<?php
	include('../connect.php');
	$id=$_GET['id'];
	
	$result = mysql_query("UPDATE sales_order SET `delete`='1' WHERE invoice= $id AND empresa_id = $sesionEmpresaID");
	
	$result = mysql_query("UPDATE sales SET `delete`='1' WHERE transaction_id= $id AND empresa_id = $sesionEmpresaID");
	
?>