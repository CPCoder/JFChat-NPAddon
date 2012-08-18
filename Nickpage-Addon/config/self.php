<?php
/*
 * Project		Nickpage-Addon
 * Filename		self.php
 * Author		Steffen Haase
 * Date			06.02.2010
 * License		GPL v3
 */
 
##########################
# In dieser Datei können eigene Variablen in ein Array gepackt werden, 
# welche dann vom Addon verarbeitet werden und z.b. in Links oder eigenen
# Modulen wieder eingesetzt werden können.
# Zudem können Werte, die mittels GET oder POST übermittelt wurden, 
# hier einer eigenen Prüfung unterzogen werden, dies gilt auch für Werte 
# die innerhalb des Addons per GET und POST übermittelt werden!
# 
# WICHTIG: Wenn hier eine eigene Prüfung der sog. Request-Variablen vorgenommen
#          wird, dann bitte in der "config.php" den Wert der Variable "$request_check"
#          auf "false" stellen!
#
# Beispiel)
# Per GET oder POST übergebene Variable "meinevar" in das Array packen und eine Template-Variable
# festlegen um sie damit weiterverwenden zu können.
#
# Per GET übermittelten Wert zu dem Array hinzufügen:
# $self_array[0]['value']	= $_REQUEST['meinevar'];
# $self_array[0]['outvar']	= 'MEINEVAR'
#
# Variable im Link wiederverwenden:
# $lang['profile']['edit'] = '<a href="http://'.$chathost.':'.$chatport.$comstring.'{SID}?auth=1'.
#								'&amp;profil=np&amp;design=0&amp;meinevar={SELFARRAY_MEINEVAR}">Profil bearbeiten</a><br>';
#
# Alternativ zum Link kann die festgelegte Variable auch innerhalb jedes Templates wiederverwendet werden.
#
#
# Hinweis 1: Bei Einbindung eigener Variablen über diese Datei bitte die Struktur des Array beachten!!!
# Hinweis 2: Alternativ zu $_GET und $_POST kann man auch auf $_REQUEST zugreifen, diese Variable
#            enthält sämtliche Werte die auch per GET und POST übermittelt wurden.

# $self_array[0]['value']	= $_REQUEST['variable1'];
# $self_array[0]['outvar']	= 'VARIABLE1';
# $self_array[1]['value']	= $_REQUEST['variable2'];
# $self_array[1]['outvar']	= 'VARIABLE2';

?>