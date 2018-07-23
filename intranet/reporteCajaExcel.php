<?php
 			require_once('auth.php');


include('../connect.php');

$fechaMes = $_POST['fechaMes'];
$fechaInicio = $_POST['fechaInicio'];
$fechaFin = $_POST['fechaFin'];
$direccion = $_POST['direccion'];

include('../connect.php');
$sql = "SELECT  td.descripcion as tipoDocumento, 
			CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
			END as folio_DTE,  
			s.fecha_factura, 
			sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19 as total,
			fp.descripcion as formaPago, c.rut, c.customer_name, 
			CASE
				WHEN vi.fecha_pago<>'' THEN vi.fecha_pago
				ELSE s.fecha_vencimiento
			END as fecha_vencimiento,
			s.observaciones, b.banco_name, 
			s.forma_pago_id, s.tipo_documento_id, vi.monto as montoCheque
FROM sales s 
LEFT JOIN sales_order so ON s.transaction_id = so.invoice AND so.`delete` = 0
LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
LEFT JOIN forma_pago fp ON fp.forma_pago_id = s.forma_pago_id
LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
LEFT JOIN customer c ON c.customer_id = s.customer_id
LEFT JOIN ventas_impago vi ON s.transaction_id = vi.transaction_id 
LEFT JOIN bancos b ON b.banco_id = vi.banco
WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0'
 ";

if($fechaMes!=''){
	$sql .= " AND s.fecha_factura = '$fechaMes' ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND s.fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}
$sql .= " GROUP BY td.descripcion, cs.folio_DTE, s.invoice_number, s.fecha_factura, formaPago, c.rut, c.customer_name, s.fecha_vencimiento, vi.fecha_pago,
s.observaciones, b.banco_name, s.forma_pago_id, s.tipo_documento_id, vi.monto";
if($direccion!='-1'){
	$sql .= " ORDER BY cs.folio_DTE $direccion";
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

if($_POST['excel']==1){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=reporteCajaDiaria.xls");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Ventas</title>
</head>
<body>
	<script type="text/javascript">
		
		
	</script>

	<h2>CAJA DIARIA DE VENTAS DETALLADA</h2>
          
			<br><br><br>
			<?php 
			
				if($fechaMes!=''){
					echo 'Fecha de Caja: '.$fechaMes.'<br>';
				}else if($fechaInicio != '' && $fechaFin != ''){
					echo 'Fecha de Inicio y Fin Caja: '.$fechaInicio.'-'.$fechaFin.'<br>';
				}
				
			?>
		  <br><br>
		  <h1>DOCUMENTOS DE VENTA EMITIDOS</h1>
		  <h2>Boletas</h2>
          <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['tipo_documento_id']==13 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'Si'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    
                    	$total += $row['total'];
                    
                    		}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php $totalTotal += $total; echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>
	
	<h2>Guías</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['tipo_documento_id']==14 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo 0; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo '-'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['total'];
                        	}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>

<?php // query factura electronica
	$sqlFacturas = "SELECT  td.descripcion as tipoDocumento, 
			CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
			END as folio_DTE,  
			s.fecha_factura, 
			sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19 as total,
			fp.descripcion as formaPago, c.rut, c.customer_name, 
			s.fecha_vencimiento,
			s.observaciones,
			s.forma_pago_id, s.tipo_documento_id
FROM sales s 
LEFT JOIN sales_order so ON s.transaction_id = so.invoice AND so.`delete` = 0
LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
LEFT JOIN forma_pago fp ON fp.forma_pago_id = s.forma_pago_id
LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
LEFT JOIN customer c ON c.customer_id = s.customer_id
WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0'
 ";

if($fechaMes!=''){
	$sqlFacturas .= " AND s.fecha_factura = '$fechaMes' ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sqlFacturas .= " AND s.fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}
$sqlFacturas .= " GROUP BY td.descripcion, cs.folio_DTE, s.invoice_number, s.fecha_factura, formaPago, c.rut, c.customer_name, s.fecha_vencimiento,
s.observaciones, s.forma_pago_id, s.tipo_documento_id";
if($direccion!='-1'){
	$sqlFacturas .= " ORDER BY cs.folio_DTE $direccion";
}


//echo $sqlFacturas;


?>
	
	
	
	
	<h2>Facturas Electr&oacute;nicas</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$resultFacturas = mysql_query($sqlFacturas);
                    	$total = 0;
                        while($rowFactuas = mysql_fetch_array($resultFacturas, MYSQL_ASSOC))
                        {
                        	if($rowFactuas['tipo_documento_id']==26 && $rowFactuas['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $rowFactuas['tipoDocumento']; ?></td>
                    <td><?php echo $rowFactuas['folio_DTE']; ?></td>
                    <td><?php echo $rowFactuas['fecha_factura']; ?></td>
                    <td><?php echo round($rowFactuas['total']); ?></td>
                    <td><?php echo $rowFactuas['formaPago']; ?></td>
                    <td><?php if($rowFactuas['forma_pago_id']==2 || $rowFactuas['forma_pago_id']==4){ echo 'No';}else{ echo 'Si';}; ?></td>
                    <td><?php echo $rowFactuas['rut']; ?></td>
                    <td><?php echo $rowFactuas['customer_name']; ?></td>
                    <td><?php echo $rowFactuas['fecha_vencimiento']; ?></td>
                    <td><?php echo $rowFactuas['observaciones']; ?></td>
                    <td><?php echo '-' ?></td>
                    </tr>
                    <?php
                    		$total += $rowFactuas['total'];
                    		}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php $totalTotal += $total; echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
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
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($totalTotal);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>
	
	<h2>Notas de Crédito</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                    	
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['tipo_documento_id']==24 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo 0; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo '-'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['total'];
                        	}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>
	
	<h1>INGRESOS AL D&Iacute;A</h1>
	<h2>Efectivos</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                    	$totalTotal = 0;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	//if(($row['forma_pago_id']==0 || $row['forma_pago_id']==1 || $row['forma_pago_id']==6 || $row['forma_pago_id']==7) && $row['folio_DTE']!=''){
							if(($row['forma_pago_id']==0 || $row['forma_pago_id']==1) && $row['folio_DTE']!=''){
								if($row['tipo_documento_id']==26){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'Si'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['total'];
								} //en tipo factura
							}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php $totalTotal += $total; echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>

	<h2>Cheques</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Total Cheque</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['forma_pago_id']==3 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo round($row['montoCheque']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'Si'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['montoCheque'];
                    		}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php $totalTotal += $total; echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
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
			<td></td>
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
			<td style="font-weight: bold"><?php echo ROUND($totalTotal);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>

	<h1>INGRESOS A FECHA</h1>
	<h2>Cheques</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['forma_pago_id']==4 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'No'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['total'];
                    		}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
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
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>


	<h1>INGRESOS VENCIDOS</h1>
	<h2>Cheques</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	$total = 0;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['tipo_documento_id']==13 && $row['folio_DTE']!=''){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'No'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		$total += $row['total'];
                    		}//en tipo
                        }
                    ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td style="font-weight: bold"><?php echo ROUND($total);?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<br><br><br>
	
	
	<h1>PAGOS CUENTA CORRIENTE</h1>
	
	
	<?php $sql = "select td.descripcion as tipoDocumento, cs.folio_DTE, s.fecha_factura,  
