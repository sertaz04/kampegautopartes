<?php 
include('../connect.php');
?>


<script>

</script>

<script src="../js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="saveCreditoPagoCheque.php" method="post" id="formPagoChequeCredito" name="formPagoChequeCredito">
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

					<input type="hidden" name="listadoIdsPago2" id="listadoIdsPago2" />
					<input type="hidden" name="memi" id="memi" />
					<input type="hidden" name="cliente_id2" id="cliente_id2" />
					<input type="hidden" name="tipo_pago2" id="tipo_pago2" />
					<span>Rut Cliente:</span><input type="text" style="width:265px; height:30px;" name="customer_rut2" id="customer_rut2" placeholder="Rut" readonly/><br>
					<span>Nombre Cliente : </span><input type="text" style="width:265px; height:30px;" name="customer_name2" id="customer_name2" placeholder="Nombre" readonly/><br>
					<span>Fecha Pago : </span><input type="date" style="width:265px; height:30px;" name="fecha_pago2" id="fecha_pago2" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" readonly/><br>
					<span>Monto : </span><input type="text" style="width:265px; height:30px;" name="monto2" id="monto2" placeholder="Monto" required readonly /><br>
					
					<span>N Cheque: </span><input type="text" style="width:265px; height:30px;" name="numero_cheque2" id="numero_cheque2" placeholder="Numero Cheque" required/><br>
					<span>Banco : </span>
					
					<select name="banco_id2" id="banco_id2" style="width: 250px;" required >
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
					<span>Fecha Cheque : </span><input type="date" style="width:265px; height:30px;" name="fecha_cheque2" id="fecha_cheque2" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
					
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