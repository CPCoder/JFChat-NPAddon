<?php
/*
 * Project		Nickpage-Addon
 * Filename		functions_global.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 * 
 */

/**
 * Globale Funktionsdatei.
 * 
 * Diese Datei enthält verschiedene Funktionen die
 * global genutzt werden können. 
 *
 * @package NP-Addon
 * @author Steffen Haase <info@sh-software.de>
 * @version 1.0
 * @copyright Copyright (c) 2009-2010 SHS (Steffen Haase Software)
 */

/**
 * Liefert den Usernamen zu einer Userid zurück
 * 
 * Wird kein Username zu der übergebenen ID gefunden, gibt die Funktion NULL zurück!
 * 
 * @author Steffen Haase, <info@sh-software.de>
 * @param Integer $id ID des Users
 * @return String Username
 */
function getUsername($id){
	$ar = getQueryResult("SELECT username FROM ".REGISTRY." WHERE id='".$id."'", 'functions_global.php');
	if($ar !== false) return $ar[0];
	else return false;
}

/**
 * Liefert das aktuelle Datum bzw. die Uhrzeit zurück
 * 
 * Mit dem Parameter "flag" kann der Rückgabewert festgelegt werden.<br>
 * Flag: 0 > Datum<br>
 * Flag: 1 > Uhrzeit
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param Integer $flag Mögliche Werte: 0, 1
 * @return Datum/Uhrzeit
 */
function getDateTime($flag){
	if($flag == 0) return date('d.m.Y');
	elseif($flag == 1) return date('H:i:s');
	else return null;
}

/**
 * Ermittelt die Rechte eines Users
 * 
 * Liefert die Rechte eines Users zurück und gibt diese im Erfolgsfall zurück.
 * Existiert der User mit der gegebenen UserID nicht, wird false (Boolean) zurückgegeben!
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $id UserID
 * @return String Rechte des Users
 */
function getUserRights($id){
	$ar = getQueryResult("SELECT rechte FROM ".REGISTRY." WHERE id='".$id."'", 'functions_global.php');
	if($ar !== false) return $ar[0];
	else return false;
}
/**
 * Prüft ob ein registriertes Mitglied mit dem gegebenen Namen existiert.
 * 
 * Existiert ein Mitglied mit dem gegebenen Namen, so wird die UserID des Mitgliedes zurückgegeben.<br>
 * Wurde kein Mitglied mit dem gegebenen Namen gefunden liefert diese Funktion false (Boolean) zurück.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $name Username der geprüft werden soll
 * @return String UserID
 */
function existsUser($name){
	$ar = getQueryResult("SELECT id FROM ".REGISTRY." WHERE username='".mysql_real_escape_string($name)."' AND aktiv='1'", 'functions_global.php');
	if($ar !== false) return $ar[0];
	else return false;
}

/**
 * @ignore
 */
function setGbLastVisit($id){
	$dummy = executeQuery("UPDATE ".REGISTRY." SET gblastvisit='".time()."' WHERE id='".$id."'", 'functions_global.php');
}
/**
 * Prüft ob zwei Mitglieder miteinander befreundet sind.
 * 
 * Hierbei gilt das beide die Freundschaft akzeptiert haben! 
 * Im Erfolgsfall liefert diese Funktion true (Boolean), ansonsten false (Boolean) zurück.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $id1 Userid des ersten Mitglieds
 * @param String $id2 Userid des zweiten Mitglieds
 * @return Boolean
 */
function isFriend($id1, $id2){
	if($id1 == $id2) return true;
	$ar = getQueryResult(
		"SELECT userid, friendid FROM ".FRIENDS." WHERE (userid='".$id2."' AND friendid='".$id1."') ".
		"OR (userid='".$id1."' AND friendid='".$id2."')", 'functions_global.php');
	if($ar !== false) return true;
	return false;
}

/**
 * @ignore
 */
