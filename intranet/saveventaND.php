<?php

include('../connect.php');

$a = $_POST['cliente_id'];
$c = $_POST['idInvoice'];
$c1 = $_POST['invoiceReferencia'];

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

$e = date('Y-m-d');
$f = date('Y-m-d');
$g = date('Y-m-d');
$h = '';

$result=mysql_query("select centro_codigo from centro_costo where empresa_id = $sesionEmpresaID and sucursal_id = $sesionSucursalID AND `delete`='0'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$i = $row['centro_codigo'];
}

$k = $_POST['tipo_documento'];
// query


$resultINS=mysql_query("INSERT INTO sales (invoice_number, invoice_reference, causa_emision_id,correlativo, fecha_factura, fecha_vencimiento, fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, user_create) 
			VALUES ('','$c1', 3,'$d','$e','$f', '$g', '$a', '$h', '$i', $sesionEmpresaID, $sesionSucursalID, $k, '$username')");
								
$resultSELECT=mysql_query("SELECT transaction_id FROM sales WHERE correlativo=$d AND customer_id = $a AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND tipo_documento_id=$k AND centro_id = $i AND `delete`='0'");
while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
	$tid=$row['transaction_id'];
}



$listaids = $_POST['listaIds'];

$b = $_POST['observaciones'];
$c = $_POST['adicional'];
$sp = $_POST['cliente_id'];
$i = $tid;
$strIds = $_POST['strIds'];

$result = mysql_query("UPDATE sales SET adicional=$c, observaciones='$b', forma_pago_id=$a WHERE transaction_id=$i");

$arrayIds = explode("|",$strIds);

foreach ($arrayIds as $idItem) {

	$d = $_POST['qty-'.$idItem];
	$e = $_POST['cost-'.$idItem];
	$f = $_POST['descuento-'.$idItem];
	$g = $_POST['ventas-'.$idItem];
	$h = $_POST['id-'.$idItem];

	$resultSELECT=mysql_query("SELECT * FROM sales_order WHERE id=$h AND `delete`='0'");
	while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
	{
		$ab1 = $row['product_id'];
		//$ab2 = $row['qty'];
		//$ab3 = $row['cost'];
	}
	$resultINS = mysql_query("INSERT INTO sales_order (product_id,qty,cost,invoice, descuento, empresa_id, sucursal_id, user_create) 
					VALUES ('$ab1','$d','$e','$tid', '$f',$sesionEmpresaID, $sesionSucursalID, '$username')");
	
	//$result = mysql_query("UPDATE sales_order SET qty=$d, cost=$e, descuento=$f  WHERE id=$h");

}

//$result = mysql_query("INSERT claveSII(id_invoice, fecha, tipo_documento, estado, user_create) values($i, '".getdate()."',$a, 1, '$username')");


header("location: ventasportal.php?tipo=$k&ivReferencia=$tid&sp=$a&edita=monto");

?>