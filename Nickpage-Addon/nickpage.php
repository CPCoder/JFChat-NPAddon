<?php
/**
 * Project		Nickpage-Addon
 * Filename		nickpage.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 */

if(version_compare(PHP_VERSION, '5.3','<')) {
	echo '<br><br><center>'.
			'<h2>!! Fatal Error !!</h4>'.
			'Um das Nickpage-Addon einsetzen zu k&ouml;nnen muss mind. PHP 5.3 installiert sein!<br><br>'.
			'<u>Installierte PHP-Version:</u><br>'.PHP_VERSION.'<br><br>'.
			'<u>Ben&ouml;tigte Mindest-PHP-Version</u><br>5.3.0';
	exit;
}
include('config/error_reporting.php');
include('config/config.inc.php');
$php_errors = '';

function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars) 
{
	global $path_server, $php_errors;
    $errortype = array (
                E_ERROR              => 'Error',
                E_WARNING            => 'Warning',
                E_PARSE              => 'Parsing Error',
                E_NOTICE             => 'Notice',
                E_CORE_ERROR         => 'Core Error',
                E_CORE_WARNING       => 'Core Warning',
                E_COMPILE_ERROR      => 'Compile Error',
                E_COMPILE_WARNING    => 'Compile Warning',
                E_USER_ERROR         => 'User Error',
                E_USER_WARNING       => 'User Warning',
                E_USER_NOTICE        => 'User Notice',
                E_STRICT             => 'Runtime Notice',
                E_RECOVERABLE_ERROR  => 'Catchable Fatal Error',
                E_DEPRECATED		 => 'Deprecated (Since PHP 5.3.0)'
                );
    $err = "<b>Error-Nr.:</b>\t" . $errno . "<br>";
    $err .= "<b>Error-Type:</b>\t" . $errortype[$errno] . "<br>";
    $err .= "<b>Error-Message:</b>\t" . $errmsg . "<br>";
    $err .= "<b>Script-File:</b>\t" . $filename . "<br>";
    $err .= "<b>Line-Number:</b>\t" . $linenum . "<br>";
    $err .= "<br>";
	$php_errors .= $err;
}
if($debug_mode){$old_error_handler = set_error_handler("userErrorHandler");}

$np_version 		= '2.4.11';
$mysql_errors		= '';
$mysql_querys		= '';
$request_array		= '';
$debug_box			= '';
$npuser_name		= '';
$npuser_isonline	= '';
$script_starttime	= microtime(true);
$signcount			= '2000';
$friendcount		= '50';


include('config/config.inc.php');
include('include/defines.php');
include('config/othersettings.php');
define('MAX_ENTRIES_GUESTBOOK', $gb_entries_per_page);
define("NAV_COUNT", $gb_navigation_count);
define('MAX_ENTRIES_BLOG', $blog_entries_per_page);
include('include/functions_global.php');
include('include/TplEngine.php');

$userip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$npsitesflag = false;