function checkFriendStatus($senduid, $showid){
	if($senduid == $showid) return true;
	$ar = getQueryResult("SELECT userid, friendid FROM ".FRIENDS." WHERE userid='".$senduid."' AND friendid='".$showid."'", 'functions_global.php');
	if($ar !== false){
		return 'isfriend';
	}else{
		$ar = getQueryResult("SELECT userid, friendid FROM ".WAITFRIENDS." WHERE userid='".$senduid."' AND friendid='".$showid."'", 'functions_global.php');
		if($ar !== false){
			return 'hewait';
		}else{
			$ar = getQueryResult("SELECT userid, friendid FROM ".WAITFRIENDS." WHERE userid='".$showid."' AND friendid='".$senduid."'", 'functions_global.php');
			if($ar !== false){
				return 'youwait';
			}else{
				return 'nothing';
			}
		}
	}
}

/**
 * Berechnet das Alter aufgrund des übergebenen Geburtstages.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $birthdate Geburtsdatum in Form von DD.MM.YYYY
 * @return String Alter 
 */
function getAge($birthdate){
	$currentdate = date('Y.m.d');
	$cdate = explode('.',$currentdate);
	$cyear = $cdate[0];
	$cmonth = $cdate[1];
	$cday = $cdate[2];
	$bdate = explode('.',$birthdate);
	$byear = $bdate[2];
	$bmonth = $bdate[1];
	$bday = $bdate[0];
	$age = $cyear - $byear;
	if($cmonth < $bmonth OR ($cmonth == $bmonth AND $cday < $bday))
		$age -=1;
	return $age;
}

/**
 * @ignore
 */
function setVisit($flag, $showid, $senduid){
	if($flag == 'true' && $senduid != '-1' && $showid != $senduid){
		$date = date('y-m-d');
		$time = date('H:i:s');
		executeQuery("INSERT INTO ".VISITORS." (userid, visitorid, datum, uhrzeit) VALUES('".$showid."', '".$senduid."', '".$date."', '".$time."')", 'functions_global.php');
		executeQuery("UPDATE ".REGISTRY." SET npcount=npcount+1 WHERE id='".$showid."'", 'functions_global.php');
	}
}
/**
 * Führt ein SQL-Query in der Datenbank aus.
 * 
 * Hier dürfen nur UPDATE- und INSERT-Statements übergeben werden!<br>
 * Im Debugmodus wird das Query als erfolgreich ausgeführt wenn keine Fehler auftreten, ansonsten
 * steht das Query im Bereich für SQL-Errors.
 *
 * @author Steffen Haase <info@sh-software.de>
 * @param String $query Das Query welches ausgeführt werden soll.
 * @param String $location Der Name der PHP-Datei in welchem das Query abgesetzt wird.
 */
function executeQuery($query, $location){
	global $mysql_errors;
	$res = mysql_query($query);
	$error_message	= mysql_error();
	$error_code		= mysql_errno();
	if(!empty($error_message)){
		addMySQLError($error_code, $error_message, $query, $location, $mysql_errors);
	}else{
		addMySQLQuery($query, $location);
	}
}
/**
 * Ermittelt die Anzahl der betroffen Zeilen eines Querys
 * 
 * Im Debugmodus wird das Query als erfolgreich ausgeführt wenn keine Fehler auftreten, ansonsten
 * steht das Query im Bereich für SQL-Errors.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $query Das Query dess Zeilenanzahl ermittelt werden soll.
 * @param String $location Der Name der PHP-Datei in welchem das Query abgesetzt wird.
 * @return String Anzahl der betroffen Zeilen.
 */
function getQueryResultCount($query, $location){
	global $mysql_errors;
	$res = mysql_query($query);
	$error_message	= mysql_error();
	$error_code		= mysql_errno();
	if(!empty($error_message)){
		addMySQLError($error_code, $error_message, $query, $location, $mysql_errors);
		return false;
	}else{
		addMySQLQuery($query, $location);
		return mysql_result($res,0,"menge");
	}
}
/**
 * Gibt das Ergebnis einer MySQL-Abfrage zurück, welches mehrere Zeilen beinhalten kann.
 * 
 * Im Debugmodus wird das Query als erfolgreich ausgeführt wenn keine Fehler auftreten, ansonsten
 * steht das Query im Bereich für SQL-Errors.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $query Das Query welches ausgeführt werden soll.
 * @param String $location Der Name der PHP-Datei in dem das Query abgesetzt wird.
 * @return Array Ein Array welches das Ergebnis der Abfrage beinhaltet.
 */
