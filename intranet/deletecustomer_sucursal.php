<?php
	include('../connect.php');
	$id=$_GET['id'];
	//echo "UPDATE customer_sucursal SET `delete`='1' WHERE customer_sucursal_id = $id ";
	$result = mysql_query("UPDATE customer_sucursal SET `delete`='1' WHERE customer_sucursal_id = $id ");
?>