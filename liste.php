<?php
include_once('modules/event_db.php');

// start the session
session_start();

include("header.php");

// check for valid month
if (isset($_GET['month']) && isset($_GET['year']) && isAvailableMonth($_GET['month'],$_GET['year']) ) {
	$month = $_GET['month'];
	$year = $_GET['year'];
	$events = get_events_per_month($month,$year);
?>
	<h1><?=$month_list['headline'].$calendar[$month]." ".$year; ?>
	<table id='month_table' border='4px'>
	<tr><th><?=$month_list['day']; ?></th><th><?=$month_list['time']; ?></th><th><?=$calendar['name']; ?></th><th><?=$calendar['details']; ?></th><th><?=$calendar['participants']; ?></th></tr>
	<?php
	foreach ($events as $event) {
		echo "<tr><td>".$event['date']."</td><td>".substr($event['start'],0,5)."-".substr($event['end'],0,5)."</td><td>".utf8_encode($event[$calendar['name_db']])."</td><td>".utf8_encode($event[$calendar['details_db']])."</td><td>".$event['participants']."</td></tr>";
	}
	?>
	</table>
<?php } else { ?>
	<h2><?=$main['date_error']; ?></h2>
	<a href=<?php echo $_SESSION['phpcal_page']; ?>><?php echo $main['return_message']; ?></a>
<?php } ?>
	</div> <!--- content end !--->
	<?php // important to keep the footer at the bottom ?>
	<div class="push"></div>
</div> <!--- wrapper end !--->
</body>
</html>
