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
$sql = "SELECT p.transaction_id,p.invoice_number,p.fecha_factura, p.fecha_ingreso,p.tipo_productos, s.suplier_rut, s.suplier_name, td.descripcion, p.adicional, p.tipo_documento_id
		FROM purchases p left join supliers s on p.suplier_id = s.suplier_id 
		LEFT JOIN tipo_documento td ON td.tipo_documento_id = p.tipo_documento_id 
		WHERE p.empresa_id = $sesionEmpresaID /*AND p.sucursal_id= $sesionSucursalID*/ AND p.`delete`='0' ";


if($fechaMes!=''){
	$sql .= " AND MONTH( fecha_ingreso ) = MONTH('$fechaMes') ";
}else if($fechaInicio != '' && $fechaFin != ''){
	$sql .= " AND fecha_ingreso between '$fechaInicio' AND '$fechaFin' ";	
}

if($idCliente!=''){
	$sql .= " AND p.suplier_id = $idSupplier";
}

if($direccion!='-1'){
	$sql .= " ORDER BY p.transaction_id $direccion";
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
header("Content-Disposition: attachment;Filename=reporteCompras.xls");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Reporte - Compras</title>
</head>
<body>
	<script type="text/javascript">
		
		
	</script>

	<h2>REPORTE COMPRAS</h2>
          
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
					<th width="15%"> Fecha Ingreso</th>
                    <th width="15%"> Rut </th>
                    <th width="15%"> Razon Social </th>
                    <th width="15%"> Tipo Producto </th>
                    <?php if($costos!=''){ ?>
                    <th width="15%"> Costo </th>
                    <?php }?>
                    <th width="15%"> Neto </th>
					<th width="15%"> Exento </th>
                    <th width="15%"> IVA </th>
					<th width="15%"> Adicional </th>
                    <th width="15%"> Total </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
					<td><?php echo $row['fecha_ingreso']; ?></td>
                    <td><?php echo $row['suplier_rut']; ?></td>
                    <td><?php echo $row['suplier_name']; ?></td>
                    <td><?php echo $row['tipo_productos']; ?></td>
                    <?php if($costos!=''){ ?>
	                    <td> 
	                    <?php 
	                    $resultas = mysql_query("SELECT ROUND(sum(p.lastcost*pi.qty)) as costo FROM purchases_item pi INNER JOIN products p ON p.product_id = pi.product_id  WHERE pi.invoice= '".$row['transaction_id']."' AND pi.empresa_id = $sesionEmpresaID AND pi.`delete`='0'");
	                    while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
	                    {
	                    	if($row['descripcion']=="Nota De Cr&#233;dito" || $row['descripcion']=="Nota De Cr&#233;dito Electr&#243;nica"){
								$totalCosto += $rowas['costo']*-1;
								$Costo = $rowas['costo']*-1;
							}else{
								$totalCosto += $rowas['costo'];
								$Costo = $rowas['costo'];
							}
							
	                    } echo $Costo*1;
	                    ?></td>                    
                    <?php }?>
                    <td>
                    <?php 
                    if($row['tipo_documento_id']!=19 && $row['tipo_documento_id']!=25 && $row['tipo_documento_id']!=27){
						$resultas = mysql_query("SELECT ROUND((sum(cost*qty))-(sum(cost*qty*descuento/100))) as neto FROM purchases_item WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							if($row['descripcion']=="Nota De Cr&#233;dito" || $row['descripcion']=="Nota De Cr&#233;dito Electr&#243;nica"){
								$totalNeto += $rowas['neto']*-1;
								$Neto = $rowas['neto']*-1;
							}else{
								$totalNeto += $rowas['neto'];
								$Neto = $rowas['neto'];
							}
							
							
						} echo $Neto;
						//$netoTotal += $totalNeto;
					}else{$Neto = 0;}
                    ?>
                    </td>
                    <td> 
                    <?php 
					if($row['tipo_documento_id']==19 || $row['tipo_documento_id']==25 || $row['tipo_documento_id']==27){
						$resultas = mysql_query("SELECT ROUND((sum(cost*qty))-(sum(cost*qty*descuento/100))) as exento FROM purchases_item WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							$totalExento = $rowas['exento'];
						} echo $totalExento;
						$exentoTotal += $totalExento;
					}else{$totalExento = 0;}
						?>
					</td>
					<td> 
                    <?php 
					if($row['tipo_documento_id']!=19 && $row['tipo_documento_id']!=25 && $row['tipo_documento_id']!=27){
						$resultas = mysql_query("SELECT ROUND(((sum(cost*qty))-(sum(cost*qty*descuento/100)))*19/100) as iva FROM purchases_item WHERE invoice= '".$row['transaction_id']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
						while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
						{
							
							if($row['descripcion']=="Nota De Cr&#233;dito" || $row['descripcion']=="Nota De Cr&#233;dito Electr&#243;nica"){
								$totalIva += $rowas['iva']*-1;
								$Iva = $rowas['iva']*-1;
							}else{
								$totalIva += $rowas['iva'];
								$Iva = $rowas['iva'];
							}
							
							
						} echo $Iva;
						//$ivaTotal += $totalIva;
					}else{$Iva = 0;}
                    ?></td>
                    <td> 
                    <?php 
					if($row['tipo_documento_id']!=19 && $row['tipo_documento_id']!=25 && $row['tipo_documento_id']!=27){
						$totalAdicional = $row['adicional'];
						echo $totalAdicional;
					}else{$totalAdicional = 0;}
					?></td>
                    <td>
					<?php
					$adicionalTotal += $totalAdicional;
                    $total = $Neto+$totalExento+$Iva+$totalAdicional;
                    $totalTotal += $total;
                    echo $total;
                    ?></td>
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
			<?php if($costos!=''){ ?>
            <td><?php echo $totalCosto;?></td>
            <?php }?>
			<td><?php echo $totalNeto;?></td>
			<td><?php echo $exentoTotal;?></td>
			<td><?php echo $totalIva;?></td>
			<td><?php echo $adicionalTotal;?></td>
			<td><?php echo $totalTotal;?></td>
		</tr>
	</table>
	

</body>
</html>