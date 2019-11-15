<?php

class User {

	var $dane = array();
	var $keys = array('id', 'login', 'haslo', 'email', 'data');

	function is_user($sid, $login=NULL, $haslo=NULL) {
		if (!empty($login)) {
				$qstr='SELECT * FROM users WHERE login = \''.$login.'\' AND haslo = \''.sha1($haslo).'\' LIMIT 1';
		} else return false;

		$ret=array();
		db_query($qstr,$ret);
		if (!empty($ret[0])) {
			$this->dane=array_merge($this->dane,$ret[0]);
			$sid=sha1($this->id.$this->login.session_id());
			$_SESSION[$this->uVal] = $sid; // zapis identyfikatora sesji
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
    if (db_query($qstr)) return true;
    return false;
	}

	function is_email($email) {
		$qstr='SELECT id FROM users WHERE email=\''.$email.'\' LIMIT 1';
    if (db_query($qstr)) return true;
    return false;
	}

  function savtb() {//tab. asocjacyjna z kluczami: id#login#haslo#email#datad
		if (strlen($this->haslo)<40) $this->haslo=sha1($this->haslo);
		$this->llog=time();
		if (!$this->id) {
			$qstr='INSERT INTO users VALUES (NULL,\''.$this->login.'\',\''.$this->haslo.'\',\''.$this->email.'\',time())';
			$ret=db_exec($qstr);
			$id = db_lastInsertID();
		}
		if ($ret) return true;
		return false;
	}

}

?>