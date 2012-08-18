<?php
/*
 * Project		Nickpage-Addon
 * Filename		functions_guestbook.php
 * Author		Steffen Haase
 * Date			23.01.2010
 * License		GPL v3
 */

function YoutubeVideo($BBCode_Youtube, $data) {
	if ($BBCode_Youtube === true) {
		while (strpos(strtolower($data),'[youtube]') !== false && strpos(strtolower($data),'[/youtube]') !== false) {
			$pos1 = strpos(strtolower($data),'[youtube]');
			$code = "\n<object width=\"425\" height=\"300\">\n".
						"<param name=\"movie\" value=\"http://www.youtube.com/v/{VIDEOCODE}?fs=1&amp;hl=de_DE\"></param>\n".
						"<param name=\"allowFullScreen\" value=\"true\"></param>\n".
						"<param name=\"allowscriptaccess\" value=\"always\"></param>\n".
						"<embed src=\"http://www.youtube.com/v/{VIDEOCODE}?fs=1&amp;hl=de_DE\" type=\"application/x-shockwave-flash\" ".
						"allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"425\" height=\"300\"></embed>\n".
						"</object>\n";
			if ($pos1 !== false) {
				$pos2 = strpos(strtolower($data),'[/youtube]');
				$len = $pos2 - $pos1;
				$str = substr($data,$pos1+9, $len-9);
				$videocode = str_replace('{VIDEOCODE}', $str, $code);
				$len = $len+10;
				$data = substr_replace($data,$videocode,$pos1,$len);
			} else {
				break;
			}
		}
	}
	return $data;
}

function replaceUnicode($data){
	$data = str_replace('&amp;', '&', $data);
	$data = str_replace('&ouml;', 'ö', $data);
	$data = str_replace('&uuml;', 'ü', $data);
	$data = str_replace('&auml;', 'ä', $data);
	$data = str_replace('&Ouml;', 'Ö', $data);
	$data = str_replace('&Uuml;', 'Ü', $data);
	$data = str_replace('&Auml;', 'Ä', $data);
	$data = str_replace('&szlig;', 'ß', $data);
	$data = str_replace('&lt;i&gt;', '<i>', $data);
	$data = str_replace('&lt;b&gt;', '<b>', $data);
	$data = str_replace('&lt;/i&gt;', '</i>', $data);
	$data = str_replace('&lt;/b&gt;', '</b>', $data);
	$data = str_replace('&lt;br&gt;', '<br>', $data);
	return $data;
} 
function replaceEmocode($emoarray, $emoprefix, $chathost, $chatport, $data){
	if($emoarray !== false){
		foreach($emoarray as $key){
			$code = $key[0];
			$gfx = $key[1];
			$withprefix = $emoprefix.$code;
			$gfx = str_replace('../EMOS/', 'http://'.$chathost.':'.$chatport.'/EMOS/', $gfx);
			$gfx = str_replace('../forum/', 'http://'.$chathost.':'.$chatport.'/forum/', $gfx);
			$data = str_replace($withprefix, $gfx, $data);
		}
	}
	return $data;
}

function replaceAddonEmos($data, $path_server, $path_http, $chathost){
	if($dir = opendir($path_server."emoticons/")){
		while($file = readdir($dir)) {
			if($file != '..' && $file != '.'){
				$ex = explode('.', $file);
				$emoimg = '<img src="http://'.$chathost.$path_http.'emoticons/'.$file.'" border="0">';
				$data = str_replace('[:'.$ex[0].':]', $emoimg, $data);
			}
		}
		closedir($dir);
	}
	return $data;
}
function convertlinebreaks ($text) {
    return preg_replace ("/\015\012|\015|\012/", "\n", $text);
}
function bbcode_stripcontents ($text) {
    return preg_replace ("/[^\n]/", '', $text);
}
function do_bbcode_url ($action, $attributes, $content, $params, $node_object) {
    if (!isset ($attributes['default'])) {
        $url = $content;
        $text = htmlspecialchars ($content);
    } else {
        $url = $attributes['default'];
        $text = $content;
    }
    if ($action == 'validate') {
        if (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) == 'file:'
          || substr ($url, 0, 11) == 'javascript:' || substr ($url, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<a href="'.htmlspecialchars ($url).'" target="_blank">'.$text.'</a>';
}
function do_bbcode_img ($action, $attributes, $content, $params, $node_object) {
    if ($action == 'validate') {
        if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
          || substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<img src="'.htmlspecialchars($content).'" alt="">';
}
function do_bbcode_color ($action, $attributes, $content, $params, $node_object) {
    if (isset ($attributes['default'])) {
        $color = $attributes['default'];
        $text = $content;
    }
	if ($action == 'validate') {
        if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
          || substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<span style="color:#'.$color.';">'.$content.'</span>';
}
function do_bbcode_size ($action, $attributes, $content, $params, $node_object) {
    if (isset ($attributes['default'])) {
        $size = $attributes['default'];
        $text = $content;
    }
	if ($action == 'validate') {
        if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
          || substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<span style="font-size:'.$size.'pt;">'.$content.'</span>';
}
function do_bbcode_family ($action, $attributes, $content, $params, $node_object) {
    if (isset ($attributes['default'])) {
        $family = $attributes['default'];
        $text = $content;
    }
	if ($action == 'validate') {
        if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
          || substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<span style="font-family:'.$family.';">'.$content.'</span>';
}

?>