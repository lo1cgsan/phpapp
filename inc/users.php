<?php

class User {

	var $dane = array();
	var $keys = array('id', 'login', 'haslo', 'email', 'data');

	function is_user($sid, $login=NULL, $haslo=NULL) {
		if (!empty($login)) {
				$q="SELECT * FROM users WHERE login = '$login' AND haslo = ".sha1($haslo)."' LIMIT 1";
		} else return false;

		Baza::db_query($qstr);
		if (!empty(Baza::$ret[0])) {
			$this->dane = array_merge($this->dane,$db->ret[0]);
			$sid = sha1($this->id.$this->login.session_id());
			$_SESSION[$this->uVal] = $sid; // zapis identyfikatora sesji
			return true;
		}
		return false;
	}

	function is_login($login) {
		$q="SELECT id FROM users WHERE login='$login' LIMIT 1";
		Baza::db_query($q);
    if (Baza::$ret) return true;
    return false;
	}

	function is_email($email) {
		$q="SELECT id FROM users WHERE email='$email' LIMIT 1";
		Baza::db_query($q);
    if (Baza::$ret) return true;
    return false;
	}

  function savtb() {//tab. asocjacyjna z kluczami: id#login#haslo#email#datad
		if (strlen($this->haslo)<40)
			$this->haslo = sha1($this->haslo);
		$this->llog = time();
		if (!$this->id) {
			$q='INSERT INTO users VALUES (NULL,\''.$this->login.'\',\''.$this->haslo.'\',\''.$this->email.'\',time())';
			Baza::db_exec($q);
		}
		$id = Baza::$db->lastInsertId();
		if ($id) return true;
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
}

?>