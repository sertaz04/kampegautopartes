<?php
// configuration
include('../connect.php');

$id = $_POST['memi'];
$a = $_POST['suplier_rut'];
$b = $_POST['suplier_name'];
$b1 = $_POST['suplier_namefantasia'];
$c = $_POST['suplier_address'];
$c1 = $_POST['suplier_ciudad'];
$c2 = $_POST['suplier_comuna'];
$d = $_POST['suplier_contact'];
$e = $_POST['contact_person'];
$f = $_POST['suplier_giro'];
$f1 = $_POST['suplier_email'];
$g = $_POST['note'];
$timestamp = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));

// query

$result=mysql_query("UPDATE supliers 
        SET suplier_rut='$a', suplier_name='$b', suplier_fantasyname='$b1', suplier_address='$c', suplier_ciudad='$c1', suplier_comuna='$c2', suplier_contact='$d', contact_person='$e', suplier_giro='$f', suplier_email='$f1', note='$g', user_update='$username', date_update='$timestamp' WHERE suplier_id='$id'");

header("location: supplier.php");

?>