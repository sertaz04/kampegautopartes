<?php

	//Connect to mysql server
	//$link = mysql_connect('200.6.99.249','kam837cl','peg791rNo');
	//if(!$link) {
	//	die('Failed to connect to server: ' . mysql_error());
	//}
	
	//ANACONDAWEB
	$link = mysql_connect('localhost','root','Kampeg123');
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db('kampegerp-produccion', $link);
	if(!$db) {
		die("Unable to select database");
	}
	@session_start();
	$sesionEmpresaID = $_SESSION['SESS_EMPRESA_ID'];
	$sesionSucursalID = $_SESSION['SESS_SUCURSAL_ID'];
	$username = $_SESSION['SESS_USER'];
	$userposition = $_SESSION['SESS_TYPE'];

?>