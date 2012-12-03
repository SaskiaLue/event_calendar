<?php
// start the session
session_start();

// included files
include("header.php");

?>

	<h1><?=$error_page['message']; ?></h1>
	<a href=<?=$_SESSION['phpcal_page']; ?>><?=$main['return_message']; ?></a>
	</div> <!--- content end !--->
	<?php // important to keep the footer at the bottom ?>
	<div class="push"></div>
</div> <!--- wrapper end !--->
</body>
</html>