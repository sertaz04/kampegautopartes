<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <?php
			require_once('auth.php');
		 ?>
        <script>
		 $(document).ready(function(){
			$('#idCliente').chosen( { width: '450px' } );
		
		 });
		 </script>
    </head>
    <body>
		<?php include('navfixed.php');?>
 <div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">
				Tablero</a></li>
				<li class="active">Reporte de productos</li>
			</ul>
<div id="maintable">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Volver</button></a><br><br>
        		
	<form id="resumenOrden" action="reporteProductosExcel.php" method="post">
	
		<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
			<thead>
				<tr>
					<th width="20%">Filtro</th>
					<th width="80%">Valor</th>
				</tr>
			</thead>
			<tbody>
				<tr class="record">
					<td>Mes:</td>
					<td>
						<input type="date" style="width:265px; height:30px;" name="fechaMes" id="fechaMes" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" />
					</td>
				</tr>
				<tr>
					<td>Fecha Inicio y Fecha Fin</td>
					<td>			
			    		<input type="date" style="width:265px; height:30px;" name="fechaInicio" id="fechaInicio" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" />
			    		 - 
			    		<input type="date" style="width:265px; height:30px;" name="fechaFin" id="fechaFin" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" />
					</td>
				</tr>
				<tr>
					<td>Clientes:</td>
					<td>
						<select name="idCliente" id="idCliente" style="width: 450px;" class="grande" >
						<option></option>
							<?php
							include('../connect.php');
							$result = mysql_query("SELECT * FROM customer WHERE empresa_id = $sesionEmpresaID and `delete`='0'");
							while($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
							?>
								<option value="<?php echo $row['customer_id'];?>"><?php echo $row['rut'].' - '.$row['customer_name']; ?></option>
							<?php
										}
									?>
						</select>				
					</td>
				</tr>
				<tr>
					<td>Ordenaci&oacute;n:</td>
					<td>			
			    		<select name="direccion" id="direccion">
							<option value="-1">Seleccione</option>
							<option value="ASC">Ascendente</option>
							<option value="DESC">Descendente</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button class="btn btn-success btn-large" type="submit"> Generar Reporte</button></td>
				</tr>
		</table>
		
	</form>

</div>
</div>
</body>
</html>
