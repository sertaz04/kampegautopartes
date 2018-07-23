<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM user WHERE id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");

	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"id":"'.utf8_encode($row['id']).'",'; 
		$outp .= '"name":"'.utf8_encode($row['name']).'",';
		$outp .= '"rut":"'.utf8_encode($row['rut']).'",';     
		$outp .= '"username":"'.utf8_encode($row['username']).'",';
		$outp .= '"position":"'.utf8_encode($row['position']).'",'; 
		$outp .= '"sucursal_id":"'.utf8_encode($row['sucursal_id']).'",'; 
		$outp .= '"empresa_id":"'. utf8_encode($row['empresa_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
