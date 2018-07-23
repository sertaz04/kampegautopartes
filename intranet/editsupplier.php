<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$rut = $_GET['rut'];
	$result = mysql_query("SELECT * FROM supliers WHERE suplier_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	if($rut!=''){
		$result = mysql_query("SELECT * FROM supliers WHERE suplier_rut= '$rut' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	}
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"suplier_id":"'.utf8_encode($row['suplier_id']).'",'; 
		$outp .= '"suplier_rut":"'.utf8_encode($row['suplier_rut']).'",';     
		$outp .= '"suplier_name":"'.utf8_encode($row['suplier_name']).'",';
		$outp .= '"suplier_fantasyname":"'.utf8_encode($row['suplier_fantasyname']).'",';
		$outp .= '"suplier_address":"'.utf8_encode($row['suplier_address']).'",';
		$outp .= '"suplier_ciudad":"'.utf8_encode($row['suplier_ciudad']).'",';
		$outp .= '"suplier_comuna":"'.utf8_encode($row['suplier_comuna']).'",';
		$outp .= '"suplier_contact":"'.utf8_encode($row['suplier_contact']).'",'; 
		$outp .= '"contact_person":"'.utf8_encode($row['contact_person']).'",'; 
		$outp .= '"suplier_giro":"'.utf8_encode($row['suplier_giro']).'",'; 
		$outp .= '"note":"'. utf8_encode($row['note']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>