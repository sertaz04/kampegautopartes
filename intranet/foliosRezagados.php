<html>
    <head>
        <title>NN2016</title>
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
			<li class="active">Folios Rezagados</li>
			</ul>
            
<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM `DTE_caf` WHERE Empresa = $sesionEmpresaID and Vigente='SI' ORDER BY TipoDocto DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
				<div style="text-align:center;">
			N&uacute;mero Total de Registros:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo '0';?>]</font>
			</div>
			
</div>

<br />
<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar DTE..." autocomplete="off" />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar CAF</button>
<br /><br /><br />

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="20%"> ID </th>
			<th width="50%"> Nombre DTE </th>
			<th width="20%"> Folio Rezagado </th>
			<th width="20%"> &Uacute;ltimo Folio </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				
				$result = mysql_query("SELECT * FROM `claveSII` as a
				join DTE_TipoDocumentos as b on a.tipo_documento=b.documento_id
				WHERE empresa_id='$sesionEmpresaID'
				ORDER BY a.tipo_documento,a.folio_DTE");
				
				$contador=0;
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$contador=$contador+1;	

					if ($contador>$row['folio_DTE']){
						$contador=1;
					}						
					?>
		
			<tr class="record">
			
			<?php if ($contador<$row['folio_DTE']){ ?>
                <td><?php echo $tipo=$row['IdTipoDoc']; ?></td>
                <td><?php echo $row['NombreDoc']; ?></td>
				<?php
				
				if ($tipo=="33"){
					$tipoDTE="26";
				}elseif ($tipo=="61"){
					$tipoDTE="24";
				}elseif ($tipo=="52"){
					$tipoDTE="14";
				}elseif ($tipo=="56"){
					$tipoDTE="23";
				}elseif ($tipo=="34"){
					$tipoDTE="27";
				}				
					
				?>
                <td><?php echo $row['folio_DTE']; ?></td>
                <td><?php echo $contador; ?></td>
				<?php } ?>
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