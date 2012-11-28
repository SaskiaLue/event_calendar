<?php

// included files
include("calendar/mysql_connectdb.php");

date_default_timezone_set('Europe/Berlin');

// start the session
session_start();


/*
 * show all errors
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

//******************************************************************
//************* set session data and catch posts *******************
//******************************************************************

// set the current month and year
if (isset($_GET['m'])){
	$_SESSION['phpcal_month'] = $_GET['m'];
	$_SESSION['phpcal_year'] = $_GET['y'];
} else {
	if (empty($_SESSION['phpcal_month'])) { $_SESSION['phpcal_month'] =  date("n",time()); };
	if (empty($_SESSION['phpcal_year'])) { $_SESSION['phpcal_year']  =  date("Y",time()); };
}

//set current page
$_SESSION['phpcal_page'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
// see if a participant was added
if (isset($_POST['date']) && (!isset($_COOKIE[array_search('teilnehmen', $_POST)]))) {
	$teilnehmen_id=array_search('teilnehmen', $_POST);
	add_participant($teilnehmen_id);
	setCookie($teilnehmen_id , "participantCookie".$teilnehmen_id, mktime(0,0,0,date("m",$_POST['date']),date("d",$_POST['date']),date("Y",$_POST['date']))+86400);
}

// add the chosen event type to the session
if (isset($_POST['event_type'])) {
	$_SESSION['phpcal_event_type']= $_POST['event_type'];
}

include("header.php");

//this function will check user language and return the file name to be included .. 
$lang = check_lang();
include($lang); 
//******************************************************************
//**************************** content *****************************
//******************************************************************
?>
	<section id="calendar_wrapper">
		<?php
		if (can_connect()) {
			// on the first day of the month delete the old month and create the new one
			if ((date("d") == '26') && (date("Y-m-d") != get_last_delete())) {
				delete_month(date("Y-m-d", mktime(0, 0, 0, (date('m')-1), 0, date('Y'))));
				$newMonth = (($_SESSION['phpcal_month']+4)>12) ? $_SESSION['phpcal_month']-8 : $_SESSION['phpcal_month']+4;
				$newYear = (($_SESSION['phpcal_month']+4)>12) ? $_SESSION['phpcal_year']+1 : $_SESSION['phpcal_year'];
				create_month($newMonth,$newYear);
				// save the date so events won't be added twice
				set_last_delete(date("Y-m-d"));
			}
			// draw calendar
			if (isset($_GET['m'])){
				drawCalendar($_GET['m'],$_GET['y'], $calendar[$_GET['m']]);
			} else {
				drawCalendar($_SESSION['phpcal_month'],$_SESSION['phpcal_year'], $calendar[$_SESSION['phpcal_month']]);
			};
			?>
				
				<!--HTML for the tooltips-->
							
				<div id="mystickytooltip" class="stickytooltip">
					<div style="padding:5px">
					<?php 
					$sticky_events = get_events_per_month($_SESSION['phpcal_month'],$_SESSION['phpcal_year']);
					foreach($sticky_events as $sticky_event) {
						echo '<div id="sticky'.$sticky_event['id'].'" class="atip" style="max-width:600px">';
						echo "<ul id='sticky_list'>";
							echo "<li>".substr($sticky_event['start'],0,5)."-".substr($sticky_event['end'],0,5)."</li>";
							echo "<li>".$calendar['name'].": ".utf8_encode($sticky_event[$calendar['name_db']])."</li>";
							echo "<li>".$calendar['details'].": </li><li>".utf8_encode($sticky_event[$calendar['details_db']])."</li>";
							echo "<li>".$calendar['participants'].": ".$sticky_event[$calendar['participants_db']]."</li>";
							$today = date("Y-m-d H:i", time());
							$event_date = $sticky_event['date']." ".substr($sticky_event['start'],0,5);
							echo "<li>";
							if (($today < $event_date) && (!isset($_COOKIE[$sticky_event['id']])) ) {
								echo '<form name="'.$sticky_event['id'].'" action="'.$_SESSION['phpcal_page'].'" method="POST" onsubmit="javascript:location.reload();">';
								echo '<input type="hidden" name="date" value="'.strtotime($sticky_event['date']).'"/>';
								echo '<button type="submit" name="'.$sticky_event['id'].'" value="teilnehmen">'.$calendar['participate'].'</button>';
								echo "</form>";
							} elseif (isset($_COOKIE[$sticky_event['id']])) {
								echo $calendar['participate_message'];
							}
							echo "</li>";
							echo "<li>".$calendar['stickybox_message']."</li>";
					
							if ( isset($_SESSION['phpcal_rights']) && in_array('admin', $_SESSION['phpcal_rights']) ) {
								echo "<li>".'<a href="calendar/event_formular.php?id='.$sticky_event['id'].'" target="_blank">'.$calendar['edit_event'].'</a>';
								echo " | ";
								echo '<a href="calendar/delete_event.php?id='.$sticky_event['id'].'">'.$calendar['delete_event'].'</a>';
								echo "</li>";
							}
						echo "</ul>";
						echo "</div>";
					}
					
					?>
					
					</div>
				</div>
				
				<div class="stickystatus"></div>
		<?php  } else {  echo $calendar['db_message']; } ?>
	</section>
<?php
include("footer.php");
/*  ====================================================================
 *  Copyright (c) 2005 Astonish Inc.
 *  www.blazonry.com/scripting/datemenu_php.php
 *  All rights reserved.
 *
 *  Redistribution and use in source and binary forms, with or without
 *  modification, are permitted provided that the following conditions
 *  are met:
 *
 *  1. Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *  2. The name of the author may not be used to endorse or promote products
 *     derived from this software without specific prior written permission.
 *
 *  THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
 *  IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 *  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 *  IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
 *  INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 *  NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 *  DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 *  THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 *  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 *  THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *  ====================================================================
 */
