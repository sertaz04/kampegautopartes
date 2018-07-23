<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/jquery.dataTables.min.css" rel="stylesheet">
        
        <style type="text/css">
	    thead input {
	        width: 100%;
	        padding: 3px;
	        box-sizing: border-box;
	    }
        </style>
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <?php
			require_once('auth.php');
		 ?>
         <script type="text/javascript">
			$(function() {
			
			
			$(".delbutton").click(function(){
			
			//Save the link in a variable called element
			var element = $(this);
			
			//Find the id of the link that was clicked
			var del_id = element.attr("id");
			
			//Built a url to send
			var info = 'id=' + del_id;
			 if(confirm("!Está seguro que desea borrar este producto? \n Este proceso no es reversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deleteproduct.php",
			   data: info,
			   success: function(){
			   
			   }
			 });
					 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
					.animate({ opacity: "hide" }, "slow");
			
			 }
			
			return false;
			
			});
			
			});


			$(document).ready(function(){
				$("#myBtn").click(function(){
					
					$("#memi").val('');
					$("#group").val('');
					$("#family").val('');
					$("#subfamily").val('');
					$("#code").val('');
					$("#name").val('');
					$("#codebar").val('');
					$("#unit_purchase").val('');
					$("#unit_sale").val('');
					$("#avgcost").val('');
					$("#lastcost").val('');
					$("#marginsale").val('');
					$("#pricesale").val('');
					$("#marginspecial").val('');
					$("#pricespecial").val('');
					$("#orginproduct").val('');
					$("#genericcode").val('');
					$("#maxdescount").val('');
					$("#details").val('');
					$("#codeaccount").val('');
					$("#nameaccount").val('');
					$("#codecenter").val('');
					$("#namecenter").val('');
					$("#inmovilizado").val('');
					$("#inventariable").val('');
					$("#bodega").val('');
					$("#seccion").val('');
					$("#subseccion").val('');
					
					
					$("#userForm").attr("action", "saveproduct.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editproduct.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].product_id);
					
							$("#group").val(response.records[0].group);
							$("#family").val(response.records[0].family_id);
							$("#subfamily").val(response.records[0].subfamily_id);
							$("#code").val(response.records[0].code);
							$("#name").val(response.records[0].name);
							$("#codebar").val(response.records[0].codebar);
							$("#unit_purchase").val(response.records[0].unit_purchase);
							$("#unit_sale").val(response.records[0].unit_sale);
							$("#avgcost").val(response.records[0].avgcost);
							$("#lastcost").val(response.records[0].lastcost);
							$("#marginsale").val(response.records[0].marginsale);
							$("#pricesale").val(response.records[0].pricesale);
							$("#marginspecial").val(response.records[0].marginspecial);
							$("#pricespecial").val(response.records[0].pricespecial);
							$("#orginproduct").val(response.records[0].orginproduct);
							$("#genericcode").val(response.records[0].genericcode);
							$("#maxdescount").val(response.records[0].maxdescount);
							$("#details").val(response.records[0].details);
							$("#codeaccount").val(response.records[0].codeaccount);
							$("#nameaccount").val(response.records[0].nameaccount);
							$("#codecenter").val(response.records[0].codecenter);
							$("#namecenter").val(response.records[0].namecenter);
							$("#inmovilizado").val(response.records[0].inmovilizado);
							$("#inventariable").val(response.records[0].inventariable);
							$("#bodega").val(response.records[0].bodega_id);
							$("#seccion").val(response.records[0].seccion_id);
							$("#subseccion").val(response.records[0].subseccion_id);
							
							
							$("#userForm").attr("action", "saveeditproduct.php");
							$("#myModal").modal();
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
				});
			});

			function comprobarCodigoBarra(){
				if(!$("#memi").val()>0){
					var grupo = $("#group").val();					
					var familia = $("#family").val();
					var subfamilia = $("#subfamily").val();
					var codebar = $("#codebar").val();
					$.ajax({
					url: 'comprobarCodigoBarra.php?grupo=' + grupo + '&familia=' + familia + '&subfamilia=' + subfamilia + '&codigoBarra=' + codebar,
					method: 'GET'
					}).success(function(response) {
						var existeProductoBarra = response.records[0].existe;
						if(existeProductoBarra>0){
							alert('El c�digo de barra ya existe, favor ingresar un c�digo de barra diferente');
							$("#codebar").val('');	
						}
					}).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
					});
				}
			}

			$(document).ready(function(){
				$("#group").change(function(){
					comprobarCodigoBarra();
				});
			});
			
			$(document).ready(function(){
				$("#family").change(function(){
					comprobarCodigoBarra();
				});
			});
			
			$(document).ready(function(){
				$("#subfamily").change(function(){
					comprobarCodigoBarra();
				});
			});
			
			$(document).ready(function(){
				$("#codebar").change(function(){
					comprobarCodigoBarra();
				});
			});
			


			$(document).ready(function() {
			    // Setup - add a text input to each footer cell
			    $('#resultTableProductos tfoot th').each( function () {
			        var title = $(this).text();
			        $(this).html( '<input type="text" placeholder="'+title+'" />' );
			    } );
			 
			    // DataTable
			    var table = $('#resultTableProductos').DataTable();
			 
			    // Apply the search
			    table.columns().every( function () {
			        var that = this;
			 
			        $( 'input', this.footer() ).on( 'keyup change', function () {
			            if ( that.search() !== this.value ) {
			                that
			                    .search( this.value )
			                    .draw();
			            }
			        } );
			    } );
			} );
			

