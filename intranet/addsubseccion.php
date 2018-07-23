<form action="savesubseccion.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Subsecci&oacute;n</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span>Nombre Subsecci&oacute;n : </span>
	<input type="text" style="width:265px; height:30px;" name="subseccion_nombre" id="subseccion_nombre" placeholder="Nombre" required/>
    <br>
	
	<span>Bodega: </span>
	<select id="bodega" name="bodega"  style="width:265px; height:30px; margin-left:-5px;" >
<option></option>
	<?php
	include('../connect.php');
	
	$result=mysql_query("SELECT bodega_id, bodega_nombre FROM bodega WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	?>
		<option value="<?php echo $row['bodega_id']; ?>"><?php echo $row['bodega_nombre']; ?></option>
	<?php
	}
	?>
</select>
    <br>
	
	<span>Secci&oacute;n: </span>
	<select id="seccion" name="seccion"  style="width:265px; height:30px; margin-left:-5px;" >
<option></option>
	<?php
	include('../connect.php');
	
	$result=mysql_query("SELECT seccion_id, ubicacion FROM seccion WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	?>
		<option value="<?php echo $row['seccion_id']; ?>"><?php echo $row['ubicacion']; ?></option>
	<?php
	}
	?>
</select>
    <br>
    
    </div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>