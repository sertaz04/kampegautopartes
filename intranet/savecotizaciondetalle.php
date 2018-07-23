<?php
session_start();
include('../connect.php');
$a0 = $_POST['cotizacion_id'];
$a = $_POST['product_id'];
$b = $_POST['cotizacion_detalle_precio'];
$c = $_POST['cotizacion_detalle_descuento'];
$d = $_POST['cotizacion_detalle_cantidad'];

// query

$result=mysql_query("INSERT INTO cotizaciones_detalle (cotizacion_id, product_id, 0, 0, cotizacion_detalle_cantidad, empresa_id, user_create) VALUES ('$a0','$a','$b','$c','$d', $sesionEmpresaID, '$username')");

echo $result;

//header("location: cotizacionesdetalle.php?id=$a0");

?>