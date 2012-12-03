<?php 
// included files
include_once("modules/event_db.php");
include("header.php");

// start the session
session_start(); 
?>
<section id="calendar_wrapper">
	<h1><?=$footer['event config']; ?></h1>
	<table cellpadding="2" cellspacing="0" border="1">
	<tr><th><?=$month_list['day']; ?></th><th><?=$month_list['time']; ?></th><th><?=$calendar['name']; ?></th><th><?=$user_config['edit']; ?></th><th><?=$user_config['delete']; ?></th></tr>
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
			echo "<td><a href='event_formular.php?id=".$event['id']."'>".$user_config['edit']."</a></td>";
			echo "<td><a href='delete_event.php?id=".$event['id']."'>".$user_config['delete']."</a></td>";
			echo "</tr>";
		} 
	?>
</table>
	<a href=<?=$_SESSION['phpcal_page']; ?>><?=$main['return_message']; ?></a>
</section>
<?php include("footer.php"); ?>