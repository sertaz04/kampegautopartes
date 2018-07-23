<?php
 
	  $consultaClienteID = $_POST['clienteid'];
      $consultaFecha = $_POST['fecha'];
      $consultaFormaPago = $_POST['formapago'];
      
      
      if(!empty($consultaClienteID) || !empty($consultaFecha) || !empty($consultaFormaPago)) {
            buscarFactElec($consultaClienteID, $consultaFecha, $consultaFormaPago);
      }
       
      function buscarFactElec($consultaClienteID, $consultaFecha, $consultaFormaPago) {
            include('../connect.php');
       
            $query = "
            		SELECT * FROM sales sa
					LEFT JOIN customer cu
					ON sa.customer_id = cu.customer_id
					LEFT JOIN forma_pago fp
					ON fp.forma_pago_id = sa.forma_pago_id
					WHERE sa.tipo_documento_id=26
					  and sa.empresa_id = $sesionEmpresaID
					  and sa.sucursal_id = $sesionSucursalID
					  and cu.customer_id = '$consultaClienteID'
            		  and sa.`delete` = 0
            		";
            
            if($consultaFecha!=""){
            	$query .=" and sa.fecha_factura = '$consultaFecha'";
            }
            if($consultaFormaPago!=""){
            	$query .=" and sa.forma_pago_id = '$consultaFormaPago'";
            }
            
            $sqlBuscar = mysql_query($query);
                       
            $contar = mysql_num_rows($sqlBuscar);
             
            if($contar == 0){
                  echo "No se han encontrado resultados para la búsqueda'<b>";
            }else{
                  while($row=mysql_fetch_array($sqlBuscar)){
                         
                        //echo $id." - ".$nombre."<br /><br />";
                        echo "<option value=".$row['transaction_id'].">"
                        		.$row['transaction_id']." - "
                        		.$row['invoice_number']." - "
                        		.$row['rut']." - "
                        		.$row['customer_name']." - "
                        		.$row['fecha_factura']." - "
                        		.$row['descripcion'].""
                        		."</option>";
                  }
            }
      }
       
?>