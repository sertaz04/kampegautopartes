<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = mysql_query("UPDATE empresa SET `delete`='1' WHERE empresa_id= $id");
?>