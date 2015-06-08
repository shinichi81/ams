<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<?=$all_data->unit_id;?>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" /> <span class="error" id="errTxtName"></span>
		<br>
		<label for="address">Alamat : </label> 
		<input name="txtAddress" id="txtAddress" type="text" value="<?php echo $all_data->address; ?>" />
		<br>
		<label for="contact">Kontak : </label> 
		<input name="txtContact" id="txtContact" type="text" value="<?php echo $all_data->contact; ?>" />
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
	  <label for="unit">Unit : </label>
	  <div style="float: left"> 
			<select name="selectUnitSource" id="selectUnitSource" multiple="multiple" size="5" style="width: 150px;">
				  <?php foreach ($all_unit as $unit): ?>
						<option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
				  <?php endforeach; ?>
			</select>
	  </div>
	  <div style="float: left; margin-top: 15px; margin-right: 8px;">
			<a href="javascript:void(0);" id="unittodestination">
				  <input id="button2" type="button" value=">>" style="width: 25px" />
			</a>
			<br>
			<a href="javascript:void(0);" id="unittosource">
				  <input id="button2" type="button" value="<<" style="width: 25px" />
			</a>
	  </div>
	  <div style="float: left"> 
			<select name="selectUnitDestination" id="selectUnitDestination" multiple="multiple" size="5" style="width: 150px;">
				  <?php foreach ($selected_unit as $unit): ?>
						<option value="<?php echo $unit->id; ?>"><?php echo $unit->name; ?></option>
				  <?php endforeach; ?>
			</select>
	  </div>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('agency', 'update', '<?php echo site_url("master_agency/update"); ?>', '<?php echo site_url("master_agency/content"); ?>', '<?php echo site_url("master_agency/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_agency/insert_page"); ?>')" />
	</div>
</form>
      <script type="text/javascript">
            $(document).ready(function() {
                  $("#unittodestination").click(function() {
                        move("selectUnitSource", "selectUnitDestination");
                  });
                                                                  		
                  $("#unittosource").click(function() {
                        move("selectUnitDestination", "selectUnitSource");
                  });                                                                  		
            });
                                                                    
            function move(source, destination) {
                  $("select[name="+source+"] option:selected").each(function() {
                        $("select[name="+destination+"]").append($(this).clone());
                        $(this).remove();
                  });
            }
      </script>
<?php endif; ?>