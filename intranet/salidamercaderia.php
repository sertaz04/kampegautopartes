<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
<?php
	require_once('auth.php');
	
	$id=$_GET['iv'];
	$customer=$_GET['sp'];
?>

<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}

function validateForm() {
    var x = document.forms["myForm"]["qty"].value;
		if (x == null || x == "") {
			alert("Debe ingresar cantidad de elementos para el producto ingresado");
			return false;
		}
	}

		$(document).ready(function(){
			$("#myBtn").click(function(){
				
				$("#memi").val('');
				$("#group").val('');
				$("#family").val('');
				$("#subfamily").val('');
				$("#code").val('');
				$("#name").val('');
				$("#codebar").val('');
				$("#unit_purchase").val('');
				$("#unit_sale").val('');
				$("#avgcost").val('');
				$("#lastcost").val('');
				$("#marginsale").val('');
				$("#pricesale").val('');
				$("#marginspecial").val('');
				$("#pricespecial").val('');
				$("#orginproduct").val('');
				$("#genericcode").val('');
				$("#maxdescount").val('');
				$("#details").val('');
				$("#codeaccount").val('');
				$("#nameaccount").val('');
				$("#codecenter").val('');
				$("#namecenter").val('');
				$("#inmovilizado").val('');
				$("#inventariable").val('');
				$("#origen").val('ventas');
				$("#iv").val('<? echo $_GET['iv']; ?>');
				$("#sp").val('<? echo $_GET['sp']; ?>');
				
				
				$("#userForm").attr("action", "saveproduct.php");
				$("#myModal").modal();
			});
		});
		
		
		$(document).ready(function(){
			$("#rutProveedor").change(function(){
				$("#nombreFantasia").val($("#rutProveedor").val());
			});
		});
		
		function descuento(id, id2){
			$(id2).val( $(id2).val()-($(id2).val()*$(id).val()/100) );
			calcular_total();
		}
		
		function calcular_total() {
			var importe_total = 0
			$("[id*=ventas]").each(
				function(index, value) {
					importe_total = importe_total + eval($(this).val());
				}
			);
			$("#neto").val(Math.round(importe_total*0.81));
			$("#iva").val(Math.round(importe_total*0.19));
			$("#importe").val(Math.round(importe_total)+eval($("#adicional").val()));
		}
		
		$(document).ready(function(){
			$("#productocodigo").change(function(){
				$("#product").val($("#productocodigo").val());
			});
		});

</script>

  <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
 <div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Tablero</a></li>
				<li class="active">Lista Ventas</li>
			</ul>
<div id="maintable">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Volver</button></a><br><br>

<form action="savesalidamercaderia.php" method="post" onSubmit="return validateForm()" name="myForm">
<input type="hidden" name="invoice" value="<?php echo $_GET['iv']; ?>" />

<input type="text" name="productocodigo" id="productocodigo" />
<select name="product" style="width:480px; "class="chzn-select" required>
<option></option>
	<?php
	include('../connect.php');
	$result = mysql_query("SELECT 
(select sum(pi.qty) from purchases_item pi where pi.product_id = p.product_id AND pi.`delete`='0')-
case when (select sum(so.qty) from sales_order so where so.product_id = p.product_id AND p.`delete`='0')>0 then 
(select sum(so.qty) from sales_order so where so.product_id = p.product_id AND so.`delete`='0') else 0 end as stock ,  
p.name, p.product_id, p.code, p.codebar, g.group_label, f.family_label, sf.subfamily_label
FROM products p
LEFT JOIN `group` g
ON g.group_id = p.group_id
LEFT JOIN `family` f
ON f.family_id = p.family_id
LEFT JOIN subfamily sf
ON sf.subfamily_id = p.subfamily_id
WHERE p.empresa_id = $sesionEmpresaID AND p.`delete`='0'");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
	?>
		<option value="<?php echo $row['product_id'];?>"><?php echo $row['group_label']; ?> - <?php echo $row['family_label']; ?> - <?php echo $row['subfamily_label']; ?> - <?php echo $row['codebar']; ?> - <?php echo $row['name']; ?> | Stock : <?php echo $row['stock']; ?></option>
	<?php
				}
			?>
</select>

<input type="text" name="qty" value="" placeholder="Cantidad" autocomplete="off" style="width: 78px; height:30px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<input type="hidden" name="cliente_id" value="<? echo $_GET['sp'];?>" />
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-save icon-large"></i> Guardar</button>

</form>
<div class="content" id="content">
<div>
<?php
include('../connect.php');

$resultaz = mysql_query("SELECT v.*, c.rut, c.customer_name FROM sales v left join customer c on v.customer_id = c.customer_id WHERE v.transaction_id= '$id' and c.customer_id='$customer' AND v.empresa_id = $sesionEmpresaID AND v.delete='0'");
while($rowaz = mysql_fetch_array($resultaz, MYSQL_ASSOC))
{
echo 'Transaction ID : TR-'.$rowaz['transaction_id'].'<br>';
echo 'Rut Cliente : '.$rowaz['rut'].'<br>';
echo 'Nombre Fantasia : '.$rowaz['customer_name'].'<br>';
echo 'Numero Venta : '.$rowaz['invoice_number'].'<br>';
echo 'Fecha Factura: '.$rowaz['fecha_factura'].'<br>';
$adicional = $rowaz['adicional'];
}
?>
</div>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="35%"> Nombre </th>
			<th width="10%"> Cantidad </th>
			<th width="15%"> Bodega </th>
            <th width="15%"> Sección </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			$id=$_GET['iv'];
			
			$result = mysql_query("SELECT * FROM item_salida_venta WHERE invoice= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{
			?>
			<tr class="record">
			<td><?php
			$rrrrrrr=$row['producto_id'];
			
			$resultss = mysql_query("SELECT * FROM products WHERE product_id= '$rrrrrrr' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
			while($rowss = mysql_fetch_array($resultss, MYSQL_ASSOC))
			{
			echo $rowss['name'];
			}
			?></td>
			<td><input type="text" name="cantidad-<?php echo $row['id']; ?>" id="cantidad-<?php echo $row['id']; ?>" value="<?php echo $row['cantidad']; ?>"></td>
			<td>
				<select name="bodega_id" id="bodega_id"  style="width:265px; height:30px; margin-left:-5px;" >
				<option></option>
					<?php
					include('../connect.php');
					
					$resultzz=mysql_query("SELECT bodega_id, bodega_nombre FROM bodega WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
						while($rowzz = mysql_fetch_array($resultzz, MYSQL_ASSOC)){
					?>
						<option value="<?php echo $rowzz['bodega_id']; ?>"><?php echo $rowzz['bodega_nombre']; ?></option>
					<?php
					}
					?>
				</select>
			</td>
            <td>
            	<select name="seccion_id" id="seccion_id"  style="width:265px; height:30px; margin-left:-5px;" >
				<option></option>
					<?php
					include('../connect.php');
					
					$resultyy=mysql_query("SELECT seccion_id, ubicacion FROM seccion WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
						while($rowyy = mysql_fetch_array($resultyy, MYSQL_ASSOC)){
					?>
						<option value="<?php echo $rowyy['seccion_id']; ?>"><?php echo $rowyy['ubicacion']; ?></option>
					<?php
					}
					?>
				</select>
            </td>
			<td><center><a href="deletepventa.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['iv']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['name'];?>"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a></td>
			</center>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table></div><br>

<button  style="height:35px; float:right;" class="btn btn-success btn-large">Guardar</button>

<div class="clearfix"></div>
	<div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addproduct.php');?>

		</div>
       </div>
    </div>

</div>
</body>
</html>