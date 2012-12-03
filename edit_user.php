<?php

// included files
include_once("modules/user_db.php");

// start the session
session_start();
/*
 * show all errors
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

if (isset($_GET['id'])) $userid=(int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// get values
	$values = array();
	$values['id'] = $_POST['user_id'];
	$values['user_name'] = $_POST['user_name'];
	$values['user_password'] = $_POST['user_password'];  
	$values['user_mail'] = $_POST['user_mail'];
	
	// enter changed user into db
	edit_user($values);
	header('Location: user_config.php');
    exit();
}

$user=array();
$user=get_user($userid);

include("header.php");

include($lang); ?>
		<h2><?=$edit_user['Headline']; ?></h2>
		<div id="userformular">
			<form id="user_formular" name="user_formular" action="<?=htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<ul>
				<li><input type="hidden" name="user_id" value=<?='"'.$userid.'"'; ?>></li>
				<li><label for="user_name" id="em"><?=$footer['login_name']; ?>:<strong>*</strong></label></li>
				<li><input type="text" name="user_name" size="35" maxlength="128" value="<?=$user['username']; ?>"></li>
				<li><label for="user_password" id="em"><?=$footer['login_pw']; ?>:<strong>*</strong></label></li>
				<li><input type="password" name="user_password" size="35" maxlength="128" value="<?=$user['pwd']; ?>"/></li>
				<li><label for="user_mail" id="em"><?=$user_config['mail']; ?>:</label></li>
				<li><input type="text" id="user_mail" name="user_mail" size="35" maxlength="128" value="<?=$user['mail']; ?>"/></li>
				<li><input type="submit" class="submit" value="<?=$main['submit']; ?>"></li>
			</ul>
			</form>
		</div>
<?php include('footer.php');