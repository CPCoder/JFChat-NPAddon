<?php
/*
 * Project		Nickpage-Addon
 * Filename		globaldata.php
 * Author		Steffen Haase
 * Date			16.01.2010
 * License		GPL v3
*/

// Initialise Variables
$npuser_name		= '';
$npuser_isonline	= $lang['other']['offline'];
$npuser_gblock		= false;
$np_npblocks		= array();
$np_lock			= false;
$visitorrights		= '0';
$visitorcheck		= true;
$nponlyfriends		= false;	
$unknowuser			= false;

$ar = getQueryResult("SELECT username, isOnline, gblock, nplock, nponlyfriends FROM ".REGISTRY." WHERE id='".$showid."'", 'globaldata.php');
if($ar !== false){
	$npuser_name = $ar[0];
	if($ar[1] == 1) $npuser_isonline = $lang['other']['online'];
	if($ar[2] == 1) $npuser_gblock = true;
	if($ar[3] == 1) $np_lock = true;
	if($ar[4] == 1) $nponlyfriends = true;
}else{
	$unknowuser = true;
}
$ar = getQueryResultLoop("SELECT blockid FROM ".NPBLOCKS." WHERE userid='".$showid."'", 'globaldata.php');
if($ar !== false){
	foreach($ar as $key){
		$np_npblocks[] = $key[0];
	}
}else{
	$np_npblocks[0] = '';
}

if($haslicense){
	if($senduid != '-1'){
		$ar = getQueryResult("SELECT sid, isOnline, rechte, username FROM ".REGISTRY." WHERE id='".$senduid."'", 'globaldata.php');
		if($ar !== false){
			if(strstr($sessionID, '=')){
				$explode = explode('=', $sessionID);
				$sid = $explode[1];
			}else{
				$sid = $sessionID;
			}
			if(empty($ar[0])) $visitorcheck = false;
			if($ar[1] == 0) $visitorcheck = false;
			if($sid != $ar[0]) $visitorcheck = false;
			$visitorrights = $ar[2];
		}else{
			$visitorcheck = false;
		}
	}else{
		$visitorcheck = false;
	}
}else{
	if($senduid != '-1'){
		$url = 'http://'.$chathost.':'.$chatport.$comstring.$sessionID.'?showhtml=sidcheck';
		$c_con = curl_init($url);
		curl_setopt($c_con, CURLOPT_RETURNTRANSFER, 1);
		$response = trim(curl_exec($c_con));
		curl_close($c_con);
		if(strstr($response, '<userid>') && strstr($response, '</userid>')){
			$tmp = substr($response, 8);
			$tmp = substr($tmp, 0, -9);
			if ($tmp != $senduid) {
				$visitorcheck = false;
			} else {
				$ar = getQueryResult("SELECT rechte FROM ".REGISTRY." WHERE id='".$senduid."'", 'globaldata.php');
				if ($ar !== false) {
					$visitorrights = $ar[0];
				}
			}
		}else{
			$visitorcheck = false;
		}
	}else{
		$visitorcheck = false;
	}
}

?>