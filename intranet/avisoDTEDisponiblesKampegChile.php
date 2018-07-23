<?php

header('Content-Type: text/html; charset=ISO-8859-1');
include('../connect.php');
require 'PHPMailer/PHPMailerAutoload.php';

$sqlFacturacion=mysql_query("SELECT DISTINCT * FROM `DTE_caf` as a
				join DTE_TipoDocumentos as b on a.TipoDocto=b.IdTipoDoc
				join DTE_informacionEmpresas as c on a.RutEmpresa=c.RUTEmisor
				WHERE Empresa in ('3') and Vigente='SI' ORDER BY RutEmpresa,TipoDocto DESC");


$content ='<strong>FOLIOS DISPONIBLES</strong><br><br>';
$content .='<div class="datagrid">
<div style="overflow: hidden;" id="DivHeaderRow">
</div><div style="overflow:scroll;" onscroll="OnScrollDiv(this)" id="DivMainContent"><table id="tablaContent">
<thead><tr>
<th align="left">RUT</th><th align="left">RZN SOCIAL</th><th  align="left">TIPO DOCTO</th><th>FOLIOS DISP.</th><th>ULTIMO FOLIO</th>
</tr></thead><tbody>';
while($row = mysql_fetch_array($sqlFacturacion, MYSQL_ASSOC)){

$tipo = $row['TipoDocto'];

				if ($tipo=="33"){
					$tipoDTE="26";
				}elseif ($tipo=="61"){
					$tipoDTE="24";
				}elseif ($tipo=="52"){
					$tipoDTE="14";
				}elseif ($tipo=="56"){
					$tipoDTE="29";
				}elseif ($tipo=="34"){
					$tipoDTE="27";
				}

				$idEmpresa=$row['Empresa'];
$resultFoliosUtilizados = mysql_query("SELECT count(folio_DTE) as contador FROM `claveSII` as a
				WHERE empresa_id='$idEmpresa' and tipo_documento='$tipoDTE'");
				
$rowFoliosUtilizados = mysql_fetch_array($resultFoliosUtilizados, MYSQL_ASSOC);

$disponibles = ($row['UltimoFolio'])-$rowFoliosUtilizados['contador'];
	$content .='<tr>
	<td nowrap="nowrap">'.$row['RutEmpresa'].'</td>
	<td nowrap="nowrap">'.$row['RznSoc'].'</td>
	<td nowrap="nowrap">'.$row['NombreDoc'].'</td>
	<td nowrap="nowrap" align="center">'.$disponibles.'</td>
	<td nowrap="nowrap" align="center">'.$row['UltimoFolio'].'</td></tr>';
}
//$row['UltimoFolio'];
$content .='</tbody></table></div></div>';

$content .='<table>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Correo generado automáticamente, por favor no responder</td>
  </tr>
  <tr>
    <td>Atte, sistema de Facturación Electrónica</td>
  </tr>
</table>';

if (isset($_GET['origen'])){
echo $content;
}else{
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dte@alonsa.cl';                 // SMTP username
$mail->Password = 'Cawu5198';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'dte@alonsa.cl';
$mail->FromName = 'Documentos Electrónicos';

$mail->addAddress('hmunoz@alonsa.cl', ''); 
$mail->addAddress('ealfaro@kampeg.cl', '');  //fredy alejandro badilla jarpa <badillafredy@gmail.com>
$mail->addAddress('ventaslosangeles@kampeg.cl', '');
$mail->addAddress('losangeles@kampeg.cl', '');
$mail->addAddress('administracionlosangeles@kampeg.cl', '');//administracion losangeles <administracionlosangeles@kampeg.cl>
/*
$mail->addAddress('luisvargas@kampeg.cl', ''); 
$mail->addAddress('psanmartin@kampeg.cl', ''); 
$mail->addAddress('capchile@kampeg.cl', ''); 
*/

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "INFORME CANTIDAD FOLIOS DISPONIBLES POR CADA TIPO DTE";
$mail->Body    = $content;

if(!$mail->send()) {
    echo 'Error en el envío del mail, verifique casilla de correo en maestro SGFM.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mail enviado con exito<br>' . ' FECHA:'. date("Y-m-d");
}

}

echo date("Y-m-d h:i:s A");
// Se cierra la conexión
odbc_close_all();

?>