<?php require_once('../private/init.php'); ?>

<?php
$errors = Session::get_temp_session(new Errors());
$message = Session::get_temp_session(new Message());
$admin = Session::get_session(new Admin());
if(empty($admin)){
    Helper::redirect_to("login.php");
}else{
    $all_categories = new Category();
    $all_categories = $all_categories->where(["admin_id" => $admin->id])->all();
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

			<div class="oflow-hidden mb-15 mb-xs-0">
				<h4 class="float-l mb-15 lh-45 lh-xs-40">Categories</h4>
				<h6 class="float-r mb-15"><b><a class="c-btn" href="category-form.php">Create Category</a></b></h6>
			</div>

			<div class="item-wrapper">
				<div class="masonry-grid">

                    <?php if(count($all_categories) > 0){
                        foreach ($all_categories as $category){ ?>
                            <div class="masonry-item category-item">
                                <div class="item item-img">
                                    <div class="item-inner">

                                        <h6 class="all-status"><?php
                                            if($category->status == 1) echo "<span class='active'>Active</span>";
                                            else echo "<span class='inactive'>Inactive</span>";
                                            ?></h6>

                                        <a class="image-wrapper" href="#">
                                            <img src="<?php echo "uploads" . DIRECTORY_SEPARATOR . $category->image_name; ?>" alt="image"/></a>

                                        <h5 class="image-footer"><b><?php echo $category->title; ?></b></h5>

                                        <div class="img-header action-btn-wrapper">
                                            <div class="action-btn-inner">
                                                <a href="<?php echo 'category-form.php?id=' . $category->id; ?>"<i class="fas fa-edit"></i></a>
                                                <a href="<?php echo '../private/controllers/category.php?id=' . $category->id;?>"
                                                   data-confirm="Are you sure you want to delete this item?" data-method="post">
                                                    <i class="fas fa-trash-alt"></i></a>

                                            </div><!--action-btn-inner-->
                                        </div><!--action-btn-wrapper-->

                                    </div><!--item-inner-->
                                </div><!--item-->
                            </div><!--masonry-item category-item-->

                    <?php }
                    } ?>

				</div><!--masonry-grid-->
			</div><!--item-wrapper-->

		</div><!--item-wrapper-->
	</div><!--main-content-->
</div><!--main-container-->


<?php require("common/php/php-footer.php"); ?>