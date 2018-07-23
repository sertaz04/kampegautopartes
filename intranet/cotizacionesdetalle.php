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
        
		<form action="savecotizaciondetalle.php" method="post" onSubmit="return validateForm()" name="myForm">
            <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="<?php echo $_GET['id']; ?>" />
            
            <select name="product_id" id="product_id" style="width:650px; "class="chzn-select" required>
            <option></option>
                <?php
                include('../connect.php');
                $result = mysql_query("SELECT * FROM products WHERE empresa_id = $sesionEmpresaID");
                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                {
                ?>
                    <option value="<?php echo $row['product_id'];?>"><?php echo $row['code']; ?> - <?php echo $row['codebar']; ?> - <?php echo $row['name']; ?> | Precio : <?php echo $row['pricesale']; ?></option>
                <?php
                            }
                        ?>
            </select>
            
            <input type="text" name="cotizacion_detalle_cantidad" id="cotizacion_detalle_cantidad" value="" placeholder="Cantidad" autocomplete="off" style="width: 78px; height:30px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
            <Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-save icon-large"></i> Guardar</button>
            
            <a rel="facebox" href="addproduct.php?iv=<? echo $id?>&sp=<? echo $suplier?>"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Agregar Productos</button></a>
            
            </form>
            <div class="content" id="content">
            <div>
            <?php
            include('../connect.php');
			 $idCoti = $_GET['id'];
            
            $resultaz = mysql_query("SELECT p.*, c.customer_name, c.rut FROM cotizaciones  p left join customer c on c.customer_id = p.customer_id WHERE p.cotizaciones_id= '$idCoti' AND p.empresa_id = $sesionEmpresaID");
            while($rowaz = mysql_fetch_array($resultaz, MYSQL_ASSOC))
            {
            echo 'Transaction ID : TR-'.$rowaz['transaction_id'].'<br>';
            echo 'Rut Cliente : '.$rowaz['rut'].'<br>';
            echo 'Nombre Cliente : '.$rowaz['customer_name'].'<br>';
            echo 'Numero Cotización : '.$rowaz['cotizaciones_id'].'<br>';
            echo 'Fecha Cotización: '.$rowaz['cotizaciones_fecha'].'<br>';
            }
            ?>
            </div>
            
            <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
                <thead>
                    <tr>
                        <th width="35%"> Nombre </th>
                        <th width="10%"> Cantidad </th>
                        <th width="20%"> Costo </th>
                        <th width="20%"> Descuento </th>
                        <th width="10%"> Acci&oacute;n </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php
                            $id=$_GET['id'];
                            
                            $result = mysql_query("SELECT * FROM cotizaciones_detalle WHERE cotizaciones_id= '$id' AND empresa_id = $sesionEmpresaID");
                            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                            {
                        ?>
                        <tr class="record">
                        <td><?php
                        $rrrrrrr=$row['product_id'];
                        
                        $resultss = mysql_query("SELECT * FROM products WHERE product_id= '$rrrrrrr' AND empresa_id = $sesionEmpresaID");
                        while($rowss = mysql_fetch_array($resultss, MYSQL_ASSOC))
                        {
                        echo $rowss['product_name'];
                        }
                        ?></td>
                        <td><?php echo $row['cotizacion_detalle_cantidad']; ?></td>
                        <td>
                        <?php
                        $dfdf=$row['cotizacion_detalle_precio'];
                        echo formatMoney($dfdf, true);
                        ?>
                        </td>
                        <td><center><a href="deletep.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['iv']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['name'];?>"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a></td>
                        </center>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
                            <td colspan="2"><strong style="font-size: 12px; color: #222222;">
                            <?php
                            function formatMoney($number, $fractional=false) {
                                if ($fractional) {
                                    $number = sprintf('%.2f', $number);
                                }
                                while (true) {
                                    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                                    if ($replaced != $number) {
                                        $number = $replaced;
                                    } else {
                                        break;
                                    }
                                }
                                return $number;
                            }
                            $sdsd=$_GET['iv'];
                            
                            $resultas = mysql_query("SELECT sum(cost) FROM purchases_item WHERE invoice= '$sdsd' AND empresa_id = $sesionEmpresaID");
                            while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
                            {
                            $fgfg=$rowas['sum(cost)'];
                            echo formatMoney($fgfg, true);
                            }
                            ?>
                            </strong></td>
                        </tr>
                    
                </tbody>
            </table></div><br>
        
          
       </div>
	</body>
</html>