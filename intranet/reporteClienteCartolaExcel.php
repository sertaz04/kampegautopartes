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
$sql = "SELECT s.*, u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, td.descripcion , fp.descripcion as forma_pago, '' as fechaPago, 
		CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
		END as folio_DTE, 0 as monto, '' as fecha_pago, '' as observaciones
		FROM sales s
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		WHERE s.empresa_id = $sesionEmpresaID /* AND s.sucursal_id= $sesionSucursalID */ AND s.`delete`='0' -- AND s.tipo_documento_id = 26
		AND s.fecha_factura between '$fechaInicio' AND '$fechaFin' 
		AND c.customer_id = $idCliente	
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , vp.forma_pago, vp.fecha_pago as fechaPago,
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, vp.monto, vp.fecha_pago, vp.observaciones as observaciones
		FROM ventas_pagos vp 
		LEFT JOIN customer c on vp.customer_id = c.customer_id 
		LEFT JOIN sales s ON vp.transaction_id = s.transaction_id
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN `user` u ON u.id = vp.user_create
		WHERE vp.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin'
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , 'Efectivo', '' as fechaPago,
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, 0, s.fecha_factura, '' as observaciones
		FROM sales s 
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN `user` u ON u.id = s.user_create
		WHERE s.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID AND s.forma_pago_id in (1,6,7)
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin' 
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , fp.descripcion as forma_pago, vi.fecha_pago as fechaPago, 
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, vi.monto , vi.fecha_pago, CONCAT(vi.fecha_pago, ' - ',b.banco_name, ' - ', vi.numero_cheque) as observaciones
		FROM ventas_impago vi
		LEFT JOIN sales s ON s.transaction_id = vi.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN forma_pago fp on fp.forma_pago_id = vi.forma_pago_id
		LEFT JOIN bancos b ON b.banco_id = vi.banco
		LEFT JOIN `user` u ON u.id = s.user_create
		WHERE s.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID AND s.forma_pago_id in (3,4,5)
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin'
		";

