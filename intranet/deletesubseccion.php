<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE subseccion SET `delete`='1' WHERE subseccion_id = $id AND empresa_id = $sesionEmpresaID");
	
?>