<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE `family` SET `delete`='1' WHERE family_id= $id AND empresa_id = $sesionEmpresaID");
	
?>