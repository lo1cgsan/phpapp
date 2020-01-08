<?php
ini_set('session.save_path', 'sesje');

class User {

	var $dane = array();
	var $keys = array('id', 'login', 'haslo', 'email', 'data');
	var $CookieName = 'phpapp';
	var $remTime = 7200;
	var $kom = array();

	function __construct() {
		if (!isset($_SESSION)) session_start();
		if (isset($_COOKIE[$this->CookieName]) && !$this->id) {
			$c = unserialize(base64_decode($_COOKIE[$this->CookieName]));
			$this->login($c['login'], $c['haslo'], false, true);
			$this->kom[] = "Witaj {$this->login}! Zostałeś automatycznie zalogowany!";
		}

		if (!$this->id && isset($_POST['login2'])) {
			foreach ($_POST as $k => $v) {
        ${$k} = clrtxt($v);
    	}
    	$this->login($login2, $haslo2, true, true);
		}

	}

	function login($login, $haslo, $rem=false, $load=true ) {
		if ($load && $this->is_user($login, $haslo)) {
			if ($rem) {
				$c = base64_encode(serialize(array('login'=>$login, 'haslo'=>$haslo)));
				$this->kom[] = $c;
				$a = setcookie($this->CookieName, $c, time()+$this->remTime, '/', 'localhost', false, true);
				if ($a) $this->kom[] = 'Zapisano ciasteczko.';
				$this->kom[] = "Witaj $login! Zostałeś zalogowany.";
				return true;
			}
		} else {
			$this->kom[] = 'Błędny login lub hasło!';
			return false;
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
			// $id = db_lastInsertID();
		}
		if (Baza::$ret) return true;
		return false;
	}

	function logout($redirect='') {
		setcookie($this->CookieName, '', time()-(5*$this->remTime), '/', 'localhost', false, true);
		$this->dane = array();
		$_SESSION = array();
		if (session_destroy()) $this->kom[] = 'Zostałeś wylogowany';
		if ($redirect != '' && !headers_sent()) {
			header('Location: '.$redirect);
			exit;
		}
	}

}

// github.com/lo1cgsan/phpapp

?>