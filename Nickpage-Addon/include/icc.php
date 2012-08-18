<?php

class ICC{
  protected $pattern_integer = '/^[0-9]$/';
  protected $pattern_plz = '/^[0-9]{5}$/';
  protected $pattern_date = '/^[0-9]{1,2}(\.|\/|\-){1}[0-9]{1,2}(\.|\/|\-){1}[0-9]{4}$/';
  protected $pattern_phone = '/^[0-9\+\(\)\/\-\s]+$/';
  protected $pattern_money = '/^([1-9]{1}[0-9]{0,2}((\.)?[0-9]{3})*((\.|\,)?[0-9]{0,2})?|[1-9]{1}[0-9]{0,}((\.|\,)?[0-9]{0,2})?|0((\.|\,)?[0-9]{0,2})?|((\.|\,)?[0-9]{1,2})?)$/';
  protected $pattern_word = '/^[a-zA-ZäöüÄÖÜ\xc0-\xc2\xc8-\xcf\xd2-\xd4\xd9-\xdb\xe0-\xe2\xe8-\xef\xf2-\xf4\xf9-\xfb\x9f\xff\']+$/';
  protected $pattern_name = '/^([a-zA-ZäöüÄÖÜ\xc0-\xc2\xc8-\xcf\xd2-\xd4\xd9-\xdb\xe0-\xe2\xe8-\xef\xf2-\xf4\xf9-\xfb\x9f\xff\.\'\-_]?(\s)?)+$/';
  protected $pattern_email = '';
  protected $pattern_url = '/^(http|https)\:\/\/([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&%\$\-]+)*@)?((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.[a-zA-Z]{2,6})(\:[0-9]+)?(\/[a-zA-Z0-9\.\,\?\'\\/\+&%\$#\=~_\-@]*)*$/';
  protected $sql_injection = array('delete from','drop table','insert into','select from','select into','update set', '\'');
  protected $script_injection = array('script', 'javascript', 'vbscript');
  protected $email_injection = array('bcc:','boundary','cc:','content-transfer-encoding:','content-type:','mime-version:','subject:');
  protected $clear_searchexp = array("/(\r\n)|(\r)/m","/(\n){3,}/m","/\s{3,}/m","/(.)\\1{15,}/im");
  protected $clear_replace = array("\n","\n\n"," ","\\1");
  protected $feld_error = array();
  protected $hack_log = '';
  const FELD_ERROR_FORMAT = 'Die Eingabe hat das falsche Format.';
  const FELD_ERROR_TOSHORT = 'Die Eingabe ist zu kurz.';
  const FELD_ERROR_TOBIG = 'Die Eingabe ist zu lang.';
  const FELD_ERROR_DATE = 'Das eingegebene Datum ist ung&uuml;ltig.';
  const FELD_ERROR_INJECTION = 'Die Eingabe enth&auml;lt ung&uuml;ltige Zeichen.';

  public function __construct(){
    $nonascii      = "\x80-\xff";
    $nqtext        = "[^\\\\$nonascii\015\012\"]";
    $qchar         = "\\\\[^$nonascii]";
    $normuser      = '[a-zA-Z0-9][a-zA-Z0-9_.-]*';
    $quotedstring  = "\"(?:$nqtext|$qchar)+\"";
    $user_part     = "(?:$normuser|$quotedstring)";
    $dom_mainpart  = '[a-zA-Z0-9][a-zA-Z0-9._-]*\\.';
    $dom_subpart   = '(?:[a-zA-Z0-9][a-zA-Z0-9._-]*\\.)*';
    $dom_tldpart   = '[a-zA-Z]{2,5}';
    $log_date      = date('d-m-Y');
    $log_dir       = "log/";
    $hacklog_file  = "_hacklog.txt";
    $domain_part   = "$dom_subpart$dom_mainpart$dom_tldpart";
    $pattern       = "$user_part\@$domain_part";
    $this->pattern_email = "/^{$pattern}$/";
    $this->hack_log= "$log_dir$log_date$hacklog_file";
  }

  /**
  * Method for clear input
  *
  * @param  mixed  $input Userinput
  * @return mixed  Return cleared input
  */

