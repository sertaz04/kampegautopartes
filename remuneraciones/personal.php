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
			 if(confirm("Está seguro que desea borrar a esta Persona? \n Este proceso no es reversible!"))
					  {
			 $.ajax({
			   type: "GET",
			   url: "deletepersonal.php",
			   data: info,
			   success: function(){
			   		alert('La Persona se ha borrado correctamente.');
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
					$("#personal_nombre").val('');
					$("#personal_direccion").val('');
					$("#personal_telefono").val('');
					$("#personal_ciudad").val('');
					$("#personal_comuna").val('');
					$("#userForm").attr("action", "savepersonal.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editpersonal.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].personal_id);
							$("#empresa_id").val(response.records[0].empresa_id);
							$("#personal_nombre").val(response.records[0].personal_nombre);
							$("#personal_direccion").val(response.records[0].personal_direccion);
							$("#personal_telefono").val(response.records[0].personal_telefono);
							$("#personal_ciudad").val(response.records[0].personal_ciudad);
							$("#personal_comuna").val(response.records[0].personal_comuna);
							$("#userForm").attr("action", "saveeditpersonal.php");
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
			<li class="active">personal</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM personal WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de Personas:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar personal..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Persona</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="10%"> Rut </th>
			<th width="35%"> Ape. Paterno </th>
			<th width="10%"> Ape. Materno </th>
			<th width="35%"> Nombres </th>
            <th width="35%"> Direcci&oacute;n </th>
            <th width="35%"> Ciudad </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = mysql_query("SELECT * FROM personal s LEFT JOIN empresa e ON e.empresa_id =s.empresa_id WHERE s.empresa_id = $sesionEmpresaID AND s.`delete`='0' ORDER BY s.personal_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				echo '<tr class="record">';
			?>
		

			<td><?php echo $row['empresa_nombre']; ?></td>
			<td><?php echo $row['personal_nombre']; ?></td>
			<td><?php echo $row['personal_direccion']; ?></td>
            <td><?php echo $row['personal_telefono']; ?></td>
            <td><?php echo $row['personal_ciudad']; ?></td>
            <td><?php echo $row['personal_comuna']; ?></td>
			</td>			
			<td>
				<Button data-id="<?php echo $row['personal_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
				<a href="#" id="<?php echo $row['personal_id']; ?>" class="delbutton" title="Click para borrar la persona"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a>
			</td>
			</tr>
			<?php
				}
			?>
		
		
		
	</tbody>
</table>
<div class="clearfix"></div>
 <!-- MODAL Agregar Persona-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addpersonal.php');?>

		</div>
       </div>
	   
	   
</body>

</html>