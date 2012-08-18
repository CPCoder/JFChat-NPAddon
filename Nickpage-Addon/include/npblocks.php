<?php
/*
 * Project		Nickpage-Addon
 * Filename		gbblocks.php
 * Author		Steffen Haase
 * Date			06.03.2010
 * License		GPL v3
 */
 
$blocklist = '';
$errormsg = '';

if($ac == 'addblock'){
	if(isset($_REQUEST['username']) && $_REQUEST['username'] != ''){
		if(($blockid = existsUser($_REQUEST['username'])) !== false){
			if($blockid == $senduid){
				$errormsg = $lang['error']['noselfblock'];
			}else{
				if(($ur = getUserRights($blockid) >= $adminrights)){
					$errormsg = $lang['error']['noadminblock'];
				}else{
					$result = getQueryResult(
						"SELECT ".
							"userid ".
						"FROM ".NPBLOCKS." ".
						"WHERE ".
							"userid='".$senduid."' AND blockid='".$blockid."'"
						, 'npblocks.php');
					if($result === false){
						$dummy = executeQuery(
							"INSERT INTO ".NPBLOCKS." ".
								"(userid, blockid) ".
							"VALUES(".
								"'".$senduid."', ".
								"'".$blockid."'".
							")"
							, 'npblocks.php');
					}else{
						$errormsg = $lang['error']['hasblock'];
					}
				}
			}
		}else{
			$errormsg = str_replace('{USERNAME}', $_REQUEST['username'], $lang['error']['unknowuser']);
		}
	}else{
		$errormsg = $lang['error']['nonamegiven'];
	}
}
if($ac == 'delblock'){
	$dummy = executeQuery("DELETE FROM ".NPBLOCKS." WHERE userid='".$senduid."' AND blockid='".$id."'", 'npblocks.php');
}
$ar = getQueryResultLoop(
		"SELECT ".
			"b.blockid, a.username, a.farbcode ".
		"FROM ".NPBLOCKS." AS b LEFT JOIN ".REGISTRY." AS a ".
		"ON b.blockid = a.id ".
		"WHERE b.userid='".$senduid."' AND a.aktiv='1' ".
		"ORDER BY a.username"
		, 'gbblocks.php');
$count = getQueryResultCount(
		"SELECT COUNT(*) AS menge ".
		"FROM ".NPBLOCKS." AS b LEFT JOIN ".REGISTRY." AS a ".
		"ON b.blockid = a.id ".
		"WHERE b.userid='".$senduid."' AND a.aktiv='1' "
		, 'gbblocks.php');
if($ar !== false){
	foreach($ar as $key){
		$user = '<font color="#'.$key[2].'">'.$key[1].'</font>';
		$blocklist .= '<a href="nickpage.php?site=npblocks&amp;sid='.$sessionID.'&amp;senduid='.$senduid.
						'&amp;showid='.$showid.'&amp;auth='.$auth.'&amp;id='.$key[0].'&amp;ac=delblock">'.
						'<img src="http://'.$chathost.$path_http.'style/gfx/delete.gif" border="0">'.$user.'</a><br>';
	}
}

$template->setSubTPL('npblocks');
$template->replaceVar('BLOCKLIST', $blocklist);
$template->replaceVar('BLOCKCOUNT', $count);
$template->replaceVar('SUB_TITLE', $lang['title']['npblocks']);
$template->replaceVar('ERRORMESSAGE', $errormsg);

?>