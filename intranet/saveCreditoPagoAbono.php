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
	
	$resultMontoFactura = mysql_query("SELECT sum(monto) as monto from (SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0
	UNION ALL
	SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order_history so WHERE so.invoice = $idItem AND so.`delete` = 0) AS monto ");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{
			$montoFactura = $rowMonto['monto'];
		}
		//echo $montoFactura.' - '.$resto;
	if(intval($montoFactura)==intval($resto)){
		$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
		$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
		$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')");
	//echo '-a';
	}else{
		if(intval($montoFactura)<=intval($resto)){
			$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
			$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
			$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')");
		}else{
			$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$resto', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')");
		}
	}
	$resto = intval($resto) - intval($montoFactura);
	//echo '-'.$resto;
}

 header("location: credito.php?customer_id=$cliente_id");

?>



