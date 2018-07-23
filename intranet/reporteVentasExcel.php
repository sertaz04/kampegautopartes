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
/*$sql = "SELECT s.*, u.name as nombreVendedor, u2.name as usuario,c.rut, csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, c.customer_name, td.descripcion , fp.descripcion as forma_pago, 
		CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
		END as folio_DTE
		FROM sales s
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN customer_sucursal csu on csu.customer_sucursal_id = s.customer_sucursal_id
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id and u2.sucursal_id = s.sucursal_id
		WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0' ";

*/

$sql = "SELECT s.fecha_factura, s.tipo_productos, u.name as nombreVendedor, u2.name as usuario,c.rut, 
csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, c.customer_name, td.descripcion , 
fp.descripcion as forma_pago, CASE WHEN s.tipo_documento_id=13 THEN s.invoice_number ELSE cs.folio_DTE 
END as folio_DTE, 
ROUND(sum(p.lastcost*so.qty)*1.19) as costo, 
ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))) as neto,
ROUND((SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*19/100) as iva,
ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19) as total
FROM sales s
LEFT JOIN sales_order so ON so.invoice= s.transaction_id and so.`delete`='0' 
LEFT JOIN products p on p.product_id = so.product_id
LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id 
LEFT JOIN customer c on s.customer_id = c.customer_id 
LEFT JOIN customer_sucursal csu on csu.customer_sucursal_id = s.customer_sucursal_id 
LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id 
LEFT JOIN `user` u ON u.id = c.vendedor_cartera 
LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id 
and u2.sucursal_id = s.sucursal_id WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID 
AND s.`delete`='0' ";

if($fechaMes!=''){
	$sql .= " AND MONTH( fecha_factura ) = MONTH('$fechaMes') ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}

if($deudas!=''){
	$sql .= " AND s.forma_pago_id in (2,4) AND s.estado_pago = 0 ";
}

if($idCliente!=''){
	$sql .= " AND c.customer_id = $idCliente";
}

$sql .= " GROUP BY s.transaction_id, s.fecha_factura, s.tipo_productos, u.name , u2.name, 
csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, c.customer_name, td.descripcion , 
fp.descripcion";

//HISTORICO
/*$sql .= " UNION ALL SELECT s.*, u.name as nombreVendedor, u2.name as usuario,c.rut, csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, c.customer_name, td.descripcion , fp.descripcion as forma_pago, 
		CASE
				WHEN s.tipo_documento_id=13 THEN s.invoice_number
				ELSE cs.folio_DTE
		END as folio_DTE
		FROM sales_history s
		LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id
		LEFT JOIN customer c on s.customer_id = c.customer_id 
		LEFT JOIN customer_sucursal csu on csu.customer_sucursal_id = s.customer_sucursal_id
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
		LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id
		LEFT JOIN `user` u ON u.id = c.vendedor_cartera
		LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id and u2.sucursal_id = s.sucursal_id
		WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID AND s.`delete`='0' ";
*/
$sql .= " UNION ALL 
SELECT s.fecha_factura, s.tipo_productos, u.name as nombreVendedor, 
u2.name as usuario,c.rut, csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, 
c.customer_name, td.descripcion , fp.descripcion as forma_pago, 
CASE WHEN s.tipo_documento_id=13 THEN s.invoice_number ELSE cs.folio_DTE END as folio_DTE,
ROUND(sum(p.lastcost*so.qty)*1.19) as costo, 
ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))) as neto,
ROUND((SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*19/100) as iva,
ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19) as total
FROM sales_history s 
LEFT JOIN sales_order_history so ON so.invoice= s.transaction_id and so.`delete`='0'
LEFT JOIN products p on p.product_id = so.product_id
LEFT JOIN claveSII cs on cs.id_invoice = s.transaction_id 
LEFT JOIN customer c on s.customer_id = c.customer_id 
LEFT JOIN customer_sucursal csu on csu.customer_sucursal_id = s.customer_sucursal_id 
LEFT JOIN tipo_documento td ON td.tipo_documento_id = s.tipo_documento_id 
LEFT JOIN forma_pago fp ON s.forma_pago_id = fp.forma_pago_id 
LEFT JOIN `user` u ON u.id = c.vendedor_cartera 
LEFT JOIN `user` u2 ON u2.username = s.user_create and u2.empresa_id = s.empresa_id 
and u2.sucursal_id = s.sucursal_id WHERE s.empresa_id = $sesionEmpresaID AND s.sucursal_id= $sesionSucursalID 
AND s.`delete`='0'";

if($fechaMes!=''){
	$sql .= " AND MONTH( fecha_factura ) = MONTH('$fechaMes') ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND fecha_factura between '$fechaInicio' AND '$fechaFin' ";	
}

if($deudas!=''){
	$sql .= " AND s.forma_pago_id in (2,4) AND s.estado_pago = 0 ";
}

if($idCliente!=''){
	$sql .= " AND c.customer_id = $idCliente";
}

