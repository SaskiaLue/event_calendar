<?php include("header.php"); ?>
	<section id="calendar_wrapper">
		<?php 
		
		// start the session
		session_start();

		date_default_timezone_set('Europe/Berlin');
		// included files
		include_once("modules/event_db.php");
		// get date
		$date = $_GET['date'];
		echo "<h1>".$date."</h1>";
		$events=get_events($date);
		if ($events) {
			echo "<table class='content_table'>";
			for ($i=0;$i<24;++$i) {
				echo "<tr>";
				
				echo "<td class='day_event_time'>".date("H:i",mktime($i,"0","0"))."</td>";
				echo "<td>";
				$found = false;
				foreach ($events as $event) {
					if (substr($event['start'],0,2) == $i) {
						echo "<div class='day_event' style='background-color:#".get_color($event['event_type_id'])."'>";
						echo substr($event['start'],0,5)."-".substr($event['end'],0,5)."</br>";
						echo $calendar['name'].": ".utf8_encode($event[$calendar['name_db']])."</br>";
						echo $calendar['details'].": ".utf8_encode($event[$calendar['details_db']])."</br>";
						echo $calendar['participants'].": ".$event[$calendar['participants_db']];
						echo "</div>";
						$found = true;
					}
				}
				if (!$found) {
						echo "&nbsp;";
					}
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "<h2>".$day['no_events']."</h2>";
		}
		?>
		<p>
		<a href=<?=$_SESSION['phpcal_page']; ?>><?=$main['return_message']; ?></a>
		</p>
	</section>
<?php include("footer.php"); ?>