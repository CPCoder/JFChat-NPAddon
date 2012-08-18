<?php
/*
 * Project		Nickpage-Addon
 * Filename		friends.php
 * Author		Steffen Haase
 * Date			17.01.2010
 * License		GPL v3
 */
 
$friends = '';
$i = 0;
$ar = getQueryResultLoop("SELECT a.username, a.farbcode, a.id ".
		"FROM ".FRIENDS." AS b LEFT JOIN ".REGISTRY." AS a ON b.friendid = a.id ".
		"WHERE b.userid='".$showid."' AND a.aktiv='1' ". 
		"ORDER BY a.username", 'friends.php');
if($ar !== false){
	foreach($ar as $key => $val){
		if($val[2] != $showid){
			if($i>0)
				$friends .= ', <a href="#" onclick="showreg(\''.$val[2].'\');"><span style="color:#'.$val[1].'">'.$val[0].'</span></a>';
			else
				$friends .= '<a href="#" onclick="showreg(\''.$val[2].'\');"><span style="color:#'.$val[1].'">'.$val[0].'</span></a>';
			$i++;
		}
	}
	$template->setSubTPL('friends');
	$template->replaceVar('SUB_TITLE', $lang['title']['friends']);
	if($friends != ''){
		$template->replaceVar('FRIENDS', $friends);
	}else{
		$template->replaceVar('FRIENDS', $lang['error']['nofriends']);
	}
}

?>