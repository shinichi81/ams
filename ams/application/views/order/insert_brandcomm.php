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
                              <option value="B" selected="selected">Dari Brandcomm</option>
                        </select>
                        <span class="txtSpace" style="display: none;">
                              <br>
                              <label for="space">Dari Space : </label> 
                              <input type="radio" name="rdbSpace" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
                              <input type="radio" name="rdbSpace" value="N" /> Cari
                              <br>
                              <label for="nbsp">&nbsp;</label>
                              <input name="txtNoSpace" id="txtNoSpace" type="text" />
                        </span>
                        <span class="txtBrandcomm">
                              <br>
                              <label for="brandcomm">Dari Brandcomm : </label> 
                              <input type="radio" name="rdbBrandcomm" value="Y" /> Autocomplete &nbsp;&nbsp;&nbsp;
                              <input type="radio" name="rdbBrandcomm" value="N" checked="checked" /> Cari
                              <br>
                              <label for="nbsp">&nbsp;</label>
                              <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" value="<?php echo $all_data->no_brandcomm; ?>" />
                        </span>
                        <span class="error" id="errTxtNo"></span>
                        <?php /*
                          <br>
                          <label for="nopaket">No Paket : </label>
                          <input name='txtNoPaket' id='txtNoPaket' type='text' disabled='disabled' value='<?php echo $no_paket; ?>' /> <span class="error" id="errTxtNoPaket"></span>
                         */ ?>
                        <br>
                        <label for="agency">Agency : </label> 
                        <select name="selectAgency" id="selectAgency" style="width: 150px;">
                              <option value="-">-</option>
                              <?php
                              foreach ($all_agency as $agency):
                                    $selected = "";
                                    if ($all_data->agency_id == $agency->id)
                                          $selected = "selected='selected'";
                                    ?>
                                    <option value="<?php echo $agency->id; ?>" <?php echo $selected; ?>><?php echo $agency->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                        <br>
                        <label for="client">Client : </label> 
                        <select name="selectClient" id="selectClient" style="width: 150px;">
                              <?php
                              foreach ($all_client as $client):
                                    $selected = "";
                                    if ($all_data->client_id == $client->id)
                                          $selected = "selected='selected'";
                                    ?>
                                    <option value="<?php echo $client->id; ?>" <?php echo $selected; ?>><?php echo $client->name; ?></option>
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
                        <textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info; ?></textarea>
                  </div>
            </fieldset>
            <div id="addbrandcomm">
                  <fieldset id="brandcomm">
                        <legend>Brandcomm</legend>
                        <!-- <div style="float: left; width: 400px;">
                                <label for="nopaket">No Brandcomm : </label> 
                                <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                                <br> -->
                        <label for="nopaket">Start Date : </label>
                        <input name='txtStartDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data->start_date; ?>" />
                        <br>
                        <label for="nopaket">End Date : </label>
                        <input name='txtEndDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data->end_date; ?>" />
                        <!-- </div> -->
                        <table>
                              <thead>
                              <th width="40px">No</th>
                              <th>Item</th>
                              <th>Detail</th>
                              </thead>
                              <tbody>
                                    <?php foreach ($all_item as $key => $item): ?>
                                          <tr>
                                                <td align="center"><?php echo ($key + 1); ?></td>
                                                <td><?php echo $item->item; ?></td>
                                                <td><?php echo $all_detail[$key]->detail; ?></td>
                                          </tr>
                                    <?php endforeach; ?>
                              </tbody>
                        </table>
                  </fieldset>
                  <fieldset id="personal">
                        <legend>Feedback Client</legend>
                        <label for="feedback">Status : </label>
                        <?php echo ($all_data->enable_feedback == "Y") ? "Enable" : "Disable"; ?>
                        <br>
                        <label for="feedback">Feedback : </label>
                        <textarea id="txtFeedback" disabled="disabled" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data->feedback; ?></textarea>
                  </fieldset>
            </div>
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
                                    "			<option value='<?php echo $position->id; ?>' rel='<?php echo (in_array($position->id, $all_default_cpm_position)) ? "Y" : "N"; ?>'><?php echo $position->name; ?></option>"+
                                    "			<?php endforeach; ?>"+
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
                              "		<textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 130px;'></textarea>"+
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
                        		
                  // gunakan fungsi live untuk membind event 'change' ke #selectPosition
                  $("#selectPosition").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                                            
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
                                  
                  // untuk autocomplete Agency
                  $("#txtAgency").autocomplete({
                        source: "<?php echo site_url("order/get_agency"); ?>",
                        minLength: 2,
                        select: function(event, ui) {
                              $("#txtAgency").attr("nilai", ui.item.id);
                        }
                  });
                        		
                  // untuk autocomplete Client
                  $("#txtClient").autocomplete({
                        source: "<?php echo site_url("order/get_client"); ?>",
                        minLength: 2,
                        select: function(event, ui) {
                              $("#txtClient").attr("nilai", ui.item.id);
                        }
                  });
                        		
                  // untuk autocomplete No Space
                  $("#txtNoSpace").autocomplete({
                        source: "<?php echo site_url("order/get_space"); ?>",
                        minLength: 0,
                        select: function(event, ui) {
                              $("#txtAgency").val(ui.item.agency);
                              $("#txtAgency").attr("nilai", ui.item.agency_id);
                              $("#txtClient").val(ui.item.client);
                              $("#txtClient").attr("nilai", ui.item.client_id);
                              $("#txtAe").val(ui.item.ae_name);
                              $("#txtAe").attr("nilai", ui.item.ae_username);
                        				
                              if (ui.item.is_restrict == "Y") {
                                    $("#chkIsRestrict").attr("checked", "checked");
                                    $(".industry").show();
                                    $("select[name=selectIndustry] option").each(function() {
                                          if ($(this).val() == ui.item.industry_id) {
                                                $(this).attr("selected", "selected");
                                                return false;
                                          }
                                    });
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
            });
      </script>
<?php endif; ?>