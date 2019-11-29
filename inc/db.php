<?php

class Baza {
	static private $db = null;
	static public $ret = array();
	static public $kom = array();

	public function __construct($dbfile) {
		if (!file_exists($dbfile)) self::$kom[] = 'Brak pliku bazy. Tworzę nowy.';
		self::$db = new PDO("sqlite:$dbfile");
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::init_tables();
	}


	function init_tables() {
		if (file_exists(DBASE.'baza.sql')) {
			$q = "SELECT name FROM sqlite_master WHERE type='table' AND name='menu'";
			self::db_query($q);
			if (empty(self::$ret)) {
				$sql = file_get_contents(DBASE.'baza.sql', 'r');
				self::db_exec($sql);
				self::$kom[] = "Utworzono tabele!";
			}
		}
	}


	static public function db_query($q) {
		try {
			self::$ret = self::$db->query($q, PDO::FETCH_ASSOC)->fetchAll();
			self::$kom[] = 'Wykonuję: '.$q.'<br>';
		} catch(PDOException $e) {
			echo ($e->getMessage());
		}
	}

	static public function db_exec($q) {
		try {
			self::$db->exec($q);
			self::$kom[] = 'Wykonuję: '.$q.'<br>';
		} catch(PDOException $e) {
			echo ($e->getMessage());
		}
	}

}

?>