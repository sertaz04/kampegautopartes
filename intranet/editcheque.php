<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM ventas_impago WHERE id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"id_cheque":"'.utf8_encode($row['id']).'",'; 
		$outp .= '"transaction_id":"'.utf8_encode($row['transaction_id']).'",'; 
		$outp .= '"forma_pago":"'.utf8_encode($row['forma_pago_id']).'",'; 
		$outp .= '"customer_id":"'.utf8_encode($row['customer_id']).'",';
		$outp .= '"tipo":"'.utf8_encode($row['tipo']).'",';
		$outp .= '"fecha":"'.utf8_encode($row['fecha']).'",'; 
		$outp .= '"numeroCheque":"'.utf8_encode($row['numero_cheque']).'",';  
		$outp .= '"banco":"'.utf8_encode($row['banco']).'",';  
		$outp .= '"fechaPago":"'.utf8_encode($row['fecha_pago']).'",';  		       
		$outp .= '"monto":"'. utf8_encode($row['monto']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>