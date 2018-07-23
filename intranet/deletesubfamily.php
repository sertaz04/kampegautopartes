<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE subfamily SET `delete`='1' WHERE subfamily_id= $id AND empresa_id = $sesionEmpresaID");
?>