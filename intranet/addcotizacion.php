<form action="savecustomer.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cotizaciones</h4>
      </div>
      <div class="modal-body">
<div id="ac">
<input type="hidden" name="memi" id="memi" />
<span>Descripci&oacute;n: </span><input type="text" style="width:265px; height:30px;" name="cotizacion_name" id="cotizacion_name" placeholder="Nombre" Required/><br>
<span>Cliente: </span>
<select name="customer_id" id="customer_id">
	<option></option>
		<?php
		include('../connect.php');
		
		$result=mysql_query("SELECT customer_id, customer_name FROM customer where empresa_id = $sesionEmpresaID and `delete`='0'");	    
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<option value="<?php echo $row['customer_id']; ?>"><?php echo $row['customer_name']; ?></option>
		<?php
		}
		?>
</select><button type="button" class="btn btn-success btn-xs masCliente" data-dismiss="modal">+</button>
<br>

<span>Fecha: </span>
<input type="date" style="width:265px; height:30px;" name="cotizacion_fecha" id="cotizacion_fecha" placeholder="MM/DD/YYYY" value="<?php echo date("d-m-Y");?>" /><br>
</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>