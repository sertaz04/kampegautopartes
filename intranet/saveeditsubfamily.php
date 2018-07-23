<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['subfamily_name'];
$c = $_POST['subfamily_label'];
$b = $_POST['family'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE subfamily 
        SET family_id='$b', subfamily_name='$a', subfamily_label='$c', user_update='$username', date_update='$current_date' WHERE subfamily_id ='$id'");

header("location: subfamily.php");

?>