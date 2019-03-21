<?php require_once('../private/init.php'); ?>

<?php

$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());


if(empty($admin)){
	Helper::redirect_to("login.php");
}else{
	$settings = new Setting();
	$settings = $settings->where(["admin_id" => $admin->id])->one();
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

			<div class="item">
				<div class="item-inner">

					<h4 class="item-header">APi Token</h4>

					<div class="item-content">
						<form method="post" action="../private/controllers/setting.php">

                            <input type="hidden" name="id" value="<?php echo $settings->id; ?>"/>
                            <input type="hidden" name="admin_id" value="<?php echo $settings->admin_id; ?>"/>

							<label>Api Token</label>
							<input type="text" placeholder="eg. bmdk2433xcscww#4gfe" name="api_token"
								   value="<?php echo $settings->api_token; ?>">

							<div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>
						</form>

                        <?php if(Session::get_session_by_key("type") == "api_token"){
                            Session::unset_session_by_key("type");
                            if($errors) echo $errors->format();
                        }?>

					</div><!--item-content-->

				</div><!--item-inner-->
			</div><!--item-->

			<div class="item">
				<div class="item-inner">

					<h4 class="item-header">Popular View Count</h4>

					<div class="item-content">
                        <form method="post" action="../private/controllers/setting.php">

                            <input type="hidden" name="id" value="<?php echo $settings->id; ?>"/>
                            <input type="hidden" name="admin_id" value="<?php echo $settings->admin_id; ?>"/>

							<label>Minimum view count to be in popular video list</label>
							<input type="text" placeholder="eg. 100" name="popular_view_count" value="<?php echo $settings->popular_view_count; ?>">

							<div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>
						</form>

                        <?php if(Session::get_session_by_key("type") == "popular_view_count"){
                            Session::unset_session_by_key("type");
                            if($errors) echo $errors->format();
                        }?>

					</div><!--item-content-->

				</div><!--item-inner-->
			</div><!--item-->


	</div><!--main-content-->
</div><!--main-container-->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/other/script.js"></script>


</body>
</html>