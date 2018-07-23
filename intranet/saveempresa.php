<?php
session_start();
include('../connect.php');
$a0 = $_POST['nombre'];
$a = $_POST['rut'];
$b = $_POST['direccion'];
$c = $_POST['telefono'];
$d = $_POST['representante_legal'];

// query


$result=mysql_query("INSERT INTO empresa (empresa_nombre,empresa_rut,empresa_direccion,empresa_telefono,empresa_representante_legal, user_create) VALUES ('$a0','$a','$b','$c','$d', '$username')");

header("location: empresa.php");

?>