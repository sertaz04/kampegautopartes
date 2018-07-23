<?php
session_start();
include('../connect.php');
$family = $_POST['family'];
$subfamily = $_POST['subfamily'];
$a = $_POST['family'];
$b = $_POST['subfamily_name'];
$c = $_POST['subfamily_label'];

// query

$result=mysql_query("INSERT INTO subfamily (subfamily_name,subfamily_label,family_id, empresa_id, user_create) VALUES('$b','$c','$a', $sesionEmpresaID, '$username')");

header("location: subfamily.php");


?>