<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="paket">Paket : </label> 
                        <select name="selectPacketType" id="selectPacketType">
                              <option value="Y">Baru</option>
                              <option value="N" <?php echo ($type == "S") ? "selected='selected'" : ""; ?>>Dari Space</option>
                              <option value="B" <?php echo ($type == "B") ? "selected='selected'" : ""; ?>>Dari Brandcomm</option>
                        </select>
                        <span class="txtSpace" <?php echo ($type == "S") ? "" : "style='display: none;'"; ?>>
                              <br>
                              <label for="space">Dari Space : </label> 
                              <input type="radio" name="rdbSpace" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
                              <input type="radio" name="rdbSpace" value="N" /> Cari
                              <br>
                              <label for="nbsp">&nbsp;</label>
                              <input name="txtNoSpace" id="txtNoSpace" type="text" />
                        </span>
                        <span class="txtBrandcomm" <?php echo ($type == "B") ? "" : "style='display: none;'"; ?>>
                              <br>
                              <label for="brandcomm">Dari Brandcomm : </label> 
                              <input type="radio" name="rdbBrandcomm" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
                              <input type="radio" name="rdbBrandcomm" value="N" /> Cari
                              <br>
                              <label for="nbsp">&nbsp;</label>
                              <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" />
                        </span>
                        <span class="error" id="errTxtNo"></span>
                        <?php /*
                          <br>
                          <label for="nopaket">No Paket : </label>
                          <input name='txtNoPaket' id='txtNoPaket' type='text' disabled='disabled' value='<?php echo $no_paket; ?>' /> <span class="error" id="errTxtNoPaket"></span>
                         */ ?>
                        <br>
                        <label for="agency">Perusahaan : </label>
                        <select name="selectAgency" id="selectAgency" style="width: 150px;">
								<option value="" disabled selected>-- Pilih Perusahaan --</option>
                              <?php foreach ($all_agency as $agency): ?>
                                    <option value="<?php echo $agency->id; ?>"><?php echo $agency->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="unit">Unit : </label> 
                        <select name="selectUnit" id="selectUnit" style="width: 150px;">
								<option value="" disabled selected>-- Pilih Unit --</option>
                        </select>
                        <br>
                        <label for="client">Brand : </label> 
                        <select name="selectClient" id="selectClient" style="width: 150px;">
								<option value="" disabled selected>-- Pilih Brand --</option>
                              <?php foreach ($all_client as $client): ?>
                                    <option value="<?php echo $client->id; ?>"><?php echo $client->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div style="float: left;">
                        <label for="budget">Budget : </label> 
                        <input name="txtBudget" id="txtBudget" type="text" />
                        <br>
                        <label for="campaign">Campaign : </label> 
                        <input name="txtCampaign" id="txtCampaign" type="text" />
<!--                        <br>
                        <label for="benefit">Benefit : </label> 
                        <input name="txtBenefit" id="txtBenefit" type="text" />
                        <br>
                        <label for="miscinfo">Keterangan : </label> 
                        <textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"></textarea>
