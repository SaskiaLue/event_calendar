<?php
include_once("modules/calendar_db.php");

// start the session
session_start();
		
// increment the participants for the event
if (isset($_POST['date']) && (!isset($_COOKIE[array_search('participate', $_POST)]))) {
	$participate_id=array_search('participate', $_POST);
	add_participant($participate_id);
	setCookie($participate_id , "participantCookie".$participate_id, mktime(0,0,0,date("m",$_POST['date']),date("d",$_POST['date']),date("Y",$_POST['date']))+86400);
}

header("Location: ".$_SESSION['phpcal_page']);
exit;
?>