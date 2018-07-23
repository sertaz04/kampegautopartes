<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE purchases SET `delete`='1' WHERE transaction_id= $id AND empresa_id = $sesionEmpresaID");
	
?>