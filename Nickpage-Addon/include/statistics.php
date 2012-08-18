<?php
/*
 * Project		Nickpage-Addon
 * Filename		statistics.php
 * Author		Steffen Haase
 * Date			17.01.2010
 * License		GPL v3
*/

$ar = getQueryResult("SELECT ".
		"objekte, onlinezeit, chatzeit, punkte, lastLoginTime, lastLoginDate, forumBeitraege, ".
		"forumThemen, umsatz, forumGesperrt, npcount, memberSince ".
	"FROM ".REGISTRY." ".
	"WHERE ".
		"id='$showid'", 
	'statistics.php');
$ar2 = getQueryResult("SELECT COUNT(*) FROM ".GUESTBOOKS." WHERE userid='".$showid."'", 'statistics.php');
$ar3 = getQueryResult("SELECT COUNT(*) FROM ".GUESTBOOKS." WHERE userid='".$showid."' AND isPrivate='1'", 'statistics.php');
if($ar !== false){
	if($ar2 !== false)
		$gbcount = $ar2[0];
	else
		$gbcount = 0;
	if($ar3 !== false)
		$privcount = $ar3[0];
	else
		$privcount = 0;
	if($haslicense === true){
		if(empty($ar['objekte']))
			$objects = $lang['error']['noobjects'];
		else
			$objects = $ar['objekte'];
		$template->loadTPL('objects');
		$template->replaceVarTPL('OBJECTS', $objects);
		$objects = $template->getTPL();
	}else{
		$objects = '';
	}
	$lldate = date('d.m.Y', strtotime($ar['lastLoginDate']));
	$membersince = date('d.m.Y', strtotime($ar['memberSince']));
	$visitors = '';
	if($haslicense === true){
		$ar4 = getQueryResultLoop("SELECT ".
				"a.username, a.farbcode, a.id, b.datum, b.uhrzeit ".
			"FROM ".VISITORS." AS b LEFT JOIN ".REGISTRY." AS a ON b.visitorid = a.id ".
			"WHERE b.userid='".$showid."' AND a.aktiv='1' ".
			"ORDER BY b.id DESC LIMIT 10", 
			'statistics.tpl');
		if($ar4 !== false){
			$tablelines = '';
			foreach($ar4 as $key => $val){
				$tableline = str_replace('{VISITOR}', '<a href="#" onclick="showreg(\''.$val[2].'\');"><span style="color:#'.$val[1].'">'.$val[0].'</span></a>', $visitorline);
				$tableline = str_replace('{VISITDATE}', date('d.m.Y', strtotime($val[3])), $tableline);
				$tableline = str_replace('{VISITTIME}', $val[4], $tableline);
				$tablelines .= $tableline;
			}
			$template->loadTPL('visitors');
			$template->replaceVarTPL('VISITORLINES', $tablelines);
			$visitors .= $template->getTPL();
		}
	}
	$template->setSubTPL('statistics');
	$template->replaceVar('SUB_TITLE', $lang['title']['statistics']);
	$template->replaceVar('OBJECTS', $objects);
	$template->replaceVar('ONLINETIME', $ar['onlinezeit']);
	$template->replaceVar('CHATTIME', $ar['chatzeit']);
	$template->replaceVar('POINTS', $ar['punkte']);
	$template->replaceVar('LASTLOGINTIME', $ar['lastLoginTime']);
	$template->replaceVar('LASTLOGINDATE', $lldate);
	$template->replaceVar('TRANSVOL', $ar['umsatz']);
	$template->replaceVar('THREADS', $ar['forumThemen']);
	$template->replaceVar('ANSWERS', $ar['forumBeitraege']);
	$template->replaceVar('THREADSLOCKED', $ar['forumGesperrt']);
	$template->replaceVar('VISITORSCOUNT', $ar['npcount']);
	$template->replaceVar('MEMBERSINCE', $membersince);
	$template->replaceVar('GBCOUNT', $gbcount);
	$template->replaceVar('PRIVCOUNT', $privcount);
	$template->replaceVar('VISITORS', $visitors);
}
 
?>