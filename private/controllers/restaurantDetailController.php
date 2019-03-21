<?php require_once('../init.php'); ?>
<?php

//creating objects
$response = new Response();
$errors = new Errors();
$admin = Session::get_session(new Admin());
$message = Session::get_temp_session(new Message());


$restaurant_detail_id_to_delete = isset($_GET['delete']) ? $_GET['delete'] : '';
if(!empty($restaurant_detail_id_to_delete))
{

    $item_images = new Item_Images();
    $restaurant_detail = new Restaurant_details();

    if($item_images->where(["type_id" => $restaurant_detail_id_to_delete])->andWhere(["type" => 3])->delete() && $restaurant_detail->where(["id" => $restaurant_detail_id_to_delete])->delete())
    {
        Helper::redirect_to("../../public/restaurant-details.php");
    }

}
else{

    // Add or Edit
    $item_images = new Item_Images();
    $restaurant_detail = new Restaurant_details();

    // Data for update
    $restaurant_detail_id = isset($_GET['id']) ? $_GET['id'] : '';
    $restaurant_detail_to_update = !empty($restaurant_detail_id) ? $restaurant_detail->where(["id" => $restaurant_detail_id])->one() : '';
    $item_image_id = !empty($restaurant_detail_to_update) ? $restaurant_detail_to_update->itm_img_id : '';

    // Last restaurant details id
    $restaurant_detail = new Restaurant_details();
    $last_restaurant_detail_id_result = $restaurant_detail->orderBy("id")->desc()->one();
    $last_restaurant_detail_id = $last_restaurant_detail_id_result->id;


    $image_name = $_FILES["item_image"]["name"];
    $target_dir = "../../public/tripeasy_images/";

    //upload item image in tripeasy_images folder
    $target_file = $target_dir . basename($image_name);
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);

    //finding image resolution
    $image_resolution = getimagesize($target_dir . $target_file);
    $image_resolution = "$image_resolution[0]:$image_resolution[1]";

    // data for item_image table
    $item_images->admin_id = $admin->id;
    $item_images->image = $image_name;
    $item_images->type = 3;   // 3 for restaurant
    $item_images->type_id = $last_restaurant_detail_id + 1;
    $item_images->resolution = $image_resolution;

    // for edit item image
    if(!empty($item_image_id)){

        if(empty($image_name)){
            $item_images->image = $restaurant_detail_to_update->image;
            $item_images->resolution = $restaurant_detail_to_update->resolution;
        }
        $item_images->type_id = $restaurant_detail_id;
        $item_images->where(["id" => $item_image_id])->update();
    }
    else{
        // inserting item image in item_image table
        $item_images->save();
    }



    //upload image in tripeasy_images folder
    $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
    move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);

    // last item_image id
    $item_images = new Item_Images();
    $last_item_image_id_result = $item_images->orderBy("id")->desc()->one();
    $last_item_image_id = $last_item_image_id_result->id;


    // upload & insert file
    if($_FILES["files"]){

        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
        {
            $file_name = $_FILES["files"]["name"][$key];
            $file_tmp = $_FILES["files"]["tmp_name"][$key];

            // uploading file
            if(!file_exists($target_dir . $file_name))
            {
                move_uploaded_file($file_tmp,$target_dir . $file_name);
            }

            //finding image resolution
            $image_resolution = getimagesize($target_dir . $file_name);

            $image_resolution = "$image_resolution[0]:$image_resolution[1]";
            $item_images->resolution = $image_resolution;

            $item_images->admin_id = $admin->id;
            $item_images->type = 3;   // 3 for Restaurant
            $item_images->image = $file_name;
            $item_images->type_id = $last_restaurant_detail_id + 1;

            if(!empty($restaurant_detail_to_update)){
                // update
                $item_images->type_id = $restaurant_detail_id;
            }

            // insert into item_images table
            if($errors->is_empty() && !empty($file_name)){
                $item_images->save();
            }

        }
    }


    // data for restaurant details table
    $restaurant_detail = new Restaurant_details();
    $restaurant_detail->admin_id = $admin->id;
    $restaurant_detail->itm_img_id = $last_item_image_id;
    $restaurant_detail->title = $_POST["title"];
    $restaurant_detail->description = $_POST["description"];
    $restaurant_detail->latitude = $_POST["latitude"];
    $restaurant_detail->longitude = $_POST["longitude"];
    $restaurant_detail->category = $_POST["category"];
    $restaurant_detail->timing = $_POST["timing"];


    if(!empty($restaurant_detail_to_update)){
        $restaurant_detail->itm_img_id = $item_image_id;

        if($restaurant_detail->where(["id" => $restaurant_detail_id])->update()){
            Helper::redirect_to("../../public/restaurant-details.php");
        }
    }
    else{
        if($errors->is_empty()){
            if($restaurant_detail->save())
            {
                Helper::redirect_to("../../public/restaurant-details.php");
            }
        }

    }
}






/*if($errors->is_empty()){
    Session::set_session($message);
    Helper::redirect_to("../../public/places.php");
}*/
?>