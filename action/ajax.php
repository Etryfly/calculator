<?php
include('config.php');
$link = mysql_connect($host, $user, $pass) or die("Access denied");
mysql_select_db($db_name);
/*mysql_query('SET NAMES  uft8', $db_name);
mysql_query('SET CHARACTER SET  uft8', $db_name);*/
mysql_query('SET COLLATION_CONNECTION="utf8_general_ci"');

switch ($_POST['action']){

    case "usl":
        $variant = 1;
        if ($_POST['direct'] == 4) {
            $variant = 2;
        }
        if ($_POST['direct'] == 5) {
            $variant = 3;
        }
        if ($_POST['direct'] == 6) {
            $variant = 4;
        }
        if ($_POST['direct'] == 7) {
            $variant = 5;
        }
        if ($_POST['direct'] == 8) {
            $variant = 9;
        }
        if ($_POST['direct'] == 9) {
            $variant = 6;
        }
        if ($_POST['direct'] == 10) {
            $variant = 7;
        }
        if ($_POST['direct'] == 11) {
            $variant = 10;
        }
        if ($_POST['direct'] == 12) {
            $variant = 11;
        }
        if ($_POST['direct'] == 13) {
            $variant = 12;
        }
        if ($_POST['direct'] == 14) {
            $variant = 13;
        }
        if ($_POST['direct'] == 15) {
            $variant = 14;
        }
        if ($_POST['direct'] == 16) {
            $variant = 15;
        }
        if ($_POST['direct'] == 17) {
            $variant = 16;
        }
        if ($_POST['direct'] == 18) {
            $variant = 17;
        }




        $rows = mysql_query('SELECT * FROM usloviya WHERE variant= '.$variant.' and id_type='.$_POST['type']);
        $a = mysql_query('SELECT COUNT(1) FROM usloviya where  variant= '.$variant.' and id_type='.$_POST['type']);
        $c = mysql_fetch_array( $a );
        $b =  mysql_query('select max(id) from usloviya where variant= '.$variant.' and id_type='.$_POST['type']);
        $last = mysql_fetch_array( $b );
        $l = mysql_query('SELECT * FROM usloviya WHERE variant= '.$variant.'  and id_type='.$_POST['type']. ' and id='.$last[0]);
        $last_zn = mysql_fetch_array( $l );
        for ($i = 0; $i < $c[0]; $i++ ) {
            $row = mysql_fetch_array($rows);
            $zn = $row['znachenie'];
            if ($_POST['inp'] >= $last_zn['znachenie'] ){echo $last[0];break;  }
                else { if (($_POST['inp'] < $zn )) {
                    /*if ($row['id'] == '') {$id_result = $last['max(id)'];} else {
                        $id_result = $row['id'];
                    }*/
                    $id_result = $row['id'];
                    echo $id_result;
                    //echo $row['id'];

                    break;

                }
            }

            //$id_result = $c[0];
        }
        break;


    case "tarif":
        $rows = mysql_query('SELECT * FROM tarif WHERE id_direct='.$_POST["direct"]. ' and id_usloviya='.$_POST["usloviya"]);

        //$rows = mysql_query("SELECT * FROM tarif WHERE id_direct='1' and id_usloviya='1'");
        $row = mysql_fetch_array($rows);

        //echo '<p>'. $row['tarif']. '</p>';
        echo $row['tarif'];
        break;


    case "min":
        $rows= mysql_query('select min(id) from tarif where id_direct='.$_POST['direct']);
        $min_id = mysql_fetch_array($rows);
        $rows = mysql_query('SELECT tarif FROM `tarif` WHERE id ='.$min_id[0]);
        $min = mysql_fetch_array($rows);
        //$rows = mysql_query('SELECT * FROM tarif WHERE id_direct='.$_POST['direct']. 'and id='.);
        //$rows = mysql_query("SELECT * FROM tarif WHERE id_direct='1' and id_usloviya='1'");
       // $row = mysql_fetch_array($rows);

        //echo '<p>'. $row['tarif']. '</p>';
       // echo $row['tarif'];
        echo $min[0];
        break;

    case "percent":
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
        if ($_POST['v'] > $DB_v['usl']) { $out_a = $DB_v['percent'];}
            $a = mysql_query('SELECT COUNT(1) FROM percent where st = 1');
            $c = mysql_fetch_array($a);
            $rows = mysql_query('SELECT * FROM percent WHERE st=1 ');
            for ($i = 0; $i < $c[0]; $i++) {
                $DB_max = mysql_fetch_array($rows);
                if ($_POST['max'] > $DB_max['usl']) {
                    $out_b = $DB_max['percent'];
                }



            }
            if ($out_a > $out_b) {
                echo $out_a;
            } else { echo $out_b;}

    break;

}

?>

