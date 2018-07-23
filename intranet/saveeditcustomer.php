<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a0 = $_POST['rut'];
$a = $_POST['name'];
$b = $_POST['address'];
$b1 = $_POST['ciudad'];
$b2 = $_POST['comuna'];
$c = $_POST['contact'];
$c1 = $_POST['phone'];
$d = $_POST['memno'];
$e = $_POST['prod_name'];
$e1 = $_POST['email'];
$f = $_POST['note'];
$g = $_POST['date'];
$timestamp = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));

$h = $_POST['tipo_cliente'];
$i = $_POST['bloqueado'];
$j = $_POST['rutlibre'];
$k = $_POST['permiteDescuento'];
$l = $_POST['porc_max'];
$m = $_POST['saldo_max'];
$n = $_POST['vendedor_cartera'];

// query


if($userposition=='Administrador'){
$result = mysql_query("UPDATE customer 
        SET rut= '$a0', customer_name='$a', address='$b', ciudad='$b1', comuna='$b2', contact='$c', 
		membership_number='$d', prod_name='$e', email='$e1', note='$f', expected_date='$g', phone='$c1', user_update='$username', 
		date_update='$timestamp', tipo_cliente='$h', bloqueado='$i', rut_libre='$j', descuento='$k', porcentaje_maximo_descuento='$l', 
		saldo_maximo='$m', vendedor_cartera='$n' 
		WHERE customer_id=$id");
}else{
$result = mysql_query("UPDATE customer 
        SET rut= '$a0', customer_name='$a', address='$b', ciudad='$b1', comuna='$b2', contact='$c', 
		membership_number='$d', prod_name='$e', email='$e1', note='$f', expected_date='$g', phone='$c1', user_update='$username', 
		date_update='$timestamp'
		WHERE customer_id=$id");	
}

header("location: customer.php");

?>