$sql .= " UNION ALL SELECT s.*, u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, td.descripcion , fp.descripcion as forma_pago, ''  as fechaPago,
		CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
		END as folio_DTE, 0 as monto, '' as fecha_pago, '' as observaciones
		FROM sales_history s
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		WHERE s.empresa_id = $sesionEmpresaID /* AND s.sucursal_id= $sesionSucursalID */ AND s.`delete`='0' -- AND s.tipo_documento_id = 26
		AND s.fecha_factura between '$fechaInicio' AND '$fechaFin' 
		AND c.customer_id = $idCliente	
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , vp.forma_pago, vp.fecha_pago as fechaPago,
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, vp.monto, vp.fecha_pago, vp.observaciones as observaciones
		FROM ventas_pagos vp 
		LEFT JOIN customer c on vp.customer_id = c.customer_id 
		LEFT JOIN sales_history s ON vp.transaction_id = s.transaction_id
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN `user` u ON u.id = vp.user_create
		WHERE vp.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin'
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , 'Efectivo', '' as fechaPago,
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, 0, s.fecha_factura, '' as observaciones
		FROM sales_history s 
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN `user` u ON u.id = s.user_create
		WHERE s.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID AND s.forma_pago_id in (1,6,7)
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin' 
		UNION 
		SELECT s.* , u.name as nombreVendedor,c.rut, c.ciudad, c.comuna, c.customer_name, 'ABONO' , fp.descripcion as forma_pago, vi.fecha_pago as fechaPago,
			CASE
					WHEN s.tipo_documento_id=13 THEN s.invoice_number
					ELSE cs.folio_DTE
			END as folio_DTE, vi.monto , vi.fecha_pago, CONCAT(vi.fecha_pago, ' - ',b.banco_name, ' - ', vi.numero_cheque) as observaciones
		FROM ventas_impago vi
		LEFT JOIN sales_history s ON s.transaction_id = vi.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN forma_pago fp on fp.forma_pago_id = vi.forma_pago_id
		LEFT JOIN bancos b ON b.banco_id = vi.banco
		LEFT JOIN `user` u ON u.id = s.user_create
		WHERE s.customer_id = $idCliente and s.empresa_id = $sesionEmpresaID AND s.forma_pago_id in (3,4,5)
		  AND s.fecha_factura BETWEEN '$fechaInicio' AND '$fechaFin'
		";

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
$totalPago = 0;

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=reporteClienteCartola.xls");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Cliente Cartola</title>
</head>
<body>

	<h2>REPORTE CARTOLA DE CLIENTES</h2>
          
			<br>
			
			<?php
				//echo $sql;
				echo 'Fecha de Inicio y Fin: '.$fechaInicio.'-'.$fechaFin.'<br>';
				echo 'Ordenado : '.$direccion.'<br><br><br>';

			?>
			
          <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="15%"> Tipo Documento </th>
                    <th width="15%"> N&uacute;mero Documento</th>
                    <th width="15%"> Fecha Factura</th>
                    <th width="15%"> Rut </th>
                    <th width="15%"> Razon Social </th>
                    <th width="15%"> Ciudad </th>
                    <th width="15%"> Comuna </th>
                    <th width="15%"> Tipo Producto </th>
                    <th width="15%"> Neto </th>
                    <th width="15%"> IVA </th>
                    <th width="15%"> Total </th>
					<th width="15%"> Pago </th>
					<th width="15%"> Fecha Pago </th>
                    <th width="15%"> Forma Pago </th>
                    <th width="15%"> Vendedor </th>
					<th width="15%"> Observaciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php if($row['descripcion']=='ABONO' && $row['tipo_documento_id'] != 26){
									echo $row['fecha_pago'];
							  }else{
									echo $row['fecha_factura']; 
							  }?>
					</td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['ciudad']; ?></td>
                    <td><?php echo $row['comuna']; ?></td>
                    <td><?php echo $row['tipo_productos']; ?></td>
                    <td>
                    <?php 
                    if($row['descripcion']=='ABONO' || $row['tipo_documento_id'] == 24){
						echo 0;
					}else{
						//echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
						$resultas = mysql_query("SELECT SUM(neto) AS neto FROM (SELECT ROUND((sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100))))) as neto FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
						UNION ALL
						SELECT ROUND((sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100))))) as neto FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') AS neto");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							$totalNeto += $rowas['neto'];
							$Neto = $rowas['neto'];
						} echo $Neto*1;
					}
                    ?>
                    </td>
                    <td> 
                    <?php 
					if($row['descripcion']=='ABONO' || $row['tipo_documento_id'] == 24){
						echo 0;
					}else{
						//echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
						$resultas = mysql_query("SELECT SUM(iva) AS iva FROM (SELECT ROUND(((sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))))*19/100) as iva FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
						UNION ALL
						SELECT ROUND(((sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))))*19/100) as iva FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') AS iva");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							$totalIva += $rowas['iva'];
							$Iva = $rowas['iva'];
						} echo $Iva*1;
					}
                    ?></td>
                    <td> 
                    <?php 
					if($row['descripcion']=='ABONO' || $row['tipo_documento_id'] == 24){
						echo 0;
					}else{
						//echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
						$resultas = mysql_query("SELECT SUM(costo) AS costo FROM (SELECT ROUND(sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19) as costo FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
						UNION ALL
						SELECT ROUND(sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19) as costo FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') AS costo");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							$totalTotal += $rowas['costo']*1;
							$total = $rowas['costo']*1;
						} echo $total;
					}
                    ?></td>
					<td><?php if($row['tipo_documento_id'] == 24 || ($row['descripcion']=='ABONO' && $row['tipo_documento_id'] == 26 && ($row['forma_pago_id']==1 || $row['forma_pago_id']==6 || $row['forma_pago_id']==7))){
									$resultas = mysql_query("SELECT SUM(costo) AS costo FROM (SELECT ROUND(sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19) as costo FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
									UNION ALL
									SELECT ROUND(sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19) as costo FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') AS costo");
									while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
									{
										$total = $rowas['costo']*1;
									} 
									echo $total;
									$totalPago += $total;
								}else{
									echo $row['monto'];
									$totalPago += $row['monto'];
								}
								?></td>
                    <td><?php echo $row['fecha_pago']; ?></td>
					<td><?php echo $row['forma_pago']; ?></td>
                   	<td><?php echo $row['nombreVendedor']; ?></td>
					<td><?php echo $row['observaciones']; ?></td>
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
			<td><?php echo $totalNeto;?></td>
			<td><?php echo $totalIva;?></td>
			<td><?php echo $totalTotal;?></td>
			<td><?php echo $totalPago;?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td><?php if(($totalTotal-$totalPago)>0){ echo "DEUDA PDTE";}else{ echo "SALDO A FAVOR";}?></td>
			<td></td>
			<td></td>
			<td><?php if(($totalTotal-$totalPago)>0){ echo $totalTotal-$totalPago;}?></td>
			<td><?php if(($totalTotal-$totalPago)<0){ echo $totalTotal-$totalPago;}?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	

</body>
</html>