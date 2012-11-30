<?php
/* all database functions for events
*	- method get_event: get the specific event for the given id
*	- method get_repeat_events: returns the repeated events
*	- method get_events: get all events for a given date
*	- method get_events_per_month:  get all events for a given month
*	- method get_types: function to fill the german type dropdown
*	- method get_english_types: function to fill the english type dropdown
*	- method get_color: every event-type has a different color, that is used in the calendar
*	- method get_repeat: function to fill the repeat dropdown
*	- method insert_event: add a new event
*	- method edit_event: manage an existing event
*	- method delete_event: delete an event and his future events
*/
// requires
include_once('connect_db.php');

/****************************************************
*************** get functions ***********************
****************************************************/

// get the specific event for the given id
function get_event($id) {
	$query = "SELECT * FROM `events` WHERE id='".$id."'";
	$event = returnQuery($query);
	return $event[0];
}

// get all repeatable events
function get_repeat_events() {
	$query = "SELECT * FROM `events` WHERE repeated > '0' ORDER BY date";
	return returnQuery($query);
}

// get all events for a given date
function get_events($date) {
	$query = "SELECT * FROM `events` WHERE date='".$date."' AND repeated = '0' ORDER BY start";
	return returnQuery($query);
}

// get all events for a given month
function get_events_per_month($month,$year) {
	$query = "SELECT * FROM `events` WHERE date like '".$year."-%".$month."-%%' AND repeated = '0' ORDER BY start";
	return returnQuery($query);
}

// get the correct color for the event type
function get_color($type_id) {
	$query = "select color_code from `event_types` where id=$type_id";
	$color_code = returnQuery($query);
	return $color_code[0]['color_code'];
}

// get the event types for the dropdown
function get_types($actual_type) {
	return getDropdownOptions('name', 'event_types', $actual_type);
}

function get_english_types($actual_type) {
	return getDropdownOptions('name_english', 'event_types', $actual_type);
}

// get the possible repeat types
function get_repeat($repeat_id) {
	return getDropdownOptions('name_eng', 'event_repeat', $repeat_id);
}

