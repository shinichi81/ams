<?php if ($update == "Y"): ?>
<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="username">Username : </label> 
		<input name="txtUsername" id="txtUsername" type="text" disabled="disabled" value="<?php echo $all_data->username; ?>" /> <span class="error" id="errTxtUsername"></span>
		<br>
		<label for="password">Password : </label> 
		<input name="txtPassword" id="txtPassword" type="checkbox" /> Reset menjadi "<?php echo $this->config->item("reset_password"); ?>"
		<br>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" />
		<br>
		<label for="email">Email : </label> 
		<input name="txtEmail" id="txtEmail" type="text" value="<?php echo $all_data->email; ?>" />
		<br>
		<label for="departemen">Departemen : </label> 
		<select name="selectDepartment" id="selectDepartment">
			<?php 
			foreach ($all_department as $department):
				$selected = "";
				if ($department->id == $all_data->department_id)
					$selected = "selected='selected'"; 
			?>
			<option value="<?php echo $department->id; ?>" <?php echo $selected; ?>><?php echo $department->name; ?></option>
			<?php 
			endforeach; 
			?>
		</select>
		<br>
		<label for="level">Level : </label> 
		<select name="selectLevel" id="selectLevel">
			<?php 
			foreach ($all_level as $level): 
				$selected = "";
				if ($level->id == $all_data->level_id)
					$selected = "selected='selected'"; 
			?>
			<option value="<?php echo $level->id; ?>" <?php echo $selected; ?>><?php echo $level->name; ?></option>
			<?php 
			endforeach; 
			?>
		</select>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('user', 'update', '<?php echo site_url("master_user/update"); ?>', '<?php echo site_url("master_user/content"); ?>', '<?php echo site_url("master_user/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_user/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>