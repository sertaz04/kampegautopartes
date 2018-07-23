<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM ventas_pagos WHERE id= '$id' AND empresa_id = $sesionEmpresaID");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"transaction_id":"'.utf8_encode($row['transaction_id']).'",'; 
		$outp .= '"customer_id":"'.utf8_encode($row['customer_id']).'",';     
		$outp .= '"fecha_pago":"'.utf8_encode($row['fecha_pago']).'",'; 
		$outp .= '"monto":"'.utf8_encode($row['monto']).'",';
		$outp .= '"numero_cheque":"'.utf8_encode($row['numero_cheque']).'",';
		$outp .= '"banco_id":"'.utf8_encode($row['banco_id']).'",'; 
		$outp .= '"fecha_cheque":"'.utf8_encode($row['fecha_cheque']).'",';  
		$outp .= '"forma_pago":"'.utf8_encode($row['forma_pago']).'",';  
		       
		$outp .= '"observaciones":"'. utf8_encode($row['observaciones']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>