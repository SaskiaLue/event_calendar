<?php
// start the session
session_start();

// included files
include("modules/event_db.php");

//deleting the indicated user
delete_event($_GET['id']);

//back to calendar
header('Location: '.$_SESSION['phpcal_page']);
?>