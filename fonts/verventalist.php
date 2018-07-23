<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM sales_order so LEFT JOIN products p ON p.product_id = so.product_id WHERE invoice= '$id' AND so.empresa_id = $sesionEmpresaID AND so.`delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"id":"'.utf8_encode($row['id']).'",'; 
		$outp .= '"name":"'.utf8_encode($row['name']).'",';     
		$outp .= '"qty":"'.utf8_encode($row['qty']).'",'; 
		$outp .= '"cost":"'.utf8_encode($row['cost']).'",'; 
		$outp .= '"invoice":"'. utf8_encode($row['invoice']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>