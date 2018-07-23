<html>
    <head>
        <title>ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
  		         <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">

			$(document).ready(function(){
				$("#myBtn").click(function(){
					
					$("#memi").val('');
					$("#tipoDocto").val('');
					$("#xmlCaf").val('');
					$("#ultimoFolio").val('');
					$("#rutEmisor2").val('');
					$("#userForm").attr("action", "savecaf.php");
					$("#myModal").modal();
				});
			});

$(document).ready(function(){
    $('#resultTable').dataTable();
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
			<li class="active">Folios Disponibles</li>
			</ul>
            
<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
				$result = mysql_query("SELECT * FROM `DTE_caf` WHERE Empresa = $sesionEmpresaID and Vigente='SI' ORDER BY TipoDocto DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			

			
</div>

<br />

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar CAF (Talonario)</button>
<br /><br /><br />

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="20%"> ID </th>
			<th width="50%"> Nombre DTE </th>
			<th width="20%"> Folios Disponible </th>
			<th width="20%"> &Uacute;ltimo Folio </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				$result = mysql_query("SELECT DISTINCT * FROM `DTE_caf` as a
				join DTE_TipoDocumentos as b on a.TipoDocto=b.IdTipoDoc
				WHERE Empresa = $sesionEmpresaID and Vigente='SI' ORDER BY TipoDocto DESC");
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
								
					?>
		
			<tr class="record">
                <td><?php echo $tipo=$row['TipoDocto']; ?></td>
                <td><?php echo $row['NombreDoc']; ?></td>
				<?php
				
				if ($tipo=="33"){
					$tipoDTE="26";
				}elseif ($tipo=="61"){
					$tipoDTE="24";
				}elseif ($tipo=="52"){
					$tipoDTE="14";
				}elseif ($tipo=="56"){
					$tipoDTE="29";
				}elseif ($tipo=="34"){
					$tipoDTE="27";
				}				
					
				//SELECT * FROM `NN2016`.`claveSII` LIMIT 1000;
				$resultFoliosUtilizados = mysql_query("SELECT count(folio_DTE) as contador FROM `claveSII` as a
				WHERE empresa_id = $sesionEmpresaID and tipo_documento='$tipoDTE'");
				
				//echo "SELECT count(folio_DTE) as contador FROM `claveSII` as a
				//WHERE empresa_id = $sesionEmpresaID and tipo_documento='$tipoDTE'";
				
				//$rowcount = mysql_num_rows($resultFoliosUtilizados);
				$rowFoliosUtilizados = mysql_fetch_array($resultFoliosUtilizados, MYSQL_ASSOC)
				?>
                <td><?php echo ($row['UltimoFolio'])-$rowFoliosUtilizados['contador']; ?></td>
                <td><?php echo $row['UltimoFolio']; ?></td>
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
        
        <?php include('addcaf.php');?>

		</div>
       </div>
	</body>
</html>