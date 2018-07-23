<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM family WHERE family_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"family_id":"'.utf8_encode($row['family_id']).'",'; 
		$outp .= '"family_name":"'.utf8_encode($row['family_name']).'",';     
		$outp .= '"family_label":"'.utf8_encode($row['family_label']).'",';
		$outp .= '"group_id":"'. utf8_encode($row['group_id']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
