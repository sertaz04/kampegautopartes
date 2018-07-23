<form action="savecheque.php" method="post" id="userFormCheque">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cheque</h4>
      </div>
      <div class="modal-body">

<div id="ac">
<input type="hidden" name="id_cheque" id="id_cheque" />
<input type="hidden" name="transaction_id" id="transaction_id" />
<input type="hidden" name="forma_pago" id="forma_pago" />
<input type="hidden" name="customer_id" id="customer_id" />
<input type="hidden" name="tipo" id="tipo" />

<span>Fecha: <br></span>
<input type="date" style="width:265px; height:30px;" name="fecha" id="fecha" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
<span>N&uacute;mero Cheque : </span>
<input type="text" style="width:265px; height:30px;" name="numeroCheque" id="numeroCheque" ><br>
<span>Banco : </span>
<select name="banco" id="banco" style="width: 250px;" required >
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

<span>Fecha Pago : </span>
<input type="date" style="width:265px; height:30px;" name="fechaPago" id="fechaPago" placeholder="Fecha"/><br>
<span>Monto : </span>
<input type="text" style="width:265px; height:30px;" name="monto" id="monto" ><br>
</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>
