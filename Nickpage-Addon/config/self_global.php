<?php
/*
 * Project		Nickpage-Addon
 * Filename		self_global.php
 * Author		Steffen Haase
 * Date			06.03.2010
 * License		GPL v3
 */

/*
 * Hier k�nnt ihr eine eigene Datenbank-Abfrage erstellen und die Ergebnisse der Abfragen 
 * Global im Nickpage-Addon verf�gbar machen.
 * 
 * Wichtiger Hinweis: Bitte genau an die Vorgaben bez�glich der Definition der Template-
 * Variablen halten, da es sonst zu Inkonsistenzen mit bestehenden Template-Variablen
 * kommen kann!
 * 
 * Um eine Datanbank-Abfrage zu erstellen bitte nur die nachfolgenden Funktionen nutzen, 
 * nur dann wird die Abfrage auch im Degbug-Modus ber�cksichtigt!
 * 
 * Funktionen
 * ==============
 * Query-Funktionsaufruf
 * ---------------------
 * getQueryResult("SQL_QUERY", 'Name der PHP-Datei');
 * 
 * Erkl�rung:
 * SQL_QUERY			> Hier wird das eigentliche SQL-Query reingeschrieben
 * Name der PHP-Datei	> Hier bitte den Namen der PHP-Datei reinschreiben, in dem
 * 						  die Funktion aufgerufen wird (e.g. self_global.php)
 * 
 * Template-Variablen-Funktionsaufruf
 * ----------------------------------
 * $template->replaceVar('TEMPLATE_VARIABLE', $variable);
 * 
 * Erkl�rung:
 * TEMPLATE_VARIABLE	> Der Name der Variable wie sie im Template genutzt wird.
 * 						  Bitte Hinweis dazu im Beispiel beachten!
 * $variable			> Hier kommt die PHP-Variable hin, welche den Wert enth�lt,
 * 						  der in die Template-Variable rein soll. 
 * 
 * Definitions-Name der Registry-Tabelle
 * =====================================
 * REGISTRY
 * 
 * Nutzbare PHP-Variablen
 * ======================
 * $senduid		> Enth�lt die per GET oder POST �bermittelte Userid des Nickpage-Besuchers
 * $showid		> Enth�lt die per GET oder POST �bermittelte Userid des Nickpage-Inhabers
 * $sid			> Enth�lt die per GET oder POST �bermittelte SessionID des Nickpage-Besuchers
 * 				  Hinweis: Diese Variable kann nur in Verbindung mit einer g�ltigen Lizenz
 * 						   (Lite-, C-, B-, Community-Lizenz) der JFChat-Software genutzt werden.
 * 						   Der Grund ist einfach, liegt eine solche Lizenz nicht vor, wird von der
 * 						   JFChat-Software dieser Wert auch nicht in die Datenbank eingetragen!
 *
 * Beispiel
 * ========
 * In dem nachfolgenden Beispiel werden die Spalten "optional1" bis "optional2" aus der
 * Registry des Nickpage-Inhabers abgefragt.
 * 
 * Datenbank-Abfrage
 * -----------------
 * $ar = getQueryResult(
 * 		"SELECT ".
 * 			"optional1, optional2, optional3, optional4, optional5 ".
 * 		"FROM ".REGISTRY." ".
 * 		"WHERE id='$showid'"
 * 		, 'self_global.php');
 * 
 * Auswertung und Zuweisen von Template-Variablen
 * ----------------------------------------------
 * if($ar !== false){ // Pr�fung ob Abfrage leer ist oder Daten enth�lt
 * 		// Ergebnisse den eigenen Variablen zuweisen, alternativ k�nnen
 * 		// die Ergebnisse auch direkt den Template-Varibalen zugewiesen 
 * 		// werden. Siehe Alternative weiter unten.
 * 		// Wichtig:
 * 		// Bitte bei eigenen Variablen in dieser Datei sollte "$self_"
 * 		// am Anfang stehen um Inkonsistenzen mit Variablen innerhalb des Addons
 * 		// zu vermeiden! 
 * 		//
 * 		$self_opt1 = $ar[0];
 * 		$self_opt2 = $ar[1];
 * 		$self_opt3 = $ar[2];
 * 		$self_opt4 = $ar[3];
 * 		$self_opt5 = $ar[4];
 * 		
 * 		// Template-Variablen zuweisen.
 * 		// Wichtig:
 * 		// Auch hier bitte den Anfang der Template-Variablen auf "SELF_" setzen
 * 		// um Inkonsistenzen zu bestehenden Template-Variablen zu vermeiden!
 * 		// Wichtig 2:
 * 		// Hier brauchen nicht die Klammern ({}) mit angegeben zu werden, die Klammern
 * 		// M�ssen nur im Template zus�tzlich angegeben werden!
 * 		$template->replaceVar('SELF_OPT1', $opt1);
 * 		$template->replaceVar('SELF_OPT2', $opt2);
 * 		$template->replaceVar('SELF_OPT3', $opt3);
 * 		$template->replaceVar('SELF_OPT4', $opt4);
 * 		$template->replaceVar('SELF_OPT5', $opt5);
 * 
 * 		// Alternativ k�nnen die Ausgabewerte des Querys auch direkt ohne Umweg �ber eine
 * 		// eigene PHP-Variable an die Template-Variable gebunden werden:
 * 		$template->replaceVar('SELF_OPT1', $ar[0]);
 * 		$template->replaceVar('SELF_OPT2', $ar[1]);
 * 		$template->replaceVar('SELF_OPT3', $ar[2]);
 * 		$template->replaceVar('SELF_OPT4', $ar[3]);
 * 		$template->replaceVar('SELF_OPT5', $ar[4]);
 * }
 *  
 */

?>