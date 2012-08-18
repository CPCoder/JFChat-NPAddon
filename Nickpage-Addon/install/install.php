<?php
/*
 * Project		Nickpage-Addon
 * Filename		install.php
 * Author		Steffen Haase
 * Date			07.02.2010
 * License		GPL v3
 */
 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_REQUEST['step'])) $step = $_REQUEST['step'];
else $step = '0';
$step_tmp = trim($step, '0123456789');
if(!empty($step_tmp)) $step = '0';

include('../config/config.inc.php');
define('BLOG', $dbpref.'npblog');
define('GALCAT', $dbpref.'npgalcategories');
define('GALIMG', $dbpref.'npgalimages');
define('REGISTRY', $dbpref.'registry');
define('VISITORS', $dbpref.'visitors');
define('NPBLOCKS', $dbpref.'npblocks');
define('GUESTBOOKS', $dbpref.'guestbooks');

require('TplEngine.php');
$template = new TplEngine();
$template->openTemplate('install');
$subtitle = 'Start der Installation';

if($step == 1){
	include('step1.php');
}elseif($step == 2){
	include('step2.php');
}elseif($step == 3){
	include('step3.php');	
}elseif($step == 4){
	include('finish.php');
}else{
	$template->setSubTPL('start');
}

$template->replaceVar('TITLE', 'NP-Addon Installation');
$template->replaceVar('SUBTITLE', $subtitle);
$template->printTemplate();
?>