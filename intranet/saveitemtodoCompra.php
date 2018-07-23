<?php
session_start();
include('../connect.php');

$listaids = $_POST['listaIds'];

$b = $_POST['observaciones'];
$c = $_POST['adicional'];
$sp = $_POST['suplier_id'];
$i = $_POST['idInvoice'];
$strIds = $_POST['strIds'];

$result = mysql_query("UPDATE purchases SET adicional=$c, observaciones='$b' WHERE transaction_id=$i");
//echo "UPDATE purchases SET adicional=$c, observaciones='$b' WHERE transaction_id=$i";
$arrayIds = explode("|",$strIds);

foreach ($arrayIds as $idItem) {

	$d = $_POST['qty-'.$idItem];
	$e = $_POST['cost-'.$idItem];
	$f = $_POST['descuento-'.$idItem];
	$g = $_POST['compras-'.$idItem];
	$h = $_POST['id-'.$idItem];
		
	$result = mysql_query("UPDATE purchases_item SET qty=$d, cost=$e, descuento=$f  WHERE id=$h");
	
	/*$actualizaUltimoCosto = mysql_query("SELECT product_id FROM purchases_item WHERE id=$h");
	while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
	{
		$ab1 = $row['product_id'];
	}
	$resultActualizaProd = mysql_query("UPDATE products SET lastcost = $e WHERE product_id = $ab1");
	*/
	
	$idProducto = mysql_query("SELECT product_id FROM purchases_item where id=$h");
	while($rowIdProducto = mysql_fetch_array($idProducto, MYSQL_ASSOC)){
		$idProd = $rowIdProducto['product_id'];
		$resultUpdatePrecio = mysql_query("UPDATE products SET lastcost=$e, pricesale=$e+($e*marginsale/100), pricespecial=$e+($e*marginspecial/100) WHERE product_id=$idProd");
	}
	/*$idProducto = mysql_query("SELECT product_id FROM sales_order_history where id=$h");
	while($rowIdProducto = mysql_fetch_array($idProducto, MYSQL_ASSOC)){
		$idProd = $rowIdProducto['product_id'];
		$resultUpdatePrecio = mysql_query("UPDATE products SET pricesale=$e  WHERE id=$idProd");
	}*/
	
	
//echo "UPDATE purchases_item SET qty=$d, cost=$e, descuento=$f  WHERE id=$h";
}

header("location: purchasesportal.php?iv=$i&sp=$sp&tipo=26");

?>

