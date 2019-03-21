<?php require_once('../private/init.php'); ?>

<?php
$admin = Session::get_session(new Admin());
if(empty($admin)){
	Helper::redirect_to("login.php");
}

	/*$admin = new Admin();
	$admin->password = "123456";
	$admin->username = "admin";
	$admin->save();*/



	//echo $admin->where(["id" => 6])->andWhere(["username" => "s1"])->update();

	//print_r($admin->where(["id" => 1])->andWhere(["username" => "admin"])->all());
	//print_r($admin->orderBy("id")->desc()->andOrderBy("username")->desc()->all());


	/*	$password_hash = password_hash("123", PASSWORD_BCRYPT);

	if (password_verify(123, $password_hash)) echo "TRUE";
	else echo "FALSE";*/

?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">

	<?php require("common/php/sidebar.php"); ?>

	<div class="main-content">

		<div class="item-wrapper three">

			<div class="item item-dahboard">
				<div class="item-inner">

					<div class="item-content">
						<h2 class="title"><b>61</b></h2>
						<h4 class="desc">Wallpapers</h4>
					</div><!--item-content-->

					<div class="icon"><i class="far fa-images"></i></div>

					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->

				</div><!--item-inner-->
			</div><!--item-->


			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b>61</b></h2>
						<h4 class="desc">Downloads</h4>
					</div>
					<div class="icon"><i class="far fa-archive"></i></div>
					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->
				</div><!--item-inner-->
			</div><!--item-->

			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b>6</b></h2>
						<h4 class="desc">Categories</h4>
					</div>
					<div class="icon"><i class="far fa-shopping-basket"></i></div>
					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->
				</div><!--item-inner-->
			</div><!--item-->

			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b>6</b></h2>
						<h4 class="desc">Rating</h4>
					</div>
					<div class="icon"><i class="fal fa-star-half-alt"></i></div>
					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->
				</div><!--item-inner-->
			</div><!--item-->


			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b>3.3</b></h2>
						<h4 class="desc">Average Rating</h4>
					</div>
					<div class="icon"><i class="fas fa-star-half-alt"></i></div>

					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->

				</div><!--item-inner-->
			</div><!--item-->

			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b>13</b></h2>
						<h4 class="desc">Users</h4>
					</div>
					<div class="icon"><i class="fas fa-users"></i></div>
					<div class="item-footer">
						<a class="" href="#">More info <i class="fas fa-angle-double-right"></i></a>
					</div><!--item-footer-->

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