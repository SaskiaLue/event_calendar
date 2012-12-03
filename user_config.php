<?php 
// included files
include_once("modules/user_db.php");
include("header.php");

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

// start the session
session_start();

//this function will check user language and return the file name to be included .. 
$lang = check_lang();
include_once($lang); 
?>
<section id="calendar_wrapper">
	<h1><?php echo $user_config['headline']; ?></h1>
	<?php echo '<a id="add_user" href="#">'.$user_config['add_user'].'</a><table>' ?>
	<table cellpadding="2" cellspacing="0" border="1">
	<tr><th>user-name</th><th>mail</th><th><?php echo $user_config['edit']; ?></th><th><?php echo $user_config['delete']; ?></th></tr>
	<?php
	// get all users from the database
		$users=array();
		$users=get_users();
		foreach ($users as $user) {
			echo "<tr>";
			echo "<td>".$user['username']."</td>";
			echo "<td>".$user['mail']."</td>";
			echo "<td><a href='edit_user.php?id=".$user['id']."'>".$user_config['edit']."</a></td>";
			// it's not possible to delete the admin
			if($user['username'] == "phpadmin") {
				echo "<td>&nbsp;</td>"; 
			} else {
				echo "<td><a href='delete_user.php?id=".$user['id']."'>".$user_config['delete']."</a></td>"; 
			} 
			echo "</tr>";
		} 
	?>
	</table>
	<a href=<?php echo $_SESSION['phpcal_page']; ?>><?php echo $main['return_message']; ?></a>
</section>
<div id="overlay">
	<div class="user_overlay">
		<!-- <form id="user_formular" name="user_formular" action="" method="POST">!-->
		<form id="user_formular" name="user_formular" action="save_user.php" method="POST">
			<ul>
			<li><b><?php echo $user_config['add_user']?></b></li>
			<li><label for="user_name" id="em"><?=$footer['login_name']; ?>:<strong>*</strong></label></li>
			<li><input type="text" name="user_name" size="35" maxlength="128" value=""><span class="error"></span></li>
			<li><label for="user_password" id="em"><?=$footer['login_pw']; ?>:<strong>*</strong></label></li>
			<li><input type="password" name="user_password" size="35" maxlength="128" value=""/><span class="error"></span></li>
			<li><label for="user_mail" id="em"><?=$user_config['mail']; ?>:</label></li>
			<li><input type="text" id="user_mail" name="user_mail" size="35" maxlength="128" value=""/><span class="error"></span></li>
			<li><input type="submit" class="submit" value="<?=$main['submit']; ?>"> <a href="#" id="close"><?=$user_config['close'] ?></a></li>
			</ul>
		</form>
	</div>
</div>


<?php 
// included files
include("footer.php");
?>