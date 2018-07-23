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
	        //alert("El rut ingresado es v�lido :D");
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
	    	alert("El Rut no es v�lido, favor revisar");
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


<form action="savepersonal.php" method="post" id="userForm" name="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Personas</h4>
      </div>
      <div class="modal-body">
<div id="ac">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#datosPersonales" name="tabDatosPersonales" id="tabDatosPersonales">Datos Personales</a></li>
    <li><a data-toggle="tab" href="#datosLaborales" name="tabDatosLaborales" id="tabParametrizacion">Datos Laborales</a></li>
    <li><a data-toggle="tab" href="#previsionSalud" name="tabPrevisionSalud" id="tabPrevisionSalud">Previsi&oacute;n y Salud</a></li>
    <li><a data-toggle="tab" href="#apviApvc" name="tabApviApvc" id="tabApviApvc"> APVI- APVC</a></li>
  </ul>

  <div class="tab-content">
        <div id="datosPersonales" class="tab-pane fade in active">
            <input type="hidden" name="memi" id="memi" />
            <input type="hidden" name="origen" id="origen" />

            <span>Rut : </span><input type="text" style="width:265px; height:30px;" name="rut" id="rut" placeholder="Rut" Required/><br>
            <span>Nombre : </span><input type="text" style="width:265px; height:30px;" name="name" id="name" placeholder="Raz&oacute;n Social" Required/><br>
            <span>A. Paterno : </span><input type="text" style="width:265px; height:30px;" name="address" id="address" placeholder="Direcci&oacute;n"/><br>
            <span>A. Materno : </span><input type="text" style="width:265px; height:30px;" name="ciudad" id="ciudad" placeholder="Ciudad"/><br>
            <span>Direcci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="comuna" id="comuna" placeholder="Comuna"/><br>
            <span>Comuna : </span><input type="text" style="width:265px; height:30px;" name="contact" id="contact" placeholder="Contacto"/><br>
            <span>Ciudad : </span><input type="text" style="width:265px; height:30px;" name="phone" id="phone" placeholder="Tel&eacute;fono"/><br>
            <span>Tel&eacute;fono : </span><input type="text" style="width:265px; height:30px;" name="prod_name" id="prod_name" placeholder="Giro" /><br>
            <span>Celular : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>E-Mail : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>Sexo : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>Fecha Nacimiento: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br>
            <span>Cargo : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>T&iacute;tulo : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>Secci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>Nacionalidad : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>Banco : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>
            <span>N Cuenta Deposito : </span><input type="text" style="width:265px; height:30px;" name="email" id="email" placeholder="E-Mail" /><br>

            <!-- <span>Fecha Esperada: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br> -->

        </div>
		     
		<div id="datosLaborales" class="tab-pane fade">
			<span>Fecha Ingreso: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br>
            <span>Fecha Retiro: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br>
            <span>Fecha Renovaci&oacute;n: </span><input type="date" style="width:265px; height:30px;" name="date" id="date" placeholder="Fecha"/><br>

            <span>Hrs Semanales : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>D&iacute;as semanales : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Sueldo Base Mansual : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

            <span>N Cargas Familiares : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Suedo prom 6 meses : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Gratificación Zona : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>% Reajuste Zona : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            
		</div>

        <div id="previsionSalud" class="tab-pane fade">
            <span>AFP : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Cotizaci&oacute;n obligatoria : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>SIS : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro voluntario : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

            <span>Afiliado a Fonasa : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>% Cotiz : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>ISAPRE : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Valor del plan en UF : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Adicional Auge(ley 19966) en UF : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Valor del plan en Pesos : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

            <span>Tomar seguro de desempleo : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Contrato plazo fijo, obra o faena : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Solo F. C. Solidario : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

            <span>RUT : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Nombres : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>A. Paterno : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>A. Materno : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>AFP : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Cotizaci&oacute;n voluntaria : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro Voluntario : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Cesa Ctoizaci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

        </div>

        <div id="apviApvc" class="tab-pane fade">

            <span>Institución APV : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>N Contrato : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro en pesos : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro en UF : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Dep. Convenidos : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Tributabe : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

            <span>Institución APV 2 : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>N Contrato : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro en pesos : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Ahorro en UF : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Dep. Convenidos : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>
            <span>Tributabe : </span><input type="text" style="width:265px; height:30px;" name="tipo_cliente" id="tipo_cliente" placeholder="Tipo Cliente" /><br>

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