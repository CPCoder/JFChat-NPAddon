<?php
/*
 * Project		Nickpage-Addon
 * Filename		npshowsetting.php
 * Author		Steffen Haase
 * Date			05.04.2010
 * License		GPL v3
 */
 
$showset0	= '';
$showset1	= '';
$showset2	= '';


if($ac == 'save'){
	if(isset($_REQUEST['showsetting'])) $showsetting = $_REQUEST['showsetting'];
	else $showsetting = 'null';
	$tmp_showsetting	= trim($showsetting, '0123456789');
	if(!empty($tmp_showsetting)) $showsetting = 'null';
	
	if($showsetting != 'null'){
		if($showsetting == 1){
			$dummy = executeQuery("UPDATE ".REGISTRY." SET nponlyfriends='1' WHERE id='".$senduid."'", 'npshowsetting.php');
		}elseif($showsetting == 2){
			$dummy = executeQuery("UPDATE ".REGISTRY." SET nponlyfriends='2' WHERE id='".$senduid."'", 'npshowsetting.php');
		}else{
			$dummy = executeQuery("UPDATE ".REGISTRY." SET nponlyfriends='0' WHERE id='".$senduid."'", 'npshowsetting.php');
		}
	}
}

$ar = getQueryResult(
		"SELECT nponlyfriends FROM ".REGISTRY." ".
		"WHERE id='".$senduid."'"
		, 'npshowsetting.php');
$template->setSubTPL('npshowsetting');
if($ar !== false){
	if($ar[0] == 2){
		$showset2 = ' checked';
	}elseif($ar[0] == 1){
		$showset1 = ' checked';
	}else{
		$showset0 = ' checked';
	}
}
$template->replaceVar('FLAG_SHOWSET0', $showset0);
$template->replaceVar('FLAG_SHOWSET1', $showset1);
$template->replaceVar('FLAG_SHOWSET2', $showset2);
$template->replaceVar('SUB_TITLE', $lang['title']['npshowsetting']);
 
?>