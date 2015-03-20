<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Paket : </label> 
                        <input name="txtNoPaket" id="txtNoPaket" type="text" disabled="disabled" value="<?php echo $all_data->no_paket; ?>" />
                        <br>
                        <label for="nopaketuser">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" type="text" disabled="disabled" value="<?php echo $all_data->no_paket_user; ?>" />
                        <br>
                        <label for="agency">Perusahaan : </label> 
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
                        <label for="unit">Unit : </label> 
                        <select name="selectUnit" id="selectUnit" style="width: 150px;">
								<option value="" disabled selected>-- Pilih Unit --</option>
                        </select>
                        <br>
                        <label for="client">Brand : </label> 
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
                        <input name="txtBudget" id="txtBudget" type="text" value="<?php echo $all_data->budget; ?>" />
						<br />
                        <label for="campaign">Campaign : </label> 
                        <input name="txtCampaign" id="txtCampaign" type="text" value="<?php echo $all_data->campaign; ?>" />
<!--                        <br>
                        <label for="benefit">Benefit : </label> 
                        <input name="txtBenefit" id="txtBenefit" type="text" value="<?php echo $all_data->benefit; ?>" />
                        <br>
                        <label for="miscinfo">Keterangan : </label> 
                        <textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info; ?></textarea>
-->
                  </div>
            </fieldset>
            <?php if (count($all_data_brandcomm) > 0): ?>
                  <fieldset id="brandcomm">
                        <legend>Brandcomm</legend>
                        <!-- <div style="float: left; width: 400px;">
                                <label for="nopaket">No Brandcomm : </label> 
                                <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                                <br> -->
                        <label for="nopaket">Start Date : </label>
                        <input name='txtStartDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->start_date; ?>" />
                        <br>
                        <label for="nopaket">End Date : </label>
                        <input name='txtEndDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->end_date; ?>" />
                        <!-- </div> -->
                        <table>
                              <thead>
                              <th width="40px">No</th>
                              <th>Item</th>
                              <th>Detail</th>
                              </thead>
                              <tbody>
                                    <?php foreach ($all_detail_brandcomm as $key => $detail_brandcomm): ?>
                                          <tr>
                                                <td align="center"><?php echo ($key + 1); ?></td>
                                                <td><?php echo $detail_brandcomm->item; ?></td>
                                                <td><?php echo $detail_brandcomm->detail; ?></td>
                                          </tr>
                                    <?php endforeach; ?>
                              </tbody>
                        </table>
                  </fieldset>
                  <fieldset id="personal">
                        <legend>Feedback Client</legend>
                        <label for="feedback">Status : </label>
                        <?php echo ($all_data_brandcomm->enable_feedback == "Y") ? "Enable" : "Disable"; ?>
                        <br>
                        <label for="feedback">Feedback : </label>
                        <textarea id="txtFeedback" disabled="disabled" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data_brandcomm->feedback; ?></textarea>
                  </fieldset>
            <?php endif; ?>
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
                        <th>Harga</th>
                        <th>Keterangan</th>
                        <th>&nbsp;</th>
                        </thead>
                        <tbody id="addme">
                              <?php
                              $n = 0;
							  $jumlah = 0;
                              foreach ($all_detail as $detail):
                                    ?>
									<?php 
									// remark 3 April 2013 @tio 
									// cek banner apakah sudah tayang atau belum
									$allDetailReq = $this->Request_Model->getRequestDetail($all_data->no_paket,$detail->kanal_id,$detail->product_group_id,$detail->position_id,$detail->start_date);
									$disabled="";
									$readonly="";
									$hidden="";
									if(!empty($allDetailReq)) $disabled="disabled"; else  $disabled="";
									if(!empty($allDetailReq)) $readonly="readonly"; else  $readonly="";
									if(!empty($allDetailReq)) $hidden="hidden"; else  $hidden="";
									?>
                                    <tr class='remove'>
                                          <td align='center'>
                                                <select name='selectAds' id='selectAds'>
                                                      <?php
                                                      foreach ($all_ads as $ads):
                                                            $selected = "";
                                                            if ($detail->ads_id == $ads->id)
                                                                  $selected = "selected='selected'";
                                                            ?>
                                                            <option value='<?php echo $ads->id; ?>' <?php echo $selected; ?>><?php echo $ads->name; ?></option>
                                                            <?php
                                                      endforeach;
                                                      ?>
                                                </select>
                                          </td>
                                          <td align='center'>
                                                <select name='selectKanal' id='selectKanal'>
                                                      <?php
                                                      foreach ($all_kanal as $kanal):
                                                            $selected = "";
                                                            if ($detail->kanal_id == $kanal->id)
                                                                  $selected = "selected='selected'";
                                                            ?>
                                                            <option value='<?php echo $kanal->id; ?>' <?php echo $selected; ?> <?php echo $disabled; ?>><?php echo $kanal->name; ?></option>
                                                            <?php
                                                      endforeach;
                                                      ?>
                                                </select>
                                          </td>
                                          <td align='center'>
                                                <select name='selectProductGroup' id='selectProductGroup'>
                                                      <?php
                                                      foreach ($arr_productgroup[$n] as $productgroup):
                                                            $selected = "";
                                                            if ($detail->product_group_id == $productgroup->id)
                                                                  $selected = "selected='selected'";
                                                            ?>
                                                            <option value='<?php echo $productgroup->id; ?>' <?php echo $selected; ?> <?php echo $disabled; ?>><?php echo $productgroup->name; ?></option>
                                                            <?php
                                                      endforeach;
                                                      ?>
                                                </select>
                                          </td>
                                          <td align='center'>
                                                <select name='selectPosition' id='selectPosition'>
                                                      <?php
                                                      $isCpmQuota = FALSE;
                                                      foreach ($arr_position[$n] as $position):
                                                            $selected = "";
                                                            if ($detail->position_id == $position->id) {
                                                                  $selected = "selected='selected'";
                                                                  if (in_array($position->id, $all_cpm_position[$n]))
                                                                        $isCpmQuota = TRUE;
                                                            }
                                                            ?>
                                                            <option value='<?php echo $position->id; ?>' <?php echo $selected; ?> <?php echo $disabled; ?> rel='<?php echo (in_array($position->id, $all_cpm_position[$n])) ? "Y" : "N"; ?>'><?php echo $position->name; ?></option>
                                                            <?php
                                                      endforeach;
                                                      ?>
                                                </select>
                                          </td>
                                          <td align='center'>
                                                <input name='txtCpmQuota' type='text' style='width:50px; <?php echo ($isCpmQuota === TRUE) ? "" : "background-color:#DCDCDC;"; ?>' <?php echo ($isCpmQuota === TRUE) ? "" : "readonly='readonly'"; ?> value="<?php echo number_format($detail->cpm_quota, 0, ",", "."); ?>" onkeyup="currencySeparator(this, '.')" onkeydown="return numberOnly(event);" <?php echo $readonly;?>/>
                                                <a href='javascript:void(0);' <?php echo ($isCpmQuota === TRUE) ? "" : "style='display:none;'"; ?> id='show_cpm'><img src='<?php echo image_path("icons/info.ico"); ?>' align='top' /></a>
                                          </td>
                                          <td align='center'>
											<?php if(!empty($allDetailReq)){ ?>
                                                <input name='txtStartDate' class='txtStartDate' type='text' readonly='readonly' style='width:70px;' value="<?php echo $detail->start_date; ?>"/>
                                                -
                                                <input name='txtEndDate' class='txtEndDate' type='text' readonly='readonly' style='width:70px;' value="<?php echo $detail->end_date; ?>"/>
                                                <input type="hidden" name="hdStartDate" value="<?php echo $detail->start_date; ?>" />
                                                <input type="hidden" name="hdEndDate" value="<?php echo $detail->end_date; ?>" />
											<?php }else{?>
												<input name='txtStartDate' class='txtStartDate' type='text' readonly='readonly' style='width:70px;' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->start_date; ?>"/>
                                                -
                                                <input name='txtEndDate' class='txtEndDate' type='text' readonly='readonly' style='width:70px;' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->end_date; ?>"/>
                                                <input type="hidden" name="hdStartDate" value="<?php echo $detail->start_date; ?>" />
                                                <input type="hidden" name="hdEndDate" value="<?php echo $detail->end_date; ?>" />
											<?php } ?>
                                          </td>
										  <td align='center'>
												<div id="harga">
													<input name="txtHarga" id="txtHarga" type="text" style="width: 70px;" value="<?= number_format($harga->harga,0,",","."); $jumlah = $jumlah + $harga->harga;?>" readonly />
												</div>
										  </td>
                                          <td align='center'>
                                                <textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 130px;' <?php echo $readonly;?>><?php echo $detail->misc_info; ?></textarea>
                                          </td>
                                          <td align='center'>
                                                <button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn' <?php echo $hidden;?>><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>
                                                <div class='error' id='errConflict'></div>
                                          </td>
                                    </tr>
                                    <?php
                                    $n += 1;
                              endforeach;
                              ?>
                        </tbody>
                  </table>
				  <div style="float:right; margin-right:50px;">
					<label>Harga Sistem :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input name="total" id="total" style="width:100px;" type="text" value="<?php echo $all_data->harga_sistem; ?>" />
				  </div>
				  <br />
                  <label for="hargaGross">Harga Paket Gross : </label> 
                  <input name="hargaGross" id="hargaGross" type="text" value="<?php echo $all_data->harga_gross; ?>" onKeyPress="gantiHarga()" onKeyUp="gantiHarga()" />
                  <br>
                  <label for="diskon">Diskon : </label> 
                  <input name="txtDiskon" id="txtDiskon" type="text" value="<?php echo $all_data->diskon; ?>" readonly />
				  <br />
				  <label for="additionalDiskon">Additional Diskon : </label> 
				  <input name="txtAddDiskon" id="txtAddDiskon" type="text" value="<?php echo $all_data->additional_diskon; ?>" readonly />
                  <br>
                  <label for="diskonNominal">Diskon (Nominal) : </label> 
                  <input name="diskonNominal" id="diskonNominal" type="text" value="0" readonly />
                  <br>
                  <label for="addDiskonNominal">Additional Diskon (Nominal) : </label> 
                  <input name="addDiskonNominal" id="addDiskonNominal" type="text" value="0" readonly />
            </fieldset>
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflict">Conflict Brand : </label> 
                  <input type="checkbox" name="chkIsRestrict" id="chkIsRestrict" value="Y" <?php echo ($all_data->is_restrict == "Y") ? "checked='checked'" : ""; ?> /> Ya
				  <span class="industry_cat" <?php echo ($all_data->is_restrict == "Y") ? "" : "style='display: none;'"; ?>>
                        <br>
                        <label for="industry_cat">Industri : </label>
                        <select name="selectIndustryCat" id="selectIndustryCat">
                              <?php foreach ($all_industry_cat as $industry_cat): 
									$selected = "";
                                    if ($all_data->industrycat_id == $industry_cat->id)
                                          $selected = "selected='selected'";
									?>
                                    <option value="<?php echo $industry_cat->id; ?>" <?php echo $selected; ?>><?php echo $industry_cat->industry_name; ?></option>	
                              <?php endforeach; ?>
                        </select>
                  </span>
                  <span class="industry" <?php echo ($all_data->is_restrict == "Y") ? "" : "style='display: none;'"; ?>>
                        <br>
                        <label for="industry">Sub Industri : </label>
                        <select name="selectIndustry" id="selectIndustry">
                              <?php
                              foreach ($all_industry as $industry):
                                    $selected = "";
                                    if ($all_data->industry_id == $industry->id)
                                          $selected = "selected='selected'";
                                    ?>
                                    <option value="<?php echo $industry->id; ?>" <?php echo $selected; ?>><?php echo $industry->name; ?></option>	
                              <?php endforeach; ?>
                        </select>
                  </span>
            </fieldset>
            <fieldset id="others">
                  <legend>Others</legend>
                  <div style="float: left; width: 400px;">
                        <label for="miscinfo">Event : </label> 
                        <textarea name="txtMiscInfoEvent" id="txtMiscInfoEvent" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info_event; ?></textarea>
                  </div>
                  <div style="float: left;">
                        <label for="miscinfo">Production Cost : </label> 
                        <textarea name="txtMiscInfoProductionCost" id="txtMiscInfoProductionCost" style="height: 80px; width: 250px;"><?php echo $all_data->misc_info_production_cost; ?></textarea>
                  </div>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('order', 'update', '<?php echo site_url("order/update"); ?>', '<?php echo site_url("order/content"); ?>', '<?php echo site_url("order/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("order/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
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
                                                      
            $(document).ready(function() {
				  var simpan = parseInt($("#total").val());
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
							  "		<div id='harga'>"+
							  "			<input name='txtHarga' id='txtHarga' type='text' readonly='readonly' style='width: 70px;' value='<?= number_format($harga->harga,0,",","."); ?>' />"+
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
						// simpan = simpan + <?= $harga->harga; ?>;
						document.getElementById('total').value = simpan;
                  });
				  
                   // gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
                  $("#selectProductGroup").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                                                  				
                        loadListOption(index, '<?php echo site_url("order/get_position"); ?>', 'selectProductGroup', 'selectPosition');
                        loadListOption(index, '<?php echo site_url("order/get_harga"); ?>', 'selectProductGroup', 'harga');

						document.getElementById('total').value = simpan;
                  });


      <?php /* ?>
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
        <?php */ ?>
                                                                        				
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
              });
      </script>
<?php endif; ?>