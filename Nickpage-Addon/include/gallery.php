<?php

/*
 * Project		Nickpage-Addon
 * Filename		gallery.php
 * Author		Steffen Haase
 * Date			30.01.2010
 * License		GPL v3
 */

$manage_link = '';
include('include/functions_gallery.php');
if($subsite == 'upload'){
	include('include/gallery_upload.php');
}elseif($subsite == 'newcategory'){
	include('include/gallery_newcategory.php');
}elseif($subsite == 'manage'){
	include('include/gallery_manage.php');
}elseif($subsite == 'editcategory'){
	include('include/gallery_editcategory.php');
}elseif($subsite == 'showcategory'){
	include('include/gallery_showcategory.php');
}else{
	$categories = '';
	$noimageflag = true;
	$cats = 0;
	$ar = getQueryResultLoop("SELECT id, title, description FROM ".GALCATS." WHERE userid='".$showid."'", 'gallery.php');
	if($ar !== false && !empty($ar[0])){
		foreach($ar as $key){
			$catcount = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".GALIMGS." WHERE userid='".$showid."' AND galid='".$key[0]."'", 'gallery.php');
			$ar2 = getQueryResult("SELECT image FROM ".GALIMGS." WHERE userid='".$showid."' AND locked='0' AND galid='".$key[0]."' ORDER BY id LIMIT 1", 'gallery.php');
			if($ar2 !== false){
				$img = $path_server.'gallery/'.$ar2[0];
				$info = getimagesize($img);
				if($info[0] > $info[1]) $size = ' width="100"';
				elseif($info[1] > $info[0]) $size = ' height="100"';
				else $size = ' width="100" height="100"';
				$preview = '<img src="{INSTALL}gallery/'.$ar2[0].'" border="0"'.$size.'>';
				$noimageflag = false;
				$template->loadTPL('gallery_category');
				$template->replaceVarTPL('PREVIEWIMAGE', $preview);
				$template->replaceVarTPL('CATEGORY_ID', $key[0]);
				$template->replaceVarTPL('CATEGORY_TITLE', $key[1]);
				$template->replaceVarTPL('CATEGORY_DESCRIPTION', $key[2]);
				$template->replaceVarTPL('CATEGORY_COUNT', $catcount);
				$categories .= $template->getTPL();
			}
			$cats++;
		}
	}
	if($noimageflag === true) $categories = $lang['error']['noimages'];
	if($senduid == $showid) $manage_link = $lang['gallery']['managelink'];
	$template->setSubTPL('gallery');
	$template->replaceVar('SITECACHE', '<meta http-equiv="cache-control" content="no-cache">');
	$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
	$template->replaceVar('MANAGE_LINK', $manage_link);
	$template->replaceVar('CATEGORIES', $categories);
	
}

?>