<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM sucursal WHERE sucursal_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"sucursal_id":"'.utf8_encode($row['sucursal_id']).'",'; 
		$outp .= '"sucursal_nombre":"'.utf8_encode($row['sucursal_nombre']).'",';     
		$outp .= '"sucursal_direccion":"'.utf8_encode($row['sucursal_direccion']).'",';
		$outp .= '"sucursal_telefono":"'.utf8_encode($row['sucursal_telefono']).'",';
		$outp .= '"sucursal_ciudad":"'.utf8_encode($row['sucursal_ciudad']).'",';
		$outp .= '"sucursal_comuna":"'.utf8_encode($row['sucursal_comuna']).'",';
		$outp .= '"empresa_id":"'. utf8_encode($row['empresa_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
