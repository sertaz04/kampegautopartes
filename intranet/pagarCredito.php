<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT s.transaction_id, c.customer_id, c.rut, c.customer_name, sum(so.qty*so.cost) as monto 
							FROM sales s
							LEFT JOIN sales_order so ON s.transaction_id = so.invoice
							LEFT JOIN customer c ON c.customer_id = s.customer_id
							WHERE c.customer_id= '$id' AND s.empresa_id = $sesionEmpresaID AND s.`delete`='0'
							  AND s.forma_pago_id = 2 AND s.estado_pago = 0
							GROUP BY s.transaction_id, c.customer_id, c.rut, c.customer_name");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"transaction_id":"'.utf8_encode($row['transaction_id']).'",'; 
		$outp .= '"customer_id":"'.utf8_encode($row['customer_id']).'",'; 
		$outp .= '"customer_rut":"'.utf8_encode($row['rut']).'",'; 
		$outp .= '"customer_name":"'.utf8_encode($row['customer_name']).'",';
		$outp .= '"monto":"'. utf8_encode($row['monto']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>