<?php if ($create == "Y"): ?>
<h3 id="adduser">FORM INPUT</h3>
<form id="form">
	<fieldset id="personal">
		<legend>Data</legend>
		<div style="float: left; width: 400px;">
			<label for="paket">Paket : </label> 
			<select name="selectPacketType" id="selectPacketType">
				<option value="Y">Baru</option>
				<option value="N">Dari Space</option>
				<option value="B">Dari Brandcomm</option>
			</select>
			<span class="txtSpace" style="display: none;">
			<br>
			<label for="space">Dari Space : </label> 
			<input type="radio" name="rdbSpace" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
			<input type="radio" name="rdbSpace" value="N" /> Cari
			<br>
			<label for="nbsp">&nbsp;</label>
			<input name="txtNoSpace" id="txtNoSpace" type="text" /> <span class="error" id="errTxtNoSpace"></span>
			</span>
			<span class="txtBrandcomm" style="display: none;">
			<br>
			<label for="brandcomm">Dari Brandcomm : </label> 
			<input type="radio" name="rdbBrandcomm" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
			<input type="radio" name="rdbBrandcomm" value="N" /> Cari
			<br>
			<label for="nbsp">&nbsp;</label>
			<input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" /> <span class="error" id="errTxtNoBrandcomm"></span>
			</span>
			<?php /*
			<br>
			<label for="nopaket">No Paket : </label>
			<input name='txtNoPaket' id='txtNoPaket' type='text' disabled='disabled' value='<?php echo $no_paket; ?>' /> <span class="error" id="errTxtNoPaket"></span>
			*/ ?>
			<br>
			<label for="agency">Agency : </label>
			<select name="selectAgency" id="selectAgency" style="width: 150px;">
				<option value="-">-</option>
				<?php foreach ($all_agency as $agency): ?>
				<option value="<?php echo $agency->id; ?>"><?php echo $agency->name; ?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<label for="client">Client : </label> 
			<select name="selectClient" id="selectClient" style="width: 150px;">
				<?php foreach ($all_client as $client): ?>
				<option value="<?php echo $client->id; ?>"><?php echo $client->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div style="float: left;">
			<label for="budget">Budget : </label> 
			<input name="txtBudget" id="txtBudget" type="text" />
			<br>
			<label for="diskon">Diskon : </label> 
			<input name="txtDiskon" id="txtDiskon" type="text" /> <span class="error" id="errTxtDiskon"></span>
			<br>
			<label for="benefit">Benefit : </label> 
			<input name="txtBenefit" id="txtBenefit" type="text" />
			<br>
			<label for="miscinfo">Keterangan : </label> 
			<textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"></textarea>
		</div>
	</fieldset>
	<div id="addbrandcomm"></div>
	<fieldset id="paket">
		<legend>Paket</legend>
		<button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errPaket"></span>
		<table>
			<thead>
				<th>Iklan</th>
				<th>Kanal</th>
				<th>Produk Grup</th>
				<th>Posisi</th>
				<th>Periode</th>
				<th>Keterangan</th>
				<th>&nbsp;</th>
			</thead>
			<tbody id="addme">			
			</tbody>
		</table>
	</fieldset>
	<fieldset id="conflict">
		<legend>Conflict Brand</legend>
		<label for="conflict">Conflict Brand : </label> 
		<input type="checkbox" name="chkIsRestrict" id="chkIsRestrict" value="Y" checked="checked" /> Ya
		<span class="industry">
		<br>
		<label for="industry">Industri : </label>
		<select name="selectIndustry" id="selectIndustry">
			<?php foreach ($all_industry as $industry): ?>
			<option value="<?php echo $industry->id; ?>"><?php echo $industry->name; ?></option>	
			<?php endforeach; ?>
		</select>
		</span>
	</fieldset>
	<fieldset id="others">
		<legend>Others</legend>
		<div style="float: left; width: 400px;">
			<label for="miscinfo">Event : </label> 
			<textarea name="txtMiscInfoEvent" id="txtMiscInfoEvent" style="height: 80px; width: 250px;"></textarea>
		</div>
		<div style="float: left;">
			<label for="miscinfo">Production Cost : </label> 
			<textarea name="txtMiscInfoProductionCost" id="txtMiscInfoProductionCost" style="height: 80px; width: 250px;"></textarea>
		</div>
	</fieldset>
	<div class="ajax-loader" style="display: none;">&nbsp;</div>
	<div align="center">
		<input id="button1" type="button" value="Simpan" onclick="ajaxChange('order', 'insert', '<?php echo site_url("order/insert"); ?>', '<?php echo site_url("order/content"); ?>', '<?php echo site_url("order/insert_page"); ?>')" /> 
		<input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("order/insert_page"); ?>')" />
	</div>
</form>

