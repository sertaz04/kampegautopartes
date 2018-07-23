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
			 if(confirm("Está seguro que desea borrar a esta sucursal? \n Este proceso no es reversible!"))
					  {
			 $.ajax({
			   type: "GET",
			   url: "deletesucursal.php",
			   data: info,
			   success: function(){
			   		alert('La sucursal se ha borrado correctamente.');
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
					$("#empresa_id").val('');
					$("#sucursal_nombre").val('');
					$("#sucursal_direccion").val('');
					$("#sucursal_telefono").val('');
					$("#sucursal_ciudad").val('');
					$("#sucursal_comuna").val('');
					$("#userForm").attr("action", "savesucursal.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editsucursal.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].sucursal_id);
							$("#empresa_id").val(response.records[0].empresa_id);
							$("#sucursal_nombre").val(response.records[0].sucursal_nombre);
							$("#sucursal_direccion").val(response.records[0].sucursal_direccion);
							$("#sucursal_telefono").val(response.records[0].sucursal_telefono);
							$("#sucursal_ciudad").val(response.records[0].sucursal_ciudad);
							$("#sucursal_comuna").val(response.records[0].sucursal_comuna);
							$("#userForm").attr("action", "saveeditsucursal.php");
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
	<div class="span2">
	<div class="span10">
	<div class="contentheader">

			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Sucursal</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM sucursal WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de Sucursales:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Sucursal..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Sucursal</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="10%"> Empresa </th>
			<th width="35%"> Nombre </th>
			<th width="10%"> Direcci&oacute;n </th>
			<th width="35%"> Tel&eacute;fono </th>
            <th width="35%"> Ciudad </th>
            <th width="35%"> Comuna </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = mysql_query("SELECT * FROM sucursal s LEFT JOIN empresa e ON e.empresa_id =s.empresa_id WHERE s.empresa_id = $sesionEmpresaID AND s.`delete`='0' ORDER BY s.sucursal_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				echo '<tr class="record">';
			?>
		

			<td><?php echo $row['empresa_nombre']; ?></td>
			<td><?php echo $row['sucursal_nombre']; ?></td>
			<td><?php echo $row['sucursal_direccion']; ?></td>
            <td><?php echo $row['sucursal_telefono']; ?></td>
            <td><?php echo $row['sucursal_ciudad']; ?></td>
            <td><?php echo $row['sucursal_comuna']; ?></td>
			</td>			
			<td>
				<Button data-id="<?php echo $row['sucursal_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
				<a href="#" id="<?php echo $row['sucursal_id']; ?>" class="delbutton" title="Click para borrar la sucursal"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a>
			</td>
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
        
        <?php include('addsucursal.php');?>

		</div>
       </div>
	   
	   
</body>

</html>