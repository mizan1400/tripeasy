<?php require_once('../private/init.php'); ?>

<?php

    $errors = Session::get_temp_session(new Errors());
    $message = Session::get_temp_session(new Message());
	$admin = Session::get_session(new Admin());
	if(empty($admin)){
		Helper::redirect_to("login.php");
	}else{
		$site_cofig = new Site_Config();
		$site_cofig = $site_cofig->where(["admin_id" => $admin->id])->one();
	}


?>
<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

	<?php require("common/php/sidebar.php"); ?>

	<div class="main-content">
		<div class="item-wrapper one">

			<div class="item">

                <?php if($message) echo $message->format(); ?>
                
				<div class="item-inner">
					<h4 class="item-header">Site Configuration</h4>

					<div class="item-content">
						<form data-validation="true" action="../private/controllers/site_config.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $site_cofig->id; ?>"/>
							<input type="hidden" name="admin_id" value="<?php echo $site_cofig->admin_id; ?>"/>
							<input type="hidden" name="prev_image" value="<?php echo $site_cofig->image_name; ?>"/>

							<label class="control-label" for="file">Logo</label>

                            <div class="image-upload">
                                <img
									src="<?php if(!empty($site_cofig->image_name))
										echo "uploads" . DIRECTORY_SEPARATOR . $site_cofig->image_name; ?>"
									alt="" id="uploaded-image"/>
                                <div class="h-100" id="upload-content">
                                    <div class="dplay-tbl">
                                        <div class="dplay-tbl-cell">
                                            <i class="ion-ios-cloud-upload"></i>
                                            <h5><b>Choose Your Image to Upload</b></h5>
                                            <h6 class="mt-10 mb-70">Or Drop Your Image Here</h6>
                                        </div>
                                    </div>
                                </div><!--upload-content-->
                                <input type="file" name="image_name" class="image-input" value="<?php echo $site_cofig->image_name; ?>"/>
                            </div>
                            
							<label>Site Title</label>
							<input type="text" data-required="true" placeholder="Site Title" name="title" value="<?php echo $site_cofig->title; ?>"/>

							<label>Site Tag Line</label>
							<input type="text" data-required="true" placeholder="Site Tag Line" name="tag_line" value="<?php echo $site_cofig->tag_line; ?>" />

							<div class="btn-wrapper"><button type="submit" class="c-btn mb-10"><b>Update</b></button></div>

							<?php if($errors) echo $errors->format(); ?>

						</form>
					</div><!--item-content-->

				</div><!--item-inner-->
			</div><!--item-->

		</div><!--item-wrapper-->
	</div><!--main-content-->
</div><!--main-container-->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/other/script.js"></script>


</body>
</html>