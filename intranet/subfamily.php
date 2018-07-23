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
			 if(confirm("Está seguro que desea borrar esta subfamilia? Este proceso es irreversible!"))
					  {
			
			 $.ajax({
			   type: "GET",
			   url: "deletesubfamily.php",
			   data: info,
			   success: function(){
			   	alert('La subfamilia se ha borrado correctamente.');
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
					$("#family").val('');
					$("#subfamily_name").val('');
					$("#subfamily_label").val('');
					$("#userForm").attr("action", "savesubfamily.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editsubfamily.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].subfamily_id);
							$("#family").val(response.records[0].family_id);
							$("#subfamily_name").val(response.records[0].subfamily_name);
							$("#subfamily_label").val(response.records[0].subfamily_label);
							$("#userForm").attr("action", "saveeditsubfamily.php");
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
			<li class="active">Sub-Familia</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM subfamily WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ORDER BY subfamily_name ASC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
			
				<div style="text-align:center;">
			N&uacute;mero Total de Sub-familia:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			
			
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar Sub-Familia..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar Sub-Familia</button>
<br /><br /><br />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="7%">Abr Grupo </th>
			<th width="23%">Nombre Grupo</th>
			<th width="7%">Abr Familia</th>
           <th width="23%">Nombre Familia</th>
           <th width="8%">Abr Sub-Familia</th>
           <th width="22%">Nombre Sub-Familia</th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				$result = mysql_query("SELECT * FROM subfamily sf LEFT JOIN family fa ON fa.family_id = sf.family_id LEFT JOIN `group` gr ON fa.group_id = gr.group_id WHERE sf.empresa_id = $sesionEmpresaID AND sf.delete='0' ORDER BY subfamily_name ASC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				
			?>
		<tr class="record">
			<td><?php echo $row['group_label']; ?></td>
			<td><?php echo $row['group_name']; ?></td>
			<td><?php echo $row['family_label']; ?></td>
           <td><?php echo $row['family_name']; ?></td>
           <td><?php echo $row['subfamily_label']; ?></td>
           <td><?php echo $row['subfamily_name']; ?></td>
				<td>
                <Button data-id="<?php echo $row['subfamily_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar</button> 
                
			<a href="#" id="<?php echo $row['subfamily_id']; ?>" class="delbutton" title="Click para borrar la subfamilia"><button class="btn btn-danger"><i class="icon-trash"></i> Borrar</button></a></td>
			</tr>
			<?php
				}
			?>
		
		
		
	</tbody>
</table>
<div class="clearfix"></div>

 <!-- MODAL Agregar subfamilia-->
       
       <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addsubfamily.php');?>

		</div>
       </div>
</body>
</html>