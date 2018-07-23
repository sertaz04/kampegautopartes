<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$qty=$_GET['qty'];
	$wapak=$_GET['code'];
	$sp=$_GET['sp'];
	//edit qty
	$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));

	$tipo=$_GET['tipo'];
	
	$result = mysql_query("UPDATE sales_order SET `delete`='1', user_update='$username', date_update='$current_date'  WHERE id= $id AND empresa_id = $sesionEmpresaID");
	
	if($tipo==24 || $tipo==29){
		header("location: ventasportal.php?tipo=$tipo&ivReferencia=$c&sp=$sp&edita=datos");
	}else{
		header("location: ventasportal.php?tipo=$tipo&iv=$c&sp=$sp");
	}
?>