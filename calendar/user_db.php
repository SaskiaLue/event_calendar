<?php
/* all database functions for users
*	- method insert_user: adding a new user
*	- method edit_user: updating user data
*	- method delete_user: deleting a user and his rights
*	- method get_user: get a specific user by id
*	- method get_users: returns all users
*	- method get_rights: get the rights of the current user
*	- method dologin: user login
*	- method dologout: user logout
*	- method autologin: login the user if he has an autologin cookie
*	- method login: check if the user entered correct data and login
*/
// requires
include_once('connect_db.php');

// adding a new user and his rights
function insert_user($values) {
	$query = "insert into `event_user`
				(`username`,
				`pwd`,
				`mail`)
			values
				( '".$values['user_name']."',
				'".$values['user_password']."',
				'".$values['user_mail']."'
				);";
	if (enterQuery($query)) {
		$user_id = mysql_insert_id();
		$rights_query = "insert into `event_user_rights`
					(`userid`,
					`user_right`)
				values
					( '".$user_id."',
					'events'
					);";
		if (!enterQuery($rights_query)) die("<pre>\n".$query."</pre>\n".mysql_error());
	} else die("<pre>\n".$query."</pre>\n".mysql_error());
}

// updating user data
function edit_user($values) {
	$query = "update `event_user` set
				username='".$values['user_name']."',
				pwd='".$values['user_password']."',
				mail='".$values['user_mail']."' where id=".$values['id'].";";
	enterQuery($query);
}

// deleting a user and his rights
function delete_user($user_id) {
	$query = "DELETE FROM `event_user` WHERE id = ".$user_id.";";
	enterQuery($query);
	// delete rights
	$query = "DELETE FROM `event_user_rights` WHERE userid = ".$user_id.";";
	enterQuery($query);
}

// get a specific user by id
function get_user($id) {
	$query="SELECT * FROM `event_user` WHERE id='".$id."';";
	$user = returnQuery($query);
	return $user[0];
}

function get_users() {	
	$query = "SELECT * FROM `event_user`";
	return returnQuery($query);
}

// get the rights of the current user
function getRights() {
	$rights = array();
	// get rights from the database and save them in an array
	if(isset($_SESSION['UserID'])){
		$query = "SELECT user_right FROM `event_user_rights` WHERE userid = '".$_SESSION['UserID']."'";
		$rights = returnQuery($query);
		return returnQuery($query);
	}
} 

// user login
function doLogin($ID, $Autologin=false) {
	// save the actual session
	$query = "UPDATE `event_user` SET
		sid = '".mysql_real_escape_string(session_id())."',
		autologin = NULL
		WHERE id = '".$ID."'";
	enterQuery($query);
	// if the user wants autologin, create a cookie with the relevant data
	if($Autologin){
		$part_one = substr(time()-rand(100, 100000),5,10);
		$part_two = substr(time()-rand(100, 100000),-5);
		$Login_ID = md5($part_one.$part_two);
		setcookie("Autologin", $Login_ID, time()+60*60*24*365*10);
		$query = "UPDATE `event_user` SET autologin = '".$Login_ID."' WHERE ID = '".$ID."'";
		enterQuery($query);
	}
	// save user data
	$query = "SELECT username FROM `event_user` WHERE id = '".$ID."'";
	$username = returnQuery($query);
	$_SESSION['UserID'] = $ID;
	$_SESSION['Nickname'] = $username[0]['username'];
	// save user rights
	foreach ( getRights() as $right ) {
		$_SESSION['phpcal_rights'][] = $right['user_right'];
	}
}

// user logout
function doLogout($id) {
	// remove cookie from database
	if(isset($_COOKIE['Autologin'])) setcookie("Autologin", "", time()-60*60);
	// remove session id from database
	 $query = "UPDATE `event_user` SET sid = NULL, autologin = NULL WHERE id = '".$id."'";
	enterQuery($query);
} 

// login the user if he has an autologin cookie
function autologin(){
	if(isset($_COOKIE['Autologin']) AND !isset($_SESSION['UserID'])){
		$query = "SELECT id FROM `event_user` WHERE autologin = '".mysql_real_escape_string($_COOKIE['Autologin'])."'";
		if (count($query_result = enterQuery($query))==1){
			doLogin($query_result['id'], '1');
		} 
	}
}

// try to login the user with the given values
function login($values) {
	// validate user data
	$query = "SELECT id FROM `event_user` WHERE username = '".mysql_real_escape_string(trim($values['username']))."' AND pwd = '".trim($values['password'])."'";
	// test if theres only one user with this data
	if (count($query_result = enterQuery($query))==1){
		doLogin($query_result, $values['autologin']); 
		return true;
	} else {
		return false;
	}
}

?>