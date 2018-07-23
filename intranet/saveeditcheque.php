<?php
session_start();
include('../connect.php');

$id_cheque = $_POST['id_cheque'];
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
$result=mysql_query("UPDATE `ventas_impago` SET fecha='$d', numero_cheque='$a', banco='$b', fecha_pago='$c', monto='$e', user_update='$username' WHERE id=$id_cheque AND empresa_id = $sesionEmpresaID AND sucursal_id=$sesionSucursalID");

//echo "UPDATE `ventas_impago` SET fecha='$d', numero_cheque='$a', banco='$b', fecha_pago='$c', monto='$e', user_update='$username' WHERE id=$id_cheque AND empresa_id = $sesionEmpresaID AND sucursal_id=$sesionSucursalID";

header("location: ventasportal.php?tipo=$tipo&iv=$id&sp=$customer_id");

?>