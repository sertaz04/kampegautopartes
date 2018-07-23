<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM subfamily WHERE subfamily_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"subfamily_id":"'.utf8_encode($row['subfamily_id']).'",'; 
		$outp .= '"subfamily_name":"'.utf8_encode($row['subfamily_name']).'",';     
		$outp .= '"subfamily_label":"'.utf8_encode($row['subfamily_label']).'",';
		$outp .= '"family_id":"'. utf8_encode($row['family_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
