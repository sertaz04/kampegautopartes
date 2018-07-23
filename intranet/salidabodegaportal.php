<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
         <script>
		
			
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
			
			
		 </script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
          
		         <h2>LISTA DE SALIDA BODEGA</h2>
 <br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="15%"> Tipo Documento </th>
                    <th width="15%"> N&uacute;mero </th>
                    <th width="15%"> Fecha </th>
                    <th width="15%"> Cliente </th>
                    <th width="15%"> Tipo Producto</th>
                    <th width="15%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT v.*, c.customer_name, td.descripcion FROM sales v left join customer c on c.customer_id = v.customer_id LEFT JOIN tipo_documento td ON td.tipo_documento_id = v.tipo_documento_id WHERE v.empresa_id = $sesionEmpresaID AND v.`delete`='0' ORDER BY v.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['tipo_productos']; ?></td>
                    <td>
                    <a href="salidamercaderia.php?iv=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['customer_id']; ?>">
                    <Button class="btn btn-primary btn-mini" />Ingresar</button></a>
                    </td>
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
							echo "<li".(($_GET['pag']==$numeroPagina)?'active':'')." ><a href=\"ventas.php?pag=".$numeroPagina."\">".$numeroPagina."</a></li>";
							$contador++;
						}
                    ?>
                    
                    <li class="active"><a href="ventas.php?pag=2">2</a></li>
                    <li><a href="ventas.php?pag=1">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                  </ul>
                </div>
            </tbody>
         </table>

    </div>
	</body>
</html>