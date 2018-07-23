<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$group = $_POST['group'];
$family = $_POST['family'];
$subfamily = $_POST['subfamily'];
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
$o = $_POST['codeaccount'];
$p = $_POST['nameaccount'];
$q = $_POST['codecenter'];
$r = $_POST['namecenter'];
$s = $_POST['inmovilizado'];
$t = $_POST['inventariable'];
$u = $_POST['details'];
$v = $_POST['bodega'];
$w = $_POST['seccion'];
$x = $_POST['subseccion'];


$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query

$result = mysql_query("UPDATE products 
       SET 
		group_id='$group',
		family_id='$family',
		subfamily_id='$subfamily',
		code='$a',
		name='$b',
		codebar='$c',
		unit_purchase='$d',
		unit_sale='$e',
		avgcost='$f',
		lastcost='$g',
		marginsale='$h',
		pricesale='$i',
		marginspecial='$j',
		pricespecial='$k',
		originproduct='$l',
		genericcode='$m',
		maxdescount='$n',
		codeaccount='$o',
		nameaccount='$p',
		codecenter='$q',
		namecenter='$r',
		inmovilizado='$s',
		inventariable='$t',
		bodega_id=". (($v!='')?'$v':'NULL') .",
		seccion_id=". (($w!='')?'$w':'NULL') .",
		subseccion_id=". (($x!='')?'$x':'NULL') .",
		details = '$u', user_update='$username', date_update='$current_date'
		WHERE product_id='$id'");
/*
echo "UPDATE products 
       SET 
		group_id='$group',
		family_id='$family',
		subfamily_id='$subfamily',
		code='$a',
		name='$b',
		codebar='$c',
		unit_purchase='$d',
		unit_sale='$e',
		avgcost='$f',
		lastcost='$g',
		marginsale='$h',
		pricesale='$i',
		marginspecial='$j',
		pricespecial='$k',
		originproduct='$l',
		genericcode='$m',
		maxdescount='$n',
		codeaccount='$o',
		nameaccount='$p',
		codecenter='$q',
		namecenter='$r',
		inmovilizado='$s',
		inventariable='$t',
		bodega_id=". (($v!='')?'$v':'NULL') .",
		seccion_id=". (($w!='')?'$w':'NULL') .",
		subseccion_id=". (($x!='')?'$x':'NULL') .",
		details = '$u', user_update='$username', date_update='$current_date'
		WHERE product_id='$id'";
*/
header("location: productos.php");

?>