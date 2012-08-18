<?php
/*
 * Project		Nickpage-Addon
 * Filename		gallery_upload.php
 * Author		Steffen Haase
 * Date			30.01.2010
 * License		GPL v3
 */
 
if($senduid == $showid){
	if(haveCategory($senduid)){
		if($ac == 'save'){
			if(empty($_REQUEST['title'])) $title = '';
			if(empty($_FILES['image']['name'])){
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['noimagefile']);
			}elseif($_REQUEST['id'] == '0'){
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['takeacat']);
			}else{
				if($_FILES['image']['error'] === UPLOAD_ERR_OK){
					list($width, $height, $type) = getimagesize($_FILES['image']['tmp_name']);
					if($width > $gal_max_width || $height > $gal_max_height){
						$template->setSubTPL('sysmessage');
						$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
						$template->replaceVar('MESSAGE', $lang['error']['imagemaxsize']);
					}else{
						$savefile = $senduid.'_'.$id.'_'.time().'.jpg';
						$savepath = $path_server.'gallery/'.$savefile;
						if($type != 1 && $type != 2 && $type != 3){
							$template->setSubTPL('sysmessage');
							$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
							$template->replaceVar('MESSAGE', $lang['error']['wrongtype']);
						}else{
							$count = getQueryResultCount("SELECT userid FROM ".GALIMGS." WHERE galid='".$id."'", 'gallery_upload.php');
							if($count === false){
								$count = 0;
							}
							if($count >= $gal_max_images){
								$template->setSubTPL('sysmessage');
								$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
								$template->replaceVar('MESSAGE', $lang['error']['maximgcount']);
							}else{
								if($type == 1) $src_img = imagecreatefromgif($_FILES['image']['tmp_name']);
								if($type == 2) $src_img = imagecreatefromjpeg($_FILES['image']['tmp_name']);
								if($type == 3) $src_img = imagecreatefrompng($_FILES['image']['tmp_name']);
								$dst_img = imagecreatetruecolor($width,$height);
								imagecopyresampled($dst_img,$src_img,0,0,0,0,$width,$height,$width,$height);
								if(imagejpeg($dst_img,$savepath) !== false){
									if ($acc_mode === true) {
										$locked = 1;
									} else {
										$locked = 0;
									}
									$dummy = executeQuery(
										"INSERT INTO ".GALIMGS.
											" (galid, userid, title, image, locked) ".
										"VALUES (".
											"'$id', ".
											"'$senduid', ".
											"'".mysql_real_escape_string($_REQUEST['title'])."', ".
											"'$savefile', ".
											"'$locked')"
										, 'gallery_upload.php');
									chmod($savepath, 0744);
									$template->setSubTPL('sysmessage');
									$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
									$template->replaceVar('MESSAGE', $lang['gallery']['imagesaved']);
								}else{
									$template->setSubTPL('sysmessage');
									$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
									$template->replaceVar('MESSAGE', $lang['error']['imgcantsave']);
								}
								imagedestroy($dst_img); 
							}
						}
					}
				}else{
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', file_upload_error_message($_FILES['file']['error']));
				}
			}
		}else{
			if ($acc_mode === true) {
				$terms = $lang['gallery']['terms'];
			} else {
				$terms = '';
			}
			$category_list = buildCategoryList($senduid);
			$template->setSubTPL('gallery_upload');
			$template->replaceVar('SUB_TITLE', $lang['title']['gallery']);
			$template->replaceVar('ADDITIONAL', $lang['additional']['galupload']);
			$template->replaceVar('CATEGORYLIST', $category_list);
			$template->replaceVar('TERMS', $terms);
		}
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['hasnokat']);
	}
}else{
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['notallowed']);
}

?>