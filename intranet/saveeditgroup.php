<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['group_name'];
$b = $_POST['group_label'];
$current_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s")));
// query
$result = mysql_query("UPDATE `group` 
        SET group_name='$a', group_label='$b', user_update='$username', date_update='$current_date' WHERE group_id ='$id'");

header("location: group.php");

?>