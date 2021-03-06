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
	$idReferencia=$_GET['ivReferencia'];
	$customer=$_GET['sp'];
	$tipo=$_GET['tipo'];
	
	include 'funcNumeroALetra.php';
?>

<?php //genera DTE Borrador

function url_exists( $url = NULL ) {

    if( empty( $url ) ){
        return false;
    }

    // get_headers() realiza una petici�n GET por defecto
    // cambiar el m�todo predeterminadao a HEAD
    // Ver http://php.net/manual/es/function.get-headers.php
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
             )
        )
    );
    $headers = @get_headers( $url );
    sscanf( $headers[0], 'HTTP/%*d.%*d %d', $httpcode );

    //Aceptar solo respuesta 200 (Ok), 301 (redirecci�n permanente) o 302 (redirecci�n temporal)
    $accepted_response = array( 200, 301, 302 );
    if( in_array( $httpcode, $accepted_response ) ) {
        return true;
    } else {
        return false;
    }
}

//GENERAR PDF BORRADOR
if (isset($_GET['valido']) and $_GET['valido']=="EnvioSIIBorrador"){
require_once("json.php");
// read data
include('../connect.php');

//INICIO - GENERAR FOLIO DOCUMENTO - svalenzu
$result = mysql_query("
		SELECT CASE WHEN MAX(folio_DTE)+1>0 
		 THEN MAX(folio_DTE)+1
		 ELSE 1
		 END as FOLIO_NVO 
		FROM claveSII 
		WHERE tipo_documento= '$tipo' AND empresa_id = $sesionEmpresaID");
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$folio_nvo=$row['FOLIO_NVO'];
}

$result = mysql_query("INSERT 
				claveSII(id_invoice, folio_DTE, fecha, tipo_documento, estado, empresa_id, user_create) 
				values($id, $folio_nvo,'".date("Y-m-d")."',$tipo, 1, $sesionEmpresaID, '$username')");

//FIN - GENERAR FOLIO DOCUMENTO - svalenzu

$tipoDocto = $_GET['tipoDTE'];
$idEmpresa = $sesionEmpresaID;//"1";
$folio = $_GET['folioDTE'];
$usuario=$_SESSION['KT_Username'];
$fechaActual = date("d-m-Y");

	//desarrollo
	//$aUrl = "http://localhost:1095/api/dte/Post/";
	//produccion
	$aUrl = "http://200.73.116.79:8081/api/dte/Post/";

$EnviarSII='0';

$data = file_get_contents($aUrl."?empresa=".urlencode($idEmpresa)."&tipoDocumento=".urlencode($tipoDocto)."&numeroDocumento=".urlencode($folio)."&enviarSII=".urlencode($EnviarSII));
// decode data
$json = new Services_JSON;
$obj = $json->decode($data);
}

?>

<script language="javascript">

function innerSIIBorrador(tipoDTE,folioDTE)
{
	//VALIDA FORMA PAGO
	if($("#formaPago").val()!=''){
		//VALIDA FORMA PAGO CHEQUE CON CHEQUE INGRESADO
		if($contadorCheque>0){
		alert ("GENERACION DE PDF BORRADOR EN PROCESO");
		//document.forms["myForm"]["qty"].value
		//alert ("paso 2"); EnvioSIIBorrador
		document.forms["myForm"]["valido"].value="EnvioSIIBorrador";
		document.forms["myForm"]["folioDTE"].value=folioDTE;
		document.forms["myForm"]["tipoDTE"].value=tipoDTE;
		//alert ("paso 3");
		document.forms.myForm.submit();
		//alert ("paso 3");
		}else{
			alert('FORMA DE PAGO ES CON CHEQUE Y NO SE HA INGRESADO NINGUN CHEQUE!');
		}
	}else{
		alert('FORMA DE PAGO NO DEFINIDA, FAVOR INGRESAR FORMA DE PAGO V�LIDA');
	}
}

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
				$("#origen").val('ventas');
				$("#iv").val('<? echo $_GET['iv']; ?>');
				$("#sp").val('<? echo $_GET['sp']; ?>');
				
				
				$("#userForm").attr("action", "saveproduct.php");
				$("#myModal").modal();
			});

			$("#btnAddCheque").click(function(){
				$("#transaction_id").val('<? echo $_GET['iv']; ?>');
				$("#forma_pago").val(document.getElementById('formaPago').value);
				$("#customer_id").val('<? echo $_GET['sp']; ?>');
				$("#tipo").val('<? echo $tipo;?>');
				$("#fecha").val('<?php echo date("Y-m-d");?>');
				$("#numeroCheque").val('');
				$("#banco").val('');
				$("#fechaPago").val('<?php echo date("Y-m-d");?>');

				 <?php
	                include('../connect.php');
	                
	                $resultas = mysql_query("select sum(t.total) as totalItem  from (
	                		select (cost*qty)-(cost*qty*descuento/100) as total from sales_order WHERE invoice= '".$_GET['iv']."' AND empresa_id = $sesionEmpresaID AND `delete`='0'
	                		) t");
	                
	                $sumaItem = 0;
	                while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
	                {
	                	$sumaItem = $rowas['totalItem'];	                		
	                }
	                $sumaItem =round($sumaItem);
	                
	                $result=mysql_query("SELECT * FROM ventas_impago vi INNER JOIN sales s ON s.transaction_id = vi.transaction_id
	                					WHERE s.transaction_id = ".$_GET['iv']);
	                $totalVentaCh = $sumaItem;
	                while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                    	$totalVentaCh -= $row['monto'];
                    }
				?>

				
				$("#monto").val(<?php echo $totalVentaCh;?>);
				$("#userFormCheque").attr("action", "savecheque.php");
				$("#myModalCheque").modal();
			});

			$(document).ready(function(){
				$(".btnEditCheque").click(function(){
					
 					var id = $(this).attr('data-id');
 					$.ajax({
 						url: 'editcheque.php?id=' + id,
 						method: 'GET'
 					}).success(function(response) {
 							$("#id_cheque").val(response.records[0].id_cheque);
 							$("#transaction_id").val(response.records[0].transaction_id);
 							$("#forma_pago").val(response.records[0].forma_pago);
 							$("#customer_id").val(response.records[0].customer_id);
 							$("#tipo").val('<? echo $tipo;?>');
 							$("#fecha").val(response.records[0].fecha);
 							$("#numeroCheque").val(response.records[0].numeroCheque);
 							$("#banco").val(response.records[0].banco);
							$("#fechaPago").val(response.records[0].fechaPago);
							$("#monto").val(response.records[0].monto);
 							$("#userFormCheque").attr("action", "saveeditcheque.php");
 							$("#myModalCheque").modal();
 					}).error(function (textStatus, errorThrown){
 						alert('Error: ha ocurrido un error: ' + errorThrown);
 					});
				});
			});
			
			$("#myBtnGuardar").click(function(){

				var form = document.createElement("form");
				form.setAttribute("method", "POST");
				<?php if(($tipo==24)  && $_GET['edita']==''){ ?>
					form.setAttribute("action", "saveventaNC.php");
				<?php }else{?>
					form.setAttribute("action", "saveitemtodo.php");
				<?php }?>
								
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
				$("[id*=ventas]").each(
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
				
				var tipoDocumentoVenta =  document.getElementById("tipo_documento");
				
				<?php if($tipo==13 || $tipo==26){?>
				    form.appendChild(document.getElementById("formaPago"));
				<?php }?>
				form.appendChild(document.getElementById("observaciones"));
				form.appendChild(document.getElementById("adicional"));
				form.appendChild(document.getElementById("cliente_id"));
				form.appendChild(document.getElementById("idInvoice"));
				form.appendChild(document.getElementById("invoiceReferencia"));
				form.appendChild(document.getElementById("strIds"));
				form.appendChild(document.getElementById("tipo_documento"));
			    form.submit();
				
			});

			$("#myBtnFactElect").click(function(){
				alert('Funcionalidad en Construcion');
			});
			$("#myBtnBoleta").click(function(){
				alert('Funcionalidad en Construcion');
			});
		});
		
		$(document).ready(function(){
			$("#rutProveedor").change(function(){
				$("#nombreFantasia").val($("#rutProveedor").val());
			});
		});

		$(document).ready(function(){
			$("#rutProveedor").change(function(){
				$("#nombreFantasia").val($("#rutProveedor").val());
			});
		});

		
		$(document).ready(function(){
			$("#formaPago").ready(function(){
				if($("#formaPago").val()==3 || $("#formaPago").val()==4 || $("#formaPago").val()==5){
					$('#divCheques').show();
				}else{ $('#divCheques').hide();}
			});
		});

		$(document).ready(function(){
			$("#formaPago").change(function(){
				if($("#formaPago").val()==3 || $("#formaPago").val()==4 || $("#formaPago").val()==5){
					$('#divCheques').show();
				}else{ $('#divCheques').hide();}
			});
		});
		
		function descuento(qty,costo,descuento, venta){
			
			if(eval($(descuento).val())>eval($("#maximoDesc").val())){
				alert("El valor ingresado como descuento es mayor al permitido, se actualizar�");
				$(descuento).val($("#maximoDesc").val());
			}
			
			$(venta).val( $(qty).val()*$(costo).val()-($(qty).val()*$(costo).val()*($(descuento).val()/100)) );
			calcular_total();
		}
		
		function calcular_total() {
			var importe_total = 0;
			$("[id*=ventas]").each(
				function(index, value) {
					importe_total = importe_total + eval($(this).val());
				}
			);
			$("#neto").val(Math.round(importe_total/1.19));
			$("#iva").val(Math.round((importe_total/1.19)*19/100));
			$("#importe").val(Math.round(importe_total)+eval($("#adicional").val()));
		}



