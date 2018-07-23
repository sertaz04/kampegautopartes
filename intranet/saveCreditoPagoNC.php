<?php
session_start();
include('../connect.php');

$strIds = $_POST['listadoIdsPago4'];
$cliente_id = $_POST['cliente_id4'];

$fecha_pago = $_POST['fecha_pago4'];
$monto = $_POST['montoNC5'];
$montoPago = $_POST['monto4'];
$tipo_pago = $_POST['tipo_pago4'];
$observaciones = $_POST['observaciones4'];
$strIdsNc = $_POST['listadoIdsListaNC'];

$arrayIds = explode(",",$strIds);
$arrayIdsNC = explode(",",$strIdsNc);

$resto = $monto;

foreach ($arrayIds as $idItem) {
	
	$resultMontoFactura = mysql_query("SELECT ROUND(SUM(monto)) AS monto FROM 
	(SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order so WHERE so.invoice = $idItem AND so.`delete` = 0
	UNION ALL
	SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-(IFNULL((ROUND((SELECT SUM(vp.monto) FROM ventas_pagos vp WHERE vp.transaction_id = so.invoice),0)),0))) as monto FROM sales_order_history so WHERE so.invoice = $idItem AND so.`delete` = 0) AS F");
	while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
		{
			$montoFactura = $rowMonto['monto'];
		}
	//echo $resto .'-'. $montoFactura;
	if(intval($montoFactura)==intval($resto)){
		$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItem");
		$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItem");
		$resultINSERT = mysql_query("INSERT INTO ventas_pagos(transaction_id, customer_id, fecha_pago, monto, forma_pago, empresa_id, observaciones, sucursal_id, user_create) 
								 VALUES($idItem, $cliente_id, '$fecha_pago', '$montoFactura', '$tipo_pago', $sesionEmpresaID, '$observaciones', $sesionSucursalID, '$username')");
	}else{
		if(intval($montoFactura)<intval($resto)){
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
}

$restoNC = $monto;
foreach ($arrayIdsNC as $idItemNC) {
	if($idItemNC!=-1){
		$resultMontoFactura = mysql_query("SELECT ROUND(SUM(monto)) AS monto FROM 
		(SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-monto_efectivo) as monto FROM sales_order so WHERE so.invoice = $idItemNC AND so.`delete` = 0
		union all
		SELECT (ROUND(SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-monto_efectivo) as monto FROM sales_order_history so WHERE so.invoice = $idItemNC AND so.`delete` = 0) AS F");
		while($rowMonto = mysql_fetch_array($resultMontoFactura, MYSQL_ASSOC))
			{
				$montoFacturaNC = $rowMonto['monto'];
			}
		//echo $restoNC .'-'. $montoFacturaNC;
		if($restoNC == $montoPago){
			$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItemNC");
			$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItemNC");
		}else{
			if(intval($montoPago)>intval($restoNC)){
				$result = mysql_query("UPDATE sales SET estado_pago=1 WHERE transaction_id=$idItemNC");
				$result = mysql_query("UPDATE sales_history SET estado_pago=1 WHERE transaction_id=$idItemNC");
			}else{
				$result = mysql_query("UPDATE sales SET monto_efectivo='$montoPago' WHERE transaction_id=$idItemNC");
				$result = mysql_query("UPDATE sales_history SET monto_efectivo='$montoPago' WHERE transaction_id=$idItemNC");
			}
		}
		$restoNC = intval($restoNC) - intval($montoPago);
	}
}


header("location: credito.php?customer_id=$cliente_id");

?>

