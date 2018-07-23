<?php 

	$cliente_id = $_GET['customer_id'];
	
?>
<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script>

        $(document).ready(function(){
			$(".pagarButton").click(function(){
				$listadoIds = '';
				$totalDeuda = 0;
				$("input[type=checkbox]").each(
					function(index, value) {
						if ($(this).is(':checked')  && $(this).val() != 'marcarTodo'){
							if($listadoIds!=''){
								$listadoIds += ','
							}

							$listadoIds += $(this).attr('data-id');
							$totalDeuda += parseInt($(this).attr('value'));
						}
					}
				);
				$("#tipo_pago").val('efectivo');
				$("#totalPago").val($totalDeuda);
				//completo modal
				$("#listadoIdsPago").val($listadoIds);
				$("#cliente_id").val(<?php echo $cliente_id;?>);
				$("#monto").val($totalDeuda);
				$("#customer_rut").val($("#rut").val());
				$("#customer_name").val($("#nombre").val());
								
				$("#myModalEfectivo").modal();
			});
			
			$(".pagarAbonoButton").click(function(){
				$listadoIds = '';
				$totalDeuda = 0;
				$("input[type=checkbox]").each(
					function(index, value) {
						if ($(this).is(':checked')  && $(this).val() != 'marcarTodo'){
							if($listadoIds!=''){
								$listadoIds += ','
							}

							$listadoIds += $(this).attr('data-id');
							$totalDeuda += parseInt($(this).attr('value'));
						}
					}
				);
				$("#tipo_pago3").val('efectivo');
				$("#totalPago3").val(0);
				$("#montoMaximoPago3").val($totalDeuda);
				//completo modal
				$("#listadoIdsPago3").val($listadoIds);
				$("#cliente_id3").val(<?php echo $cliente_id;?>);
				$("#monto3").val(0);
				$("#customer_rut3").val($("#rut").val());
				$("#customer_name3").val($("#nombre").val());
								
				$("#myModalAbono").modal();
			});

			$(".pagarAbonoChequeButton").click(function(){
				$listadoIds = '';
				$totalDeuda = 0;
				$("input[type=checkbox]").each(
					function(index, value) {
						if ($(this).is(':checked')  && $(this).val() != 'marcarTodo'){
							if($listadoIds!=''){
								$listadoIds += ','
							}

							$listadoIds += $(this).attr('data-id');
							$totalDeuda += parseInt($(this).attr('value'));
						}
					}
				);
				$("#tipo_pago5").val('cheque');
				$("#totalPago5").val(0);
				$("#montoMaximoPago5").val($totalDeuda);
				//completo modal
				$("#listadoIdsPago5").val($listadoIds);
				$("#cliente_id5").val(<?php echo $cliente_id;?>);
				$("#monto5").val(0);
				$("#customer_rut5").val($("#rut").val());
				$("#customer_name5").val($("#nombre").val());
								
				$("#myModalAbonoCheque").modal();
			});
			
			$(".pagarChequeButton").click(function(){
				$listadoIds = '';
				$totalDeuda = 0;
				$("input[type=checkbox]").each(
					function(index, value) {
						if ($(this).is(':checked') && $(this).val() != 'marcarTodo'){
							if($listadoIds!=''){
								$listadoIds += ','
							}
							$listadoIds += $(this).attr('data-id');
							$totalDeuda += parseInt($(this).attr('value'));
						}
					}
				);
				$("#tipo_pago2").val('cheque');
				$("#totalPago2").val($totalDeuda);
				//completo modal
				$("#listadoIdsPago2").val($listadoIds);
				$("#cliente_id2").val(<?php echo $cliente_id;?>);
				$("#monto2").val($totalDeuda);
				$("#customer_rut2").val($("#rut").val());
				$("#customer_name2").val($("#nombre").val());
								
				$("#myModalCheque").modal();
			});

			$(".pagarNCButton").click(function(){
				var id = <?php echo $cliente_id;?>;
				$.ajax({
					url: 'modalCreditoNCData.php?id=' + id,
					method: 'GET'
				}).success(function(response) {
					
						var sumaNC = 0;
						$contenidoLista = "<table class=\"table table-bordered\">";
						$contenidoLista += "<tr><td>NC</td><td>Nro Documento</td><td>Tipo</td><td>Fecha Vencimiento</td><td>Monto</td></tr>";
						for (i = 0; i < response.records.length; i++) { 
							$contenidoLista += "<tr>"
											+"<td>"+"<input type=\"checkbox\" onClick=\"validaSumaCheckNC(this)\" class=\"idListNC\" value=\""+response.records[i].monto+"\" data-id=\""+response.records[i].transaction_id+"\">"+"</td>"
											+"<td>"+ response.records[i].folio_DTE+"</td>"
											+"<td>"+ response.records[i].tipo_documento+"</td>"
											+"<td>"+ response.records[i].fecha_vencimiento+"</td>"
											+"<td>"+ parseInt(response.records[i].monto)+"</td>"
											+"</tr>";
							sumaNC += parseInt(response.records[i].monto);
						}
						$contenidoLista += "<tr><td></td><td></td><td></td><td>TOTAL</td><td>"+sumaNC+"</td></tr>";
						$contenidoLista += "</table>";
						
						$("#acLista").html($contenidoLista);			
				
				
						$listadoIds = '';
						$totalDeuda = 0;
						$("input[type=checkbox]").each(
							function(index, value) {
								if ($(this).is(':checked')  && $(this).val() != 'marcarTodo'){
									if($listadoIds!=''){
										$listadoIds += ','
									}

									$listadoIds += $(this).attr('data-id');
									$totalDeuda += parseInt($(this).attr('value'));
								}
							}
						);
						$("#tipo_pago4").val('nota credito');
						$("#totalPago4").val($totalDeuda);
						//completo modal
						$("#listadoIdsPago4").val($listadoIds);
						$("#cliente_id4").val(<?php echo $cliente_id;?>);
						$("#monto4").val($totalDeuda);
						$("#customer_rut4").val($("#rut").val());
						$("#customer_name4").val($("#nombre").val());
				
				
				
					$("#myModalNotaCredito").modal();
				}).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
				});
			});
			$("#marcarTodo").change(function () {
			    if ($(this).is(':checked')) {
			        $("input[type=checkbox]").prop('checked', true);
			    } else {
			        $("input[type=checkbox]").prop('checked', false);
			    }
			});
			
			
			
			$(".delbutton").click(function(){
			
			//Save the link in a variable called element
			var element = $(this);
			
			//Find the id of the link that was clicked
			var del_id = element.attr("id");
			var del_id_inovice = element.attr("data-id");
			
			//Built a url to send
			var info = 'id=' + del_id + '&invoice='+del_id_inovice;
			
			 if(confirm("Está seguro que desea borrar este pago? \n Este proceso no es reversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deletepago.php",
			   data: info,
			   success: function(){
			   	alert('El Pago se ha borrado correctamente');
			   }
			 });
					 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
					.animate({ opacity: "hide" }, "slow");
			
			 }
			
			return false;
			
			});
			
			
			/*
			$(".editButton").click(function(){
				var id = $(this).attr('id');

				$.ajax({
					url: 'editpago.php?id=' + id,
					method: 'GET'
				}).success(function(response) {
						
						//alert(response.records.length);
						if(response.records[0].forma_pago=='efectivo'){
							$("#tipo_pago").val('efectivo');
							$("#totalPago").val(response.records[0].monto);
							//completo modal
							$("#cliente_id").val(<?php echo $cliente_id;?>);
							$("#monto").val(response.records[0].monto);
							$("#monto")prop('readonly', false);
							$("#customer_rut").val($("#rut").val());
							$("#customer_name").val($("#nombre").val());
							$("#myModalEfectivo").modal();
						}else if(response.records[0].forma_pago=='cheque'){
							$("#tipo_pago5").val('cheque');
							$("#totalPago5").val(response.records[0].monto);
							$("#montoMaximoPago5").val(response.records[0].monto);
							$("#cliente_id5").val(<?php echo $cliente_id;?>);
							$("#monto5").val(response.records[0].monto);
							$("#monto5")prop('readonly', false);
							$("#customer_rut5").val($("#rut").val());
							$("#customer_name5").val($("#nombre").val());
							$("#myModalCheque").modal();
						}else if(response.records[0].forma_pago=='nota credito'){
							$("#totalPago4").val(response.records[0].monto);
							//completo modal
							$("#cliente_id4").val(<?php echo $cliente_id;?>);
							$("#monto4").val(response.records[0].monto);
							$("#monto4")prop('readonly', false);
							$("#customer_rut4").val($("#rut").val());
							$("#customer_name4").val($("#nombre").val());
							$("#myModalNotaCredito").modal();
						}
				}).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
					});
			});*/
			
			
		});


        </script>
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
		<h1>Cartola de Cliente</h1>
		<?php 
		
		include('../connect.php');
		$sql = "SELECT id_invoice, folio_DTE, rut, customer_name, 
					ROUND(sum(deuda)) as deuda , 
					fecha_factura,fecha_vencimiento, descripcion, monto FROM (SELECT cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
					ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
					sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
					s.fecha_factura, s.fecha_vencimiento, td.descripcion,
					(select sum(vp.monto) from ventas_pagos vp WHERE vp.transaction_id = s.transaction_id) as monto
				FROM sales s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order so ON so.invoice = s.transaction_id AND so.`delete` = 0
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 0
				GROUP BY cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento
				union all
				SELECT cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
					ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
					sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
					s.fecha_factura, s.fecha_vencimiento, td.descripcion,
					(select sum(vp.monto) from ventas_pagos vp WHERE vp.transaction_id = s.transaction_id) as monto
				FROM sales_history s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 0
				GROUP BY cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento
				union all
					SELECT cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
					ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
					sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
					s.fecha_factura, s.fecha_vencimiento, td.descripcion,
					(select sum(vp.monto) from ventas_pagos vp WHERE vp.transaction_id = s.transaction_id) as monto
				FROM sales s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 0
				GROUP BY cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento) as creditos
