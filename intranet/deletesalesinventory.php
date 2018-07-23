<?php
	include('../connect.php');
	$id=$_GET['id'];
	$qty=$_GET['qty'];
	
	$result = mysql_query("SELECT * FROM products WHERE product_code= $b AND empresa_id = $sesionEmpresaID");

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$qty=$row['qty'];
}

	mysql_query("UPDATE products 
        SET qty=qty+$qty
		WHERE product_id=$id AND empresa_id = $sesionEmpresaID");

	
	mysql_query("UPDATE sales_order SET `delete`='1' WHERE transaction_id= $id AND empresa_id = $sesionEmpresaID");
	
	header("location: sales_inventory.php");
?>