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
			 if(confirm("Está seguro que desea borrar a este cliente? \n Este proceso no es reversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deletecustomer.php",
			   data: info,
			   success: function(){
			   	alert('El cliente se ha borrado correctamente');
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
					$("#rut").val('');
					$("#name").val('');
					$("#address").val('');
					$("#ciudad").val('');
					$("#comuna").val('');
					$("#contact").val('');
					$("#phone").val('');
					$("#prod_name").val('');
					$("#email").val('');
					$("#total").val('');
					$("#note").val('');
					$("#date").val('');
					
					$("#tipo_cliente").val('');
					$("#bloqueado").val('');
					$("#rutlibre").val('');
					$("#permiteDescuento").val('');
					$("#porc_max").val('');
					$("#saldo_max").val('');
					$("#vendedor_cartera").val('');
					
					$("#userForm").attr("action", "savecustomer.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editcustomer.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].customer_id);
							$("#rut").val(response.records[0].rut);
							$("#name").val(response.records[0].customer_name);
							$("#address").val(response.records[0].address);
							$("#ciudad").val(response.records[0].ciudad);
							$("#comuna").val(response.records[0].comuna);
							$("#contact").val(response.records[0].contact);
							$("#phone").val(response.records[0].phone);
							$("#prod_name").val(response.records[0].prod_name);
							$("#email").val(response.records[0].email);
							$("#total").val(response.records[0].membership_number);
							$("#note").val(response.records[0].note);
							$("#date").val(response.records[0].expected_date);
							
							$("#tipo_cliente").val(response.records[0].tipo_cliente);
							if(response.records[0].bloqueado!='' && response.records[0].bloqueado!='false'){
								$("#bloqueado").val('true');
								$("#bloqueado").prop('checked', true);
							}else{
								$("#bloqueado").val('false');
								$("#bloqueado").prop('checked', false);
							};
							if(response.records[0].rutlibre!='' && response.records[0].rutlibre!='false'){
								$("#rutlibre").val('true');
								$("#rutlibre").prop('checked', true);
							}else{
								$("#rutlibre").val('false');
								$("#rutlibre").prop('checked', false);
							};
							if(response.records[0].permiteDescuento!='' && response.records[0].permiteDescuento!='false'){
								$("#permiteDescuento").val('true');
								$("#permiteDescuento").prop('checked', true);
							}else{
								$("#permiteDescuento").val('false');
								$("#permiteDescuento").prop('checked', false);
							};
							$("#porc_max").val(response.records[0].porc_max);
							$("#saldo_max").val(response.records[0].saldo_max);
							$("#vendedor_cartera").val(response.records[0].vendedor_cartera);
							
							$("#userForm").attr("action", "saveeditcustomer.php");
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
			<li class="active">Clientes</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">

<?php 
			include('../connect.php');
			
				$result = mysql_query("SELECT * FROM customer WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY customer_id DESC");
				
				$rowcount = mysql_num_rows($result);
			
			?>
			<div style="text-align:center;">
			N&uacute;mero Total de Clientes: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<br />
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Buscar Cliente..." autocomplete="off" />
<button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" >Agregar Cliente</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="15%"> Rut </th>
			<th width="10%"> Raz&oacute;n Social </th>
			<th width="10%"> Direcci&oacute;n </th>
            <th width="10%"> Tel&eacute;fono </th>
			<th width="15%"> Giro</th>
			<th width="15%"> Ciudad</th>
			<th width="15%"> Comuna</th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$result = mysql_query("SELECT * FROM customer WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY customer_id DESC");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
			?>
			<tr class="record">
			<td><?php echo $row['rut']; ?></td>
			<td><?php echo $row['customer_name']; ?></td>
			<td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['prod_name']; ?></td>
			<td><?php echo $row['ciudad']; ?></td>
			<td><?php echo $row['comuna']; ?></td>
			<td>
            <Button data-id="<?php echo $row['customer_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
            
			<a href="#" id="<?php echo $row['customer_id']; ?>" class="delbutton" title="Click para borrar cliente"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a></td>
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
        
        <?php include('addcustomer.php');?>

		</div>
       </div>
  </div>
  </div>
  </div>     
</body>


</html>