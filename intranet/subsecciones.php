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
			 if(confirm("Está seguro que desea borrar a esta subsección? Este proceso no es reversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deletesubseccion.php",
			   data: info,
			   success: function(){
			   
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
					
					$("#subseccion_nombre").val('');
					$("#bodega").val('');
					$("#seccion").val('');
					$("#userForm").attr("action", "savesubseccion.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editsubseccion.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].subseccion_id);
							$("#subseccion_nombre").val(response.records[0].subseccion_nombre);
							$("#bodega").val(response.records[0].bodega_id); 
							$("#seccion").val(response.records[0].seccion_id); 
							$("#userForm").attr("action", "saveeditsubseccion.php");
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
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Subsecci&oacute;n</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">

<?php 
			include('../connect.php');
			
				$result = mysql_query("SELECT subseccion_id, subseccion_nombre FROM subseccion WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY subseccion_id DESC");
				
				$rowcount = mysql_num_rows($result);
			
			?>
</div>
<br />
<input type="text" name="filter" style="padding:15px;" id="filter" placeholder="Buscar Subsecci&oacute;n..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Subsecci&oacute;n</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="20%"> Bodega </th>
			<th width="15%"> Seccion </th>
			<th width="25%"> Subsecci&oacute;n Nombre</th>
			<th width="20%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$result = mysql_query("SELECT ss.subseccion_id, ss.subseccion_nombre, s.seccion_id, b.bodega_nombre, s.capacidad, s.ubicacion, s.tipo 
										FROM subseccion ss
										LEFT JOIN seccion s on ss.seccion_id = s.seccion_id 
										LEFT JOIN bodega b on b.bodega_id = s.bodega_id 
										WHERE s.empresa_id = $sesionEmpresaID AND ss.`delete`='0' ORDER BY ss.subseccion_id ASC");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
			?>
			<tr class="record">
			<td><?php echo $row['bodega_nombre']; ?></td>
			<td><?php echo $row['ubicacion']; ?></td>
			<td><?php echo $row['subseccion_nombre']; ?></td>
			<td>
<Button data-id="<?php echo $row['subseccion_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
			<a href="#" id="<?php echo $row['subseccion_id']; ?>" class="delbutton" title="Click para borrar sección"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar</button></a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<div class="clearfix"></div>

 <!-- MODAL Agregar empresa-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addsubseccion.php');?>

		</div>
       </div>
       
</body>
</html>