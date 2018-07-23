<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE seccion SET `delete`='1' WHERE seccion_id = $id AND empresa_id = $sesionEmpresaID");
	
?>