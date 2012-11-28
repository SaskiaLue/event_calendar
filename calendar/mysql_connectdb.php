<?php
/*
library for all queries
	- method can_connect: test the database connection
	- method get_types: function to fill the german type dropdown
	- method get_english_types: function to fill the english type dropdown
	- method get_color: every event-type has a different color, that is used in the calendar
	- method get_repeat: function to fill the repeat dropdown
	- method add_participant: updating the participants for a chosen event
	- method insert_user: adding a new user
	- method edit_user: updating user data
	- method delete_user: deleting a user and his rights
	- method get_user: get a specific user by id
	- method get_users: returns all users
	- method get_rights: get the rights of the current user
	- method dologin: user login
	- method dologout: user logout
	- method autologin: login the user if he has an autologin cookie
	- method login: check if the user entered correct data and login
	- method get_event: get the specific event for the given id
	- method get_repeat_events: returns the repeated events
	- method get_events: get all events for a given date
	- method get_events_per_month:  get all events for a given month
	- method insert_event: add a new event
	- method edit_event: manage an existing event
	- method delete_event: delete an event and his future events
	- method delete_month: deletes all events for a month
	- method create_month: add all active repeatable events to the new month
	- method get_last_delete: get the date where the last creation/ delete took place
	- method set_last_delete: save the actual date to the database
*/
/*
 * Daf&uuml;r sorgen, dass unabh&auml;ngig von den aktuellen PHP-Einstellungen
 * alle auftretenden Error angezeigt werden
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

$host = "localhost";
$username = "root";
$pass = "";
$db_name = "db372066379";

// test the database connection
function can_connect() {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn=mysql_connect($host, $username, $pass);
	if(!$conn){
		return FALSE;
	}
	mysql_close($conn);
	return TRUE;	
}

// get the event types for the dropdown
function get_types($actual_type) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$types = "";
	$conn = mysql_connect($host, $username, $pass);
	if ($conn)
	{
		if (mysql_select_db($db_name, $conn))
		{
			if ($result = mysql_query("SELECT id, name FROM $db_name.`event_types`"))
			{
				while ($row = mysql_fetch_assoc($result))
				{
					if (($actual_type != 0) && ($row["id"]==$actual_type)) {
						$types .= "<option value='".$row["id"]."' selected>".$row["name"]."</option>";
					} else {
						$types .= "<option value='".$row["id"]."'>".$row["name"]."</option>";
					}
				}
				return $types;
			} else die("Error beim auslesen der Event-Typen.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

function get_english_types($actual_type)
{
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$types = "";
	$conn = mysql_connect($host, $username, $pass);
	if ($conn)
	{
		if (mysql_select_db($db_name, $conn))
		{
			if ($result = mysql_query("SELECT id, name_english FROM $db_name.`event_types`"))
			{
				while ($row = mysql_fetch_assoc($result))
				{
					if (($actual_type != 0) && ($row["id"]==$actual_type)) {
						$types .= "<option value='".$row["id"]."' selected>".$row["name_english"]."</option>";
					} else {
						$types .= "<option value='".$row["id"]."'>".$row["name_english"]."</option>";
					}
				}
				return $types;
			} else die("Error beim auslesen der Event-Typen.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get the correct color for the event type
function get_color($type_id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("select color_code from $db_name.`event_types` where id=$type_id")) {
				$color = mysql_fetch_assoc($result);
				return  $color['color_code'];
			} else die("Error beim auslesen der Farbe.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get the possible repeat types
function get_repeat($repeat_id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$repeat = "";
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT id, name_eng FROM $db_name.`event_repeat`")) {
				while ($row = mysql_fetch_assoc($result)) {
					if (($repeat_id != 0) && ($row["id"]==$repeat_id)) {
						$repeat .= "<option value='".$repeat_id."' selected>".$row["name_eng"]."</option>";
					} else {
						$repeat .= "<option value='".$row["id"]."'>".$row["name_eng"]."</option>";
					}
					echo $row["id"];
				}
				return $repeat;
			} else die("Error beim auslesen der Wiederholungsm&ouml;glichkeiten.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// updating the participants for a chosen event
function add_participant($event_id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query = "UPDATE $db_name.`events` SET participants = participants+1 WHERE id='".$event_id."'";
			if (!$result = mysql_query($query)) die("Error beim updaten der Teilnehmer.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// adding a new user and his rights
function insert_user($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query = "insert into $db_name.`event_user`
						(`username`,
						`pwd`,
						`mail`)
					values
						( '".$values['user_name']."',
						'".$values['user_password']."',
						'".$values['user_mail']."'
						);";
			if (mysql_query($query)) {
				$query = "SELECT id FROM `event_user` WHERE username = '".$values['user_name']."'";
			    $result = mysql_query($query) OR die("<pre>\n".$query."</pre>\n".mysql_error());
				$row = mysql_fetch_assoc($result);
				$rights_query = "insert into $db_name.`event_user_rights`
							(`userid`,
							`user_right`)
						values
							( '".$row['id']."',
							'events'
							);";
				if (!mysql_query($rights_query)) die("<pre>\n".$query."</pre>\n".mysql_error());
			} else die("<pre>\n".$query."</pre>\n".mysql_error());
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// updating user data
function edit_user($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query = "update $db_name.`event_user` set
						username='".$values['user_name']."',
						pwd='".$values['user_password']."',
						mail='".$values['user_mail']."' where id=".$values['id'].";";
			if (!mysql_query($query)) die("Error beim Bearbeiten des Users");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// deleting a user and his rights
function delete_user($user_id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query = "DELETE FROM $db_name.`event_user` WHERE id = ".$user_id.";";
			if (mysql_query($query)) {
				$query = "DELETE FROM $db_name.`event_user_rights` WHERE userid = ".$user_id.";";
				if (!mysql_query($query)) die("Error beim L&ouml;schen der Rechte");
			} else die("Error beim L&ouml;schen des Users");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get a specific user by id
function get_user($id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$repeat = "";
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query="SELECT * FROM $db_name.`event_user` WHERE id='".$id."';";
			if ($result = mysql_query($query)) {
				$user_values=array();
				while ($row = mysql_fetch_assoc($result)) {
					$user_values=$row;
				}
				return $user_values;
			} else die("Error beim auslesen der Wiederholungsm&ouml;glichkeiten.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

function get_users() {	
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn)
	{
		if (mysql_select_db($db_name, $conn))
		{
			$users = array();
			// .. indem die Rechte eines User aus der Datenbank ausgew&auml;hlt werden..
			$query = "SELECT * FROM $db_name.`event_user`";
			$result = mysql_query($query) OR die ("<pre>\n".$query."</pre>\n".mysql_error());
			// .. und als array zur&uuml;ckgegeben werden
			while($row = mysql_fetch_assoc($result))
			$users[] = $row;
			return $users;
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get the rights of the current user
function getRights() {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$rights = array();
			// get rights from the database and save them in an array
			if(isset($_SESSION['UserID'])){
				$query = "SELECT user_right FROM $db_name.`event_user_rights` WHERE userid = '".$_SESSION['UserID']."'";
				$result = mysql_query($query) OR die ("<pre>\n".$query."</pre>\n".mysql_error());
				$rights = array();
				while($row = mysql_fetch_assoc($result)) $rights[] = $row['user_right'];
			}
			return $rights;
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
} 

// user login
function doLogin($ID, $Autologin=false) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			// save the actual session
			$query = "UPDATE $db_name.`event_user` SET
				sid = '".mysql_real_escape_string(session_id())."',
				autologin = NULL
				WHERE id = '".$ID."'";
			mysql_query($query) OR die("<pre>\n".$query."</pre>\n".mysql_error());
			// if the user wants autologin, create a cookie with the relevant data
			if($Autologin){
				$part_one = substr(time()-rand(100, 100000),5,10);
				$part_two = substr(time()-rand(100, 100000),-5);
				$Login_ID = md5($part_one.$part_two);
				setcookie("Autologin", $Login_ID, time()+60*60*24*365*10);
				$query = "UPDATE $db_name.`event_user` SET autologin = '".$Login_ID."' WHERE ID = '".$ID."'";
			    mysql_query($query) OR die("<pre>\n".$query."</pre>\n".mysql_error());
			}
			// save user data
			$query = "SELECT username FROM $db_name.`event_user` WHERE id = '".$ID."'";
		    $result = mysql_query($query) OR die("<pre>\n".$query."</pre>\n".mysql_error());
			$row = mysql_fetch_assoc($result);
		    $_SESSION['UserID'] = $ID;
		    $_SESSION['Nickname'] = $row['username'];
	        // save user rights
	        $_SESSION['phpcal_rights'] = getRights(); 
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// user logout
function doLogout($id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			// remove cookie from database
			if(isset($_COOKIE['Autologin'])) setcookie("Autologin", "", time()-60*60);
			// remove session id from database
			 $sql = "UPDATE $db_name.`event_user` SET sid = NULL, autologin = NULL WHERE id = '".$id."'";
			 mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
} 

// login the user if he has an autologin cookie
function autologin(){
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
		    if(isset($_COOKIE['Autologin']) AND !isset($_SESSION['UserID'])){
		        $sql = "SELECT id FROM $db_name.`event_user` WHERE autologin = '".mysql_real_escape_string($_COOKIE['Autologin'])."'";
		        $result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
		        $row = mysql_fetch_assoc($result);
		        if(mysql_num_rows($result) == 1) {
		            doLogin($row['id'], '1');
		    	} 
		    }
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// try to login the user with the given values
function login($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
	        // Falls der Nickname und das Passwort &uuml;bereinstimmen..
	        $query = "SELECT id FROM $db_name.`event_user` WHERE username = '".mysql_real_escape_string(trim($values['username']))."' AND pwd = '".trim($values['password'])."'";
	        $result = mysql_query($query) OR die("<pre>\n".$query."</pre>\n".mysql_error());
	        // wird die ID des Users geholt und der User damit eingeloggt
	        $row = mysql_fetch_assoc($result);
	        // Pr&uuml;ft, ob wirklich genau ein Datensatz gefunden wurde
	        if (mysql_num_rows($result)==1){
	        	doLogin($row['id'], $values['autologin']); 
	        	return true;
	        } else {
	        	return false;
	        }
		}
	}
}

// get the specific event for the given id
function get_event($id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT * FROM $db_name.`events` WHERE id='".$id."'")) {
				while ($row = mysql_fetch_assoc($result)) {
					$event = $row;
				}
				return $event;
			} else die("Error beim auslesen der verf&uuml;gbaren Events.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get all repeatable events
function get_repeat_events() {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$events = array();
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT * FROM $db_name.`events` WHERE repeated > '0' ORDER BY date")) {
				while ($row = mysql_fetch_assoc($result)) {
					$events[] = $row;
				}
				return $events;
			} else die("Error beim auslesen der wiederholbaren Events.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get all events for a given date
function get_events($date) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$events = array();
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT * FROM $db_name.`events` WHERE date='".$date."' AND repeated = '0' ORDER BY start")) {
				while ($row = mysql_fetch_assoc($result)) {
					$events[] = $row;
				}
				return $events;
			} else die("Error beim auslesen der verf&uuml;gbaren Events.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// get all events for a given month
function get_events_per_month($month,$year) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$events = array();
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT * FROM $db_name.`events` WHERE date like '".$year."-%".$month."-%%' AND repeated = '0' ORDER BY start")) {
				while ($row = mysql_fetch_assoc($result)) {
					$events[] = $row;
				}
				return $events;
			} else die("Error beim auslesen der verf&uuml;gbaren Events.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// try to insert the given event values
function insert_event($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		// save event data
		if (mysql_select_db($db_name, $conn)) {
			$query = "insert into $db_name.`events`
						(`event_type_id`,
						`date`,
						`title`,
						`details`,
						`start`,
						`end`,
						`participants`,
						`repeated`,
						`title_english`,
						`details_english`)
					values
						( '".$values['event_type']."',
						'".$values['event_date']."',
						'".$values['event']."',
						'".$values['event_details']."',
						'".$values['event_start']."',
						'".$values['event_end']."',
						'".$values['event_participants']."',
						'".$values['event_repeated']."',
						'".$values['event_eng']."',
						'".$values['event_details_eng']."'
						);";
			if (mysql_query($query)) {
				echo "Das Event wurde gespeichert";
			} else die("Error couldn't save events");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
	// if it's a repeatable event create all future events
	if ($values['event_repeated'] != "") {
		$date = $values['event_date'];
		$month = date("n",time());
		$year = date("Y",time());
		if (($month+4)>12) {
			$month -=  8;
			$year += 1;
		} else {
			$month += 4;
		}
		$last_day = date("Y-m-t",  mktime(0, 0, 0, $month, 1, $year));
		while ($date <= $last_day) {
        	// create event array
        	$save_event=array();
			$save_event['event_type'] = $values['event_type'];
			$save_event['event_date'] = $date;  
			$save_event['event'] = $values['event'];  
			$save_event['event_details'] = $values['event_details']; 
			$save_event['event_start'] = $values['event_start']; 
			$save_event['event_end'] = $values['event_end']; 
			$save_event['event_participants'] = $values['event_participants'];
			$save_event['event_repeated'] = 0; 
			$save_event['event_eng'] = $values['event_eng']; 
			$save_event['event_details_eng'] = $values['event_details_eng'];
			insert_event($save_event);
			
			// calculate new event date
			switch ($values['event_repeated']) {
			    case 1:
					$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
			        break;
			    case 2:
			        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
			        break;
			    case 3:
			        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
			        break;
			}
        }
	}
}

// update event data
function edit_event($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$event = get_event($values['id']);
			$new_repeated = ($event['repeated'] == $values['event_repeated'])?0:1;
			$query = "update $db_name.`events` set
						`event_type_id`='".$values['event_type']."',
						`date`='".$values['event_date']."',
						`title`='".$values['event']."',
						`details`='".$values['event_details']."',
						`start`='".$values['event_start']."',
						`end`='".$values['event_end']."',
						`participants`='".$values['event_participants']."',
						`repeated`='".$values['event_repeated']."',
						`title_english`='".$values['event_eng']."',
						`details_english`='".$values['event_details_eng']."' where id=".$values['id'].";";
			if (mysql_query($query)) {
				echo "Das Event wurde ge&auml;ndert";
			} else die("Error couldn't save events");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
	// if it's a repetable event
	if ($values['event_repeated'] != "") {
		if ($new_repeated == 0) {
			$conn = mysql_connect($host, $username, $pass);
			if ($conn) {
				if (mysql_select_db($db_name, $conn)) {
					// update all future events that are connected to it
					$query = "update $db_name.`events` set
								`event_type_id`='".$values['event_type']."',
								`title`='".$values['event']."',
								`details`='".$values['event_details']."',
								`start`='".$values['event_start']."',
								`end`='".$values['event_end']."',
								`participants`='".$values['event_participants']."',
								`repeated`='',
								`title_english`='".$values['event_eng']."',
								`details_english`='".$values['event_details_eng']."' 
								where 
								`event_type_id`='".$event['event_type_id']."' AND
								`title`='".$event['title']."' AND
								`details`='".$event['details']."' AND
								`start`='".$event['start']."' AND
								`end`='".$event['end']."' AND
								`repeated`='0' AND
								`participants`='".$event['participants']."' AND
								`title_english`='".$event['title_english']."' AND
								`details_english`='".$event['details_english']."' AND
								`date` > '".date('Y-m-d', strtotime('today'))."';";
								// `date` > ".date('Y-m-d', strtotime('today')).";";
					if (mysql_query($query)) {
						echo "Changed events";
					} else die("Error couldn't save events");
				} else die("Error : Couldn't find database.");
			} else die("Error : No database connection.");
			mysql_close($conn);
		
		// if there is a new repeat type
		} else {
			// remove all future events of the old repeat type
			$conn = mysql_connect($host, $username, $pass);
			if ($conn) {
				if (mysql_select_db($db_name, $conn)) {
					$query = "DELETE FROM $db_name.`events` where
								`event_type_id`='".$event['event_type_id']."' AND
								`title`='".$event['title']."' AND
								`details`='".$event['details']."' AND
								`start`='".$event['start']."' AND
								`end`='".$event['end']."' AND
								`repeated`='0' AND
								`participants`='".$event['participants']."' AND
								`title_english`='".$event['title_english']."' AND
								`details_english`='".$event['details_english']."' AND
								`date` > '".date('Y-m-d', strtotime('today'))."';";
							echo $query;
					if (!mysql_query($query)) die("Error: Can't delete event");
				} else die("Error : Couldn't find database.");
			} else die("Error : No database connection.");
			mysql_close($conn);
			// add future events of the new repeat type
			$date = $values['event_date'];
			$month = date("n",time());
			$year = date("Y",time());
			if (($month+4)>12) {
				$month -=  8;
				$year += 1;
			} else {
				$month += 4;
			}
			$last_day = date("Y-m-t",  mktime(0, 0, 0, $month, 1, $year));
			while ($date <= $last_day) {
				// get the values for the database
				$save_event=array();
				$save_event['event_type'] = $values['event_type'];
				$save_event['event_date'] = $date;  
				$save_event['event'] = $values['event'];  
				$save_event['event_details'] = $values['event_details']; 
				$save_event['event_start'] = $values['event_start']; 
				$save_event['event_end'] = $values['event_end']; 
				$save_event['event_participants'] = $values['event_participants'];
				$save_event['event_repeated'] = 0; 
				$save_event['event_eng'] = $values['event_eng']; 
				$save_event['event_details_eng'] = $values['event_details_eng'];
				insert_event($save_event);
				
				// calculate new event date
				switch ($values['event_repeated']) {
					case 1:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
						break;
					case 2:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
						break;
					case 3:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
						break;
				}
			}
		}
	}
}

// remove an event
function delete_event($event_id) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$event = get_event($event_id);
			// delete the specified event
			$query = "DELETE FROM $db_name.`events`
						WHERE id = ".$event_id.";";
			if (!mysql_query($query)) die("Error: Can't delete event");
			if ($event['repeated'] != '') {
				$query = "DELETE from $db_name.`events` where
						`event_type_id`='".$event['event_type_id']."' AND
						`title`='".$event['title']."' AND
						`details`='".$event['details']."' AND
						`start`='".$event['start']."' AND
						`end`='".$event['end']."' AND
						`participants`='".$event['participants']."' AND
						`title_english`='".$event['title_english']."' AND
						`details_english`='".$event['details_english']."' AND
						'date' >= '".date('Y-m-d' AND strtotime('today'))."';";
						echo $query;
				if (!mysql_query($query)) die("Error: Can't delete event");
			}
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// delete remove all events for a given month from the database
function delete_month($last_day) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$query="DELETE FROM $db_name.`events` WHERE date <= '".$last_day."' AND repeated = '0'";
			if (!mysql_query($query)) die("Error: Delete failed");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
}

// add all active repeatable events to the new month
function create_month($month,$year) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$events = array();
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT * FROM $db_name.`events` WHERE repeated > '0'")) {
				while ($row = mysql_fetch_assoc($result)) {
					$events[] = $row;
				}
				$last_day = date("Y-m-t", mktime(0, 0, 0, $month, 1, $year));
				foreach ($events as $event) {
					// get the new date depending on the repeat type
					$date = $event['date'];
					switch ($event['repeated']) {
					    case 1:
							$date = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
							break;
					    case 2:
					    	$weekday=date("N",strtotime($date));
					    	$date=mktime(0, 0, 0, $month, 1, $year);
					    	$actualday=date("N",$date);
					    	while ($actualday != $weekday) {
					    		$date = mktime(0, 0, 0, $month, date("d",$date)+1, $year);
					    		$actualday=date("N",$date);
					    	}
					    	$date = date("Y-m-d", $date);
					        break;
					    case 3:
					        $date = date("Y-m-d", mktime(0, 0, 0, $month , date("d",strtotime($date)), $year));
					        break;
					}
					while ($date <= $last_day) {
						$duplicate_query= "select id from $db_name.`events`
									where date = '".$date."' and
									title='".$event['title']."' and
									details='".$event['details']."' and
									start='".$event['start']."' and
									end='".$event['end']."' and
									participants='".$event['participants']."' and
									repeated='0' and
									title_english='".$event['title_english']."' and
									details_english='".$event['details_english']."'";
						if (!($duplicates=mysql_query($duplicate_query))) die("Error while trying to find duplicate values");
						if(!(mysql_num_rows( $duplicates )>0)) {
							// speichern
							$query = "insert into $db_name.`events`
										(`event_type_id`,
										`date`,
										`title`,
										`details`,
										`start`,
										`end`,
										`participants`,
										`repeated`,
										`title_english`,
										`details_english`)
									values
										( '".$event['event_type_id']."',
										  '".$date."',
										  '".$event['title']."',
										  '".$event['details']."',
										  '".$event['start']."',
										  '".$event['end']."',
										  '".$event['participants']."',
										  '0',
										  '".$event['title_english']."',
										  '".$event['details_english']."'
									);";
							if (!mysql_query($query)) die("Error: Couldn't create new month");
						}
						// calculate new date
						switch ($event['repeated']) {
						    case 1:
								$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
						        break;
						    case 2:
						        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
						        break;
						    case 3:
						        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
						        break;
						}
			        }
				}
			} else die("Error creation of new month failed");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);	
}

// get the date where the last creation/ delete took place
function get_last_delete() {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	$date = '';
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT lastdelete FROM $db_name.`event_delete_month` where id=1")) {
				while ($row = mysql_fetch_assoc($result)) {
					$date = $row["lastdelete"];
				}
				return $date;
			} else die("Error couldn't get last delete date.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
	
}

// save the actual date to the database
function set_last_delete($date) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn))
		{
			$query = "update $db_name.`event_delete_month` set `lastdelete`='".$date."';";
			if (mysql_query($query)) {
				if (mysql_affected_rows()==0) {
					$query = "insert into $db_name.`event_delete_month` (`lastdelete`) values ('".$date."');";
					if(!mysql_query($query)) die("<pre>\n".$query."</pre>\n".mysql_error());
				}
			} else die("<pre>\n".$query."</pre>\n".mysql_error());
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);	
}

?>