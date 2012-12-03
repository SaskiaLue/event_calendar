<?php

// included files
include("modules/user_db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ( ( trim($_POST['user_name']) != '' ) AND ( trim($_POST['user_password']) != '' ) AND ( filter_var($_POST['user_mail'] , FILTER_VALIDATE_EMAIL)) ) {
	// get values
	$values = array();
	$values['user_name'] = $_POST['user_name'];
	$values['user_password'] = $_POST['user_password'];  
	$values['user_mail'] = $_POST['user_mail'];
	
	// connect to db and enter query
	insert_user($values);
	}
}

//back to user management
header('Location:  user_config.php');
?>