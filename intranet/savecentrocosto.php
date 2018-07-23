<?php
session_start();
include('../connect.php');
$a = $_POST['centro_codigo'];
$b = $_POST['centro_name'];
$c = $_POST['empresa'];

// query
$result=mysql_query("INSERT INTO centro_costo (centro_codigo, centro_nombre, empresa_id, user_create) VALUES('$a','$b','$c','$username')");

header("location: centrocosto.php");


?>