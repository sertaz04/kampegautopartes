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
			 if(confirm("Está seguro que desea borrar a esta Familia? \n Este proceso no es reversible!"))
					  {
			 $.ajax({
			   type: "GET",
			   url: "deletefamily.php",
			   data: info,
			   success: function(){
			   		alert('La familia se ha borrado correctamente.');
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
					$("#group_id").val('');
					$("#family_name").val('');
					$("#family_label").val('');
					$("#userForm").attr("action", "savefamily.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editfamily.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
							$("#memi").val(response.records[0].family_id);
							$("#family_name").val(response.records[0].family_name);
							$("#family_label").val(response.records[0].family_label);
							$("#group_id").val(response.records[0].group_id);
							$("#userForm").attr("action", "saveeditfamily.php");
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
			<li class="active">Familia</li>
			</ul>


<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM family WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY 1 DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM family WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY family_id DESC");
				
				$rowcount123 = mysql_num_rows($result);

			?>
				<div style="text-align:center;">
			N&uacute;mero Total de Familias:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
</div>
<br />

<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Familia..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Familia</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="10%"> Abr Grupo </th>
			<th width="35%"> Nombre Grupo </th>
			<th width="10%"> Abr Familia </th>
			<th width="35%"> Nombre Familia </th>
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
				$result = mysql_query("SELECT * FROM family f LEFT JOIN `group` g ON g.group_id =f.group_id WHERE f.empresa_id = $sesionEmpresaID AND g.`delete`='0' ORDER BY f.family_id DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				echo '<tr class="record">';
			?>
		

			<td><?php echo $row['group_label']; ?></td>
			<td><?php echo $row['group_name']; ?></td>
			<td><?php echo $row['family_label']; ?></td>
			<td><?php echo $row['family_name']; ?></td>
			</td>			
			<td>
				<Button data-id="<?php echo $row['family_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
				<a href="#" id="<?php echo $row['family_id']; ?>" class="delbutton" title="Click para borrar la familia"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a>
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
        
        <?php include('addfamily.php');?>

		</div>
       </div>
	   
	   
</body>

</html>