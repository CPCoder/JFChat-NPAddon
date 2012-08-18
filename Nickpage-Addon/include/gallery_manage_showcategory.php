<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_manage_showcategory.php
 * Author		Steffen Haase
 * Date			07.02.2010
 * License		GPL v3
 */
 
if($sc == 'delete'){
	$ar = getQueryResult("SELECT galid, image FROM ".GALIMGS." WHERE userid='$senduid' AND id='".$id."'", 'gallery_manage_showcategory');
	if($ar !== false){
		$image = $path_server.'gallery/'.$ar[1];
		unlink($image);
		$dummy = executeQuery("DELETE FROM ".GALIMGS." WHERE userid='$senduid' AND id='".$id."'", 'gallery_manage_showcategory');
		$id = $ar[0];
	}
}
$ar = getQueryResultLoop(
		"SELECT id, title, image, locked ".
		"FROM ".GALIMGS.
		" WHERE galid='$id' AND userid='$senduid' ORDER BY id"
		, 'gallery_manage_showcategory.php');
if($ar !== false){
	$grid = '';
	$template->setSubTPL('gallery_manage_showcategory');
	foreach($ar as $key => $val){
		$img = $path_server.'gallery/'.$val[2];
		$img_http = 'http://'.$chathost.$path_http.'gallery/'.$val[2];
		list($width, $height) = getimagesize($img);
		if($width > $height) $size = ' width="100"';
		if($height > $width) $size = ' height="100"';
		if ($acc_mode === true && $val[3] == '1') {
			$locked = "\n".$lang['gallery']['locked'];
		} else {
			$locked = '';
		}
		$dellink = '<a href="{INSTALL}nickpage.php?site=gallery&amp;subsite=manage&amp;ac=showcategory'.
					'&amp;sc=delete&amp;showid={SHOWID}&amp;senduid={SENDUID}&amp;auth={AUTH}&amp;sid={SID}&amp;id='.$val[0].'">L&ouml;schen</a>';
		$image = '<a href="'.$img_http.'" rel="lytebox[vacation]" title="'.$val[1].'">'.
					'<img src="'.$img_http.'"'.$size.' border="0" alt="'.$val[1].'" title="'.$val[1].'"></a>';
		$image = "\n<li>\n<div class=\"galimage\">".$image.$locked."\n".$dellink."</div>\n</li>";
		$grid .= $image;
	}
	$template->replaceVar('CATEGORY_IMAGES', $grid);
	$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
	$template->replaceVar('ADDITIONAL', $lang['additional']['galmanage']);
}

?>