</script>
        
    </head>
    <body>
    <?php include('navfixed.php');?>
	<div class="container-fluid">
    <div class="row-fluid">
	<div class="span10">
	<div class="contentheader">
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Productos</li>
			</ul>
       
       <div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT code FROM products WHERE empresa_id = $sesionEmpresaID AND `delete`='0' group by code");
				
				$rowcount = mysql_num_rows($result);
			?>
			
			<div style="text-align:center;">
			N&uacute;mero Total de Productos:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			
</div>

<br />
<!--  <input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Producto..." autocomplete="off" /> -->
<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Productos</button>
<br /><br /><br />

<form action="productos.php" method="post" name="buscarProductos">
<input type="hidden" name="buscar" value="1" />
<input type="text" id="busquedaGrupo" name="busquedaGrupo" placeholder="Grupo" maxlength="2" size="2" value="<?php echo $_POST['busquedaGrupo'];?>"/>
<input type="text" id="busquedaFamily" name="busquedaFamily" placeholder="Familia" maxlength="2" size="2" value="<?php echo $_POST['busquedaFamily'];?>"/>
<input type="text" id="busquedaSubfamily" name="busquedaSubfamily" placeholder="Subfamilia" maxlength="2" size="2" value="<?php echo $_POST['busquedaSubfamily'];?>"/>
<input type="text" id="busquedaCodigo" name="busquedaCodigo" placeholder="C�digo" value="<?php echo $_POST['busquedaCodigo'];?>"/>
<input type="text" id="busquedaDescripcion" name="busquedaDescripcion" placeholder="Descripci�n" size="70" value="<?php echo $_POST['busquedaDescripcion'];?>"/>
<Button type="submit" class="btn btn-info btn-lg" id="myBtnBuscar" style="float:right; width:123px; height:35px;" />Buscar</button>
</form>

