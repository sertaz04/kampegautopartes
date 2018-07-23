<html>
<head>
<title>C&oacute;digo de barra Kampeg</title>
</head>
<body>
	<table border="1">
	<?php
	include('../connect.php');
	$contador=0;
	$result=mysql_query("select code, name from products where empresa_id = $sesionEmpresaID and `delete`='0' GROUP BY code, name order by 1 desc limit 30");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			?>
			<? if($contador==0){ ?>
				<tr>
			<? } ?>
				<td>
				<img src="test_2D.php?text=<?echo $row['code'];?>" alt="barcode" /> <br />
				<? echo $row['name']; ?>
				</td>
			<? $contador++;
			if($contador==3){ ?>
				</tr>
			<? $contador = 0;} ?>
		<?php
		}
		?>
	
	</table>
</body>
</html>