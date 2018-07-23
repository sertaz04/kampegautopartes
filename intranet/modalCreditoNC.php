
<script>
function revisarTotal(){
	if(parseInt($("#montoMaximoPago4").val()) < parseInt($("#monto4").val())){
		alert("EL MONTO MAXIMO DE PAGO ES : " + $("#montoMaximoPago4").val() + "\n Se actualizara el monto del pago.");
		$("#monto4").val($("#montoMaximoPago4").val());
	}

}

function validaSumaCheckNC(elemento){
	
	$listadoIdsNC = $("#listadoIdsListaNC").val();
	$totalDeuda = parseInt(0+$("#montoNC5").val());
	
	if(elemento.checked){
		if($listadoIdsNC!=''){
			$listadoIdsNC += ','
		}
		$listadoIdsNC += elemento.getAttribute("data-id");
		$totalDeuda += parseInt(elemento.value);
	}else{
		$listadoIdsNC = $listadoIdsNC.replace(elemento.getAttribute("data-id"), "-1");
		$totalDeuda -= parseInt(elemento.value);
	}
	
	$("#listadoIdsListaNC").val($listadoIdsNC);
	$("#montoNC5").val($totalDeuda);
	
}
</script>

<div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Listado Notas de cr&eacute;dito disponibles</h4>
	</div>
	<div class="modal-body">

		<div id="acLista">
				
		</div>

		
		<div id="ac">
			<form action="saveCreditoPagoNC.php" method="post" id="formPagoCreditoNC" name="formPagoCreditoNC">

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#general" name="tabGeneral" id="tabGeneral">General</a></li>
				</ul>

				<div class="tab-content">
					<div id="general" class="tab-pane fade in active">

						<input type="hidden" name="listadoIdsPago4" id="listadoIdsPago4" />
						<input type="hidden" name="cliente_id4" id="cliente_id4"/>
						<input type="hidden" name="tipo_pago4" id="tipo_pago4" />
						<input type="hidden" name="listadoIdsListaNC" id="listadoIdsListaNC" />
						<span>Rut Cliente:</span><input type="text" style="width:265px; height:30px;" name="customer_rut4" id="customer_rut4" placeholder="Rut" readonly/><br>
						<span>Nombre Cliente : </span><input type="text" style="width:265px; height:30px;" name="customer_name4" id="customer_name4" placeholder="Nombre" readonly/><br>
						<span>Fecha Pago : </span><input type="date" style="width:265px; height:30px;" name="fecha_pago4" id="fecha_pago4" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" readonly/><br>
						<span>Monto Nota Cr&eacute;dito: </span><input type="text" style="width:265px; height:30px;" name="montoNC5" id="montoNC5" placeholder="Monto" required readonly/><br>
						<span>Monto : </span><input type="text" style="width:265px; height:30px;" name="monto4" id="monto4" placeholder="Monto" required /><br>
						<span>Observaciones : </span><textarea style="width:265px; height:120px;" name="observaciones4" id="observaciones4" placeholder="Observaciones"></textarea><br>
					</div>
				</div>

				 <div class="modal-footer">
					 <div style="float:right; margin-right:10px;">
						<button class="btn btn-success btn-block btn-large" style="width:267px;" id="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
					 </div>
				 </div>
			</form>
		</div>
		
		
		<div class="modal-footer">
			<div style="float:right; margin-right:10px;">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>

	</div>
</div>
