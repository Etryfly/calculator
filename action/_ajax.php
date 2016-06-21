<?php
include('config.php');
$link = mysql_connect($host, $user, $pass) or die("Access denied");
mysql_query('SET NAMES uft8');
mysql_select_db($db_name);

switch ($_POST['action']){

    case "showSForInsert":
        if (!$_POST["variant"]) {$_POST["variant"] = 1;};
        //$rows = mysql_query('SELECT * FROM usloviya WHERE id_type=1 and variant='.$_POST["variant"]);
        $rows = mysql_query('SELECT * FROM usloviya WHERE variant=1 and id_type='.$_POST["id_type"]);
        //$a = mysql_query('SELECT COUNT(1) FROM usloviya where id_type=1 and variant='.$_POST["variant"]);
        $a = mysql_query('SELECT COUNT(1) FROM usloviya where  variant=1 and id_type='.$_POST["id_type"]);
        $c = mysql_fetch_array( $a );

        for ($i = 0; $i < $c[0]; $i++ ) {
            $row = mysql_fetch_array($rows);

            echo '<option value="' . $row["id"] . '">' . $row['name'] . '</option>';

        };
        break;


    case "tarif":

        $rows = mysql_query('SELECT * FROM tarif WHERE id_direct='.$_POST["direct"]. ' and id_usloviya='.$_POST["usloviya"]);
        //$rows = mysql_query("SELECT * FROM tarif WHERE id_direct='1' and id_usloviya='1'");
        $row = mysql_fetch_array($rows);

        //echo '<p>'. $row['tarif']. '</p>';
        echo $row['tarif'];
        break;



}





?>

