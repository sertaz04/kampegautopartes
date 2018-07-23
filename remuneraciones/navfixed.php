 <?php include('../connect.php');?>
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ERP Kampeg</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Inicio</a></li>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Archivos<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="personal.php?tipo=51">Personal</a></li>
		  <li><a href="haberes.php?tipo=51">Haberes</a></li>
		  <li><a href="descuentos.php?tipo=51">Descuentos</a></li>
		  <li><a href="afp.php?tipo=51">AFP</a></li>
		  <li><a href="isapre.php?tipo=51">Isapre</a></li>
		  <!--<li><a href="seccion.php?tipo=51">Secci&oacute;n</a></li>
		  <li><a href="cuentas.php?tipo=51">Cuentas</a></li>-->
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Movimientos<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="ventas.php?tipo=51">Haberes</a></li>
		  <li><a href="ventas.php?tipo=51">Descuentos</a></li>
		  <li><a href="ventas.php?tipo=51">Anticipos</a></li>
		  <li><a href="ventas.php?tipo=51">Atrasos</a></li>
		  <li><a href="ventas.php?tipo=51">Inasistencias</a></li>
		  <li><a href="ventas.php?tipo=51">D�as Trabajados (trabaj sueldo diario)</a></li>
		  <li><a href="ventas.php?tipo=51">Horas Extras</a></li>
		  <li><a href="ventas.php?tipo=51">Pr�stamos</a></li>
		  <li><a href="ventas.php?tipo=51">Cargas retroactivas</a></li>
		  <li><a href="ventas.php?tipo=51">F / 1887 Meses Anteriores</a></li>
		  <li><a href="ventas.php?tipo=51">Diferencia de Gratificaci&oacute;n</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="bodegas.php">Informes<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<li><a href="ingresobodegaportal.php">Liquidaciones de sueldo</a></li>
            <li><a href="salidabodegaportal.php">planillas</a></li>
			<li><a href="salidabodegaportal.php">Libro de Remuneraciones</a></li>
			<li><a href="salidabodegaportal.php">Contrato</a></li>
			<li><a href="salidabodegaportal.php">Finiquito</a></li>
			<li><a href="salidabodegaportal.php">Desglose monedas, billetes y cheques</a></li>
			<li><a href="salidabodegaportal.php">Lista de Bancos a Depositar</a></li>
			<li><a href="salidabodegaportal.php">N&oacute;mica para Bancos</a></li>
			<li><a href="salidabodegaportal.php">Empleados con Seguro de Cesant&iacute;a</a></li>
			<li><a href="salidabodegaportal.php">Empleados con A.P.V.</a></li>
			<li><a href="salidabodegaportal.php">Certificado de Renta Trabajadores</a></li>
			<li><a href="salidabodegaportal.php">Declaraci&oacute;n Anua Rentas S.I.I F. /1887</a></li>
			<li><a href="salidabodegaportal.php">Crear Archivo F/1887</a></li>
			<li><a href="salidabodegaportal.php">Gratificaci&oacute;n Anual 30%</a></li>
			<li><a href="salidabodegaportal.php">Graficar gastos Centros de Costos</a></li>
			<li><a href="salidabodegaportal.php">Graficar Imposiciones en AFPs</a></li>
			<li><a href="salidabodegaportal.php">Comprobantes de Feriado</a></li>
			<li><a href="salidabodegaportal.php">Impresi&oacute;n de Cheques</a></li>
			<li><a href="salidabodegaportal.php">Cuadratura Mensual</a></li>
			<li><a href="salidabodegaportal.php">Centralizaci&oacute;n</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="bodegas.php">Periodo<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<li><a href="customer.php">Cierre de Mes</a></li>
            <li><a href="customer.php">Cambio de Mes</a></li>
			<li><a href="customer.php">Modificar Meses Anteriores</a></li>
			<li><a href="customer.php">Reajustar Sueldos</a></li>
        </ul>
      </li>
      <?php }?>
      <?php if($userposition=='Vendedor' || $userposition=='Cajero' || $userposition=='Administrador'){?>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="bodegas.php">Opciones<span class="caret"></span></a>
      	<ul class="dropdown-menu">
        	<li><a href="reporteVentas.php">Tabla de Par&aacute;metros</a></li>
        	<li><a href="reporteProductos.php">Ingresar UF y UTM</a></li>
        	<li><a href="reporteCompras.php">Ingresar Factores de Act.</a></li>
            <li><a href="reporteCaja.php">Ingreso de M&oacute;dulos</a></li>
			<li><a href="reporteClienteCartola.php">Configurar Cheques</a></li>
			<li><a href="reporteInventario.php">Modificar C&oacute;digos Previred</a></li>
			<li><a href="reporteInventario.php">Configurar Textos </a></li>
			<li><a href="reporteInventario.php">Eliminar Sobregiro</a></li>
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
      <li><a href="../index.php"><font color="red"><i class="icon-off icon-large"></i></font> Cerrar Sesi&oacute;n</a></li>
    </ul>
  </div>
</nav>
