<?php
session_start();
include('../connect.php');

$strIds = $_POST['listadoIdsPago'];
$cliente_id = $_POST['cliente_id'];

$fecha_pago = $_POST['fecha_pago'];
$monto = $_POST['monto'];
$tipo_pago = $_POST['tipo_pago'];
$observaciones = $_POST['observaciones'];

$arrayIds = explode(",",$strIds);

$resto = $monto;

foreach ($arrayIds as $idItem) {
	
	$resultMontoFactura = mysql_query("SELECT ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*1.19,0) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{
			$montoFactura = $rowMonto['monto'];
		}
	$result = mysql_query("UPDATE sales SET estado_pago=1, user_update ='$username' WHERE transaction_id=$idItem");
	
		$resultMontoFactura = mysql_query("SELECT ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*1.19,0) as monto FROM sales_order_history so WHERE so.invoice = $idItem AND so.`delete` = 0");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{
			$montoFactura = $rowMonto['monto'];
		}
	$result = mysql_query("UPDATE sales_history SET estado_pago=1, user_update ='$username' WHERE transaction_id=$idItem");
	
	
	//echo "UPDATE sales SET estado_pago=1, user_update ='$username' WHERE transaction_id=$idItem";
	$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, observaciones, numero_cheque, fecha_cheque, empresa_id, sucursal_id, user_create, user_update) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$tipo_pago', '$observaciones','','', $sesionEmpresaID, $sesionSucursalID, '$username','')");
	
	/*echo "INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, observaciones, numero_cheque, fecha_cheque, empresa_id, sucursal_id, user_create, user_update) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$tipo_pago', '$observaciones','','', $sesionEmpresaID, $sesionSucursalID, '$username','')";
	*/$resto = intval($resto) - intval($montoFactura);
}

header("location: credito.php?customer_id=$cliente_id");

?>