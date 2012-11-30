<?php 
// included files
include_once("calendar/event_db.php");
include("header.php");

// start the session
session_start();

//this function will check user language and return the file name to be included .. 
$lang = check_lang();
include_once($lang); 
?>
<section id="calendar_wrapper">
	<h1><?php echo $footer['event config']; ?></h1>
	<table cellpadding="2" cellspacing="0" border="1">
	<tr><th><?php echo $month_list['day']; ?></th><th><?php echo $month_list['time']; ?></th><th><?php echo $calendar['name']; ?></th><th><?php echo $user_config['edit']; ?></th><th><?php echo $user_config['delete']; ?></th></tr>
	<?php 
		function sort_events($value_a,$value_b) {
			$x = $value_a['date'];
			$y = $value_b['date'];
			if ($x==$y) return 0;
			return ($x<$y)?-1:+1;
		}
		$events=array();
		$events=get_repeat_events();
		usort($events,'sort_events');
		foreach ($events as $event) {
			echo "<tr>";
			echo "<td>".$event['date']."</td>";
			echo "<td>".$event['start']."</td>";
			echo "<td>".utf8_encode($event['title'])."</td>";
			echo "<td><a href='calendar/event_formular.php?id=".$event['id']."'>".$user_config['edit']."</a></td>";
			echo "<td><a href='calendar/delete_event.php?id=".$event['id']."'>".$user_config['delete']."</a></td>";
			echo "</tr>";
		} 
	?>
</table>
	<a href=<?php echo $_SESSION['phpcal_page']; ?>><?php echo $main['return_message']; ?></a>
</section>
<?php include("footer.php"); ?>