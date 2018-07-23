<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_TYPE']);
	unset($_SESSION['SESS_EMPRESA_ID']);
?>
<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery-2.2.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
		
       <div class="container">
       
       	<div align="center">
        	<img src="img/logo_kampegsa.jpg" alt="">
        </div>
    <?php
        if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
            foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
            }
            unset($_SESSION['ERRMSG_ARR']);
        }else{
            echo '<div style="color: red; text-align: center;"></div><br>';
            }
        ?>
        

        <div class="wrapper">
		<form role="form" action="login.php" method="post">
            <div class="form-group">
              <label for="username">Usuario:</label>
              <input type="input" class="form-control" id="username" name="username" placeholder="Ingrese Usuario">
            </div>
            <div class="form-group">
              <label for="password">Contrase&ntilde;a:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contrase&ntilde;a">
            </div>
            <div class="checkbox">
              <label><input type="checkbox">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-default">Acceder</button>
          </form>
          </div>
        </div>
	</body>
</html>