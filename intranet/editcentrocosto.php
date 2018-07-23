<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM centro_costo WHERE centro_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"centro_codigo":"'.utf8_encode($row['centro_codigo']).'",'; 
		$outp .= '"centro_id":"'.utf8_encode($row['centro_id']).'",';     
		$outp .= '"centro_name":"'.utf8_encode($row['centro_nombre']).'",';     
		$outp .= '"empresa_id":"'. utf8_encode($row['empresa_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
