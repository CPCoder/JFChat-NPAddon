<?php
/*
 * Project		Nickpage-Addon
 * Filename		TplEngine.php
 * Author		Steffen Haase
 * Date			15.01.2010
 * License		GPL v3
 * 
 */

/**
 * Kompakte Template-Engine
 * 
 * Dient dem Ersetzen von Template-Variablen durch die entsprechende Werte.<br>
 * Auf diese Weise ist eine strikte Trennung von HTML- und PHP-Code möglich.
 *
 * @package TplEngine
 * @author Steffen Haase  
 * @version 1.0
 */
class TplEngine
{
	private $addon_name		= 'Nickpage-Addon';
	private $addon_version	= '';

	private $path_http		= '';
	private $path_server	= '';
	private $title			= '';
	private $sign_left		= '{';
	private $sign_right		= '}';
	private $template_dir	= 'templates/';
	private $style_dir		= 'style/';
	private $gallery_dir	= 'gallery/';
	private $js_dir			= 'js/';
	private $emo_dir		= 'emoticons/';
	private $tpl			= '';
	private $tpl_tmp		= '';
	private $install_dir	= '';
	
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
		global $path_http, $path_server, $chathost, $comname, $np_version;
		$this->title		= $comname;
		$this->path_http	= $path_http;
		$this->path_server	= $path_server;
		$this->addon_version = $np_version;
		$this->style_dir 	= 'http://'.$chathost.$path_http.$this->style_dir;
		$this->gallery_dir 	= 'http://'.$chathost.$path_http.$this->gallery_dir;
		$this->js_dir 		= 'http://'.$chathost.$path_http.$this->js_dir;
		$this->emo_dir		= 'http://'.$chathost.$path_http.$this->emo_dir;
		$this->install_dir	= 'http://'.$chathost.$path_http;
	}
	
	/**
	 * Liefert ein Verzeichnis zurück.
	 * 
	 * @author Steffen Haase  
	 * @access public
	 * @param String $var Mögliche Werte: style, gallery, js, emos
	 * @return String Verzeichnis (Bsp.: emoticons/)
	 */
	public function getPath($var){
		switch(strtolower(trim($var))){
			case 'style':
				return $this->style_dir;
			case 'gallery':
				return $this->gallery_dir;
			case 'js':
				return $this->js_dir;
			case 'emos':
				return $this->emo_dir;
			default:
				return $this->install_dir;
		}
	}
	
	/**
	 * Liest ein Template über die Funktion "getTemplate($tpl)" ein 
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
	 * Liest ein Template aus dem Dateisystem ein und gibt den Inhalt des Templates zurück.
	 *  
	 * Falls das Tempalte nicht gefunden wurde erhält man eine Fehlermeldung.
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
		$this->replaceVar('EMOS',$this->emo_dir);
		$this->replaceVar('JS',$this->js_dir);
		$this->replaceVar('INSTALL',$this->install_dir);
		$endtime = microtime(true);
		$runtime = round($endtime - $script_starttime,3);
		$this->replaceVar('RUNTIME',$runtime);
		header("Content-Type: text/html; charset=iso-8859-1");
		echo $this->tpl;
	}
}
 
?>