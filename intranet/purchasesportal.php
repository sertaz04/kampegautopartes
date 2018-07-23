<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
<?php
	require_once('auth.php');
	
	$id=$_GET['iv'];
	$suplier=$_GET['sp'];
?>

<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}

function validateForm() {
    var x = document.forms["myForm"]["qty"].value;
    if (x == null || x == "") {
        alert("Debe ingresar cantidad de elementos para el producto ingresado");
        return false;
    }
}

		$(document).ready(function(){
			$("#myBtn").click(function(){
				
				$("#memi").val('');
				$("#group").val('');
				$("#family").val('');
				$("#subfamily").val('');
				$("#code").val('');
				$("#name").val('');
				$("#codebar").val('');
				$("#unit_purchase").val('');
				$("#unit_sale").val('');
				$("#avgcost").val('');
				$("#lastcost").val('');
				$("#marginsale").val('');
				$("#pricesale").val('');
				$("#marginspecial").val('');
				$("#pricespecial").val('');
				$("#orginproduct").val('');
				$("#genericcode").val('');
				$("#maxdescount").val('');
				$("#details").val('');
				$("#codeaccount").val('');
				$("#nameaccount").val('');
				$("#codecenter").val('');
				$("#namecenter").val('');
				$("#inmovilizado").val('');
				$("#inventariable").val('');
				$("#origen").val('compras');
				$("#iv").val('<? echo $_GET['iv']; ?>');
				$("#sp").val('<? echo $_GET['sp']; ?>');
				
				
				$("#userForm").attr("action", "saveproduct.php");
				$("#myModal").modal();
			});
		});
		
		$(document).ready(function(){
			$("#myBtnGuardar").click(function(){

				var form = document.createElement("form");
				form.setAttribute("method", "POST");
				form.setAttribute("action", "saveitemtodoCompra.php");

								
				$("[id*=qty]").each(
					function(index, value) {

						var hiddenField = document.createElement("input");
						hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", $(this).attr('name'));
			            hiddenField.setAttribute("value", $(this).val());
						form.appendChild(hiddenField);	
					}
				);
				$("[id*=cost]").each(
						function(index, value) {

							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
				            hiddenField.setAttribute("name", $(this).attr('name'));
				            hiddenField.setAttribute("value", $(this).val());
							form.appendChild(hiddenField);
								
						}
				);
				$("[id*=descuento]").each(
						function(index, value) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
				            hiddenField.setAttribute("name", $(this).attr('name'));
				            hiddenField.setAttribute("value", $(this).val());
							form.appendChild(hiddenField);	
						}
				);
				$("[id*=compras]").each(
						function(index, value) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
				            hiddenField.setAttribute("name", $(this).attr('name'));
				            hiddenField.setAttribute("value", $(this).val());
							form.appendChild(hiddenField);	
						}
				);
				$("[id*=id-]").each(
						function(index, value) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
				            hiddenField.setAttribute("name", $(this).attr('name'));
				            hiddenField.setAttribute("value", $(this).val());
							form.appendChild(hiddenField);
							if(document.getElementById("strIds").value!=""){
								document.getElementById("strIds").value+="|";
							}
							document.getElementById("strIds").value+=$(this).val();
						}
				);
				$("[id*=invoice]").each(
						function(index, value) {
							var hiddenField = document.createElement("input");
							hiddenField.setAttribute("type", "hidden");
				            hiddenField.setAttribute("name", $(this).attr('name'));
				            hiddenField.setAttribute("value", $(this).val());
							form.appendChild(hiddenField);
						}
				);

				//form.appendChild(document.getElementById("formaPago"));
				form.appendChild(document.getElementById("observaciones"));
				form.appendChild(document.getElementById("adicional"));
				form.appendChild(document.getElementById("suplier_id"));
				form.appendChild(document.getElementById("idInvoice"));
				form.appendChild(document.getElementById("strIds"));
				
				//solucion problema not connect chrome
				document.body.appendChild(form);
				
			    form.submit();
				
			});
			
		});
		
		$(document).ready(function(){
			$("#mybtntodo").click(function(){
				$( "#saveitemdetalle" ).submit();
			});
		});
		
		
		$(document).ready(function(){
			$("#rutProveedor").change(function(){
				$("#nombreFantasia").val($("#rutProveedor").val());
			});
		});


		/*$(document).ready(function(){
			$("#formaPago").ready(function(){
				if($("#formaPago").val()==3 || $("#formaPago").val()==4 || $("#formaPago").val()==5){
					$('#divCheques').show();
				}else{ $('#divCheques').hide();}
			});
		});*/
		
		function descuento(qty,costo,descuento, compras){
			$(compras).val( $(qty).val()*$(costo).val()-($(qty).val()*$(costo).val()*($(descuento).val()/100)) );
			calcular_total();
		}
		
		function calcular_total() {
			var importe_total = 0
			$("[id*=compras]").each(
				function(index, value) {
					importe_total = importe_total + eval($(this).val());
				}
			);
			$("#neto").val(Math.round(importe_total));
			$("#iva").val(Math.round((importe_total)*19/100));
			$("#importe").val(Math.round(importe_total)+Math.round((importe_total)*19/100)+eval($("#adicional").val()));
		}

	//grupo
			$(document).ready(function(){
	            
		        var consulta;
		         //hacemos focus al campo de búsqueda
		        $("#busquedaGrupo").focus();
		                                                                                                    
		        //comprobamos si se pulsa una tecla
		        $("#busquedaGrupo").blur(function(e){
		                                     
		              //obtenemos el texto introducido en el campo de búsqueda
		              $consultaGrupo = $("#busquedaGrupo").val();
		              $consultaFamilia = $("#busquedaFamily").val();
		              $consultaSubFamilia = $("#busquedaSubfamily").val();
		              $consultaCodigo = $("#busquedaCodigo").val();
		              $consultaDescripcion = $("#busquedaDescripcion").val();

		              //hace la búsqueda
		       	                                                                   
		              $.ajax({
		                    type: "POST",
		                    url: "buscar.php",
		                    data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
		                    beforeSend: function(){
		                          //imagen de carga
		                          $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
		                    },
		                    error: function(){
		                          alert("Error en búsqueda");
		                    },
		                    success: function(data){ 
		                    	$("#resultado").empty();                                                   
		                          $("#product").empty();
		                          $("#product").append(data);
		                          $('#product').trigger("chosen:updated");
		                          $("#product").trigger("liszt:updated");                    
		                    }
		              });
		                                                                                  
		                                                                           
		        });
		                                                                   
		});

			//family

	$(document).ready(function(){
	            
		        var consulta;
		         //hacemos focus al campo de búsqueda
		 //       $("#busquedaFamily").focus();
		                                                                                                    
		        //comprobamos si se pulsa una tecla
		        $("#busquedaFamily").blur(function(e){
		                                     
		              //obtenemos el texto introducido en el campo de búsqueda
		              $consultaGrupo = $("#busquedaGrupo").val();
		              $consultaFamilia = $("#busquedaFamily").val();
		              $consultaSubFamilia = $("#busquedaSubfamily").val();
		              $consultaCodigo = $("#busquedaCodigo").val();
		              $consultaDescripcion = $("#busquedaDescripcion").val();

		                                                                 
		              //hace la búsqueda
		                                                                                  
		              $.ajax({
		                    type: "POST",
		                    url: "buscar.php",
		                    data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
		                    beforeSend: function(){
		                          //imagen de carga
		                          $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
		                    },
		                    error: function(){
		                          alert("error petición ajax");
		                    },
		                    success: function(data){
		                    	$("#resultado").empty();                                                    
		                          $("#product").empty();
		                          $("#product").append(data);
		                          $('#product').trigger("chosen:updated");
		                          $("#product").trigger("liszt:updated");                    
		                    }
		              });
		                                                                                  
		                                                                           
		        });
		                                                                   
		});

	//subfamily
	$(document).ready(function(){
	    
	    var consulta;
	     //hacemos focus al campo de búsqueda
	    //$("#busquedaSubfamily").focus();
	                                                                                                
	    //comprobamos si se pulsa una tecla
	    $("#busquedaSubfamily").blur(function(e){
	                                 
	          //obtenemos el texto introducido en el campo de búsqueda
	          $consultaGrupo = $("#busquedaGrupo").val();
	          $consultaFamilia = $("#busquedaFamily").val();
	          $consultaSubFamilia = $("#busquedaSubfamily").val();
	          $consultaCodigo = $("#busquedaCodigo").val();
	          $consultaDescripcion = $("#busquedaDescripcion").val();

	          //hace la búsqueda
	                                                                              
	          $.ajax({
	                type: "POST",
	                url: "buscar.php",
	                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
	                beforeSend: function(){
	                      //imagen de carga
	                      $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
	                },
	                error: function(){
	                      alert("error petición ajax");
	                },
	                success: function(data){
	                	  $("#resultado").empty();
	                      $("#product").empty();
	                      $("#product").append(data);
	                      $('#product').trigger("chosen:updated");
	                      $("#product").trigger("liszt:updated");                    
	                }
	          });
	                                                                              
	                                                                       
	    });
	                                                               
	});

	//codigo
	$(document).ready(function(){
	    
	    var consulta;
	     //hacemos focus al campo de búsqueda
	    //$("#busquedaCodigo").focus();
	                                                                                                
	    //comprobamos si se pulsa una tecla
	    $("#busquedaCodigo").blur(function(e){
	                                 
	          //obtenemos el texto introducido en el campo de búsqueda
	          $consultaGrupo = $("#busquedaGrupo").val();
	          $consultaFamilia = $("#busquedaFamily").val();
	          $consultaSubFamilia = $("#busquedaSubfamily").val();
	          $consultaCodigo = $("#busquedaCodigo").val();
	          $consultaDescripcion = $("#busquedaDescripcion").val();

	                                                             
	          //hace la búsqueda
	                                                                              
	          $.ajax({
	                type: "POST",
	                url: "buscar.php",
	                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
	                beforeSend: function(){
	                      //imagen de carga
	                      $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
	                },
	                error: function(){
	                      alert("error petición ajax");
	                },
	                success: function(data){
		                $("#resultado").empty();                                              
	                      $("#product").empty();
	                      $("#product").append(data);
	                      $('#product').trigger("chosen:updated");
	                      $("#product").trigger("liszt:updated");                    
	                }
	          });
	                                                                              
	                                                                       
	    });
	                                                               
	});

	//codigo
	$(document).ready(function(){
	    
	    var consulta;
	     //hacemos focus al campo de búsqueda
	    //$("#busquedaCodigo").focus();
	                                                                                                
	    //comprobamos si se pulsa una tecla
	    $("#busquedaDescripcion").blur(function(e){
	                                 
	          //obtenemos el texto introducido en el campo de búsqueda
	          $consultaGrupo = $("#busquedaGrupo").val();
	          $consultaFamilia = $("#busquedaFamily").val();
	          $consultaSubFamilia = $("#busquedaSubfamily").val();
	          $consultaCodigo = $("#busquedaCodigo").val();
	          $consultaDescripcion = $("#busquedaDescripcion").val();

	                                                             
	          //hace la búsqueda
	                                                                              
	          $.ajax({
	                type: "POST",
	                url: "buscar.php",
	                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
	                beforeSend: function(){
	                      //imagen de carga
	                      $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
	                },
	                error: function(){
	                      alert("error petición ajax");
	                },
	                success: function(data){
		                $("#resultado").empty();                                              
	                      $("#product").empty();
	                      $("#product").append(data);
	                      $('#product').trigger("chosen:updated");
	                      $("#product").trigger("liszt:updated");                    
	                }
	          });
	                                                                              
	                                                                       
	    });
	                                                               
	});
		
