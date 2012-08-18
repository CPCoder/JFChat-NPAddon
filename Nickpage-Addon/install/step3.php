<?php
/*
 * Project		Nickpage-Addon
 * Filename		step3.php
 * Author		Steffen Haase
 * Date			13.02.2010
 * License		GPL v3
 */
 
$subtitle = 'Schritt 3: Anlegen der neuen Tabellen und Erweiterung der vorhanden Tabellen.';
$template->setSubTPL('step3');
$flag = true;
$errors = '<strong>MySQL-Error(s):</strong><br>';

$dz = @mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname, $dz);

if(!empty($_REQUEST['ac'])){
	$ac = $_REQUEST['ac'];
	if($ac == 'createblog'){
		$dummy = @mysql_query
					(
						"CREATE TABLE ".$dbpref."npblog (".
							"id int(12) unsigned NOT NULL AUTO_INCREMENT,".
							"userid int(12) NOT NULL,".
							"`date` date NOT NULL,".
							"`time` time NOT NULL,".
							"content mediumtext NOT NULL,".
							"contenthtml mediumtext NOT NULL,".
							"editinfo text NOT NULL,".
							"PRIMARY KEY (id),".
							"KEY userid (userid)".
						") ENGINE=MyISAM;"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'creategalcats'){
		$dummy = @mysql_query
					(
						"CREATE TABLE ".$dbpref."npgalcategories (".
							"id int(11) unsigned NOT NULL AUTO_INCREMENT,".
							"title varchar(50) NOT NULL,".
							"description varchar(500) NOT NULL,".
							"userid int(11) NOT NULL,".
							"PRIMARY KEY (id),".
							"KEY userid (userid)".
						") ENGINE=MyISAM;"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'creategalimg'){
		$dummy = @mysql_query
					(
						"CREATE TABLE ".$dbpref."npgalimages (".
							"id bigint(10) unsigned NOT NULL AUTO_INCREMENT,".
							"galid int(11) NOT NULL,".
							"userid int(11) NOT NULL,".
							"title varchar(255) NOT NULL,".
							"image varchar(255) NOT NULL,".
							"locked int(1) NOT NULL default '0',".
							"PRIMARY KEY (id),".
							"KEY userid (userid)".
						") ENGINE=MyISAM;"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'createnpblocks'){
		$dummy = @mysql_query
					(
						"CREATE TABLE ".$dbpref."npblocks (".
							"userid bigint(20) NOT NULL,".
							"blockid bigint(20) NOT NULL,".
							"KEY userid (userid)".
						") ENGINE=MyISAM;"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'addgblastvisit'){
		$dummy = @mysql_query
					(
						"ALTER TABLE ".REGISTRY." ADD gblastvisit int(11) default '".time()."';"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'addvisitorsid'){
		$dummy = @mysql_query
					(
						"ALTER TABLE ".VISITORS." ADD id bigint(20) unsigned NOT NULL AUTO_INCREMENT FIRST,".
						"ADD PRIMARY KEY (id);"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'addeditinfo'){
		$dummy = @mysql_query
					(
						"ALTER TABLE ".GUESTBOOKS." ADD editinfo varchar(255) NULL default '';"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'addnponlyfriends'){
		$dummy = @mysql_query
					(
						"ALTER TABLE ".REGISTRY." ADD nponlyfriends int(1) NOT NULL default '0';"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
	if($ac == 'addnplock'){
		$dummy = @mysql_query
					(
						"ALTER TABLE ".REGISTRY." ADD nplock int(1) default '0';"
					);
		if(mysql_error()){
			$errors .= mysql_error().'<br>';
			$flag = false;
		}
	}
}

$ar = @mysql_query("DESCRIBE ".BLOG);
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('BLOG_STATUS', '<font color="#FF0000"><b>Table doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=createblog">Tabelle anlegen</a>');
}else{
	$template->replaceVar('BLOG_STATUS', '<font color="#009F00"><b>Table exists!</b></font>');
}
$ar = @mysql_query("DESCRIBE ".GALCAT);
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('GALCAT_STATUS', '<font color="#FF0000"><b>Table doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=creategalcats">Tabelle anlegen</a>');
}else{
	$template->replaceVar('GALCAT_STATUS', '<font color="#009F00"><b>Table exists!</b></font>');
}
$ar = @mysql_query("DESCRIBE ".GALIMG);
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('GALIMG_STATUS', '<font color="#FF0000"><b>Table doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=creategalimg">Tabelle anlegen</a>');
}else{
	$template->replaceVar('GALIMG_STATUS', '<font color="#009F00"><b>Table exists!</b></font>');
}
$ar = @mysql_query("DESCRIBE ".NPBLOCKS);
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('NPBLOCKS_STATUS', '<font color="#FF0000"><b>Table doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=createnpblocks">Tabelle anlegen</a>');
}else{
	$template->replaceVar('NPBLOCKS_STATUS', '<font color="#009F00"><b>Table exists!</b></font>');
}
$ar = @mysql_query("SELECT gblastvisit FROM ".REGISTRY." LIMIT 1");
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('GBLASTV_STATUS', '<font color="#FF0000"><b>Column doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=addgblastvisit">Spalte anlegen</a>');
}else{
	$template->replaceVar('GBLASTV_STATUS', '<font color="#009F00"><b>Column exists!</b></font>');
}
$ar = @mysql_query("SELECT id FROM ".VISITORS." LIMIT 1");
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('VISITID_STATUS', '<font color="#FF0000"><b>Column doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=addvisitorsid">Spalte anlegen</a>');
}else{
	$template->replaceVar('VISITID_STATUS', '<font color="#009F00"><b>Column exists!</b></font>');
}
$ar = @mysql_query("SELECT editinfo FROM ".GUESTBOOKS." LIMIT 1");
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('EDITINFO_STATUS', '<font color="#FF0000"><b>Column doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=addeditinfo">Spalte anlegen</a>');
}else{
	$template->replaceVar('EDITINFO_STATUS', '<font color="#009F00"><b>Column exists!</b></font>');
}
$ar = @mysql_query("SELECT nplock FROM ".REGISTRY." LIMIT 1");
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('NPLOCK_STATUS', '<font color="#FF0000"><b>Column doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=addnplock">Spalte anlegen</a>');
}else{
	$template->replaceVar('NPLOCK_STATUS', '<font color="#009F00"><b>Column exists!</b></font>');
}
$ar = @mysql_query("SELECT nponlyfriends FROM ".REGISTRY." LIMIT 1");
if(mysql_error()){
	$errors .= mysql_error().'<br>';
	$flag = false;
	$template->replaceVar('NPONLYFRIENDS_STATUS', '<font color="#FF0000"><b>Column doesn\'t exist!</b></font>&nbsp; >> <a href="install.php?step=3&ac=addnponlyfriends">Spalte anlegen</a>');
}else{
	$template->replaceVar('NPONLYFRIENDS_STATUS', '<font color="#009F00"><b>Column exists!</b></font>');
}


if($flag === false) $link = '<a href=install.php?step=3>Ansicht aktualisieren</a>';
else $link = '<a href=install.php?step=4>Installation abschliessen</a>';

if($errors != '<strong>MySQL-Error(s):</strong><br>'){
	$errmsg = $errors.'<br><br>';
}else{
	$errmsg = '';
}
$template->replaceVar('LINK', $link);
$template->replaceVar('DBPREF', $dbpref);
$template->replaceVar('DB_ERRORMESSAGE', $errmsg);

?>