<script type="text/javascript">
	/*var unavailableDates = ["29-12-2011","30-12-2011"];

	function unavailable(date) {
	    dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
	    
	    if ($.inArray(dmy, unavailableDates) == -1)
	        return [true, ""];
	    
	    return [false,""];
	}*/
	
	function reset_field() {
		$("#txtNoSpace").val("");
		$("#txtNoBrandcomm").val("");
		$("#addbrandcomm").empty();
		$("#addme").empty();
		$('select[name=selectAgency] option').eq(0).attr('selected', 'selected');
		$('select[name=selectClient] option').eq(0).attr('selected', 'selected');
		$('select[name=selectIndustry] option').eq(0).attr('selected', 'selected');
	}

	$(document).ready(function() {
		$("#btnTambah").click(function() {
			$("#addme").append("<tr class='remove'>"+
							   "	<td align='center'>"+
							   "		<select name='selectAds' id='selectAds'>"+
							   "			<?php foreach ($all_ads as $ads): ?>"+
							   "			<option value='<?php echo $ads->id; ?>'><?php echo $ads->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectKanal' id='selectKanal'>"+
							   "			<?php foreach ($all_kanal as $kanal): ?>"+
							   "			<option value='<?php echo $kanal->id; ?>'><?php echo $kanal->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectProductGroup' id='selectProductGroup'>"+
							   "			<?php foreach ($all_productgroup as $productgroup): ?>"+
							   "			<option value='<?php echo $productgroup->id; ?>'><?php echo $productgroup->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<select name='selectPosition' id='selectPosition'>"+
							   "			<?php foreach ($all_position as $position): ?>"+
							   "			<option value='<?php echo $position->id; ?>'><?php echo $position->name; ?></option>"+
							   "			<?php endforeach; ?>"+
							   "		</select>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<input name='txtStartDate' class='txtStartDate' type='text' size='7' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
							   "		-"+
							   "		<input name='txtEndDate' class='txtEndDate' type='text' size='7' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 150px;'></textarea>"+
							   "	</td>"+
							   "	<td align='center'>"+
							   "		<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
							   "		<div class='error' id='errConflict'></div>"+
							   "	</td>"+
							   "</tr>");
		});
		
		// gunakan fungsi live untuk membind event 'click' ke #btnHapus
		$("#btnHapus").die('click').live('click', function() {
			$(this).parents(".remove").remove();
		});
		
		// gunakan fungsi live untuk membind event 'change' ke #selectKanal
		$("#selectKanal").die('change').live('change', function() {
			var index = $(this).parents(".remove").prevAll().length;
			
			loadListOption(index, '<?php echo site_url("order/get_product_group"); ?>', 'selectKanal', 'selectProductGroup');
		});
		
		// gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
		$("#selectProductGroup").die('change').live('change', function(event, index) {
			if (index == undefined)
				var index = $(this).parents(".remove").prevAll().length;
				
			loadListOption(index, '<?php echo site_url("order/get_position"); ?>', 'selectProductGroup', 'selectPosition');
		});
		
		// untuk autocomplete No Space
		$("#txtNoSpace").autocomplete({
			source: "<?php echo site_url("order/get_space"); ?>",
			minLength: 0,
			select: function(event, ui) {
				$("select[name=selectAgency] option").each(function() {
					if ($(this).val() == ui.item.agency_id)
						$(this).attr("selected", "selected");
				});
				$("select[name=selectClient] option").each(function() {
					if ($(this).val() == ui.item.client_id)
						$(this).attr("selected", "selected");
				});
				// $("select[name=selectAe] option").each(function() {
					// if ($(this).val() == ui.item.ae_username)
						// $(this).attr("selected", "selected");
				// });
				
				if (ui.item.is_restrict == "Y") {
					/*$("#chkIsRestrict").attr("checked", "checked");
					$(".industry").show();*/
					$("select[name=selectIndustry] option").each(function() {
						if ($(this).val() == ui.item.industry_id) {
							$(this).attr("selected", "selected");
							return false;
						}
					});
				} else {
					$("#chkIsRestrict").removeAttr("checked");
					$(".industry").hide();
				}
				
				// untuk load paket
				loadDetail('<?php echo site_url("order/get_space_detail"); ?>', ui.item.value);
			}
		});
		
		// untuk autocomplete No Brandcomm
		$("#txtNoBrandcomm").autocomplete({
			source: "<?php echo site_url("order/get_brandcomm"); ?>",
			minLength: 0,
			select: function(event, ui) {
				// untuk load brandcomm
				loadDetail('<?php echo site_url("order/get_brandcomm_detail"); ?>', ui.item.value, "#addbrandcomm");
			}
		});
		
		// untuk menampilkan inputan industri
		$("#chkIsRestrict").click(function() {
			if ($(this).is(":checked"))
				$(".industry").show();
			else
				$(".industry").hide();
		});
		
		$("#selectPacketType").change(function() {
			if ($(this).val() == "Y")
				loadForm('<?php echo site_url("order/insert_page"); ?>')
			else if ($(this).val() == "N") {
				reset_field();
				$(".txtBrandcomm").hide();
				$(".txtSpace").show();
			} else {
				reset_field();
				$(".txtSpace").hide();
				$(".txtBrandcomm").show();
				// $(".txtSpace").find("label[for=space]").text("Dari Brandcomm : ");
				// $(".txtSpace").find("input[name=rdbSpace]").attr("name", "rdbBrandcomm");
				// $(".txtSpace").find("input[name=txtNoSpace]").attr("id", "txtNoBrandcomm");
				// $(".txtSpace").find("input[name=txtNoSpace]").attr("name", "txtNoBrandcomm");
				// $(".txtSpace").find(".error").attr("id", "errTxtNoBrandcomm");
			}
		});
		
		// untuk menampilkan inputan no space
		$("input[name=rdbSpace]").click(function() {
			if ($(this).val() == "N")
				loadForm('<?php echo site_url("order/search_page"); ?>')
		});
		
		// untuk menampilkan inputan no space
		$("input[name=rdbBrandcomm]").click(function() {
			if ($(this).val() == "N")
				loadForm('<?php echo site_url("order/search_page/B"); ?>')
		});
	});
</script>
<?php endif; ?>