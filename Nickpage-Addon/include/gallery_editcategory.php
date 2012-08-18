<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_editcategory.php
 * Author		Steffen Haase
 * Date			05.02.2010
 * License		GPL v3
 */


if($senduid == $showid){
	if($ac == 'save'){
		if(empty($_REQUEST['title'])){
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nocattitle']);
		}else{
			$dummy = executeQuery(
					"UPDATE ".GALCATS." SET ".
						" title='".mysql_real_escape_string(htmlspecialchars($_REQUEST['title'], ENT_QUOTES))."', ".
						" description='".mysql_real_escape_string(htmlspecialchars($_REQUEST['description'], ENT_QUOTES))."' ".
					"WHERE userid='$senduid' AND id='$id'"
					, 'gallery_newcategory.php');
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['gallery']['catsavededit']);
		}
	}else{
		$ar = getQueryResult("SELECT id, title, description FROM ".GALCATS." WHERE userid='".$senduid."' AND id='".$id."'", 'gallery_editcategory.php');
		if($ar !== false){
			$template->setSubTPL('gallery_editcategory');
			$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
			$template->replaceVar('ADDITIONAL', $lang['additional']['galeditcat']);
			$template->replaceVar('CATEGORY_ID', $ar[0]);
			$template->replaceVar('CATEGORY_TITLE', $ar[1]);
			$template->replaceVar('CATEGORY_DESCRIPTION', $ar[2]);
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['unknowcatid']);
		}
	}
}else{
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['notallowed']);
}

?>