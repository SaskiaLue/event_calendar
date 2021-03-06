<?php

// start the session
session_start();

// only visible for users with the right to change events
if (in_array("admin", $_SESSION['phpcal_rights']) || in_array("events", $_SESSION['phpcal_rights'])) {

	// included files
	include_once("modules/event_db.php");
	
	// show all errors
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 'On');
	
	// if an event should be edited, get the data and set the form-type
	if (isset($_GET['id']) || isset($_POST['event_id'])) {
		$eventid=$_GET['id'];
		$event=array();
		$event=get_event($eventid);
		$type = 'edit';
	} else {	
		$type = 'insert';
	}

	/**
	* replace URIs with appropriate HTML code to be clickable.
	*/
	function replace_uri($str) {
	  $pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm';
	  return preg_replace($pattern,"\\1<a href=\"\\2\\3\"><u>\\2\\3</u></a>\\4",$str);
	}
	
	// get the Post data
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$today = date("Y-m-d H:i", time());
		$event_date = $_POST['event_date']." ".substr($_POST['event_start'],0,5);
		if (( ( $type == 'insert' ) && ( $event_date > $today ) ) || ( $type == 'edit' ) ) {
			// get values
			$values = array();
			if ( $type == 'edit' ) { $values['id'] = $_POST['event_id']; }
			$values['event_type'] = $_POST['event_type'];
			$values['event_date'] = $_POST['event_date'];  
			$values['event'] = $_POST['event'];  
			$values['event_details'] = replace_uri($_POST['event_details']);
			$values['event_start'] = $_POST['event_start']; 
			$values['event_end'] = $_POST['event_end']; 
			$values['event_participants'] = $_POST['event_participants'];
			$values['event_repeated'] = $_POST['event_repeated']; 
			$values['event_eng'] = $_POST['event_eng']; 
			$values['event_details_eng'] =  replace_uri($_POST['event_details_eng']); 
			
			// connect to db and enter query
			if ( $type == 'insert' ) {
				insert_event($values);
			} else {
				edit_event($values);
			}
			print '<script>window.close();</script>';
		} else {
			print($event_config['wrong_date']);
		}

		//back to user management
		header('Location: '.$_SESSION['phpcal_page']);
	}
	
include("header.php");
	?>

		<div id="eventformular">
			<form id="event_formular" name="event_formular" action="<?=htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<table>
				<tr><td><input type="hidden" id="event_date" name="event_date" value="<?=(isset($event))?($event['date']):($_GET['date']);?>" size="12" /></td></tr>
				<?php if (isset($event)) { ?><tr><td></td><td><input type="hidden" name="event_id" value=<?='"'.$eventid.'"'; ?>></td></tr> <?php } ?>
				<tr><td><label for="event_type" id="em">Type :<strong>*</strong></label></td><td><select id="event_type" name="event_type" size="1"><?=get_english_types((isset($event))?($event['event_type_id']):(0));?></select></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event" id="em">Name :<strong>*</strong></label></td><td><input type="text" id="event" name="event" value="<?=(isset($event))?($event['title']):(''); ?>" size="35" maxlength="128" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_details" id="em">Details :<strong>*</strong></label></td><td><input type="text" id="event_details" name="event_details" value="<?=(isset($event))?($event['details']):(''); ?>" size="35" maxlength="500" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_eng" id="em">Name (english):<strong>*</strong></label></td><td><input type="text" id="event_eng" name="event_eng" value="<?=(isset($event))?($event['title_english']):(''); ?>" size="35" maxlength="128" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_details_eng" id="em">Details (english) :<strong>*</strong></label></td><td><input type="text" id="event_details_eng" name="event_details_eng" value="<?=(isset($event))?($event['details_english']):(''); ?>" size="35" maxlength="128" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_start" id="em">Start (hh:mm):<strong>*</strong></label></td><td><input type="text" id="event_start" name="event_start" value="<?=(isset($event))?($event['start']):(''); ?>" size="35" maxlength="128" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_end" id="em">End (hh:mm):</label></td><td><input type="text" id="event_end" name="event_end" value="<?=(isset($event))?($event['end']):(''); ?>" size="35" maxlength="128" /></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_repeated" id="em">Repeats:</label></td><td><select id="event_repeated" name="event_repeated" size="1"><option></option><?=get_repeat((isset($event))?($event['repeated']):(0));?></select></td><td><span class="error"></span></td></tr>
				<tr><td><label for="event_participants" id="em">Participants:<strong>*</strong></label></td><td><input type="text" id="event_participants" name="event_participants" value="<?=(isset($event))?($event['participants']):(''); ?>" size="35" maxlength="128" value="0" /></td></tr>
				<tr><td><input type="submit" class="submit" value="<?=$main['submit']; ?>"></td></tr>
			</table>
			</form>	
		</div>
	<?php 
include("footer.php");
}
?>