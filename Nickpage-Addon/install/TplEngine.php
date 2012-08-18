<?php
/*
 * Project		Nickpage-Addon
 * Filename		TplEngine.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 */

/**
 * Kompakte Template-Engine - Dient dem Ersetzen von Template-Variablen 
 * durch die entsprechende Werte. Auf diese Weise ist eine strikte Trennung
 * von HTML- und PHP-Code möglich.
 *
 * @package TplEngine
 * @author Steffen Haase
 * @version 1.0
 * @copyright Copyright (c) 2009-2010 SHS (Steffen Haase Software)
 */
class TplEngine
{
	private $addon_name		= 'Nickpage-Addon';
	private $addon_vers		= '2.4';

	private $title			= '';
	private $sign_left		= '{';
	private $sign_right		= '}';
	private $template_dir	= 'templates/';
	private $style_dir		= 'style/';
	private $tpl			= '';
	private $tpl_tmp		= '';
	private $path_http		= '';
	private $path_server	= '';
	
	/**
	 * Initialisiert die Template-Engine.
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @global String $path_http HTTP-Pfad zum Nickpage-Addon
	 * @global String $path_server Server-Pfad zum Nickpage-Addon
	 * @global String $hostname Hostname des Chatservers
	 * @global String $comname Name der Chatcommunity
	 */
	public function TplEngine(){
		global $chathost, $path_http, $path_server;
		$this->title		= $this->addon_name.' - Installation';
		$this->path_http	= 'http://'.$chathost.$path_http.'install/'; 
		$this->path_server	= $path_server.'install/';
		$this->style_dir	= $this->path_http.$this->style_dir; 
	}
	
	/**
	 * Öffnet ein Template über die Funktion "getTemplate($tpl)" ein 
	 * und speichert es in der Klassen-Variable "$tpl" ab. Der Name des zu 
	 * öffnenden Templates muss ohne den zusatz ".tpl" angegeben werden!
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @param String $tpl Dateiname des Templates
	 */
	public function openTemplate($tpl){
		$this->tpl = '';
		$this->tpl = $this->getTemplate($tpl);
	}
	
	/**
	 * Liest ein Template aus dem Dateisystem ein. Gibt den inhalt des Templates zurück, 
	 * Eine Fehlermeldung, falls das Tempalte nicht gefunden wurde.
	 * 
	 * @author Steffen Haase
	 * @access private
	 * @param String $tpl Dateiame des Templates
	 * @return String Inhalt des Templates
	 */
	private function getTemplate($tpl){
		$template = $this->path_server.$this->template_dir.$tpl.'.tpl';
		if(false!=($file = @fopen($template,'r'))){
			$out = '';
			while($line = fgets($file, 1000)){
				$out .= $line;
			}
			fclose($file);
			return $out;
		}else{
			return '<br><br><h2>FATAL ERROR!!</h2><b>Could not find the template "'.$tpl.'.tpl"!</b><br><br>';
		}
	}
	
	/**
	 * Liest ein weiteres Template aus dem Dateisystem ein und ersetzt in dem Template, 
	 * welches in der Klassen-Variable "$tpl" gespeichert ist, die Template-Variable
	 * "{SITECONTENT}". Der Dateiname des einzulesenden Templates muss ohne den Zusatz ".tpl" 
	 * angegeben werden!
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @param String $tpl Dateiname des Templates (ohne .tpl)
	 */
	public function setSubTPL($tpl){
		$tpl_tmp = $this->getTemplate($tpl);
		$this->replaceVar('SITECONTENT', $tpl_tmp);
	}

	/**
	 * Liest ein weiteres Template aus dem Dateisystem ein und speichert den Inhalt
	 * des Templates in der Klassen-Variable "$tpl_tmp". Der Dateiname des zu ladenden
	 * Templates muss ohne den Zusatz ".tpl" angegeben werden!
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @param String $tpl Dateiname des Templates
	 */
	public function loadTPL($tpl){
		$this->tpl_tmp .= $this->getTemplate($tpl);
	}

	/**
	 * Gibt den Inhalt der Klassen-Variable "$tpl_tmp" zurück.
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @return String Inhalt der Klassen-Variable "$tpl_tmp"
	 */
	public function getTPL(){
		$out = $this->tpl_tmp;
		$this->tpl_tmp = '';
		return $out;
	}

	/**
	 * Ersetzt innerhalb der Klassen-Variable "$tpl" eine Template-Variable.
	 * Der Name der Template-Variable die ersetzt werden soll muss ohne die 
	 * geschweiften Klammern angegeben werden! 
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @param String $var1 Name der Template-Variable (ohne {})
	 * @param String $var2 Wert der eingesetzt werden soll
	 */
	public function replaceVar($var1, $var2){
		$var1 = $this->sign_left.strtoupper($var1).$this->sign_right;
		$tpl = str_replace($var1, $var2, $this->tpl);
		$this->tpl = $tpl;
	}

	/**
	 * Ersetzt innerhalb der Klassen-Variable "$tpl_tmp" eine Template-Variable.
	 * Der Name der Template-Variable die ersetzt werden soll muss ohne die 
	 * geschweiften Klammern angegeben werden!
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @param String $var1 Name der Template-Variable (ohne {})
	 * @param String $var2 Wert der eingesetzt werden soll
	 */
	public function replaceVarTPL($var1, $var2){
		$tpl = $this->tpl_tmp;
		$var1 = $this->sign_left.strtoupper($var1).$this->sign_right;
		$tpl = str_replace($var1, $var2, $tpl);
		$this->tpl_tmp = $tpl;
	}

	/**
	 * Gibt den Inhalt der Klassen-Variable "$tpl" per echo aus.
	 * Zusätzlich werden noch die Template-Variablen "{TITLE}, {STYLE}, {EMOS} und {JS}" 
	 * durch die entsprechenden Werte ersetzt. Der Parameter der erwartet wird, wird
	 * für die Berechnung der Ausführungszeit des Scriptes benötigt.
	 * 
	 * @author Steffen Haase
	 * @access public
	 * @global Integer $script_starttime Startzeit bei der Ausführung des Scriptes
	 */
	public function printTemplate(){
		global $script_starttime;
		$this->replaceVar('TITLE',$this->title);
		$this->replaceVar('STYLE',$this->style_dir);
		$this->replaceVar('INSTALL',$this->path_http);
		echo $this->tpl;
	}
}
 
?>