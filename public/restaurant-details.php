<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $all_restaurant_details = new Restaurant_details();
    $all_restaurant_details = $all_restaurant_details->where(["admin_id" => $admin->id])->all();
}



?>

<?php require("common/php/php-head.php"); ?>

    <body>

<?php require("common/php/header.php"); ?>

    <div class="main-container">

        <?php require("common/php/sidebar.php"); ?>

        <div class="main-content">

            <div class="item-wrapper">

                <?php if($message) echo $message->format(); ?>

                <!--Add place button-->
                <div class="oflow-hidden mb-15 mb-xs-0">
                    <h4 class="float-l mb-15 lh-45 lh-xs-40">Restaurant Details</h4>
                    <h6 class="float-r mb-15"><b><a class="c-btn" href="restaurant_detail_form.php">Add Restaurant Details</a></b></h6>
                </div>


                <div class="item-wrapper">
                    <div class="masonry-grid">
                        <?php
                        if(count($all_restaurant_details)){
                            foreach ($all_restaurant_details as $restaurant_detail) { ?>
                                <div class="masonry-item wallpaper-item">
                                    <div class="item  item-img">
                                        <div class="item-inner">

                                            <?php
                                            // creating image source path
                                            $restaurant_detail_image = Place::imageName($restaurant_detail->itm_img_id);
                                            $image_source = "/public/tripeasy_images/" . $restaurant_detail_image;
                                            ?>

                                            <!-- Image of place -->
                                            <img src="<?= $image_source; ?>" alt="image"/>

                                            <!-- View, edit, delete button section -->
                                            <div class="item-header action-btn-wrapper">
                                                <div class="action-btn-inner">
                                                    <a href="<?= '/public/view-restaurant-details.php?id=' . $restaurant_detail->id ?>"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= '/public/restaurant_detail_form.php?id=' . $restaurant_detail->id ?>"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= '../private/controllers/restaurantDetailController.php?delete=' . $restaurant_detail->id ?>"
                                                       onclick="return confirm('Are you sure you want to delete this item?');" data-method="post">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div><!--action-btn-wrapper-->

                                            <div class="image-footer">
                                                <!--latitude longitude section-->
                                                <h6 class="footer-content">
                                                    <span class="mr-15"><i class="fas fa-star"></i><b>Latitude: <?= $restaurant_detail->latitude; ?></b></span>
                                                    <span class="mr-15"><i
                                                            class="fas fa-star"></i><b>Longitude: <?= $restaurant_detail->longitude; ?></b></span>
                                                    <span><i class="fas fa-download"></i><b><?= $restaurant_detail->place_title; ?></b></span>
                                                    <span><i class="fas fa-download"></i><b><?= $restaurant_detail->address; ?></b></span>
                                                </h6>
                                            </div><!--item-footer-->

                                        </div><!--item-inner-->
                                    </div><!--item-->
                                </div><!--wallpaper-item-->
                            <?php } } ?>
                    </div><!--wallpaper-grid-->
                </div><!--item-wrapper-->

            </div><!--item-wrapper-->
        </div><!--main-content-->
    </div><!--main-container-->


<?php require("common/php/php-footer.php"); ?>