</script>

  <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
 <div class="container">
 	
	<div class="contentheader">
			<ul class="breadcrumb">
                <li><a href="index.php">Tablero</a></li>
                <li><a href="compras.php?tipo=<? echo $_GET['tipo'];?>">Compras</a></li>
                <li class="active">Detalle Compras</li>
			</ul>
    </div>



<!-- <div id="maintable"> -->
<a  href="compras.php?tipo=<? echo $_GET['tipo'];?>"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Volver</button></a><br><br>

<form action="savepurchasesitem.php" method="post" onSubmit="return validateForm()" name="myForm">
<input type="hidden" name="invoice" value="<?php echo $_GET['iv']; ?>" />

<input type="text" id="busquedaGrupo" placeholder="Grupo" maxlength="2" size="2"/>
<input type="text" id="busquedaFamily" placeholder="Familia" maxlength="2" size="2"/>
<input type="text" id="busquedaSubfamily" placeholder="Subfamilia" maxlength="2" size="2"/>
<input type="text" id="busquedaCodigo" placeholder="Código" />
<input type="text" id="busquedaDescripcion" placeholder="Descripción" size="70"/>
<br /><br />
<div id="resultado"></div>
<select id="product" name="product" style="width:750px; " class="chzn-select" required>
<option></option>
</select>

