<?php
session_start();
include('../connect.php');
$a0 = $_POST['rut'];
$a = $_POST['name'];

$b = $_POST['address'];
$b1 = $_POST['ciudad'];
$b2 = $_POST['comuna'];
$c = $_POST['contact'];
$c1 = $_POST['phone'];
$d = $_POST['total'];
$e = $_POST['prod_name'];
$e1 = $_POST['email'];

$f = $_POST['note'];
$g = $_POST['date'];
$h = $_POST['origen'];

$i0 = $_POST['tipo_cliente'];
$i = $_POST['bloqueado'];
$j = $_POST['rutlibre'];
$k = $_POST['permiteDescuento'];
$l = $_POST['porc_max'];
$m = $_POST['saldo_max'];
$n = $_POST['vendedor_cartera'];

$tipoDoc = $_POST['tipo_documento_customer'];

// query


//echo "INSERT INTO customer (rut,customer_name, customer_fantasyname,address, ciudad, comuna ,contact, phone,membership_number,prod_name, email,note,expected_date, empresa_id, user_create, tipo_cliente, bloqueado, rut_libre, descuento, porcentaje_maximo_descuento, saldo_maximo, vendedor_cartera) VALUES ('$a0','$a','$a1','$b','$b1','$b2','$c','$c1','$d','$e','$e1','$f','$g', $sesionEmpresaID, '$username', '$i0', '$i', '$j', '$k', '$l', '$m', '$n')";
$result=mysql_query("INSERT INTO customer (rut,customer_name, address, ciudad, comuna ,contact, phone,membership_number,prod_name, email,note,expected_date, empresa_id, sucursal_id, user_create, tipo_cliente, bloqueado, rut_libre, descuento, porcentaje_maximo_descuento, saldo_maximo, vendedor_cartera) VALUES ('$a0','$a','$b','$b1','$b2','$c','$c1','$d','$e','$e1','$f','$g', $sesionEmpresaID, $sesionSucursalID, '$username', '$i0', '$i', '$j', '$k', '$l', '$m', '$n')");

//obtengo ID
$resultSELECT=mysql_query("SELECT max(customer_id) as customer_id FROM customer WHERE rut = '$a0' AND empresa_id = $sesionEmpresaID AND sucursal_id = $sesionSucursalID AND `delete`='0'");

while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
$tid=$row['customer_id'];
//echo $tid;
}

//crear sucursal por defecto
$result=mysql_query("INSERT INTO customer_sucursal (customer_sucursal_direccion, customer_sucursal_ciudad, customer_sucursal_comuna , customer_sucursal_contacto, customer_sucursal_telefono, customer_sucursal_email,customer_id) 
													values('$b', '$b1', '$b2', '$c', '$c1', '$e1', $tid)");
/*													
echo "INSERT INTO customer_sucursal (customer_sucursal_direccion, customer_sucursal_ciudad, customer_sucursal_comuna , customer_sucursal_contacto, customer_sucursal_telefono, customer_sucursal_email,customer_id) 
													values('$b', '$b1', '$b2', '$c', '$c1', '$e1', $tid)";
*/
										
if($h==1){
header("location: cotizaciones.php");
}else if($h==2){
header("location: ventas.php?tipo=$tipoDoc");
}else{
header("location: customer.php");
}


?>