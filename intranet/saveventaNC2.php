<?php

include('../connect.php');

$a = $_POST['rutCliente2hidden'];
$c = $_POST['idInvoice'];
$c1 = $_POST['idReferencia2'];
//$d = $_POST['correlativo'];


$result=mysql_query("SELECT
		CASE WHEN MAX( correlativo ) +1 > 0
		THEN MAX( correlativo ) +1
		ELSE 1
		END AS correlativo
		FROM  sales
		WHERE MONTH( fecha_factura ) = MONTH( CURDATE( ) )
		AND empresa_id = $sesionEmpresaID
		AND `delete`='0'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$d = $row['correlativo'];
}

$e = $_POST['fechaFactura'];
$f = $_POST['fechaVencimiento'];
$g = $_POST['fechaIngreso'];
$h = $_POST['tipoProducto'];

$i = $_POST['codigoCentro'];
//$j = $_POST['nombreCentro'];
$k = $_POST['tipo_documento'];

//actualizamos el cliente

$customer1 = $_POST['address'];
$customer2 = $_POST['ciudad'];
$customer3 = $_POST['comuna'];
$customer4 = $_POST['phone'];
$customer5 = $_POST['contact'];
$customer6 = $_POST['prod_name'];

$result = mysql_query("UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a");
//echo "UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a";


// query
//echo "INSERT INTO sales (invoice_number, invoice_reference,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) 
//								VALUES ('','$c1','$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')";

$resultINS=mysql_query("INSERT INTO sales (invoice_number, invoice_reference, causa_emision_id,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) 
								VALUES ('','$c1', 2,'$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')");
								
$resultSELECT=mysql_query("SELECT transaction_id FROM sales WHERE correlativo=$d AND customer_id = $a AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND tipo_documento_id=$k AND centro_id = $i AND `delete`='0'");
while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
	$tid=$row['transaction_id'];
}

//subitems
$resultSELECTSI=mysql_query("SELECT * FROM sales_order WHERE invoice=$c1 AND `delete`='0'");
while($rowSI = mysql_fetch_array($resultSELECTSI, MYSQL_ASSOC))
{
	$ab1 = $rowSI['product_id'];
	$ab2 = $rowSI['qty'];
	$ab3 = $rowSI['cost'];
	$ab4 = $rowSI['descuento'];
}
$resultINS = mysql_query("INSERT INTO sales_order (product_id,qty,cost,invoice,descuento , empresa_id, sucursal_id, user_create) 
VALUES ('$ab1','$ab2','$ab3','$tid', '$ab4', $sesionEmpresaID, $sesionSucursalID, '$username')");

//history


$result=mysql_query("SELECT
		CASE WHEN MAX( correlativo ) +1 > 0
		THEN MAX( correlativo ) +1
		ELSE 1
		END AS correlativo
		FROM  sales_history
		WHERE MONTH( fecha_factura ) = MONTH( CURDATE( ) )
		AND empresa_id = $sesionEmpresaID
		AND `delete`='0'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$d = $row['correlativo'];
}

$e = $_POST['fechaFactura'];
$f = $_POST['fechaVencimiento'];
$g = $_POST['fechaIngreso'];
$h = $_POST['tipoProducto'];

$i = $_POST['codigoCentro'];
//$j = $_POST['nombreCentro'];
$k = $_POST['tipo_documento'];

//actualizamos el cliente

$customer1 = $_POST['address'];
$customer2 = $_POST['ciudad'];
$customer3 = $_POST['comuna'];
$customer4 = $_POST['phone'];
$customer5 = $_POST['contact'];
$customer6 = $_POST['prod_name'];

$result = mysql_query("UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a");
//echo "UPDATE customer SET address= '$customer1', ciudad='$customer2', comuna='$customer3', phone='$customer4', contact='$customer5', prod_name='$customer6' WHERE customer_id=$a";


// query
//echo "INSERT INTO sales (invoice_number, invoice_reference,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) 
//								VALUES ('','$c1','$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')";

$resultINS=mysql_query("INSERT INTO sales_history (invoice_number, invoice_reference, causa_emision_id,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) 
								VALUES ('','$c1', 2,'$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')");
								
$resultSELECT=mysql_query("SELECT transaction_id FROM sales_history WHERE correlativo=$d AND customer_id = $a AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND tipo_documento_id=$k AND centro_id = $i AND `delete`='0'");
while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
	$tid=$row['transaction_id'];
}

//subitems
$resultSELECTSI=mysql_query("SELECT * FROM sales_order_history WHERE invoice=$c1 AND `delete`='0'");
while($rowSI = mysql_fetch_array($resultSELECTSI, MYSQL_ASSOC))
{
	$ab1 = $rowSI['product_id'];
	$ab2 = $rowSI['qty'];
	$ab3 = $rowSI['cost'];
	$ab4 = $rowSI['descuento'];
}
$resultINS = mysql_query("INSERT INTO sales_order_history (product_id,qty,cost,invoice,descuento , empresa_id, sucursal_id, user_create) 
VALUES ('$ab1','$ab2','$ab3','$tid', '$ab4', $sesionEmpresaID, $sesionSucursalID, '$username')");



header("location: ventasportal.php?tipo=$k&ivReferencia=$tid&sp=$a&edita=datos");


?>