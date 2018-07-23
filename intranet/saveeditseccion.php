<?php
// configuration
include('../connect.php');

// new data
$a0 = $_POST['ubicacion'];
$a = $_POST['capacidad'];
$b = $_POST['tipo'];
$c = $_POST['bodega'];
$id = $_POST['memi'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE seccion 
        SET ubicacion='$a0', capacidad='$a' , tipo= '$b', bodega_id= '$c', user_update='$username', date_update='$current_date'
		 WHERE seccion_id ='$id'");

header("location: secciones.php");

?>