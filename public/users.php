<?php require_once('../private/init.php'); ?>

<?php

$admin = Session::get_session(new Admin());
if(empty($admin)){
	Helper::redirect_to("login.php");
}else{
    $all_users = new User();
    $all_users = $all_users->where(["admin_id" => $admin->id])->all();
}

?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

	<?php require("common/php/sidebar.php"); ?>

	<div class="main-content">

		<h4 class="mb-30 mb-xs-15">Registered users</h4>

		<div class="item-wrapper">

            <?php if(count($all_users) > 0){
                foreach ($all_users as $u){ ?>
                    <div class="item">
                        <div class="item-inner">

                            <div class="item-content">
                                <h6 class="color-semi-dark">Username</h6>
                                <h5>rifat</h5>
                                <h6 class="mt-15 color-semi-dark">Email</h6>
                                <h5>rifat@w3engineers.com</h5>
                            </div><!--item-content-->

                            <div class="item-footer">
                                <a class="" href="#" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>
                            </div><!--item-footer-->

                        </div><!--item-inner-->
                    </div><!--item-->
                <?php }
            }?>

		</div><!--item-wrapper-->

	</div><!--main-content-->
</div><!--main-container-->


<!-- jQuery library -->
<script src="plugin-frameworks/jquery-3.2.1.min.js"></script>


<!-- Main Script -->
<script src="common/other/script.js"></script>


</body>
</html>