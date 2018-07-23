<?php
session_start();
include('../connect.php');
$group = $_POST['group'];
$family = $_POST['family'];
$subfamily = $_POST['subfamily'];
$iv = $_POST['iv'];
$sp = $_POST['sp'];
if($sp==''){ $sp='879';}
$a = $_POST['code'];
$b = $_POST['name'];
$c = $_POST['codebar'];
$d = $_POST['unit_purchase'];
$e = $_POST['unit_sale'];
$f = $_POST['avgcost'];
$g = $_POST['lastcost'];
$h = $_POST['marginsale'];
$i = $_POST['pricesale'];
$j = $_POST['marginspecial'];
$k = $_POST['pricespecial'];
$l = $_POST['originproduct'];
$m = $_POST['genericcode'];
$n = $_POST['maxdescount'];
$details = $_POST['details'];
$o = $_POST['codeaccount'];
$p = $_POST['nameaccount'];
$q = $_POST['codecenter'];
$r = $_POST['namecenter'];
$s = $_POST['inmovilizado'];
$t = $_POST['inventariable'];
$u = $_POST['bodega'];
$v = $_POST['seccion'];
$w = $_POST['subseccion'];
$origen = $_POST['origen'];


// query

$result=mysql_query("INSERT INTO products (supplier_id, group_id, family_id, subfamily_id, code, name, codebar, unit_purchase, unit_sale, avgcost, lastcost, marginsale, pricesale, marginspecial, pricespecial,
		    originproduct, genericcode, maxdescount,details, codeaccount, nameaccount, codecenter, namecenter, inmovilizado, inventariable, bodega_id, seccion_id, subseccion_id
			, empresa_id, sucursal_id,user_create)
		    VALUES ($sp, $group, $family, $subfamily,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$detail','$o','$p','$q','$r','$s','$t', ". (($u!='')?'$u':'NULL') .",". (($v!='')?'$v':'NULL') .",". (($w!='')?'$w':'NULL') .", $sesionEmpresaID,$sesionSucursalID, '$username')");
/*
echo "INSERT INTO products (supplier_id, group_id, family_id, subfamily_id, code, name, codebar, unit_purchase, unit_sale, avgcost, lastcost, marginsale, pricesale, marginspecial, pricespecial,
		    originproduct, genericcode, maxdescount,details, codeaccount, nameaccount, codecenter, namecenter, inmovilizado, inventariable, bodega_id, seccion_id, subseccion_id
			, empresa_id, sucursal_id,user_create)
		    VALUES ($sp, $group, $family, $subfamily,'$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$detail','$o','$p','$q','$r','$s','$t', ". (($u!='')?'$u':'NULL') .",". (($v!='')?'$v':'NULL') .",". (($w!='')?'$w':'NULL') .", $sesionEmpresaID,$sesionSucursalID, '$username')";
*/
if($origen=='compras'){
	header("location: purchasesportal.php?iv=$iv&sp=$sp");
}else if($origen=='ventas'){
	header("location: ventasportal.php?iv=$iv&sp=$sp");
}else{
	header("location: productos.php");
}


?>