<?php
include_once('event_db.php');

// start the session
session_start();

$year = $_GET['year'];
$month = $_GET['month'];

$events = get_events_per_month($month,$year);
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Calendar</title>
<meta name="DESCRIPTION" content="event calendar">
<meta name="KEYWORDS" content="event calendar">
<meta name="GENERATOR" content="">
<link href="../css/styles.css?template=av-067&colorScheme=green&header=headers1&button=buttons1" rel="stylesheet" type="text/css">
<link href="../css/css-reset.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="content">
	<?php 
	// get the correct language from the session
	function check_lang() {
		// check if a language is selected
		if (!isset($_SESSION['phpcal_lang'])) { 
		// if no language is selected set default language to english
			$lang = 'en'; 
		} else { 
			$lang = $_SESSION['phpcal_lang']; 
		} 

		//directory name 
		$dir = '../languages'; 

	//get the appropriate language file
		return "$dir/$lang.lng"; 
	}
	//this function will check user language and return the file name to be included .. 
	$lang = check_lang();
	include($lang); ?>
	<h1><?php echo $month_list['headline'].$calendar[$_SESSION['phpcal_month']]." ".$_SESSION['phpcal_year']; ?>
	<table id='month_table' border='4px'>
	<tr><th><?php echo $month_list['day']; ?></th><th><?php echo $month_list['time']; ?></th><th><?php echo $calendar['name']; ?></th><th><?php echo $calendar['details']; ?></th><th><?php echo $calendar['participants']; ?></th></tr>
	<?php
	foreach ($events as $event) {
		echo "<tr><td>".$event['date']."</td><td>".substr($event['start'],0,5)."-".substr($event['end'],0,5)."</td><td>".utf8_encode($event[$calendar['name_db']])."</td><td>".utf8_encode($event[$calendar['details_db']])."</td><td>".$event['participants']."</td></tr>";
	}
	?>
	</table>
</div>
</body>
</html>