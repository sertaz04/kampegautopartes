<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE bodega SET `delete`='1' WHERE bodega_id= $id AND empresa_id = $sesionEmpresaID");
?>