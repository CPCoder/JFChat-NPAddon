<?php
/*
 * Project		Nickpage-Addon
 * Filename		guestbook_comment.php
 * Author		Steffen Haase
 * Date			17.01.2010
 * License		GPL v3
 */

include('include/bbcode.php');
include('include/functions_guestbook.php');
if($id != 'null'){
	$ar = getQueryResult("SELECT a.userid, a.kommentar, b.username FROM ".GUESTBOOKS." AS a LEFT JOIN ".REGISTRY." AS b ON a.userid=b.id WHERE a.id='$id'", 'guestbook_comment.php');
	if($ar !== false){
		if($ar[0] == $senduid){
			if($ac == 'save'){
				if(empty($_REQUEST['data']) || $_REQUEST['data'] == ''){
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['nocommentdata']);
				}else{
					$data = '[BR][BR][COMMENT][B]Kommentar von '.$ar[2].' am '.date('d.m.Y').' um '.date('H:i:s').' Uhr:[/B][BR]'.$_REQUEST['data'].'[/COMMENT]';
    				$comment = $ar[1].$data;
    				$dummy = executeQuery(
								"UPDATE ".GUESTBOOKS." SET ".
								"kommentar='".mysql_real_escape_string(htmlspecialchars($comment,ENT_QUOTES))."' ".
								"WHERE id='".$id."'", 'guestbook_comment.php');
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
					$template->replaceVar('ADDITIONAL', $lang['additional']['gbcomment']);
					$template->replaceVar('MESSAGE', $lang['guestbook']['commentsaved']);
					$template->replaceVar('PAGE', $page);
				}
			}else{
				$template->setSubTPL('guestbook_comment');
				$template->replaceVar('SUB_TITLE', $lang['title']['guestbook']);
				$template->replaceVar('ADDITIONAL', $lang['additional']['gbcomment']);
				$template->replaceVar('GB_ID', $id);
			}
		}else{
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nocomment']);
		}
	}else{
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['unknowgbid']);
	}
}else{
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['unknowgbid']);
}
 
?>