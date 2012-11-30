<?php
/* handles all database queries
*	- method can_connect: test the database connection
*/
/*
 * show all errors
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
	$conn = mysql_connect($host, $username, $pass);
	if(!$conn){
		return FALSE;
	} else return TRUE;	
}


// query without return value
function enterQuery($query) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if (!$result = mysql_query($query)) die("Error beim updaten der Teilnehmer.");
			return true;
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
}

// return an array with results
function returnQuery($query) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$value = array();
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query($query)) {
					while ($row = mysql_fetch_assoc($result)) {
						$value[] = $row;
					}
					return $value;
			} else die("Error beim auslesen der verf&uuml;gbaren Events.");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
}


// get all the possible values for the dropdowns
function getDropdownOptions($name, $table, $selected) {
	$html = "";
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			if ($result = mysql_query("SELECT id, ".$name." FROM ".$table)) {
				while ($row = mysql_fetch_assoc($result)) {
					$html .= sprintf("<option value='%s'%s>%s</option>\n", $row["id"], $row["id"] == $selected ? ' selected' : '', $row[$name]);
				}
				return $html;
			} else die("Error");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
}

?>