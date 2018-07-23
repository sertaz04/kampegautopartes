<?php 

header("Access-Control-Allow-Origin: *"); 
//header("Content-Type: application/json; charset=UTF-8");   
header("Content-Type: application/json; charset=iso-8859-1");

include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("SELECT *, replace(replace(details,'\n',' '),'\r', ' ') as details2 FROM products WHERE product_id= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
	
	$i=1; 
	$outp = ""; 
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

		if ($outp != "") {$outp .= ",";}          
		$outp .= '{"product_id":"'.utf8_encode($row['product_id']).'",'; 
		$outp .= '"group":"'.utf8_encode($row['group_id']).'",';     
		$outp .= '"family_id":"'.utf8_encode($row['family_id']).'",'; 
		$outp .= '"subfamily_id":"'.utf8_encode($row['subfamily_id']).'",'; 
		$outp .= '"code":"'.utf8_encode($row['code']).'",'; 
		$outp .= '"name":"'.utf8_encode($row['name']).'",'; 
		$outp .= '"codebar":"'.utf8_encode($row['codebar']).'",'; 
		$outp .= '"unit_purchase":"'.utf8_encode($row['unit_purchase']).'",'; 
		$outp .= '"unit_sale":"'.utf8_encode($row['unit_sale']).'",'; 
		$outp .= '"avgcost":"'.utf8_encode($row['avgcost']).'",'; 
		$outp .= '"lastcost":"'.utf8_encode($row['lastcost']).'",'; 
		$outp .= '"marginsale":"'.utf8_encode($row['marginsale']).'",'; 
		$outp .= '"pricesale":"'.utf8_encode($row['pricesale']).'",'; 
		$outp .= '"marginspecial":"'.utf8_encode($row['marginspecial']).'",'; 
		$outp .= '"pricespecial":"'.utf8_encode($row['pricespecial']).'",'; 
		$outp .= '"orginproduct":"'.utf8_encode($row['orginproduct']).'",'; 
		$outp .= '"genericcode":"'.utf8_encode($row['genericcode']).'",'; 
		$outp .= '"maxdescount":"'.utf8_encode($row['maxdescount']).'",'; 
		$outp .= '"details":"'.utf8_encode($row['details2']).'",'; 
		$outp .= '"codeaccount":"'.utf8_encode($row['codeaccount']).'",'; 
		$outp .= '"nameaccount":"'.utf8_encode($row['nameaccount']).'",'; 
		$outp .= '"codecenter":"'.utf8_encode($row['codecenter']).'",'; 
		$outp .= '"namecenter":"'.utf8_encode($row['namecenter']).'",'; 
		$outp .= '"inmovilizado":"'.utf8_encode($row['inmovilizado']).'",'; 
		$outp .= '"bodega_id":"'.utf8_encode($row['bodega_id']).'",'; 
		$outp .= '"seccion_id":"'.utf8_encode($row['seccion_id']).'",'; 
		$outp .= '"subseccion_id":"'.utf8_encode($row['subseccion_id']).'",'; 
		$outp .= '"inventariable":"'. utf8_encode($row['inventariable']).'"}';     
		$i++; 
	} 

	$outp ='{"records":['.$outp.']}';   
	echo($outp); 

?>
