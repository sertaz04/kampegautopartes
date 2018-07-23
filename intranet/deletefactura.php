<?php
	include('../connect.php');
	$id=$_GET['id'];

	$result = mysql_query("UPDATE purchases_item SET `delete`='1' WHERE invoice= $id AND empresa_id = $sesionEmpresaID");
	
	$result = mysql_query("UPDATE purchases SET `delete`='1' WHERE transaction_id= $id AND empresa_id = $sesionEmpresaID");
	
?>