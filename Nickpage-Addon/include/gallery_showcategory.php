<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_showcategory.php
 * Author		Steffen Haase
 * Date			07.02.2010
 * License		GPL v3
 */

$ar = getQueryResultLoop(
		"SELECT title, image ".
		"FROM ".GALIMGS.
		" WHERE galid='".$id."' AND locked='0' AND userid='".$showid."' ORDER BY id"
		, 'gallery_showcategory.php');
if($ar !== false){
	$grid = '';
	$template->setSubTPL('gallery_showcategory');
	foreach($ar as $key => $val){
		$img = $path_server.'gallery/'.$val[1];
		$img_http = 'http://'.$chathost.$path_http.'gallery/'.$val[1];
		list($width, $height) = getimagesize($img);
		if($width > $height) $size = ' width="100"';
		if($height > $width) $size = ' height="100"';
		$image = '<a href="'.$img_http.'" rel="lytebox[vacation]" title="'.$val[0].'">'.
					'<img src="'.$img_http.'"'.$size.' border="0" alt="'.$val[0].'" title="'.$val[0].'"></a>';
		$image = "\n<li>\n<div class=\"galimage\">".$image."</div>\n</li>";
		$grid .= $image;
	}
	$template->replaceVar('CATEGORY_IMAGES', $grid);
	$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
}

?>