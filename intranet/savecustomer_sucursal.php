<?php
session_start();
include('../connect.php');
$a0 = $_POST['memi'];
$a = $_POST['name'];
$b = $_POST['direccion'];
$b1 = $_POST['ciudad'];
$b2 = $_POST['comuna'];
$c = $_POST['contacto'];
$c1 = $_POST['telefono'];
$e1 = $_POST['email'];
$f = $_POST['rutCliente'];

// query

$result=mysql_query("INSERT INTO customer_sucursal (customer_sucursal_direccion, customer_sucursal_ciudad, customer_sucursal_comuna , customer_sucursal_contacto, customer_sucursal_telefono, customer_sucursal_email,customer_id) 
													values('$b', '$b1', '$b2', '$c', '$c1', '$e1', $f)");

//echo "INSERT INTO customer_sucursal (customer_sucursal_direccion, customer_sucursal_ciudad, customer_sucursal_comuna , customer_sucursal_contacto, customer_sucursal_telefono, customer_sucursal_email,customer_id) 
//													values('$b', '$b1', '$b2', '$c', '$c1', '$e1', $f)";
header("location: customer_sucursal.php");

?>