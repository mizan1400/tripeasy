<?php require_once('../../../private/init.php'); ?>
<?php

$response = new Response();
$errors = new Errors();

if(Helper::is_post()){
    if(isset($_POST["api_token"])){
        $setting = new Setting();
        $admin = $setting->where(["api_token" => $_POST["api_token"]])->one();

        if(!empty($admin)){
            if(isset($_POST["email"]) && isset($_POST["password"])){

                $user = new User();
                $user->email = trim($_POST["email"]);
                $user->password = trim($_POST["password"]);
                $user = $user->verify_login();
                if(!empty($user)){
                    $user->password = "";
                    $response->create(200, "Successfully Signedin", json_encode($user));
                }else $response->create(200, "Invalid Email/Password", null);
            }else $response->create(200, "Invalid Parameter", null);
        }else $response->create(200, "Invalid Api Token", null);
    }else $response->create(200, "Error occurred", null);
}else $response->create(200, "Invalid Request Method", null);

echo $response->response();

?>
