<?php

$current = basename($_SERVER["SCRIPT_FILENAME"]);

if($current == "index.php") $index = "active";
else if(($current == "categories.php") ||($current == "category-form.php")) $categories = "active";
else if($current == "videos.php") $videos = "active";
else if($current == "places.php" || $current == "view-place.php" || $current == "place-form.php") $places = "active";
else if($current == "restaurant-details.php") $restaurant_details = "active";
else if($current == "restaurant-menu.php") $restaurant_menu = "active";
else if($current == "hotel-details.php") $hotel_details = "active";
else if($current == "hotel-room.php") $hotel_room = "active";
else if($current == "images.php") $images = "active";
else if($current == "users.php") $users = "active";
else if($current == "setting.php") $setting = "active";
else if($current == "admob.php") $admob = "active";
else if($current == "site-config.php") $site_config = "active";
else if(($current == "push-notifications.php") || $current == "push-notification-form.php") $push_notifications = "active";

?>

<div class="sidebar">
    <ul class="sidebar-list">
        <li class="<?php echo $index; ?>"><a href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="<?php echo $places; ?>"><a href="places.php"><i class="fas fa-tachometer-alt"></i><span>Places</span></a></li>
        <li class="<?php echo $restaurant_details; ?>"><a href="restaurant-details.php"><i class="fas fa-tachometer-alt"></i><span>Restaurant Details</span></a></li>
        <li class="<?php echo $restaurant_menu; ?>"><a href="restaurant-menu.php"><i class="fas fa-tachometer-alt"></i><span>Restaurant Menu</span></a></li>
        <li class="<?php echo $hotel_details; ?>"><a href="hotel-details.php"><i class="fas fa-tachometer-alt"></i><span>Hotel Details</span></a></li>
        <li class="<?php echo $hotel_room; ?>"><a href="hotel-room.php"><i class="fas fa-tachometer-alt"></i><span>Hotel Room</span></a></li>
        <li class="<?php echo $images; ?>"><a href="images.php"><i class="fas fa-tachometer-alt"></i><span>Images</span></a></li>
        <li class="<?php echo $categories; ?>"><a href="categories.php"><i class="far fa-shopping-basket"></i><span>Categories</span></a></li>
        <li class="<?php echo $videos; ?>"><a href="videos.php"> <i class="far fa-images"></i><span>Videos</span></a></li>
        <li class="<?php echo $users; ?>"><a href="users.php"><i class="fas fa-users"></i><span>Register Users</span></a></li>
        <li class="<?php echo $admob; ?>"><a href="admob.php"><i class="fab fa-adversal"></i><span>Admob</span></a></li>
        <li class="<?php echo $push_notifications; ?>"><a href="push-notifications.php"><i class="fal fa-cog"></i><span>Push Notification</span></a></li>
        <li class="<?php echo $site_config; ?>"><a href="site-config.php"><i class="fal fa-cog"></i><span>Configuration</span></a></li>
        <li class="<?php echo $setting; ?>"><a href="setting.php"><i class="fab fa-adversal"></i><span>Setting</span></a></li>
    </ul>
</div><!--sidebar-->