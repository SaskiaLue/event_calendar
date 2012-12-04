<?php

// helper functions

// start the session
// session_start();

// new: checks if the month is in the 6 months interval ( one month before the actual month or up to 4 months after )
function isAvailableMonth($m,$y) {
	$available = FALSE;
	$month = date("n",time());
	$year = date("Y",time());
	for ($i=-1;$i<=4;$i++) {
		$aMonth=$month+$i;
		$aYear=$year;
		if ($aMonth > 12) { $aMonth = $aMonth - 12 ; $aYear = $year + 1;}
		if ($aMonth < 1) { $aMonth = $aMonth + 12 ; $aYear = $year - 1;}
		if ( ( $m == $aMonth ) && ( $y == $aYear ) ) { $available = TRUE; }
	}
	return $available;
}

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
	$dir = 'languages'; 

//get the appropriate language file
	return "$dir/$lang.lng"; 
}

?>