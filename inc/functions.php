<?php

// $pages = array(
// 	'witam' => 'Witamy',
// 	'formularz' => 'Formularz',
// 	'klasa' => 'Klasy'
// );

function get_menu($id) {
	global $db;
	$ret = array();
	db_query('SELECT * FROM menu', $ret);
	//print_r($ret);
 	foreach ($ret as $k => $t) {
		echo '
<li class="nav-item">
    <a class="nav-link" href="?id='.$t['plik'].'">'.$t['tytul'].'</a>
</li>
		';
	}
}

function get_page_title($id) {
	global $pages;
	if (array_key_exists($id, $pages))
		echo $pages[$id];
	else
		echo 'Aplikacja PHP';
}

function get_page_content($id) {
	if (file_exists($id.'.html'))
		include($id.'.html');
	else
		include('404.html');
}

?>