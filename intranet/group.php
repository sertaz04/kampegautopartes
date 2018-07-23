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
			 if(confirm("Está seguro que desea borrar este grupo? \n Este proceso es irreversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deletegroup.php",
			   data: info,
			   success: function(){
			   	alert('El grupo se ha borrado correctamente.');
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
					$("#group_name").val('');
					$("#group_label").val('');
					$("#userForm").attr("action", "savegroup.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editgroup.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].group_id);
							$("#group_name").val(response.records[0].group_name);
							$("#group_label").val(response.records[0].group_label);
							$("#userForm").attr("action", "saveeditgroup.php");
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
			<li class="active">Grupo</li>
			</ul>
            
<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM `group` WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 asc");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de Grupos:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Grupo..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Grupo</button>
<br /><br /><br />

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="20%"> Abr. </th>
			<th width="70%"> Nombre Grupo </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				$result = mysql_query("SELECT * FROM `group` WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY group_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
								
					?>
		
			<tr class="record">
                <td><?php echo $row['group_label']; ?></td>
                <td><?php echo $row['group_name']; ?></td>
                <td>
                <Button data-id="<?php echo $row['group_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                <a href="#" id="<?php echo $row['group_id']; ?>" class="delbutton" title="Click para borrar el grupo"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a></td>
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
        
        <?php include('addgroup.php');?>

		</div>
       </div>
	</body>
</html>