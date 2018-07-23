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
			 if(confirm("Está seguro que desea borrar a este usuario? \n Este proceso no es reversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deleteuser.php",
			   data: info,
			   success: function(){
			   	alert('El usuario se ha borrado correctamente.');
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
					$("#name").val('');
					$("#rut").val('');
					$("#username").val('');
					$("#position").val('');
					$("#empresa").val('');
					$("#sucursal").val('');
					$("#userForm").attr("action", "saveuser.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'edituser.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].id);
							$("#name").val(response.records[0].name);
							$("#rut").val(response.records[0].rut);
							$("#username").val(response.records[0].username);
							$("#position").val(response.records[0].position);
							$("#empresa").val(response.records[0].empresa_id);
							$("#sucursal").val(response.records[0].sucursal_id);
							$("#userForm").attr("action", "saveedituser.php");
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
			<li class="active">Usuario</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">

<?php 
			include('../connect.php');
			
				$result = mysql_query("SELECT * FROM user WHERE `delete`='0' ORDER BY id DESC");
				
				$rowcount = mysql_num_rows($result);
			
			?>
			<div style="text-align:center;">
			N&uacute;mero Total de Usuario: <font color="green" style="font:bold 22px 'Aleo';"><?php echo $rowcount;?></font>
			</div>
</div>
<br />
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Buscar Usuario..." autocomplete="off" />

<button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;">Agregar Usuario</button>

<br /><br /><br />

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="15%"> Nombre Usuario </th>
            <th width="10%"> Rut </th>
			<th width="15%"> Usuario </th>
			<th width="10%"> Posici&oacute;n</th>
			<th width="20%"> Empresa</th>
            <th width="15%"> Sucursal</th>
			<th width="15%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$result = mysql_query("SELECT u.id, u.name, u.rut, u.username, u.position, 
										e.empresa_nombre, s.sucursal_nombre FROM user u 
										LEFT JOIN empresa e ON u.empresa_id = e.empresa_id 
										LEFT JOIN sucursal s ON u.sucursal_id = s.sucursal_id
										WHERE u.delete='0'
										ORDER BY u.id DESC");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
			?>
			<tr class="record">
			<td><?php echo $row['name']; ?></td>
            <td><?php echo $row['rut']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['position']; ?></td>
			<td><?php echo $row['empresa_nombre']; ?></td>
            <td><?php echo $row['sucursal_nombre']; ?></td>
			<td>
            
            <Button data-id="<?php echo $row['id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
            
			<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click para borrar usuario"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a></td>
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
        
        <?php include('adduser.php');?>

		</div>
       </div>
       
</body>
<?php include('footer.php');?>

</html>