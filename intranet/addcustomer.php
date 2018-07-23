<script type="text/javascript">

$(document).ready(function(){
	var Fn = {
	    // Valida el rut con su cadena completa "XXXXXXXX-X"
	    validaRut : function (rutCompleto) {

	    	rutCompleto = rutCompleto.replace(".", "");
	    	
	        if (!/^[0-9]+-[0-9kK]{1}$/.test( rutCompleto ))
	            return false;
            
	        var tmp     = rutCompleto.split('-');
	        var digv    = tmp[1]; 
	        var rut     = tmp[0];
	        if ( digv == 'K' ) digv = 'k' ;
	        return (Fn.dv(rut) == digv );
	    },
	    dv : function(T){
	        var M=0,S=1;
	        for(;T;T=Math.floor(T/10))
	            S=(S+T%10*(9-M++%6))%11;
	        return S?S-1:'k';
	    }
	}


	$("#rut").blur(function(){
	    if (Fn.validaRut( $("#rut").val() )){
	        //alert("El rut ingresado es válido :D");
			$("#btnSave").removeClass("disabled").addClass("active");

			if( $("#memi").val()=='' ){
				
			    var id = $("#rut").val();
			    $.ajax({
					url: 'editcustomer.php?rut=' + id,
					method: 'GET'
			    }).success(function(response) {

					if(response.records[0].customer_name!=''){
						alert("El rut ingresado ya Existe, no es posible volver a crearlo!");
			    		$("#btnSave").removeClass("active").addClass("disabled");
					}else{
						$("#btnSave").removeClass("disabled").addClass("active");
					}
				
			    }).error(function (textStatus, errorThrown){
					alert('Error: ha ocurrido un error: ' + errorThrown);
			    });

			}
	    } else {
	    	alert("El Rut no es válido, favor revisar");
	    	//$("#rut").focus();
			$("#btnSave").removeClass("active").addClass("disabled");
	    }
	    
	});

	$("#permiteDescuento").click(function(){
		var temp = $("#permiteDescuento").prop('checked');
		$("#permiteDescuento").val(temp);
	});
	$("#bloqueado").click(function(){
		var temp = $("#bloqueado").prop('checked');
		$("#bloqueado").val(temp);
	});
	$("#rutlibre").click(function(){
		var temp = $("#rutlibre").prop('checked');
		$("#rutlibre").val(temp);
	});

});
</script>


<form action="savecustomer.php" method="post" id="userForm" name="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Clientes</h4>
      </div>
      <div class="modal-body">
<div id="ac">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#generalCliente" name="tabGeneralCliente" id="tabGeneralCliente">General</a></li>
    <?php if($userposition=='Administrador'){?>
    	<li><a data-toggle="tab" href="#parametrizacion" name="tabParametrizacion" id="tabParametrizacion">Parametrizaci&oacute;n</a></li>
    <?php }?>
  </ul>

  <div class="tab-content">
      <div id="generalCliente" class="tab-pane fade in active">

<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="origen" id="origen" />
<input type="hidden" name="tipo_documento_customer" id="tipo_documento_customer" />

<span>Rut : </span><input type="text" style="width:265px; height:30px;" name="rut" id="rut" placeholder="Rut" Required/><br>
<span>Raz&oacute;n Social: </span>
<input type="text" style="width:265px; height:30px;" name="name" id="name" placeholder="Raz&oacute;n Social" Required/><br>
<span>Direcci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="address" id="address" placeholder="Direcci&oacute;n"/><br>
<span>Ciudad : </span><input type="text" style="width:265px; height:30px;" name="ciudad" id="ciudad" placeholder="Ciudad"/><br>
<span>Comuna : </span><input type="text" style="width:265px; height:30px;" name="comuna" id="comuna" placeholder="Comuna"/><br>
<span>Contacto : </span><input type="text" style="width:265px; height:30px;" name="contact" id="contact" placeholder="Contacto"/><br>
<span>Tel&eacute;fono : </span><input type="text" style="width:265px; height:30px;" name="phone" id="phone" placeholder="Tel&eacute;fono"/><br>
<span>Giro : </span><input type="text" style="width:265px; height:30px;" name="prod_name" id="prod_name" placeholder="Giro" /><br>
<span>E-mail : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
<span>Notas : </span><textarea style="height:60px; width:265px;" name="note" id="note"></textarea><br>
<!-- <span>Fecha Esperada: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br> -->

		</div>
		     
		<?php if($userposition=='Administrador'){?>
		<div id="parametrizacion" class="tab-pane fade">
			<span>Tipo cliente : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Bloqueado : </span><input type="checkbox" name="bloqueado" id="bloqueado" /><br>
            <span>Rut Libre : </span><input type="checkbox" name="rutlibre" id="rutlibre" /><br>
            <span>Permite descuento : </span><input type="checkbox" name="permiteDescuento" id="permiteDescuento" /><br>
            <span>Porcentaje M&aacute;ximo : </span><input type="text" style="width:265px; height:30px;" name="porc_max" id="porc_max" placeholder="% M&aacute;ximo" /><br>
            <span>Saldo m&aacute;ximo : </span><input type="text" style="width:265px; height:30px;" name="saldo_max" id="saldo_max" placeholder="Saldo M&aacute;ximo" /><br>
            <!-- <span>Vendedor cartera : </span><input type="text" style="width:265px; height:30px;" name="vendedor_cartera2" id="vendedor_cartera2" placeholder="Vendedor cartera" /><br> -->
            
            
            <span>Vendedor Cartera: <br></span>
			<select name="vendedor_cartera" id="vendedor_cartera" style="width: 250px;" required >
			<option></option>
				<?php
				include('../connect.php');
				$result = mysql_query("SELECT id, name FROM user WHERE empresa_id = $sesionEmpresaID and sucursal_id = $sesionSucursalID and `delete`='0'");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				?>
					<option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
				<?php
				}
				?>
			</select>
            
            
		</div>
		<?php }?>

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