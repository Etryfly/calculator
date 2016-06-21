<?php
include('config.php');
$link = mysql_connect($host, $user, $pass) or die("Access denied");
mysql_select_db($db_name);
mysql_query('SET NAMES  uft8');
mysql_query('SET CHARACTER SET  uft8');
mysql_query("SET character_set_results = utf8");
mysql_query('SET COLLATION_CONNECTION="utf8_general_ci"');







$query = "select * from direct ";
$result = mysql_query($query) or die(mysql_error());
$a = mysql_query("SELECT COUNT(1) FROM direct"); //число строк в таблице
$c = mysql_fetch_array( $a );

for ($k = 0; $k < $c[0]; $k++){
    $row = mysql_fetch_array($result);
    print '<option  value='.($k+1).'>'.$row[1].'</option>';
    print "<br>";

}

?>

