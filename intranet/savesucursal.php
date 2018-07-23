<?php
session_start();
include('../connect.php');
$a = $_POST['empresa_id'];
$b = $_POST['sucursal_nombre'];
$c = $_POST['sucursal_direccion'];
$d = $_POST['sucursal_telefono'];
$e = $_POST['sucursal_ciudad'];
$f = $_POST['sucursal_comuna'];

// query

$result=mysql_query("INSERT INTO sucursal (sucursal_nombre, sucursal_direccion, sucursal_telefono, sucursal_ciudad, sucursal_comuna, empresa_id, user_create) VALUES('$b','$c','$d' ,'$e', '$f', $sesionEmpresaID, '$username')");

header("location: sucursal.php");


?>