/****************************************************************************************
*************************** change and add events ***************************************
****************************************************************************************/
// try to insert the given event values
function insert_event($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		// save event data
		if (mysql_select_db($db_name, $conn)) {
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
						( '".$values['event_type']."',
						'".$values['event_date']."',
						'".$values['event']."',
						'".$values['event_details']."',
						'".$values['event_start']."',
						'".$values['event_end']."',
						'".$values['event_participants']."',
						'".$values['event_repeated']."',
						'".$values['event_eng']."',
						'".$values['event_details_eng']."'
						);";
			if (mysql_query($query)) {
				echo "Das Event wurde gespeichert";
			} else die("Error couldn't save events");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
	// if it's a repeatable event create all future events
	if ($values['event_repeated'] != "") {
		$date = $values['event_date'];
		$month = date("n",time());
		$year = date("Y",time());
		if (($month+4)>12) {
			$month -=  8;
			$year += 1;
		} else {
			$month += 4;
		}
		$last_day = date("Y-m-t",  mktime(0, 0, 0, $month, 1, $year));
		while ($date <= $last_day) {
        	// create event array
        	$save_event=array();
			$save_event['event_type'] = $values['event_type'];
			$save_event['event_date'] = $date;  
			$save_event['event'] = $values['event'];  
			$save_event['event_details'] = $values['event_details']; 
			$save_event['event_start'] = $values['event_start']; 
			$save_event['event_end'] = $values['event_end']; 
			$save_event['event_participants'] = $values['event_participants'];
			$save_event['event_repeated'] = 0; 
			$save_event['event_eng'] = $values['event_eng']; 
			$save_event['event_details_eng'] = $values['event_details_eng'];
			insert_event($save_event);
			
			// calculate new event date
			switch ($values['event_repeated']) {
			    case 1:
					$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
			        break;
			    case 2:
			        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
			        break;
			    case 3:
			        $date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
			        break;
			}
        }
	}
}

// update event data
function edit_event($values) {
	global $host;
	global $username;
	global $pass;
	global $db_name;
	$conn = mysql_connect($host, $username, $pass);
	if ($conn) {
		if (mysql_select_db($db_name, $conn)) {
			$event = get_event($values['id']);
			$new_repeated = ($event['repeated'] == $values['event_repeated'])?0:1;
			$query = "update `events` set
						`event_type_id`='".$values['event_type']."',
						`date`='".$values['event_date']."',
						`title`='".$values['event']."',
						`details`='".$values['event_details']."',
						`start`='".$values['event_start']."',
						`end`='".$values['event_end']."',
						`participants`='".$values['event_participants']."',
						`repeated`='".$values['event_repeated']."',
						`title_english`='".$values['event_eng']."',
						`details_english`='".$values['event_details_eng']."' where id=".$values['id'].";";
			if (mysql_query($query)) {
				echo "Das Event wurde ge&auml;ndert";
			} else die("Error couldn't save events");
		} else die("Error : Couldn't find database.");
	} else die("Error : No database connection.");
	mysql_close($conn);
	// if it's a repetable event
	if ($values['event_repeated'] != "") {
		if ($new_repeated == 0) {
			$conn = mysql_connect($host, $username, $pass);
			if ($conn) {
				if (mysql_select_db($db_name, $conn)) {
					// update all future events that are connected to it
					$query = "update `events` set
								`event_type_id`='".$values['event_type']."',
								`title`='".$values['event']."',
								`details`='".$values['event_details']."',
								`start`='".$values['event_start']."',
								`end`='".$values['event_end']."',
								`participants`='".$values['event_participants']."',
								`repeated`='',
								`title_english`='".$values['event_eng']."',
								`details_english`='".$values['event_details_eng']."' 
								where 
								`event_type_id`='".$event['event_type_id']."' AND
								`title`='".$event['title']."' AND
								`details`='".$event['details']."' AND
								`start`='".$event['start']."' AND
								`end`='".$event['end']."' AND
								`repeated`='0' AND
								`participants`='".$event['participants']."' AND
								`title_english`='".$event['title_english']."' AND
								`details_english`='".$event['details_english']."' AND
								`date` > '".date('Y-m-d', strtotime('today'))."';";
								// `date` > ".date('Y-m-d', strtotime('today')).";";
					if (mysql_query($query)) {
						echo "Changed events";
					} else die("Error couldn't save events");
				} else die("Error : Couldn't find database.");
			} else die("Error : No database connection.");
			mysql_close($conn);
		
		// if there is a new repeat type
		} else {
			// remove all future events of the old repeat type
			$conn = mysql_connect($host, $username, $pass);
			if ($conn) {
				if (mysql_select_db($db_name, $conn)) {
					$query = "DELETE FROM `events` where
								`event_type_id`='".$event['event_type_id']."' AND
								`title`='".$event['title']."' AND
								`details`='".$event['details']."' AND
								`start`='".$event['start']."' AND
								`end`='".$event['end']."' AND
								`repeated`='0' AND
								`participants`='".$event['participants']."' AND
								`title_english`='".$event['title_english']."' AND
								`details_english`='".$event['details_english']."' AND
								`date` > '".date('Y-m-d', strtotime('today'))."';";
							echo $query;
					if (!mysql_query($query)) die("Error: Can't delete event");
				} else die("Error : Couldn't find database.");
			} else die("Error : No database connection.");
			mysql_close($conn);
			// add future events of the new repeat type
			$date = $values['event_date'];
			$month = date("n",time());
			$year = date("Y",time());
			if (($month+4)>12) {
				$month -=  8;
				$year += 1;
			} else {
				$month += 4;
			}
			$last_day = date("Y-m-t",  mktime(0, 0, 0, $month, 1, $year));
			while ($date <= $last_day) {
				// get the values for the database
				$save_event=array();
				$save_event['event_type'] = $values['event_type'];
				$save_event['event_date'] = $date;  
				$save_event['event'] = $values['event'];  
				$save_event['event_details'] = $values['event_details']; 
				$save_event['event_start'] = $values['event_start']; 
				$save_event['event_end'] = $values['event_end']; 
				$save_event['event_participants'] = $values['event_participants'];
				$save_event['event_repeated'] = 0; 
				$save_event['event_eng'] = $values['event_eng']; 
				$save_event['event_details_eng'] = $values['event_details_eng'];
				insert_event($save_event);
				
				// calculate new event date
				switch ($values['event_repeated']) {
					case 1:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
						break;
					case 2:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
						break;
					case 3:
						$date = date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
						break;
				}
			}
		}
	}
}

// remove an event
function delete_event($event_id) {
	$event = get_event($event_id);
	// delete the specified event
	$query = "DELETE FROM `events`
				WHERE id = ".$event_id.";";
	enterQuery($query);
	if ($event['repeated'] != '') {
		$query = "DELETE from `events` where
				`event_type_id`='".$event['event_type_id']."' AND
				`title`='".$event['title']."' AND
				`details`='".$event['details']."' AND
				`start`='".$event['start']."' AND
				`end`='".$event['end']."' AND
				`participants`='".$event['participants']."' AND
				`title_english`='".$event['title_english']."' AND
				`details_english`='".$event['details_english']."' AND
				'date' >= '".date('Y-m-d' AND strtotime('today'))."';";
	enterQuery($query);
	}
}

// helper functions
function getNextDate($date, $repeat_type) {
	
	// calculate new event date
	switch ($repeat_type) {
		case 1:
			return date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+1, date("Y",strtotime($date))));
			break;
		case 2:
			return date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))  , date("d",strtotime($date))+7, date("Y",strtotime($date))));
			break;
		case 3:
			return date("Y-m-d", mktime(0, 0, 0, date("m",strtotime($date))+1  , date("d",strtotime($date)), date("Y",strtotime($date))));
			break;
	}
}

?>