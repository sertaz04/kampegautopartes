<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$e = $_POST['suplier_id'];

$result = mysql_query("SELECT * FROM products WHERE product_id= '$b' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$asasa=$row['lastcost'];
}

//edit qty
$result = mysql_query("UPDATE products 
        SET qty=qty+$c
		WHERE product_id='$b'");

$d=$asasa;
// query
$resultINS = mysql_query("INSERT INTO purchases_item (product_id,qty,cost,invoice, empresa_id, sucursal_id, user_create) VALUES ('$b','$c','$d','$a', $sesionEmpresaID, $sesionSucursalID, '$username')");

 header("location:  purchasesportal.php?iv=$a&sp=$e&tipo=26");


?>