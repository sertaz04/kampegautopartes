<?php
session_start();
include('../connect.php');
$a0 = $_POST['nombre'];
$a = $_POST['capacidad'];
$b = $_POST['empresa'];

// query


$result=mysql_query("INSERT INTO bodega (bodega_nombre,bodega_capacidad,empresa_id, user_create) VALUES ('$a0','$a','$b', '$username')");

header("location: bodegas.php");


?>