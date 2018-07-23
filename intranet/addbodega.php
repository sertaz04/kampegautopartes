<form action="savebodega.php" method="post" id="userForm">

<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bodega</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span>Nombre Bodega : </span>
	<input type="text" style="width:265px; height:30px;" name="nombre" id="nombre" placeholder="Nombre Bodega" required/>
    <br>
	<span>Capacidad: </span>
	<input type="text" style="width:265px; height:30px;" name="capacidad" id="capacidad" placeholder="Capacidad" required/>
    <br>
	<span>Empresa: </span>
	<select id="empresa" name="empresa"  style="width:265px; height:30px; margin-left:-5px;" >
<option></option>
	<?php
	include('../connect.php');
	
	$result=mysql_query("SELECT empresa_id, empresa_nombre FROM empresa WHERE empresa_id = $sesionEmpresaID and `delete`='0'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	?>
		<option value="<?php echo $row['empresa_id']; ?>"><?php echo $row['empresa_nombre']; ?></option>
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