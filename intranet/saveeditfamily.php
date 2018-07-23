<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['group_id'];
$b = $_POST['family_name'];
$c = $_POST['family_label'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE family 
        SET group_id='$a', family_name='$b', family_label='$c', user_update='$username', date_update='$current_date' WHERE family_id ='$id'");

header("location: family.php");

?>