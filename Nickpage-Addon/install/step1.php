<?php
/*
 * Project		Nickpage-Addon
 * Filename		step1.php
 * Author		Steffen Haase
 * Date			13.02.2010
 * License		GPL v3
 */

$subtitle = 'Schritt 1: Pr&uuml;fung der Schreibrechte der Verzeichnisse und Dateien.';
$template->setSubTPL('step1');
$flag = true;
  
if(substr(decoct( fileperms('../gallery') ), 2) != 777){
	$galdir = '<font color="#FF0000"><b>Not writable!</b></font>';
	$flag = false;
}else{
	$galdir = '<font color="#009F00"><b>OK, Writable</b></font>';
}
if(substr(decoct( fileperms('../log') ), 2) != 777){
	$logdir = '<font color="#FF0000"><b>Not writable!</b></font>';
	$flag = false;
}else{
	$logdir = '<font color="#009F00"><b>OK, Writable</b></font>';
}
if($flag === false) $link = '<a href=install.php?step=1>Ansicht aktualisieren</a>';
else $link = '<a href=install.php?step=2>Weiter mit Schritt 2</a>';

$template->replaceVar('GALDIR_STATUS', $galdir);
$template->replaceVar('LOGDIR_STATUS', $logdir);
$template->replaceVar('LINK', $link);

?>