$sql .= " GROUP BY s.transaction_id, s.fecha_factura, s.tipo_productos, u.name , u2.name, 
csu.customer_sucursal_ciudad, csu.customer_sucursal_comuna, c.customer_name, td.descripcion , 
fp.descripcion";

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
header("Content-Disposition: attachment;Filename=reporteVentas.xls");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Ventas</title>
</head>
<body>

	<h2>REPORTE VENTAS</h2>
          
			<br>
			
			<?php 
				echo 'Fecha de Mes: '.$fechaMes.'<br>';
				echo 'Fecha de Inicio y Fin: '.$fechaInicio.'-'.$fechaFin.'<br>';
				echo 'Incluye Costos: '.$costos.'<br>';
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
                    <?php if($costos!=''){ ?>
                    <th width="15%"> Costo </th>
                    <?php }?>
                    <th width="15%"> Neto </th>
                    <th width="15%"> IVA </th>
                    <th width="15%"> Total </th>
                    <th width="15%"> Forma Pago </th>
                    <?php if($vendedor!=''){ ?>
                    <th width="15%"> Vendedor </th>
                    <?php }?>
					<th width="15%"> Usuario </th>
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
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['rut']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['customer_sucursal_ciudad']; ?></td>
                    <td><?php echo $row['customer_sucursal_comuna']; ?></td>
                    <td><?php echo $row['tipo_productos']; ?></td>
                    <?php if($costos!=''){ ?>
	                    <td> 
	                    <?php 
	                    //echo "SELECT sum(p.lastcost*so.qty) FROM sales_order so INNER JOIN products p ON p.product_id = so.product_id  WHERE so.invoice= '".$row['transaction_id']."' AND so.empresa_id = $sesionEmpresaID AND so.`delete`='0'";
	                    /*$resultas = mysql_query(" select round(sum(costo)) as costo from (SELECT ROUND(sum(p.lastcost*so.qty)*1.19) as costo FROM sales_order so INNER JOIN products p ON p.product_id = so.product_id  WHERE so.invoice= '".$row['transaction_id']."' AND so.empresa_id = $sesionEmpresaID AND so.`delete`='0'
						UNION ALL
						SELECT ROUND(sum(p.lastcost*so.qty)*1.19) as costo FROM sales_order_history so INNER JOIN products p ON p.product_id = so.product_id  WHERE so.invoice= '".$row['transaction_id']."' AND so.empresa_id = $sesionEmpresaID AND so.`delete`='0') as costo");
	                    while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
	                    {*/
							if($row['descripcion']=="Nota De Cr&#233;dito"){
								$totalCosto += $row['costo']*-1;
								$Costo = $row['costo']*-1;
							}else{
								$totalCosto += $row['costo'];
								$Costo = $row['costo'];
							}
						//} 
						echo $Costo*1;
	                    ?></td>                    
                    <?php }?>
                    <td>
                    <?php 
                    
                    //echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
                    /*$resultas = mysql_query("select round(sum(neto)) as neto from (SELECT ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))) as neto FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
					UNION ALL SELECT ROUND((sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))) as neto FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') as neto");
                    while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
                    {*/
						if($row['descripcion']=="Nota De Cr&#233;dito"){
							$totalNeto += $row['neto']*-1;
							$Neto = $row['neto']*-1;
						}else{
							$totalNeto += $row['neto'];
							$Neto = $row['neto'];
						}
					//} 
					echo $Neto*1;
                    ?>
                    </td>
                    <td> 
                    <?php 
                    //echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
                    /*$resultas = mysql_query("select round(sum(iva)) as iva from (SELECT ROUND((SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*19/100) as iva FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
					union all
					SELECT ROUND((SUM((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100)))*19/100) as iva FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') as iva");
                    while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
                    {*/
						if($row['descripcion']=="Nota De Cr&#233;dito"){
							$totalIva += $row['iva']*-1;
							$Iva = $row['iva']*-1;
						}else{
							$totalIva += $row['iva'];
							$Iva = $row['iva'];
						}
					//} 
					echo $Iva*1;
                    ?></td>
                    <td> 
                    <?php 
                    //echo "SELECT sum(cost) FROM sales_order WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'";
                   /*$resultas = mysql_query("select round(sum(costo)) as costo from (SELECT ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19) as costo FROM sales_order so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
					UNION ALL
					SELECT ROUND(sum((so.cost*so.qty)-((so.cost*so.qty)*so.descuento/100))*1.19) as costo FROM sales_order_history so WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0') as costo");

                    while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
                    {*/
                    	if($row['descripcion']=="Nota De Cr&#233;dito"){
							$totalTotal += $row['total']*-1;
							$total = $row['total']*-1;
						}else{
							$totalTotal += $row['total']*1;
							$total = $row['total']*1;
						}
					//} 
					echo $total;
                    ?></td>
                    <td><?php echo $row['forma_pago']; ?></td>
                    <?php if($vendedor!=''){ ?>
                    	<td><?php echo $row['nombreVendedor']; ?></td>
                    <?php } ?>
					<td><?php echo $row['usuario']; ?></td>
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
			<?php if($costos!=''){ ?>
            <td><?php echo $totalCosto;?></td>
            <?php }?>
			<td><?php echo $totalNeto;?></td>
			<td><?php echo $totalIva;?></td>
			<td><?php echo $totalTotal;?></td>
			<td></td>
			<?php if($vendedor!=''){ ?>
            <th></th>
            <?php }?>
		</tr>
	</table>
	

</body>
</html>