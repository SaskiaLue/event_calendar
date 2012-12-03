<?php
include_once('modules/event_db.php');

// start the session
session_start();

$year = $_GET['year'];
$month = $_GET['month'];

$events = get_events_per_month($month,$year);
include("header.php");
?>
	<h1><?=$month_list['headline'].$calendar[$_SESSION['phpcal_month']]." ".$_SESSION['phpcal_year']; ?>
	<table id='month_table' border='4px'>
	<tr><th><?=$month_list['day']; ?></th><th><?=$month_list['time']; ?></th><th><?=$calendar['name']; ?></th><th><?=$calendar['details']; ?></th><th><?=$calendar['participants']; ?></th></tr>
	<?php
	foreach ($events as $event) {
		echo "<tr><td>".$event['date']."</td><td>".substr($event['start'],0,5)."-".substr($event['end'],0,5)."</td><td>".utf8_encode($event[$calendar['name_db']])."</td><td>".utf8_encode($event[$calendar['details_db']])."</td><td>".$event['participants']."</td></tr>";
	}
	?>
	</table>
	</div> <!--- content end !--->
	<?php // important to keep the footer at the bottom ?>
	<div class="push"></div>
</div> <!--- wrapper end !--->
</body>
</html>
