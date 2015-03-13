<div id="box">
	<h3 id="adduser">AKUN SAYA</h3>
	<form id="form" method="post" action="<?php echo site_url("myaccount/do_update"); ?>">
	    <fieldset id="personal">
			<legend>Data</legend>
			<label for="change">Ganti Password : </label> 
			<input name="chkChange" id="chkChange" type="checkbox" value="Y" <?php echo ($isError) ? "checked='checked'" : ""; ?> /> Ya
			<span class="txtPassword" <?php echo ($isError) ? "" : "style='display: none;'"; ?> >
			<br>
			<label for="nbsp">&nbsp;</label> 
			Password Lama<br>
			<input name="txtOldPassword" id="txtOldPassword" type="password" />
			<br>
			<label for="nbsp">&nbsp;</label>
			Password Baru<br> 
			<input name="txtNewPassword" id="txtNewPassword" type="password" />
			<br>
			<label for="nbsp">&nbsp;</label>
			Retype Password Baru<br> 
			<input name="txtRetypePassword" id="txtRetypePassword" type="password" />
			</span>
			<br>
			<label for="name">Nama : </label> 
			<input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" />
			<br>
			<label for="email">Email : </label> 
			<input name="txtEmail" id="txtEmail" type="text" value="<?php echo $all_data->email; ?>" />
			<?php if ($isError): ?>
				<div class="error">
					* Password lama harus valid<br> 
					* Password baru dan retype password baru harus cocok
				</div>
			<?php endif; ?>
			<?php if ($isSuccess): ?>
				<div class="success">
					* Edit account berhasil dilakukan silahkan <a href="<?php echo site_url("login"); ?>" style="color: red;">login</a> kembali
				</div>
			<?php endif; ?>
		</fieldset>
		<div align="center">
			<input id="button1" name="btnSubmit" type="submit" value="Simpan" /> 
			<input id="button2" name="btnReset" type="reset" />
		</div>
	</form>
</div>

<?php
if ($isSuccess)
	$this->session->sess_destroy();
?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#chkChange").click(function() {
			if ($(this).is(":checked"))
				$(".txtPassword").show();
			else
				$(".txtPassword").hide();
		});
	});
</script>