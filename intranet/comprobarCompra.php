<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$rutProveedor=$_GET['rutProveedor'];
	$iv = $_GET['iv'];
	$tipo = $_GET['tipo'];
	
	$result = mysql_query("
			SELECT COUNT(p.transaction_id) as existe
			FROM purchases p
			WHERE p.invoice_number = '$iv'
			AND p.suplier_id = '$rutProveedor'
			AND p.tipo_documento_id = '$tipo'
			AND p.`delete` = 0
					");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}
		$outp .= '{"existe":"'. utf8_encode($row['existe']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>