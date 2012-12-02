<?php
// included files
include("user_db.php");

// start the session
session_start();

//deleting the indicated user
delete_user($_GET['id']);

//back to user management
header('Location:  ../user_config.php');
?>