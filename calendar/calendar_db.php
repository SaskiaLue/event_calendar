<?php
/* all database functions for the calendar
*
*	- method add_participant: updating the participants for a chosen event
*	- method delete_month: deletes all events for a month
*	- method create_month: add all active repeatable events to the new month
*	- method get_last_delete: get the date where the last creation/ delete took place
*	- method set_last_delete: save the actual date to the database
*/
// requires
include_once('connect_db.php');

// updating the participants for a chosen event
function add_participant($event_id) {
	$query = "UPDATE `events` SET participants = participants+1 WHERE id='".$event_id."'";
	enterQuery($query);
}

/**************************************************************
************************** month functions ********************
**************************************************************/
// delete remove all events for a given month from the database
function delete_month($last_day) {
	$query="DELETE FROM `events` WHERE date <= '".$last_day."' AND repeated = '0'";
	enterQuery($query);
}

// add all active repeatable events to the new month
function create_month($month,$year) {
	$query = "SELECT * FROM `events` WHERE repeated > '0'";
	if ($events = returnQuery($query)) {
		$last_day = date("Y-m-t", mktime(0, 0, 0, $month, 1, $year));
		foreach ($events as $event) {
			// get the new date depending on the repeat type
			$date = getNextDate($event['date'], $event['repeated'], date("Y-m-01", mktime(0, 0, 0, $month, 1, $year)));
			while ($date <= $last_day) {
				$duplicate_query= "select id from `events`
							where date = '".$date."' and
							title='".$event['title']."' and
							details='".$event['details']."' and
							start='".$event['start']."' and
							end='".$event['end']."' and
							participants='".$event['participants']."' and
							repeated='0' and
							title_english='".$event['title_english']."' and
							details_english='".$event['details_english']."'";
				$duplicates = returnQuery($duplicate_query);
				if (empty($duplicates)){
					// save new event
					$query = "insert into `events`
								(`event_type_id`,
								`date`,
								`title`,
								`details`,
								`start`,
								`end`,
								`participants`,
								`repeated`,
								`title_english`,
								`details_english`)
							values
								( '".$event['event_type_id']."',
								  '".$date."',
								  '".$event['title']."',
								  '".$event['details']."',
								  '".$event['start']."',
								  '".$event['end']."',
								  '".$event['participants']."',
								  '0',
								  '".$event['title_english']."',
								  '".$event['details_english']."'
							);";
					enterQuery($query);
				}
				// get the new date depending on the repeat type
				$date = getNextDate($date, $event['repeated']);
			}
		}
	} else die("Error creation of new month failed");
}

// get the date where the last creation/ delete took place
function get_last_delete() {
	$query = "SELECT lastdelete FROM `event_delete_month` order by id desc limit 1";
	$last_delete = returnQuery($query);
	return $last_delete[0]['lastdelete'];
}

// save the actual date to the database
function set_last_delete($date) {
echo "set";
	$query = "INSERT INTO `event_delete_month` (`lastdelete`) VALUES ('".$date."')
				ON DUPLICATE KEY UPDATE `lastdelete`='".$date."';";
	enterQuery($query);
}

?>