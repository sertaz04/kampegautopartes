<?php
 			require_once('auth.php');


include('../connect.php');

$fechaMes = $_POST['fechaMes'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$costos = $_POST['costos'];
$direccion = $_POST['direccion'];
$deudas = $_POST['deudas'];
$idSupplier = $_POST['idSupplier'];

include('../connect.php');
$sql = "SELECT

		p.stock+
		case when (select sum(pi.qty) from purchases_item pi where pi.product_id = p.product_id AND pi.`delete`='0')>0 then
		(select sum(pi.qty) from purchases_item pi where pi.product_id = p.product_id AND pi.`delete`='0') else 0 end
		-
		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		- -- ventaBoleta
		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
		
		+
		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		-
		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		-
			case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		+
		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		-
		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0)>0 then
		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
		as stock ,
		p.name, p.product_id, p.code, p.codebar, g.group_label, f.family_label, sf.subfamily_label,
		su.sucursal_nombre, p.lastcost, sup.suplier_rut, sup.suplier_name
		FROM products p
		LEFT JOIN `group` g
		ON g.group_id = p.group_id
		LEFT JOIN `family` f
		ON f.family_id = p.family_id
		LEFT JOIN subfamily sf
		ON sf.subfamily_id = p.subfamily_id
		LEFT JOIN sucursal su
		ON su.sucursal_id = p.sucursal_id
		LEFT JOIN supliers sup
		ON sup.suplier_id = p.supplier_id
		WHERE p.empresa_id = $sesionEmpresaID
		  AND p.`delete`='0'";


if($idSupplier!=''){
	$sql .= "  AND p.supplier_id = $idSupplier";
}

if($direccion!='-1'){
	$sql .= " ORDER BY p.transaction_id $direccion";
}


//echo $sql;
		
$result = mysql_query($sql);

//variables totales
$totalNeto = 0;
$totalExento = 0;
$totalAdicional = 0;
$totalIva = 0;
$total = 0;
$totalCosto = 0;

$netoTotal = 0;
$exentoTotal = 0;
$adicionalTotal = 0;
$ivaTotal = 0;
$totalTotal = 0;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=reporteInventario.xls");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Inventario</title>
</head>
<body>
	<script type="text/javascript">
		
		
	</script>

	<h2>REPORTE INVENTARIO</h2>
          
			<br>
			
			<?php 
				echo 'Ordenado : '.$direccion.'<br><br><br>';

			?>
			
          <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Grupo</th>
					<th width="10%"> Familia</th>
                    <th width="10%"> Subfamilia </th>
					<th width="10%"> C&oacute;digo </th>
                    <th width="10%"> Descripci&oacute;n producto</th>
                    <th width="10%"> Stock </th>
                    <th width="10%"> Costo </th>
                    <th width="10%"> Rut Proveedor </th>
					<th width="10%"> Nombre Proveedor </th>
					<th width="10%"> Sucursal </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['group_label']; ?></td>
                    <td><?php echo $row['family_label']; ?></td>
                    <td><?php echo $row['subfamily_label']; ?></td>
					<td><?php echo $row['code']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo str_replace('.',',',floatval($row['stock'])); ?></td>
                    <td><?php echo str_replace('.',',',floatval($row['lastcost'])); ?></td>
                    <td><?php echo $row['suplier_rut']?></td>
					<td><?php echo $row['suplier_name']; ?></td>
					<td><?php echo $row['sucursal_nombre']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	

</body>
</html>