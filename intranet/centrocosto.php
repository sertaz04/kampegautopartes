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
			 if(confirm("Está seguro que desea borrar a este Centro de costo? \n Este proceso no es reversible!"))
					  {
			 $.ajax({
			   type: "GET",
			   url: "deletecentrocosto.php",
			   data: info,
			   success: function(){
			   		alert('El Centro de costo se ha borrado correctamente.');
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
					$("#centro_name").val('');
					$("#empresa_id").val('');
					$("#userForm").attr("action", "savecentrocosto.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editcentrocosto.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].centro_id);
							$("#centro_codigo").val(response.records[0].centro_codigo);
							$("#centro_name").val(response.records[0].centro_name);
							$("#empresa").val(response.records[0].empresa_id);
							$("#userForm").attr("action", "saveeditcentrocosto.php");
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
			<li class="active">Centro Costo</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de Centro de Costos:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Centro..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Centro Costo</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="20%"> C&oacute;digo Centro </th>
			<th width="70%"> Nombre Centro </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
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
				include('../connect.php');
				$result = mysql_query("SELECT * FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY centro_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				echo '<tr class="record">';
			?>
		

			<td><?php echo $row['centro_codigo']; ?></td>
			<td><?php echo $row['centro_nombre']; ?></td>
			</td>			
			<td>
				<Button data-id="<?php echo $row['centro_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
				<a href="#" id="<?php echo $row['centro_id']; ?>" class="delbutton" title="Click para borrar el centro"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a>
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
        
        <?php include('addcentrocosto.php');?>

		</div>
       </div>
	   
	   
</body>

</html>