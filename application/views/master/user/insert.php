<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<label for="username">Username : </label> 
		<input name="txtUsername" id="txtUsername" type="text" /> <span class="error" id="errTxtUsername"></span>
		<br>
		<label for="password">Password : </label> 
		<input name="txtPassword" id="txtPassword" type="password" /> <span class="error" id="errTxtPassword"></span>
		<br>
		<label for="name">Nama : </label> 
		<input name="txtName" id="txtName" type="text" />
		<br>
		<label for="email">Email : </label> 
		<input name="txtEmail" id="txtEmail" type="text" />
		<br>
		<label for="departemen">Departemen : </label> 
		<select name="selectDepartment" id="selectDepartment">
			<?php foreach ($all_department as $department): ?>
			<option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
			<?php endforeach; ?>
		</select>
		<br>
		<label for="level">Level : </label> 
		<select name="selectLevel" id="selectLevel">
			<?php foreach ($all_level as $level): ?>
			<option value="<?php echo $level->id; ?>"><?php echo $level->name; ?></option>
			<?php endforeach; ?>
		</select>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('user', 'insert', '<?php echo site_url("master_user/insert"); ?>', '<?php echo site_url("master_user/content"); ?>', '<?php echo site_url("master_user/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_user/insert_page"); ?>')" />
	</div>
</form>
<?php endif; ?>