<?php
// configuration
include('../connect.php');

// new data
$a0 = $_POST['nombre'];
$a = $_POST['capacidad'];
$b = $_POST['empresa'];
$id = $_POST['memi'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE bodega 
        SET bodega_nombre='$a0', bodega_capacidad='$a' , empresa_id= '$b', user_update='$username', date_update='$current_date'
		 WHERE bodega_id ='$id'");

header("location: bodegas.php");

?>