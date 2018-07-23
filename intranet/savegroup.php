<?php
session_start();
include('../connect.php');
$a = $_POST['group_name'];
$b = $_POST['group_label'];

// query

$result=mysql_query("INSERT INTO `group` (group_name,group_label, empresa_id, user_create) VALUES('$a','$b', $sesionEmpresaID, '$username')");

header("location: group.php");


?>