<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE supliers SET `delete`='1' WHERE suplier_id= $id AND empresa_id = $sesionEmpresaID");
?>