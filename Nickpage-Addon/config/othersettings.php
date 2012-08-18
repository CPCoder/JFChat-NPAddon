<?php
/*
 * Project		Nickpage-Addon
 * Filename		othersettings.php
 * Author		Steffen Haase
 * Date			16.01.2010
 * License		GPL v3
*/

#######################################
# Testdatei
# Hier kann die Testdatei (test.php) aktiviert werden.
# Wurde die Testdatei aktiviert, bindet sie das Template
# "test.tpl" aus dem Template-Verzeichnis ein.
#
# Wert		Auswirkung
# true		Aktiviert die Testdatei
# false 	Deaktiviert die Testdatei
#
# Standard-Wert ist "false"
$activateTestFile = false;

#######################################
# Adminrechte
# Hier k�nnen die Rechte festgelegt werden, ab denen einem
# Admin bestimmte Funktionen auf den Nickpages zur Verf�gung stehen.
$adminrights = 10;

#######################################
# Galerie
# Hier k�nnen verschiedene Einstellungen f�r die Nickpage-Galerie
# festgelegt werden.
#
# Maximale Anzahl der Bilder pro Kategorie
# Standard-Wert ist 50
$gal_max_images = 50;
# Maximale Breite eines Bildes das hochgeladen werden soll
# Standard-Wert ist 800
$gal_max_width = 800;
# Maximale H�he eines Bildes das hochgeladen werden soll
# Standard-Wert ist 600
$gal_max_height = 600;

#######################################
# BBCode "YOUTUBE"
# Hier kann der BBCode f�r Youtube-Videos deaktiviert, bzw
# aktiviert werden.
#
# Wert		Auswirkung
# true		Youtube-BBCode ist aktiviert
# false		Youtube-BBCode ist deaktiviert
$BBCode_Youtube = false;

#######################################
# Freundschaft
# Hier kann festgelegt werden ob bei einer Freundschafts-Anfrage
# der Angefragte zustimmen muss, oder nicht.
#
# Wert		Auswirkung
# true		Angefragter muss nicht zustimmen
# false		Angefragter muss zustimmen
$nofriendauthorize = true;

#######################################
# G�stebuch
# Soll statt des Userbildes das Avatar des Users bei den G�stebuchbeitr�gen
# angezeigt werden, dann diesen Wert auf "false" stellen.
$gb_showpicture = false;
# Hier kann die Anzahl der G�stebucheintr�ge pro Seite festgelegt werden
# Standard-Wert ist 10 Eintr�ge pro Seite
$gb_entries_per_page = 10;
# Hier kann die Anzahl der Minuten festgelegt werden, innerhalb derer
# kein weiterer Eintrag gemacht werden kann (Flood-Protection).
# Standard-Wert ist 5 Minuten.
$gbfloodmin = 5; 
# Hier kann die Anzahl der Punkte festgelegt werden, die man f�r einen
# G�stebucheintrag bekommt. Standard-Wert ist 5 Punkte.
$gbpoints = 5;
# Hier kann die Anzahl der Seitenlinks angegeben werden, die ausgehend
# von der aktuellen Seite links und rechts angezeigt werden
# Standard-Wert ist 5 Seitenlinks nach links und rechts.
# Hinweis: Diese Einstellung gilt f�r alle Bereiche, in denen eine Seiten-
#          navigation vorhanden ist!
$gb_navigation_count = 5;
# Hier kann eingestellt werden, ob auch G�stebuchbeitr�ge von gel�schten
# Mitgliedern angezeigt werden sollen. Standard-Wert ist false.
# true	= Es werden auch Beitr�ge von gel�schten Mitgliedern angezeigt.
# false	= Es werden nur Beitr�ge von aktiven Mitgliedern angezeigt.
$gb_show_all_entries = true;
# Hier kann festgelegt werden ob IMG und URL im G�stebuch erlaubt sind.
# Bei deaktiverter Option werden auch die Buttons im G�stebuch ausgeblendet.
# Standardwert ist false
# true	= IMG und URL bei G�stebuchbeitr�gen erlauben
# false	= IMG und URL bei G�stebuchbeitr�gen verbieten
$gb_allow_img_and_url = false;

#######################################
# Blog
# Hier kann die Anzahl der Blogbeitr�ge pro Seite festgelegt werden.
# Standard-Wert ist 5 Eintr�ge pro Seite.
#
# Hinweis: Das Blog ist erst ab der Vollversion des NP-Addons nutzbar!
# Hinweis: Die Anzahl der Seitenlinks wird beim G�stebuch �ber die
#          Variable $gb_navigation_count festgelegt!
$blog_entries_per_page = 5;

