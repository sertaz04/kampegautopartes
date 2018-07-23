<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
include('../connect.php');


function nombremes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
} 


function url_exists( $url = NULL ) {
 
    if( empty( $url ) ){
        return false;
    }
 
    $options['http'] = array(
        'method' => "HEAD",
        'ignore_errors' => 1,
        'max_redirects' => 0
    );
    $body = @file_get_contents( $url, NULL, stream_context_create( $options ) );
    
    // Ver http://php.net/manual/es/reserved.variables.httpresponseheader.php
    if( isset( $http_response_header ) ) {
        sscanf( $http_response_header[0], 'HTTP/%*d.%*d %d', $httpcode );
 
        //Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            return true;
        } else {
            return false;
        }
     } else {
         return false;
     }

}




$result=mysql_query("SELECT *
  FROM Periodos where Empresa='$sesionEmpresaID'
  ORDER BY P01_ID DESC");


if (isset($_POST['periodo'])){
	$fInicio=substr($_POST['periodo'],0,8);
	$year=substr($_POST['periodo'],0,4);
	$month=substr($_POST['periodo'],4,2);
	$fFin=date ('d',(mktime (0,0,0,$month+1,1,$year)-1));
	$fFin= $year.$month.$fFin;
}else{
	$fInicio=date("Ymd");
	$fInicio=substr($fInicio,0,6)."01";
	$year=substr($fInicio,0,4);
	$month=substr($fInicio,4,2);
	$fFin=date ('d',(mktime (0,0,0,$month+1,1,$year)-1));
	$fFin= $year.$month.$fFin;
}


//ENVIO DE DTE AL SII
if (isset($_GET['valido']) and $_GET['valido']=="EnvioSII"){
require_once("json.php");
// read data
include('../connect.php');


//FIN - GENERAR FOLIO DOCUMENTO - svalenzu

$tipoDocto = $_GET['tipoDTE'];
$idEmpresa = $sesionEmpresaID;//"1";
$usuario=$_SESSION['KT_Username'];
$fechaActual = date("d-m-Y");

	//desarrollo
	//$aUrl = "http://localhost:1095/api/dte/Post/";
	//produccion
	$aUrl = "http://190.114.253.217:8083/api/dte/Post/";

$EnviarSII='1';

$data = file_get_contents($aUrl."?empresa=".urlencode($idEmpresa)."&tipoDocumento=".urlencode($tipoDocto)."&numeroDocumento=".urlencode($folio)."&enviarSII=".urlencode($EnviarSII)."&customer=".urlencode($customer));
// decode data
$json = new Services_JSON;
$obj = $json->decode($data);

if ($rowEnvios==0){
$result = mysql_query("INSERT INTO DTE_envioSII
           (NroDTE
           ,TipoDocto
           ,Empresa
           ,Estado
           ,Sistema
           ,Fecha
           ,Usuario
           ,FechaRecepcion
           ,IdSII)
     VALUES
           ($folio, $tipoDocto, $idEmpresa, 'EPR', 'INTRANET', '".date("Y-m-d")."', '$username', '".date("Y-m-d")."', 1)");
}
			
}

?>

<?php
if (isset($_POST['valido']) and $_POST['valido']=="Exportar"){


$mes=$_POST['mes'];
$annho=$_POST['annho'];

?>
<script>
document.getElementById('Div1').innerHTML = "";
</script>
<?php
header("Location: exportar_excel_libro_ventas.php?empresa=$idEmpresa&mes=$mes&annho=$annho");
}
?>

<?php
if (isset($_POST['valido']) and $_POST['valido']=="ExportarCompras"){


$mes=$_POST['mes'];
$annho=$_POST['annho'];

?>
<script>
document.getElementById('Div1').innerHTML = "";
</script>
<?php
header("Location: exportar_excel_libro_compras.php?empresa=$idEmpresa&mes=$mes&annho=$annho");
}
?>


<head>

<meta http-equiv="Content-Type" content="" content="text/html" charset="utf-8"/>
<title>:: Importar Libro de Ventas ::</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script>
function innerDetalle(ano,mes)
{
document.getElementById('Div1').innerHTML = "<input name='valido' value='Exportar' type='hidden'>";
document.getElementById('Mes').innerHTML = "<input id='mes' name='mes' value='1' type='hidden'>";
document.getElementById('Annho').innerHTML = "<input id='annho' name='annho' value='1' type='hidden'>";
document.forms.form1.mes.value = mes;
document.forms.form1.annho.value = ano;
document.forms.form1.submit();
}

function innerDetalleCompras(ano,mes)
{
document.getElementById('Div1').innerHTML = "<input name='valido' value='ExportarCompras' type='hidden'>";
document.getElementById('Mes').innerHTML = "<input id='mes' name='mes' value='1' type='hidden'>";
document.getElementById('Annho').innerHTML = "<input id='annho' name='annho' value='1' type='hidden'>";
document.forms.form1.mes.value = mes;
document.forms.form1.annho.value = ano;
document.forms.form1.submit();
}

$(document).ready(function(){
    $('#resultTable').dataTable();
});
</script>
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
			<li class="active">Generar y Envio Libro de Compra/Venta al SII</li>
			</ul>

<!--<form name="importa" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data">-->
<form name="form1" id="form1" method="POST">
  <div align="right">
  <?php
echo "<table border='0'>

  <tr>

		  	   
			  
	    <div id='Div1'></div>
<div id='Mes'></div>
<div id='Annho'></div>

  </tr>
</table>";
?>
    

  <input type="hidden" value="upload" name="action"/>
  </div>
</form>
<?php
extract($_POST);
if ($action == "upload"){
//cargamos el archivo al servidor con el mismo nombre
//solo le agregue el sufijo bak_
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$anho=$_POST['anho'];//date("Y");
$empresa=$_POST['planta'];
$periodo=$_POST['periodo'];

//INI -- INVOCACION AL WS.

//FIN -- INVOCACION AL WS.

}
?>

<table class="table table-hover table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="8%"> CVS - XML </th>
			<th width="8%"> Mes/Año </th>
			<th width="8%"> Tipo Libro </th>
			<th width="10%"> Cant. DTE </th>
			<th width="15%"> Neto </th>
			<th width="15%"> IVA </th>
			<th width="10%"> Impuestos </th>
			<th width="15%"> Total </th>
			<th width="30%"> Estado </th>
			<th width="20%"> ACCION </th>			
			
			
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				//if ($sesionEmpresaID=='1'){
				$result = mysql_query("SELECT anho, mes, SUM(NroDTE) as NroDTE, SUM(Neto) as Neto, round(SUM(Neto)*0.19,0) as IVA, round(SUM(Neto)*1.19,0) as Total FROM VIEW_LIBRO_VENTA WHERE CodEmpresa = $sesionEmpresaID
						group by anho, mes, CodEmpresa order by anho desc,mes desc");

//echo "SELECT anho, mes, SUM(NroDTE) as NroDTE, SUM(Neto) as Neto, round(SUM(Neto)*0.19,0) as IVA, round(SUM(Neto)*1.19,0) as Total FROM `VIEW_LIBRO_VENTA` WHERE CodEmpresa = $sesionEmpresaID	group by mes, CodEmpresa order by anho desc,mes desc";
				/*}else{
				$result = mysql_query("SELECT anho, mes, SUM(Neto) as Neto, round(SUM(Neto)*0.19,0) as IVA, round(SUM(Neto)*1.19,0) as Total FROM `VIEW_LIBRO_VENTAS_SIN_KILOS` WHERE CodEmpresa = $sesionEmpresaID group by anho, mes, CodEmpresa order by mes desc, anho desc");				
				}*/
				
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
								
										
								//$neto=$neto+$row['Neto'];
								//$iva=$iva+($neto*0.19);//$row['IVA'];
								//$mes=$row['mes'];
								//$anho=$row['anho'];
								//Otros_imp
								//$otros=$otros+$row['Otros_imp'];
								//$total=	$total+$iva;//$row['Total'];
						
	$anno = $row['anho'];
					$mes = $row['mes'];
				
			?>
					<tr class="record"><td nowrap>
<?php
					 echo "<input name='botton' type='button' id='botton' value='Excel Detalle' onClick='innerDetalle($anno ,$mes);'></td>";
?>

<?php
						$ip="190.114.253.217";
					$idEmp=$sesionEmpresaID;

                if ($idEmp==1)
                {
                    $nomEmpresa = "EMELIPIL"; 
                }else if ($idEmp==2){
                    $nomEmpresa = "RURIBE";
}


					$anno = $row['anho'];
					$mes = "0".$row['mes'];
					$nomMes = "02 - Febrero";
					
				   $rutaPDFCedible="http://".$ip.":8083/libros/".$anno."/".$nomEmpresa."/".$nomMes."/".$anno."_".$mes."_libvta_".$idEmp.".Signed.xml";
					$urlexistsNCedible = url_exists($rutaPDFCedible);
					  if ($urlexistsNCedible) {
					echo "<a href='".$rutaPDFCedible."' target='_blank'><img src='../img/xml-2.png' width='50' height='50'></a>";
					}
					?>
				</td>

                <td><?php echo $row['mes'].'/'.$row['anho']; ?></td>
                <td><?php echo 'VENTA'; ?></td>
                <td><?php echo number_format($row['NroDTE']); ?></td>
                <td><?php echo '$ '.number_format($row['Neto']); ?></td>
                <td><?php echo '$ '.number_format($row['IVA']); ?></td>
                <td><?php echo '$ '.number_format($otros); ?></td>
                <td><?php echo '$ '.number_format($row['Total']); ?></td>

   <td><?php echo 'EN PROCESO'; ?></td>
								<TD>
					<button style="height:35px; float:right;" class="btn btn-success btn-large" onClick='javascript:innerSII(<?php echo "VENTA"; ?>,<?php echo "TOTAL"; ?>);'>Enviar al SII</button>
</TD>


			</tr>
			
			
						<?php
			}
				include('../connect.php');
				
												$neto=0;
								$iva=0;
								$otros=0;
								$total=	0;
								
								
				$result = mysql_query("SELECT anho, mes, SUM(NroDTE) as NroDTE,SUM(Otros_imp) AS adicional, SUM(Neto) as Neto, round(SUM(IVA),0) as IVA, round(SUM(Neto)+SUM(IVA),0) as Total FROM `VIEW_LIBRO_COMPRA` WHERE CodEmpresa = $sesionEmpresaID group by anho, mes, CodEmpresa order by  anho desc,mes desc");
				

				while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
								
								
								//$neto=$neto+$row['Neto'];
								//$iva=$iva+$row['IVA'];
								//$total=$total+$row['Total'];

			
				
      $month = $row['mes'];
      $year = $row['anho'];
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
      $fechafin=date('Y-m-d', mktime(0,0,0, $month, $day, $year));
      $fechaini=date('Y-m-d', mktime(0,0,0, $month, 1, $year));


				//$resultOtrosImpuestos = mysql_query("SELECT SUM(Otros_imp) AS adicional FROM `purchases` as s WHERE s.empresa_id = $sesionEmpresaID and (`s`.`fecha_factura` >= '$fechaini') and (`s`.`fecha_factura` <= '$fechafin') and (`s`.`delete` = 0)");
								//while($rowOtrosImpuestos = mysql_fetch_array($resultOtrosImpuestos, MYSQL_ASSOC)){
							
								$otros=$row['adicional'];
								//}
								$anno = $row['anho'];
					$mes = $row['mes'];
				
			?>
					<tr class="record"><td nowrap>
<?php
					 echo "<input name='botton' type='button' id='botton' value='Excel Detalle' onClick='innerDetalleCompras($anno ,$mes);'></td>";
?>
<?php
						$ip="190.114.253.217";
					$idEmp=$sesionEmpresaID;

                if ($idEmp==1)
                {
                    $nomEmpresa = "EMELIPIL"; 
                }else if ($idEmp==2){
                    $nomEmpresa = "RURIBE";
}


					$anno = $row['anho'];
					$mes = "0".$row['mes'];
					$nomMes = "02 - Febrero";
					
				   $rutaPDFCedible="http://".$ip.":8083/libros/".$anno."/".$nomEmpresa."/".$nomMes."/".$anno."_".$mes."_libcomp_".$idEmp.".Signed.xml";
				   ?>
	
                <td><?php echo $row['mes'].'/'.$row['anho']; ?></td>
                <td><?php echo 'COMPRA'; ?></td>
                <td><?php echo number_format($row['NroDTE']); ?></td>
                <td><?php echo '$ '.number_format($row['Neto']); ?></td>
                <td><?php echo '$ '.number_format($row['IVA']); ?></td>
                <td><?php echo '$ '.number_format($otros); ?></td>
                <td><?php echo '$ '.number_format($row['Total']+$otros); ?></td>

   <td><?php echo 'EN PROCESO'; ?></td>
								<TD>
					<button style="height:35px; float:right;" class="btn btn-success btn-large" onClick='javascript:innerSII(<?php echo "VENTA"; ?>,<?php echo "TOTAL"; ?>);'>Enviar al SII</button>
</TD>

			</tr>
<?php
	}
?>
			
	</tbody>
</table>
<div class="clearfix"></div>
	</div>
	</div>
</body>
</html>