sum((so.cost*so.qty)-(ROUND((so.cost*so.qty)*so.descuento/100)))*1.19 as total,
vp.forma_pago as formaPago, 'Si', c.rut, c.customer_name, vp.fecha_pago as fecha_vencimiento, 
vp.observaciones, b.banco_name
from ventas_pagos vp
LEFT JOIN view_sales s ON s.transaction_id = vp.transaction_id
LEFT JOIN view_sales_order so ON s.transaction_id = so.invoice AND so.`delete` = 0
LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id
LEFT JOIN claveSII cs ON cs.id_invoice = s.transaction_id
LEFT JOIN customer c ON c.customer_id = s.customer_id
LEFT JOIN bancos b ON b.banco_id = vp.banco_id 					
WHERE vp.empresa_id = $sesionEmpresaID AND vp.sucursal_id= $sesionSucursalID AND s.`delete`='0'
 ";
                    
                    
                    if($fechaMes!=''){
                    	$sql .= " AND vp.fecha_pago = '$fechaMes' ";
                    }else if($fechaInicio != '' && $fechaFin != ''){
                    	$sql .= " AND vp.fecha_pago between '$fechaInicio' AND '$fechaFin' ";
                    }
                    $sql .= " GROUP BY td.descripcion, cs.folio_DTE, s.fecha_factura, vp.forma_pago, 'Si', c.rut, c.customer_name, vp.fecha_pago, vp.observaciones, b.banco_name";
                    if($direccion!='-1'){
                    	$sql .= " ORDER BY cs.folio_DTE $direccion";
                    }
                    //echo $sql;
                    
?>
	
	
	
	<h2>Efectivos</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                    	// echo $sql;
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['formaPago']=='efectivo'){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'Si'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		}//en tipo
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
	<br><br><br>

	<h2>Cheques</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['formaPago']=='cheque'){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'Si'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		}//en tipo
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
	
	<h1>INGRESOS A FECHA</h1>
	<h2>Cheques</h2>
        <table class="table table-bordered" id="resultTable" border="1" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> Tipo Documento </th>
                    <th width="10%"> N&uacute;mero Documento</th>
                    <th width="10%"> Fecha Documento</th>
                    <th width="10%"> Total Documento</th>
                    <th width="10%"> Forma Pago Documento / G. Trasp </th>
                    <th width="10%"> PG</th>
					<th width="10%"> Rut</th>
                    <th width="10%"> Cliente o Proveedor </th>
                    <th width="10%"> Fecha Vencimiento o Pago</th>
                    <th width="10%"> Observaci&oacute;n </th>
                    <th width="10%"> Banco </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    	$result = mysql_query($sql);
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                        	if($row['formaPago']=='cheque'){
                    ?>
                    <tr class="record">
                    <td><?php echo $row['tipoDocumento']; ?></td>
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo round($row['total']); ?></td>
                    <td><?php echo $row['formaPago']; ?></td>
                    <td><?php echo 'No'; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['fecha_vencimiento']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    </tr>
                    <?php
                    		}//en tipo
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
	<br><br><br>


</body>
</html>