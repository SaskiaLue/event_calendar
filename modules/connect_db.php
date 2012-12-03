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

$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $pass);

// test the database connection
function can_connect() {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	try {
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $pass);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return true;
		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}


// query without return value
function enterQuery($query) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	try {
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $pass);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->query($query);
		$dbh = null;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

// return an array with results
function returnQuery($query) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$value = array();
	try {
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $pass);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach ($dbh->query($query) as $row) {
			$value[] = $row;
		}
		$dbh = null;
		return $value;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}


// get all the possible values for the dropdowns
function getDropdownOptions($name, $table, $selected) {
	$html = "";
	global $host;
	global $username;
	global $pass;
	global $db_name;
	try {
		$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $pass);
		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		foreach ($dbh->query("SELECT id, ".$name." FROM ".$table) as $row) {
			$html .= sprintf("<option value='%s'%s>%s</option>\n", $row["id"], $row["id"] == $selected ? ' selected' : '', $row[$name]);
		}
		$dbh = null;
		return $html;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

?>