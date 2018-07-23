<html>
    <head>
        <title>KAMPEG</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>   
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
			   url: "deletecaf.php",
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
					$("#userForm").attr("action", "savecaf.php");
					$("#myModal").modal();
				});
			});
			
			$(document).ready(function(){
				$(".editButton").click(function(){
					var id = $(this).attr('data-id');

					$.ajax({
						url: 'editcaf.php?id=' + id,
						method: 'GET'
					}).success(function(response) {
						
							$("#memi").val(response.records[0].group_id);
							$("#group_name").val(response.records[0].group_name);
							$("#group_label").val(response.records[0].group_label);
							$("#userForm").attr("action", "saveeditcaf.php");
							$("#myModal").modal();
					}).error(function (textStatus, errorThrown){
						alert('Error: ha ocurrido un error: ' + errorThrown);
						});
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
			<li class="active">Estado Env&iacute;o SII </li>
			</ul>
            
<div style="margin-top: -19px; margin-bottom: 21px;">

			<?php 
			include('../connect.php');
			require_once("json.php");
				$result = mysql_query("SELECT * FROM `DTE_caf` WHERE Empresa = $sesionEmpresaID and Vigente='SI' ORDER BY TipoDocto DESC");
				
				$rowcount = mysql_num_rows($result);
			?>
			
			
</div>

<br />
<!--<input type="text" style="padding:15px;" name="filter" value="" id="filter" placeholder="Buscar DTE..." autocomplete="off" />-->

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:230px; height:35px;" />Agregar CAF (Talonario)</button>
<br /><br /><br />

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> ID </th>
			<th> Nombre DTE </th>
			<th> Fecha DTE </th>
			<th> Folio </th>
			<th> Cliente</th>
			<th> Estado</th>

		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');

if ($sesionEmpresaID!='1'){
				$myQuery = "SELECT a.folio_DTE, a.estadoSII, b.IdTipoDoc, b.NombreDoc, s.customer_id, c.customer_name,
				DATE_FORMAT(s.fecha_factura, '%d%m%Y') as fecha_factura,  REPLACE(I.RUTEmisor,'.','') AS RUTEmisor, I.RutAutorizador, c.rut as rutCliente,s.transaction_id,
(round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) + round(((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) * 19) / 100),0)) AS `Total`
				FROM `claveSII` as a
				join DTE_TipoDocumentos as b on a.tipo_documento=b.documento_id
				join view_sales as s on s.transaction_id=a.id_invoice and s.delete=0
				join view_sales_order as so on s.transaction_id=so.invoice  and so.delete=0
				join customer as c on c.customer_id=s.customer_id
				JOIN DTE_informacionEmpresas AS I ON I.CodEmpresa=a.empresa_id
				WHERE a.empresa_id=$sesionEmpresaID  and (estadoSII is null   or estadoSII='NOK'   or estadoSII='') and b.IdTipoDoc in ('33','61','56','52')				
				GROUP BY b.documento_id, a.folio_DTE, a.empresa_id
				ORDER BY b.documento_id, a.folio_DTE ";
}else{
				$myQuery = "SELECT a.folio_DTE, a.estadoSII, b.IdTipoDoc, b.NombreDoc, s.customer_id, c.customer_name,
				DATE_FORMAT(s.fecha_factura, '%d%m%Y') as fecha_factura,  REPLACE(I.RUTEmisor,'.','') AS RUTEmisor, I.RutAutorizador, c.rut as rutCliente,s.transaction_id,
(round(((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)),0) + round(((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) * 19) / 100),0)) AS `Total`
				FROM claveSII as a
				join DTE_TipoDocumentos as b on a.tipo_documento=b.documento_id
				join view_sales as s on s.transaction_id=a.id_invoice and s.delete=0
				join view_sales_order as so on s.transaction_id=so.invoice
				join customer as c on c.customer_id=s.customer_id
				JOIN DTE_informacionEmpresas AS I ON I.CodEmpresa=a.empresa_id
				WHERE a.empresa_id='$sesionEmpresaID'  and (estadoSII is null   or estadoSII='NOK'   or estadoSII='') and b.IdTipoDoc in ('33','61','56')				
				GROUP BY b.documento_id, a.folio_DTE, a.empresa_id
				ORDER BY b.documento_id, a.folio_DTE ";
}
				/*
				echo "SELECT a.folio_DTE, a.estadoSII, b.IdTipoDoc, b.NombreDoc, s.customer_id, c.customer_name,
				DATE_FORMAT(s.fecha_factura, '%d%m%Y') as fecha_factura,  REPLACE(I.RUTEmisor,'.','') AS RUTEmisor, I.RutAutorizador, c.rut as rutCliente,s.transaction_id,
				ROUND(sum(((((`so`.`cost` * `so`.`qty`) - (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) 
				/ 1.19) + (((((`so`.`cost` * `so`.`qty`) 
				- (((`so`.`cost` * `so`.`qty`) * `so`.`descuento`) / 100)) / 1.19) * 19) / 100))),0) AS `Total`
				FROM `claveSII` as a
				join DTE_TipoDocumentos as b on a.tipo_documento=b.documento_id
				join view_sales as s on s.transaction_id=a.id_invoice
				join view_sales_order as so on s.transaction_id=so.invoice
				join customer as c on c.customer_id=s.customer_id
				JOIN DTE_informacionEmpresas AS I ON I.CodEmpresa=a.empresa_id
				WHERE a.empresa_id=$sesionEmpresaID  and (estadoSII is null   or estadoSII='NOK'   or estadoSII='') and b.IdTipoDoc in ('33','61','56','52')				
				GROUP BY b.documento_id, a.folio_DTE, a.empresa_id
				ORDER BY b.documento_id, a.folio_DTE";
				*/
				$result = mysql_query($myQuery) or die("<br/><br/>ERROR: ".mysql_error()."<br/><br/>");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						
						$aUrl = "http://190.14.56.35:8081/api/dte/GetDTEStatus/";
						//$aUrl = "http://localhost:1095/api/dte/GetDTEStatus/";
						//http://localhost:1095/

$montoDte=$row['Total'];
$fechaEmisionDte=$row['fecha_factura'];//'02022017';
$folioDte=$row['folio_DTE'];
$tipoDte=$row['IdTipoDoc'];
$rutReceptor=$row['rutCliente'];
$rutEmpresa=$row['RUTEmisor'];
$rutConsultante=$row['RutAutorizador'];
$customer_id=$row['customer_id'];

$data = file_get_contents($aUrl."?rutConsultante=".urlencode($rutConsultante)."&rutEmpresa=".urlencode($rutEmpresa)."&rutReceptor=".urlencode($rutReceptor)."&tipoDte=".urlencode($tipoDte)."&folioDte=".urlencode($folioDte)."&fechaEmisionDte=".urlencode($fechaEmisionDte)."&montoDte=".urlencode($montoDte)."&empresa=".urlencode($sesionEmpresaID));

//echo $aUrl."?rutConsultante=".urlencode($rutConsultante)."&rutEmpresa=".urlencode($rutEmpresa)."&rutReceptor=".urlencode($rutReceptor)."&tipoDte=".urlencode($tipoDte)."&folioDte=".urlencode($folioDte)."&fechaEmisionDte=".urlencode($fechaEmisionDte)."&montoDte=".urlencode($montoDte)."&empresa=".urlencode($sesionEmpresaID);

// decode data
$json = new Services_JSON;
$obj = $json->decode($data);


//echo $data;	
$posDnk = strpos($data, 'DNK');
$posDok = strpos($data, 'DOK');

$id=$row['transaction_id'];

if ($posDnk !== false) {
    $estado='DOK';
	$resultUpdate=mysql_query("UPDATE claveSII as a
        SET estadoSII='$estado' WHERE id_invoice='$id' ");
}elseif ($posDok !== false) {
    $estado='DOK';
	$resultUpdate=mysql_query("UPDATE claveSII 
        SET estadoSII='$estado' WHERE id_invoice='$id' ");
}else {
    $estado='NOK';


//ENVIO AL SII

//if ($tipoDte=='61' || $tipoDte=='33'){
if ($tipoDte=='61' || $tipoDte=='33'){
//produccion
//$aUrl = "http://190.14.56.35:8083/api/dte/Post/";

$EnviarSII='1';

//$data = file_get_contents($aUrl."?empresa=".urlencode($sesionEmpresaID )."&tipoDocumento=".urlencode($tipoDte)."&numeroDocumento=".urlencode($folioDte)."&enviarSII=".urlencode($EnviarSII)."&customer=".urlencode($customer_id));
// decode data
//$json = new Services_JSON;
//$obj = $json->decode($data);
}
					?>
		
			<tr class="record">
                <td><?php echo $tipo=$row['IdTipoDoc']; ?></td>
                <td><?php echo $row['NombreDoc']; ?></td>
				<td><?php echo $row['fecha_factura']; ?></td>
		
                <td><?php echo $row['folio_DTE']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
				<td><?php echo $estado; ?></td>
			</tr>
			<?php
	}

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