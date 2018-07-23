<?php
// configuration
include('../connect.php');

// new data
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



$result = mysql_query("UPDATE customer_sucursal 
        SET 		
		customer_sucursal_direccion = '$b', 
		customer_sucursal_ciudad = '$b1', 
		customer_sucursal_comuna = '$b2', 
		customer_sucursal_contacto = '$c', 
		customer_sucursal_telefono = '$c1', 
		customer_sucursal_email = '$e1'
		WHERE customer_id = $f AND customer_sucursal_id = $a0");
/*
echo "UPDATE customer_sucursal 
        SET 		
		customer_sucursal_direccion = '$b', 
		customer_sucursal_ciudad = '$b1', 
		customer_sucursal_comuna = '$b2', 
		customer_sucursal_contacto = '$c', 
		customer_sucursal_telefono = '$c1', 
		customer_sucursal_email = '$e1'
		WHERE customer_id = $f AND customer_sucursal_id = $a0";
*/
 header("location: customer_sucursal.php");

?>