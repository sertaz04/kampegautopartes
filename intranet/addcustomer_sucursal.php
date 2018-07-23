<script type="text/javascript">

$(document).ready(function(){
	$('#rutCliente').chosen( { width: '450px' } );
});
</script>


<form action="savecustomer_sucursal.php" method="post" id="userForm" name="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sucursal de Clientes</h4>
      </div>
      <div class="modal-body">
<div id="ac">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#generalCliente" name="tabGeneralCliente" id="tabGeneralCliente">General</a></li>
  </ul>

  <div class="tab-content">
      <div id="generalCliente" class="tab-pane fade in active">

<input type="hidden" name="memi" id="memi" />
<span>Rut Cliente: <br></span>
<select name="rutCliente" id="rutCliente" class="grande" style="width: 450px;" required >
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

<span>Direcci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="direccion" id="direccion" placeholder="Direcci&oacute;n"/><br>
<span>Ciudad : </span><input type="text" style="width:265px; height:30px;" name="ciudad" id="ciudad" placeholder="Ciudad"/><br>
<span>Comuna : </span><input type="text" style="width:265px; height:30px;" name="comuna" id="comuna" placeholder="Comuna"/><br>
<span>Contacto : </span><input type="text" style="width:265px; height:30px;" name="contacto" id="contacto" placeholder="Contacto"/><br>
<span>Tel&eacute;fono : </span><input type="text" style="width:265px; height:30px;" name="telefono" id="telefono" placeholder="Tel&eacute;fono"/><br>
<span>E-mail : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
<!-- <span>Fecha Esperada: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br> -->

		</div>
		
</div>
</div>
</div>
     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;" id="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>

</form>