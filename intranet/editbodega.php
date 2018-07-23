<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT bodega_id, bodega_nombre, bodega_capacidad, empresa_id FROM bodega WHERE bodega_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"bodega_id":"'.utf8_encode($row['bodega_id']).'",'; 
		$outp .= '"bodega_nombre":"'.utf8_encode($row['bodega_nombre']).'",';     
		$outp .= '"bodega_capacidad":"'.utf8_encode($row['bodega_capacidad']).'",';    
		$outp .= '"empresa_id":"'. utf8_encode($row['empresa_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>