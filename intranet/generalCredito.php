<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>

        $(document).ready(function(){
			$(".listadoPagoButton").click(function(){
				var id = $(this).attr('data-id');
				$.ajax({
					url: 'listadoPagoLista.php?id=' + id,
					method: 'GET'
				}).success(function(response) {
						$totalLista = 0;
						$contenidoLista = "<table class=\"table table-bordered\">";
						$contenidoLista += "<tr><td>Nro Documento</td><td>Tipo</td><td>Fecha Vencimiento</td><td>Monto</td></tr>";
						for (i = 0; i < response.records.length; i++) { 
							$contenidoLista += "<tr>"
											+"<td>"+ response.records[i].folio_DTE+"</td>"
											+"<td>"+ response.records[i].tipo_documento+"</td>"
											+"<td>"+ response.records[i].fecha_vencimiento+"</td>"
											+"<td>"+ response.records[i].monto+"</td>"
											+"</tr>";
							$rutClienteLista = response.records[i].rut;
							$nombreClienteLista = response.records[i].customer_name;
							$totalLista += parseInt(response.records[i].monto);
						}

						$contenidoLista += "<tr><td></td><td></td><td>Total</td><td>"+$totalLista+"</td></tr>"
						
						$contenidoLista += "</table>";
						$("#acLista").html($contenidoLista);
						$("#rutCliente").html("Rut Cliente: " + $rutClienteLista);
						$("#nombreCliente").html("Nombre Cliente: " + $nombreClienteLista);
						$("#myModalListadopago").modal();
				}).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
					});
			});
		});


        </script>
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
          <h2>Lista de cr&eacute;ditos</h2>
			<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar deudas..." autocomplete="off" />
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="25%"> Cliente </th>
                    <th width="15%"> Primera Fecha Vencimiento</th>
                    <th width="10%"> Monto</th>
                    <th width="25%"> Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT customer_id, rut, customer_name, sum(deuda) as deuda, min(fecha_vencimiento) as fecha_vencimiento FROM (SELECT c.customer_id, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
                        						min(s.fecha_vencimiento) as fecha_vencimiento 
												FROM customer c
                        						LEFT JOIN sales s ON s.customer_id = c.customer_id
                        						LEFT JOIN sales_order so ON so.invoice = s.transaction_id AND so.`delete` = 0
												LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id											
												where s.forma_pago_id = 2
												  AND s.empresa_id = $sesionEmpresaID
                        						  AND s.`delete` = 0
                        						  AND cs.folio_DTE > 0
                        						  AND s.estado_pago = 0
												GROUP BY c.customer_id, c.rut, c.customer_name
												UNION ALL
												SELECT c.customer_id, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
                        						min(s.fecha_vencimiento) as fecha_vencimiento 
												FROM customer c
                        						LEFT JOIN sales_history s ON s.customer_id = c.customer_id
                        						LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
												LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id											
												where s.forma_pago_id = 2
												  AND s.empresa_id = $sesionEmpresaID
                        						  AND s.`delete` = 0
                        						  AND cs.folio_DTE > 0
                        						  AND s.estado_pago = 0
												GROUP BY c.customer_id, c.rut, c.customer_name
												UNION ALL
												SELECT c.customer_id, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
                        						min(s.fecha_vencimiento) as fecha_vencimiento 
												FROM customer c
                        						LEFT JOIN sales s ON s.customer_id = c.customer_id
                        						LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
												LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id											
												where s.forma_pago_id = 2
												  AND s.empresa_id = $sesionEmpresaID
                        						  AND s.`delete` = 0
                        						  AND cs.folio_DTE > 0
                        						  AND s.estado_pago = 0
												GROUP BY c.customer_id, c.rut, c.customer_name) AS CREDITOS
                        						GROUP BY customer_id, rut, customer_name");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['rut'].' - '.$row['customer_name']; ?></td>
                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['fecha_vencimiento']; ?></td>
                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['deuda']; ?></td>
                    <td> 
						<a href="credito.php?customer_id=<?php echo $row['customer_id']; ?>">
							<Button class="btn btn-success btn-mini" />Pagar</button>
						</a>
                    	<!--  <button data-id="<?php echo $row['customer_id']; ?>" type="button" class="btn btn-success btn-mini pagarButton" data-toggle="modal" >Pagar</button>
                    	<button data-id="<?php echo $row['customer_id']; ?>" type="button" class="btn btn-warning btn-mini abonarButton" data-toggle="modal" >Abonar</button>-->
                    	<button data-id="<?php echo $row['customer_id']; ?>" type="button" class="btn btn-primary btn-mini listadoPagoButton" data-toggle="modal" >Listado Pago</button>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                
            </tbody>
         </table>
        </div>
      <div class="modal fade" id="myModalListadopago" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('listadoPago.php');?>

		</div>
      </div>
        
	</body>
</html>