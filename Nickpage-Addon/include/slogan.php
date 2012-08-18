<?php
/*
 * Project		Nickpage-Addon
 * Filename		motto.php
 * Author		Steffen Haase
 * Date			16.01.2010
 * License		GPL v3
 */

if ($subsite == 'delete' && $visitorrights>=$adminrights) {
	$dummy = executeQuery("UPDATE ".REGISTRY." SET motto='' WHERE id='".$showid."'", 'guestbook.php');
}
$ar = getQueryResult("SELECT motto FROM ".REGISTRY." WHERE id='".$showid."'", 'slogan.php');
if($ar !== false){
	include('include/bbcode.php');
	include('include/functions_guestbook.php');
	$slogan = str_replace('[br]', '<br>', $ar[0]);
	$template->setSubTPL('slogan');
	$template->replaceVar('SUB_TITLE', $lang['title']['slogan']);
	if(!empty($ar[0])){
		$bbc_tmp = $bbcode->parse($ar[0]);
		$bbc_tmp = str_replace('<br />', '<br>', $bbc_tmp);
		$bbc_tmp = str_replace('[br]', '', $bbc_tmp);
		$bbc_tmp = str_replace('[BR]', '', $bbc_tmp);
		$bbc_tmp .= $lang['profile']['deleteslogan'];
		$template->replaceVar('SLOGAN', $bbc_tmp);
	}else{
		$template->replaceVar('SLOGAN', $lang['error']['noslogan']);
	}
} 

?>