//grupo
		$(document).ready(function(){
            
	        var consulta;
	         //hacemos focus al campo de b�squeda
	        $("#busquedaGrupo").focus();
	                                                                                                    
	        //comprobamos si se pulsa una tecla
	        $("#busquedaGrupo").blur(function(e){
	                                     
	              //obtenemos el texto introducido en el campo de b�squeda
	              $consultaGrupo = $("#busquedaGrupo").val();
	              $consultaFamilia = $("#busquedaFamily").val();
	              $consultaSubFamilia = $("#busquedaSubfamily").val();
	              $consultaCodigo = $("#busquedaCodigo").val();
	              $consultaDescripcion = $("#busquedaDescripcion").val();

	              //hace la b�squeda
	       	                                                                   
	              $.ajax({
	                    type: "POST",
	                    url: "buscar.php",
	                    data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
	                    beforeSend: function(){
	                          //imagen de carga
		                      $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
	                    },
	                    error: function(){
	                          alert("Error en b�squeda");
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
	         //hacemos focus al campo de b�squeda
	       // $("#busquedaFamily").focus();
	                                                                                                    
	        //comprobamos si se pulsa una tecla
	        $("#busquedaFamily").blur(function(e){
	                                     
	              //obtenemos el texto introducido en el campo de b�squeda
	              $consultaGrupo = $("#busquedaGrupo").val();
	              $consultaFamilia = $("#busquedaFamily").val();
	              $consultaSubFamilia = $("#busquedaSubfamily").val();
	              $consultaCodigo = $("#busquedaCodigo").val();
	              $consultaDescripcion = $("#busquedaDescripcion").val();

	                                                                 
	              //hace la b�squeda
	                                                                                  
	              $.ajax({
	                    type: "POST",
	                    url: "buscar.php",
	                    data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
	                    beforeSend: function(){
	                          //imagen de carga
		                      $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
	                    },
	                    error: function(){
	                          alert("error petici�n ajax");
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
     //hacemos focus al campo de b�squeda
    //$("#busquedaSubfamily").focus();
                                                                                                
    //comprobamos si se pulsa una tecla
    $("#busquedaSubfamily").blur(function(e){
                                 
          //obtenemos el texto introducido en el campo de b�squeda
          $consultaGrupo = $("#busquedaGrupo").val();
          $consultaFamilia = $("#busquedaFamily").val();
          $consultaSubFamilia = $("#busquedaSubfamily").val();
          $consultaCodigo = $("#busquedaCodigo").val();
          $consultaDescripcion = $("#busquedaDescripcion").val();

          //hace la b�squeda
                                                                              
          $.ajax({
                type: "POST",
                url: "buscar.php",
                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
                beforeSend: function(){
                      //imagen de carga
                    $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
                },
                error: function(){
                      alert("error petici�n ajax");
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
     //hacemos focus al campo de b�squeda
    //$("#busquedaCodigo").focus();
                                                                                                
    //comprobamos si se pulsa una tecla
    $("#busquedaCodigo").blur(function(e){
                                 
          //obtenemos el texto introducido en el campo de b�squeda
          $consultaGrupo = $("#busquedaGrupo").val();
          $consultaFamilia = $("#busquedaFamily").val();
          $consultaSubFamilia = $("#busquedaSubfamily").val();
          $consultaCodigo = $("#busquedaCodigo").val();
          $consultaDescripcion = $("#busquedaDescripcion").val();

                                                             
          //hace la b�squeda
                                                                              
          $.ajax({
                type: "POST",
                url: "buscar.php",
                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
                beforeSend: function(){
                      //imagen de carga
                    $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
                },
                error: function(){
                      alert("error petici�n ajax");
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

//descripcion
$(document).ready(function(){
    
    var consulta;
     //hacemos focus al campo de b�squeda
    //$("#busquedaCodigo").focus();
                                                                                                
    //comprobamos si se pulsa una tecla
    $("#busquedaDescripcion").blur(function(e){
                                 
          //obtenemos el texto introducido en el campo de b�squeda
          $consultaGrupo = $("#busquedaGrupo").val();
          $consultaFamilia = $("#busquedaFamily").val();
          $consultaSubFamilia = $("#busquedaSubfamily").val();
          $consultaCodigo = $("#busquedaCodigo").val();
          $consultaDescripcion = $("#busquedaDescripcion").val();

                                                             
          //hace la b�squeda
                                                                              
          $.ajax({
                type: "POST",
                url: "buscar.php",
                data: {grupo:$consultaGrupo,familia:$consultaFamilia,subfamily:$consultaSubFamilia,codigo:$consultaCodigo, descripcion:$consultaDescripcion},
                beforeSend: function(){
                      //imagen de carga
                    $("#resultado").html("<p align='center'><img src='../img/loader.gif' /></p>");
                },
                error: function(){
                      alert("error petici�n ajax");
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


//nota credito
	$(document).ready(function(){
            
        var consulta;
         //hacemos focus al campo de b�squeda
        $("#busquedaFecha").focus();
                                                                                                    
        //comprobamos si se pulsa una tecla
        $("#busquedaFecha").blur(function(e){
                                     
              //obtenemos el texto introducido en el campo de b�squeda
              $consultaClienteID = <?php if($customer){ echo $customer;}else{ echo "''";}?>;
              $consultaFecha = $("#busquedaFecha").val();
              $consultaFormaPago = $("#busquedaFormaPago").val();
              
              //hace la b�squeda
       	                                                                   
              $.ajax({
                    type: "POST",
                    url: "buscarFactElec.php",
                    data: {clienteid:$consultaClienteID,fecha:$consultaFecha,formapago:$consultaFormaPago},
                    beforeSend: function(){
                          //imagen de carga
	                      $("#resultadoFacturas").html("<p align='center'><img src='../img/loader.gif' /></p>");
                    },
                    error: function(){
                          alert("Error en b�squeda");
                    },
                    success: function(data){                                                    
                    	$("#resultadoFacturas").empty();
                          $("#facturasElectronicas").empty();
                          $("#facturasElectronicas").append(data);
                          $('#facturasElectronicas').trigger("chosen:updated");
                          $("#facturasElectronicas").trigger("liszt:updated");                    
                    }
              });
                                                                                  
                                                                           
        });
                                                                   
	});

	$(document).ready(function(){
        
        var consulta;
         //hacemos focus al campo de b�squeda
        $("#busquedaFormaPago").focus();
                                                                                                    
        //comprobamos si se pulsa una tecla
        $("#busquedaFormaPago").blur(function(e){
                                     
              //obtenemos el texto introducido en el campo de b�squeda
              $consultaClienteID = <?php if($customer){ echo $customer;}else{ echo "''";}?>;
              $consultaFecha = $("#busquedaFecha").val();
              $consultaFormaPago = $("#busquedaFormaPago").val();
              
              //hace la b�squeda
       	                                                                   
              $.ajax({
                    type: "POST",
                    url: "buscarFactElec.php",
                    data: {clienteid:$consultaClienteID,fecha:$consultaFecha,formapago:$consultaFormaPago},
                    beforeSend: function(){
                          //imagen de carga
	                      $("#resultadoFacturas").html("<p align='center'><img src='../img/loader.gif' /></p>");
                    },
                    error: function(){
                          alert("Error en b�squeda");
                    },
                    success: function(data){                                                    
                    	$("#resultadoFacturas").empty();
                          $("#facturasElectronicas").empty();
                          $("#facturasElectronicas").append(data);
                          $('#facturasElectronicas').trigger("chosen:updated");
                          $("#facturasElectronicas").trigger("liszt:updated");                    
                    }
              });
                                                                                  
                                                                           
        });
                                                                   
	});


	$(document).ready(function(){
		$(".editButton").click(function(){
			var id = $(this).attr('data-id');
			$.ajax({
				url: 'editventa.php?id=' + id,
				method: 'GET'
			}).success(function(response) {
					$("#memi").val(response.records[0].transaction_id);
					$("#iv").val(response.records[0].invoice_number);
					$("#correlativo").val(response.records[0].correlativo);
					$("#fechaFactura").val(response.records[0].fecha_factura);
					$("#fechaVencimiento").val(response.records[0].fecha_vencimiento);
					$("#fechaIngreso").val(response.records[0].fecha_ingreso);
					
					$("#rutCliente").val(response.records[0].customer_id);
					$("#rutCliente").attr('disabled', true);
					$('#rutCliente').trigger("chosen:updated");
					$("#rutCliente").trigger("liszt:updated");
					$("#rutCliente2hidden").val(response.records[0].customer_id);
					
					$("#address").val(response.records[0].address);
					$("#ciudad").val(response.records[0].ciudad);
					$("#comuna").val(response.records[0].comuna);
					$("#prod_name").val(response.records[0].prod_name);
					$("#contact").val(response.records[0].contact);
					$("#phone").val(response.records[0].phone);
					
					
					$("#tipoProducto").val(response.records[0].tipo_productos);
					$("#codigoCentro").val(response.records[0].centro_id);
					$('#codigoCentro').trigger("chosen:updated");
					$("#codigoCentro").trigger("liszt:updated");
					$("input[name=tipo_documento]").val('<?php echo $_GET['tipo'];?>');
					$('#idReferencia2').val(id);
					$("div.myModalDetalle form").attr("action", "saveventaNC2.php");
					$("#myModalDetalle").modal();
			}).error(function (textStatus, errorThrown){
				alert('Error: ha ocurrido un error: ' + errorThrown);
				});
		});
	});
	



//documentos referenciados

$(document).ready(function() {
    $('.addReferencia').on('click', function() {
        // Get the record's ID via attribute
        var id = $(this).attr('data-id');

        $.ajax({
            url: 'http://jsonplaceholder.typicode.com/users/' + id,
            method: 'GET'
        }).success(function(response) {
            // Populate the form fields with the data returned from server
            $('#userForm')
                .find('[name="id"]').val(response.id).end()
                .find('[name="name"]').val(response.name).end()
                .find('[name="email"]').val(response.email).end()
                .find('[name="website"]').val(response.website).end();

            // Show the dialog
            bootbox
                .dialog({
                    title: 'Edit the user profile',
                    message: $('#userForm'),
                    show: false // We will show it manually later
                })
                .on('shown.bs.modal', function() {
                    $('#userForm')
                        .show()                             // Show the login form
                        .formValidation('resetForm'); // Reset form
                })
                .on('hide.bs.modal', function(e) {
                    // Bootbox will remove the modal (including the body which contains the login form)
                    // after hiding the modal
                    // Therefor, we need to backup the form
                    $('#userForm').hide().appendTo('body');
                })
                .modal('show');
        });
    });
});





	
</script>

  <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body onLoad="">
		<?php include('navfixed.php');?>
 <div class="container">
 			<ul class="breadcrumb">
			<li><a href="index.php">Tablero</a></li>
			<li class="active">Lista Ventas</li>
			</ul>
 
<!--  <div id="maintable">  -->
<a  href="ventas.php?tipo=<?php echo $tipo;?>"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Volver</button></a><br><br>

<?php if($tipo!=24 || ($tipo==24 && $idReferencia!='')){ //distinto de nota credito o guia de despacho?>

<form action="saveventasitem.php" method="post" onSubmit="return validateForm()" name="myForm">
  <div id='Div1'></div>
<input type="hidden" name="invoice" value="<?php echo $id; ?>" />
<input type="hidden" name="tipo" value="<?php echo $tipo; ?>" />
<input type="text" id="busquedaGrupo" placeholder="Grupo" maxlength="2" size="2" <?php if($tipo==24){ echo "readonly"; } ?>/>
<input type="text" id="busquedaFamily" placeholder="Familia" maxlength="2" size="2" <?php if($tipo==24){ echo "readonly"; } ?>/>
<input type="text" id="busquedaSubfamily" placeholder="Subfamilia" maxlength="2" size="2" <?php if($tipo==24){ echo "readonly"; } ?>/>
<input type="text" id="busquedaCodigo" placeholder="C�digo" <?php if($tipo==24){ echo "readonly"; } ?>/>
<input type="text" id="busquedaDescripcion" placeholder="Descripci�n" size="70" <?php if($tipo==24){ echo "readonly"; } ?>/>

<!--DTE-->
<input name="valido" value="" type="hidden"/>
<input name="folioDTE" value="" type="hidden"/>
<input name="tipoDTE" value="" type="hidden"/>
<input name="idEmpresa" value="" type="hidden"/>
<!--DTE-->

<br /><br />
<div id="resultado"></div>
<select id="product" name="product" style="width:750px; " class="chzn-select" required>
<option></option>
</select>

<input type="text" name="qty" value="" placeholder="Cantidad" autocomplete="off" style="width: 78px; height:30px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" <?php if($tipo==24){ echo "readonly"; } ?>/>
<input type="hidden" id="cliente_id" name="cliente_id" value="<? echo $_GET['sp'];?>" />
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-save icon-large <?php if($tipo==24){ echo "disabled"; } ?>"></i> agregar</button>

<Button type="button" class="btn btn-info" id="myBtn" style="float:right; width:123px; height:35px;" />+ Productos</button>

</form>

<?php }//fin combo productos
 else{ ///inicio lista de facturas ?>
	<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar..." autocomplete="off" />
	<br /><br />
		<table class="table table-bordered" id="resultTableNC" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="10%"> DTE</th>
                    <th width="10%"> Estado </th>
                    <th width="10%"> N&uacute;mero </th>
                    <th width="10%"> Fecha </th>
                    <th width="45%"> Cliente </th>
                    <th width="15%"> Acciones </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    include('../connect.php');
                    $result = mysql_query("SELECT v.*, c.customer_name, c.rut, es.estado, td.descripcion  FROM sales v
                    				left join customer c on c.customer_id = v.customer_id
                    				left join claveSII cs on cs.id_invoice = v.transaction_id
                    				left join estadoSII es on es.id = cs.estado
                    				left join tipo_documento td on v.tipo_documento_id=td.tipo_documento_id
                    				WHERE v.empresa_id = $sesionEmpresaID AND v.tipo_documento_id in (13, 26)
                    				AND v.`delete`='0' ORDER BY v.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['descripcion']; ?></td>
                    <td><?php if($row['estado']==""){ echo "Sin Estado";}else{ echo $row['estado'];} ?></td>
                    <td><?php echo $row['invoice_number']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['rut'].' - '.$row['customer_name']; ?></td>
                    <td>
                    <?php if($tipo==24){?>
	                    <a href="ventasportal.php?tipo=<?php echo $tipo;?>&sp=<?php echo $row['customer_id']; ?>&ivReferencia=<?php echo $row['transaction_id']; ?>">
	                    <Button class="btn btn-primary btn-mini" />Edita Monto</button></a>
	                    <Button data-id="<?php echo $row['transaction_id']; ?>" type="button" class="btn btn-warning btn-mini editButton" data-toggle="modal" />Editar Datos</button>
	                    <a href="#" id="<?php echo $row['transaction_id']; ?>" class="anulabutton" title="Click para anular DTE"><button class="btn btn-danger btn-mini"><i class="icon-trash"></i> Anula DTE </button></a>
                    <?php }else{?>
                    	<a href="ventasportal.php?tipo=<?php echo $tipo;?>&sp=<?php echo $row['customer_id']; ?>&ivReferencia=<?php echo $row['transaction_id']; ?>">
	                    <Button class="btn btn-primary btn-mini" />Facturar Gu&iacute;a</button></a>
                    <?php }?>
                    </td>
                    </tr>
                    <?php
                        }
                    ?>
                
            </tbody>
         </table>
		 
<?php }?>
<div class="content" id="content">
<div>
<?php

include('../connect.php');

$permiteDesc="";
$bloqueado="";
$maximoDesc=0;
$saldoMaximo=0;
if($tipo==24){
	$resultaz = mysql_query("SELECT v.*, c.rut, c.customer_name, c.descuento, c.porcentaje_maximo_descuento, c.saldo_maximo, c.bloqueado, td.descripcion FROM sales v left join customer c on v.customer_id = c.customer_id LEFT JOIN tipo_documento td ON td.tipo_documento_id = v.tipo_documento_id WHERE v.transaction_id= '$idReferencia' and c.customer_id='$customer' AND v.empresa_id = $sesionEmpresaID AND v.`delete`='0'");
}else{
	$resultaz = mysql_query("SELECT v.*, c.rut, c.customer_name, c.descuento, c.porcentaje_maximo_descuento, c.saldo_maximo, c.bloqueado, td.descripcion FROM sales v left join customer c on v.customer_id = c.customer_id LEFT JOIN tipo_documento td ON td.tipo_documento_id = v.tipo_documento_id WHERE v.transaction_id= '$id' and c.customer_id='$customer' AND v.empresa_id = $sesionEmpresaID AND v.`delete`='0'");
}
while($rowaz = mysql_fetch_array($resultaz, MYSQL_ASSOC))
{
if($tipo==24){
	echo 'Tipo de documento: Nota de Cr�dito Electr�nica<br>';
	echo 'Transaccion Referencia ID : TR-'.$idReferencia.'<br>';
}else if($tipo==14){
	echo 'Tipo de documento: Gu�a de Despacho Electr�nica<br>';
	echo 'Transaccion Referencia ID : TR-'.$idReferencia.'<br>';
}else{
	echo 'Tipo de documento: '.$rowaz['descripcion'].'<br>';
	echo 'Transaccion ID : TR-'.$rowaz['transaction_id'].'<br>';
}

echo 'Rut Cliente : '.$rowaz['rut'].'<br>';
echo 'Nombre Fantasia : '.$rowaz['customer_name'].'<br>';
echo 'Numero Venta : '.$rowaz['invoice_number'].'<br>';
echo 'Fecha Factura: '.$rowaz['fecha_factura'].'<br>';
$adicional = $rowaz['adicional'];
$observaciones = $rowaz['observaciones'];
$forma_pago_id = $rowaz['forma_pago_id'];
$bloqueado = $rowaz['bloqueado'];
$permiteDesc = $rowaz['descuento'];
$maximoDesc = $rowaz['porcentaje_maximo_descuento'];
$saldoMaximo = $rowaz['saldo_maximo'];
}

$id=$_GET['iv'];

?>
<input type="hidden" id="maximoDesc" name="maximoDesc" value="<? echo $maximoDesc;?>" />
<input type="hidden" id="saldoMaximo" name="saldoMaximo" value="<? echo $saldoMaximo;?>" />


		<?php if($tipo==13 || $tipo==26){ //boleta y factura?>
    		Forma pago :
            <select name="formaPago" id="formaPago"  style="width:265px; height:30px; " value="<?php echo $forma_pago_id;?>">
            <option></option>
                <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT * FROM forma_pago");	    
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
                    <option value="<?php echo $row['forma_pago_id']; ?>" <?php if($row['forma_pago_id']==$forma_pago_id) echo "selected";?>><?php echo $row['descripcion']; ?></option>
                <?php
                }
                ?>
            </select>
        <?php } //fin forma pago?>
            <div id="divCheques" style="display: none;">
            <?php
                include('../connect.php');
                
                $result=mysql_query("SELECT * FROM ventas_impago vi INNER JOIN sales s ON s.transaction_id = vi.transaction_id
                					WHERE s.transaction_id = $id");
                $contadorCheque = 0;
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                ?>
		    <Button data-id="<?php echo $row['id']; ?>" type="button" class="btn btn-lg btn-success btnEditCheque" data-toggle="modal" /><?php echo $row['numero_cheque']; ?></button>
                <?php
                $contadorCheque = $contadorCheque+1;
                }
                ?>
            
            
            	<button class="btn btn-info btn-mini" id="btnAddCheque"><i class="icon-trash"></i> Agregar Cheque </button>
            </div>
			
			<table width="600" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><?php 

					$ip="200.73.116.79";
					$idEmp=$sesionEmpresaID;
					
					if ($tipo=="26"){
					$tipoDTE="33";
					$idRef = $id;
					}elseif ($tipo=="24"){
					$tipoDTE="61";
					$idRef = $idReferencia;
					}elseif ($tipo=="14"){
					$tipoDTE="52";
					$idRef = $id;
					}
					
				   $rutaPDFCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".CEDIBLE.pdf";
				   $rutaPDFNCedible="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".NCEDIBLE.pdf";
				   $rutaBorrador="http://".$ip.":8081/pdf/".$tipoDTE."_".$idRef."_".$idEmp.".pdf";
				   $rutaXMLA="http://".$ip.":8081/xml/".$tipoDTE."_".$idRef."_".$idEmp.".EnvioDTESigned.Customer.xml";
				   $rutaXMLS="http://".$ip.":8081/xml/".$tipoDTE."_".$idRef."_".$idEmp.".EnvioDTESigned.xml";
				   
				   //C:\SISTEMAS\KAMPEG\ServiciosInt\ServiciosIntegracion\App_Data\Resources\PDF
				   $rutaExisteBorrador="C:/inetpub/wwwroot/App_Data/Resources/PDF/".$tipoDTE."_".$idRef."_".$idEmp.".pdf";
				  // $rutaExisteBorrador="C:/SISTEMAS/KAMPEG/ServiciosInt/ServiciosIntegracion/App_Data/Resources/PDF/".$tipoDTE."_".$id."_".$idEmp.".pdf";
				   $rutaExisteCedible="C:/inetpub/wwwroot/App_Data/Resources/PDF/".$tipoDTE."_".$idRef."_".$idEmp.".CEDIBLE.pdf";
				   $rutaExisteNcedible="C:/inetpub/wwwroot/App_Data/Resources/PDF/".$tipoDTE."_".$idRef."_".$idEmp.".NCEDIBLE.pdf";
				   
				  $rutaXML="C:/inetpub/wwwroot/App_Data/Resources/XML/es-CL/".$tipoDTE."_".$idRef."_".$idEmp.".EnvioDTESigned.Customer.xml";
				  
				  $rutaXMLSII="C:/inetpub/wwwroot/App_Data/Resources/XML/es-CL/".$tipoDTE."_".$idRef."_".$idEmp.".EnvioDTESigned.xml";
				  
				  

						$urlexists = url_exists($rutaBorrador);

				  if ($urlexists) {
				  //		echo"<a href='#' onClick='innerDet($tipoDTE,$folio);'>DET.FACT.</a> - ";
				   		echo"<a href='".$rutaBorrador."' target='_blank'>VER PDF BORRADOR</a> ";
				   }
					?></td>
                  </tr>
                </table>
				
            <?php if($tipo==13 || $tipo==26){ //boleta y factura?>
            <?php if($bloqueado!="" && $bloqueado!="false"){?>
	            <div class="alert alert-danger">
				  <strong>CLIENTE BLOQUEADO!</strong> Este cliente no permite VENTAS - FAVOR CONTACTAR CON ADMINISTRACION.
				</div>
            <?php }?>
            <?php if($permiteDesc=="" || $permiteDesc=="false"){?>
            	<div class="alert alert-warning">
				  <strong>CLIENTE NO PERMITE DESCUENTO!</strong> Este cliente no permite descuento en sus ventas.
				</div>
            <?php }else{?>
            	<div class="alert alert-info">
				  <strong>CLIENTE PERMITE DESCUENTO!</strong> Este cliente permite un descuento m�ximo de: <?php echo $maximoDesc;?>.
				</div>
			<?php }?>
            <?php if($saldoMaximo>0){?>
	            <div class="alert alert-success">
				  <strong>CLIENTE CON CUENTA CORRIENTE!</strong> Este cliente permite pago con cr�dito como m�ximo de: <?php echo $saldoMaximo?>.
				</div>
            <?php }?>
            <?php } //tipo documento?>
            
            <input type="hidden" id="sp" name="sp" value="<?php echo $customer?>">
            <input type="hidden" id="strIds" name="strIds" value="">
            <input type="hidden" id="idInvoice" name="idInvoice" value="<?php echo $id?>">
            <input type="hidden" id="invoiceReferencia" name="invoiceReferencia" value="<?php echo $idReferencia?>">
            <input type="hidden" id="tipo_documento" name="tipo_documento" value="<?php echo $tipo?>">
</div>

<?php if($tipo!=24 || ($tipo==24 && $idReferencia!='')){ ?>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="35%"> Nombre </th>
			<th width="10%"> Cantidad </th>
			<th width="15%"> P. Unitario </th>
            <th width="15%"> Descuento </th>
            <th width="15%"> Total </th>
			<th width="10%"> Acci&oacute;n </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				
				if($tipo==24){
					$result = mysql_query("SELECT * FROM sales_order WHERE invoice= '$idReferencia' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
				}else{
					$result = mysql_query("SELECT * FROM sales_order WHERE invoice= '$id' AND empresa_id = $sesionEmpresaID AND `delete`='0'");
				}
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
				<input type="number" name="qty-<?php echo $row['id']; ?>" id="qty-<?php echo $row['id']; ?>" value="<?php echo $row['qty'];?>" 
				onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#ventas-<?php echo $row['id']; ?>')">
			</td>
			<td>
			
			<input type="text" name="cost-<?php echo $row['id']; ?>" id="cost-<?php echo $row['id']; ?>" value="
			<?php
			
				if($row['cost']>0){ 
					$dfdf=$row['cost'];
				}else{
					$dfdf=$rowss['pricesale'];
				}
				echo intval($dfdf);
			?>
			" onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#ventas-<?php echo $row['id']; ?>')">
			
			</td>
            <td>
            	<input type="number" <?php if($permiteDesc!=''){ echo "max=$maximoDesc";} ?> min="0" name="descuento-<?php echo $row['id']; ?>" id="descuento-<?php echo $row['id']; ?>" value="<?php echo $row['descuento'];?>" 
            	onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#ventas-<?php echo $row['id']; ?>')"
            	<?php if($permiteDesc==''){ echo "readonly";} ?>>
            </td>
            <td>
            <?php
            
	            if($row['cost']>0){
	            	$costoItem=$row['cost'];
	            }else{
	            	$costoItem=$rowss['pricesale'];
	            }
	            
				$total=$costoItem*$row['qty']-($costoItem*$row['qty']*$row['descuento']/100);
			}
            ?>
				<input type="text" name="ventas-<?php echo $row['id']; ?>" id="ventas-<?php echo $row['id']; ?>" value="<? echo $total; ?>"
				onChange="descuento('#qty-<?php echo $row['id'];?>', '#cost-<?php echo $row['id'];?>' ,'#descuento-<?php echo $row['id'];?>', '#ventas-<?php echo $row['id']; ?>')">
			
            </td>
			<td><center>
			<a href="<?php if($tipo==24){ echo "#"; }else{ ?>deletepventa.php?id=<?php echo $row['id']; ?>&invoice=<?php echo $_GET['iv']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['name'];?>&sp=<?php echo $customer; }?>">
			    <button class="btn btn-danger btn-mini <?php if($tipo==24){ echo "disabled"; } ?>"><i class="icon-trash"></i> Borrar </button>
			</a></td>
			</center>
			</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">Neto:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
				<?php
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
				
				if($tipo==24){
				$resultas = mysql_query("select sum(t.total) as totalItem  from (
										select (cost*qty)-(cost*qty*descuento/100) as total from sales_order WHERE invoice= '$idReferencia' AND empresa_id = $sesionEmpresaID AND `delete`='0'
										) t");
				}else{
				$resultas = mysql_query("select sum(t.total) as totalItem  from (
										select (cost*qty)-(cost*qty*descuento/100) as total from sales_order WHERE invoice= '$sdsd' AND empresa_id = $sesionEmpresaID AND `delete`='0'
										) t");
				}
				
				$sumaItem = 0;
				while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
				{
					$sumaItem = $rowas['totalItem'];
					$neto=round($sumaItem/1.19);
					
				}
				$sumaItem =round($sumaItem);
				?>
                 <input type="text" name="neto" id="neto" value="<? echo $neto /*formatMoney($neto, true)*/;?>">
				</strong></td>
			</tr>
            <tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">IVA:</strong></td>
				<td colspan="2" align="right"><strong style="font-size: 12px; color: #222222;">
				<?php
					$iva=round(($sumaItem/1.19)*19/100);
				?>
                 <input type="text" name="iva" id="iva" value="<? echo $iva /*formatMoney($iva, true)*/;?>">
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
                <input type="text" name="importe" id="importe" value="<? echo $sumaItem /*formatMoney($sumaItem, true)*/;?>">
				</strong></td>
			</tr>
		
	</tbody>
</table></div><br>

<textarea name="observaciones" id="observaciones" placeholder="Observaciones" style="margin: 0px; width: 803px; height: 55px;"><?php echo $observaciones;?></textarea>


<textarea name="numeroPalabras" id="numeroPalabras" placeholder="Numero en palabras" style="margin: 0px; width: 803px; height: 55px;"><?php echo $sumaItem>0 ? numtoletras($sumaItem) : ''; ?></textarea>

<? 
	$transac_id = $_GET['transaction_id'];
	if($transac_id>0){?>

	<button  style="height:35px; float:right;" class="btn btn-success btn-large">Factura Electr&oacute;nica</button>
	<button  style="height:35px; float:right;" class="btn btn-success btn-large">Vista Previa</button>

<? 	}else{
	
	?>
	<?php if($tipo==50 || $tipo==51){ ?>
	<button name="myBtnFactElect" id="myBtnFactElect" style="height:35px; float:right;" class="btn btn-success btn-large <?php if($bloqueado!=""){ echo "disabled";}?>" onClick="">Factura Electr�nica</button>
	<button name="myBtnBoleta" id="myBtnBoleta" style="height:35px; float:right;" class="btn btn-success btn-large <?php if($bloqueado!=""){ echo "disabled";}?>" onClick="">Boleta</button>
	<button name="myBtnGuardar" id="myBtnGuardar" style="height:35px; float:right;" class="btn btn-success btn-large <?php if($bloqueado!=""){ echo "disabled";}?>" onClick="">Guardar</button>
	<?php }else{ 
	
					if ($tipo=="26"){
					$tipoDTE="33";
					$idRef = $id;
					}elseif ($tipo=="24"){
					 $tipoDTE="61";
					 $idRef = $idReferencia;
					}elseif ($tipo=="14"){
					$tipoDTE="52";
					$idRef = $id;
					}
					
	?>
	<button style="height:35px; float:right;" class="btn btn-success btn-large " onClick='javascript:innerSIIBorrador(<?php echo $tipoDTE; ?>,<?php echo $idRef; ?>);'>Generar PDF Borrador</button>
	<!--<button style="height:35px; float:right;" class="btn btn-success btn-large " onClick="window.open('52_38569_4.pdf')">Enviar al SII</button>-->
	<button name="myBtnGuardar" id="myBtnGuardar" style="height:35px; float:right;" class="btn btn-success btn-large <?php if($bloqueado!="" || $_GET['edita']=='datos'){ echo "disabled";}?>" onClick="">Guardar</button>
	<?php }?>
<?php } ?>

<?php } //fin nota credito ?>
<div class="clearfix"></div>
	<div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addproduct.php');?>

		</div>
    </div>
    <div class="modal fade" id="myModalCheque" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('addcheque.php');?>

		</div>
   </div>
 <!-- main table </div>-->   

    </div>
    <div class="modal fade myModalDetalle" id="myModalDetalle" role="dialog">
       <div class="modal-dialog">
       
       	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
        
        <?php include('sales.php');?>

		</div>
   </div>

</div>
</body>
</html>