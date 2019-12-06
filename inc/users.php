<?php
ini_set('session.save_path', 'sesje');

class User {

	var $dane = array();
	var $keys = array('id', 'login', 'haslo', 'email', 'data');

	function __construct() {
		if (!isset($_SESSION)) session_start();
	}

	function login($login, $haslo) {
		if ($this->is_user($login, $haslo)) {
			$_SESSION['dane'] = $this->dane;
		}
	}

	function is_user($login=NULL, $haslo=NULL) {
		if (!empty($login)) {
				$q="SELECT * FROM users WHERE login='$login' AND haslo='".sha1($haslo)."' LIMIT 1";
		} else return false;

		Baza::db_query($q);
		if (!empty(Baza::$ret[0])) {
			$this->dane=array_merge($this->dane,Baza::$ret[0]);
			$sid=sha1($this->id.$this->login.session_id());
			$_SESSION['sid'] = $sid; // zapis identyfikatora sesji
			return true;
		}
		return false;
	}

	function __set($k, $v) {
		$this->dane[$k] = $v;
	}

	function __get($k) {
		if (array_key_exists($k, $this->dane))
			return $this->dane[$k];
		else
			return null;
	}

	function is_login($login) {
		$qstr='SELECT id FROM users WHERE login=\''.$login.'\' LIMIT 1';
    if (Baza::db_query($qstr)) return true;
    return false;
	}

	function is_email($email) {
		$qstr='SELECT id FROM users WHERE email=\''.$email.'\' LIMIT 1';
    if (Baza::db_query($qstr)) return true;
    return false;
	}

  function savtb() {//tab. asocjacyjna z kluczami: id#login#haslo#email#datad
		if (strlen($this->haslo)<40) $this->haslo=sha1($this->haslo);
		$this->llog=time();
		if (!$this->id) {
			$qstr='INSERT INTO users VALUES (NULL,\''.$this->login.'\',\''.$this->haslo.'\',\''.$this->email.'\',time())';
			Baza::db_exec($qstr);
			$id = db_lastInsertID();
		}
		if (Baza::$ret) return true;
		return false;
	}

}

?>