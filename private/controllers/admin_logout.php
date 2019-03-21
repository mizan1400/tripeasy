
<?php require_once('../init.php'); ?>

<?php


Session::unset_session(new Admin());
Helper::redirect_to("../../public/login.php");

?>