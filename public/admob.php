<?php require_once('../private/init.php'); ?>
<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());
if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $settings = new Setting();
    $settings = $settings->where(["admin_id" => 1])->one();
    $admobs = new Admob();
    $admobs = $admobs->where(["admin_id" => 1])->one();
}

?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

	<?php require("common/php/sidebar.php"); ?>

	<div class="main-content">

            <div class="item-wrapper three">

                <div class="ml-15 mt-15"><?php if($message) echo $message->format(); ?></div>
                
                <form method="post" action="../private/controllers/admob.php">

                    <input type="hidden" name="setting_id" value="<?php echo $settings->id; ?>"/>
                    <input type="hidden" name="admob_id" value="<?php echo $admobs->id; ?>"/>
                    <input type="hidden" name="admin_id" value="<?php echo $admobs->admin_id; ?>"/>

                    <div class="item">

                        <div class="item-inner">
                            <div class="item-header">
                                <h5 class="dplay-inl-b">Banner Ad</h5>

                                <h5 class="float-r oflow-hidden">
                                    <label href="#" class="switch">
                                        <input type="checkbox" name="banner_ad"
                                            <?php if($settings->banner_ad == 1) echo "checked"; ?>/>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="toggle-title"></span>
                                </h5>
                            </div>

                            <div class="item-content">

                                <label>App ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-8647879749090078~4918217822"
                                       value="<?php echo $admobs->banner_id; ?>" name="banner_id"/>

                                <label>Ad Unit ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-ca-app-pub-3940256099942544/5224354917"
                                       value="<?php echo $admobs->banner_unit_id; ?>" name="banner_unit_id"/>
                                <div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>

                                <?php if(Session::get_session_by_key("type") == "banner_ad"){
                                    Session::unset_session_by_key("type");
                                    if($errors) echo $errors->format();
                                }?>

                            </div><!--item-content-->
                        </div><!--item-inner-->
                    </div><!--item-->
                </form>

                <form method="post" action="../private/controllers/admob.php">

                    <input type="hidden" name="setting_id" value="<?php echo $settings->id; ?>"/>
                    <input type="hidden" name="admob_id" value="<?php echo $admobs->id; ?>"/>
                    <input type="hidden" name="admin_id" value="<?php echo $admobs->admin_id; ?>"/>

                    <div class="item">
                        <div class="item-inner">

                            <div class="item-header">
                                <h5 class="dplay-inl-b">Interstitial Ad</h5>

                                <h5 class="float-r oflow-hidden">
                                    <label href="#" class="switch">
                                        <input type="checkbox" name="interstitial_ad"
                                            <?php if($settings->interstitial_ad == 1) echo "checked"; ?>/>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="toggle-title"></span>
                                </h5>
                            </div>

                            <div class="item-content">
                                <label>App ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-8647879749090078~4918217822"
                                       value="<?php echo $admobs->interstitial_id; ?>" name="interstitial_id"/>

                                <label>Ad Unit ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-ca-app-pub-3940256099942544/5224354917"
                                       value="<?php echo $admobs->interstitial_unit_id; ?>" name="interstitial_unit_id" />
                                <div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>


                                <?php if(Session::get_session_by_key("type") == "interstitial_ad"){
                                    Session::unset_session_by_key("type");
                                    if($errors) echo $errors->format();
                                }?>

                            </div><!--item-content-->

                        </div><!--item-inner-->
                    </div><!--item-->
                </form>

                <form method="post" action="../private/controllers/admob.php">

                    <input type="hidden" name="setting_id" value="<?php echo $settings->id; ?>"/>
                    <input type="hidden" name="admob_id" value="<?php echo $admobs->id; ?>"/>
                    <input type="hidden" name="admin_id" value="<?php echo $admobs->admin_id; ?>"/>

                    <div class="item">
                        <div class="item-inner">

                            <div class="item-header">
                                <h5 class="dplay-inl-b">Video Ad</h5>

                                <h5 class="float-r oflow-hidden">
                                    <label href="#" class="switch">
                                        <input type="checkbox" name="video_ad"
                                            <?php if($settings->video_ad == 1) echo "checked"; ?>/>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="toggle-title"></span>
                                </h5>
                            </div>

                            <div class="item-content">
                                <label>App ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-8647879749090078~4918217822"
                                       value="<?php echo $admobs->video_id; ?>" name="video_id"/>

                                <label>Ad Unit ID</label>
                                <input type="text" placeholder="eg. ca-app-pub-ca-app-pub-3940256099942544/5224354917"
                                       value="<?php echo $admobs->video_unit_id; ?>" name="video_unit_id"/>
                                <div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>

                                <?php if(Session::get_session_by_key("type") == "video_ad"){
                                    Session::unset_session_by_key("type");
                                    if($errors) echo $errors->format();
                                }?>

                            </div><!--item-content-->

                        </div><!--item-inner-->
                    </div><!--item-->
                </form>
            </div><!--item-wrapper-->

	</div><!--main-content-->
</div><!--main-container-->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/other/script.js"></script>


</body>
</html>