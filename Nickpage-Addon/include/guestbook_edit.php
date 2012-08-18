<?php

/*
 * Project		Nickpage-Addon
 * Filename		guestbook_edit.php
 * Language		PHP
 * Author		Steffen Haase <info@sh.software.de>
 * License		GPL v3
 */
 
include('include/bbcode.php');
include('include/functions_guestbook.php');

if($ac == 'preview'){
	if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
		$ar = getQueryResult("SELECT a.absenderid, a.kommentar, b.username FROM ".GUESTBOOKS." AS a LEFT JOIN ".REGISTRY." AS b ON a.absenderid=b.id WHERE a.id='$id'", 'guestbook_comment.php');
		if($ar !== false){
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
			$previewdata = str_replace('{CONTENT_PREVIEW}', $bbc_tmp, $lang['guestbook']['preview']);
			$template->setSubTPL('guestbook_edit');
			$template->replaceVar('GB_ID', $id);
			$template->replaceVar('GB_POSTER', $ar[2]);
			$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
			$template->replaceVar('ADDITIONAL', $lang['additional']['gbedit']);
			$template->replaceVar('DATA', $_REQUEST['data']);
			$template->replaceVar('PREVIEW', $previewdata);
		}
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['nogbdata']);
	}
}elseif($ac == 'save'){
	if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
		$editinfo = str_replace('{DATE}', date('d.m.Y'), $lang['guestbook']['editinfo']);
		$editinfo = str_replace('{TIME}', date('H:m:s'), $editinfo);
		$editinfo = str_replace('{ADMIN}', $senduid, $editinfo);
		$dummy = executeQuery("
							UPDATE
								".GUESTBOOKS." 
							SET 
								kommentar='".mysql_real_escape_string(htmlspecialchars($_REQUEST['data'], ENT_QUOTES))."', 
								editinfo='".mysql_real_escape_string($editinfo)."' 
							WHERE
								id='".$id."'
							", 'guestbook_edit.php');
		$message = str_replace('{SHOWID}', $showid, $lang['guestbook']['entrysaved']);
		$message = str_replace('{SENDUID}', $senduid, $message);
		$message = str_replace('{SID}', $sessionID, $message);
		$message = str_replace('{AUTH}', $auth, $message);
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $message);
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['nogbdata']);
	}
}else{
	$ar = getQueryResult("SELECT a.absenderid, a.kommentar, b.username FROM ".GUESTBOOKS." AS a LEFT JOIN ".REGISTRY." AS b ON a.absenderid=b.id WHERE a.id='$id'", 'guestbook_comment.php');
	if($ar !== false){
		$template->setSubTPL('guestbook_edit');
		$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
		$template->replaceVar('ADDITIONAL', $lang['additional']['gbedit']);
		$template->replaceVar('GB_ID', $id);
		$template->replaceVar('DATA', $ar[1]);
		$template->replaceVar('GB_POSTER', $ar[2]);
		$template->replaceVar('PREVIEW', '');
	}
}

?>