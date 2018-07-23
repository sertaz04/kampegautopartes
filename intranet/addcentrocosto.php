<form action="savecentrocosto.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Centro Costo</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span>C&oacute;digo : </span>
	<input type="text" style="width:265px; height:30px;" name="centro_codigo" id="centro_codigo" ><br>
	<span>Nombre : </span>
	<input type="text" style="width:265px; height:30px;" name="centro_name" id="centro_name" ><br>
    <span>Empresa : </span>
    	<select name="empresa" id="empresa" required>
        	<option></option>
			<?php
            include('../connect.php');
            
            $result=mysql_query("SELECT empresa_id, empresa_nombre FROM empresa WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
                while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
            ?>
                <option value="<?php echo $row['empresa_id']; ?>"><?php echo $row['empresa_nombre']; ?></option>
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
