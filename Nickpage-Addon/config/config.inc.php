<?php
/*
 * Project		Nickpage-Addon
 * Filename		config.inc.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 */
 
####################
# MySQL-Zugangsdaten
$dbhost = 'localhost';   // Host der Datenbank (e.g. localhost)
$dbuser = 'root';   // Datenbank-User
$dbpass = '';   // Datenbank-Passwort
$dbname = '';   // Datenbankname
$dbpref = 'jf_';   // Datenbank-Prefix (e.g. jf_  oder  fwc_)

###################
# Chatserver-Daten
// Hostname des Chatserver (Ohne "http://" !!!)
$chathost	= 'www.example.org';
// Port des Chatserver
$chatport	= '9090';
// Comstring des Chatserver
$comstring	= '/servlet/jfchat';
// Pfad zur 'membertitles.txt' (Mit Dateinamen angeben!)
// Wichtig: Die Datei "membertitles.txt" muss Leserechte für alle haben!
$mtpath		= '/var/private/chatserver/bin/data/config/membertitles.txt';
// Name der Community
$comname	= 'My community';
// Emoticon-Prefix
$emoprefix	= '#';
// JFChat-Emoticons de-/aktivieren
// Mittels diesem Flag könnt ihr die JFChat-Emoticons im Addon zulassen (true) oder nicht (false)
$allowjfemos = true;
// Wenn nicht das Standard-Verzeichnis zum speichern der Profilbilder verwendet wird, 
// dann bitte diese Variable auf "false" setzen.
$stdpicpath	= true;
// HTTP-Pfad zum Verzeichnis in dem die Profilbilder gespeichert sind (incl. abschl. "/").
// Wichtig: Dieser Ordner muss Leserechte für alle besitzen!
// Hinweis: Diese Pfadangabe wird nur verwendet, wenn die vorherige Variable auf "false"
//			steht!!!
$picturespath	= '/pfad/zum/externen/bildverzeichnis/';


########################################
# Lizenzart der Community-Software
# Hier nur dann 'true' setzen, wenn die Community-Software mit einer
# Lite-, C- oder einer B-Lizenz (bzw. Community-Version) betrieben wird!
# Wird die Community-Software als Freeware oder mit einer Forenmodul-
# Lizenz betrieben, muss dieser Wert auf 'false' stehen bleiben, da es 
# sonst zu Problemen kommt.
#
# Hinweis: Diese Einstellung aktiviert eine Prüfung ob mindestens eine
#          Lite-Lizenz der JFChat-Software vorliegt!
$haslicense = true;

####################
# Pfadangaben der Nickpage-Addon Installation
// HTTP-Pfad zum Nickpage-Verzeichnis incl. abschliessenden "/"
$path_http = '/nickpage/';
// Server-Pfad zum Nickpage-Verzeichnis incl. abschliessenden "/"
$path_server = '/var/www/nickpage/';

####################
# ACC-MODE
# Die nachfolgende Variable nur dann auf "true" setzen, wenn das Addon in
# Verbindung mit dem ACC (Admin-Control-Center) betrieben wird und man
# Galeriebilder einer Freischaltprüfung unterziehen möchte.
$acc_mode = true;

####################
# DEBUG-MODE
# Auf "true" stellen um den Debug-Modus einzuschalten.
# Im Debug-Modus werden diverse Informationen ausgegeben,
# welche die Fehlersuche/-behebung erleichtern.
# Zu den Informationen gehören sämtliche übermittelten
# $_REQUEST Paremeter, ausgeführte MySQL-Querys und evtl.
# aufgetretener MySQL-Error.
$debug_mode = true;

#####################
# Spracheinstellung
# Hier kann festgelegt werden welche Sprachdatei genutzt werden soll.
# Die Sprach-Dateien liegen im Verzeichnis "lang". Um eine neue Sprach-
# Datei hinzu zu fügen, braucht man nur die vorhande kopieren und unter
# einem neuen Dateinamen abspeichern, genauere Infos dazu können in der
# mitgeliefert Sprachdatei "lang_german.php" nachgelesen werden.
$language = 'german';

#####################
# Request-Prüfung
# Hier kann man festlegen ob eine Prüfung der GET- und POST-Werte vom
# Addon durchgeführt werden soll oder nicht. Nutzt man in der Datei "self.php"
# eine eigene Prüfroutine, so sollte dieser Wert auf "false" gestellt werden,
# anderenfalls bitte auf "true" stehen lasse.
# 
# Hinweis: Die Request-Prüfung prüft alle übermittelten GET- und POST-Werte
#          auf mögliche SQL-Injections!
$request_check = true;

?>