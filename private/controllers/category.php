<?php require_once('../init.php'); ?>
<?php

$errors = new Errors();
$message = new Message();
$category = new Category();

if (Helper::is_post()) {

    $category->admin_id = $_POST['admin_id'];

    if(empty($_POST['id'])){
        $category->title = $_POST['title'];
        $category->status = (isset($_POST['status'])) ? 1 : 2;

        $category->image_name = $_FILES["image_name"]["name"];
        $category->validate_except(["id"]);
        $errors = $category->get_errors();

        if($errors->is_empty()){
            if(!empty($_FILES["image_name"]["name"])){
                $upload = new Upload($_FILES["image_name"]);
                if($upload->upload()){
                    $category->image_name = $upload->get_file_name();
                }
                $errors = $upload->get_errors();
            }

            if($errors->is_empty()){
                if($category->save()){
                    $message->set_message("Category Created Successfully");
                }
            }
        }
    }else if(!empty($_POST['id'])){

        $category->id = $_POST['id'];
        $category->title = $_POST['title'];
        $category->status = (isset($_POST['status'])) ? 1 : 2;
        $category->image_name = $_POST['prev_image'];

        $category->validate_except(["image_name"]);
        $errors = $category->get_errors();


        if($errors->is_empty()){

            if(!empty($_FILES["image_name"]["name"])){
                $upload = new Upload($_FILES["image_name"]);
                if($upload->upload()){
                    $upload->delete($category->image_name);
                    $category->image_name = $upload->get_file_name();
                }
                $errors = $upload->get_errors();
            }

            if($errors->is_empty()){
                if($category->where(["id"=>$category->id])->andWhere(["admin_id" => $category->admin_id])->update()){
                    $message->set_message("Category Updated Successfully");
                }
            }
        }
    }
}if (Helper::is_get()) {

    if(!empty($_GET['id'])){
        $category->id = $_GET['id'];
        if($category->where(["id" => $category->id])->delete()){
            $message->set_message("Category Deleted Successfully");
        }
    }
}

if(!$message->is_empty()){
    Session::set_session($message);
    Helper::redirect_to("../../public/categories.php");
}else if(!$errors->is_empty()){
    Session::set_session($errors);
    Helper::redirect_to("../../public/category-form.php");
}



?>