GROUP BY id_invoice, folio_DTE, rut, customer_name, fecha_factura, fecha_vencimiento
				ORDER BY folio_DTE ASC";
		
		$result = mysql_query($sql);
		
		$rutCliente = '';
		$nombreCliente = '';
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$rutCliente = $row['rut'];
			$nombreCliente = $row['customer_name'];
			$sumaTotalTitulo +=  intval($row['deuda'])-intval($row['monto']);
		}
		?>
		
		Rut: <?php echo $rutCliente;?><br>
		Cliente: <?php echo $nombreCliente;?><br>
		Saldo: <?php echo $sumaTotalTitulo;?>
		
		<h2>Lista de documentos Pendiente de pago</h2>
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                	<th width="5%"> <input type="checkbox" name="marcarTodo" id="marcarTodo" value="marcarTodo" /> Marcar</th>
                    <th width="10%"> N&uacute;mero documento</th>
                    <th width="15%"> Fecha documento</th>
                    <th width="20%"> Tipo documento </th>
                    <th width="15%"> Fecha vencimiento</th>
                    <th width="10%"> Monto Dcto</th>
					<th width="10%"> Abono</th>
					<th width="10%"> Deuda</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    	$result = mysql_query($sql);
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
	                    <td><input type="checkbox" class="listaCheck" value="<?php echo intval($row['deuda'])-intval($row['monto']); ?>" data-id="<?php echo $row['id_invoice']; ?>"></td>
	                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['folio_DTE']; ?></td>
	                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['fecha_factura']; ?></td>
	                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['descripcion']; ?></td>
	                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php echo $row['fecha_vencimiento']; ?></td>
	                    <td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php $sumaTotalDeuda +=  intval($row['deuda']);echo intval($row['deuda'])?></td>
						<td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php $sumaTotalAbono +=  intval($row['monto']);echo intval($row['monto']); ?></td>
						<td <?php if($row['fecha_vencimiento']<date("Y-m-d")){ echo "bgcolor=\"red\"";}?>><?php $sumaTotal +=  intval($row['deuda'])-intval($row['monto']); echo intval($row['deuda'])-intval($row['monto']); ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                	<tr class="record">
	                    <td></td>
	                    <td></td>
	                    <td></td>
	                    <td></td>
	                    <td>Total</td>
	                    <td><?php echo $sumaTotalDeuda;?></td>
						<td><?php echo $sumaTotalAbono;?></td>
						<td><?php echo $sumaTotal;?></td>
                    </tr>
            </tbody>
         </table>
         
        <input type="hidden" name="tipoPago" id="tipoPago" value="">
        <input type="hidden" name="totalPago" id="totalPago" value="">
        <input type="hidden" name="rut" id="rut" value="<?php echo $rutCliente;?>">
        <input type="hidden" name="nombre" id="nombre" value="<?php echo $nombreCliente;?>">
 
		<button data-id="<?php echo $row['id_invoice']; ?>" type="button" class="btn btn-success btn-mini pagarButton" data-toggle="modal" >Efectivo</button>
		<button data-id="<?php echo $row['id_invoice']; ?>" type="button" class="btn btn-primary btn-mini pagarChequeButton" data-toggle="modal" >Cheque</button>
		<button data-id="<?php echo $row['id_invoice']; ?>" type="button" class="btn btn-warning btn-mini pagarAbonoButton" data-toggle="modal" >Abono</button>
		<button data-id="<?php echo $row['id_invoice']; ?>" type="button" class="btn btn-warning btn-mini pagarAbonoChequeButton" data-toggle="modal" >Abono Cheque</button>
		<button data-id="<?php echo $row['id_invoice']; ?>" type="button" class="btn btn-info btn-mini pagarNCButton" data-toggle="modal" >Nota Cr&eacute;dito</button>

         
        </div>
      <div class="modal fade" id="myModalEfectivo" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('modalCredito.php');?>

		</div>
      </div>
      <div class="modal fade" id="myModalCheque" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('modalCreditoCheque.php');?>

		</div>
      </div>
      <div class="modal fade" id="myModalAbono" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('modalCreditoAbono.php');?>

		</div>
      </div>
	  <div class="modal fade" id="myModalAbonoCheque" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('modalCreditoAbonoCheque.php');?>

		</div>
      </div>
	  <div class="modal fade" id="myModalNotaCredito" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('modalCreditoNC.php');?>

		</div>
      </div>
	  
	  
	  <!-- Listad de pago -->
	  <div class="container">
	  <h2>Lista de documentos Pagados</h2>
		
		<?php 
		
		include('../connect.php');
		$sql = "SELECT id, id_invoice, folio_DTE, rut, customer_name, 
						ROUND(sum(deuda)) as deuda , 
				monto, fecha_factura, fecha_vencimiento, descripcion, forma_pago, numero_cheque, banco_name, fecha_cheque FROM 
				(SELECT vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
				vp.monto, s.fecha_factura, s.fecha_vencimiento, td.descripcion, vp.forma_pago, vp.numero_cheque, b.banco_name, vp.fecha_cheque
				FROM sales s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order so ON so.invoice = s.transaction_id AND so.`delete` = 0
				LEFT JOIN ventas_pagos vp ON vp.transaction_id = s.transaction_id
				LEFT JOIN bancos b ON vp.banco_id = b.banco_id
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 1
				GROUP BY vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento, vp.monto, vp.forma_pago, vp.numero_cheque, vp.fecha_cheque, b.banco_name
				union all
				SELECT vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
				vp.monto, s.fecha_factura, s.fecha_vencimiento, td.descripcion, vp.forma_pago, vp.numero_cheque, b.banco_name, vp.fecha_cheque
				FROM sales_history s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
				LEFT JOIN ventas_pagos vp ON vp.transaction_id = s.transaction_id
				LEFT JOIN bancos b ON vp.banco_id = b.banco_id
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 1
				GROUP BY vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento, vp.monto, vp.forma_pago, vp.numero_cheque, vp.fecha_cheque, b.banco_name
				union all
				SELECT vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, 
						ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)) +
						sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*0.19) as deuda , 
				vp.monto, s.fecha_factura, s.fecha_vencimiento, td.descripcion, vp.forma_pago, vp.numero_cheque, b.banco_name, vp.fecha_cheque
				FROM sales s
				LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
				LEFT JOIN customer c ON c.customer_id = s.customer_id
				LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
				LEFT JOIN sales_order_history so ON so.invoice = s.transaction_id AND so.`delete` = 0
				LEFT JOIN ventas_pagos vp ON vp.transaction_id = s.transaction_id
				LEFT JOIN bancos b ON vp.banco_id = b.banco_id
				where s.forma_pago_id = 2
				AND s.empresa_id = $sesionEmpresaID
				AND s.`delete` = 0
				AND cs.folio_DTE > 0
				AND c.customer_id = $cliente_id
				AND s.estado_pago = 1
				GROUP BY vp.id, cs.id_invoice, cs.folio_DTE, c.rut, c.customer_name, s.fecha_factura, s.fecha_vencimiento, vp.monto, vp.forma_pago, vp.numero_cheque, vp.fecha_cheque, b.banco_name) AS CREDITOS1
