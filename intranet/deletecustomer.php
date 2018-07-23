<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE customer SET `delete`='1' WHERE customer_id= $id AND empresa_id = $sesionEmpresaID");
?>