if(isset($_REQUEST['sid'])){
	$ex = explode('=', $_REQUEST['sid']);
	$sessionID = $ex[1];
}else{
	$sessionID = 'NoSessionID';
}
include('config/self.php');
if($request_check === true){
	include('include/icc.php');
	$icc = new ICC();
	for($i=0;$i<sizeof($_REQUEST);$i++){
		$icc_current = current($_REQUEST);
		$icc_key = key($_REQUEST);
  		if($icc->injection($icc_current, $icc_key)){
    		$icc->writeLog($icc_key, $icc_current, $userip, $userAgent, $sessionID);
  		}
  		next($_REQUEST);
	}
}
if(isset($_REQUEST['sid'])) $sessionID = $_REQUEST['sid'];
else $sessionID = 'NoSessionID';
if(isset($_REQUEST['showid'])) $showid = trim($_REQUEST['showid']);	
else $showid = 'null';
if(isset($_REQUEST['senduid'])) $senduid = $_REQUEST['senduid'];
else $senduid = 'null';
if(isset($_REQUEST['auth'])) $auth = $_REQUEST['auth'];
else $auth = '';
if(isset($_REQUEST['site'])) $site = $_REQUEST['site'];
else $site = 'profile';
if(isset($_REQUEST['setvisit'])) $setvisit = $_REQUEST['setvisit'];
else $setvisit = 'false';
if(isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = 1;
if(isset($_REQUEST['subsite'])) $subsite = $_REQUEST['subsite'];
else $subsite = 'null';
if(isset($_REQUEST['ac'])) $ac = $_REQUEST['ac'];
else $ac = 'null';
if(isset($_REQUEST['sc'])) $sc = $_REQUEST['sc'];
else $sc = 'null';
if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
else $id = 'null';

if($senduid != '-1'){
	$tmp_senduid = trim($senduid, '0123456789');
	if(!empty($tmp_senduid)) $senduid = 'null';
}
$tmp_showuid	= trim($showid, '0123456789');
$tmp_page		= trim($page, '0123456789');
$tmp_id			= trim($id, '0123456789');
if(!empty($tmp_showuid)) $showid = 'null';
if(!empty($tmp_page)) $page = 'null';
if(!empty($tmp_id)) $id = 'null';

include('lang/lang_'.$language.'.php');
include('include/globaldata.php');

function checkFriendCount($senduid, $showid){
	global $haslicense, $friendcount;
	if($haslicense !== true){
		$ar = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".FRIENDS." WHERE userid='$senduid'", 'nickpage.php');
		if($ar !== false){
			if($ar[0] >= $friendcount){
				return 'younomore';
			}else{
				$ar = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".FRIENDS." WHERE userid='$showid'", 'nickpage.php');
				if($ar !== false){
					if($ar[0] >= $friendcount){
						return 'henomore';
					}else{
						return 'ok';
					}
				}else{
					return 'ok';
				}
			}
		}else{
			$ar = getQueryResultCount("SELECT COUNT(*) AS menge FROM ".FRIENDS." WHERE userid='$showid'", 'nickpage.php');
			if($ar !== false){
				if($ar[0] >= $friendcount){
					return 'henomore';
				}else{
					return 'ok';
				}
			}else{
				return 'ok';
			}
		}
	}else{
		return 'ok';
	}
}

function addToFriends($senduid, $showid){
	global $nofriendauthorize;
	if($nofriendauthorize === true){
		$dummy = executeQuery("INSERT INTO ".FRIENDS." (userid, friendid) VALUES('$senduid', '$showid')", 'nickpage.php');
		$dummy = executeQuery("INSERT INTO ".FRIENDS." (userid, friendid) VALUES('$showid', '$senduid')", 'nickpage.php');
	}else{
		$dummy = executeQuery("INSERT INTO ".SENDFRIENDS." (userid, friendid) VALUES('$senduid', '$showid')", 'nickpage.php');
		$dummy = executeQuery("INSERT INTO ".WAITFRIENDS." (userid, friendid) VALUES('$showid', '$senduid')", 'nickpage.php');
	}
}

function delFromFriends($senduid, $showid){
	$dummy = executeQuery("DELETE FROM ".FRIENDS." WHERE userid='$senduid' AND friendid='$showid'", 'functions_global.php');
	$dummy = executeQuery("DELETE FROM ".FRIENDS." WHERE userid='$showid' AND friendid='$senduid'", 'functions_global.php');
}

$template = new TplEngine();


$npsites = array('blog', 'guestbook', 'gallery', 'statistics', 'slogan', 
				'profile', 'friends', 'npblocks', 'npshowsetting', 
				'test', 'shs_lic_info');
$nbsi = 0;
foreach($noblocksites as $value){
	if(in_array($value, $npsites)){
		unset($noblocksites[$nbsi]);
		break;
	}
	$nbsi++;
}
$nbsi = 0;
foreach($noheadfootsites as $value){
	if(in_array($value, $npsites)){
		unset($noheadfootsites[$nbsi]);
		break;
	}
	$nbsi++;
}
if(!in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');

if($sessionID == 'NoSessionID'){
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['session']);
}elseif($visitorcheck === false){
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['session']);
}elseif($senduid == '-1'){
	$template->setSubTPL('sysmessage');
	$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
	$template->replaceVar('MESSAGE', $lang['error']['noguests']);
}else{
	if($ac == 'locknp' && $visitorrights >= $adminrights){
		$dummy = executeQuery("UPDATE ".REGISTRY." SET nplock='1' WHERE id='$showid'", 'nickpage.php');
		$np_lock = true;
	}
	if($ac == 'unlocknp' && $visitorrights >= $adminrights){
		$dummy = executeQuery("UPDATE ".REGISTRY." SET nplock='0' WHERE id='$showid'", 'nickpage.php');
		$np_lock = false;
	}
	if($np_lock === true){
		if(!in_array($site, $noblocksites)){
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['npislocked']);
			if($visitorrights >= $adminrights) $template->replaceVar('ADDITIONAL', $lang['profile']['unlocknp']);
		} else {
			if(strstr($site, '..')){
				if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
			}else{
				if(file_exists('extensions/'.$site.'.php')){
					include('extensions/'.$site.'.php');
				}else{
					if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
				}
			}
		}
	}elseif($nponlyfriends === true && isFriend($senduid, $showid) !== true && $visitorrights < $adminrights){
		if(!in_array($site, $noblocksites)){
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['nponlyfriends']);
		} else {
			if(strstr($site, '..')){
				if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
			}else{
				if(file_exists('extensions/'.$site.'.php')){
					include('extensions/'.$site.'.php');
				}else{
					if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
				}
			}
		}
	}elseif(in_array($senduid, $np_npblocks)){
		if(!in_array($site, $noblocksites)){
			$template->setSubTPL('sysmessage');
			$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
			$template->replaceVar('MESSAGE', $lang['error']['isblockedinnp']);
		} else {
			if(strstr($site, '..')){
				if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
			}else{
				if(file_exists('extensions/'.$site.'.php')){
					include('extensions/'.$site.'.php');
				}else{
					if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
				}
			}
		}
	}elseif($unknowuser === true){
		$template->setSubTPL('sysmessage');
		$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
		$template->replaceVar('MESSAGE', $lang['error']['unknowuser2']);
	}else{
		setVisit($setvisit, $showid, $senduid, $mysql_errors);
		if($site == 'slogan'){
			include('include/slogan.php');
		}elseif($site == 'statistic'){
			include('include/statistics.php');
		}elseif($site == 'blog'){
			include('include/blog.php');
		}elseif($site == 'guestbook'){
			include('include/guestbook.php');
		}elseif($site == 'gallery'){
			include('include/gallery.php');
		}elseif($site == 'profile'){
			include('include/profile.php');
		}elseif($site == 'friends'){
			include('include/friends.php');
		}elseif($site == 'npblocks'){
			include('include/npblocks.php');
		}elseif($site == 'npshowsetting'){
			include('include/npshowsetting.php');
		}elseif($site == 'test' && $activateTestFile === true){
			include('include/test.php');
		}else{
			if(strstr($site, '..')){
				if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
				$template->setSubTPL('sysmessage');
				$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
				$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
			}else{
				if(file_exists('extensions/'.$site.'.php')){
					include('extensions/'.$site.'.php');
				}else{
					if(in_array($site, $noheadfootsites)) $template->openTemplate('nickpage');
					$template->setSubTPL('sysmessage');
					$template->replaceVar('SUB_TITLE', $lang['title']['systemmsg']);
					$template->replaceVar('MESSAGE', $lang['error']['sitenotavailable']);
				}
			}
		}
	}
}
include('config/self_global.php');
if($debug_mode){
	$request_array = "Array<br>(<br>";
	foreach($_REQUEST as $key => $val){
		$request_array .= "\t[".$key."] => ".$val."<br>";
	}
	$request_array .= ")<br>";
	$files_array = "Array<br>(<br>";
	foreach($_FILES as $key => $val){
		$files_array .= "\t[".$key."] => ".$val."<br>".
						"\tArray<br>\t(<br>";
		foreach($val as $ar => $value){
			$files_array .= "\t\t[".$ar."] => ".$value."<br>";
		}
		$files_array .= "\t)<br>";
	}
	$files_array .= ")<br>";
	if(!empty($_FILES)){
		$upload_paras = '<br><strong><u>Submitted Upload-Paras:</u></strong>' .
			'<pre>'.$files_array.'</pre>';
	}else{
		$upload_paras = '';
	}
	$check_varibales = "\$adminrights\t: $adminrights\n".
						"\$visitorrights\t: $visitorrights\n".
						"\$visitorcheck\t: $visitorcheck\n".
						"\$acc_mode\t: $acc_mode\n";
	$debug_box = '<br><br>' .
			'<div id="info_debug_box">' .
			'<center><h2>DEBUG-MODE</h2></center>' .
			'<strong><u>Check-Variables:</u></strong>' .
			'<pre>'.$check_varibales.'</pre>'.
			'<br><strong><u>Submitted Request-Paras:</u></strong>' .
			'<pre>'.$request_array.'</pre>' .$upload_paras.
			'<br><strong><u>Clean executed MySQL-Querys:</u></strong><br>' .
			'<pre style="white-space:pre-line;">'.$mysql_querys.'</pre>';
	if($mysql_errors != ''){
		$debug_box .= '<br><span class="color_red"><strong><u>MySQL-Errors and associated Querys:</u></strong></span><br>' .
				'<pre style="white-space:pre-line;">'.$mysql_errors.'</pre>';
	}
	if($php_errors != ''){
		$debug_box .= '<br><span class="color_red"><strong><u>PHP Error Reporting:</u></strong></span><br>' .
				'<pre style="white-space:pre-line;">'.$php_errors.'</pre>';
	}
	$debug_box .= '<br><strong>Script-Runtime: </strong>{RUNTIME} seconds';
	$debug_box .= '</div>';
}
$template->replaceVar('PAGE', $page);
$template->replaceVar('SID', $sessionID);
$template->replaceVar('SENDUID', $senduid);
$template->replaceVar('SHOWID', $showid);
$template->replaceVar('AUTH', $auth);
$template->replaceVar('SITECACHE', '');
$template->replaceVar('ADDITIONAL', '');
$template->replaceVar('NPUSER_NAME', $npuser_name);
$template->replaceVar('ISONLINE', $npuser_isonline);
$template->replaceVar('DEBUG_BOX', $debug_box);
$template->replaceVar('ONLOAD', '');
$template->replaceVar('MAXSIGNS', '0');

if(isset($self_array)){
	foreach($self_array as $key => $val){
		$template->replaceVar(strtoupper('SELFARRAY_'.$val['outvar']), $val['value']);
	}
}

$template->printTemplate();
?>