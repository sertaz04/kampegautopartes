<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$rut = $_GET['rut'];
	$result = mysql_query("SELECT * FROM customer WHERE customer_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	if($rut!=''){
		$result = mysql_query("SELECT * FROM customer WHERE rut= '$rut' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	}
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"customer_id":"'.utf8_encode($row['customer_id']).'",'; 
		$outp .= '"rut":"'.utf8_encode($row['rut']).'",';     
		$outp .= '"customer_name":"'.utf8_encode($row['customer_name']).'",'; 
		$outp .= '"address":"'.utf8_encode($row['address']).'",';
		$outp .= '"ciudad":"'.utf8_encode($row['ciudad']).'",';
		$outp .= '"comuna":"'.utf8_encode($row['comuna']).'",'; 
		$outp .= '"contact":"'.utf8_encode($row['contact']).'",';  
		$outp .= '"phone":"'.utf8_encode($row['phone']).'",';  
		$outp .= '"membership_number":"'.utf8_encode($row['membership_number']).'",';  
		$outp .= '"prod_name":"'.utf8_encode($row['prod_name']).'",';
		$outp .= '"email":"'.utf8_encode($row['email']).'",';
		$outp .= '"expected_date":"'.utf8_encode($row['expected_date']).'",';
		
		$outp .= '"tipo_cliente":"'.utf8_encode($row['tipo_cliente']).'",';
		$outp .= '"bloqueado":"'.utf8_encode($row['bloqueado']).'",';
		$outp .= '"rutlibre":"'.utf8_encode($row['rut_libre']).'",';
		$outp .= '"permiteDescuento":"'.utf8_encode($row['descuento']).'",';
		$outp .= '"porc_max":"'.utf8_encode($row['porcentaje_maximo_descuento']).'",';
		$outp .= '"saldo_max":"'.utf8_encode($row['saldo_maximo']).'",';
		$outp .= '"vendedor_cartera":"'.utf8_encode($row['vendedor_cartera']).'",';
		       
		$outp .= '"note":"'. utf8_encode($row['note']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>