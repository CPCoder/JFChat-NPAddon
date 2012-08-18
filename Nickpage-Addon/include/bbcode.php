<?php
/*
 * Project		Nickpage-Addon
 * Filename		bbcode.php
 * Author		Steffen Haase
 * Date			23.01.2010
 * License		GPL v3
 */
 
require_once('include/classes/stringparser_bbcode.class.php');
$bbcode = new StringParser_BBCode();
$bbcode->addFilter(STRINGPARSER_FILTER_PRE, 'convertlinebreaks');
$bbcode->addParser(array('block', 'inline', 'link', 'listitem'), 'htmlspecialchars');
$bbcode->addParser(array('block', 'inline', 'link', 'listitem'), 'nl2br');
$bbcode->addCode('b', 'simple_replace', null, array('start_tag' => '<strong>', 'end_tag' => '</strong>'), 
				'inline', array('listitem', 'block', 'inline', 'link'), array());
$bbcode->addCode('u', 'simple_replace', null, array('start_tag' => '<u>', 'end_tag' => '</u>'), 
				'inline', array('listitem', 'block', 'inline', 'link'), array());
$bbcode->addCode('i', 'simple_replace', null, array('start_tag' => '<i>', 'end_tag' => '</i>'), 
				'inline', array('listitem', 'block', 'inline', 'link'), array());
$bbcode->addCode('color', 'callback_replace', 'do_bbcode_color', array('usecontent_param' => array ('default')), 
				'inline', array('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode('size', 'callback_replace', 'do_bbcode_size', array('usecontent_param' => array ('default')), 
				'inline', array('listitem', 'block', 'inline', 'link'), array());
$bbcode->addCode('family', 'callback_replace', 'do_bbcode_family', array('usecontent_param' => array ('default')), 
				'inline', array('listitem', 'block', 'inline', 'link'), array());
if($gb_allow_img_and_url){
	$bbcode->addCode('url', 'usecontent?', 'do_bbcode_url', array('usecontent_param' => 'default'), 
				'link', array('listitem', 'block', 'inline'), array('link'));
	$bbcode->addCode('img', 'usecontent?', 'do_bbcode_img', array(), 'image', array('listitem', 'block', 'inline', 'link'), 
				array());
}
$bbcode->addCode('quote', 'simple_replace', null, array('start_tag' => '<div class="quote"><div class="padding_4">', 
				'end_tag' => '</div></div>'), 'inline', array('listitem', 'block', 'inline', 'link'), array());
$bbcode->addCode('comment', 'simple_replace', null, array('start_tag' => '<div class="comment"><div class="padding_4">', 
				'end_tag' => '</div></div>'), 'inline', array('listitem', 'block', 'inline', 'link'), array());
if($gb_allow_img_and_url){
	$bbcode->setOccurrenceType('img', 'image');
	$bbcode->setOccurrenceType('bild', 'image');
	$bbcode->setMaxOccurrences('image', 2);
}
$bbcode->setGlobalCaseSensitive(false);
$bbcode->setCodeFlag('b', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('i', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('u', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('color', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('size', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('family', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
if($gb_allow_img_and_url){
	$bbcode->setCodeFlag('link', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
	$bbcode->setCodeFlag('img', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
}
$bbcode->setCodeFlag('quote', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setCodeFlag('comment', 'paragraph_type', BBCODE_PARAGRAPH_ALLOW_INSIDE);
$bbcode->setRootParagraphHandling(true);

?>