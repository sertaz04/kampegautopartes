<?php
session_start();
include('../connect.php');

$strIds = $_POST['listadoIdsPago2'];
$cliente_id = $_POST['cliente_id2'];

$forma_pago = $_POST['tipo_pago2'];
$fecha_pago = $_POST['fecha_pago2'];
$monto = $_POST['monto2'];
$numero_cheque = $_POST['numero_cheque2'];
$banco_id = $_POST['banco_id2'];
$fecha_cheque = $_POST['fecha_cheque2'];
$observaciones = $_POST['observaciones'];

$arrayIds = explode(",",$strIds);

$resto = $monto;

foreach ($arrayIds as $idItem) {
	
	$resultMontoFactura = mysql_query("SELECT SUM(monto) AS monto FROM (SELECT ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0
	UNION ALL
	SELECT ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0) AS monto");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{
			$montoFactura = $rowMonto['monto'];
		}
	
	$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
		$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
	$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, numero_cheque, banco_id, fecha_cheque, forma_pago, empresa_id, sucursal_id, user_create)
			VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$numero_cheque', $banco_id, '$fecha_cheque', '$forma_pago', $sesionEmpresaID, $sesionSucursalID, '$username')");
	
	$resto = intval($resto) - intval($montoFactura);
}

header("location: credito.php?customer_id=$cliente_id");

?>

