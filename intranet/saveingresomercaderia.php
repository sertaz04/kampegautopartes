<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$e = $_POST['suplier_id'];

// query
$resultINS = mysql_query("INSERT INTO item_entrada_compra 
							(product_id, cantidad, invoice, empresa_id, sucursal_id, user_create) 
						VALUES ('$b','$c','$a', $sesionEmpresaID,$sesionSucursalID, '$username')");

header("location:  ingresomercaderia.php?iv=$a&sp=$e");


?>