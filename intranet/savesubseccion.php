<?php
session_start();
include('../connect.php');
$a = $_POST['subseccion_nombre'];
$b = $_POST['bodega'];
$c = $_POST['seccion'];

// query


$result=mysql_query("INSERT INTO subseccion (subseccion_nombre,bodega_id,seccion_id, empresa_id, user_create) VALUES ('$a','$b', '$c', $sesionEmpresaID, '$username')");

//echo "INSERT INTO subseccion (subseccion_nombre,bodega_id,seccion_id, empresa_id, user_create) VALUES ('$a','$b', '$c', $sesionEmpresaID, '$username')";

header("location: subsecciones.php");


?>