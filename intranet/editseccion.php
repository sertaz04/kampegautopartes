<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT seccion_id, capacidad, ubicacion, tipo, bodega_id FROM seccion WHERE seccion_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"seccion_id":"'.utf8_encode($row['seccion_id']).'",'; 
		$outp .= '"capacidad":"'.utf8_encode($row['capacidad']).'",';     
		$outp .= '"ubicacion":"'.utf8_encode($row['ubicacion']).'",';
		$outp .= '"tipo":"'.utf8_encode($row['tipo']).'",';    
		$outp .= '"bodega_id":"'. utf8_encode($row['bodega_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>