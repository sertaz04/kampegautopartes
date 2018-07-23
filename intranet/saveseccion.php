<?php
session_start();
include('../connect.php');
$a0 = $_POST['ubicacion'];
$a = $_POST['capacidad'];
$b = $_POST['tipo'];
$c = $_POST['bodega'];

// query


$result=mysql_query("INSERT INTO seccion (ubicacion,capacidad,tipo, bodega_id, empresa_id, user_create) VALUES ('$a0','$a','$b', '$c', $sesionEmpresaID, '$username')");

header("location: secciones.php");


?>