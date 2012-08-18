<?php
/*
 * Project		Nickpage-Addon
 * Filename		guestbook_newentry.php
 * Author		Steffen Haase
 * Date			17.01.2010
 * License		GPL v3
 */
 
include('include/bbcode.php');
include('include/functions_guestbook.php');
if($haslicense === true){
	$signcount = 'ub';
}
$minutes = 999999999999;
$ar = getQueryResult("SELECT datum, uhrzeit FROM ".GUESTBOOKS." WHERE absenderid='".$senduid."' ORDER BY id DESC LIMIT 1", 'guestbook_newentry.php');
if($ar !== false){
	$time = time();
	$datetime = strtotime($ar[0].' '.$ar[1]);
	$seconds = $time - $datetime;
	$minutes = round($seconds / 60);
}
if($minutes < $gbfloodmin){
	$message = str_replace('{FLOODMINUTES}', $gbfloodmin, $lang['error']['floodmsg']);
	$message = str_replace('{LASTENTRYMINUTES}', $minutes, $message);
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $message);
}else{
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
   			$previewdata = str_replace('{CONTENT_PREVIEW}', $bbc_tmp, $lang['guestbook']['preview']);
			$template->setSubTPL('guestbook_newentry');
			$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
			$template->replaceVar('DATA', $_REQUEST['data']);
			$template->replaceVar('PREVIEW', $previewdata);
			if(isset($_REQUEST['private']) && $_REQUEST['private'] == '1')
				$template->replaceVar('CHECKED', ' checked');
			else
				$template->replaceVar('CHECKED', '');
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nogbdata']);
		}
		$template->replaceVar('ONLOAD', ' onload="checkSignCount(\'data\');"');
		$template->replaceVar('MAXSIGNS', $signcount);
	}elseif($ac == 'save'){
		if(isset($_REQUEST['data']) && $_REQUEST['data'] != ''){
			if(isset($_REQUEST['private']) && $_REQUEST['private'] == '1')
				$private = '1';
			else
				$private = '0';
			if ($haslicense === false) {
				$data = substr($_REQUEST['data'], 0, $signcount);
			} else {
				$data = $_REQUEST['data'];
			}
			$dummy = executeQuery(
					"INSERT INTO ".GUESTBOOKS.
						"(kommentar, datum, uhrzeit, ip, isPrivate, userid, absenderid) ".
					"VALUES(".
						"'".mysql_real_escape_string(htmlspecialchars($data, ENT_QUOTES))."', ".
						"'".date('y-m-d')."', ".
						"'".date('H:i:s')."', ".
						"'".$userip."', ".
						"'".$private."', ".
						"'".$showid."', ".
						"'".$senduid."'".
					")", 'guestbook_newentry.php');
			$dummy = executeQuery("UPDATE ".REGISTRY." SET punkte=punkte+".$gbpoints." WHERE id='".$senduid."'", 'guestbook_newentry.php');
			$dummy = executeQuery("UPDATE ".REGISTRY." SET gbCount=gbCount+1 WHERE id='".$showid."'", 'guestbook_newentry.php');
			$dummy = executeQuery("UPDATE ".REGISTRY." SET gbWriteCount=gbWriteCount+1 WHERE id='".$senduid."'", 'guestbook_newentry.php');
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
		$template->setSubTPL('guestbook_newentry');
		$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
		$template->replaceVar('DATA', '');
		$template->replaceVar('PREVIEW', '');
		$template->replaceVar('CHECKED', '');
		$template->replaceVar('ONLOAD', ' onload="checkSignCount(\'data\');"');
		$template->replaceVar('MAXSIGNS', $signcount);
	}
	if($gb_allow_img_and_url === true) $template->replaceVar('ALLOWIMGURL', 'true');
	else $template->replaceVar('ALLOWIMGURL', 'false');
}

?>