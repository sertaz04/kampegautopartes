<form action="savesubfamily.php" method="post" id="userForm">
<div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sub-Familia</h4>
      </div>
      <div class="modal-body">

<div id="ac">
<input type="hidden" name="memi" id="memi" />
<span> Familia : </span>
<select name="family" id="family"  style="width:265px; height:30px; margin-left:-5px;" >
<option></option>
	<?php
	include('../connect.php');
	
	$result=mysql_query("SELECT family_id, family_name FROM family WHERE empresa_id = $sesionEmpresaID AND `delete`='0'");	    
		while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
	?>
		<option value="<?php echo $row['family_id']; ?>"><?php echo $row['family_name']; ?></option>
	<?php
	}
	?>
</select><br>
<span>Nombre Sub-Familia : </span><input type="text" style="width:265px; height:30px;" name="subfamily_name" id="subfamily_name" ><br>
<span>Abreviatura : </span>
<input type="text" style="width:265px; height:30px;" name="subfamily_label" id="subfamily_label" ><br>

</div>

     <div class="modal-footer">
      	 <div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Guardar</button>
      	  </div>
     </div>

</div>
</form>