GROUP BY id, id_invoice, folio_DTE, rut, customer_name, fecha_factura, fecha_vencimiento, monto, forma_pago, numero_cheque, fecha_cheque, banco_name
				ORDER BY folio_DTE ASC";
		
		$result = mysql_query($sql);
		
		$sumaTotal = 0;
		?>

		
		<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table2" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> N&uacute;mero documento</th>
                    <th width="15%"> Fecha documento</th>
                    <th width="20%"> Tipo documento </th>
                    <th width="15%"> Fecha vencimiento</th>
                    <th width="10%"> Monto Factura</th>
					<th width="10%"> Monto Pagado</th>
					<th width="10%"> Forma Pago</th>
					<th width="20%"> ...</th>
					<th width="10%"> Acciones</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    	$result = mysql_query($sql);
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
	                    <td><?php echo $row['folio_DTE']; ?></td>
	                    <td><?php echo $row['fecha_factura']; ?></td>
	                    <td><?php echo $row['descripcion']; ?></td>
	                    <td><?php echo $row['fecha_vencimiento']; ?></td>
	                    <td><?php echo intval($row['deuda']); ?></td>
						<td><?php $sumaTotal +=  intval($row['deuda'])-intval($row['monto']); echo intval($row['monto']); ?></td>
						<td><?php echo $row['forma_pago']; ?></td>
						<td><?php if($row['forma_pago']=='cheque'){ echo $row['numero_cheque'].' - '.$row['banco_name'].' - '.$row['fecha_cheque']; }?></td>
						<td>
						<? if($userposition=='Administrador'){ ?>
						<a href="#" id="<?php echo $row['id']; ?>" data-id="<?php echo $row['id_invoice']; ?>" class="delbutton" title="Click para borrar cliente"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a></td>
						<? }?>
						</td>
                    </tr>
                    <?php
                        }
                    ?>
                	<tr class="record">
	                    <td></td>
	                    <td></td>
	                    <td></td>
	                    <td></td>
	                    <td>Saldo</td>
	                    <td><?php echo $sumaTotal;?></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
            </tbody>
         </table>
		 
		 </div>
	  
    </div>
        
	</body>
</html>