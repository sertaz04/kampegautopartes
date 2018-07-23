<?php

include('../connect.php');

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
$k = $_POST['tipo_documento'];
$l = $_POST['forma_pago'];

$guia1 = $_POST['chofer'];
$guia1rut = $_POST['chofer_rut'];
$guia2 = $_POST['dir_origen'];
$guia3 = $_POST['dir_destino'];
$guia4 = $_POST['ciudad_origen'];
$guia5 = $_POST['ciudad_destino'];
$guia6 = $_POST['tipo_traslado'];
$guia7 = $_POST['transportista_rut'];
$guia8 = $_POST['transportista'];
$guia9 = $_POST['patente_camion'];
$guia10 = $_POST['patente_carro'];

//actualiza cliente
/*
$customer1 = $_POST['address'];
$customer2 = $_POST['ciudad'];
$customer3 = $_POST['comuna'];
$customer4 = $_POST['phone'];
$customer5 = $_POST['contact'];
$customer6 = $_POST['prod_name'];
*/

//$result = mysql_query("UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a");
//echo "UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a";

// query
$resultINS=mysql_query("INSERT INTO sales (invoice_number,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id, customer_sucursal_id, tipo_productos, 
						centro_id, empresa_id, sucursal_id, tipo_documento_id, forma_pago_id, user_create, chofer, direccion_origen, direccion_destino, 
						ciudad_origen, ciudad_destino, tipo_traslado_id,
						chofer_rut, transportista_rut, transportista, patente_camion, patente_carro) 
						VALUES ('$c','$d','$e','$f', '$g', '$a', '$a1', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$l', '$username',
						'$guia1','$guia2','$guia3','$guia4','$guia5','$guia6', '$guia1rut', '$guia7', '$guia8', '$guia9', '$guia10')");
/*
					echo "INSERT INTO sales (invoice_number,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id, customer_sucursal_id, tipo_productos, 
						centro_id, empresa_id, sucursal_id, tipo_documento_id, forma_pago_id, user_create, chofer, direccion_origen, direccion_destino, 
						ciudad_origen, ciudad_destino, tipo_traslado_id,
						chofer_rut, transportista_rut, transportista, patente_camion, patente_carro) 
						VALUES ('$c','$d','$e','$f', '$g', '$a', '$a1', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$l', '$username',
						'$guia1','$guia2','$guia3','$guia4','$guia5','$guia6', '$guia1rut', '$guia7', '$guia8', '$guia9', '$guia10')";
*/
$resultSELECT=mysql_query("SELECT transaction_id FROM sales WHERE correlativo=$d AND customer_id = $a AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND tipo_documento_id=$k AND centro_id = $i AND `delete`='0'");

while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
$tid=$row['transaction_id'];
}

header("location: ventasportal.php?tipo=$k&iv=$tid&sp=$a");

?>