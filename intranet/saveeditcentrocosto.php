<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['centro_codigo'];
$b = $_POST['centro_name'];
$c = $_POST['empresa'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE centro_costo 
        SET centro_id='$a', centro_nombre='$b', empresa_id='$c', user_update='$username', date_update='$current_date' WHERE centro_id ='$id'");

header("location: centrocosto.php");

?>