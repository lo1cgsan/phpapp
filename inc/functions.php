<?php

// $pages = array(
// 	'witam' => 'Witamy',
// 	'formularz' => 'Formularz',
// 	'klasa' => 'Klasy'
// );

// github.com/lo1cgsan/phpapp
// tablica asocjcyjna, która będzie zawierała wyniki zapytań
$ret = array();

function get_menu($id, &$strona) {
	Baza::db_query('SELECT * FROM menu');
 	foreach (Baza::$ret as $k => $t) {
		echo '
<li class="nav-item">
    <a class="nav-link';

    if ($t['id'] == $id) {
    	echo ' active';
    	$strona = $t;
    }

    echo '" href="?id='.$t['id'].'">'.$t['tytul'].'</a>
</li>
		';
	}
}

function get_page_title($strona) {
	if (array_key_exists('tytul', $strona))
		echo $strona['tytul'];
	else
		echo 'Aplikacja PHP';
}

function get_page_content($strona) {
	if (array_key_exists('plik', $strona))
		if (file_exists($strona['plik'].'.html'))
			include($strona['plik'].'.html');
		else
			include('404.html');
}

function clrtxt(&$el, $maxdl=30) {
    if (is_array($el)) {
        return array_map('clrtxt', $el);
    } else {
        $el = trim($el);
        $el = substr($el, 0, $maxdl);
        if (get_magic_quotes_gpc()) $el = stripslashes($el);
        $el = htmlspecialchars($el, ENT_QUOTES);
        return $el;
    }
}

function get_koms($kom) {
	foreach ($kom as $k) {
		echo "<p class=\"text-info\">$k</p>";
	}
}

?>