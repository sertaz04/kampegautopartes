
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
                <div class="col-sm-4"><a href="personal.php"><img src="../img/personal2.png" alt="Personal" width="180"><br>Ingreso Personal</a></div>
                <div class="col-sm-4"><a href="haberes.php"><img src="../img/haber.png" alt="Haberes" width="180"><br>Haberes</a></div>
                <div class="col-sm-4"><a href="descuentos.php"><img src="../img/descuentos.png" alt="Descuentos" width="180"><br> Descuentos</a></div>
            </div>
            <div class="row">
                <div class="col-sm-4"><a href="isapre.php"><img src="../img/isapre1.png" alt="Isapre" width="180"><br> Isapres</a></div>
                <div class="col-sm-4"><a href="afp.php"><img src="../img/afp.png" alt="AFP" width="180"><br> AFP</a></div>
                <div class="col-sm-4"><a href="../index.php"><img src="../img/salir.jpg" alt="Salir" width="200"><br> Salir</a></div>
            </div>
      
       </div>
       </div>
	</body>
</html>