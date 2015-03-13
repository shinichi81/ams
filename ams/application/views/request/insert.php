<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Paket : </label> 
                        <input type="radio" name="rdbPacket" value="Y" checked="checked" /> Autocomplete &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="rdbPacket" value="N" /> Cari
                        <br>
                        <label for="nbsp">&nbsp;</label>
                        <input name="txtNoPaket" id="txtNoPaket" type="text" /> <span class="error" id="errTxtNoPaket"></span>
                        <br>
                        <label for="agency">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" type="text" disabled="disabled" />
                        <br>
                        <label for="agency">Agency : </label> 
                        <input name="txtAgency" id="txtAgency" type="text" disabled="disabled" />
                        <br>
                        <label for="client">Client : </label> 
                        <input name="txtClient" id="txtClient" type="text" disabled="disabled" />
                        <!--
                        <br>
                        <label for="benefit">Brand : </label> 
                        <input name="txtBrand" id="txtBrand" type="text" /> <span class="error" id="errTxtBrand"></span>
                        -->
                        <br>
                        <label for="benefit">Jenis Order : </label> 
                        <input type="radio" name="rdbOrderType" value="T" checked="checked" /> Tayang Banner&nbsp;
                        <input type="radio" name="rdbOrderType" value="D" /> Data
                        <span class="error" id="errTxtOrderType"></span>
                        <br>
                        <label for="benefit">Detail : </label> 
                        <textarea name="txtDetail" id="txtDetail" style="height: 80px; width: 250px;"></textarea>
                  </div>
                  <div style="float: left; width: 400px;">
                        <label for="budget">Budget : </label> 
                        <input name="txtBudget" id="txtBudget" type="text" disabled="disabled" />
                        <br>
                        <label for="benefit">Benefit : </label> 
                        <input name="txtBenefit" id="txtBenefit" type="text" disabled="disabled" />
                        <br>
                        <label for="diskon">Diskon : </label> 
                        <input name="txtDiskon" id="txtDiskon" type="text" disabled="disabled" />
                        <br>
                        <label for="miscinfo">Keterangan : </label> 
                        <textarea name="txtMiscInfo" id="txtMiscInfo" disabled="disabled" style="height: 80px; width: 250px;"></textarea>
                  </div>
            </fieldset>
            <div id="addme">
                  <fieldset id="paket">
                        <legend>Paket</legend>
                        <span class="error" id="errPaket"></span>
                        <table>
                              <thead>
                              <th>Iklan</th>
                              <th>Kanal</th>
                              <th>Produk Grup</th>
                              <th>Posisi</th>
                              <th>CPM Quota</th>
                              <th>Periode</th>
                              <th>Keterangan</th>
                              <th>No Po</th>
                              <th>Request</th>
                              </thead>
                              <tbody>
                              </tbody>
                        </table>
                  </fieldset>
            </div>
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflict">Conflict Brand : </label>
                  <span id="isRestrict">-</span>
                  <p>
                  <label for="industrycat">Industri : </label>
                  <span id="industrycat">-</span>
                  <input type="hidden" name="hdIndustryCatId" id="hdIndustryCatId" />
				  </p>
                  <p>
                  <label for="industry">Sub Industri : </label>
                  <span id="industry">-</span>
                  <input type="hidden" name="hdIndustryId" id="hdIndustryId" />
				  </p>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('request', 'insert', '<?php echo site_url("request/insert"); ?>', '<?php echo site_url("request/content"); ?>', '<?php echo site_url("request/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("request/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                  // untuk autocomplete Client
                  $("#txtNoPaket").autocomplete({
                        source: "<?php echo site_url("request/get_data"); ?>",
                        minLength: 0,
                        select: function(event, ui) {
                              $("#txtNoPaketUser").val(ui.item.no_paket_user);
                              $("#txtAgency").val(ui.item.agency);
                              $("#txtClient").val(ui.item.client);
                              $("#txtBudget").val(ui.item.budget);
                              $("#txtDiskon").val(ui.item.diskon);
                              $("#txtBenefit").val(ui.item.benefit);
                              $("#hdIndustry").val(ui.item.industry_id);
                              // $("#txtIndustry").val(ui.item.industry);
                              $("#txtMiscInfo").val(ui.item.misc_info);
                              $("#isRestrict").text(ui.item.is_restrict);
                              $("#industry").text(ui.item.industry);
                              $("#hdIndustryId").val(ui.item.industry_id);
                              $("#industrycat").text(ui.item.industrycat);
                              $("#hdIndustryCatId").val(ui.item.industrycat_id);
                        				
                              loadDetail('<?php echo site_url("request/get_data_detail"); ?>', ui.item.value);
                        }
                  });
                        		
                  // untuk menampilkan inputan no space
                  $("input[name=rdbPacket]").click(function() {
                        if ($(this).val() == "Y")
                              loadForm('<?php echo site_url("request/insert_page"); ?>')
                        else
                              loadForm('<?php echo site_url("request/search_page"); ?>')
                  });
            });
      </script>
<?php endif; ?>