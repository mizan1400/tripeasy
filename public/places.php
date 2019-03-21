<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $all_places = new Place();
    $all_places = $all_places->where(["admin_id" => $admin->id])->all();
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
                    <h4 class="float-l mb-15 lh-45 lh-xs-40">Places</h4>
                    <h6 class="float-r mb-15"><b><a class="c-btn" href="place-form.php">Add Place</a></b></h6>
                </div>


                <div class="item-wrapper">
                    <div class="masonry-grid">
                        <?php
                            if(count($all_places)){
                            foreach ($all_places as $place) { ?>
                                <div class="masonry-item wallpaper-item">
                                    <div class="item  item-img">
                                        <div class="item-inner">

                                            <?php
                                                // creating image source path
                                                $place_image = Place::imageName($place->itm_img_id);
                                                $image_source = "/public/tripeasy_images/" . $place_image;
                                            ?>

                                            <!-- Image of place -->
                                            <img src="<?= $image_source; ?>" alt="image"/>

                                            <!-- View, edit, delete button section -->
                                            <div class="item-header action-btn-wrapper">
                                                <div class="action-btn-inner">
                                                    <a href="<?= '/public/view-place.php?id=' . $place->id ?>"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= '/public/place-form.php?id=' . $place->id ?>"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= '../private/controllers/placeController.php?delete=' . $place->id ?>"
                                                       onclick="return confirm('Are you sure you want to delete this item?');" data-method="post">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div><!--action-btn-wrapper-->

                                            <div class="image-footer">
                                                <?php if ($place->featured > 0) echo '<a class="featured" href="#"><h6><b>FEATURED</b></h6></a>'; ?>

                                                <!--latitude longitude section-->
                                                <h6 class="footer-content">
                                                    <span class="mr-15"><i class="fas fa-star"></i><b>Latitude: <?= $place->latitude; ?></b></span>
                                                    <span class="mr-15"><i
                                                                class="fas fa-star"></i><b>Longitude: <?= $place->longitude; ?></b></span>
                                                    <span><i class="fas fa-download"></i><b><?= $place->place_title; ?></b></span>
                                                    <span><i class="fas fa-download"></i><b><?= $place->address; ?></b></span>
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