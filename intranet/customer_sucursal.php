<html>
<head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript">
			$(function() {
			
			
			$(".delbutton").click(function(){
			
			//Save the link in a variable called element
			var element = $(this);
			
			//Find the id of the link that was clicked
			var del_id = element.attr("id");
			
			//Built a url to send
			var info = 'id=' + del_id;
			 if(confirm("Está seguro que desea borrar a esta sucursal de cliente? \n Este proceso no es reversible!"))
					  {
			
			 $.ajax({
				type: "GET",
				url: "deletecustomer_sucursal.php",
				data: info,
				success: function(){
				alert('La sucursal del cliente se ha borrado correctamente');
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
					$("#direccion").val('');
					$("#ciudad").val('');
					$("#comuna").val('');
					$("#contacto").val('');
					$("#telefono").val('');
					$("#email").val('');
					
					$("#userForm").attr("action", "savecustomer_sucursal.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editcustomer_sucursal.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].memi);
							//$("#rut").val(response.records[0].rut);
							
							$("#rutCliente").val(response.records[0].rutCliente);
							$('#rutCliente').trigger("chosen:updated");
							$("#rutCliente").trigger("liszt:updated");
							
							$("#name").val(response.records[0].customer_name);
							$("#direccion").val(response.records[0].customer_sucursal_direccion);
							$("#telefono").val(response.records[0].customer_sucursal_telefono);
							$("#email").val(response.records[0].customer_sucursal_email);
							$("#ciudad").val(response.records[0].customer_sucursal_ciudad);
							$("#comuna").val(response.records[0].customer_sucursal_comuna);
							$("#contacto").val(response.records[0].customer_sucursal_contacto);
							
							$("#userForm").attr("action", "saveeditcustomer_sucursal.php");
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
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
	<div class="contentheader">
			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Sucursales de Clientes</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">

<?php 
			include('../connect.php');
			
				$result = mysql_query("SELECT cs.customer_sucursal_id, c.rut, c.customer_name, cs.customer_sucursal_direccion, cs.customer_sucursal_telefono, cs.customer_sucursal_email, cs.customer_sucursal_ciudad, cs.customer_sucursal_comuna FROM customer_sucursal cs INNER JOIN customer c ON c.customer_id = cs.customer_id WHERE c.empresa_id = $sesionEmpresaID AND cs.`delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			
			?>
			<div style="text-align:center;">
			N&uacute;mero Total de sucursales de Clientes: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<br />
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Buscar Sucursal..." autocomplete="off" />
<button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" >Agregar Sucursal</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="15%"> Rut </th>
			<th width="10%"> Raz&oacute;n Social </th>
			<th width="10%"> Direcci&oacute;n </th>
            <th width="10%"> Tel&eacute;fono </th>
			<th width="15%"> Email</th>
			<th width="15%"> Ciudad</th>
			<th width="15%"> Comuna</th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$result1 = mysql_query("SELECT cs.customer_sucursal_id, c.rut, c.customer_name, cs.customer_sucursal_direccion, cs.customer_sucursal_telefono, cs.customer_sucursal_email, cs.customer_sucursal_ciudad, cs.customer_sucursal_comuna FROM customer_sucursal cs INNER JOIN customer c ON c.customer_id = cs.customer_id WHERE c.empresa_id = $sesionEmpresaID AND cs.`delete`='0' ORDER BY 1 DESC");
				
				while($row = mysql_fetch_array($result1, MYSQL_ASSOC))
				{ 
			?>
			<tr class="record">
			<td><?php echo $row['rut']; ?></td>
			<td><?php echo $row['customer_name']; ?></td>
			<td><?php echo $row['customer_sucursal_direccion']; ?></td>
            <td><?php echo $row['customer_sucursal_telefono']; ?></td>
			<td><?php echo $row['customer_sucursal_email']; ?></td>
			<td><?php echo $row['customer_sucursal_ciudad']; ?></td>
			<td><?php echo $row['customer_sucursal_comuna']; ?></td>
			<td>
            <Button data-id="<?php echo $row['customer_sucursal_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
            
			<a href="#" id="<?php echo $row['customer_sucursal_id']; ?>" class="delbutton" title="Click para borrar cliente"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<div class="clearfix"></div>

 <!-- MODAL Agregar producto-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addcustomer_sucursal.php');?>

		</div>
       </div>
  </div>
  </div>
  </div>     
</body>


</html>