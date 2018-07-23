<?php
session_start();
include('../connect.php');

$tipo = $_POST['tipo'];
$forma_pago = $_POST['forma_pago'];
$a = $_POST['numeroCheque'];
$b = $_POST['banco'];
$c = $_POST['fechaPago'];
$d = $_POST['fecha'];
$e = $_POST['monto'];

$id = $_POST['transaction_id'];
$forma_pago = $_POST['forma_pago'];
$customer_id = $_POST['customer_id'];

// query
$result=mysql_query("INSERT INTO `ventas_impago` (transaction_id,fecha, customer_id, forma_pago_id, estado, numero_cheque, banco, fecha_pago, monto ,empresa_id, sucursal_id, user_create) 
		VALUES('$id','$d', '$customer_id', '$forma_pago','Pdte Pago', '$a', '$b', '$c', '$e', $sesionEmpresaID, $sesionSucursalID, '$username')");


$result= mysql_query("UPDATE sales SET forma_pago_id = $forma_pago WHERE transaction_id = $id");
$result= mysql_query("UPDATE sales_history SET forma_pago_id = $forma_pago WHERE transaction_id = $id");
//echo "INSERT INTO `ventas_impago` (transaction_id,fecha, customer_id, forma_pago_id, estado, numero_cheque, banco, fecha_pago,empresa_id, sucursal_id, user_create) 
//		VALUES('$id','$d', '$customer_id', '$forma_pago','Pdte Pago', '$a', '$b', '$c', $sesionEmpresaID, $sesionSucursalID, '$username')";

header("location: ventasportal.php?tipo=$tipo&iv=$id&sp=$customer_id");

?>