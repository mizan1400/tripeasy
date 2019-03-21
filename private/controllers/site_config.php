<?php require_once('../init.php'); ?>

<?php

if (Helper::is_post()) {
    $errors = new Errors();
    $message = new Message();
    $site_config = new Site_Config();

    $site_config->firebase_auth = $_POST['firebase_auth'];
    $site_config->id = $_POST['id'];
    $site_config->admin_id = $_POST['admin_id'];

    if(empty($site_config->firebase_auth)){

        $site_config->title = $_POST['title'];
        $site_config->tag_line = $_POST['tag_line'];
        $site_config->image_name = $_POST['prev_image'];

        $site_config->validate_except(["image_name", "firebase_auth"]);
        $errors = $site_config->get_errors();

        if($errors->is_empty()){

            if(!empty($_FILES["image_name"]["name"])){
                $upload = new Upload($_FILES["image_name"]);
                if($upload->upload()){
                    $upload->delete($site_config->image_name);
                    $site_config->image_name = $upload->get_file_name();
                }
                $errors = $upload->get_errors();
            }

            if($errors->is_empty()){
                $new_site_config = clone $site_config;
                $new_site_config->id = null;
                if($new_site_config->where(["id"  => $site_config->id])->update()){
                    $message->set_message("Site Successfully Updated");
                }
            }
        }

        if(!$message->is_empty()){
            Session::set_session($message);
        }else{
            Session::set_session($errors);
        }
        Helper::redirect_to("../../public/site-config.php");

    }else if(!empty($site_config->firebase_auth)){

        $site_config->validate_except(["title", "tag_line", "image_name"]);
        $errors = $site_config->get_errors();

        if($errors->is_empty()){
            $new_site_config = clone $site_config;
            $new_site_config->id = null;
            $new_site_config->admin_id = null;

            if($new_site_config->where(["id"  => $site_config->id])->andWhere(["admin_id" => $site_config->admin_id])->update()){
                $message->set_message("Firebase Auth Updated");
            }else{
                $errors->add_error("Error occurred while updating.");
            }
        }

        if(!$message->is_empty()){
            Session::set_session($message);
        }else{
            Session::set_session($errors);
        }
        Helper::redirect_to("../../public/push-notifications.php");

    }

}

?>