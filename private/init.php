<?php

ob_start(); // output buffering is turned on

session_start();


// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . DIRECTORY_SEPARATOR  . 'public');
define("UPLOAD_FOLDER", PUBLIC_PATH . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);
define("UPLOAD_LINK", getcwd() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);

// Assign the root URL to a PHP constant
// * Do not need to include the domain
// * Use same document root as webserver
// * Can set a hardcoded value:
// define("WWW_ROOT", '/~kevinskoglund/globe_bank/public');
// define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('models/lib/Database.php');
require_once('models/lib/Helper.php');
require_once('models/lib/Session.php');
require_once('models/lib/Response.php');
require_once('models/lib/Errors.php');
require_once('models/lib/Message.php');
require_once('models/lib/Upload.php');

require_once('models/Admin.php');
require_once('models/Site_Config.php');
require_once('models/Setting.php');
require_once('models/Push_Notification.php');
require_once('models/Admob.php');
require_once('models/User.php');
require_once('models/Category.php');
require_once('models/Place.php');
require_once('models/Item_Images.php');
require_once('models/Restaurant_details.php');
require_once('models/Res_menu.php');


define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "tripeasy_new");


//$db = db_connect();


?>