<input type="text" name="qty" value="" placeholder="Cantidad" autocomplete="off" style="width: 78px; height:30px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<input type="hidden" id="suplier_id" name="suplier_id" value="<? echo $_GET['sp'];?>" />
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-save icon-large"></i> agregar</button>

<Button type="button" class="btn btn-info btn-lg" id="myBtn" style="float:right; width:123px; height:35px;" />+ Productos</button>

</form>
<div class="content" id="content">
<div>
<?php
include('../connect.php');

$resultaz = mysql_query("SELECT p.*, s.suplier_rut, s.suplier_name, td.descripcion FROM purchases  p left join supliers s on p.suplier_id = s.suplier_id LEFT JOIN tipo_documento td ON td.tipo_documento_id = p.tipo_documento_id WHERE p.transaction_id= '$id' and s.suplier_id='$suplier' AND p.empresa_id = $sesionEmpresaID AND p.`delete`='0'");
while($rowaz = mysql_fetch_array($resultaz, MYSQL_ASSOC))
{
	
echo 'Tipo de documento: '.$rowaz['descripcion'].'<br>';
echo 'Transaction ID : TR-'.$rowaz['transaction_id'].'<br>';
echo 'Rut Proveedor : '.$rowaz['suplier_rut'].'<br>';
echo 'Nombre Fantasia : '.$rowaz['suplier_name'].'<br>';
echo 'Numero Compra : '.$rowaz['invoice_number'].'<br>';
echo 'Fecha Factura: '.$rowaz['fecha_factura'].'<br>';

$adicional = $rowaz['adicional'];
$tipo_documento = $rowaz['tipo_documento_id'];
$observaciones = $rowaz['observaciones'];
$forma_pago_id = $rowaz['forma_pago_id'];
$permiteDesc = $rowaz['descuento'];
$maximoDesc = $rowaz['porcentaje_maximo_descuento'];

}
?>
</div>

