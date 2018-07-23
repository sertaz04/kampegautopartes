<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM `group` WHERE group_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"group_id":"'.utf8_encode($row['group_id']).'",'; 
		$outp .= '"group_name":"'.utf8_encode($row['group_name']).'",';     
		$outp .= '"group_label":"'. utf8_encode($row['group_label']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
