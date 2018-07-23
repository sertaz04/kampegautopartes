<?php
	//Start session
	@session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		
		echo("<script>location.href = '../index.php';</script>");
		//exit(header("location: ../index.php"));
	}
?>

        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>
        <script>
			$(function() {
				$(".chzn-select").chosen();
			});
        </script>
        <script src="../js/application.js" type="text/javascript" charset="utf-8"></script>