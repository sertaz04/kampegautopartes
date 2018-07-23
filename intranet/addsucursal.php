<form action="saveempresa.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sucursal</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	
	<span>Nombre  : </span>
	<input type="text" style="width:265px; height:30px;" name="sucursal_nombre" id="sucursal_nombre" ><br>
	<span>Dirección : </span>
	<input type="text" style="width:265px; height:30px;" name="sucursal_direccion" id="sucursal_direccion" ><br>
    <span>Telefono : </span>
	<input type="text" style="width:265px; height:30px;" name="sucursal_telefono" id="sucursal_telefono" ><br>
    <span>Ciudad : </span>
	<input type="text" style="width:265px; height:30px;" name="sucursal_ciudad" id="sucursal_ciudad" ><br>
    <span>Comuna : </span>
	<input type="text" style="width:265px; height:30px;" name="sucursal_comuna" id="sucursal_comuna" ><br>
	<span> Empresa : </span>
	<select name="empresa_id" id="empresa_id"  style="width:265px; height:30px; margin-left:-5px;" >
	<option></option>
		<?php
		include('../connect.php');
		
		$result=mysql_query("SELECT empresa_id, empresa_nombre FROM empresa WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<option value="<?php echo $row['empresa_id']; ?>"><?php echo $row['empresa_nombre']; ?></option>
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
