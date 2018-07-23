<?php
	include('../connect.php');
	$id=$_GET['id'];
	$id_invoice=$_GET['invoice'];
	
	$result = mysql_query("DELETE FROM ventas_pagos WHERE id= $id AND empresa_id = $sesionEmpresaID");
	$result = mysql_query("UPDATE sales SET estado_pago = 0 WHERE transaction_id= $id_invoice AND empresa_id = $sesionEmpresaID");
	$result = mysql_query("UPDATE sales_history SET estado_pago = 0 WHERE transaction_id= $id_invoice AND empresa_id = $sesionEmpresaID");
?>