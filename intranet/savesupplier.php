<?php
session_start();
include('../connect.php');
$a = $_POST['suplier_rut'];
$b = $_POST['suplier_name'];
$b1 = $_POST['suplier_namefantasia'];
$c = $_POST['suplier_address'];
$c1 = $_POST['suplier_ciudad'];
$c2 = $_POST['suplier_comuna'];
$d = $_POST['suplier_contact'];
$e = $_POST['contact_person'];
$f = $_POST['suplier_giro'];
$f1 = $_POST['suplier_email'];
$g = $_POST['note'];
$h = $_POST['origen'];
$tipoDoc = $_POST['tipo_documento'];
// query
$result=mysql_query("INSERT INTO supliers (suplier_rut, suplier_name, suplier_fantasyname, suplier_address, suplier_ciudad, suplier_comuna, suplier_contact, contact_person, suplier_giro, suplier_email, note, empresa_id, sucursal_id, user_create) VALUES ('$a','$b','$b1' ,'$c','$c1','$c2','$d','$e','$f','$f1','$g', $sesionEmpresaID, $sesionSucursalID, '$username')");
//echo "INSERT INTO supliers (suplier_rut, suplier_name, suplier_fantasyname, suplier_address, suplier_ciudad, suplier_comuna, suplier_contact, contact_person, suplier_giro, suplier_email, note, empresa_id, sucursal_id, user_create) VALUES ('$a','$b','$b1' ,'$c','$c1','$c2','$d','$e','$f','$f1','$g', $sesionEmpresaID, $sesionSucursalID, '$username')";

if($h==1){
header("location: cotizaciones.php");
}else if($h==2){
header("location: compras.php?tipo=$tipoDoc");
}else{
header("location: supplier.php");
}


?>