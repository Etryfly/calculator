<?php
include('config.php');
$link = mysql_connect($host, $user, $pass) or die("Access denied");
mysql_select_db($db_name);
mysql_query('SET COLLATION_CONNECTION="utf8_general_ci"');


	$out = 0;
	$rows = mysql_query('SELECT * FROM percent WHERE st=3');
	$DB_v = mysql_fetch_array($rows);
	/*if ($_POST['v'] > $DB_v['usl']) { echo $DB_v['percent'];} else {
		$a = mysql_query('SELECT COUNT(1) FROM percent where st = 1');
		$c = mysql_fetch_array($a);
		$rows = mysql_query('SELECT * FROM percent WHERE st=1 ');
		for ($i = 0; $i < $c[0]; $i++) {
			$DB_max = mysql_fetch_array($rows);
			if ($_POST['max'] > $DB_max['usl']) {
				$out = $DB_max['percent'];
			}

		}*/
	$out_a = 0;
	$out_b = 0;
	if (50 > $DB_v['usl']) { $out_a = $DB_v['percent'];}
	$a = mysql_query('SELECT COUNT(1) FROM percent where st = 1');
	$c = mysql_fetch_array($a);
	$rows = mysql_query('SELECT * FROM percent WHERE st=1 ');
	for ($i = 0; $i < $c[0]; $i++) {
		$DB_max = mysql_fetch_array($rows);
		if (801 > $DB_max['usl']) {
			$out_b = $DB_max['percent'];
		}



	}
	if ($out_a > $out_b) {
		echo $out_a;
	} else { echo $out_b;}


?>

