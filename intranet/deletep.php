<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	$sp=$_GET['sp'];
	//edit qty
	
	$result = mysql_query("UPDATE purchases_item SET `delete`='1' WHERE id= $id AND empresa_id = $sesionEmpresaID");
	
	header("location: purchasesportal.php?iv=$c&sp=$sp");
	
	
?>