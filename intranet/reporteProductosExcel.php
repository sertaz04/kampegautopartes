<?php
 			require_once('auth.php');


include('../connect.php');

$fechaMes = $_POST['fechaMes'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$costos = $_POST['costos'];
$vendedor = $_POST['vendedor'];
$direccion = $_POST['direccion'];
$deudas = $_POST['deudas'];
$idCliente = $_POST['idCliente'];


include('../connect.php');
$sql = "SELECT so.*, s.invoice_number, s.fecha_factura, c.rut, c.customer_name, cs.folio_DTE, p.name, p.code, p.stock, p.marginsale, p.lastcost ,td.descripcion, g.group_name, 
		p.pricesale, f.family_name, sf.subfamily_name, u.name nombre_vendedor, fp.descripcion forma_pago, s.estado_pago, u2.name usuario, so.product_id
		FROM sales_order so
		LEFT JOIN sales s ON s.transaction_id = so.invoice
		LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
		LEFT JOIN customer c ON s.customer_id = c.customer_id
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN products p ON p.product_id = so.product_id
		LEFT JOIN `group` g ON g.group_id = p.group_id
		LEFT JOIN family f ON f.family_id = p.family_id
		LEFT JOIN subfamily sf ON sf.subfamily_id = p.subfamily_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id and u2.sucursal_id = s.sucursal_id
		LEFT JOIN forma_pago fp ON fp.forma_pago_id = s.forma_pago_id
		WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0' AND so.`delete`='0' ";


if($fechaMes!=''){
	$sql .= " AND MONTH( fecha_factura ) = MONTH('$fechaMes') ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}

if($idCliente!=''){
	$sql .= " AND c.customer_id = $idCliente";
}

$sql .= " UNION ALL SELECT so.*, s.invoice_number, s.fecha_factura, c.rut, c.customer_name, cs.folio_DTE, p.name, p.code, p.stock, p.marginsale, p.lastcost ,td.descripcion, g.group_name, 
		p.pricesale, f.family_name, sf.subfamily_name, u.name nombre_vendedor, fp.descripcion forma_pago, s.estado_pago, u2.name usuario, so.product_id
		FROM sales_order_history so
		LEFT JOIN sales_history s ON s.transaction_id = so.invoice
		LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
		LEFT JOIN customer c ON s.customer_id = c.customer_id
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN products p ON p.product_id = so.product_id
		LEFT JOIN `group` g ON g.group_id = p.group_id
		LEFT JOIN family f ON f.family_id = p.family_id
		LEFT JOIN subfamily sf ON sf.subfamily_id = p.subfamily_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id and u2.sucursal_id = s.sucursal_id
		LEFT JOIN forma_pago fp ON fp.forma_pago_id = s.forma_pago_id
		WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0' AND so.`delete`='0' ";


if($fechaMes!=''){
	$sql .= " AND MONTH( fecha_factura ) = MONTH('$fechaMes') ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}

if($idCliente!=''){
	$sql .= " AND c.customer_id = $idCliente";
}

if($direccion!='-1'){
	$sql .= " ORDER BY s.transaction_id $direccion";
}


//echo $sql;
		
$result = mysql_query($sql);

//variables parciales
$Neto = 0;
$Iva = 0;
$total = 0;
$Costo = 0;

//variables totales
$totalNeto = 0;
$totalIva = 0;
$totalTotal = 0;
$totalCosto = 0;


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=reporteProductosVendidos.xls");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Ventas</title>
</head>
<body>
	<script type="text/javascript">
		
		
	</script>

	<h2>REPORTE PRODUCTOS VENDIDOS</h2>
          
			<br>
			
			<?php 
				echo 'Fecha de Mes: '.$fechaMes.'<br>';
				echo 'Fecha de Inicio y Fin: '.$fechaInicio.'-'.$fechaFin.'<br>';
				echo 'Ordenado : '.$direccion.'<br><br><br>';

			?>
			
          <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="9%"> Tipo Documento </th>
                    <th width="9%"> N&uacute;mero Documento</th>
                    <th width="9%"> Fecha Factura</th>
                    <th width="9%"> Forma de Pago</th>
                    <th width="9%"> Rut </th>
                    <th width="9%"> Razon Social </th>
                    <th width="9%"> Grupo </th>
                    <th width="9%"> Familia </th>
                    <th width="9%"> Subfamilia </th>
					<th width="9%"> Cod. Producto</th>
                    <th width="9%"> Producto </th>
                    <th width="9%"> Cantidad vendida </th>
                    <th width="9%"> Precio Venta Unidad </th>
                    <th width="9%"> Precio Producto Unidad </th>
                    <th width="9%"> Costo Venta Unidad </th>
                    <th width="9%"> Margen </th>
                    <th width="9%"> Precio Total </th>
                    <th width="9%"> Precio Producto Total </th>
                    <th width="9%"> Costo Total </th>
                    <th width="9%"> Descuento </th>
                    <th width="10%"> Stock restante </th>
                    <th width="10%"> Vendedor </th>
					<th width="10%"> Usuario </th>
                    <th width="10%"> Pagado </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['folio_DTE'].$row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['forma_pago']; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['group_name']; ?></td>
                    <td><?php echo $row['family_name']; ?></td>
                    <td><?php echo $row['subfamily_name']; ?></td>
                    <td><?php echo $row['code']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo doubleval($row['qty']); ?></td>
                    <td><?php echo round($row['cost']*1.19); ?></td>
                    <td><?php echo round($row['pricesale']*1.19); ?></td>
                    <td><?php echo $row['lastcost']; ?></td>
                    <td><?php echo $row['marginsale']; ?></td>
                    <td><?php echo round( ( (doubleval($row['qty'])*doubleval($row['cost'])) - (doubleval($row['qty'])*doubleval($row['cost'])*$row['descuento']/100) )*1.19 ) ; ?></td>
                    <td><?php echo round( ( (doubleval($row['qty'])*doubleval($row['pricesale'])) - (doubleval($row['qty'])*doubleval($row['pricesale']))*$row['descuento']/100 )*1.19 ); ?></td>
                    <td><?php echo doubleval($row['qty'])*$row['lastcost']; ?></td>
                    <td><?php echo $row['descuento']; ?></td>
                    <td>
					<? 
					$sqlStockProd = "SELECT
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
            		as stock
            		FROM products p
            		LEFT JOIN `group` g
            		ON g.group_id = p.group_id
            		LEFT JOIN `family` f
            		ON f.family_id = p.family_id
            		LEFT JOIN subfamily sf
            		ON sf.subfamily_id = p.subfamily_id
            		WHERE p.empresa_id = $sesionEmpresaID AND p.sucursal_id=$sesionSucursalID AND p.`delete`='0'
            		 AND p.product_id = ".$row['product_id'];
					
					//$result2 = mysql_query($sqlStockProd);
					$filaStock = 0;
					while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
                        {
						$filaStock += round($row2['stock'],3);
						} echo $filaStock;
						?></td>
                    <td><?php echo $row['nombre_vendedor']; ?></td>
					<td><?php echo $row['usuario']; ?></td>
                    <td><?php if( ($row['forma_pago']=="Credito" || $row['forma_pago']=="Cheque a Fecha") && $row['estado_pago']==0){echo "NO";}else{ echo "SI";} ?></td>
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
			<td></td>
		</tr>
	</table>
	

</body>
</html>