<?php 

// header("Access-Control-Allow-Origin: *"); 
// header("Content-Type: application/json; charset=UTF-8");   

$id = $_GET['id'];
buscar($id);

function buscar($id){

	include('../connect.php');
		$result = mysql_query("SELECT * FROM customer_sucursal cs INNER JOIN customer c ON c.customer_id = cs.customer_id WHERE cs.customer_id= '$id' AND cs.`delete`='0'");
		
		$i=1; 
		$outp = ""; 
		
		$contar = mysql_num_rows($result);
				 
		if($contar == 0){
			  echo "No se han encontrado resultados para la sucursal buscada";
			  //."SELECT * FROM customer_sucursal cs INNER JOIN customer c ON c.customer_id = cs.customer_id WHERE cs.customer_id= '$id'";
		}else{	
			while($row=mysql_fetch_array($result)){
					echo "<option value=".$row['customer_sucursal_id'].">".$row['customer_sucursal_direccion']." - ".$row['customer_sucursal_ciudad']." - "
							.$row['customer_sucursal_comuna']." - ".$row['customer_sucursal_telefono']." - "
							.$row['customer_sucursal_email']."</option>";
			}
		}
	}

?>