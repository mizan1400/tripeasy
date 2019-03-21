<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $all_restaurant_menu = new Res_menu();
    $all_restaurant_menu = $all_restaurant_menu->where(["admin_id" => $admin->id])->all();
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
                    <h4 class="float-l mb-15 lh-45 lh-xs-40">Restaurant Menu</h4>
                    <h6 class="float-r mb-15"><b><a class="c-btn" href="restaurant_menu_form.php">Add Restaurant Menu</a></b></h6>
                </div>


                <div class="item-wrapper">
                    <div class="masonry-grid">
                        <?php
                        if(count($all_restaurant_menu)){
                            foreach ($all_restaurant_menu as $restaurant_menu) { ?>
                                <div class="masonry-item wallpaper-item">
                                    <div class="item  item-img">
                                        <div class="item-inner">

                                            <?php
                                            // creating image source path
                                            $restaurant_menu_image = $restaurant_menu->image;
                                            $image_source = "/public/tripeasy_images/" . $restaurant_menu_image;
                                            ?>

                                            <!-- Image of place -->
                                            <img src="<?= $image_source; ?>" alt="image"/>

                                            <!-- View, edit, delete button section -->
                                            <div class="item-header action-btn-wrapper">
                                                <div class="action-btn-inner">
                                                    <a href="<?= '/public/view-restaurant-menu.php?id=' . $restaurant_menu->id ?>"><i class="fas fa-eye"></i></a>
                                                    <a href="<?= '/public/restaurant_menu_form.php?id=' . $restaurant_menu->id ?>"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= '../private/controllers/restaurantMenuController.php?delete=' . $restaurant_menu->id ?>"
                                                       onclick="return confirm('Are you sure you want to delete this item?');" data-method="post">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div><!--action-btn-wrapper-->

                                            <div class="image-footer">
                                                <!--latitude longitude section-->
                                                <h6 class="footer-content">
                                                    <span class="mr-15"><i class="fas fa-star"></i><b>Title: <?= $restaurant_menu->title; ?></b></span>
                                                    <span class="mr-15"><i
                                                            class="fas fa-star"></i><b>Type: <?= $restaurant_menu->type ?></b></span>
                                                    <span><i class="fas fa-download"></i><b>Price: <?= $restaurant_menu->price ?></b></span>
                                                    <span><i class="fas fa-download"></i><b>Quantity: <?= $restaurant_menu->quantity ?></b></span>
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