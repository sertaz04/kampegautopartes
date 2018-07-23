<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	//edit qty
	$result = mysql_query("UPDATE products SET qty=qty+'$qty' WHERE product_id='$wapak' AND empresa_id = $sesionEmpresaID");
	//delete invoce
	$result = mysql_query("UPDATE sales_order SET delete='1' WHERE transaction_id= '$id' AND empresa_id = $sesionEmpresaID");
	
	header("location: sales.php?id=$sdsd&invoice=$c");
?>