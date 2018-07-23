<?php
session_start();
include('../connect.php');
$a0 = $_POST['cotizacion_name'];
$a = $_POST['customer_id'];
$b = $_POST['cotizacion_fecha'];
// query


$result=mysql_query("INSERT INTO cotizaciones (cotizaciones_name,customer_id,cotizaciones_fecha, empresa_id, user_create) VALUES ('$a0','$a','$b', $sesionEmpresaID, '$username')");

$resultaz = mysql_query("SELECT MAX(cotizaciones_id) as id FROM cotizaciones WHERE empresa_id = $sesionEmpresaID");
            while($rowaz = mysql_fetch_array($resultaz, MYSQL_ASSOC))
            {
            $id= $rowaz['id'];
            }

header("location: cotizacionesdetalle.php?id=$id");

?>