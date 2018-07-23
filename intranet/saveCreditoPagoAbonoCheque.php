<?php
session_start();
include('../connect.php');

$strIds = $_POST['listadoIdsPago5'];
$cliente_id = $_POST['cliente_id5'];

$fecha_pago = $_POST['fecha_pago5'];
$monto = $_POST['monto5'];
$numero_cheque = $_POST['numero_cheque5'];
$banco_id = $_POST['banco_id5'];
$fecha_cheque = $_POST['fecha_cheque5'];
$tipo_pago = $_POST['tipo_pago5'];
$observaciones = $_POST['observaciones5'];


$arrayIds = explode(",",$strIds);

$resto = $monto;

foreach ($arrayIds as $idItem) {
	//echo 'a';echo $idItem;
	$resultMontoFactura = mysql_query("SELECT SUM(monto) as monto from (SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0
	UNION ALL
	SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order_history so WHERE so.invoice = $idItem AND so.`delete` = 0) as monto");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{//echo 'b';
			$montoFactura = $rowMonto['monto'];
		}
	if(intval($montoFactura)==intval($resto)){
		$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
		$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
		$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, numero_cheque, banco_id, fecha_cheque, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$numero_cheque', $banco_id, '$fecha_cheque', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')");
	/*echo 'c';
	echo "INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, numero_cheque, banco_id, fecha_cheque, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$numero_cheque', $banco_id, '$fecha_cheque', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')";*/
	}else{
		if(intval($montoFactura)<=intval($resto)){
			$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
			$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
			$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, numero_cheque, banco_id, fecha_cheque, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$numero_cheque', $banco_id, '$fecha_cheque', '$tipo_pago', $sesionEmpresaID, '$observaciones',$sesionSucursalID, '$username')");
		}else{
			$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, numero_cheque, banco_id, fecha_cheque, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$resto', '$numero_cheque', $banco_id, '$fecha_cheque', '$tipo_pago', $sesionEmpresaID, '$observaciones',$sesionSucursalID, '$username')");
		}
	}
	$resto = intval($resto) - intval($montoFactura);
}

header("location: credito.php?customer_id=$cliente_id");

?>

