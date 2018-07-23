<form action="savefamily.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Familia</h4>
      </div>
      <div class="modal-body">

<div id="ac">
	<input type="hidden" name="memi" id="memi" />
	<span> Grupo : </span>
	<select name="group_id" id="group_id"  style="width:265px; height:30px; margin-left:-5px;" >
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
	<span>Nombre Familia : </span>
	<input type="text" style="width:265px; height:30px;" name="family_name" id="family_name" ><br>
	<span>Abreviatura : </span>
	<input type="text" style="width:265px; height:30px;" name="family_label" id="family_label" ><br>


</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>
