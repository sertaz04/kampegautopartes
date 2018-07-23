<?php
session_start();
include('../connect.php');

$listaids = $_POST['listaIds'];

$a = intval($_POST['formaPago']);
$b = $_POST['observaciones'];
$c = $_POST['adicional'];
$oc = $_POST['orden_compra'];
$sp = $_POST['cliente_id'];
$i = $_POST['idInvoice'];
if($i==''){
	$i = $_POST['invoiceReferencia'];
}
$k = $_POST['tipo_documento'];
$strIds = $_POST['strIds'];

$result = mysql_query("UPDATE sales SET adicional=$c, observaciones='$b', forma_pago_id='$a', orden_compra = '$oc' WHERE transaction_id=$i");

$result = mysql_query("UPDATE sales_history SET adicional=$c, observaciones='$b', forma_pago_id='$a', orden_compra = '$oc' WHERE transaction_id=$i");
//echo "UPDATE sales SET adicional=$c, observaciones='$b', forma_pago_id=$a WHERE transaction_id=$i";

$arrayIds = explode("|",$strIds);

foreach ($arrayIds as $idItem) {

	$d = $_POST['qty-'.$idItem];
	$e = $_POST['cost-'.$idItem];
	$f = $_POST['descuento-'.$idItem];
	$g = $_POST['ventas-'.$idItem];
	$h = $_POST['id-'.$idItem];
		
	$result = mysql_query("UPDATE sales_order SET qty=$d, cost=$e, descuento=$f  WHERE id=$h");
	
	//actualizamos el ultimo costo
	$idProducto = mysql_query("SELECT product_id FROM sales_order where id=$h");
	while($rowIdProducto = mysql_fetch_array($idProducto, MYSQL_ASSOC)){
		$idProd = $rowIdProducto['product_id'];
		$resultUpdatePrecio = mysql_query("UPDATE products SET pricesale=$e  WHERE product_id=$idProd");
	}
	
	$result = mysql_query("UPDATE sales_order_history SET qty=$d, cost=$e, descuento=$f  WHERE id=$h");

	//echo "UPDATE sales_order SET qty=$d, cost=$e, descuento=$f  WHERE id=$h";
	
	//actualizamos el ultimo costo
	/*$idProducto = mysql_query("SELECT product_id FROM sales_order_history where id=$h");
	while($rowIdProducto = mysql_fetch_array($idProducto, MYSQL_ASSOC)){
		$idProd = $rowIdProducto['product_id'];
		$resultUpdatePrecio = mysql_query("UPDATE products SET pricesale=$e  WHERE id=$idProd");
	}*/
	
}

//$result = mysql_query("INSERT claveSII(id_invoice, fecha, tipo_documento, estado, user_create) values($i, '".date("Y-m-d")."',$k, 1, '$username')");

//secho "INSERT claveSII(id_invoice, fecha, tipo_documento, estado, user_create) values($i, '".date("Y-m-d")."',$k, 1, '$username')";
if($_POST['idInvoice']==''){
	header("location: ventasportal.php?tipo=$k&ivReferencia=$i&sp=$sp&edita=monto");
}else{
	header("location: ventasportal.php?tipo=$k&iv=$i&sp=$sp");
}

?>

