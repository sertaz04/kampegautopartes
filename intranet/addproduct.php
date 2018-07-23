 <script>
 
	$(document).ready(function(){
		$("#marginsale").change(function(){
			$("#pricesale").val( parseInt($("#lastcost").val()) + (parseInt($("#lastcost").val()*$("#marginsale").val()/100)));
		});
	});
	
	$(document).ready(function(){
		$("#pricesale").change(function(){
			$("#marginsale").val( ( parseInt($("#pricesale").val())-parseInt($("#lastcost").val()) )*100 / $("#lastcost").val() );
		});
	});
	
	$(document).ready(function(){
		$("#marginspecial").change(function(){
			$("#pricespecial").val( parseInt($("#lastcost").val()) + (parseInt($("#lastcost").val()*$("#marginspecial").val()/100)));
		});
	});
	
	$(document).ready(function(){
		$("#pricespecial").change(function(){
			$("#marginspecial").val( ( parseInt($("#pricespecial").val())-parseInt($("#lastcost").val()) )*100 / $("#lastcost").val() );
		});
	});
	//ultimo costo
	$(document).ready(function(){
		$("#lastcost").change(function(){
			$("#pricesale").val( parseInt($("#lastcost").val()) + (parseInt($("#lastcost").val()*$("#marginsale").val()/100)));
			$("#pricespecial").val( parseInt($("#lastcost").val()) + (parseInt($("#lastcost").val()*$("#marginspecial").val()/100)));
		});
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
	$(document).ready(function(){
		$("#tabGeneral").click(function(){
			$("#btnSave").removeClass("active").addClass("disabled");
		});
	});
	
	$(document).ready(function(){
		$("#codecenter").change(function(){
			$("#namecenter").val($("#codecenter").val());
		});
	});
	$(document).ready(function(){
		$("#namecenter").change(function(){
			$("#codecenter").val($("#namecenter").val());
		});
	});
 	
 </script>
 
 
 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Productos</h4>
      </div>
      <div class="modal-body">
        
       
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveproduct.php" method="post" id="userForm">
<?php
$iv=$_GET['iv'];
$sp=$_GET['sp'];
?>

<div id="ac">
<input type="hidden" value="<? echo $iv?>" name="iv" />
<input type="hidden" value="<? echo $sp?>" name="sp" />
<input type="hidden" value="" name="origen" />
<input type="hidden" name="memi" id="memi" />
<input type="hidden" name="tipo_documento" id="tipo_documento" />

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general" name="tabGeneral" id="tabGeneral">General</a></li>
    <li><a data-toggle="tab" href="#costos" name="tabCosto" id="tabCosto">Costos</a></li>
    <li><a data-toggle="tab" href="#detalle" name="tabDetalle" id="tabDetalle">Detalle</a></li>
	<li><a data-toggle="tab" href="#inventario" name="tabInventario" id="tabInventario">Inventario</a></li>
  </ul>


  <div class="tab-content">
      <div id="general" class="tab-pane fade in active">
        
            <span>Grupo : </span>
            <select name="group" id="group"  style="width:265px; height:30px;" >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT group_id, group_name FROM `group` WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['group_id']; ?>"><?php echo $row['group_name']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Familia: </span>
            <select name="family" id="family" style="width:265px; height:30px; " required >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT family_id, family_name FROM family WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['family_id']; ?>"><?php echo $row['family_name']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Subfamilia : </span>
            <select name="subfamily" id="subfamily"  style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT subfamily_id, subfamily_name FROM subfamily WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['subfamily_id']; ?>"><?php echo $row['subfamily_name']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>C&oacute;digo Producto: </span><input type="text" style="width:265px; height:30px;" name="code" id="code" Required/><br>
            
            <span>Descripci&oacute;n : </span><input type="text" style="width:265px; height:30px;" name="name" id="name" Required/><br>
            
            <span>C&oacute;digo Bara: </span><input type="text" style="width:265px; height:30px;" name="codebar" id="codebar" Required/><br>
            
            <span>Comprar en Unidad: </span>
            <select name="unit_purchase" id="unit_purchase"> 
            <option>Existencia</option>
            <option>Peso</option>
            </select><br>
            
            <span>Vender en Unidad: </span>
            <select name="unit_sale" id="unit_sale"> 
            <option>Existencia</option>
            <option>Peso</option>
            </select><br>
        
      </div>
      <div id="costos" class="tab-pane fade">
            <span>Costo promedio: </span><input type="text" style="width:265px; height:30px;" name="avgcost" id="avgcost" Required/><br>
            
            <span>&Uacute;ltimo costo: </span><input type="text" style="width:265px; height:30px;" name="lastcost" id="lastcost" Required/><br>
            
            <span>Margen venta p&uacute;blico: </span><input type="text" style="width:265px; height:30px;" name="marginsale" id="marginsale" Required/>%<br>
            
            <span>Precio venta p&uacute;blico: </span><input type="text" style="width:265px; height:30px;" name="pricesale" id="pricesale" Required/><br>
            
            <span>Margen venta especial: </span><input type="text" style="width:265px; height:30px;" name="marginspecial" id="marginspecial" Required/>%<br>
            
            <span>Precio venta especial: </span><input type="text" style="width:265px; height:30px;" name="pricespecial" id="pricespecial" Required/><br>
            
            <span>Origen de producto: </span>
            <select name="originproduct" id="originproduct"> 
            <option>Nacional</option>
            <option>Importado</option>
            </select><br>
            
            <span>C&oacute;digo gen&eacute;rico: </span>
            <input type="text" style="width:265px; height:30px;" name="genericcode" id="genericcode" Required/><br>
            
            <span>Descuento m&aacute;ximo: </span>
            <input type="text" style="width:265px; height:30px;" name="maxdescount" id="maxdescount" Required/>
            %<br>
      </div>
      <div id="detalle" class="tab-pane fade">
            <span>Observaciones: </span>
            <textarea style="height:70px; width:265px;" name="details" id="details"></textarea>
            <br>
            
            <span>C&oacute;digo cuenta: </span>
            <input type="text" style="width:265px; height:30px;" name="codeaccount" id="codeaccount" Required/>
            <br>
            
            <span>Nombre cuenta: </span>
            <input type="text" style="width:265px; height:30px;" name="nameaccount" id="nameaccount" Required/>
            <br>
            
             <span>C&oacute;digo Centro Costo : </span>
            <select name="codecenter" id="codecenter"  style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT centro_id, centro_codigo FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['centro_id']; ?>"><?php echo $row['centro_codigo']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Nombre Centro Costo : </span>
            <select name="namecenter" id="namecenter"  style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT centro_id, centro_nombre FROM centro_costo WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['centro_id']; ?>"><?php echo $row['centro_nombre']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Inmovilizado: </span>
            <input type="checkbox" name="inmovilizado" id="inmovilizado" />
            <br>
            
            <span>Producto Inventariable: </span>
            <input type="checkbox" name="inventariable" id="inventariable" checked="true"/>
            <br>      
       </div>
			
	   <div id="inventario" class="tab-pane fade">
			<span>Bodega : </span>
            <select name="bodega" id="bodega"  style="width:265px; height:30px;" >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT bodega_id, bodega_nombre FROM bodega WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['bodega_id']; ?>"><?php echo $row['bodega_nombre']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Secci&oacute;n: </span>
            <select name="seccion" id="seccion" style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT seccion_id, ubicacion FROM seccion WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['seccion_id']; ?>"><?php echo $row['ubicacion']; ?></option>
                <?php
                }
                ?>
            </select><br>
            
            <span>Subsecci&oacute;n : </span>
            <select name="subseccion" id="subseccion"  style="width:265px; height:30px; " >
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT subseccion_id, subseccion_nombre FROM subseccion WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['subseccion_id']; ?>"><?php echo $row['subseccion_nombre']; ?></option>
                <?php
                }
                ?>
            </select><br>
	   </div>
  </div>

      </div>
      <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large disabled" style="width:267px;" id="btnSave" name="btnSave"><i class="icon icon-save icon-large"></i> Guardar</button>
      </div>
    </div>
    

</div>
</div>
</form>