<!--  <form method="post" action="saveitemtodoCompra.php" id="saveitemdetalle">-->
<input type="hidden" name="invoice2" value="<?php echo $_GET['iv']; ?>" />
<input type="hidden" name="suplier_id2" value="<? echo $_GET['sp'];?>" />


<input type="hidden" id="sp" name="sp" value="<?php echo $suplier?>">
<input type="hidden" id="strIds" name="strIds" value="">
<input type="hidden" id="idInvoice" name="idInvoice" value="<?php echo $id?>">

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="35%"> Nombre </th>
			<th width="10%"> Cantidad </th>
			<th width="15%"> Costo </th>
            <th width="15%"> Descuento </th>
            <th width="15%"> Total </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				
				//$result = mysql_query("SELECT pi.*, p.code FROM purchases_item pi LEFT JOIN products p ON pi.product_id = p.product_id WHERE invoice= '$id' AND pi.empresa_id = $sesionEmpresaID AND pi.`delete`='0'");
				$result = mysql_query("SELECT * FROM purchases_item WHERE invoice= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
			?>
			<tr class="record">
			<td>
			<input type="hidden" id="id-<?php echo $row['id'];?>" name="id-<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">
			<input type="hidden" id="invoice-<?php echo $row['id'];?>" name="invoice-<?php echo $row['id'];?>" value="<?php echo $row['invoice'];?>">
			<?php
			$rrrrrrr=$row['product_id'];
			
			$resultss = mysql_query("SELECT * FROM products WHERE product_id= '$rrrrrrr' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
			while($rowss = mysql_fetch_array($resultss, MYSQL_ASSOC))
			{
			echo $rowss['name'];
			
			?></td>
			<td>
				<input type="number" max="100" min="0" name="qty-<?php echo $row['id']; ?>" id="qty-<?php echo $row['id']; ?>" value="<?php echo $row['qty'];?>" 
				onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#compras-<?php echo $row['id']; ?>')">
			</td>
			<td>
			
			<input type="text" name="cost-<?php echo $row['id']; ?>" id="cost-<?php echo $row['id']; ?>" value="
			<?php
			
				if($row['cost']>0){
					$dfdf=$row['cost'];
				}else{
					$dfdf=$rowss['lastcost'];
				}
				echo round($dfdf,2);
			?>
			" onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#compras-<?php echo $row['id']; ?>')">
			
			</td>
            <td>
            	<input type="number" max="100" min="0" name="descuento-<?php echo $row['id']; ?>" id="descuento-<?php echo $row['id']; ?>" value="<?php echo $row['descuento']; ?>" 
            	onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#compras-<?php echo $row['id']; ?>')">
            </td>
            <td>
            <?php
	            if($row['cost']>0){
	            	$total=($row['cost']*$row['qty'])-($row['cost']*$row['qty']*$row['descuento']/100);
	            }else{
	            	$total=($rowss['lastcost']*$row['qty'])-($rowss['lastcost']*$row['qty']*$row['descuento']/100);
	            }            
				//$total=$rowss['lastcost']*$row['qty'];
			}
            ?>
				<input type="text" name="compras-<?php echo $row['id']; ?>" id="compras-<?php echo $row['id']; ?>" value="<? echo $total; ?>"
				onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#compras-<?php echo $row['id']; ?>')">
			
            </td>
			<td><a href="deletep.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['iv']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['code'];?>&sp=<?php echo $suplier;?>"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Borrar </button></a></td>
			</tr>
			<?php
			}
			
			function formatMoney($number, $fractional=false) {
				if ($fractional) {
					$number = sprintf('%.2f', $number);
				}
				while (true) {
					$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
					if ($replaced != $number) {
						$number = $replaced;
					} else {
						break;
					}
				}
				return $number;
			}
			$sdsd=$_GET['iv'];
			
			$resultas = mysql_query("select sum(t.total) as totalItem  from (
					select (cost*qty)-(cost*qty*descuento/100) as total from purchases_item WHERE invoice= '$sdsd' AND empresa_id = $sesionEmpresaID AND `delete`='0'
					) t");
			
			$sumaItem = 0;
			while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
			{
				$sumaItem = $rowas['totalItem'];
				$neto=round($sumaItem);
			}
			$sumaItem =round($sumaItem);
			
			if($tipo_documento==16 || $tipo_documento==19 || $tipo_documento==25 || $tipo_documento==27){?>
				<tr>
					<td colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
					<td colspan="2" align="right">
						<strong style="font-size: 12px; color: #222222;">
	                		<input type="text" name="importe" id="importe" value="<? echo $sumaItem/*formatMoney($sumaItem, true)*/;?>">
	                	</strong>
					</td>
				</tr>
			<?php }else{?>
			
			<tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">Neto:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
                 <input type="text" name="neto" id="neto" value="<? echo $neto/*formatMoney($neto, true)*/;?>">
				</strong></td>
			</tr>
            <tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">IVA:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
				<?php
					$iva=round(($sumaItem)*19/100);
				?>
                 <input type="text" name="iva" id="iva" value="<? echo $iva/*formatMoney($iva, true)*/;?>">
				</strong></td>
			</tr>
            <tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">Impuesto Adicional:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
                 <input type="text" name="adicional" id="adicional" value="<? echo $adicional;?>" onChange="calcular_total()">
				</strong></td>
			</tr>
            
            <tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
                <input type="text" name="importe" id="importe" value="<? echo $sumaItem+$iva+$adicional/*formatMoney($sumaItem, true)*/;?>">
				</strong></td>
			</tr>
			<?php }?>
	</tbody>
</table>
</div><br>

<textarea name="observaciones" id="observaciones" placeholder="Observaciones" style="margin: 0px; width: 803px; height: 55px;"><?php echo $observaciones;?></textarea>


<button name="myBtnGuardar" id="myBtnGuardar" style="height:35px; float:right;" class="btn btn-success btn-large" onclick="">Guardar</button>

</form>
<div class="clearfix"></div>
	<div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addproduct.php');?>

		</div>
       </div>
<!--     </div> -->

</div>
</body>
</html>