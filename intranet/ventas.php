<?php  $tipo = $_GET['tipo']; 
	include('../connect.php');
?>
<?php //genera DTE Borrador

function url_exists( $url = NULL ) {

    if( empty( $url ) ){
        return false;
    }
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
             )
        )
    );
    $headers = @get_headers( $url );
    sscanf( $headers[0], 'HTTP/%*d.%*d %d', $httpcode );

    //Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
    $accepted_response = array( 200, 301, 302 );
    if( in_array( $httpcode, $accepted_response ) ) {
        return true;
    } else {
        return false;
    }
}
?>
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
				 if(confirm("Está seguro que desea borrar a esta venta? \n Este proceso no es reversible!"))
				{
				 $.ajax({
				   type: "GET",
				   url: "deleteventa.php",
				   data: info,
				   success: function(){
						alert('La venta se ha borrado correctamente.');
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
					<?php if($tipo!=24 && $tipo!=29){?>
					$("#memi").val('');
					$("#invoice").val('');
					$("#fecha_factura").val('<?php echo date("Y-m-d");?>');
					$("#fecha_vencimiento").val('<?php echo date("Y-m-d");?>');
					$("#fecha_ingreso").val('<?php echo date("Y-m-d");?>');
					<? if($tipo==13){?>
						<? if($sesionEmpresaID==1){?>
						$("#rutCliente").val('5336');
						<?}else if ($sesionEmpresaID==2){?>
						$("#rutCliente").val('5365');
						<?}?>
						$('#rutCliente').trigger("chosen:updated");
						$("#rutCliente").trigger("liszt:updated");
						$("#rutCliente").change();
					<? }else{ ?>
						$("#customer_id").val('');
					<? } ?>
					$("#tipo_productos").val('');
					$("#centro_id").val('');
					$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
					$("#tipo_documento_customer").val('<?php echo $_GET['tipo'];?>');
					
					$("#userForm").attr("action", "saveventa.php");
					$("#myModal").modal();
					//$("#userForm").submit();
					<?php }else{ ?>
					window.location.assign("ventasportal.php?tipo=<? echo $tipo;?>");
					<?php } ?>
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');
					$.ajax({
						url: 'editventa.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].transaction_id);
							$("#iv").val(response.records[0].invoice_number);
							$("#correlativo").val(response.records[0].correlativo);
							$("#fechaFactura").val(response.records[0].fecha_factura);
							$("#fechaVencimiento").val(response.records[0].fecha_vencimiento);
							$("#fechaIngreso").val(response.records[0].fecha_ingreso);
							
							$("#rutCliente").val(response.records[0].customer_id);
							$('#rutCliente').trigger("chosen:updated");
							$("#rutCliente").trigger("liszt:updated");
							$("#nombreFantasia").val(response.records[0].customer_id);
							
							//revisar si tengo que cargar las sucursales y seleccionar la correcta
							$cliente_id = $("#rutCliente").val();
							//hace la búsqueda					   
							$.ajax({
								type: "GET",
								url: "buscarcustomer_sucursal.php",
								data: {id:$cliente_id},
								beforeSend: function(){
									  //imagen de carga
									  $("#resultadoSucursal").html("<p align='center'><img src='../img/loader.gif' /></p>");
								},
								error: function(jqXHR,error, errorThrown){
									  alert("Error en búsqueda");
									  alert(JSON.stringify(jqXHR));
									  //alert(error);
									  //alert(errorThrown);
								},
								success: function(data){  
									  $("#resultadoSucursal").empty();
									  $("#sucursalCliente").empty();
									  $("#sucursalCliente").append(data);
									  $('#sucursalCliente').trigger("chosen:updated");
									  $("#sucursalCliente").trigger("liszt:updated"); 

										//seleccioncamos el valor
									  $("#sucursalCliente").val(response.records[0].customer_sucursal_id);
									  $('#sucursalCliente').trigger("chosen:updated");
									  $("#sucursalCliente").trigger("liszt:updated");									  
								}
							});
							
							//$("#nombreFantasia").val(response.records[0].customer_id);
							
							/*
							$("#address").val(response.records[0].address);
							$("#ciudad").val(response.records[0].ciudad);
							$("#comuna").val(response.records[0].address);
							$("#prod_name").val(response.records[0].prod_name);
							$("#contact").val(response.records[0].contact);
							$("#phone").val(response.records[0].phone);
							*/
							
							$("#tipoProducto").val(response.records[0].tipo_productos);
							$("#codigoCentro").val(response.records[0].centro_id);
							$('#codigoCentro').trigger("chosen:updated");
							$("#codigoCentro").trigger("liszt:updated");
							$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
							//$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
							//$("#nombreCentro").val(response.records[0].centro_id);
							
							<?php if($tipo==14){?>
								$("#chofer_rut").val(response.records[0].chofer_rut);
								$("#chofer").val(response.records[0].chofer);
								$("#transportista_rut").val(response.records[0].transportista_rut);
								$("#transportista").val(response.records[0].transportista);
								$("#dir_origen").val(response.records[0].dir_origen);
								$("#dir_destino").val(response.records[0].dir_destino);
								$("#ciudad_origen").val(response.records[0].ciudad_origen);
								$("#ciudad_destino").val(response.records[0].ciudad_destino);
								$("#patente_camion").val(response.records[0].patente_camion);
								$("#patente_carro").val(response.records[0].patente_carro);
								$("#tipo_traslado").val(response.records[0].tipo_traslado);
								$('#tipo_traslado').trigger("chosen:updated");
								$("#tipo_traslado").trigger("liszt:updated");
							<?php }?>
							$("#userForm").attr("action", "saveeditventa.php");
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
						url: 'verventalist.php?id=' + id,
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
				$(".masCliente").click(function(){
					$("#memi").val('');
					$("#origen").val('2');
					$("#rut").val('');
					$("#namefantasia").val('');
					$("#name").val('');
					$("#address").val('');
					$("#contact").val('');
					$("#prod_name").val('');
					$("#note").val('');
					$("#date").val('');
					$("#tipo_documento").val('<?php echo $_GET['tipo'];?>');
					$("#myModalCustomer").modal();
					
				});
			});
			
			
			
			$(document).ready(function(){
				$("#rutCliente").change(function(){
					//$("#nombreFantasia").val($("#rutCliente").val());
					/*
				    var id = $("#rutCliente").val();
				    $.ajax({
					url: 'editcustomer.php?id=' + id,
					method: 'GET'
				    }).success(function(response) {
					
					$("#address").val(response.records[0].address);
					$("#ciudad").val(response.records[0].ciudad);
					$("#comuna").val(response.records[0].comuna);
					$("#prod_name").val(response.records[0].prod_name);
					$("#contact").val(response.records[0].contact);
					$("#phone").val(response.records[0].phone);
					
				    }).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
				    });
					*/
					
					//sucursal
													 
					$cliente_id = $("#rutCliente").val();

					//hace la búsqueda
																			   
					$.ajax({
						type: "GET",
						url: "buscarcustomer_sucursal.php",
						data: {id:$cliente_id},
						beforeSend: function(){
							  //imagen de carga
							  $("#resultadoSucursal").html("<p align='center'><img src='../img/loader.gif' /></p>");
						},
						error: function(jqXHR,error, errorThrown){
							  alert("Error en búsqueda");
							  alert(JSON.stringify(jqXHR));
							  //alert(error);
							  //alert(errorThrown);
						},
						success: function(data){  
							  $("#resultadoSucursal").empty();
							  $("#sucursalCliente").empty();
							  $("#sucursalCliente").append(data);
							  $('#sucursalCliente').trigger("chosen:updated");
							  $("#sucursalCliente").trigger("liszt:updated");                    
						}
					});
						
			//----		
					
					
				});
			});

			
			
$(document).ready(function(){
   // $('#resultTable').dataTable();
		table = $('#resultTable').DataTable({
	dom:'Bfrtip',

	lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 Filas', '25 Filas', '50 Filas', 'Ver Todo' ]
        ],
		buttons:[
	'pageLength','copyHtml5','excelHtml5','csvHtml5', { extend: 'pdfHtml5',orientation: 'landscape',pageSize: 'LEGAL'}
	],
	language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
			 select: {
            rows: "%d Filas seleccionadas"
			},
			 buttons: {
            pageLength: {
                _: "Mostrar %d Filas",
                '-1': "Todas las Filas"
            }
        }
        }
	});
});
			
		 </script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
	
		<?php include('navfixed.php');
		$contPendientes=0; ?>

       <div class="container" style="width: 100%">
          	<form id="resumenVentas" action="ventas.php?tipo=<?php echo $tipo; ?>" method="post">
          <?
            	include('../connect.php');
					$fin= date('t'); 
						$mes= date('m')."-".date('Y'); 
					$desde= " desde 01-".$mes. " hasta ".$fin."-".$mes; 
				$result = mysql_query("SELECT * FROM tipo_documento WHERE tipo_documento_id = $tipo");
				if (isset($_POST['fechaI']) && $_POST['fechaI']!='dd-mm-aaaa'  && $_POST['fechaI']!=null){
					$fechaInicio=$_POST['fechaI'];
					$fechaFin=$_POST['fechaF'];
				}else{

					$fechaInicio=date('Y')."-".date('m')."-01";
					$fechaFin=date('Y')."-".date('m')."-".$fin;
				}
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					echo '<h4>Lista de '.$row['descripcion'].' ';
					?>
					
					<tr>
				desde
					<td>			
			    		<input  type="date" style="width:225px; height:35px;" name="fechaI" id="fechaI" placeholder="MM/DD/YYYY" value='<?php echo  $fechaInicio;?>' />
			    		 hasta 
			    		<input type="date" style="width:225px; height:35px;" name="fechaF" id="fechaF" placeholder="MM/DD/YYYY" value='<?php echo $fechaFin;?>' />
									<!--	<input type="text" name="filter" style="width:20%; height:35px;" value="" id="filter" placeholder="Buscar Folio..." autocomplete="off" /> -->
					<Button class="btn btn-success btn-large" type="submit" id="buscarBtn"/>Buscar Ventas</button> 
					<Button class="btn btn-success btn-large" type="submit" id="mesactualBtn"/>Mes actual</button> 
					<button class="btn btn-success btn-large" type=""> Reporte Ventas</button>
					</td>

					 <Button type="button" class="btn btn-success btn-large" id="myBtn" style="float:right; width:180px; height:35px;" />Agregar Venta</button>
				</tr>        </h4>   	</form>      
	<?php

				}
			?>
          
          <table class="table table-hover table-bordered" id="resultTable" data-responsive="table" style="text-align: left;" >
            <thead>
                <tr>
                	<?php if($tipo==24 || $tipo==29){?>
                    <th width="10%">DTE</th>
                    <?php }?>
					<th width="10%">PDF/XML</th>
                    <th width="10%"> Estado </th>
                    <th width="10%"> N&uacute;mero </th>
		    <?php if($tipo==24 || $tipo==29){?>
                    <th width="10%">F. Ref</th>
		    <th width="10%">Motivo</th>
                    <?php }?>
                    <th width="10%"> Fecha </th>
                    <th width="10%"> Cliente </th>
                    <?php if($tipo==14){?>
                    	<th width="5%"> Tipo Traslado</th>
                    <?php }?>
                    <th width="20%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    
                    	include('../connect.php');

                        $result = mysql_query("SELECT * FROM (SELECT v.*, c.customer_name, c.rut, es.estado, td.descripcion, cs.folio_DTE, cs2.folio_DTE as fref , v2.invoice_number as fref2 , tt.tipo_traslado_descripcion  FROM sales v 
				                        		left join customer c on c.customer_id = v.customer_id
				                        		left join claveSII cs on cs.id_invoice = v.transaction_id
												left join estadoSII es on es.id = cs.estado
                        						left join tipo_documento td on v.tipo_documento_id=td.tipo_documento_id
                        						left join tipo_traslado tt on tt.tipo_traslado_id = v.tipo_traslado_id
									left join claveSII cs2 on cs2.id_invoice = v.invoice_reference
									left join sales v2 on v2.transaction_id = v.invoice_reference
                        					   WHERE v.empresa_id = $sesionEmpresaID AND v.tipo_documento_id=$tipo 
									 and v.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin' AND v.`delete`='0' 
									 union all
									 SELECT v.*, c.customer_name, c.rut, es.estado, td.descripcion, cs.folio_DTE, cs2.folio_DTE as fref , v2.invoice_number as fref2 , tt.tipo_traslado_descripcion  FROM sales_history v 
				                        		left join customer c on c.customer_id = v.customer_id
				                        		left join claveSII cs on cs.id_invoice = v.transaction_id
												left join estadoSII es on es.id = cs.estado
                        						left join tipo_documento td on v.tipo_documento_id=td.tipo_documento_id
                        						left join tipo_traslado tt on tt.tipo_traslado_id = v.tipo_traslado_id
									left join claveSII cs2 on cs2.id_invoice = v.invoice_reference
									left join sales_history v2 on v2.transaction_id = v.invoice_reference
                        					   WHERE v.empresa_id = $sesionEmpresaID AND v.tipo_documento_id=$tipo 
									 and v.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin'
                        						 AND v.`delete`='0') AS VENTAS ORDER BY transaction_id DESC ");
//ORDER BY v.transaction_id DESC"
                    	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <?php if($tipo==24 || $tipo==29){?>
                    <td nowrap><?php echo $row['descripcion']; ?></td>
                    <?php }
					$ip="190.14.56.35";
					$idEmp=$sesionEmpresaID;
					$idRef = $row['folio_DTE'];
					if ($tipo=="26"){
					$tipoDTE="33";
		
					}elseif ($tipo=="24"){
					$tipoDTE="61";
					}elseif ($tipo=="29"){
					$tipoDTE="56";
					
					}elseif ($tipo=="14"){
					$tipoDTE="52";
					}
					
				   $rutaPDFCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".CEDIBLE.pdf";
				   $rutaPDFNCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".NCEDIBLE.pdf";
				   $rutaPDF="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".pdf";
				   $rutaXML="http://".$ip.":8081/xml/".$tipoDTE."_".$idRef."_".$idEmp.".EnvioDTESigned.Customer.xml";
 ?>
				<td nowrap>
					<?php  if ($row['folio_DTE']) {
						   echo"<a href='".$rutaPDF."' target='_blank'><img src='../img/pdf-icon.png' width='30' height='30'></a> ";
							echo"<a href='".$rutaPDFCedible."' target='_blank'><img src='../img/pdf-icon.png' width='30' height='30'></a> ";
					   }
					   if ($row['folio_DTE']) {
							echo"<a href='".$rutaPDFNCedible."' target='_blank'><img src='../img/pdf-icon.png' width='30' height='30'></a>";
							echo "<a href='".$rutaXML."' target='_blank' ><img src='../img/xml.png' width='30' height='30' alt='XML DTE'></a>";
					   }
					?>
					</td>
                    <td nowrap><?php if($row['estado']==""){ echo "Sin Estado";}else{ echo $row['estado'];} ?></td>
                    <td nowrap><?php if($tipo==12 || $tipo==13){echo $row['invoice_number'];}else{ echo $row['folio_DTE']; }?></td>
		    <?php if($tipo==24 || $tipo==29){?>
                    	<td nowrap><?php echo $row['fref'].$row['fref2']; ?></td>
			<td nowrap><?php if($row['causa_emision_id']==1){echo 'A';}elseif($row['causa_emision_id']==2){echo 'D';}elseif($row['causa_emision_id']==3){echo 'M';} ?></td>
                    <?php }?>
                    <td nowrap><?php echo $row['fecha_factura']; ?></td>
                    <td nowrap><?php echo $row['rut'].' - '.$row['customer_name']; ?></td>
                    <?php if($tipo==14){?>
                    	<td nowrap><?php echo $row['tipo_traslado_descripcion']; ?></td>
                    <?php }?>
                    <td nowrap >
					<?php if($tipo==24 || $tipo==29){?>
                    	<a href="ventasportal.php?tipo=<?php echo $tipo;?>&ivReferencia=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['customer_id']; ?>&edita=datos">
							<Button class="btn btn-primary btn-mini" />Detalle</button>
	    			  </a>
					<?php }else{?>
				      <a href="ventasportal.php?tipo=<?php echo $tipo;?>&iv=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['customer_id']; ?>&edita=datos">
						<Button class="btn btn-primary btn-mini" />Detalle</button>
				      </a>
					<?php }
					
					 if (!$row['folio_DTE']) {
						 $contPendientes++;
					 ?>
					
                    <Button data-id="<?php echo $row['transaction_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                    <a href="#" id="<?php echo $row['transaction_id']; ?>" class="delbutton" title="Click para borrar"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a>
					<?php } ?>
                	<?php if($tipo==14 && ($row['tipo_traslado_id']==1 || $row['tipo_traslado_id']==2)){?>
                		<a href="ventasportal.php?tipo=26&ivReferencia=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['customer_id']; ?>">
							<Button class="btn btn-primary btn-mini" />Facturar Gu&iacute;a</button>
		    			</a>
                	<?php }?>
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
        
        <?php include('sales.php');?>

	  </div>
       </div>

    <div class="modal fade" id="myModalCustomer" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addcustomer.php');?>

		</div>
    </div>
    </div>

    <div class="modal fade" id="myModalVer" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('view_ventas_list.php');?>

		</div>
    </div>
    </div>
<?php

if ($contPendientes>2 && ($tipo==24 || $tipo==29 || $tipo==14 || $tipo==26)){
?>	
<script>
alert ('Existen DTE pendientes de días anteriores. Por favor emitirlos o eliminar');
</script>
<?php
}
?>
	</body>
</html>