#######################################
# Besucherliste
# Hier wird die Zeile definiert, die pro Besucher ausgegeben wird.
#
# Hinweis: Die Besucherliste wird nur angezeigt wenn eine g�ltige
#          JFChat-Lizenz (mind. Lite-Lizenz) vorliegt!
$visitorline = '<tr><td width="34%"><div class="text_left">{VISITOR}</div></td><td width="33%"><div class="text_center">{VISITDATE}</div></td><td width="33%"><div class="text_center">{VISITTIME}</div></td></tr>';

#######################################
# Ausnahme-Seiten f�r diverse Blocks
# Hier k�nnen eigene erstellte Seiten von den Blocks:
# - Nickpage nur f�r Freunde/Niemanden
# - Nickpage durch Admin gesperrt
# - Nickpage f�r bestimmte User durch NP-Inhaber gesperrt
# 
# Diese Einstellung wirkt sich wie schon gesagt nur auf eigene erstellte
# Seite aus, welche im "extensions"-Verzeichnis liegen!
#
# Hinweis: Diese Variable deklariert ein Array, in dem beliebig viele
#          Seitennamen hinterlegt werden k�nnen. Die Variable ist mit 
#          3 Beispielnamen vorbelegt, um zu zeigen wie sie bef�llt werden muss!
$noblocksites = array('eigeneseite1', 'eigeneseite2', 'eigeneseite3');

#######################################
# Ausnahme-Seiten f�r Header und Footer
# Hier k�nnen eigene erstellte Seiten angegeben werden,
# bei denen weder der Addon-Header/-Footer angezeigt werden soll.
#
# Diese Einstellung wirkt sich wie schon gesagt nur auf eigene erstellte
# Seite aus, welche im "extensions"-Verzeichnis liegen!
#
# Hinweis: Diese Variable deklariert ein Array, in dem beliebig viele
# Seitennamen hinterlegt werden k�nnen. Die Variable ist mit 3 Beispielnamen
# vorbelegt, um zu zeigen wie sie bef�llt werden muss!
$noheadfootsites = array('eigeneseite1', 'eigeneseite2', 'eigeneseite3');



#######################################
# Profil-Daten
# Hier k�nnen die Spalten deklariert werden, welche abgefragt
# und auf der Profil-Seite ausgegeben werden sollen.
# Bitte jeden Spaltennamen in einer neuen Zeile angeben und
# dabei die vorgebene Struktur einhalten.
# 
# Das $profil[]-Array ist ein sogenanntes "Multi-Array".
# Der Aufbau ist wie folgt:
#
# $profil[0]['row'] = 'Spaltenname'	> Hier wird die Spalte definiert
# $profil[0]['out'] = 'Anzeigename' > Hier wird der Bezeichner definiert
#
# HINWEIS: Die Spalten "bild", "geburtsdatum" und "geschlecht"
#          d�rfen in dieser Liste nicht definiert werden, da
#          diese Spalten schon im Abfrage-Query hinterlegt sind!
#
# WICHTIG: $profil[0]['out'] und $profil[1]['out'] enthalten den selben
#          Anzeigenamen, da die Werte aus der Datenbank zusammengefasst
#          und als anklickbarer Link ausgegeben werden! Dies ist somit
#          keine Fehlkonfiguration!  

$profil[0]['row']	= 'homepagename';
$profil[0]['out']	= 'Homepage:';

$profil[1]['row']	= 'homepageurl';
$profil[1]['out']	= 'Homepage:';

$profil[2]['row']	= 'wohnort';
$profil[2]['out']	= 'Wohnort:';

$profil[3]['row']	= 'beschreibung';
$profil[3]['out']	= 'Beschreibung:';

$profil[4]['row']	= 'machtWut';
$profil[4]['out']	= 'Negative Eigenschaften:';

$profil[5]['row']	= 'gutDrauf';
$profil[5]['out']	= 'Positive Eigenschaften:';

$profil[6]['row']	= 'wasInsel';
$profil[6]['out']	= '3 Dinge f&uuml;r die Insel:';

$profil[7]['row']	= 'hobbies';
$profil[7]['out']	= 'Hobbys:';

$profil[8]['row']	= 'favMusik';
$profil[8]['out']	= 'Lieblings-Musik:';

$profil[9]['row']	= 'icq';
$profil[9]['out']	= 'ICQ:';

$profil[10]['row']	= 'favLink';
$profil[10]['out']	= 'Lieblings-Link:';

$profil[11]['row']	= 'optional1';
$profil[11]['out']	= 'Optional 1:';

$profil[12]['row']	= 'optional2';
$profil[12]['out']	= 'Optional 2:';

$profil[13]['row']	= 'optional3';
$profil[13]['out']	= 'Optional 3:';

$profil[14]['row']	= 'optional4';
$profil[14]['out']	= 'Optional 4:';

$profil[15]['row']	= 'optional5';
$profil[15]['out']	= 'Optional 5:';
 
?>