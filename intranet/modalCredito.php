<?php 
include('../connect.php');
?>


<script>

</script>

<script src="../js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="saveCreditoPago.php" method="post" id="formPagoCredito" name="formPagoCredito">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pago Facturas</h4>
    </div>
    <div class="modal-body">
		<div id="ac">

			<ul class="nav nav-tabs">
		    	<li class="active"><a data-toggle="tab" href="#general" name="tabGeneral" id="tabGeneral">General</a></li>
		  	</ul>

 			<div class="tab-content">
      			<div id="general" class="tab-pane fade in active">

		
					<input type="hidden" name="listadoIdsPago" id="listadoIdsPago" />
					<input type="hidden" name="cliente_id" id="cliente_id"/>
					<input type="hidden" name="tipo_pago" id="tipo_pago" />
					<span>Rut Cliente:</span><input type="text" style="width:265px; height:30px;" name="customer_rut" id="customer_rut" placeholder="Rut" readonly/><br>
					<span>Nombre Cliente : </span><input type="text" style="width:265px; height:30px;" name="customer_name" id="customer_name" placeholder="Nombre" readonly/><br>
					<span>Fecha Pago : </span><input type="date" style="width:265px; height:30px;" name="fecha_pago" id="fecha_pago" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" readonly/><br>
					<span>Monto : </span><input type="text" style="width:265px; height:30px;" name="monto" id="monto" placeholder="Monto" required readonly/><br>
					<span>Observaciones : </span><textarea style="width:265px; height:120px;" name="observaciones" id="observaciones" placeholder="Observaciones"></textarea><br>
				</div>
			</div>

		     <div class="modal-footer">
		      	 <div style="float:right; margin-right:10px;">
					<button class="btn btn-success btn-block btn-large" style="width:267px;" id="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
		      	 </div>
		     </div>

		</div>
	</div>
</div>
</form>