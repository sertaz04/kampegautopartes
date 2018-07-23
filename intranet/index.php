
<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container"> 
       <div id="mainmain">
		
            <div class="row">
                <div class="col-sm-4"><a href="compras.php?tipo=26"><img src="../img/compra2_opt.jpg" alt="Factura" width="200"><br>Compras Factura</a></div>
                <div class="col-sm-4"><a href="ventas.php?tipo=26"><img src="../img/venta.jpg" alt="Factura" width="200"><br>Ventas Factura</a></div>
                <div class="col-sm-4"><a href="salidabodegaportal.php"><img src="../img/BODEGA2_opt.jpg" alt="Factura" width="200"><br> Bodega</a></div>
            </div>
            <div class="row">
                <div class="col-sm-4"><a href="customer.php"><img src="../img/cliente2_opt.jpg" alt="Factura" width="200"><br> Clientes</a></div>
                <div class="col-sm-4"><a href="supplier.php"><img src="../img/proveedor_opt.jpg" alt="Factura" width="200"><br> Proveedores</a></div>
                <div class="col-sm-4"><a href="../index.php"><img src="../img/salir.jpg" alt="Salir" width="200"><br> Salir</a></div>
            </div>
      
       </div>
       </div>
	</body>
</html>