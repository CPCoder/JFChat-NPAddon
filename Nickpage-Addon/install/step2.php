<?php
/*
 * Project		Nickpage-Addon
 * Filename		step2.php
 * Author		Steffen Haase
 * Date			13.02.2010
 * License		GPL v3
 */
 
$subtitle = 'Schritt 2: Pr&uuml;fung der Datenbank-Anbindung.';
$template->setSubTPL('step2');
$flag = true;
$error = '<strong>MySQL-Error:</strong> ';

$dz = @mysql_connect($dbhost, $dbuser, $dbpass);
if($dz === false){
	$error .= mysql_error();
	$flag = false;	
}else{
	if(@mysql_select_db($dbname, $dz) === false){
		$error .= mysql_error();
		$flag = false;	
	}else{
		$res = @mysql_query("DESCRIBE ".REGISTRY);
		$ar = @mysql_fetch_array($res);
		if(empty($ar[0])){
			$error .= mysql_error();
			$flag = false;
		}
	}
}
if($flag === false) $link = '<a href=install.php?step=2>Ansicht aktualisieren</a>';
else $link = '<a href=install.php?step=3>Weiter mit Schritt 3</a>';

if($flag === false){
	$template->replaceVar('DB_ERRORMESSAGE', $error);
	$template->replaceVar('CONNECTION_STATUS', '<font color="#FF0000"><b>Can\'t connect to database!</b></font>');
}else{
	$template->replaceVar('DB_ERRORMESSAGE', '');
	$template->replaceVar('CONNECTION_STATUS', '<font color="#009F00"><b>Connection to database ok!</b></font>');
}


$template->replaceVar('LINK', $link);
$template->replaceVar('DB_HOST', $dbhost);
$template->replaceVar('DB_USER', $dbuser);
$template->replaceVar('DB_PASS', $dbpass);
$template->replaceVar('DB_NAME', $dbname);
$template->replaceVar('DB_PREF', $dbpref);

 
?>