-->
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
                        <th>Imps Quota/Day</th>
                        <th>Periode</th>
                        <th>Harga / Hari</th>
                        <th>Harga Total</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody id="addme">			
                        </tbody>
                  </table>
				  <div style="float:right; margin-right:50px;">
					<label>Harga Sistem :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input id="total" style="width:100px;" type="text" value="0" />
				  </div>
				  <br />
                  <label for="hargaGross">Harga Paket Gross : </label> 
                  <input name="hargaGross" id="hargaGross" type="text" value="0" onKeyPress="gantiHarga()" onKeyUp="gantiHarga()" />
                  <br>
					<label for="diskon">Diskon : </label> 
					<input name="txtDiskon" id="txtDiskon" type="text" value="0" onKeyPress="gantiHarga()" onKeyUp="gantiHarga()" /> <span class="error" id="errTxtDiskon"></span>
					<br />
					<label for="additionalDiskon">Additional Diskon : </label> 
					<input name="txtAddDiskon" id="txtAddDiskon" type="text" value="0" onKeyPress="gantiHarga()" onKeyUp="gantiHarga()" />
					<br />
                  <label for="diskonNominal">Diskon (Nominal) : </label> 
                  <input name="diskonNominal" id="diskonNominal" type="text" value="0" readonly />
				  <br />
                  <label for="addDiskonNominal">Additional Diskon (Nominal) : </label> 
                  <input name="addDiskonNominal" id="addDiskonNominal" type="text" value="0" readonly />
            </fieldset>
            <fieldset id="production">
                  <legend>Production Cost</legend>
                  <button type="button" name="btnTambahProduction" id="btnTambahProduction" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button>
                  <table>
                        <thead>
                        <th>Production</th>
                        <th>Qty</th>
                        <th>Biaya</th>
                        <th>Biaya Total</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody id="addmeProduction">			
                        </tbody>
                  </table>
            </fieldset>
            <fieldset id="event">
                  <legend>Event</legend>
                  <button type="button" name="btnTambahEvent" id="btnTambahEvent" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button>
                  <table>
                        <thead>
                        <th>Event</th>
                        <th>Periode</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody id="addmeEvent">			
                        </tbody>
                  </table>
            </fieldset>
			<fieldset id="totalSemua">
					<legend>Total Biaya</legend>
					<label>Total Harga Paket :</label> 
					<input name="totalHarga" id="totalHarga" type="text" value="0" readonly />
					<br>
					<label>Total Harga Produksi :</label>
					<input name="totalProduction" id="totalProduction" type="text" value="0" readonly />
					<br>
					<label>Total Harga Event :</label>
					<input name="totalEvent" id="totalEvent" type="text" value="0" readonly />					
					<br>
					<label>PPN :</label>
					<input name="pajak" id="pajak" type="text" value="0" />
					<br>
					<label>Total Biaya Keseluruhan :</label>
					<input name="totalSemua" id="akhir" type="text" value="0" />
			</fieldset>
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflict">Conflict Brand : </label> 
                  <input type="checkbox" name="chkIsRestrict" id="chkIsRestrict" value="Y" checked="checked" /> Ya
                  <span class="industry_cat">
                        <br>
                        <label for="industry_cat">Industri : </label>
                        <select name="selectIndustryCat" id="selectIndustryCat">
									<option value="" disabled selected>-- Pilih Industri --</option>
                              <?php foreach ($all_industry_cat as $industry_cat): ?>
                                    <option value="<?php echo $industry_cat->id; ?>"><?php echo $industry_cat->industry_name; ?></option>	
                              <?php endforeach; ?>
                        </select>
						<span class="error" id="errSelectIndustryCat"></span>
                  </span>
				  <span class="industry">
                        <br>
                        <label for="industry">Sub Industri : </label>
                        <select name="selectIndustry" id="selectIndustry">
									<option value="" disabled selected>-- Pilih Sub Industri --</option>
                              <?php foreach ($all_industry as $industry): ?>
                                    <option value="<?php echo $industry->id; ?>"><?php echo $industry->name; ?></option>	
                              <?php endforeach; ?>
                        </select>
						<span class="error" id="errSelectIndustry"></span>
                  </span>
            </fieldset>
