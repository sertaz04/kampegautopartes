<html>
<head>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <script src="../../js/jquery-2.2.3.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>

<title>C&oacute;digo de barra Kampeg</title>

 <?php
	require_once('../auth.php');
?>

</head>
<body>
<?php include('../../connect.php');
	  include('../navfixed.php');
	  ?>
<div class="container-fluid">
    <div class="row-fluid">
	<div class="span10">
	<div class="contentheader">
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">C&oacute;digo de barra Kampeg</li>
			</ul>



	<? if(!$_POST['codigo']){?>
	<h2>Formulario para imprimir c&oacute;digo de barra</h2>
	<table>
		<form method="POST" action="./BarInventarios2.php">
		<tr><td colspan="2"></td></tr>
		<tr><td>Ingrese Grupo</td><td><input type="text" id="grupo" name="grupo" ></td></tr>
		<tr><td>Ingrese Familia</td><td><input type="text" id="familia" name="familia" ></td></tr>
		<tr><td>Ingrese Subfamilia</td><td><input type="text" id="subfamilia" name="subfamilia" ></td></tr>
		<tr><td>Ingrese c&oacute;digo</td><td><input type="text" id="codigo" name="codigo" ></td></tr>
		<tr><td>Ingrese cantidad</td><td><input type="number" id="cantidad" name="cantidad" ></td></tr>
		<tr><td colspan="2"><button type="submit"  value="Imprimir">Imprimir</button></td></tr>
		</form>
	</table>
	<? }else{ ?>
	<table border="1">	
	<?php
	include('../../connect.php');
	$contador=0;
	$grupo = $_POST['grupo'];
	$familia = $_POST['familia'];
	$subfamilia = $_POST['subfamilia'];
	$codigo = $_POST['codigo'];
	$cantidad = $_POST['cantidad'];
	$result=mysql_query("select p.code, g.group_label as gl, f.family_label as fl, sf.subfamily_label as sfl, p.name from products p
						 LEFT JOIN `group` g on g.group_id = p.group_id
						 LEFT JOIN family f on f.family_id = p.family_id
						 LEFT JOIN subfamily sf on sf.subfamily_id = p.subfamily_id
						WHERE p.empresa_id = $sesionEmpresaID and p.sucursal_id= $sesionSucursalID  and p.`delete`='0' and p.code = '$codigo' 
							AND g.group_label = '$grupo' AND f.family_label = '$familia' AND sf.subfamily_label = '$subfamilia'
						GROUP BY p.code, g.group_label, f.family_label, sf.subfamily_label, p.name order by 1 desc limit $cantidad");
						
	/*echo "select p.code, g.group_label as gl, f.family_label as fl, sf.subfamily_label as sfl, p.name from products p
						 LEFT JOIN `group` g on g.group_id = p.group_id
						 LEFT JOIN family f on f.family_id = p.family_id
						 LEFT JOIN subfamily sf on sf.subfamily_id = p.subfamily_id
						WHERE p.empresa_id = $sesionEmpresaID and p.sucursal_id= $sesionSucursalID  and p.`delete`='0' and p.code = '$codigo' 
							AND g.group_label = '$grupo' AND f.family_label = '$familia' AND sf.subfamily_label = '$subfamilia'
						GROUP BY p.code, g.group_label, f.family_label, sf.subfamily_label, p.name order by 1 desc limit $cantidad";*/
	
	if (mysql_num_rows($result) < 1) { echo '<h2>Codigo Inexistente</h2>'; }
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		for ($i = 1; $i <= $cantidad; $i++) {
			?>
			<? if($contador==0){ ?>
				<tr>
			<? } ?>
				<td align="center">
				<img src="test_2D.php?text=<?echo $row['gl'].$row['fl'].$row['sfl'].$row['code'];?>" alt="barcode" /> <br />
				<? echo $row['name']; ?>
				</td><td>&nbsp;</td>
			<? $contador++;
			if($contador==3){ ?>
				</tr><tr><td colspan=6>&nbsp;</td></tr>
			<? $contador = 0;} ?>
		<?php
		} //end for
		}// end while
		?>
	
	</table>
	<? }?>

	
	<div class="clearfix"></div>
	
</body>
</html>