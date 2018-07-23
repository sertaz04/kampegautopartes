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
							
							$("#address").val(response.records[0].address);
							$("#ciudad").val(response.records[0].ciudad);
							$("#comuna").val(response.records[0].address);
							$("#prod_name").val(response.records[0].prod_name);
							$("#contact").val(response.records[0].contact);
							$("#phone").val(response.records[0].phone);
							
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
					
					
					
				});
			});

			
		 </script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>

       <div class="container" style="width: 100%">
          
          <?
            	include('../connect.php');
				$result = mysql_query("SELECT * FROM tipo_documento WHERE tipo_documento_id = $tipo");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					echo '<h2>LISTA DE '.$row['descripcion'].'</h2>';
				}
			?>
          
			<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar..." autocomplete="off" />
            
            <Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Venta</button>
            
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                	<?php if($tipo==24 || $tipo==29){?>
                    <th width="10%">DTE</th>
                    <?php }?>
					<th width="10%">PDF</th>
                    <th width="10%"> Estado </th>
                    <th width="10%"> N&uacute;mero </th>
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
                        $result = mysql_query("SELECT v.*, c.customer_name, c.rut, es.estado, td.descripcion, cs.folio_DTE, tt.tipo_traslado_descripcion  FROM sales v 
				                        		left join customer c on c.customer_id = v.customer_id
				                        		left join claveSII cs on cs.id_invoice = v.transaction_id
												left join estadoSII es on es.id = cs.estado
                        						left join tipo_documento td on v.tipo_documento_id=td.tipo_documento_id
                        						left join tipo_traslado tt on tt.tipo_traslado_id = v.tipo_traslado_id
                        					   WHERE v.empresa_id = $sesionEmpresaID AND v.tipo_documento_id=$tipo 
                        						 AND v.`delete`='0' ORDER BY v.transaction_id DESC");
                        	
                    	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <?php if($tipo==24 || $tipo==29){?>
                    <td nowrap><?php echo $row['descripcion']; ?></td>
                    <?php }
					$ip="200.73.116.79";
					$idEmp=$sesionEmpresaID;
					$idRef = $row['folio_DTE'];
					if ($tipo=="26"){
					$tipoDTE="33";
		
					}elseif ($tipo=="24"){
					$tipoDTE="61";

					}elseif ($tipo=="14"){
					$tipoDTE="52";
					}
					
				   $rutaPDFCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".CEDIBLE.pdf";
				   $rutaPDFNCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".NCEDIBLE.pdf";
 ?>
				<td nowrap>
					<?php  if ($row['folio_DTE']) {
							echo"<a href='".$rutaPDFCedible."' target='_blank'><img src='../img/pdf-icon.png' width='30' height='30'></a> ";
					   }
					   if ($row['folio_DTE']) {
							echo"<a href='".$rutaPDFNCedible."' target='_blank'><img src='../img/pdf-icon.png' width='30' height='30'></a>";
					   }
					?>
					</td>
                    <td nowrap><?php if($row['estado']==""){ echo "Sin Estado";}else{ echo $row['estado'];} ?></td>
                    <td nowrap><?php if($tipo==12 || $tipo==13){echo $row['invoice_number'];}else{ echo $row['folio_DTE']; }?></td>
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
					<?}else{?>
				      <a href="ventasportal.php?tipo=<?php echo $tipo;?>&iv=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['customer_id']; ?>">
						<Button class="btn btn-primary btn-mini" />Detalle</button>
				      </a>
					<?}?>
                    <Button data-id="<?php echo $row['transaction_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                    <a href="#" id="<?php echo $row['transaction_id']; ?>" class="delbutton" title="Click para borrar"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a>
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
      </div>
         
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
	</body>
</html>