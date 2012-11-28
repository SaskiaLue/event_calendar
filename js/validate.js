// Skript zur Validierung des Event-Formulars

function checkFormular () {
  if (document.event_formular.event_date.value == "") {
    alert("Bitte ein Datum angeben!");
    document.Formular.Ort.focus();
    return false;
  }
  if (document.event_formular.event.value == "") {
    alert("Bitte einen Titel eingeben!");
    document.Formular.User.focus();
    return false;
  }
  if (document.event_formular.event_details.value == "") {
	    alert("Bitte eine Beschreibung eingeben!");
	    document.Formular.User.focus();
	    return false;
	  }
  if (document.event_formular.event_eng.value == "") {
    alert("Keinen englischen Namen angegeben!");
    document.Formular.Mail.focus();
    return false;
  }
  if (document.event_formular.event_details_eng.value == "") {
    alert("Keine englische Beschreibung eingegeben!");
    document.Formular.Alter.focus();
    return false;
  }
  if (document.event_formular.event_start.value == "") {
	    alert("Keinen Startzeitpunkt eingegeben!");
	    document.Formular.Alter.focus();
	    return false;
	  }
  if (document.event_formular.event_end.value == "") {
	    alert("Keinen Endzeitpunkt eingegeben!");
	    document.Formular.Alter.focus();
	    return false;
	  }
}