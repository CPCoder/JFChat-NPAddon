<?php
/*
 * Project		Nickpage-Addon
 * Filename		defines.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 */
 
define('REGISTRY', $dbpref.'registry');
define('FRIENDS', $dbpref.'myfriends');
define('VISITORS', $dbpref.'visitors');
define('SENDFRIENDS', $dbpref.'sendfriends');
define('WAITFRIENDS', $dbpref.'waitingfriends');
define('GUESTBOOKS', $dbpref.'guestbooks');
define('EMOS', $dbpref.'emos');
define('BLOGS', $dbpref.'npblog');
define('GALCATS', $dbpref.'npgalcategories');
define('GALIMGS', $dbpref.'npgalimages');
define('NPBLOCKS', $dbpref.'npblocks');

$dz = mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $dz);

?>