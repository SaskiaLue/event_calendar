<?php
// change the used language

// start the session
session_start();

// set language
$_SESSION['phpcal_lang']=$_GET['lang'];

header("Location: ".$_SESSION['phpcal_page']);
exit;
?>