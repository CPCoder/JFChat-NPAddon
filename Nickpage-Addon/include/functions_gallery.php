<?php
/*
 * Project		Nickpage-Addon
 * Filename		functions_gallery.php
 * Author		Steffen Haase
 * Date			06.02.2010
 * License		GPL v3
 */

function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}

function buildCategoryList($id){
	$catlist = '';
	$ar = getQueryResultLoop("SELECT id, title FROM ".GALCATS." WHERE userid='".$id."'", 'functions_global.php');
	if($ar !== false){
		foreach($ar as $key){
			$catlist .= '<option value="'.$key[0].'">'.$key[1].'</option>';
		}
		return $catlist;
	}else{
		return '';
	}
}

function haveCategory($id){
	$ar = getQueryResult("SELECT id FROM ".GALCATS." WHERE userid='".$id."'", 'functions_global.php');
	if($ar !== false) return true;
	else return false;
}

?>