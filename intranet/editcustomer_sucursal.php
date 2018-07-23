<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM customer_sucursal cs INNER JOIN customer c ON c.customer_id = cs.customer_id WHERE customer_sucursal_id= '$id'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"memi":"'.utf8_encode($row['customer_sucursal_id']).'",'; 
		$outp .= '"rut":"'.utf8_encode($row['rut']).'",'; 
		$outp .= '"rutCliente":"'.utf8_encode($row['customer_id']).'",';   		
		$outp .= '"customer_name":"'.utf8_encode($row['customer_name']).'",'; 
		$outp .= '"customer_sucursal_direccion":"'.utf8_encode($row['customer_sucursal_direccion']).'",';
		$outp .= '"customer_sucursal_telefono":"'.utf8_encode($row['customer_sucursal_telefono']).'",';
		$outp .= '"customer_sucursal_email":"'.utf8_encode($row['customer_sucursal_email']).'",'; 
		$outp .= '"customer_sucursal_ciudad":"'.utf8_encode($row['customer_sucursal_ciudad']).'",';  
		$outp .= '"customer_sucursal_comuna":"'.utf8_encode($row['customer_sucursal_comuna']).'",';  
		
		$outp .= '"customer_sucursal_contacto":"'. utf8_encode($row['customer_sucursal_contacto']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>