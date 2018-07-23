<?php 
include('../connect.php');
$result=mysql_query("SELECT 
CASE WHEN MAX( correlativo ) +1 > 0
THEN MAX( correlativo ) +1 
ELSE 1
END AS correlativo
FROM  sales 
WHERE MONTH( fecha_factura ) = MONTH( CURDATE( ) )
AND empresa_id = $sesionEmpresaID 
AND `delete`='0'");
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$correlativo = $row['correlativo'];
		}
?>


<script>

	$(document).ready(function(){
		$("#codigoCentro").change(function(){
			$("#nombreCentro").val($("#codigoCentro").val());
		});
	
		$("#nombreCentro").change(function(){
			$("#codigoCentro").val($("#nombreCentro").val());
		});
	
    	$('#codigoCentro').chosen( { width: '250px' } );
	
    	$('#rutCliente').chosen( { width: '450px' } );
		
		$('#sucursalCliente').chosen( { width: '450px' } );



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


    		$("#chofer_rut").blur(function(){
    		    if (Fn.validaRut( $("#chofer_rut").val() )){
    		        //alert("El rut ingresado es válido :D");
    			$("#btnSave").removeClass("disabled").addClass("active");
    		    } else {
    		    	alert("El Rut no es válido, favor revisar");
    		    	//$("#rut").focus();
    			$("#btnSave").removeClass("active").addClass("disabled");
    		    }
    		});


    	$("#transportista_rut").blur(function(){
		    if (Fn.validaRut( $("#transportista_rut").val() )){
		        //alert("El rut ingresado es válido :D");
			$("#btnSave").removeClass("disabled").addClass("active");
		    } else {
		    	alert("El Rut no es válido, favor revisar");
		    	//$("#rut").focus();
			$("#btnSave").removeClass("active").addClass("disabled");
		    }
		});
	
    	
	});
</script>

<script src="../js/application.js" type="text/javascript" charset="utf-8"></script>

<form action="saveventa.php" method="post" id="userForm" name="userForm">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Venta</h4>
    </div>
    <div class="modal-body">
		<div id="ac">

	<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general" name="tabGeneral" id="tabGeneral">General</a></li>
    <? if($tipo==14 || $tipo==15){?>
    <li><a data-toggle="tab" href="#guiadespacho" name="tabGuiadespacho" id="tabGuiadesacho">Detalle</a></li>
    <? }?>
  	</ul>

 			<div class="tab-content">
      			<div id="general" class="tab-pane fade in active">


<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="tipo_documento" id="tipo_documento" value="<?php echo $tipo?>"/>
<input type="hidden" name="forma_pago" id="forma_pago" value="<?php if($tipo==13){echo "1";}?>"/>
<input type="hidden" name="idReferencia2" id="idReferencia2"/>
<input type="hidden" name="rutCliente2hidden" id="rutCliente2hidden"/>
<span>Rut Cliente: <br></span>
<select name="rutCliente" id="rutCliente" class="grande" style="width: 450px;" required <?php if($tipo==13){ echo "readonly";}?>>
<option></option>
	<?php
	include('../connect.php');
	$result = mysql_query("SELECT * FROM customer WHERE empresa_id = $sesionEmpresaID and `delete`='0'");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
	?>
		<option value="<?php echo $row['customer_id'];?>"><?php echo $row['rut'].' - '.$row['customer_name']; ?></option>
	<?php
				}
			?>
</select>
<button type="button" class="btn btn-success btn-xs masCliente" data-dismiss="modal">+</button>
<br /><br />

<!-- sucursal-->
<span>Sucursal Cliente: <br></span>
<div id="resultadoSucursal"></div>
<select id="sucursalCliente" name="sucursalCliente" style="width:450px; " class="grande" required>
<option></option>
</select>
<br /><br />
<!-- fin sucursal-->

<?php if($tipo==12 || $tipo==13){ ?>
<span>N documento : </span><input type="text" style="width:265px; height:30px;" name="iv" id="iv" placeholder="N documento" required/><br>
<br>
<?php }?>

