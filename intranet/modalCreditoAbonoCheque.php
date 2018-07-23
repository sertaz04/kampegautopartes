<?php 
include('../connect.php');
?>


<script>
function revisarTotalAbonoCheque(){
	if(parseInt($("#montoMaximoPago5").val()) < parseInt($("#monto5").val())){
		alert("EL MONTO MAXIMO DE PAGO ES : " + $("#montoMaximoPago5").val() + "\n Se actualizara el monto del pago.");
		$("#monto5").val($("#montoMaximoPago5").val());
	}

}
</script>

<script src="../js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="saveCreditoPagoAbonoCheque.php" method="post" id="formPagoCredito" name="formPagoCredito">
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

		
					<input type="hidden" name="listadoIdsPago5" id="listadoIdsPago5" />
					<input type="hidden" name="montoMaximoPago5" id="montoMaximoPago5" />
					<input type="hidden" name="cliente_id5" id="cliente_id5"/>
					<input type="hidden" name="tipo_pago5" id="tipo_pago5" />
					<span>Rut Cliente:</span><input type="text" style="width:265px; height:30px;" name="customer_rut5" id="customer_rut5" placeholder="Rut" readonly/><br>
					<span>Nombre Cliente : </span><input type="text" style="width:265px; height:30px;" name="customer_name5" id="customer_name5" placeholder="Nombre" readonly/><br>
					<span>Fecha Pago : </span><input type="date" style="width:265px; height:30px;" name="fecha_pago5" id="fecha_pago5" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" readonly/><br>
					<span>Monto : </span><input type="text" style="width:265px; height:30px;" name="monto5" id="monto5" placeholder="Monto" onblur="revisarTotalAbonoCheque();" /><br>
					
					<span>N Cheque: </span><input type="text" style="width:265px; height:30px;" name="numero_cheque5" id="numero_cheque5" placeholder="Numero Cheque" required/><br>
					<span>Banco : </span>
					
					<select name="banco_id5" id="banco_id5" style="width: 250px;" required >
								<option></option>
									<?php
									include('../connect.php');
									$result = mysql_query("SELECT * FROM bancos");
									while($row = mysql_fetch_array($result, MYSQL_ASSOC))
									{
									?>
										<option value="<?php echo $row['banco_id'];?>"><?php echo $row['banco_name']; ?></option>
									<?php
												}
											?>
					</select>
					<span>Fecha Cheque : </span><input type="date" style="width:265px; height:30px;" name="fecha_cheque5" id="fecha_cheque5" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
					
					<span>Observaciones : </span><textarea style="width:265px; height:120px;" name="observaciones5" id="observaciones5" placeholder="Observaciones"></textarea><br>
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