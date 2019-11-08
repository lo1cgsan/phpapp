<?php
function init_baza() {
	global $db, $dbfile, $kom;
	if (!file_exists($dbfile)) $kom[] = 'Brak pliku bazy. Tworzę nowy.';

	$db = new PDO("sqlite:$dbfile");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}


function init_tables() {
	global $db;
	if (file_exists(DBASE.'baza.sql')) {
		$sql = file_get_contents(DBASE.'baza.sql', 'r');
		$q = "SELECT name FROM sqlite_master WHERE type='table' AND name='menu'";
		$ret = array();
		db_query($q, $ret);
		if (empty($ret)) {
			$db->exec($sql);
			$kom[] = "Utworzono tabele!";
		}
	}
}


function db_query($q, &$ret) {
	global $db;
	$r = null;
	try {
		$r = $db->query($q);
	} catch(PDOException $e) {
		echo ($e->getMessage());
	}
	if ($r) {
		$ret = $r->fetchAll(PDO::FETCH_ASSOC);
		return true;
	}
	return false;
}

?>