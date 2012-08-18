<?php
/*
 * Project		Nickpage-Addon
 * Filename		self.php
 * Author		Steffen Haase
 * Date			06.02.2010
 * License		GPL v3
 */
 
##########################
# In dieser Datei k�nnen eigene Variablen in ein Array gepackt werden, 
# welche dann vom Addon verarbeitet werden und z.b. in Links oder eigenen
# Modulen wieder eingesetzt werden k�nnen.
# Zudem k�nnen Werte, die mittels GET oder POST �bermittelt wurden, 
# hier einer eigenen Pr�fung unterzogen werden, dies gilt auch f�r Werte 
# die innerhalb des Addons per GET und POST �bermittelt werden!
# 
# WICHTIG: Wenn hier eine eigene Pr�fung der sog. Request-Variablen vorgenommen
#          wird, dann bitte in der "config.php" den Wert der Variable "$request_check"
#          auf "false" stellen!
#
# Beispiel)
# Per GET oder POST �bergebene Variable "meinevar" in das Array packen und eine Template-Variable
# festlegen um sie damit weiterverwenden zu k�nnen.
#
# Per GET �bermittelten Wert zu dem Array hinzuf�gen:
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
# Hinweis 1: Bei Einbindung eigener Variablen �ber diese Datei bitte die Struktur des Array beachten!!!
# Hinweis 2: Alternativ zu $_GET und $_POST kann man auch auf $_REQUEST zugreifen, diese Variable
#            enth�lt s�mtliche Werte die auch per GET und POST �bermittelt wurden.

# $self_array[0]['value']	= $_REQUEST['variable1'];
# $self_array[0]['outvar']	= 'VARIABLE1';
# $self_array[1]['value']	= $_REQUEST['variable2'];
# $self_array[1]['outvar']	= 'VARIABLE2';

?>