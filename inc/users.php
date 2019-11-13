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
	}

?>