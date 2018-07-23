<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE `group` SET `delete`='1' WHERE group_id= $id AND empresa_id = $sesionEmpresaID");
	
?>