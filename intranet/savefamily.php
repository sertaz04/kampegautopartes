<?php
session_start();
include('../connect.php');
$a = $_POST['group_id'];
$b = $_POST['family_name'];
$c = $_POST['family_label'];

// query

$result=mysql_query("INSERT INTO family (group_id,family_name,family_label, empresa_id, user_create) VALUES('$a','$b','$c', $sesionEmpresaID, '$username')");

header("location: family.php");


?>