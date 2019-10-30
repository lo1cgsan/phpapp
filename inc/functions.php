<?php

// $pages = array(
// 	'witam' => 'Witamy',
// 	'formularz' => 'Formularz',
// 	'klasa' => 'Klasy'
// );

// github.com/lo1cgsan/phpapp
// tablica asocjcyjna, która będzie zawierała wyniki zapytań
$ret = array();

function get_menu($id) {
	global $db, $ret;
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
	global $ret;
	foreach ($ret as $k => $t) {
		//echo $t['id']." ";
		if ($t['plik'] == $id) {
			echo $t['tytul'];
			return;
		}
	}
	// tytuł domyślny
	echo 'Aplikacja PHP';
}

function get_page_content($id) {
	if (file_exists($id.'.html'))
		include($id.'.html');
	else
		include('404.html');
}

?>