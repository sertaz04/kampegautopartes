<?php
// configuration
include('../connect.php');

// new data
$a0 = $_POST['nombre'];
$a = $_POST['rut'];
$b = $_POST['direccion'];
$c = $_POST['telefono'];
$d = $_POST['representante_legal'];
$id = $_POST['memi'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE empresa 
        SET empresa_nombre='$a0', empresa_rut='$a' , empresa_direccion= '$b',empresa_telefono = '$c' , empresa_representante_legal = '$d', user_update='$username', date_update='$current_date'
		 WHERE empresa_id ='$id'");

header("location: empresa.php");

?>