<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT subseccion_id, subseccion_nombre, bodega_id, seccion_id FROM subseccion WHERE subseccion_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"subseccion_id":"'.utf8_encode($row['subseccion_id']).'",'; 
		$outp .= '"subseccion_nombre":"'.utf8_encode($row['subseccion_nombre']).'",';     
		$outp .= '"bodega_id":"'.utf8_encode($row['bodega_id']).'",';
		$outp .= '"seccion_id":"'. utf8_encode($row['seccion_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>