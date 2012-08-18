<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_newcategory.php
 * Author		Steffen Haase
 * Date			05.02.2010
 * License		GPL v3
 */

if($senduid == $showid){
	$count = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".GALCATS." WHERE userid='".$senduid."'", 'gallery_newcategory.php');
	if($ac == 'save'){
		if(empty($_REQUEST['title'])){
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nocattitle']);
		}else{
			$dummy = executeQuery(
				"INSERT INTO ".GALCATS.
					" (title, description, userid) ".
				"VALUES (".
					"'".mysql_real_escape_string(htmlspecialchars($_REQUEST['title'], ENT_QUOTES))."', ".
					"'".mysql_real_escape_string(htmlspecialchars($_REQUEST['description'], ENT_QUOTES))."', ".
					"'$senduid'".
				")"
				, 'gallery_newcategory.php');
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['gallery']['catadded']);
		}
	}else{
		$template->setSubTPL('gallery_newcategory');
		$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
		$template->replaceVar('ADDITIONAL', $lang['additional']['galnewcat']);
	}
}else{
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['notallowed']);
}

?>