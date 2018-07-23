<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT empresa_id, empresa_rut, empresa_nombre, empresa_direccion, empresa_telefono, empresa_representante_legal FROM empresa WHERE empresa_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"empresa_id":"'.utf8_encode($row['empresa_id']).'",'; 
		$outp .= '"empresa_rut":"'.utf8_encode($row['empresa_rut']).'",';     
		$outp .= '"empresa_nombre":"'.utf8_encode($row['empresa_nombre']).'",'; 
		$outp .= '"empresa_direccion":"'.utf8_encode($row['empresa_direccion']).'",'; 
		$outp .= '"empresa_telefono":"'.utf8_encode($row['empresa_telefono']).'",';     
		$outp .= '"empresa_representante_legal":"'. utf8_encode($row['empresa_representante_legal']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>