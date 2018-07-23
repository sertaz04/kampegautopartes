<?php

include('../connect.php');

$a = $_POST['rutCliente'];
$b = $_POST['nombreFantasia'];
$c = $_POST['iv'];
$d = $_POST['correlativo'];
$e = $_POST['fechaFactura'];
$f = $_POST['fechaVencimiento'];
$g = $_POST['fechaIngreso'];
$h = $_POST['tipoProducto'];
$i = $_POST['codigoCentro'];
$j = $_POST['nombreCentro'];
$k = $_POST['tipo_documento'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));

// query
$result = mysql_query("UPDATE sales 
        SET invoice_number= '$c'
		, correlativo= '$d'
		, fecha_factura= '$e'
		, fecha_vencimiento= '$f'
		, fecha_ingreso= '$g'
		, customer_id= '$a'
		, tipo_productos= '$h'
		, centro_id= '$i'
		, user_update = '$username'
		, date_update = $current_date	
		 WHERE transaction_id ='$id'");

$resultSELECT=mysql_query("SELECT transaction_id FROM sales WHERE invoice_number = $c AND customer_id = $a AND empresa_id = $sesionEmpresaID AND `delete`='0'");

while($row = mysql_fetch_array($resultSELECT, MYSQL_ASSOC))
{
$tid=$row['transaction_id'];
}

header("location: ventasportal.php?tipo=$k&iv=$tid&sp=$a");

?>