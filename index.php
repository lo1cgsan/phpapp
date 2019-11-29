<?php
setlocale(LC_ALL, 'pl_PL.UTF-8');
date_default_timezone_set('Europe/Warsaw');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'errorlog.txt');

define('DINC', 'inc/');
define('DBASE', 'db/');
$dbfile = DBASE.'baza.db';
$kom = array();
require_once(DINC.'functions.php');
require_once(DINC.'db.php');
require_once(DINC.'users.php');

$db = new Baza($dbfile);
$user = new User();

if (isset($_GET['id']))
	$id=$_GET['id'];
else
	$id=1;

$strona = array();

include_once(DINC.'template.php');

// echo 'zaq1@WSX';
// echo sha1('zaq1@WSX');
// c380f833034d60bf035a134094eb538d600dc6f9
?>
