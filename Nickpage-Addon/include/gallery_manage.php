<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_manage.php
 * Author		Steffen Haase
 * Date			05.02.2010
 * License		GPL v3
 */

if($senduid == $showid){
	if($ac == 'delete'){
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['gallery']['deletecatquest']);
		$template->replaceVar('ADDITIONAL', '');
		$template->replaceVar('CATEGORY_ID', $id);
	}
	if($ac == 'deletecat'){
		$ar = getQueryResultLoop("SELECT image FROM ".GALIMGS." WHERE userid='$senduid' AND galid='".$id."'", 'gallery_manage.php');
		if($ar !== false){
			foreach($ar as $key){
				$delimg = $path_server.'gallery/'.$key[0];
				echo 'Delete: '.$delimage.'<br>';
				unlink($delimg);
			}
		}
		$dummy = executeQuery("DELETE FROM ".GALIMGS." WHERE userid='$senduid' AND galid='".$id."'", 'gallery_manage.php');
		$dummy = executeQuery("DELETE FROM ".GALCATS." WHERE userid='$senduid' AND id='".$id."'", 'gallery_manage.php');
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['gallery']['catdeleted']);
		$template->replaceVar('ADDITIONAL', '');
	}
	if($ac == 'showcategory'){
		include('include/gallery_manage_showcategory.php');
	}else{
		if(haveCategory($senduid)){
			$categories = '';
			$catcount = 0;
			$ar = getQueryResultLoop("SELECT id, title, description FROM ".GALCATS." WHERE userid='".$showid."'", 'gallery_manage.php');
			if($ar !== false && !empty($ar[0])){
				foreach($ar as $key){
					$count = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".GALIMGS." WHERE userid='".$showid."' AND galid='".$key[0]."'", 'gallery_manage.php');
					$ar2 = getQueryResult("SELECT image FROM ".GALIMGS." WHERE userid='".$showid."' AND galid='".$key[0]."' ORDER BY id LIMIT 1", 'gallery_manage.php');
					if($ar2 !== false){
						$img = $path_server.'gallery/'.$ar2[0];
						$info = getimagesize($img);
						if($info[0] > $info[1]) $size = ' width="100"';
						elseif($info[1] > $info[0]) $size = ' height="100"';
						else $size = ' width="100" height="100"';
						$preview = '<img src="{INSTALL}gallery/'.$ar2[0].'" border="0"'.$size.'>';
					}else{
						$preview = 'NO IMAGES';
					}
					$template->loadTPL('gallery_manage_category');
					$template->replaceVarTPL('PREVIEWIMAGE', $preview);
					$template->replaceVarTPL('CATEGORY_ID', $key[0]);
					$template->replaceVarTPL('CATEGORY_TITLE', $key[1]);
					$template->replaceVarTPL('CATEGORY_DESCRIPTION', $key[2]);
					$template->replaceVarTPL('CATEGORY_COUNT', $count);
					$categories .= $template->getTPL();
					$catcount++;
				}
			}else{
				$categories = $lang['error']['noimages'];
			}
			$template->setSubTPL('gallery_manage');
			$template->replaceVar('SITECACHE', '<meta http-equiv="cache-control" content="no-cache">');
			$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
			$template->replaceVar('ADDITIONAL', $lang['additional']['galmanage']);
			$template->replaceVar('CATEGORIES', $categories);
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['hasnokat']);
		}
	}
}else{
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['notallowed']);
}

 
?>