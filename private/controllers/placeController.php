<?php require_once('../init.php'); ?>
<?php

//creating objects
$response = new Response();
$errors = new Errors();
$admin = Session::get_session(new Admin());
$message = Session::get_temp_session(new Message());


$place_id_to_delete = isset($_GET['delete']) ? $_GET['delete'] : '';
if(!empty($place_id_to_delete))
{

    $item_images = new Item_Images();
    $place = new Place();

    if($item_images->where(["type_id" => $place_id_to_delete])->andWhere(["type" => 1])->delete() && $place->where(["id" => $place_id_to_delete])->delete())
    {
        Helper::redirect_to("../../public/places.php");
    }

}
else{

    // Add or Edit
    $item_images = new Item_Images();
    $place = new Place();

    // Data for update
    $place_id = isset($_GET['id']) ? $_GET['id'] : '';
    $place_to_update = !empty($place_id) ? $place->where(["id" => $place_id])->one() : '';
    $item_image_id = !empty($place_to_update) ? $place_to_update->itm_img_id : '';

    // Last place id
    $place = new Place();
    $last_place_id_result = $place->orderBy("id")->desc()->one();
    $last_place_id = $last_place_id_result->id;


    $image_name = $_FILES["place_image"]["name"];
    $target_dir = "../../public/tripeasy_images/";

    //upload item image in tripeasy_images folder
    $target_file = $target_dir . basename($image_name);
    move_uploaded_file($_FILES["place_image"]["tmp_name"], $target_file);

    //finding image resolution
    $image_resolution = getimagesize($target_dir . $image_name);
    $image_resolution = "$image_resolution[0]:$image_resolution[1]";

    // data for item_image table
    $item_images->admin_id = $admin->id;
    $item_images->image = $image_name;
    $item_images->type = 1;   // 1 for place
    $item_images->type_id = $last_place_id + 1;
    $item_images->resolution = $image_resolution;

    // for edit item image
    if(!empty($item_image_id)){

        if(empty($image_name)){
            $item_images->image = $place_to_update->image;
            $item_images->resolution = $place_to_update->resolution;;
        }
        $item_images->type_id = $place_id;
        $item_images->where(["id" => $item_image_id])->update();
    }
    else{
        // inserting item image in item_image table
        $item_images->save();
    }



    //upload image in tripeasy_images folder
    $target_file = $target_dir . basename($_FILES["place_image"]["name"]);
    move_uploaded_file($_FILES["place_image"]["tmp_name"], $target_file);

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
            $item_images->type = 1;   // 1 for place
            $item_images->image = $file_name;
            $item_images->type_id = $last_place_id + 1;

            if(!empty($place_to_update)){
                // update
                $item_images->type_id = $place_id;
            }

            // insert into item_images table
            if($errors->is_empty() && !empty($file_name)){
                $item_images->save();
            }

        }
    }


    // data for places table
    $place = new Place();
    //$place->id = $last_place_id + 1;
    $place->admin_id = $admin->id;
    $place->itm_img_id = $last_item_image_id;
    $place->place_title = $_POST["place_title"];
    $place->description = $_POST["place_description"];
    $place->latitude = $_POST["place_latitude"];
    $place->longitude = $_POST["place_longitude"];
    $place->address = $_POST["place_address"];
    $place->featured = (isset($_POST["featured"]) && $_POST["featured"] == 'on') ? 1 : 0;

    if(!empty($place_to_update)){
        $place->itm_img_id = $item_image_id;

        if($place->where(["id" => $place_id])->update()){
            Helper::redirect_to("../../public/places.php");
        }
    }
    else{
        if($errors->is_empty()){
            if($place->save())
            {
                Helper::redirect_to("../../public/places.php");
            }
        }

    }
}






/*if($errors->is_empty()){
    Session::set_session($message);
    Helper::redirect_to("../../public/places.php");
}*/
?>