<html>
<head>
<!-- einbinden von jQuey -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/stickytooltip.js">

/***********************************************
* Sticky Tooltip script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Calendar</title>
<meta name="DESCRIPTION" content="event calendar">
<meta name="KEYWORDS" content="event calendar">
<meta name="GENERATOR" content="">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/stickytooltip.css" rel="stylesheet" type="text/css" />
<link href="css/css-reset.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
include('common.php');
//this function will check user language and return the file name to be included .. 
$lang = check_lang();
include($lang); 
?>
<?php // important to keep the footer on the bottom of the page ?>
<div class="wrapper">
	<header>
		<div id="logo">
			<h1>
				<?php echo $main['calendar'] ?>
			</h1>
			<h3 class="slogan">
				
			</h3>
		</div>
	</header>
	<div id="content">