<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$a1 = $_POST['rut'];
$b = $_POST['username'];
$c = $_POST['password'];
$d = $_POST['password2'];
$e = $_POST['empresa'];
$f = $_POST['position'];
$g = $_POST['sucursal'];

// query

if($c==$d){
	$result=mysql_query("INSERT INTO user (name, rut, username,password,position,empresa_id, sucursal_id, user_create) VALUES ('$a', '$a1','$b','$c','$f','$e','$g', '$username')");
	
	header("location: user.php");
}else{
	
	header("location: user.php?error=1");
}


?>