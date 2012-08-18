<?php
/*
 * Project		Nickpage-Addon
 * Filename		guestbook.php
 * Author		Steffen Haase
 * Date			17.01.2010
 * License		GPL v3
 */

if($npuser_gblock == '1'){
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['gbislocked']);
}else{
	if($senduid == $showid) setGbLastVisit($senduid);
	if($subsite == 'newentry'){
		if($senduid != $showid){
			include('include/guestbook_newentry.php');
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['noselfentry']);
		}
	}elseif($subsite == 'comment'){
		if($senduid == $showid){
			if($id != 'null'){
				include('include/guestbook_comment.php');
			}else{
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['unknowgbid']);
			}
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nocomment']);
		}
	}elseif($subsite == 'edit'){
		if($visitorrights >= $adminrights){
			if($id != 'null'){
				include('include/guestbook_edit.php');
			}else{
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['unknowgbid']);
			}
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nocomment']);
		}
	}else{
		if($ac == 'delete'){
			if($showid == $senduid || $visitorrights >= $adminrights){
				if($id != 'null'){
					$dummy = executeQuery("DELETE FROM ".GUESTBOOKS." WHERE id='".$id."'", 'guestbook.php');
					$dummy = executeQuery("UPDATE ".REGISTRY." SET gbCount=gbCount-1 WHERE id='".$showid."'", 'guestbook.php');
					$countgb = getQueryResultCount(
						"SELECT COUNT(*) AS menge ".
						"FROM ".GUESTBOOKS." AS b LEFT JOIN ".REGISTRY." AS a ".
						"ON b.absenderid = a.id ".
						"WHERE b.userid='$showid' AND a.aktiv='1' ",
						'guestbook.php');
					if($countgb !== false){
						$SitesComplete = ceil($countgb / MAX_ENTRIES_GUESTBOOK);
						if($page > $SitesComplete) $page = $SitesComplete;
					}
				}else{
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['unknowgbid']);
				}
			}
		}
		if($ac == 'switch'){
			if($showid == $senduid && $id != 'null'){
				$ar = getQueryResult("SELECT isPrivate FROM ".GUESTBOOKS." WHERE id='".$id."'", 'guestbook.php');
				if($ar !== false){
					if($ar[0] == '0') $dummy = executeQuery("UPDATE ".GUESTBOOKS." SET isPrivate='1' WHERE id='".$id."'", 'guestbook.php');
					else $dummy = executeQuery("UPDATE ".GUESTBOOKS." SET isPrivate='0' WHERE id='".$id."'", 'guestbook.php');
				}
			}
		}
		if($page == 0) $page = 1;
		$start = $page * MAX_ENTRIES_GUESTBOOK - MAX_ENTRIES_GUESTBOOK;
		if($gb_show_all_entries === false) $addSQL = " AND a.aktiv='1'";
		else $addSQL = "";
		$ar = getQueryResultLoop(
			"SELECT ".
				"b.id, b.kommentar, b.datum, b.uhrzeit, b.isPrivate, b.absenderid, b.editinfo, ".
				"a.username, a.geschlecht, a.isOnline, a.bild, a.avatar, a.aktiv ".
			"FROM ".GUESTBOOKS." AS b LEFT JOIN ".REGISTRY." AS a ".
			"ON b.absenderid = a.id ".
			"WHERE b.userid='".$showid."'".$addSQL." ".
			"ORDER BY b.id DESC LIMIT $start, ".MAX_ENTRIES_GUESTBOOK."",
			'guestbook.php');
		$countgb = getQueryResultCount(
			"SELECT COUNT(*) AS menge ".
			"FROM ".GUESTBOOKS." AS b LEFT JOIN ".REGISTRY." AS a ".
			"ON b.absenderid = a.id ".
			"WHERE b.userid='".$showid."'".$addSQL."",
			'guestbook.php');
		if($countgb !== false){
			include('include/bbcode.php');
			include('include/functions_guestbook.php');
			$ar_emos = getQueryResultLoop("SELECT quelle, ziel FROM ".EMOS."", 'functions_guestbook.php');
			if ($ar_emos != false && $ar_emos != null) {
				$emoarray = $ar_emos;
			} else {
				$emoarray = false;
			}
			$SitesComplete = ceil($countgb / MAX_ENTRIES_GUESTBOOK);
			if($SitesComplete > 1){
				$out1 = $lang['guestbook']['entries'];
				$out2 = $lang['guestbook']['sites'];
			}else{
				if($countgb > 1) $out1 = $lang['guestbook']['entries'];
				else $out1 = $lang['guestbook']['entry'];
				$out2 = $lang['guestbook']['site'];
			}
			$SiteLinks = $lang['guestbook']['entriesinfo'];
			$SiteLinks = str_replace('{COUNT_ENTRIES}', $countgb, $SiteLinks);
			$SiteLinks = str_replace('{COUNT_SITES}', $SitesComplete, $SiteLinks);
			$SiteLinks = str_replace('{ENTRIES}', $out1, $SiteLinks);
			$SiteLinks = str_replace('{SITES}', $out2, $SiteLinks);
			$extVariables = 'site=guestbook&amp;sid='.$sessionID.'&amp;senduid='.$senduid.'&amp;showid='.$showid.'&amp;auth='.$auth;
			$SiteLinks .= Navigation($SitesComplete,$page,$extVariables);
			if($ar !== false){
				$gblist = '';
				$template->setSubTPL('guestbook');
				$template->replaceVar('SITECACHE', '<meta http-equiv="cache-control" content="no-cache">');
				$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
				foreach($ar as $key){
					$tmp = $template->loadTPL('guestbook_entry');
					$gbdate = date('d.m.Y', strtotime($key[2]));
					if($key[6] != ''){
						$adminid_pos1 = strpos($key[6], '<userid>')+8;  
						$adminid_pos2 = strpos($key[6],'</userid>');
						$adminid_len = $adminid_pos2 - $adminid_pos1;  
						$adminid = trim(substr($key[6], $adminid_pos1, $adminid_len));
						$editinfo = str_replace('<userid>'.$adminid.'</userid>', getUsername($adminid), $key[6]);
						$editinfo = '<br><br><div class="editinfo">'.$editinfo.'</div>';
					}else{
						$editinfo = '';
					}
					$bbc_tmp = str_replace('[BEGINCOMMENT]', '[COMMENT]', $key[1]);
					$bbc_tmp = str_replace('[ENDCOMMENT]', '[/COMMENT]', $bbc_tmp);
   					$bbc_tmp = $bbcode->parse($bbc_tmp);
   					$bbc_tmp = str_replace('<br />', '<br>', $bbc_tmp);
   					$bbc_tmp = str_replace('[br]', '<br>', $bbc_tmp);
   					$bbc_tmp = str_replace('[BR]', '<br>', $bbc_tmp);
   					$bbc_tmp = replaceUnicode($bbc_tmp);
					$bbc_tmp = YoutubeVideo($BBCode_Youtube, $bbc_tmp);
					$bbc_tmp = $bbc_tmp.$editinfo;
   					$bbc_tmp = replaceAddonEmos($bbc_tmp, $path_server, $path_http, $chathost);
   					if ($allowjfemos === true) {
   						$bbc_tmp = replaceEmocode($emoarray, $emoprefix, $chathost, $chatport, $bbc_tmp);
   					}
   					if($key[4] == '1'){
						if($senduid == $showid || $senduid == $key[5]){
							$template->replaceVarTPL('GB_TEXT', $lang['guestbook']['alternative'].$bbc_tmp);
							$template->replaceVarTPL('GB_PRIVATE', $lang['guestbook']['private']);
						}else{
							$template->replaceVarTPL('GB_TEXT', $lang['guestbook']['alternative']);
							$template->replaceVarTPL('GB_PRIVATE', '');
						}
					}else{
						$template->replaceVarTPL('GB_TEXT', $bbc_tmp);
						$template->replaceVarTPL('GB_PRIVATE', '');
					}
					$template->replaceVarTPL('GB_DATE', $gbdate);
					$template->replaceVarTPL('GB_TIME', $key[3]);
					if($gb_show_all_entries === true && $key[12] == '0'){
						$template->replaceVarTPL('GB_POSTER', $lang['guestbook']['deleteduser']);
						$template->replaceVarTPL('GB_POSTERID', '0');
					}
					$template->replaceVarTPL('GB_POSTER', $key[7]);
					$template->replaceVarTPL('GB_POSTERID', $key[5]);
					if($key[8] == '0') $gender = $lang['gender']['male'];
					elseif($key[8] == '1') $gender = $lang['gender']['female'];
					else $gender = $lang['gender']['unknow'];
					$template->replaceVarTPL('GB_GENDER', $gender);
					if($gb_showpicture === true){
						if ($stdpicpath === true) {
							$picture = str_replace('../bilder', 'http://'.$chathost.':'.$chatport.'/bilder', $key[10]);
						} else {
							$picurl = 'http://'.$chathost.$picturespath.$ar[10];
						}
						$picwidth = ' width="120"';
					}else{
						$picture = 'http://'.$chathost.':'.$chatport.'/forum/avatare/'.$key[11];
						$picwidth = '';
					}
					$template->replaceVarTPL('GB_PICTURE', $picture);
					$template->replaceVarTPL('GB_PICWIDTH', $picwidth);
					if($key[9] == '1') $template->replaceVarTPL('GB_ISONLINEPIC', 'online.gif');
					else $template->replaceVarTPL('GB_ISONLINEPIC', 'offline.gif');
					if($senduid == $showid){
						$template->replaceVarTPL('GB_SWITCH', $lang['guestbook']['switchlink']);
						$template->replaceVarTPL('GB_DELETE', $lang['guestbook']['deletelink']);
						$template->replaceVarTPL('GB_COMMENT', $lang['guestbook']['commentlink']);
						if ($visitorrights >= $adminrights) {
							$template->replaceVarTPL('GB_EDIT', $lang['guestbook']['editlink']);
						} else {
							$template->replaceVarTPL('GB_EDIT', '');
						}
					}elseif($visitorrights >= $adminrights){
						$template->replaceVarTPL('GB_SWITCH', '');
						$template->replaceVarTPL('GB_DELETE', $lang['guestbook']['deletelink']);
						$template->replaceVarTPL('GB_COMMENT', '');
						$template->replaceVarTPL('GB_EDIT', $lang['guestbook']['editlink']);
					}else{
						$template->replaceVarTPL('GB_SWITCH', '');
						$template->replaceVarTPL('GB_DELETE', '');
						$template->replaceVarTPL('GB_COMMENT', '');
						$template->replaceVarTPL('GB_EDIT', '');
					}
					$template->replaceVarTPL('GB_ID', $key[0]);
					$gblist .= $template->getTPL();
				}
				if($countgb > 0){
					$template->replaceVar('ENTRIES', $gblist);
					$template->replaceVar('SITENAVIGATION', $SiteLinks);
				}else{
					$template->replaceVar('ENTRIES', $lang['error']['nogbentries']);
					$template->replaceVar('SITENAVIGATION', '');
				}
			}
		}
	}	
}

?>