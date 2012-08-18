<?php
/*
 * Project		Nickpage-Addon
 * Filename		blog.php
 * Author		Steffen Haase
 * Date			30.01.2010
 * License		GPL v3
 */

if($subsite == 'newentry'){
	if($senduid == $showid){
		include('include/blog_newentry.php');
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['noblogentry']);
	}
}elseif($subsite == 'edit'){
	if($senduid == $showid || $visitorrights >= $adminrights){
		include('include/blog_edit.php');
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['noblogedit']);
	}
}else{
	if($ac == 'delete'){
		if($showid == $senduid || $visitorrights >= $adminrights){
			if($id != 'null'){
				$dummy = executeQuery("DELETE FROM ".BLOGS." WHERE id='".$id."'", 'blog.php');
				$countblog = getQueryResultCount(
					"SELECT COUNT(*) AS menge ".
					"FROM ".BLOGS." WHERE userid='".$showid."'",
					'blog.php');
				if($countblog !== false){
					$SitesComplete = ceil($countblog / MAX_ENTRIES_BLOG);
					if($page > $SitesComplete) $page = $SitesComplete;
				}
			}else{
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['unknowblogid']);
			}
		}
	}
	if($page == 0) $page = 1;
	$start = $page * MAX_ENTRIES_BLOG - MAX_ENTRIES_BLOG;
	$ar = getQueryResultLoop(
		"SELECT ".
			"id, date, time, content, editinfo ".
		"FROM ".BLOGS." WHERE userid='".$showid."' ".
		"ORDER BY id DESC LIMIT ".$start.", ".MAX_ENTRIES_BLOG."",
		'blog.php');
	$countblog = getQueryResultCount(
		"SELECT COUNT(*) AS menge ".
		"FROM ".BLOGS." WHERE userid='".$showid."'",
		'blog.php');
	if($countblog !== false){
		include('include/bbcode.php');
		include('include/functions_guestbook.php');
		$ar_emos = getQueryResultLoop("SELECT quelle, ziel FROM ".EMOS."", 'functions_guestbook.php');
		if ($ar_emos != false && $ar_emos != null) {
			$emoarray = $ar_emos;
		} else {
			$emoarray = false;
		}
		$SitesComplete = ceil($countblog / MAX_ENTRIES_BLOG);
		if($SitesComplete > 1){
			$out1 = $lang['blog']['entries'];
			$out2 = $lang['blog']['sites'];
		}else{
			if($countblog > 1) $out1 = $lang['blog']['entries'];
			else $out1 = $lang['blog']['entry'];
			$out2 = $lang['blog']['site'];
		}
		$SiteLinks = $lang['blog']['entriesinfo'];
		$SiteLinks = str_replace('{COUNT_ENTRIES}', $countblog, $SiteLinks);
		$SiteLinks = str_replace('{COUNT_SITES}', $SitesComplete, $SiteLinks);
		$SiteLinks = str_replace('{ENTRIES}', $out1, $SiteLinks);
		$SiteLinks = str_replace('{SITES}', $out2, $SiteLinks);
		$extVariables = 'site=blog&amp;sid='.$sessionID.'&amp;senduid='.$senduid.'&amp;showid='.$showid.'&amp;auth='.$auth;
		$SiteLinks .= Navigation($SitesComplete,$page,$extVariables);
		if($ar !== false){
			$bloglist = '';
			$template->setSubTPL('blog');
			$template->replaceVar('SITECACHE', '<meta http-equiv="cache-control" content="no-cache">');
			$template->replaceVar('SUB_TITLE', $lang['title']['blog']);
			foreach($ar as $key){
				$tmp = $template->loadTPL('blog_entry');
				$gbdate = date('d.m.Y', strtotime($key[1]));
				$bbc_tmp = str_replace('[BEGINCOMMENT]', '[COMMENT]', $key[3]);
				$bbc_tmp = str_replace('[ENDCOMMENT]', '[/COMMENT]', $bbc_tmp);
				$bbc_tmp = $bbcode->parse($bbc_tmp);
				$bbc_tmp = str_replace('<br />', '<br>', $bbc_tmp);
				$bbc_tmp = str_replace('[br]', '<br>', $bbc_tmp);
				$bbc_tmp = str_replace('[BR]', '<br>', $bbc_tmp);
				$bbc_tmp = replaceUnicode($bbc_tmp);
			   	if ($allowjfemos === true) {
   					$bbc_tmp = replaceEmocode($emoarray, $emoprefix, $chathost, $chatport, $bbc_tmp);
   				}
				$bbc_tmp = replaceAddonEmos($bbc_tmp, $path_server, $path_http, $chathost);
				$bbc_tmp = YoutubeVideo($BBCode_Youtube, $bbc_tmp);
				if($key[4] != '' && strstr($key[4], '<userid>')){
					$adminid_pos1 = strpos($key[4], '<userid>')+8;  
					$adminid_pos2 = strpos($key[4],'</userid>');
					$adminid_len = $adminid_pos2 - $adminid_pos1;  
					$adminid = trim(substr($key[4], $adminid_pos1, $adminid_len));
					$editinfo = str_replace('<userid>'.$adminid.'</userid>', getUsername($adminid), $key[4]);
					$editinfo = '<br><br><div class="editinfo">'.$editinfo.'</div>';
				}elseif($key[4] != '' && !strstr($key[4], '<userid>')){
					$editinfo = '<br><br><div class="editinfo">'.$key[4].'</div>';
				}else{
					$editinfo = '';
				}
				$template->replaceVarTPL('BLOG_TEXT', $bbc_tmp.$editinfo);
				$template->replaceVarTPL('BLOG_DATE', $gbdate);
				$template->replaceVarTPL('BLOG_TIME', $key[2]);
				if($senduid == $showid){
					$template->replaceVarTPL('BLOG_DELETE', $lang['blog']['deletelink']);
					$template->replaceVarTPL('BLOG_EDIT', $lang['blog']['editlink']);
				}elseif($visitorrights >= $adminrights){
					$template->replaceVarTPL('BLOG_DELETE', $lang['blog']['deletelink']);
					$template->replaceVarTPL('BLOG_EDIT', $lang['blog']['editlink']);
				}else{
					$template->replaceVarTPL('BLOG_DELETE', '');
					$template->replaceVarTPL('BLOG_EDIT', '');
				}
				$template->replaceVarTPL('BLOG_ID', $key[0]);
				$bloglist .= $template->getTPL();
			}
			if($countblog > 0){
				$template->replaceVar('ENTRIES', $bloglist);
				$template->replaceVar('SITENAVIGATION', $SiteLinks);
			}else{
				$template->replaceVar('ENTRIES', $lang['error']['noblogentries']);
				$template->replaceVar('SITENAVIGATION', '');
			}
		}
	}
	if($senduid == $showid) $template->replaceVar('NEW_ENTRY_LINK', $lang['blog']['newentrylink']);
	else $template->replaceVar('NEW_ENTRY_LINK', '');
}

?>