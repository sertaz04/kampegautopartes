<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM sales WHERE transaction_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
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
		$outp .= '"customer_id":"'.utf8_encode($row['customer_id']).'",';
		$outp .= '"customer_sucursal_id":"'.utf8_encode($row['customer_sucursal_id']).'",';
		
		$cliente = $row['customer_id'];
		//agrego datos del cliente
		$resultCliente = mysql_query("SELECT * FROM customer WHERE customer_id = $cliente AND empresa_id = $sesionEmpresaID AND `delete`='0'");
		while($rowCliente = mysql_fetch_array($resultCliente, MYSQL_ASSOC))
		{
			$outp .= '"address":"'.utf8_encode($rowCliente['address']).'",';
			$outp .= '"ciudad":"'.utf8_encode($rowCliente['ciudad']).'",';
			$outp .= '"comuna":"'.utf8_encode($rowCliente['comuna']).'",';
			$outp .= '"prod_name":"'.utf8_encode($rowCliente['prod_name']).'",';
			$outp .= '"phone":"'.utf8_encode($rowCliente['phone']).'",';
			$outp .= '"contact":"'.utf8_encode($rowCliente['contact']).'",';
		}		
		$outp .= '"tipo_productos":"'.utf8_encode($row['tipo_productos']).'",';     
		$outp .= '"centro_id":"'.utf8_encode($row['centro_id']).'",';
		
		if($row['tipo_documento_id']==14){
			$outp .= '"chofer_rut":"'.utf8_encode($row['chofer_rut']).'",';
			$outp .= '"chofer":"'.utf8_encode($row['chofer']).'",';
			$outp .= '"transportista_rut":"'.utf8_encode($row['transportista_rut']).'",';
			$outp .= '"transportista":"'.utf8_encode($row['transportista']).'",';
			$outp .= '"dir_origen":"'.utf8_encode($row['direccion_origen']).'",';
			$outp .= '"dir_destino":"'.utf8_encode($row['direccion_destino']).'",';
			$outp .= '"ciudad_origen":"'.utf8_encode($row['ciudad_origen']).'",';
			$outp .= '"ciudad_destino":"'.utf8_encode($row['ciudad_destino']).'",';
			$outp .= '"patente_camion":"'.utf8_encode($row['patente_camion']).'",';
			$outp .= '"patente_carro":"'.utf8_encode($row['patente_carro']).'",';
			$outp .= '"tipo_traslado":"'.utf8_encode($row['tipo_traslado_id']).'",';
		}
		
		$outp .= '"user_create":"'.utf8_encode($row['user_create']).'",';     
		$outp .= '"date_create":"'. utf8_encode($row['date_create']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
