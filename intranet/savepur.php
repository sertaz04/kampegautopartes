<?php
session_start();
include('../connect.php');
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
$k = $_POST['tipo_documento'];
// query

$resultINS=mysql_query("INSERT INTO purchases (invoice_number,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, suplier_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) VALUES ('$c','$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')");


$resultSELECT=mysql_query("SELECT transaction_id FROM purchases WHERE correlativo = $d AND suplier_id = $a AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND `delete`='0'");



while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
$tid=$row['transaction_id'];
}

header("location: purchasesportal.php?tipo=$k&iv=$tid&sp=$a&tipo=$k");


?>