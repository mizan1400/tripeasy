<?php require_once('../../../private/init.php'); ?>
<?php

$response = new Response();
$errors = new Errors();

if(Helper::is_post()){
    if(isset($_POST["api_token"])){
        $setting = new Setting();
        $setting = $setting->where(["api_token" => $_POST["api_token"]])->one();

        if(!empty($setting)){
            if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["type"])
                && isset($_POST["social_id"]) && isset($_POST["username"])){

                $user = new User();
                $user->email = trim($_POST["email"]);
                $user->password = trim($_POST["password"]);
                $user->type = trim($_POST["type"]);
                $user->social_id = trim($_POST["social_id"]);
                $user->username = trim($_POST["username"]);
                $user->admin_id = $setting->admin_id;

                if($user->type == 1){
                    $user->validate_with("email", "password", "username");
                    $errors = $user->get_errors();
                    if($errors->is_empty()){
                        $user_from_db = $user->where(["email" => $user->email])->one();
                        if(empty($user_from_db)){
                            $user->id = $user->save();
                            if(!empty($user->id)){

                                $response->create(200, "Success", $user->id);

                            }else $response->create(200, "Something Went Wrong", null);
                        }else $response->create(200, "Email Already Used", null);
                    }else $response->create(200, $errors->get_error_str(), null);
                }else if(($user->type == 2) || ($user->type == 3)){
                    
                    $user->validate_with("social_id");
                    $errors = $user->get_errors();
                    
                    if($errors->is_empty()){
                        $existing_user = $user->where(["type" => $user->type])->andWhere(["social_id" => $user->social_id])->one();
                        if(!empty($existing_user)){
                            $response->create(200, "Success", $existing_user->id);
                        }else{
                            $user->id = $user->save();
                            if(!empty($user->id)){
                                $response->create(200, "Success", $user->id);
                            }else $response->create(200, "Something Went Wrong", null);
                        }
                    }else $response->create(200, $errors->get_error_str(), null);
                }else $response->create(200, "Invalid User Type", null);
            }else $response->create(200, "Invalid Parameter", null);
        }else $response->create(200, "Invalid Api Token", null);
    }else $response->create(200, "Error occurred", null);
}else $response->create(200, "Invalid Request Method", null);

echo $response->response();

?>
