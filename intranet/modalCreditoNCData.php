<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT transaction_id, fecha_vencimiento, folio_DTE, descripcion, ROUND(sum(monto)) as monto  FROM (SELECT s.transaction_id, s.fecha_vencimiento, cs.folio_DTE, td.descripcion, (ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-monto_efectivo) as monto 
							FROM sales s
							LEFT JOIN sales_order so ON s.transaction_id = so.invoice
							LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
							LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
							LEFT JOIN customer c ON c.customer_id = s.customer_id
							WHERE c.customer_id= '$id' AND s.empresa_id = $sesionEmpresaID AND s.`delete`='0' AND cs.folio_DTE > 0
							  AND s.estado_pago = 0 AND so.`delete` = 0 AND s.tipo_documento_id = 24
							GROUP BY s.transaction_id, cs.folio_DTE, td.descripcion
							union all
							SELECT s.transaction_id, s.fecha_vencimiento, cs.folio_DTE, td.descripcion, (ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19,0)-monto_efectivo) as monto 
							FROM sales_history s
							LEFT JOIN sales_order_history so ON s.transaction_id = so.invoice
							LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
							LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
							LEFT JOIN customer c ON c.customer_id = s.customer_id
							WHERE c.customer_id= '$id' AND s.empresa_id = $sesionEmpresaID AND s.`delete`='0' AND cs.folio_DTE > 0
							  AND s.estado_pago = 0 AND so.`delete` = 0 AND s.tipo_documento_id = 24
							GROUP BY s.transaction_id, cs.folio_DTE, td.descripcion) AS F
							GROUP BY transaction_id, folio_DTE, descripcion");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"transaction_id":"'.utf8_encode($row['transaction_id']).'",'; 
		$outp .= '"folio_DTE":"'.utf8_encode($row['folio_DTE']).'",';
		$outp .= '"tipo_documento":"'.utf8_encode($row['descripcion']).'",';  
		$outp .= '"customer_name":"'.utf8_encode($row['customer_name']).'",';
		$outp .= '"fecha_vencimiento":"'.utf8_encode($row['fecha_vencimiento']).'",';
		$outp .= '"monto":"'. utf8_encode($row['monto']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>