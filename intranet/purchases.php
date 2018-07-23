<?php 
include('../connect.php');
$result=mysql_query("SELECT 
CASE WHEN MAX( correlativo ) +1 > 0
THEN MAX( correlativo ) +1 
ELSE 1
END AS correlativo
FROM  purchases 
WHERE MONTH( fecha_factura ) = MONTH( CURDATE( ) )
AND empresa_id = $sesionEmpresaID
AND `delete`='0' ");
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	$correlativo = $row['correlativo'];
	}
?>

<script>

	$(document).ready(function(){
		$("#codigoCentro").change(function(){
			$("#nombreCentro").val($("#codigoCentro").val());
		});
	
		$("#nombreCentro").change(function(){
			$("#codigoCentro").val($("#nombreCentro").val());
		});
	
    	//$('select').chosen( { width: '250px' } );
    	$('#tipoProducto').chosen( { width: '250px' } );

    	$('#codigoCentro').chosen( { width: '250px' } );
    	
    	$('#rutProveedor').chosen( { width: '450px' } );

	});

</script>

<form action="savepur.php" method="post" id="userForm" name="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Compra</h4>
      </div>
      <div class="modal-body">
<div id="ac">
<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="tipo_documento" id="tipo_documento" />
<span>Rut Proveedor: <br></span>
<select name="rutProveedor" id="rutProveedor" class="grande" style="width: 450px;" required>
<option></option>
	<?php
	include('../connect.php');
	$result = mysql_query("SELECT * FROM supliers WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
	?>
		<option value="<?php echo $row['suplier_id'];?>"><?php echo $row['suplier_rut'].' - '.$row['suplier_name']; ?></option>
	<?php
				}
			?>
</select>
<button type="button" class="btn btn-success btn-xs masProveedor" data-dismiss="modal">+</button>
<br>

<span>Numero: </span><input type="text" style="width:265px; height:30px;" name="iv" id="iv" required/><br>
<span>Correlativo: </span><input type="text" style="width:265px; height:30px;" name="correlativo" id="correlativo" value="<?php echo $correlativo; ?>" readonly/><br>
<span>Fecha: <br></span><input type="date" style="width:265px; height:30px;" name="fechaFactura" id="fechaFactura" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
<span>Fecha Vencimiento: <br></span><input type="date" style="width:265px; height:30px;" name="fechaVencimiento" id="fechaVencimiento" placeholder="MM/DD/YYYY" value="<?php echo date('Y-m-d', strtotime('+1 months'))?>" /><br>
<span>Fecha Ingreso: <br></span><input type="date" style="width:265px; height:30px;" name="fechaIngreso" id="fechaIngreso" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
<span>Tipo Productos: <br></span>
<select name="tipoProducto" id="tipoProducto" style="width:265px; height:30px;">
	<option>Mercaderia</option>
	<option>Activo Fijo</option>
	<option>Gastos Operacionales</option>
</select>
<br>

 			<span>C&oacute;digo Centro Costo : </span>
            <select name="codigoCentro" id="codigoCentro"  style="width:265px; height:30px; " required>
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT * FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0' ");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['centro_id']; ?>"><?php echo $row['centro_codigo'].' - '.$row['centro_nombre']; ?></option>
                <?php
                }
                ?>
            </select><br>


</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>