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
				 if(confirm("Está seguro que desea borrar a esta Nota Crédito? \n Este proceso no es reversible!"))
				{
				 $.ajax({
				   type: "GET",
				   url: "deletenotacredito.php",
				   data: info,
				   success: function(){
						alert('La Nota Crédito se ha borrado correctamente.');
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
					$("#cotizacion_fecha").val('');
					$("#userForm").attr("action", "savenotacredito.php");
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
							$("#userForm").attr("action", "saveeditnotacredito.php");
							$("#myModal").modal();
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
          <h2>Lista de Notas de Crédito</h2>
			<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar Cliente..." autocomplete="off" />
            
            <Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Nota de Crédito</button>
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="15%"> Número Nota de Cr&eacute;dito </th>
                    <th width="15%"> Fecha Nota de Cr&eacute;dito</th>
                    <th width="15%"> Cliente </th>
                    <th width="15%"> Tipo Producto</th>
                    <th width="15%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT p.*, s.suplier_name FROM purchases p left join supliers s on p.suplier_id = s.suplier_id WHERE p.empresa_id = $sesionEmpresaID ORDER BY p.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['suplier_name']; ?></td>
                    <td><?php 
                    echo $row['tipo_productos']; 
                    ?></td>
                    <td><a rel="facebox" href="view_purchases_list.php?iv=<?php echo $row['transaction_id']; ?>"> <button class="btn btn-primary btn-mini"><i class="icon-search"></i> Ver </button></a> 
                    <Button data-id="<?php echo $row['family_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                    <a href="#" id="<?php echo $row['transaction_id']; ?>" class="delbutton" title="Click To Delete"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a></td>
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
        </div>
	</body>
</html>