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
						
		 </script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
       
       		<h2>LISTA DE INGRESO BODEGA</h2>
          
			<br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="15%"> Tipo Documento </th>
                    <th width="15%"> N&uacute;mero Documento</th>
                    <th width="15%"> Fecha </th>
                    <th width="15%"> Proveedor </th>
                    <th width="15%"> Tipo Producto </th>
                    <th width="15%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT p.*, s.suplier_name, td.descripcion FROM purchases p left join supliers s on p.suplier_id = s.suplier_id LEFT JOIN tipo_documento td ON td.tipo_documento_id = p.tipo_documento_id WHERE p.empresa_id = $sesionEmpresaID AND p.`delete`='0' ORDER BY p.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['suplier_name']; ?></td>
                    <td><?php echo $row['tipo_productos']; ?></td>
                    <td>
                    <a href="ingresomercaderia.php?iv=<?php echo $row['transaction_id']; ?>&sp=<?php echo $row['suplier_id']; ?>">
                    <Button class="btn btn-primary btn-mini" />Ingreso</button></a>
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

    </div>
	</body>
</html>