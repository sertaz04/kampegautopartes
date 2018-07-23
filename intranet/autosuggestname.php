<?php
   
   include('../connect.php');
   
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $_POST['queryString'];
			
			if(strlen($queryString) >0) {

				$query = mysql_query("SELECT customer_name FROM customer WHERE customer_name LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while($result = mysql_fetch_array($query, MYSQL_ASSOC)){
	         			echo '<li onClick="fill(\''.addslashes($result['customer_name']).'\');">'.$result['customer_name'].'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>