<?php
/*
 * Project		Nickpage-Addon
 * Filename		blog_newentry.php
 * Author		Steffen Haase
 * Date			30.01.2010
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
		$template->setSubTPL('blog_newentry');
		$template->replaceVar('SUB_TITLE', $lang['title']['blog']);
		$template->replaceVar('DATA', $_REQUEST['data']);
		$template->replaceVar('PREVIEW', $previewdata);
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['noblogdata']);
	}
}elseif($ac == 'save'){
	if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
		$dummy = executeQuery(
				"INSERT INTO ".BLOGS.
					" (userid, date, time, content) ".
				"VALUES(".
					"'$senduid', ".
					"'".date('y-m-d')."', ".
					"'".date('H:i:s')."', ".
					"'".mysql_real_escape_string(htmlspecialchars($_REQUEST['data'], ENT_QUOTES))."')"
					, 'blog_newentry.php');
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
		$template->replaceVar('MESSAGE', $lang['error']['noblogdata']);
	}
}else{
	$template->setSubTPL('blog_newentry');
	$template->replaceVar('SUB_TITLE', $lang['title']['blog']);
	$template->replaceVar('DATA', '');
	$template->replaceVar('PREVIEW', '');
}

?>