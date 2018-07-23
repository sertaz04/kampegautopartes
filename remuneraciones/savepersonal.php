<?php
session_start();
include('../connect.php');

/*
rut
*/
// query

$result=mysql_query("INSERT INTO `personal` (nombre,apellido, empresa_id, user_create) VALUES('$a','$b', $sesionEmpresaID, '$username')");

header("location: personal.php");


?>