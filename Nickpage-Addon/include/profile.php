<?php
/*
 * Project		Nickpage-Addon
 * Filename		profile.php
 * Author		Steffen Haase
 * Contact		info@sh-software.de
 * License		GPL v3
*/

$query_rows = '';
$picurl		= '';
$picture	= '';
$gender_out	= '';
$birthdate	= '';

foreach($profil as $key => $val){
	$query_rows .= ', '.$val['row'];
}
$ar = getQueryResult("SELECT bild, geburtsdatum, geschlecht".$query_rows." FROM ".REGISTRY." WHERE id='".$showid."'", 'profile.php');
if($ar !== false){
	if($ac == 'addfriend') addToFriends($senduid, $showid);
	if($ac == 'delfriend') delFromFriends($senduid, $showid);
	$template->setSubTPL('profile');
	$template->replaceVar('SITECACHE', '<meta http-equiv="cache-control" content="no-cache">');
	$template->replaceVar('SUB_TITLE', $lang['title']['profile']);
	foreach($profil as $key => $val){
		if(!empty($ar[$val['row']])){
			if($val['row'] == 'homepagename'){
				$template->replaceVar(strtoupper('ROW_'.$val['row']), '<a href="'.$ar['homepageurl'].'" target="blank">'.$ar['homepagename'].'</a>');
				$template->replaceVar(strtoupper('OUT_'.$val['row']), $val['out']);
			}
			$template->replaceVar(strtoupper('ROW_'.$val['row']), str_replace('[br]', '', $ar[$val['row']]));
			$template->replaceVar(strtoupper('OUT_'.$val['row']), $val['out']);
		}else{
			$template->replaceVar(strtoupper('ROW_'.$val['row']), '');
			$template->replaceVar(strtoupper('OUT_'.$val['row']), '');
		}
	}
	if($ar[2] == '0')
		$gender_out = $lang['gender']['male'];
	elseif($ar[2] == '1')
		$gender_out = $lang['gender']['female'];
	else{
		$gender_out = $lang['gender']['unknow'];
	}
	if ($stdpicpath === true) {
		$picurl = str_replace('../bilder', 'http://'.$chathost.':'.$chatport.'/bilder', $ar[0]);
	} else {
		$picurl = 'http://'.$chathost.$picturespath.$ar[0];
	}
	if (isset($picturelytebox) && $picturelytebox === true) {
		$picture = '<a href="'.$picurl.'" rel="lytebox[vacation]" title="Profilbild" alt="Profilbild"><img src="'.$picurl.'" width="200" border="0"></a><br>(Für Originalgrösse auf das Bild klicken)';
	} else {
		$picture = '<a href="'.$picurl.'" target="_blank"><img src="'.$picurl.'" width="200" border="0"></a><br>(Für Originalgrösse auf das Bild klicken)';
	}
	$ex = explode('-',$ar[1]);
	$birthdate = $ex[2].'.'.$ex[1].'.'.$ex[0];
	$friendcheck = checkFriendStatus($senduid, $showid);
	$friendcount = checkFriendCount($senduid, $showid);
	$friend_link = '';
	if($friendcheck == 'isfriend') $friend_link = $lang['profile']['delfriend'];
	elseif($friendcheck == 'hewait') $friend_link = $lang['other']['hewait'];
	elseif($friendcheck == 'youwait') $friend_link = $lang['other']['youwait'];
	elseif($friendcount == 'henomore') $friend_link = $lang['other']['henomore'];
	elseif($friendcount == 'younomore') $friend_link = $lang['other']['younomore'];
	else $friend_link = $lang['profile']['addfriend'];
	if($senduid != $showid){
		$mail_link			= $lang['profile']['sendmail'];
		$friend_link		= $friend_link;
		$edit_profile_link	= '';
		$edit_npblocks		= '';
		$edit_npshowsetting	= '';
	}else{
		$mail_link			= '';
		$friend_link		= '';
		$edit_profile_link	= $lang['profile']['edit'];
		$edit_npblocks		= $lang['profile']['npblocks'];
		$edit_npshowsetting	= $lang['profile']['npshowsetting'];
	}
	if($visitorrights >= $adminrights) $nplock_link = $lang['profile']['locknp'];
	else $nplock_link = '';
	$template->replaceVar('GEBURTSDATUM', $birthdate);
	$template->replaceVar('AGE', getAge($birthdate));
	$template->replaceVar('PICTURE', $picture);
	$template->replaceVar('GENDER', $gender_out);
	$template->replaceVar('FRIEND_LINK', $friend_link);
	$template->replaceVar('MAIL_LINK', $mail_link);
	$template->replaceVar('EDIT_NPBLOCKS_LINK', $edit_npblocks);
	$template->replaceVar('EDIT_PROFILE_LINK', $edit_profile_link);
	$template->replaceVar('TOUSER', $npuser_name);
	$template->replaceVar('NPLOCK_LINK', $nplock_link);
	$template->replaceVar('NPSHOWSETTING_LINK', $edit_npshowsetting);
}
 
?>