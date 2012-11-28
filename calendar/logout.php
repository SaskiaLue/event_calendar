<?php
// included files
include("mysql_connectdb.php");
session_start();
// logout user
doLogout($_SESSION['UserID']);
$page = $_SESSION['phpcal_page'];
// clear $_SESSION
$_SESSION = array();
// delete Session
session_destroy();

header('Location: '.$page);

exit();
?>