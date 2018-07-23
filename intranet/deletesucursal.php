<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE sucursal SET delete='1'WHERE sucursal_id= $id AND empresa_id = $sesionEmpresaID");
	
?>