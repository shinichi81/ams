<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left;">
                        <?php /*
                          <label for="nospace">No Space : </label>
                          <input name='txtNoSpace' id='txtNoSpace' type='text' disabled='disabled' value='<?php echo $no_space; ?>' /> <span class="error" id="errNoSpace"></span>
                          <br>
                         */ ?>
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
                        <br>
                        <label for="miscinfo">Keterangan : </label> 
                        <textarea name="txtMiscInfo" id="txtMiscInfo" style="height: 80px; width: 250px;"></textarea>
                  </div>
            </fieldset>
            <fieldset id="space">
                  <legend>Space</legend>
                  <button type="button" name="btnTambah" id="btnTambah" title="Tambah" class="btn"><img src="<?php echo image_url("icons/add.png"); ?>" alt="Tambah" /></button> <span class="error" id="errSpace"></span>
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
                  <span class="industry_cat">
                        <br>
                        <label for="industry_cat">Industri : </label>
                        <select name="selectIndustryCat" id="selectIndustryCat">
                              <?php foreach ($all_industry_cat as $industry_cat): ?>
                                    <option value="<?php echo $industry_cat->id; ?>"><?php echo $industry_cat->industry_name; ?></option>	
                              <?php endforeach; ?>
                        </select>
                  </span>
                  <span class="industry">
                        <br>
                        <label for="industry">Sub Industri : </label>
                        <select name="selectIndustry" id="selectIndustry">
                              <?php foreach ($all_industry as $industry): ?>
                                    <option value="<?php echo $industry->id; ?>"><?php echo $industry->name; ?></option>	
                              <?php endforeach; ?>
                        </select>
                  </span>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('orderspace', 'insert', '<?php echo site_url("order_space/insert"); ?>', '<?php echo site_url("order_space/content"); ?>', '<?php echo site_url("order_space/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("order_space/insert_page"); ?>')" />
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
                              "		<textarea name='txtMiscInfoSpace' id='txtMiscInfoSpace' style='height: 30px; width: 130px;'></textarea>"+
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
                                          			
                        loadListOption(index, '<?php echo site_url("order_space/get_product_group"); ?>', 'selectKanal', 'selectProductGroup');
                  });
                                          		
                  // gunakan fungsi live untuk membind event 'change' ke #selectProductGroup
                  $("#selectProductGroup").die('change').live('change', function(event, index) {
                        if (index == undefined)
                              var index = $(this).parents(".remove").prevAll().length;
                                          				
                        loadListOption(index, '<?php echo site_url("order_space/get_position"); ?>', 'selectProductGroup', 'selectPosition');
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
                                                                  		
                  // gunakan fungsi live untuk membind event 'change' ke #selectIndustryCat
                  $("#selectIndustryCat").die('change').live('change', function() {
                        loadListOption3('<?php echo site_url("order/get_industrycat"); ?>', 'selectIndustryCat', 'selectIndustry');
                  });
                                    
      <?php /* ?>
        // untuk autocomplete Agency
        $("#txtAgency").autocomplete({
        source: "<?php echo site_url("order_space/get_agency"); ?>",
        minLength: 2,
        select: function(event, ui) {
        $("#txtAgency").attr("nilai", ui.item.id);
        }
        });

        // untuk autocomplete Client
        $("#txtClient").autocomplete({
        source: "<?php echo site_url("order_space/get_client"); ?>",
        minLength: 2,
        select: function(event, ui) {
        $("#txtClient").attr("nilai", ui.item.id);
        }
        });

        $("#btnNoSpace").click(function() {
        loadGenerate('<?php echo site_url("order_space/generate"); ?>', 'nospace');
        });
        <?php */ ?>
                    // untuk menampilkan inputan industri
                    $("#chkIsRestrict").click(function() {
                          if ($(this).is(":checked")){
                                $(".industry").show();
                                $(".industry").show();
                          }else{
                                $(".industry").hide();
                                $(".industry").hide();
						  }
                    });
              });
      </script>
<?php endif; ?>