<!--  class="hoverTable" id="resultTableProductos" data-responsive="table" style="text-align: left;"-->
<table class="display" cellspacing="0" width="100%" id="resultTableProductos">
	<thead>
		<tr>
			<th> Sucursal </th>
			<th> Gr/Fa/Sf </th>
			<th> C&oacute;digo </th>
			<th> Nombre </th>
			<th> P. Venta </th>
			<th> P. Especial </th>
			<?php if($sesionEmpresaID==1 || $sesionEmpresaID==3){?>
			<th> Stock Temuco</th>
			<th> Stock CCP</th>
			<th> Stock Penco</th>
			<th> Stock Los Angeles</th>
			<?php }else{?>
			<th> Stock</th>
			<?php }?>
			<th> Origen</th>
			<th> C. Promedio </th>
			<th> &Uacute;lt. Costo </th>
			<th> Margen Venta </th>		
			<th> Margen venta especial </th>
			<th> Acci&oacute;n </th>
		</tr>
	</thead>
	<tfoot>
            <tr>
            	<th> Sucursal</th>
                <th> Gr/Fa/Sf </th>
				<th> C&oacute;digo </th>
				<th> Nombre </th>
				<th> P. Venta </th>
				<th> P. Especial </th>
				<?php if($sesionEmpresaID==1 || $sesionEmpresaID==3){?>
				<th> Stock Temuco</th>
				<th> Stock CCP</th>
				<th> Stock Penco</th>
				<th> Stock Los Angeles</th>
				<?php }else{?>
				<th> Stock</th>
				<?php }?>
				<th> Origen</th>
				<th> C. Promedio </th>
				<th> &Uacute;lt. Costo </th>
				<th> Margen Venta </th>
				<th> Margen venta especial </th>
				<th> Acci&oacute;n </th>
            </tr>
    </tfoot>
	<tbody>
		
			<?php
			
			
			function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$0', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				
				
		
		if($_POST['buscar']!=''){
				include('../connect.php');
				$grupo = $_POST['busquedaGrupo'];
				$familia = $_POST['busquedaFamily'];
				$subfamilia = $_POST['busquedaSubfamily'];
				$codigo = $_POST['busquedaCodigo'];
				$descripcion = $_POST['busquedaDescripcion'];
				
				
				$sql = "SELECT * FROM products p
										LEFT JOIN `group` g  
										ON p.group_id = g.group_id
										LEFT JOIN family f
										ON p.family_id = f.family_id
										LEFT JOIN subfamily sf
										ON p.subfamily_id = sf.subfamily_id
										LEFT JOIN sucursal su
										ON su.sucursal_id = p.sucursal_id
										WHERE p.empresa_id = $sesionEmpresaID
										  AND p.delete='0'";
				
				if($grupo!=''){
					$sql .=" AND g.group_label like '%".$grupo."%'";
				}
				if($familia!=''){
					$sql .=" AND f.family_label like '%".$familia."%'";
				}
				if($subfamilia!=''){
					$sql .=" AND sf.subfamily_label like '%".$subfamilia."%'";
				}
				if($codigo!=''){
					$sql .=" AND p.code like '%".$codigo."%'";
				}
				if($descripcion!=''){
					$sql .=" AND p.name like '%".$descripcion."%'";
				}
				
				$sql .= " ORDER BY product_id DESC";
				$result = mysql_query($sql);
				
				//echo $sql;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					$total=$row['total'];
					$availableqty=$row['qty'];
					
						echo '<tr class="record">';
					
			?>
		
			<td><?php echo $row['sucursal_nombre']; ?></td>
			<td><?php echo $row['group_label'].'  /  '.$row['family_label'].'  /  '.$row['subfamily_label']; ?></td>
			<td><?php echo $row['code']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo '$ '.round($row['pricesale']*1.19);?></td>
			<td><?php echo '$ '.round($row['pricespecial']*1.19); ?></td>
			
			<?php
			if($sesionEmpresaID==1 || $sesionEmpresaID==3){
				include('../connect.php');
				$resultStockTco = mysql_query("SELECT sum(stock) as stock FROM (SELECT 
						p.stock+
            		/*case when (select sum(pi.qty) from purchases_item pi where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0')>0 then
            		(select sum(pi.qty) from purchases_item pi where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0') else 0 end
            		-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		*/
						-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 1 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end				
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 1 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock 
						FROM products p
						WHERE p.empresa_id = 1 AND p.sucursal_id = 1 AND p.`delete`='0' AND p.code='".$row['code']."'
						) AS stock");
						
						
					echo "<td>";
					while($rowStockTco = mysql_fetch_array($resultStockTco, MYSQL_ASSOC)){
						echo $rowStockTco['stock'];
					}
					echo "</td>";
					
					
					
				$resultStockCCP = mysql_query("SELECT sum(stock) as stock FROM (SELECT
							p.stock+
            			-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 2 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 2 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock 
							FROM products p
							WHERE p.empresa_id = 1 AND p.sucursal_id = 2 AND p.`delete`='0' AND p.code='".$row['code']."') AS stock");
					echo "<td>";
					while($rowStockCCP = mysql_fetch_array($resultStockCCP, MYSQL_ASSOC)){
						echo $rowStockCCP['stock'];
					}
					echo "</td>";
					
				$resultStockPenco = mysql_query("SELECT sum(stock) as stock FROM (SELECT
							p.stock+
            			-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 3 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 3 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock 
							FROM products p
							WHERE p.empresa_id = 1 AND p.sucursal_id = 3 AND p.`delete`='0' AND p.code='".$row['code']."') AS stock");

					
							echo "<td>";
					while($rowStockPenco = mysql_fetch_array($resultStockPenco, MYSQL_ASSOC)){
						echo $rowStockPenco['stock'];
					}
					echo "</td>";
					$resultStockLAngeles = mysql_query("SELECT sum(stock) as stock FROM (SELECT
					p.stock+
            			-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = 4 AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4  AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = 4 AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock 
							FROM products p
							WHERE p.empresa_id = 3 AND p.sucursal_id = 4 AND p.`delete`='0' AND p.code='".$row['code']."') AS stock");
							
	
					echo "<td>";
					while($rowStockLAngeles = mysql_fetch_array($resultStockLAngeles, MYSQL_ASSOC)){
						echo $rowStockLAngeles['stock'];
					}
					echo "</td>";
			}else{
				include('../connect.php');
				$resultResto = mysql_query("SELECT sum(stock) as stock FROM (SELECT
					p.stock+
            			-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock  
					FROM products p
					WHERE p.empresa_id = $sesionEmpresaID AND p.sucursal_id = $sesionSucursalID AND p.`delete`='0' AND p.code='".$row['code']."') AS stock");

				echo "<td>";
				while($rowStockResto = mysql_fetch_array($resultResto, MYSQL_ASSOC)){
					echo $rowStockResto['stock'];
				}
				echo "</td>";
				
			}
			?>
			
			<td><?php echo $row['originproduct']; ?>	</td>
			<td><?php echo $row['avgcost']; ?></td>
			<td><?php echo $row['lastcost']; ?></td>
			<td><?php echo round($row['marginsale']).' %'; ?></td>	
			<td><?php echo round($row['marginspecial']).' %'; ?></td>
			
           <td><Button data-id="<?php echo $row['product_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
			<a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton" title="Click para borrar el producto"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a></td>
			</tr>
			<?php
				}//fin while productos
			}//fin buscar
			?>
		
		
		
	</tbody>
</table>
<div class="clearfix"></div>
       
       <!-- MODAL Agregar producto-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       <link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
       <!-- Modal content-->
   			<?php include('addproduct.php');?>
            
		</div>
       </div>
       
	</body>
</html>