function getQueryResultLoop($query, $location){
	global $mysql_errors;
	$ar2 = array();
	$i=0;
	$res = mysql_query($query);
	$error_message	= mysql_error();
	$error_code		= mysql_errno();
	if(!empty($error_message)){
		addMySQLError($error_code, $error_message, $query, $location, $mysql_errors);
		return false;
	}else{
		addMySQLQuery($query, $location);
		while($ar = mysql_fetch_array($res)){
			$ar2[$i] = $ar;
			$i++;
		}
		return $ar2;
	}
}

/**
 * Gibt das Ergebnis einer MySQL-Abfrage zurück, welches nur eine Zeile beinhaltet.
 * 
 * Im Debugmodus wird das Query als erfolgreich ausgeführt wenn keine Fehler auftreten, ansonsten
 * steht das Query im Bereich für SQL-Errors.
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param String $query Das Query welches ausgeführt werden soll.
 * @param String $location Der Name der PHP-Datei in dem das Query abgesetzt wird.
 * @return Array Ein Array welches das Ergebnis der Abfrage beinhaltet.
 */
function getQueryResult($query, $location){
	global $mysql_errors;
	$res = mysql_query($query);
	$error_message	= mysql_error();
	$error_code		= mysql_errno();
	if(!empty($error_message)){
		addMySQLError($error_code, $error_message, $query, $location, $mysql_errors);
		return false;
	}else{
		addMySQLQuery($query, $location);
		$ar = mysql_fetch_array($res);
		return $ar;
	}
}

/**
 * @ignore
 */
function addMySQLQuery($query, $location){
	global $mysql_querys;
	$mysql_querys .= '<strong>Query:</strong> '.$query.'<br>' .
			'<strong>Location:</strong> '.$location.'<br><br>';
}

/**
 * @ignore
 */
function addMySQLError($error_code, $error_message, $query, $location, &$mysql_errors){
	$mysql_errors .= '<strong>Error-Code:</strong> '.$error_code.'<br>' .
			'<strong>Error     :</strong> '.$error_message.'<br>' .
			'<strong>Query     :</strong> '.$query.'<br>' .
			'<strong>Location  :</strong> '.$location.'<br><br>';
}
/**
 * Generiert eine Seitenlink-Navigation wie z.B. im Gästebuch oder Blog
 * 
 * @author Steffen Haase <info@sh-software.de>
 * @param Integer $SitesComplete Gesamtanzahl der Ergebnisseiten 
 * @param Integer $page Aktuelle Seite
 * @param String $extVariables Zusätzliche Variablen die im Link stehen sollen (Bsp.: site=blog&sid=sessionID)
 * @return String Seitennavigation
 */
function Navigation($SitesComplete,$page,$extVariables){
  $NavCeil = floor(NAV_COUNT / 2);
  $string = '';
  if($page > 1){
    $string .= '<a href="?'.$extVariables.'&amp;page=1"><<</a>&nbsp;&nbsp;';
    $string .= '<a href="?'.$extVariables.'&amp;page='.($page-1).'"> <</a>&nbsp;&nbsp;';
  }else{
    $string .= '<<&nbsp;&nbsp; <&nbsp;&nbsp;';
  }
  for($x=$page-$NavCeil;$x<=$page+$NavCeil;$x++){
    if(($x>0 && $x<$page) || ($x>$page && $x<=$SitesComplete))
        $string .= '<a href="?'.$extVariables.'&amp;page='.$x.'">'.$x.'</a>&nbsp;&nbsp;';
    if($x==$page)
      $string .= '['.$x.']&nbsp;&nbsp;';
  }
  if($page < $SitesComplete){
    $string .= '<a href="?'.$extVariables.'&amp;page='.($page+1).'">></a>&nbsp;&nbsp;';
    $string .= '<a href="?'.$extVariables.'&amp;page='.$SitesComplete.'"> >></a>&nbsp;&nbsp;';
  }else{
    $string .= '>&nbsp;&nbsp >>&nbsp;&nbsp;';
  }
  return $string;
}

?>