<?php
// configuration
include('../connect.php');

// new data
$a = $_POST['rutCliente'];
$a1 = $_POST['sucursalCliente'];
$b = $_POST['nombreFantasia'];
$c = $_POST['iv'];
$d = $_POST['correlativo'];
$e = $_POST['fechaFactura'];
$f = $_POST['fechaVencimiento'];
$g = $_POST['fechaIngreso'];
$h = $_POST['tipoProducto'];
$i = $_POST['codigoCentro'];
$j = $_POST['nombreCentro'];

$k = $_POST['chofer_rut'];
$l = $_POST['chofer'];
$m = $_POST['transportista_rut'];
$n = $_POST['transportista'];
$o = $_POST['dir_origen'];
$p = $_POST['dir_destino'];
$q = $_POST['ciudad_origen'];
$r = $_POST['ciudad_destino'];
$s = $_POST['patente_camion'];
$t = $_POST['patente_carro'];
$u = $_POST['tipo_traslado'];

$tipo= $_POST['tipo_documento'];


$id = $_POST['memi'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query

$result = mysql_query("UPDATE sales 
        SET invoice_number= '$c'
		, correlativo= '$d'
		, fecha_factura= '$e'
		, fecha_vencimiento= '$f'
		, fecha_ingreso= '$g'
		, customer_id= '$a'
		, customer_sucursal_id= '$a1'
		, tipo_productos= '$h'
		, centro_id= '$i'
		
		, chofer_rut= '$k'
		, chofer= '$l'
		, transportista_rut= '$m'
		, transportista= '$n'
		, direccion_origen= '$o'
		, direccion_destino= '$p'
		, ciudad_origen= '$q'
		, ciudad_destino= '$r'
		, patente_camion= '$s'
		, patente_carro= '$t'
		, tipo_traslado_id= '$u'
		
		, user_update='$username'
		, date_update='$current_date'
		 WHERE transaction_id ='$id'");

header("location: ventas.php?tipo=$tipo");

/*
echo "UPDATE sales 
        SET invoice_number= '$c'
		, correlativo= '$d'
		, fecha_factura= '$e'
		, fecha_vencimiento= '$f'
		, fecha_ingreso= '$g'
		, customer_id= '$a'
		, customer_sucursal_id= '$a1'
		, tipo_productos= '$h'
		, centro_id= '$i'
		
		, chofer_rut= '$k'
		, chofer= '$l'
		, transportista_rut= '$m'
		, transportista= '$n'
		, direccion_origen= '$o'
		, direccion_destino= '$p'
		, ciudad_origen= '$q'
		, ciudad_destino= '$r'
		, patente_camion= '$s'
		, patente_carro= '$t'
		, tipo_traslado_id= '$u'
		
		, user_update='$username'
		, date_update='$current_date'
		 WHERE transaction_id ='$id'";
*/

?>