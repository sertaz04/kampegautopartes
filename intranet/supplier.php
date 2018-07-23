<html>
<head>
 <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <?php
			require_once('auth.php');
		 ?>
         <script type="text/javascript">
			$(function() {
				$(".delbutton").click(function(){
			
				//Save the link in a variable called element
				var element = $(this);
				
				//Find the id of the link that was clicked
				var del_id = element.attr("id");
				
				//Built a url to send
				var info = 'id=' + del_id;
				if(confirm("Está seguro que desea borrar este proveedor? \n Este proceso no es reversible!"))
					{
				
				$.ajax({
					type: "GET",
					url: "deletesupplier.php",
					data: info,
					success: function(){
				   	alert('El proveedor se ha borrado correctamente');
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
					$("#suplier_rut").val('');
					$("#suplier_name").val('');
					$("#suplier_namefantasia").val('');
					$("#suplier_address").val('');
					$("#suplier_ciudad").val('');
					$("#suplier_comuna").val('');
					$("#suplier_contact").val('');
					$("#contact_person").val(''); 
					$("#suplier_giro").val('');
					$("#suplier_email").val('');
					$("#note").val('');
					
					$("#userForm").attr("action", "savesupplier.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editsupplier.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].suplier_id);
							$("#suplier_rut").val(response.records[0].suplier_rut);
							$("#suplier_name").val(response.records[0].suplier_name);
							$("#suplier_namefantasia").val(response.records[0].suplier_fantasyname);
							$("#suplier_address").val(response.records[0].suplier_address);
							$("#suplier_ciudad").val(response.records[0].suplier_ciudad);
							$("#suplier_comuna").val(response.records[0].suplier_comuna);
							$("#suplier_contact").val(response.records[0].suplier_contact);
							$("#contact_person").val(response.records[0].contact_person); 
							$("#suplier_giro").val(response.records[0].suplier_giro);
							$("#suplier_email").val(response.records[0].suplier_email);
							$("#note").val(response.records[0].note);
							
							$("#userForm").attr("action", "saveeditsupplier.php");
							$("#myModal").modal();
							
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
				});
			});

</script>
        
    </head>
<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">
	<div class="span10">
	<div class="contentheader">

			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Proveedores</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

<?php 
			include('../connect.php');
			
			
				$result = mysql_query("SELECT * FROM supliers WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY suplier_id DESC");
				
				$rowcount = mysql_num_rows($result);
				
			?>
			<div style="text-align:center;">
			N&uacute;mero Total de Proveedores: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar Proveedor..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Proveedor</button>
<br><br>


<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> Rut </th>
            <th> Proveedor </th>
			<th> Persona de Contacto </th>
			<th> Direcci&oacute;n </th>
			<th> N&uacute;mero Contacto </th>
			<th> Notas </th>
			<th width="120"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$result = mysql_query("SELECT * FROM supliers WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY suplier_id DESC");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			?>
			<tr class="record">
			<td><?php echo $row['suplier_rut']; ?></td>
			<td><?php echo $row['suplier_name']; ?></td>
			<td><?php echo $row['contact_person']; ?></td>
			<td><?php echo $row['suplier_address']; ?></td>
			<td><?php echo $row['suplier_contact']; ?></td>
			<td><?php echo $row['note']; ?></td>
			<td>
            <Button data-id="<?php echo $row['suplier_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
            <a href="#" id="<?php echo $row['suplier_id']; ?>" class="delbutton" title="Click para borrar proveedor"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a>
			</td>
			</tr>
			<?php
				}
			?>
		
	</tbody>	
</table>
<div class="clearfix"></div>
</div>
</div>
</div>


<!-- MODAL Agregar supplier-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addsupplier.php');?>

		</div>
       </div>

</body>

</html>