  final public function writeLog($key, $value, $ip, $ua, $sid){
    if($file = fopen($this->hack_log, 'a')){
      fwrite($file, '
Code-Injection Versuch
----------------------
Datum     : '.date('d.m.Y').'
Uhrzeit   : '.date('H:i:s').'
IP-Adresse: '.$ip.'
UserAgent : '.$ua.'
SessionID : '.$sid.'
Input-Feld: '.$key.'
Inhalt    : '.$value.'

      ');
      fclose($file);
    }else{
      echo 'Konnte Logfile nicht &Ouml;ffnen!';
    }
  }
  
  final private function checkErrors($ar){
    if(count(self::getError()) > 0){
      foreach(self::getError() as $feld => $fehler){
        self::writeLog($feld, $ar[$feld]);
      }
    }
  }

  final public function clear(&$input){
    if(get_magic_quotes_gpc()){
      $input = stripslashes($input);
    }
    $input = trim($input);
    $input = preg_replace($this->clear_searchexp, $this->clear_replace, $input);
    $input = wordwrap($input,45," ",true);
    return $input;
  }

  /**
  * Method for check the input of injections
  *
  * @param  mixed  $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @return mixed  Return the cleared input
  */
  final public function injection(&$input,$label){
    foreach($this->sql_injection as $injection){
      if(preg_match("/{$injection}/i",$input)){
        $this->feld_error[$label] = self::FELD_ERROR_INJECTION;
        $input = '';
        return true;
      }
    }
    foreach($this->script_injection as $injection){
      if(preg_match("/{$injection}/i",$input)){
        $this->feld_error[$label] = self::FELD_ERROR_INJECTION;
        $input = '';
        return true;
      }
    }
    /*
    foreach($this->email_injection as $injection){
      if(preg_match("/{$injection}/i",$input)){
        $this->feld_error[$label] = self::FELD_ERROR_INJECTION;
        $input = '';
      }
    }
    */
    return false;
  }
  
  final public function checkNumeric(&$input,$label){
    if(is_numeric($input))
      return true;
    else
      return false;
  }

  final public function checkColorHEX(&$input,$label){
    if(preg_match("/^[0-9a-f]{6}$/i", $input))
      return true;
    else
      return false;
  }

  /**
  * Method for check the input of a valid integer
  *
  * @param  integer $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @return mixed  Return input or FALSE
  */
  final public function checkInteger(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(preg_match($this->pattern_integer,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid PLZ
  *
  * @param  integer $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @return mixed  Return input or FALSE
  */
  final public function checkPLZ(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(preg_match($this->pattern_plz,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid date
  *
  * @param  mixed  $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @param  string $trennzeichen Delimiter for datestring
  * @return mixed  Return input or FALSE
  */
  final public function checkDate(&$input,$label,$delimiter){
    self::clear($input);
    self::injection($input,$label);
    $ex = explode($delimiter,$input);
    if(strlen($ex[0])>4 || strlen($ex[0])<4)
      return false;
    elseif(strlen($ex[1])>2 || strlen($ex[1])<2 || strlen($ex[2])>2 || strlen($ex[2])<2)
      return false;
    elseif(!$this->checkNumeric($ex[0],'') || !$this->checkNumeric($ex[1],'') || !$this->checkNumeric($ex[2],''))
      return false;
    else
      return true;
  }

  /**
  * Method for check the input of a valid phone-number
  *
  * @param  mixed $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @return mixed  Return input or FALSE
  */
  final public function checkPhone(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(preg_match($this->pattern_phone,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid moneystring
  *
  * @param  mixed $input Userinput
  * @param  string $label Name of field for showing the errormessage.
  * @return mixed  Return input or FALSE
  */
  final public function checkMoney(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(preg_match($this->pattern_money,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid string
  *
  * @param  string  $input Userinput
  * @param  string  $label Name of field for showing th errormessage
  * @param  integer $min_length Minimum length of string (optional)
  * @param  integer $max_length Maximum length of string (optional)
  * @return mixed   Return input or FALSE
  */
  final public function checkWord(&$input,$label,$min_length=999,$max_length=999){
    self::clear($input);
    self::injection($input,$label);
    if($min_length != 999){
      if(strlen($input) < $min_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOSHORT;
        return false;
      }
    }
    if($max_length != 999){
      if(strlen($input) > $max_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOBIG;
        return false;
      }
    }
    if(preg_match($this->pattern_word,$input )){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid name
  *
  * @param  string  $input Userinput
  * @param  string  $label Name of field for showing the errormessage
  * @param  integer $min_length Minimum length of input (optional)
  * @param  integer $max_length Maximim length of input (optional)
  * @return mixed   Return input or FALSE
  */
  final public function checkName(&$input,$label,$min_length=999,$max_length=999){
    self::clear($input);
    self::injection($input,$label);
    if($min_length != 999){
      if(strlen($input) < $min_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOSHORT;
        return false;
      }
    }
    if($max_length != 999){
      if(strlen($input) > $max_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOBIG;
        return false;
      }
    }
    if(preg_match($this->pattern_name,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of injections in long texts
  *
  * @param  string  $input Userinput
  * @param  string  $label Name of field for showing the errormessage
  * @param  integer $min_length Minimum length of input (optional)
  * @param  integer $max_length Maximum length of input (optional)
  * @return mixed   Return input or FALSE
  */
  final public function checkText(&$input,$label,$min_length=999,$max_length=999){
    self::clear($input);
    self::injection($input,$label);
    if($min_length != 999){
      if(strlen($input) < $min_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOSHORT;
        return false;
      }
    }
    if($max_length != 999){
      if(strlen($input) > $max_length){
        $this->feld_error[$label] = self::FELD_ERROR_TOBIG;
        return false;
      }
    }
    return $input;
  }

  /**
  * Method for check the input of a valid email-address
  *
  * @param  string  $input Userinput
  * @param  string  $label Name of field for showing the errormessage
  * @return mixed   Return the input or FALSE
  */
  final public function checkEmail(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(preg_match($this->pattern_email,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for check the input of a valid url
  *
  * @param  string  $input Userinput
  * @param  string  $label Name of the field for showing the errormessage
  * @return mixed   Return the input or FALSE
  */
  final public function checkURL(&$input,$label){
    self::clear($input);
    self::injection($input,$label);
    if(strtolower(substr($input,0,7)) != "http://" && strtolower(substr($input,0,8)) != "https://"){
      $input = "http://" .$input;
    }
    if(preg_match($this->pattern_url,$input)){
      return $input;
    }else{
      $this->feld_error[$label] = self::FELD_ERROR_FORMAT;
      return false;
    }
  }

  /**
  * Method for showing the errormessage
  *
  * @return array Return a array with errormessages
  */
  final public function getError(){
    return $this->feld_error;
  }
}

?>