<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$e = $_POST['cliente_id'];
$tipo = $_POST['tipo'];
//HMO  - invoice tipo DTE 56, 61
$invoiceReference = $_POST['invoiceReference'];

$tipoDTE = $_POST['tipoDTE'];
$folioDTE = $_POST['folioDTE'];
$valido = $_POST['valido'];

$result = mysql_query("SELECT * FROM products WHERE product_id= '$b' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
$asasa=$row['pricesale'];
}

//edit qty
//$result = mysql_query("UPDATE 	 
//       SET qty=qty-$c
//		WHERE product_id='$b'");

$d=$asasa;
// query

if($a==''){
    $a = $invoiceReference;
}
$resultINS = mysql_query("INSERT INTO sales_order (product_id,qty,cost,invoice, empresa_id, sucursal_id, user_create)
                         VALUES ('$b','$c','$d','$a', $sesionEmpresaID, $sesionSucursalID, '$username')");
//echo "INSERT INTO sales_order (product_id,qty,cost,invoice, empresa_id, sucursal_id, user_create) VALUES ('$b','$c','$d','$a', $sesionEmpresaID, $sesionSucursalID, '$username')";
if ($tipo==26 or $tipo==14 or $tipo==34 or $tipo==13){
header("location:  ventasportal.php?tipo=$tipo&iv=$a&sp=$e&valido=$valido&folioDTE=$folioDTE&tipoDTE=$tipoDTE");
}elseif($tipo==24 or $tipo==29){
    header("location:  ventasportal.php?tipo=$tipo&ivReferencia=$invoiceReference&sp=$e&edita=monto&valido=$valido&folioDTE=$folioDTE&tipoDTE=$tipoDTE");
}else{
header("location:  ventasportal.php?tipo=$tipo&ivReferencia=$invoiceReference&sp=$e&valido=$valido&folioDTE=$folioDTE&tipoDTE=$tipoDTE");
}

?>