<!--
<span>Direcci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="address" id="address" placeholder="Direcci&oacute;n" required/><br>
<span>Ciudad : </span><input type="text" style="width:265px; height:30px;" name="ciudad" id="ciudad" placeholder="Ciudad" required/><br>
<span>Comuna : </span><input type="text" style="width:265px; height:30px;" name="comuna" id="comuna" placeholder="Comuna" required/><br>
<span>Contacto : </span><input type="text" style="width:265px; height:30px;" name="contact" id="contact" placeholder="Contacto" required/><br>
<span>Tel&eacute;fono : </span><input type="text" style="width:265px; height:30px;" name="phone" id="phone" placeholder="Tel&eacute;fono" required/><br>
<span>Giro : </span><input type="text" style="width:265px; height:30px;" name="prod_name" id="prod_name" placeholder="Giro" required/><br>
-->

<br>

<span>Correlativo: </span><input type="text" style="width:265px; height:30px;" name="correlativo" id="correlativo" value="<?php echo $correlativo; ?>" readonly/><br>
<span>Fecha: <br></span><input type="date" style="width:265px; height:30px;" name="fechaFactura" id="fechaFactura" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
<span>Fecha Vencimiento: <br></span><input type="date" style="width:265px; height:30px;" name="fechaVencimiento" id="fechaVencimiento" placeholder="MM/DD/YYYY" value="<?php echo date('Y-m-d', strtotime('+1 months'))?>" /><br>
<span>Fecha Ingreso: <br></span><input type="date" style="width:265px; height:30px;" name="fechaIngreso" id="fechaIngreso" placeholder="MM/DD/YYYY" value="<?php echo date("Y-m-d");?>" /><br>
<span>Tipo Productos: <br></span>
<select name="tipoProducto" id="tipoProducto" style="width:265px; height:30px;">
	<option>Mercaderia</option>
	<option>Activo Fijo</option>
</select>
<br>

			<span>C&oacute;digo Centro Costo : </span>
            <select name="codigoCentro" id="codigoCentro"  style="width:265px; height:30px; " required>
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT * FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['centro_id']; ?>" <?php if($row['sucursal_id']==$sesionSucursalID){ echo "selected";}?>><?php echo $row['centro_codigo'].' - '.$row['centro_nombre']; ?></option>
                <?php
                }
                ?>
            </select><br>
    	
    	</div>
        <? if($tipo==14 || $tipo==15){?>
		<div id="guiadespacho" class="tab-pane fade">
    		<span>Rut Chofer: </span><input type="text" style="width:265px; height:30px;" name="chofer_rut" id="chofer_rut" /><br>
    		<span>Chofer: </span><input type="text" style="width:265px; height:30px;" name="chofer" id="chofer" /><br>
            <span>Rut Transportista: </span><input type="text" style="width:265px; height:30px;" name="transportista_rut" id="transportista_rut" /><br>
            <span>Transportista: </span><input type="text" style="width:265px; height:30px;" name="transportista" id="transportista" /><br>
            <span>Direcci&oacute;n origen: </span><input type="text" style="width:265px; height:30px;" name="dir_origen" id="dir_origen" /><br>
            <span>Direcci&oacute;n destino: </span><input type="text" style="width:265px; height:30px;" name="dir_destino" id="dir_destino" /><br>
            <span>Ciudad origen: </span><input type="text" style="width:265px; height:30px;" name="ciudad_origen" id="ciudad_origen" /><br>
            <span>Ciudad destino: </span><input type="text" style="width:265px; height:30px;" name="ciudad_destino" id="ciudad_destino" /><br>
            <span>Patente Cami&oacute;n: </span><input type="text" style="width:265px; height:30px;" name="patente_camion" id="patente_camion" /><br>
            <span>Patente Carro: </span><input type="text" style="width:265px; height:30px;" name="patente_carro" id="patente_carro" /><br>
            
            <span>Tipo Traslado : </span>
            <select name="tipo_traslado" id="tipo_traslado"  style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT * FROM tipo_traslado");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['tipo_traslado_code']; ?>"><?php echo $row['tipo_traslado_descripcion']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            
    	</div>
		<? }?>
</div>

</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;" id="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</div>
</form>