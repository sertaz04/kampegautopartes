<form action="saveuser.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Usuario</h4>
      </div>
      <div class="modal-body">
      
<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span>Nombre usuario : </span>
	<input type="text" style="width:265px; height:30px;" name="name" id="name" placeholder="Nombre Completo" required/>
    <br>
	<span>Usuario: </span>
	<input type="text" style="width:265px; height:30px;" name="username" id="username" placeholder="Usuario" required/>
    <br>
   	<span>Rut: </span>
	<input type="text" style="width:265px; height:30px;" name="rut" id="rut" placeholder="Rut" required/>
    <br>
	<span>Contrase&ntilde;a: </span>
	<input type="password" style="width:265px; height:30px;" name="password" id="password" placeholder="Contrase&ntilde;a" required/>	
    <br>
	<span>Repetir Contrasen&ntilde;a: </span>
    <input type="password" style="width:265px; height:30px;" name="password2" id="password2" placeholder="Repetir Contrasen&ntilde;a" required/>
    <br>
    <span>Puesto: </span>
    <select name="position" id="position" required>
    	<option>Vendedor</option>
        <option>Cajero</option>
        <option>Bodeguero</option>
        <option>Administrador</option>
    </select>
    <br>
	<span>Empresa : </span>
    	<select name="empresa" id="empresa" required>
        	<option></option>
			<?php
            include('../connect.php');
            
            $result=mysql_query("SELECT empresa_id, empresa_nombre FROM empresa WHERE `delete`='0'");	    
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            ?>
                <option value="<?php echo $row['empresa_id']; ?>"><?php echo $row['empresa_nombre']; ?></option>
            <?php
            }
            ?>
       </select>
    <br>
    <span>Sucursal : </span>
    	<select name="sucursal" id="sucursal" required>
        	<option></option>
			<?php
            include('../connect.php');
            
            $result=mysql_query("SELECT sucursal_id, sucursal_nombre FROM sucursal");	    
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            ?>
                <option value="<?php echo $row['sucursal_id']; ?>"><?php echo $row['sucursal_nombre']; ?></option>
            <?php
            }
            ?>
       </select>
    <br>
</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>

</form>
