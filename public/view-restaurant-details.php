<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());

if(empty($admin)){
    Helper::redirect_to("login.php");
}else{

    $restaurant_detail_id = isset($_GET['id']) ? $_GET['id'] : '';

    $all_restaurant_detail = new Restaurant_details();
    $restaurant_detail = $all_restaurant_detail->where(["admin_id" => $admin->id])->andWhere(["id" => $restaurant_detail_id])->one();

}

?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

    <?php require("common/php/sidebar.php"); ?>

    <div class="main-content">
        <div class="form-wrapper">
            <div class="form-content">

                <h4 class="m-title">Restaurant Details</h4>

                <div class="form-inner">

                    <?php
                    if (!empty($restaurant_detail)) {
                        $multipleImages = Restaurant_details::multiple_img($restaurant_detail_id);
                        foreach ($multipleImages as $img) {
                            if($img->id != $restaurant_detail->itm_img_id){
                                $image_url = '/public/tripeasy_images/' . $img->image;
                                echo '<img src=" '. $image_url.'" alt="image" class="upload_form_img"/>';
                            }
                        }
                    }
                    ?>

                    <div class="oflow-hidden">
                        <div class="w-50 float-l">

                            <div class="mb-20">
                                <h6 class="color-semi-dark mb-5">Restaurant Title</h6>
                                <h5><?= $restaurant_detail->title ?></h5>
                            </div><!--mb-20-->

                            <div class="mb-20">
                                <h6 class="color-semi-dark mb-5">Latitude</h6>
                                <h5><?= $restaurant_detail->latitude ?></h5>
                            </div><!--mb-20-->

                            <div class="mb-20">
                                <h6 class="color-semi-dark mb-5">Longitude</h6>
                                <h5><?= $restaurant_detail->longitude ?></h5>
                            </div><!--mb-20-->

                        </div><!--w-50 float-l-->
                        <div class="w-50 float-l">

                            <div class="mb-20">
                                <h6 class="color-semi-dark mb-5">Description</h6>
                                <h5><?= $restaurant_detail->description ?></h5>
                            </div><!--mb-20-->

                        </div><!--w-50 float-l-->
                    </div><!--oflow-hidden-->


                    <h6 class="mt-30">
                        <b><a class="c-btn mr-7 mb-10" href="<?= '/public/restaurant_detail_form.php?id=' . $restaurant_detail_id ?>">Update</a></b>
                        <b><a class="c-btn delete mb-10" href="<?= '../private/controllers/restaurantDetailController.php?delete=' . $restaurant_detail_id ?>"
                              onclick="return confirm('Are you sure you want to delete this item?');" data-method="post">Delete</a></b>
                    </h6>


                </div><!--form-inner-->
            </div><!--form-content-->
        </div><!--form-wrapper-->


    </div><!--main-content-->
</div><!--main-container-->


<?php require("common/php/php-footer.php"); ?>
