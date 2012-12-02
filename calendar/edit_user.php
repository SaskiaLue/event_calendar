<?php

// included files
include_once("user_db.php");

// start the session
session_start();
/*
 * show all errors
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

if (isset($_GET['id'])) $userid=$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// get values
	$values = array();
	$values['id'] = $_POST['user_id'];
	$values['user_name'] = $_POST['user_name'];
	$values['user_password'] = $_POST['user_password'];  
	$values['user_mail'] = $_POST['user_mail'];
	
	// enter changed user into db
	edit_user($values);
	header('Location: ../user_config.php');
    exit();
}

$user=array();
$user=get_user($userid);
?>
<html>
<head>
<!-- einbinden von jQuey -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/validate.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>
<script type="text/javascript" src="../js/main.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Calendar</title>
<meta name="DESCRIPTION" content="event calendar">
<meta name="KEYWORDS" content="event calendar">
<meta name="GENERATOR" content="">
<link href="../css/styles.css?template=av-067&colorScheme=green&header=headers1&button=buttons1" rel="stylesheet" type="text/css">
<link href="../css/stickytooltip.css" rel="stylesheet" type="text/css" />
<link href="../css/css-reset.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
// get the correct language from the session
function check_lang() {
	// check if a language is selected
	if (!isset($_SESSION['phpcal_lang'])) { 
	// if no language is selected set default language to english
		$lang = 'en'; 
	} else { 
		$lang = $_SESSION['phpcal_lang']; 
	} 

	//directory name 
	$dir = '../languages'; 

//get the appropriate language file
	return "$dir/$lang.lng"; 
}
//this function will check user language and return the file name to be included .. 
$lang = check_lang();
include($lang); ?>
<?php // important to keep the footer on the bottom of the page ?>
<div class="wrapper">
	<header>
		<div id="logo">
			<h1>
				<?=$main['calendar'] ?>
			</h1>
			<h3 class="slogan">
				
			</h3>
		</div>
	</header>
	<div id="content">
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
	</div>
</body>
</html>

