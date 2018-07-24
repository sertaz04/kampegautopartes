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
			 if(confirm("Está seguro que desea borrar a esta afp? \n Este proceso no es reversible!"))
					  {
			 $.ajax({
			   type: "GET",
			   url: "deleteafp.php",
			   data: info,
			   success: function(){
			   		alert('La afp se ha borrado correctamente.');
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
					$("#afp_nombre").val('');
					$("#afp_direccion").val('');
					$("#afp_telefono").val('');
					$("#afp_ciudad").val('');
					$("#afp_comuna").val('');
					$("#userForm").attr("action", "saveafp.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editafp.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].afp_id);
							$("#empresa_id").val(response.records[0].empresa_id);
							$("#afp_nombre").val(response.records[0].afp_nombre);
							$("#afp_direccion").val(response.records[0].afp_direccion);
							$("#afp_telefono").val(response.records[0].afp_telefono);
							$("#afp_ciudad").val(response.records[0].afp_ciudad);
							$("#afp_comuna").val(response.records[0].afp_comuna);
							$("#userForm").attr("action", "saveeditafp.php");
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
			<li class="active">Afp</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM afp WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de afpes:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar afp..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar afp</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="10%"> C&oacute;digo </th>
			<th width="35%"> Nombre </th>
			<th width="10%"> Cotizaci&oacute;n </th>
			<th width="35%"> SIS </th>
            <th width="35%"> Cod. PreviRed </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = mysql_query("SELECT * FROM afp s LEFT JOIN empresa e ON e.empresa_id =s.empresa_id WHERE s.empresa_id = $sesionEmpresaID AND s.`delete`='0' ORDER BY s.afp_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				echo '<tr class="record">';
			?>
		

			<td><?php echo $row['empresa_nombre']; ?></td>
			<td><?php echo $row['afp_nombre']; ?></td>
			<td><?php echo $row['afp_direccion']; ?></td>
            <td><?php echo $row['afp_telefono']; ?></td>
            <td><?php echo $row['afp_ciudad']; ?></td>
            <td><?php echo $row['afp_comuna']; ?></td>
			</td>			
			<td>
				<Button data-id="<?php echo $row['afp_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
				<a href="#" id="<?php echo $row['afp_id']; ?>" class="delbutton" title="Click para borrar la afp"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a>
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
        
        <?php include('addafp.php');?>

		</div>
       </div>
	   
	   
</body>

</html>