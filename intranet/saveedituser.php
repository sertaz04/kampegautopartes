<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['name'];
$a1 = $_POST['rut'];
$b = $_POST['username'];
$c = $_POST['password'];
$d = $_POST['password2'];
$e = $_POST['empresa'];
$f = $_POST['position'];
$g = $_POST['sucursal'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));

if($c==$d){
	// query
	$result = mysql_query("UPDATE user 
        SET name='$a', rut='$a1', username='$b', password='$c', empresa_id='$e', position='$f', sucursal_id='$g', user_update='$username', date_update='$current_date', user_update='$username', date_update='$current_date' WHERE id ='$id'");
	
	header("location: user.php");
}else{
	
	header("location: user.php?error=1");
}
?>