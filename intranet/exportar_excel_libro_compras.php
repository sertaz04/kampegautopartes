<?php 
ob_start();
header('Content-Type: text/html; charset=UTF-8');
session_start();
include('../connect.php');

$mes=$_GET['mes'];
$annho=$_GET['annho'];

$result=mysql_query("SELECT Factura, Tipo_Docto, anho, mes, Fecha_Mov, sum(SubTotal) as SubTotal, sum(Dcto_Monto) as Dcto_Monto, sum(Neto) as Neto, sum(IVA) as IVA, Sum(Total) as Total FROM `VIEW_LIBRO_COMPRA_DETALLE` WHERE CodEmpresa = $sesionEmpresaID
and anho='$annho' and mes='$mes'
GROUP BY Tipo_Docto, Factura, CodEmpresa, anho, mes, Fecha_Mov");

$shtml = $shtml."FOLIO".";"."TIPO DTE".";"."ANHO".";"."MES".";"."FECHA".";"."SUBTOTAL".";"."DESCUENTO".";"."NETO".";"."IVA".";"."TOTAL"."\n";

while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
$shtml = $shtml.$row['Factura'].";".$row['Tipo_Docto'].";".$row['anho'].";".$row['mes'].";".$row['Fecha_Mov'].";".$row['SubTotal'].";".$row['Dcto_Monto'].";".$row['Neto'].";".$row['IVA'].";".$row['Total']."\n";

}

header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=detalle_libro_compras.csv");
echo $shtml; 
ob_end_flush();
?>
