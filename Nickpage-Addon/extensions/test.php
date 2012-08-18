<?php
/*
 * Project		Nickpage-Addon
 * Filename		test.php
 * Author		Steffen Haase
 * Date			04.05.2010
 * License		GPL v3
 */
 
 /**
  * Dies ist eine Test-Datei im "extensions"-Verzeichnis!
  */
 

// Hier wird das Template "test.tpl" eingebunden
$template->setSubTPL('test');
// Template->Variable "TESTOUTPUT" mit Inhalt befüllen
$template->replaceVar('TESTOUTPUT', 'Dies ist eine Test-Ausgabe im Template "test.tpl".');
 
?>