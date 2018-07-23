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


	$("#suplier_rut").blur(function(){
	    if (Fn.validaRut( $("#suplier_rut").val() )){
	        //alert("El rut ingresado es válido :D");
			$("#btnSave").removeClass("disabled").addClass("active");

			if( $("#memi").val()=='' ){
				
			    var id = $("#suplier_rut").val();
			    $.ajax({
					url: 'editsupplier.php?rut=' + id,
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
	    	//$("#suplier_rut").focus();
		$("#btnSave").removeClass("active").addClass("disabled");
	    }
	});
	
	$(document).ready(function(){
		$("#tabDetalle").click(function(){
			$("#btnSave").removeClass("disabled").addClass("active");
		});
	});
	$(document).ready(function(){
		$("#tabCosto").click(function(){
			$("#btnSave").removeClass("active").addClass("disabled");
		});	
	});

});
</script>
<form action="savesupplier.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Proveedor</h4>
      </div>
      <div class="modal-body">

<div id="ac">
<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="origen" id="origen" />
<input type="hidden" name="tipo_documento" id="tipo_documento" />

<span>Rut Proveedor : </span><input type="text" style="width:265px; height:30px;" name="suplier_rut" id="suplier_rut" placeholder="##.###.###-#" required/><br>
<span>Nombre Fantas&iacute;a: </span><input type="text" style="width:265px; height:30px;" name="suplier_name" id="suplier_name" /><br>
<span>Raz&oacute;n Social: </span><input type="text" style="width:265px; height:30px;" name="suplier_namefantasia" id="suplier_namefantasia" /><br>
<span>Direcci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="suplier_address" id="suplier_address" /><br>
<span>Ciudad : </span><input type="text" style="width:265px; height:30px;" name="suplier_ciudad" id="suplier_ciudad" /><br>
<span>Comuna : </span><input type="text" style="width:265px; height:30px;" name="suplier_comuna" id="suplier_comuna" /><br>
<span>Tel&eacute;fono : </span><input type="text" style="width:265px; height:30px;" name="suplier_contact" id="suplier_contact" /><br>
<span>Persona de contacto : </span><input type="text" style="width:265px; height:30px;" name="contact_person" id="contact_person" /><br>
<span>Giro : </span><input type="text" style="width:265px; height:30px;" name="suplier_giro" id="suplier_giro" /><br>
<span>E-Mail : </span><input type="text" style="width:265px; height:30px;" name="suplier_email" id="suplier_email" /><br>
<span>Notas : </span><textarea style="width:265px; height:80px;" name="note" id="note" /></textarea><br>

</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;" id="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>

</form>