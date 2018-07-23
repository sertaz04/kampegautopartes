<?php
// configuration
include('../connect.php');

// new data
$a = $_POST['rutProveedor'];
$b = $_POST['nombreFantasia'];
$c = $_POST['iv'];
$d = $_POST['correlativo'];
$e = $_POST['fechaFactura'];
$f = $_POST['fechaVencimiento'];
$g = $_POST['fechaIngreso'];
$h = $_POST['tipoProducto'];
$i = $_POST['codigoCentro'];
$j = $_POST['nombreCentro'];
$id = $_POST['memi'];
$tipo_documento = $_POST['tipo_documento'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE purchases 
        SET invoice_number= '$c'
		, correlativo= '$d'
		, fecha_factura= '$e'
		, fecha_vencimiento= '$f'
		, fecha_ingreso= '$g'
		, suplier_id= '$a'
		, tipo_productos= '$h'
		, centro_id= '$i'
		, user_update='$username', date_update='$current_date'
		 WHERE transaction_id ='$id'");

header("location: compras.php?tipo=$tipo_documento");

?>