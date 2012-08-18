<?php
/*
 * Project		Nickpage-Addon
 * Filename		blog_edit.php
 * Author		Steffen Haase
 * Date			31.01.2010
 * License		GPL v3
 */
 
include('include/bbcode.php');
include('include/functions_guestbook.php');
if($ac == 'preview'){
	if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
		$ar_emos = getQueryResultLoop("SELECT quelle, ziel FROM ".EMOS."", 'functions_guestbook.php');
		if ($ar_emos != false && $ar_emos != null) {
			$emoarray = $ar_emos;
		} else {
			$emoarray = false;
		}
		$bbc_tmp = $bbcode->parse($_REQUEST['data']);
   		$bbc_tmp = str_replace('<br />', '<br>', $bbc_tmp);
   		$bbc_tmp = str_replace('[br]', '<br>', $bbc_tmp);
   		$bbc_tmp = str_replace('[BR]', '<br>', $bbc_tmp);
   		$bbc_tmp = replaceAddonEmos($bbc_tmp, $path_server, $path_http, $chathost);
	   	if ($allowjfemos === true) {
   			$bbc_tmp = replaceEmocode($emoarray, $emoprefix, $chathost, $chatport, $bbc_tmp);
   		}
   		$bbc_tmp = YoutubeVideo($BBCode_Youtube, $bbc_tmp);
		$previewdata = str_replace('{CONTENT_PREVIEW}', $bbc_tmp, $lang['blog']['preview']);
		$template->setSubTPL('blog_edit');
		$template->replaceVar('SUB_TITLE', $lang['title']['blog']);
		$template->replaceVar('DATA', $_REQUEST['data']);
		$template->replaceVar('PREVIEW', $previewdata);
		$template->replaceVar('BLOG_ID', $id);
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['noblogdata']);
	}
}elseif($ac == 'save'){
	if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
		$ar = getQueryResult("SELECT userid FROM ".BLOGS." WHERE id='".$id."'", 'blog_edit.php');
		if($ar !== false && ($ar[0] == $senduid || $visitorrights >= $adminrights)){
			if($ar[0] != $senduid && $visitorrights >= $adminrights) {
				$editinfo = str_replace('{DATE}', date('d.m.Y'), $lang['blog']['editinfo']);
				$editinfo = str_replace('{TIME}', date('H:m:s'), $editinfo);
				$editinfo = str_replace('{ADMIN}', $senduid, $editinfo);
			} else{
				$editinfo = 'Bearbeitet am '.getDateTime(0).' um '.getDateTime(1).' Uhr.';
			}
			$dummy = executeQuery(
				"UPDATE ".BLOGS." SET ".
					"content='".mysql_real_escape_string(htmlspecialchars($_REQUEST['data'], ENT_QUOTES))."', ".
					"editinfo='".$editinfo."' ".
					"WHERE id='".$id."'"
					, 'blog_edit.php');
			$message = str_replace('{SHOWID}', $showid, $lang['blog']['entrysaved']);
			$message = str_replace('{SENDUID}', $senduid, $message);
			$message = str_replace('{SID}', $sessionID, $message);
			$message = str_replace('{AUTH}', $auth, $message);
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $message);
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['noblogedit']);
		}
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['noblogdata']);
	}
}else{
	$ar = getQueryResult("SELECT id, content FROM ".BLOGS." WHERE id='".$id."'", 'blog_edit.php');
	if($ar !== false){
		$template->setSubTPL('blog_edit');
		$template->replaceVar('SUB_TITLE', $lang['title']['blog']);
		$template->replaceVar('DATA', $ar[1]);
		$template->replaceVar('BLOG_ID', $ar[0]);
		$template->replaceVar('PREVIEW', '');
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['unknowblogid']);
	}
}

?>