<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE user SET `delete`='1' WHERE id= $id AND empresa_id = $sesionEmpresaID");
?>