<!--
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
-->
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('order', 'insert', '<?php echo site_url("order/insert"); ?>', '<?php echo site_url("order/content"); ?>', '<?php echo site_url("order/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("order/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
			//loadListOption3('<?php echo site_url("order/get_industrycat"); ?>', 'selectIndustryCat', 'selectIndustry');
			
			Number.prototype.formatMoney = function(c, d, t){
				var n = this, 
					c = isNaN(c = Math.abs(c)) ? 2 : c, 
					d = d == undefined ? "," : d, 
					t = t == undefined ? "." : t, 
					s = n < 0 ? "-" : "", 
					i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
					j = (j = i.length) > 3 ? j % 3 : 0;
				   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			};
 
            function numberOnly(e) {
                  var charCode = (e.which) ? e.which : e.keyCode;
                                          		
                  if (!((charCode >= 48 && charCode <= 57) || charCode == 8 || charCode == 9))
                        return false;
            }
                                                
            function currencySeparator(obj, separator) {
                  a = obj.value;
                  b = a.replace(/[^\d]/g, "");
                  c = "";
                  panjang = b.length;
                  j = 0;
                                          	  	
                  for (i = panjang; i > 0; i--) {
                        j = j + 1;
                        if (((j % 3) == 1) && (j != 1)) {
                              c = b.substr(i-1,1) + separator + c;
                        } else {
                              c = b.substr(i-1,1) + c;
                        }
                  }
                  obj.value = c;
            }
                                                      
            /*var unavailableDates = ["29-12-2011","30-12-2011"];

              function unavailable(date) {
                  dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
                                                                  	    
                  if ($.inArray(dmy, unavailableDates) == -1)
                      return [true, ""];
                                                                  	    
                  return [false,""];
              }*/

            $(document).ready(function() {
				var simpan = parseInt($("#total").val());
				var simpanProd = parseInt($("#totalProduction").val());
				var simpanEvent = parseInt($("#totalEvent").val());
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
                              "		<?php foreach ($all_position as $position): ?>"+
                                    "                       <option value='<?php echo $position->id; ?>' rel='<?php echo (in_array($position->id, $all_default_cpm_position)) ? "Y" : "N"; ?>'><?php echo $position->name; ?></option>"+
                                    "                <?php endforeach; ?>"+
                              "		</select>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<input name='txtCpmQuota' type='text' style='width:50px; <?php echo (in_array($all_position[0]->id, $all_default_cpm_position)) ? "" : "background-color:#DCDCDC"; ?>' <?php echo (in_array($all_position[0]->id, $all_default_cpm_position)) ? "" : "readonly='readonly'"; ?> onkeyup='currencySeparator(this, \".\")' onkeydown='return numberOnly(event);' value='0' />"+
                              "                 <a href='javascript:void(0);' <?php echo (in_array($all_position[0]->id, $all_default_cpm_position)) ? "" : "style='display:none;'"; ?> id='show_cpm'><img src='<?php echo image_path("icons/info.ico"); ?>' align='top' /></a>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<input name='txtStartDate' class='txtStartDate' type='text' style='width:70px;' readonly='readonly' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
                              "		-"+
                              "		<input name='txtEndDate' class='txtEndDate' type='text' style='width:70px;' readonly='readonly' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
                              "	</td>"+
                              "	<td align='center'>"+
							  "		<div id='harga'>"+
							  "			<input name='txtHarga' id='txtHarga' type='text' readonly='readonly' style='width: 70px;' value='<?= number_format($harga->harga,0,",","."); ?>' />"+
							  "		</div>"+
                              "	</td>"+
                              "	<td align='center'>"+
							  "		<div id='hargaTotal'>"+
							  "			<input name='txtHargaTotal' id='txtHargaTotal' type='text' readonly='readonly' style='width: 70px;' value='<?= number_format($harga->harga,0,",","."); ?>' />"+
							  "		</div>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 130px;'></textarea>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
                              "		<div class='error' id='errConflict'></div>"+
                              "	</td>"+
                              "</tr>");
							  
						simpan = simpan + <?= $harga->harga; ?>;
						document.getElementById('total').value = simpan.formatMoney(0);
						document.getElementById('hargaGross').value = simpan;
						gantiHarga();
						hitungTotal();
                  });
                                                                  						  
				// gunakan fungsi live untuk membind event 'click' ke #btnHapus
                  $("#btnHapus").die('click').live('click', function() {
                        var index = $(this).parents(".remove").prevAll().length;
                        var harga = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHargaTotal").val();
						harga = harga.split('.').join("");
						simpan = simpan - harga;
						document.getElementById('total').value = simpan.formatMoney(0);
						document.getElementById('hargaGross').value = simpan;
						gantiHarga();
						hitungTotal();

                        $(this).parents(".remove").remove();
                  });
                                                                  		
                  // gunakan fungsi live untuk membind event 'change' ke #selectKanal
                  $("#selectKanal").die('change').live('change', function() {
                        var index = $(this).parents(".remove").prevAll().length;
                                                                  			
                        loadListOption(index, '<?php echo site_url("order/get_product_group"); ?>', 'selectKanal', 'selectProductGroup');
						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtStartDate]").val("");
						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtEndDate]").val("");
                  });
                                                                  		
                  // gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
                  $("#selectProductGroup").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                                                  				
                        loadListOption(index, '<?php echo site_url("order/get_position"); ?>', 'selectProductGroup', 'selectPosition');
						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtStartDate]").val("");
						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtEndDate]").val("");
                  });

                  // gunakan fungsi live untuk membind event 'change' ke #selectPosition
                  $("#selectPosition").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                                
						var harga = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHargaTotal").val();
						harga = parseInt(harga.split('.').join(""));
						simpan = simpan - harga;
						document.getElementById('total').value = simpan.formatMoney(0);
						
                        loadListOption(index, '<?php echo site_url("order/get_harga"); ?>', 'selectPosition', 'harga');
                        loadListOption(index, '<?php echo site_url("order/get_harga_total"); ?>', 'selectPosition', 'hargaTotal');

						var harga2 = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHargaTotal").val();
						harga2 = parseInt(harga2.split('.').join(""));
						simpan = simpan + harga2;
						// alert(harga2);
						
						// document.getElementById('total').value = simpan.formatMoney(0);

						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtStartDate]").val("");
						$("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtEndDate]").val("");

                        var relVal = $("#addme tr").eq(index).children().next().next().next().find("#selectPosition option:selected").attr("rel");

                        if (relVal == "Y") {
                              $("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtCpmQuota]").removeAttr("readonly");
                              $("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtCpmQuota]").css("background-color", "");
                              $("#addme tr").eq(index).children().next().next().next().next().find("#show_cpm").show();
                        } else {
                              $("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtCpmQuota]").val("0");
                              $("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtCpmQuota]").attr("readonly", "readonly");
                              $("#addme tr").eq(index).children().next().next().next().next().find("input[name=txtCpmQuota]").css("background-color", "#DCDCDC");
                              $("#addme tr").eq(index).children().next().next().next().next().find("#show_cpm").hide();
                        }
                  });
                                                                  		
                  // gunakan fungsi live untuk membind event 'change' ke #selectIndustryCat
                  $("#selectIndustryCat").die('change').live('change', function() {
                        loadListOption3('<?php echo site_url("order/get_industrycat"); ?>', 'selectIndustryCat', 'selectIndustry');
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
									$("select[name=selectIndustryCat] option").each(function() {
                                          if ($(this).val() == ui.item.industrycat_id) {
                                                $(this).attr("selected", "selected");
												$("#selectIndustryCat").trigger("change");
												
                                                return false;
                                          }
                                    });
                                    
									/*$("select[name=selectIndustry] option").each(function() {
                                          if ($(this).val() == ui.item.industry_id) {
                                                $(this).attr("selected", "selected");
                                                return false;
                                          }
                                    });*/
                              } else {
                                    $("#chkIsRestrict").removeAttr("checked");
                                    $(".industry").hide();
                                    $(".industry_cat").hide();
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
                        if ($(this).is(":checked")){
                              $(".industry").show();
                              $(".industry_cat").show();
                        }else{
                              $(".industry").hide();
                              $(".industry_cat").hide();
						}
                  });
                                                                  		
                  $("#selectPacketType").change(function() {
                        if ($(this).val() == "Y")
                              loadForm('<?php echo site_url("order/insert_page"); ?>')
                        else if ($(this).val() == "N")
                              loadForm('<?php echo site_url("order/insert_page/S"); ?>')
                        else
                              loadForm('<?php echo site_url("order/insert_page/B"); ?>')
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

//TAMBAHAN WILLY				  
				var DateDiff = {

					inDays: function(d1, d2) {
						var t2 = d2.getTime();
						var t1 = d1.getTime();

						return parseInt((t2-t1)/(24*3600*1000));
					},

					inWeeks: function(d1, d2) {
						var t2 = d2.getTime();
						var t1 = d1.getTime();

						return parseInt((t2-t1)/(24*3600*1000*7));
					},

					inMonths: function(d1, d2) {
						var d1Y = d1.getFullYear();
						var d2Y = d2.getFullYear();
						var d1M = d1.getMonth();
						var d2M = d2.getMonth();

						return (d2M+12*d2Y)-(d1M+12*d1Y);
					},

					inYears: function(d1, d2) {
						return d2.getFullYear()-d1.getFullYear();
					}
				}

                  $("input[name=txtStartDate]").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;

                        var start = $("#addme tr").eq(index).children().next().next().next().next().next().find("input[name=txtStartDate]").val();
                        var end = $("#addme tr").eq(index).children().next().next().next().next().next().find("input[name=txtEndDate]").val();
						
						if (start != "" && end!= "") {
							var d1 = new Date(start);
							var d2 = new Date(end);
							
							var harga = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHarga").val();
							harga = harga.split('.').join("");
							harga = harga * (DateDiff.inDays(d1, d2) + 1);
							$("#addme tr").eq(index).children().next().next().next().next().next().next().find("#txtHargaTotal").val(harga);
						}
				  });

                  $("input[name=txtEndDate]").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;

                        var start = $("#addme tr").eq(index).children().next().next().next().next().next().find("input[name=txtStartDate]").val();
                        var end = $("#addme tr").eq(index).children().next().next().next().next().next().find("input[name=txtEndDate]").val();
						
						if (start != "" && end!= "") {
							var d1 = new Date(start);
							var d2 = new Date(end);
							
							var harga = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHarga").val();
							harga = harga.split('.').join("");
							harga = harga * (DateDiff.inDays(d1, d2) + 1);
							var hargaTotal = $("#addme tr").eq(index).children().next().next().next().next().next().find("#txtHargaTotal").val();
							hargaTotal = hargaTotal.split('.').join("");
							simpan = simpan - hargaTotal;
							$("#addme tr").eq(index).children().next().next().next().next().next().next().find("#txtHargaTotal").val(harga.formatMoney(0));
							simpan = simpan + harga;
							document.getElementById('total').value = simpan.formatMoney(0);
							hitungTotal();
						}
				  });

                  $("#btnTambahProduction").click(function() {
                        $("#addmeProduction").append("<tr class='remove'>"+
                              "	<td align='center'>"+
                              "		<select name='selectProduction' id='selectProduction'>"+
                              "			<?php foreach ($all_production as $production): ?>"+
                              "			<option value='<?php echo $production->id; ?>'><?php echo $production->nama; ?></option>"+
                              "			<?php endforeach; ?>"+
                              "		</select>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<input type='number' name='txtQty' id='txtQty' value='1' style='width:50px;' />"+
                              "	</td>"+
                              "	<td align='center'>"+
							  "		<div id='harga'>"+
							  "			<input name='txtHargaProd' id='txtHarga' type='text' readonly='readonly' style='width: 90px;' value='<?= number_format($harga_production->harga,0,",","."); ?>' />"+
							  "		</div>"+
                              "	</td>"+
                              "	<td align='center'>"+
							  "		<div id='hargaTotal'>"+
							  "			<input name='txtHargaProdTotal' id='txtHargaTotal' type='text' readonly='readonly' style='width: 90px;' value='<?= number_format($harga_production->harga,0,",","."); ?>' />"+
							  "		</div>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<textarea name='txtInfoProd' id='txtInfoProd' style='height: 30px; width: 130px;'></textarea>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<button type='button' name='btnHapusProduction' id='btnHapusProduction' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
                              "		<div class='error' id='errConflict'></div>"+
                              "	</td>"+
                              "</tr>");
							  
						simpanProd = simpanProd + <?= $harga_production->harga; ?>;
						document.getElementById('totalProduction').value = simpanProd.formatMoney(0);
						hitungTotal();
				  });

                  $("#btnHapusProduction").die('click').live('click', function() {
                        var index = $(this).parents(".remove").prevAll().length;
                        var harga = $("#addmeProduction tr").eq(index).children().next().next().next().find("#txtHargaTotal").val();
						harga = harga.split('.').join("");
						simpanProd = simpanProd - harga;
						document.getElementById('totalProduction').value = simpanProd.formatMoney(0);
                        $(this).parents(".remove").remove();
						hitungTotal();
                  });
				  
                  $("#selectProduction").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                                
                        var hargaTotal = $("#addmeProduction tr").eq(index).children().next().next().next().find("#txtHargaTotal").val();
						hargaTotal = hargaTotal.split('.').join("");
						simpanProd = simpanProd - hargaTotal;
                        loadHargaProd(index, '<?php echo site_url("order/get_harga_prod"); ?>', 'selectProduction', 'harga');
                        loadHargaProd(index, '<?php echo site_url("order/get_harga_prod_total"); ?>', 'selectProduction', 'hargaTotal');
						$("#addmeProduction tr").eq(index).children().next().next().find("#txtQty").val(1);
						// simpanProd = simpanProd + newHarga;
						document.getElementById('totalProduction').value = simpanProd.formatMoney(0);
						hitungTotal();
				  });
				  
                  $("input[name=txtQty]").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
						
                        var harga = $("#addmeProduction tr").eq(index).children().next().next().find("#txtHarga").val();
                        var hargaTotal = $("#addmeProduction tr").eq(index).children().next().next().next().find("#txtHargaTotal").val();
						harga = harga.split('.').join("");
						hargaTotal = hargaTotal.split('.').join("");
						simpanProd = simpanProd - hargaTotal;
						hargaTotal = harga * $(this).val();
						simpanProd = simpanProd + hargaTotal;
						$("#addmeProduction tr").eq(index).children().next().next().next().find("#txtHargaTotal").val(hargaTotal.formatMoney(0));                                                
						document.getElementById('totalProduction').value = simpanProd.formatMoney(0);
						hitungTotal();
				  });
				  				  
                  $("#btnTambahEvent").click(function() {
                        $("#addmeEvent").append("<tr class='remove'>"+
                              "	<td align='center'>"+
							  "		<input name='txtEvent' id='txtEvent' type='text' style='width:150px;' />"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<input name='txtStartDateEvent' class='txtStartDate' type='text' style='width:70px;' readonly='readonly' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
                              "		-"+
                              "		<input name='txtEndDateEvent' class='txtEndDate' type='text' style='width:70px;' readonly='readonly' onmousedown='$(this).datepicker({dateFormat: \"yy-mm-dd\", minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});' />"+
                              "	</td>"+
                              "	<td align='center'>"+
							  "		<input name='txtHargaEvent' id='txtHargaEvent' type='text' style='width: 90px;' value='0'  />"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<textarea name='txtInfoEvent' id='txtInfoEvent' style='height: 30px; width: 130px;'></textarea>"+
                              "	</td>"+
                              "	<td align='center'>"+
                              "		<button type='button' name='btnHapusEvent' id='btnHapusEvent' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>"+
                              "		<div class='error' id='errConflict'></div>"+
                              "	</td>"+
                              "</tr>");
						hitungTotal();
				  });

                  $("#btnHapusEvent").die('click').live('click', function() {
                        var index = $(this).parents(".remove").prevAll().length;
                        $(this).parents(".remove").remove();
						hitungTotal();
                  });

				  $('input[name=txtHargaEvent]').live('focus', function(event, index){
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
						
						$("#addmeEvent tr").eq(index).children().next().next().find("#txtHargaEvent").attr('oldValue',$("#addmeEvent tr").eq(index).children().next().next().find("#txtHargaEvent").val());
				  });
				  
                  $("input[name=txtHargaEvent]").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
					  
						var oldValue = $("#addmeEvent tr").eq(index).children().next().next().find("#txtHargaEvent").attr('oldValue');
						oldValue = parseInt(oldValue);
						simpanEvent = simpanEvent - oldValue;
                        var harga = $("#addmeEvent tr").eq(index).children().next().next().find("#txtHargaEvent").val();
						harga = parseInt(harga);
						simpanEvent = simpanEvent + harga;
						document.getElementById('totalEvent').value = simpanEvent.formatMoney(0);
						hitungTotal();
				  });
            });
      </script>
<?php endif; ?>