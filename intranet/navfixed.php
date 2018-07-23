 <?php include('../connect.php');?>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ERP Kampeg</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Inicio</a></li>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Compras<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <!--<li><a href="cotizaciones.php">Cotizaciones</a></li>
          <li><a href="ordendecompra.php">Ordenes de compra</a></li>
          <li><a href="otrascompras.php">Otras compras</a></li>-->
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=13">Boletas (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=16">Boletas Exenta (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=17">Boletas Electr&oacute;nicas</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=19">Boletas Exenta Electr&oacute;nicas</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=15">Gu&iacute;a De Despacho (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=14">Gu&iacute;a De Despacho Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=12">Facturas (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=26">Facturas Electr&oacute;nica</a></li>
          <!--<li><a href="compras.php?tipo=21">Factura De Compra (PAPEL)</a></li>
          <li><a href="compras.php?tipo=22">Factura De Compra Electr&oacute;nica</a></li>!-->
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=25">Factura No Afecto o Exenta (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=27">Factura No Afecto o Exenta Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=24">Notas De Cr&eacute;dito (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=30">Notas De Cr&eacute;dito Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=23">Notas De D&eacute;bito (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=29">Notas De D&eacute;bito Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=50">Orden De Compra</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/compras.php?tipo=51">Nota De Venta</a></li>
          <!--<li><a href="efectivos.php">Efectivos</a></li>
          <li><a href="cheques.php">Cheques</a></li>
          <li><a href="marcarimpagas.php">Marcar Impagas</a></li>
          <li><a href="generarcartapago.php">Generar Carta Pago</a></li>-->          
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Ventas<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <!--<li><a href="puntoventas.php">Punto Venta</a></li>
          <li><a href="presupuestos.php">Presupuestos</a></li>
          <li><a href="boletas.php">Boletas</a></li>-->
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=13">Boletas (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=15">Gu&iacute;a De Despacho (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=14">Gu&iacute;a De Despacho Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=12">Facturas (PAPEL)</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=26">Factura Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=24">Notas Cr&eacute;dito Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=29">Notas De D&eacute;bito Electr&oacute;nica</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=50">Orden De Compra</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/ventas.php?tipo=51">Nota de Venta</a></li>
          <!--
          -->
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Bodeguero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/ERP-Kampeg-PRO/intranet/bodegas.php">Bodegas<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<!--<li><a href="ingresobodegaportal.php">Ingreso</a></li>-->
			<li><a href="/ERP-Kampeg-PRO/intranet/bodegas.php">Bodegas</a></li>
			<li><a href="/ERP-Kampeg-PRO/intranet/secciones.php">Secci&oacute;n</a></li>
			<li><a href="/ERP-Kampeg-PRO/intranet/subsecciones.php">Subsecci&oacute;n</a></li>
            <!--<li><a href="salidabodegaportal.php">Salida</a></li>-->
			<li><a href="/ERP-Kampeg-PRO/intranet/barcodegen/BarInventarios2.php">C&oacute;digos de Barra</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/ERP-Kampeg-PRO/intranet/bodegas.php">Clientes<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<li><a href="/ERP-Kampeg-PRO/intranet/customer.php">Clientes</a></li>
            <!--<li><a href="cambios.php">Cambios</a></li>
            <li><a href="efectivos.php">Efectivos</a></li>-->
            <li><a href="/ERP-Kampeg-PRO/intranet/cheques.php">Cheques</a></li>
            <li><a href="/ERP-Kampeg-PRO/intranet/generalCredito.php">Créditos</a></li>
			<li><a href="/ERP-Kampeg-PRO/intranet/customer_sucursal.php">Sucursal Clientes</a></li>
            <!-- <li><a href="marcarimpagas.php">Marcar Impagas</a></li> -->
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Cajero' || $userposition=='Administrador'){?>
      <li><a href="/ERP-Kampeg-PRO/intranet/supplier.php">Proveedores</a></li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="/ERP-Kampeg-PRO/intranet/bodegas.php">Reportes<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<li><a href="/ERP-Kampeg-PRO/intranet/reporteVentas.php">Reporte de ventas</a></li>
        	<li><a href="/ERP-Kampeg-PRO/intranet/reporteProductos.php">Reporte de productos vendidos</a></li>
        	<li><a href="/ERP-Kampeg-PRO/intranet/reporteCompras.php">Reporte de compras</a></li>
            <li><a href="/ERP-Kampeg-PRO/intranet/reporteCaja.php">Reporte Caja Diaria</a></li>
			<li><a href="/ERP-Kampeg-PRO/intranet/reporteClienteCartola.php">Reporte Cliente Cartola</a></li>
			<li><a href="/ERP-Kampeg-PRO/intranet/reporteInventario.php">Reporte Inventario Empresa</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Cajero' || $userposition=='Administrador'){?>
      <li><a href="#">Movimientos</a></li>
      <?php }?>
      <?php if($userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Gesti&oacute;n SII<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/ERP-Kampeg-PRO/intranet/foliosDisponible.php">Folios Disponibles/Talonarios Electr&oacute;nicos (CAF)</a></li>
		  <li><a href="/ERP-Kampeg-PRO/intranet/ImportarLibroVentasXML.php">Generar/Enviar Libros Vta/Comp al SII</a></li>
		  <li><a href="/ERP-Kampeg-PRO/intranet/recibidosDTE.php">DTE Recibidos</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/pendientesSii.php">Folios Pendientes enviar SII (IMPORTANTE!!)</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenedor<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/ERP-Kampeg-PRO/intranet/empresa.php">Empresa</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/sucursal.php">Sucursal</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/bodegas.php">Bodegas</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/secciones.php">Secci&oacute;n</a></li>
		  <li><a href="/ERP-Kampeg-PRO/intranet/subsecciones.php">Subsecci&oacute;n</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/productos.php">Productos</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/customer.php">Clientes</a></li>
		  <li><a href="/ERP-Kampeg-PRO/intranet/customer_sucursal.php">Sucursal Clientes</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/supplier.php">Proveedores</a></li>
		  <!--<li><a href="/ERP-Kampeg-PRO/intranet/supplier_sucursal.php">Sucursal Proveedores</a></li>-->
          <li><a href="/ERP-Kampeg-PRO/intranet/user.php">Usuarios</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/group.php">Grupo</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/family.php">Familia</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/subfamily.php">Sub-Familia</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/centrocosto.php">Centro de Costo</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Cajero'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenedor<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/ERP-Kampeg-PRO/intranet/productos.php">Productos</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/customer.php">Clientes</a></li>
		  <li><a href="/ERP-Kampeg-PRO/intranet/customer_sucursal.php">Sucursal Clientes</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/supplier.php">Proveedores</a></li>
		  <!--<li><a href="/ERP-Kampeg-PRO/intranet/supplier_sucursal.php">Sucursal Proveedores</a></li>-->
          <li><a href="/ERP-Kampeg-PRO/intranet/user.php">Usuarios</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/group.php">Grupo</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/family.php">Familia</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/subfamily.php">Sub-Familia</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/centrocosto.php">Centro de Costo</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenedor<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/ERP-Kampeg-PRO/intranet/productos.php">Productos</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/customer.php">Clientes</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/supplier.php">Proveedores</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Bodeguero'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenedor<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/ERP-Kampeg-PRO/intranet/bodegas.php">Bodegas</a></li>
          <li><a href="/ERP-Kampeg-PRO/intranet/secciones.php">Secci&oacute;n</a></li>
        </ul>
      </li>
      <?php }?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Empresa:<strong> 
	  		<?php 
				$result = mysql_query("SELECT * from empresa WHERE empresa_id = $sesionEmpresaID");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{ echo $row['empresa_nombre'];}
			?>
      </strong></a></li>
      <li><a href="#">Sucursal:<strong> 
	  		<?php 
				$result = mysql_query("SELECT * from sucursal WHERE sucursal_id = $sesionSucursalID");
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{ echo $row['sucursal_nombre'];}
			?>
      </strong></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>Bienvenido:<strong> <?php echo $_SESSION['SESS_FIRST_NAME'];?></strong></a></li>
      <li><a href="/ERP-Kampeg-PRO/index.php"><font color="red"><i class="icon-off icon-large"></i></font> Cerrar Sesi&oacute;n</a></li>
    </ul>
  </div>
</nav>