//*********************************************************
// DRAW CALENDAR
//*********************************************************
/*
    Draws out a calendar (in html) of the month/year
    passed to it date passed in format mm-dd-yyyy 
*/
function drawCalendar($month, $year, $month_string) {

	//this function will check user language and return the file name to be included .. 
	$lang = check_lang();
	include($lang); 
	
    /*== get what weekday the first is on ==*/
    $tmpd = getdate(mktime(0,0,0,$month+1-1,1,$year+1-1));
    $month = $tmpd["month"]; 
    $firstwday= $tmpd["wday"];

    $lastday = date("t", mktime(0, 0, 0, $month+1-1, 0, $year));

?>
<div id="calendar">
	<table cellpadding="2" cellspacing="0" border="1" width="950" height="649">
		<tbody style="height:10%">
			<tr>
				<td colspan="7" class="months">
					<div id="last_month">
					<!-- get the previous month if it's in the six months interval !-->
					<?php $newMonth = (($_SESSION['phpcal_month']-1)<1) ? $_SESSION['phpcal_month']+11 : $_SESSION['phpcal_month']-1; 
					if (isAvailableMonth($newMonth)){
						echo '<a href="'.$_SERVER['PHP_SELF']."?m=".$newMonth."&y="; 
						if(($_SESSION['phpcal_month']-1)<1) {
							echo $_SESSION['phpcal_year']-1;
						} else echo $_SESSION['phpcal_year'];
						echo '">&lt;&lt;</a>'; 
					} else { echo "&nbsp;"; }?></div>
					<div id="month">
					<?php $cal_month = 'db_message';
					echo $month_string." ".$_SESSION['phpcal_year']; ?>
					</div>
					<div id="next_month">
					<!-- get the next month if it's in the six months interval !-->
					<?php $newMonth = (($_SESSION['phpcal_month']+1)>12) ? $_SESSION['phpcal_month']-11 : $_SESSION['phpcal_month']+1;
					if (isAvailableMonth($newMonth)){
						echo '<a href="'.$_SERVER['PHP_SELF']."?m=".$newMonth."&y=";
						if(($_SESSION['phpcal_month']+1)>12){
							echo $_SESSION['phpcal_year']+1; 
						} else echo $_SESSION['phpcal_year'];
						echo '">&gt;&gt;</a>'; 
					} else { echo "&nbsp;"; }?></div>
				</td>
			</tr>
			<tr>
				<td colspan="7" class="config">
					<!-- choose Event-Typen !-->
					<form class="event_type_formular" name="event_type_formular" action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
						<?php
						if (isset($_SESSION['phpcal_lang']) && ($_SESSION['phpcal_lang']=="en")) {
							echo "event-type: ";
							if (isset($_SESSION['phpcal_event_type'])) {
								echo '<select id="event_type" name="event_type" size="1"><option value="0"></option>'.get_english_types($_SESSION['phpcal_event_type']).'</select>';
							} else {
								echo '<select id="event_type" name="event_type" size="1"><option value="0"></option>'.get_english_types('0').'</select>';
							}
							echo '<input type="submit" value="change type">';
						} else {
							echo "Event-Typ: ";
							if (isset($_SESSION['phpcal_event_type'])) {
								echo '<select id="event_type" name="event_type" size="1"><option value="0"></option>'.get_types($_SESSION['phpcal_event_type']).'</select>';
							} else {
								echo '<select id="event_type" name="event_type" size="1"><option value="0"></option>'.get_types('0').'</select>';
							}
							echo '<input type="submit" value="Typ verändern">';
						}
						?>
					</form>
					<!-- choose language !-->
					<div id="lang"><a class="lang" href="calendar/language.php?lang=de">de</a>|<a class="lang" href="calendar/language.php?lang=en">en</a></div>
				</td>
			</tr>
			<tr style="font-size:1.2em">
				<?php for ($i = 0; $i<=6; $i++) {
					echo '<th class="tcell" width="14.3%">'.getDay($i).'</th>';
					}?>
			</tr>
		</tbody>
		<tbody style="text-align:right; height:90%; alink:#0000ff; link:#0000ff; vlink:#228B22">
		<?php $d = 1;
			$wday = $firstwday;
			$firstweek = ( $wday == 0 )? false : true;

			/*== loop through all the days of the month ==*/
			while ( $d <= $lastday) {

				/*== set up blank days for first week ==*/
				if ($firstweek) {
					$lastday_lastmonth = date("t",mktime(0, 0, 0, (date('m')), 0, date('Y')));
					echo "<tr height='80' valign='top'>";
					for ($i=$firstwday-1; $i>=0; $i--) {
						echo "<td class='other_month'>".($lastday_lastmonth - $i)."</td>";
					}
					$firstweek = false;
				}

				/*== Sunday start week with <tr> ==*/
				if ($wday==0) { echo "<tr height='90' valign='top'>"; }

				/*== check for event ==*/  
				$date = date("Y-m-d", mktime(0, 0, 0, $_SESSION['phpcal_month'], $d, $_SESSION['phpcal_year']));
				$today = date("Y-m-d", time());
				
				/*== change the class of today ==*/
				if ( $date == $today ) {
					echo "<td class='today'>";
				} else {
					echo "<td class='tcell'>";
				}
				echo '<a href="event_day.php?date='.$date.SID.'">'.$d."</a></br>";
				echo SID;
				/*== make new events and participate in events ==*/
				$events = get_events($date);
				if ( $date >= $today && isset($_SESSION['phpcal_rights']) && (in_array('events', $_SESSION['phpcal_rights']) || in_array('admin', $_SESSION['phpcal_rights']))) {
						/*== new events can only be created on dates in the future ==*/
						echo ' (<a href="calendar/event_formular.php?date='.$date.'" target="_blank">'.$calendar['create_event'].'</a>)'."</br>";
				}
				foreach ($events as $event) {
					if (!isset($_SESSION['phpcal_event_type']) || ($_SESSION['phpcal_event_type']==$event['event_type_id']) || ($_SESSION['phpcal_event_type']=='0')) {
						if (isset($_SESSION['phpcal_lang']) && ($_SESSION['phpcal_lang']=="en")) {
							echo "<div style='background-color:#".get_color($event['event_type_id'])." !important' data-tooltip='sticky".$event['id']."'>".substr($event['start'],0,5)." ".utf8_encode($event['title_english'])."</div>";
						} else {
							echo "<div style='background-color:#".get_color($event['event_type_id'])." !important' data-tooltip='sticky".$event['id']."'>".substr($event['start'],0,5)." ".utf8_encode($event['title'])."</div>";
						}
					}
				}
				echo "</td>\n";

				/*== Saturday end week with </tr> ==*/
				if ($wday==6) { echo "</tr>\n"; }

				$wday++;
				$wday = $wday % 7;
				if (($d == $lastday) && ($wday != 0)) {
					$j = 1;
					for ($i=$wday; $i<=6; $i++) {
						echo "<td class='other_month'>".$j."</td>";
						$j++;
					}
				}
				$d++;
			}
		?>
		</tbody>
		</tr>
	</table>
</div>

<?php
/*== end drawCalendar function ==*/
} 

// new: checks if the month is available
function isAvailableMonth($m) {
	$month = date("n",time());
	$availableMonths = array();
	for ($i=-1;$i<=4;$i++) {
		$aMonth=$month+$i;
		if ($aMonth > 12) { $aMonth = $aMonth-12 ;}
		if ($aMonth < 1) { $aMonth = $aMonth+12 ;}
		$availableMonths[]=$aMonth;
	}
	return (in_array($m, $availableMonths));
}

// new: returns the weekday
function getDay($d) {
	//this function will check user language and return the file name to be included .. 
	$lang = check_lang();
	include($lang); 
	return $calendar['day_'.$d];
}

?>