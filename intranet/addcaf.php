	<?php
	include('../connect.php');
	?>
	
		<?php
	
	$result=mysql_query("SELECT RUTEmisor FROM DTE_informacionEmpresas where CodEmpresa='$sesionEmpresaID'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
  			$rutEmpresa= str_replace(".", "", $row['RUTEmisor']); 
	}
	?>
<form action="savecaf.php" method="post" enctype="multipart/form-data" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Talonario Electr&oacute;nico (CAF) </h4>
      </div>
      <div class="modal-body">

<div id="ac">
<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="rut" id="rut" value="<?php echo $rutEmpresa; ?>" />
<span>Rut Empresa  : </span>
<label>
 <input type="text" style="width:265px; height:30px;"  name="rutEmisor2" value="<?php echo $rutEmpresa; ?>" disabled="disabled" />
 </label>
<span>Tipo DTE: </span>
<select name="tipoDocto" id="tipoDocto"  style="width:265px; height:30px; margin-left:-5px;" placeholder="Tipo DTE" required>
<option></option>
	<?php
	
	$result=mysql_query("SELECT IdTipoDoc, NombreDoc FROM DTE_TipoDocumentos");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	?>
		<option value="<?php echo $row['IdTipoDoc']; ?>"><?php echo $row['NombreDoc']; ?></option>
	<?php
	}
	?>
</select>
<span>Archivo CAF XML  : </span>


<label>
<input type="file" name="xmlCaf" required/>
</label>
<span>&Uacute;ltimo Folio : </span>
<input type="text" style="width:265px; height:30px;" name="ultimoFolio" id="ultimoFolio" placeholder="Ultimo Folio" required/>
</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
   	   </div>
     </div>

</div>
</form>
