<?php 

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");   

include('../connect.php');
	$grupo=$_GET['grupo'];
	$familia = $_GET['familia'];
	$subfamilia = $_GET['subfamilia'];
	$codigoBarra = $_GET['codigoBarra'];
	
	$result = mysql_query("SELECT
					Count(p.code) as existe
            		FROM products p
            		LEFT JOIN `group` g
            		ON g.group_id = p.group_id
            		LEFT JOIN `family` f
            		ON f.family_id = p.family_id
            		LEFT JOIN subfamily sf
            		ON sf.subfamily_id = p.subfamily_id
            		WHERE p.empresa_id = $sesionEmpresaID AND p.sucursal_id=$sesionSucursalID AND p.`delete`='0'
            		 AND g.`group_label` = (select group_label from `group` where group_id = '$grupo' )
						 AND f.`family_label` = (select family_label from `family` where family_id = '$familia' )
						 AND sf.`subfamily_label` = (select subfamily_label from `subfamily` where subfamily_id = '$subfamilia' )
						 AND p.`codebar` = '$codigoBarra'
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