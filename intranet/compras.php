<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>       
         <script>
		
			$(function() {
				$(".delbutton").click(function(){
				var element = $(this);
				var del_id = element.attr("id");
				var info = 'id=' + del_id;
				 if(confirm("Está seguro que desea borrar a esta factura? \n Este proceso no es reversible!"))
				{
				 $.ajax({
				   type: "GET",
				   url: "deletefactura.php",
				   data: info,
				   success: function(){
						alert('La factura se ha borrado correctamente.');
				   },
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
					$("#invoice_number").val('');
					$("#fecha_factura").val('<?php echo date("Y-m-d");?>');
					$("#fecha_vencimiento").val('<?php echo date("Y-m-d");?>');
					$("#fecha_ingreso").val('<?php echo date("Y-m-d");?>');
					$("#suplier_id").val('');
					$("#tipo_productos").val('');
					$("#centro_id").val('');
					$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
					$("#userForm").attr("action", "savepur.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');
					$.ajax({
						url: 'editcompra.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].transaction_id);
							$("#iv").val(response.records[0].invoice_number);
							$("#correlativo").val(response.records[0].correlativo);
							$("#fechaFactura").val(response.records[0].fecha_factura);
							$("#fechaVencimiento").val(response.records[0].fecha_vencimiento);
							$("#fechaIngreso").val(response.records[0].fecha_ingreso);
							
							$("#rutProveedor").val(response.records[0].suplier_id);
							$('#rutProveedor').trigger("chosen:updated");
	                        $("#rutProveedor").trigger("liszt:updated");
							$("#nombreFantasia").val(response.records[0].suplier_id);
							
							$("#tipoProducto").val(response.records[0].tipo_productos);
							$("#codigoCentro").val(response.records[0].centro_id);
							$('#codigoCentro').trigger("chosen:updated");
	                        $("#codigoCentro").trigger("liszt:updated");
							$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
							//$("#nombreCentro").val(response.records[0].centro_id);
							$("#userForm").attr("action", "saveeditfactura.php");
							$("#myModal").modal();
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
				});
			});
			
			$(document).ready(function(){
				$(".verButton").click(function(){
					var id = $(this).attr('data-id');
					$.ajax({
						url: 'verpurchaselist.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						var arr = response.records;
					    var i;
						var sumacosto = 0;
						var out ="";
						 for(i = 0; i < arr.length; i++) {
							out += "<tr><td>" +
							arr[i].name +
							"</td><td>" +
							arr[i].qty +
							"</td><td>" +
							arr[i].cost +
							"</td><td>" +
							"<a href=\"#\" id=\""+arr[i].id+"\" class=\"delbutton\" title=\"Click para borrar\"><button class=\"btn btn-danger btn-mini\"><i class=\"icon-trash\"></i> Borrar </button></a></td>"+
							"</tr><tr>";
								
								
							sumacosto = parseInt(sumacosto) + parseInt(arr[i].cost);
						}
					
							out +=	"<td colspan=\"2\"><strong style=\"font-size: 12px; color: #222222;\">Total:</strong></td>"+
								"<td>"+sumacosto+"</td></tr>";
						$(".records").html(out);
						
						
						$("#myModalVer").modal();
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
				});
			});
			
			$(document).ready(function(){
				$(".masProveedor").click(function(){
										
					$("#memi").val('');
					$("#origen").val('2');
					$("#suplier_rut").val('');
					$("#suplier_name").val('');
					$("#suplier_namefantasia").val('');
					$("#suplier_address").val('');
					$("#suplier_contact").val('');
					$("#contact_person").val('');
					$("#suplier_giro").val('');
					$("#note").val('');
					
					$("form").each(function(){
						$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
					});					
					$("#userForm").attr("action", "savesupplier.php");
					$("#myModalSupplier").modal();
					
				});
			});
			
			$(document).ready(function(){
				$("#rutProveedor").change(function(){
					$("#nombreFantasia").val($("#rutProveedor").val());
				});
			});
			$(document).ready(function(){
				$("#nombreFantasia").change(function(){
					$("#rutProveedor").val($("#nombreFantasia").val());
				});
			});
			
			
			function comprobarCompra(){
				
				if(!$("#memi").val()>0){
					var rutProveedor = $("#rutProveedor").val();					
					var iv = $("#iv").val();
					var tipo_documento = <?php echo $_GET['tipo'];?>;
					$.ajax({
					url: 'comprobarCompra.php?rutProveedor=' + rutProveedor + '&tipo=' + tipo_documento +'&iv=' + iv ,
					method: 'GET'
					}).success(function(response) {
						var existeCompra = response.records[0].existe;
						if(existeCompra>0){
							alert('El numero de Documento ya existe para este proveedor');
							$("#iv").val('');	
						}
					}).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
					});
				}
			}
			
			$(document).ready(function(){
				$("#iv").change(function(){
					comprobarCompra();
				});
			});

$(document).ready(function(){
    $('#resultTable').dataTable();
});			
		 </script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
       
       		<?
            	include('../connect.php');
				$tipo = $_GET['tipo'];
				$result = mysql_query("SELECT * FROM tipo_documento WHERE tipo_documento_id = $tipo");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					echo '<h2>Lista de '.$row['descripcion'].'</h2>';
				}
			?>
       
          
			<!--<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar Compra..." autocomplete="off" />-->
            
            <Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Compras</button>
            
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="15%"> N&uacute;mero </th>
                    <th width="15%"> Fecha </th>
                    <th width="30%"> Proveedor </th>
                    <th width="15%"> Tipo Producto</th>
                    <th width="25%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT p.*, s.suplier_name, s.suplier_rut FROM purchases p left join supliers s on p.suplier_id = s.suplier_id WHERE p.empresa_id = $sesionEmpresaID AND p.tipo_documento_id=$tipo AND p.`delete`='0' ORDER BY p.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['suplier_rut'].' - '.$row['suplier_name']; ?></td>
                    <td><?php 
                    echo $row['tipo_productos']; 
                    ?></td>
                    <td>
                    <a href="purchasesportal.php?tipo=<? echo $_GET['tipo'];?>&iv=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['suplier_id']; ?>">
                    <Button class="btn btn-primary btn-mini" />Detalle</button></a>
                    <Button data-id="<?php echo $row['transaction_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                    <a href="#" id="<?php echo $row['transaction_id']; ?>" class="delbutton" title="Click para borrar"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                
            </tbody>
         </table>
         
         <!-- MODAL Agregar producto-->
       
    <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('purchases.php');?>

		</div>
       </div>
    </div>

    <div class="modal fade" id="myModalSupplier" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addsupplier.php');?>

		</div>
    </div>
    </div>

    <div class="modal fade" id="myModalVer" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('view_purchases_list.php');?>

		</div>
    </div>
    </div>
	</body>
</html>