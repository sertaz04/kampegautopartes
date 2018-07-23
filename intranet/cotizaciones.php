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
				 if(confirm("Está seguro que desea borrar a esta cotización? \n Este proceso no es reversible!"))
				{
				 $.ajax({
				   type: "GET",
				   url: "deletecotizacion.php",
				   data: info,
				   success: function(){
						alert('La cotizacion se ha borrado correctamente.');
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
					$("#cotizacion_name").val('');
					$("#customer_id").val('');
					$("#cotizacion_fecha").val('<?php echo date("Y-m-d");?>');
					$("#userForm").attr("action", "savecotizacion.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editcotizacion.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].cotizacion_id);
							$("#cotizacion_name").val(response.records[0].cotizacion_name);
							$("#customer_id").val(response.records[0].customer_id);
							$("#cotizacion_fecha").val(response.records[0].cotizacion_fecha);
							$("#userForm").attr("action", "saveeditcotizacion.php");
							$("#myModal").modal();
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
				});
			});
			
			$(document).ready(function(){
				$(".masCliente").click(function(){
										
					$("#memi").val('');
					$("#origen").val('1');
					$("#rut").val('');
					$("#name").val('');
					$("#address").val('');
					$("#contact").val('');
					$("#prod_name").val('');
					$("#total").val('');
					$("#note").val('');
					$("#date").val('');
					
					$("#myModalCustomer").modal();
					
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
          <h2>Lista de cotizaciones</h2>
			<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar Cotización..." autocomplete="off" />
            
            <Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Cotizaci&oacute;n</button>
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Número Cotizaci&oacute;n </th>
                    <th width="25%"> Nombre</th>
                    <th width="15%"> Cliente </th>
                    <th width="15%"> Fecha Cotizaci&oacute;n</th>
                    <th width="20%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT co.*, cu.customer_name FROM cotizaciones co left join customer cu on co.customer_id = cu.customer_id WHERE empresa_id = $sesionEmpresaID ORDER BY co.cotizaciones_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['cotizaciones_id']; ?></td>
                    <td><?php echo $row['cotizaciones_name']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['cotizaciones_fecha'];?></td>
                    <td>
                    <Button data-id="<?php echo $row['cotizaciones_id']; ?>" type="button" class="btn btn-primary btn-mini verButton" data-toggle="modal" />Ver</button>
                    <Button data-id="<?php echo $row['cotizaciones_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                    <a href="#" id="<?php echo $row['cotizaciones_id']; ?>" class="delbutton" title="Click para borrar"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a></td>
                    </tr>
                    <?php
                        }
                    ?>
                <div class="container">
                  <ul class="pagination">
                    <?
						$numeroPagina = 1;
						$contador = 1;
						while($contador <= $numeroPagina){
							echo "<li".(($_GET['pag']==$numeroPagina)?'active':'')." ><a href=\"compras.php?pag=".$numeroPagina."\">".$numeroPagina."</a></li>";
							$contador++;
						}
                    ?>
                    
                    <li class="active"><a href="compras.php?pag=2">2</a></li>
                    <li><a href="compras.php?pag=1">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                  </ul>
                </div>
            </tbody>
         </table>
         <div class="clearfix"></div>

 <!-- MODAL Agregar producto-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addcotizacion.php');?>

		</div>
       </div>
    </div>
    
    <div class="modal fade" id="myModalCustomer" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addcustomer.php');?>

		</div>
       </div>
	</body>
</html>