<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['empresa_id'];
$b = $_POST['sucursal_nombre'];
$c = $_POST['sucursal_direccion'];
$d = $_POST['sucursal_telefono'];
$e = $_POST['sucursal_ciudad'];
$f = $_POST['sucursal_comuna'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE sucursal 
        SET empresa_id='$a', sucursal_nombre='$b', sucursal_direccion='$c', sucursal_telefono='$d', sucursal_ciudad='$e', sucursal_comuna='$f', user_update='$username', date_update='$current_date' WHERE sucursal_id ='$id'");

header("location: sucursal.php");

?>