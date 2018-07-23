<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM purchases WHERE transaction_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"transaction_id":"'.utf8_encode($row['transaction_id']).'",'; 
		$outp .= '"invoice_number":"'.utf8_encode($row['invoice_number']).'",';     
		$outp .= '"correlativo":"'.utf8_encode($row['correlativo']).'",';     
		$outp .= '"fecha_factura":"'.utf8_encode($row['fecha_factura']).'",';     
		$outp .= '"fecha_vencimiento":"'.utf8_encode($row['fecha_vencimiento']).'",';     
		$outp .= '"fecha_ingreso":"'.utf8_encode($row['fecha_ingreso']).'",';     
		$outp .= '"suplier_id":"'.utf8_encode($row['suplier_id']).'",';     
		$outp .= '"tipo_productos":"'.utf8_encode($row['tipo_productos']).'",';     
		$outp .= '"centro_id":"'.utf8_encode($row['centro_id']).'",';     
		$outp .= '"user_create":"'.utf8_encode($row['user_create']).'",';     
		$outp .= '"date_create":"'. utf8_encode($row['date_create']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
