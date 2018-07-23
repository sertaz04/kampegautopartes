<form action="saveempresa.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Empresa</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span>Nombre empresa : </span>
	<input type="text" style="width:265px; height:30px;" name="nombre" id="nombre" placeholder="Nombre Empresa" required/>
    <br>
	<span>Rut: </span>
	<input type="text" style="width:265px; height:30px;" name="rut" id="rut" placeholder="Rut" required/>
    <br>
	<span>Direcci&oacute;n: </span>
	<input type="text" style="width:265px; height:30px;" name="direccion" id="direccion" placeholder="Direcci&oacute;n" required/>	
    <br>
	<span>Tel&eacute;fono: </span>
    <input type="text" style="width:265px; height:30px;" name="telefono" id="telefono" placeholder="Tel&eacute;fono" required/>
    <br>
	<span>Representante Legal: </span>
    <input type="text" style="width:265px; height:30px;" name="representante_legal" id="representante_legal" placeholder="Representante legal" required/>
    <br>
    
    </div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>