<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$cname = $_POST['cname'];
if($d=='credit') {
$f = $_POST['due'];

$resultINS = mysql_query("INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name, empresa_id, sucursal_id, user_create) VALUES ('$a,'$b','$c','$d','$e','$z','$f','$g', $sesionEmpresaID, $sesionSucursalID, '$username')");

header("location: preview.php?invoice=$a");
exit();
}
if($d=='cash') {
$f = $_POST['cash'];

$resultINS = mysql_query("INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name, empresa_id, sucursal_id, user_create) VALUES ('$a,'$b','$c','$d','$e','$z','$f','$cname', $sesionEmpresaID, $sesionSucursalID, '$username')");


header("location: preview.php?invoice=$a");
exit();
}
// query



?>