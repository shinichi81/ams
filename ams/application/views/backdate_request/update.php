<?php /*if ($update == "Y"): ?>
<?php
// echo css("jquery-ui/jquery.ui.all.css");
// echo js("jquery-ui/jquery.ui.core.js");
// echo js("jquery-ui/jquery.ui.widget.js");
// echo js("jquery-ui/jquery.ui.position.js");
// echo js("jquery-ui/jquery.ui.datepicker.js");
// echo js("jquery-ui/jquery.ui.autocomplete.js");
?>

<h3 id="adduser">FORM UPDATE</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<div style="float: left; width: 400px;">
			<label for="nopaket">No Paket : </label> 
			<input name="txtNoPaket" id="txtNoPaket" type="text" disabled="disabled" value="<?php echo $all_data->no_paket; ?>" />
			<br>
			<label for="agency">Agency : </label> 
			<input name="txtAgency" id="txtAgency" type="text" disabled="disabled" value="<?php echo $all_data->agency; ?>" />
			<br>
			<label for="client">Client : </label> 
			<input name="txtClient" id="txtClient" type="text" disabled="disabled" value="<?php echo $all_data->client; ?>" />
			<br>
			<label for="benefit">Brand : </label> 
			<input name="txtBrand" id="txtBrand" type="text" value="<?php echo $all_data->brand; ?>" /> <span class="error" id="errTxtBrand"></span>
		</div>
		<div style="float: left; width: 400px;">
			<label for="budget">Budget : </label> 
			<input name="txtBudget" id="txtBudget" type="text" disabled="disabled" value="<?php echo $all_data->budget; ?>" />
			<br>
			<label for="benefit">Benefit : </label> 
			<input name="txtBenefit" id="txtBenefit" type="text" disabled="disabled" value="<?php echo $all_data->benefit; ?>" />
			<br>
			<label for="diskon">Diskon : </label> 
			<input name="txtDiskon" id="txtDiskon" type="text" disabled="disabled" value="<?php echo $all_data->diskon; ?>" />
			<br>
			<label for="benefit">Jenis Order : </label> 
			<input type="radio" name="rdbOrderType" value="T" <?php echo ($all_data->request_type == "T") ? "checked='checked'" : ""; ?> /> Tayang Banner&nbsp;
			<input type="radio" name="rdbOrderType" value="D" <?php echo ($all_data->request_type == "D") ? "checked='checked'" : ""; ?> /> Data
			<span class="error" id="errTxtOrderType"></span>
		</div>
		<div style="clear: both;"></div>
		<label for="benefit">Detail : </label> 
		<textarea name="txtDetail" id="txtDetail"><?php echo $all_data->detail; ?></textarea>
	</fieldset>
	<fieldset id="paket">
		<legend>Paket</legend>
		<span class="error" id="errPaket"></span>
		<table>
			<thead>
				<th>Iklan</th>
				<th>Kanal</th>
				<th>Produk Grup</th>
				<th>Posisi</th>
				<th>Periode</th>
				<th>Request</th>
			</thead>
			<tbody>
				<?php foreach ($all_detail as $detail): ?>
				<tr class='remove'>
					<td align='center'>
			   		<?php echo $detail["ads"]; ?>
				   	</td>
				   	<td align='center'>
				   		<?php echo $detail["kanal"]; ?>
				   	</td>
				   	<td align='center'>
				   		<?php echo $detail["product_group"]; ?>
				   	</td>
				   	<td align='center'>
				   		<?php echo $detail["position"]; ?>
				   	</td>
				   	<td align='center'>
				   		<?php echo format_date($detail["start_date"], TRUE); ?>
				   		-
				   		<?php echo format_date($detail["end_date"], TRUE); ?>
				   	</td>
				   	<td align="center">
				   		<input type="checkbox" name="chkRequest" value="<?php echo $detail["id"]; ?>" checked="checked" />
				   	</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
		<input name="hdNoPaket" id="hdNoPaket" type="hidden" value="<?php echo $all_data->no_paket; ?>" />
	</fieldset>
	<fieldset id="conflict">
		<legend>Conflict Brand</legend>
		<label for="conflict">Conflict Brand : </label> 
		<input type="checkbox" name="chkIsRestrict" id="chkIsRestrict" disabled="disabled" value="Y" <?php echo ($all_data->is_restrict == "Y") ? "checked='checked'" : ""; ?> /> Ya
		<span class="industry" <?php echo ($all_data->is_restrict == "Y") ? "" : "style='display: none;'"; ?>>
		<br>
		<label for="industry">Industri : </label>
		<input name="txtIndustry" id="txtIndustry" type="text" disabled="disabled" value="<?php echo $all_data->industry_id; ?>" />
		</span>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('request', 'update', '<?php echo site_url("request/update"); ?>', '<?php echo site_url("request/content"); ?>', '<?php echo site_url("request/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("request/insert_page"); ?>')" />
	</div>
</form>
<?php endif;*/ ?>