<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE centro_costo SET `delete`='1' WHERE centro_id= $id AND empresa_id = $sesionEmpresaID");
	
?>