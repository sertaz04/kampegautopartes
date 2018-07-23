<?php

include('../connect.php');

$a = $_GET['cliente'];
$c1 = $_GET['ivReferencia'];

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

// query
/*echo "INSERT INTO sales (invoice_number, invoice_reference, causa_emision_id,correlativo, fecha_factura, fecha_vencimiento, 
											fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, 
											user_create)
						SELECT '', '$c1', 3, '$d', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("Y-m-d")."', customer_id, tipo_productos, 
								centro_id, empresa_id, sucursal_id, 24, '$username'
						FROM sales WHERE transaction_id = $c1";
*/
$resultINS=mysql_query("INSERT INTO sales (invoice_number, invoice_reference, causa_emision_id,correlativo, fecha_factura, fecha_vencimiento, 
											fecha_ingreso, customer_id,tipo_productos, centro_id, empresa_id, sucursal_id, tipo_documento_id, 
											user_create)
						SELECT '', '$c1', '1', '$d', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("Y-m-d")."', customer_id, tipo_productos, 
								centro_id, empresa_id, sucursal_id, 29, '$username'
						FROM sales WHERE transaction_id = $c1");
								
$resultSELECT=mysql_query("SELECT transaction_id FROM sales WHERE invoice_reference = '$c1' AND tipo_documento_id = 29 AND `delete`='0'");
while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
	$tid=$row['transaction_id'];
}

//subitems
$resultSELECTSI=mysql_query("SELECT * FROM sales_order WHERE invoice=$c1 AND `delete`='0'");
while($rowSI = mysql_fetch_array($resultSELECTSI, MYSQL_ASSOC))
{
	$ab1 = $rowSI['product_id'];
	$ab2 = $rowSI['qty'];
	$ab3 = $rowSI['cost'];
	$ab4 = $rowSI['descuento'];
	
$resultINS = mysql_query("INSERT INTO sales_order (product_id,qty,cost,invoice,descuento , empresa_id, sucursal_id, user_create) 
VALUES ('$ab1','$ab2','$ab3','$tid', '$ab4', $sesionEmpresaID, $sesionSucursalID, '$username')");

}


header("location: ventasportal.php?tipo=29&ivReferencia=$tid&sp=$a&edita=datos");


?>