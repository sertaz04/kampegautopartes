<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE products SET `delete`='1' WHERE product_id= $id AND empresa_id = $sesionEmpresaID");
	
?>