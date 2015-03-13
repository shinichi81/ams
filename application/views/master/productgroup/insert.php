<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Nama : </label> 
                  <input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
                  <br>
                  <label for="keterangan">Keterangan : </label> 
                  <input name="txtKeterangan" id="txtKeterangan" type="text" />
                  <br>
                  <label for="kanal">Kanal : </label> 
                  <select name="selectKanal" id="selectKanal">
                        <?php foreach ($all_kanal as $kanal): ?>
                              <option value="<?php echo $kanal->id; ?>"><?php echo $kanal->name; ?></option>
                        <?php endforeach; ?>
                  </select>
                  <br>
                  <label for="kanal">Rubrik : </label> 
                  <div style="float: left">
                        <select name="selectRubrikSource" id="selectRubrikSource" class="list_rubrik" multiple="multiple" size="5" style="width: 150px;">
                              <?php foreach ($all_rubrik as $rubrik): ?>
                                    <option value="<?php echo $rubrik->id; ?>"><?php echo $rubrik->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div style="float: left; margin-top: 15px; margin-right: 8px;">
                        <a href="javascript:void(0);" id="rubriktodestination">
                              <input id="button2" type="button" value=">>" style="width: 25px" />
                        </a>
                        <br>
                        <a href="javascript:void(0);" id="rubriktosource">
                              <input id="button2" type="button" value="<<" style="width: 25px" />
                        </a>
                  </div>
                  <div style="float: left">
                        <select name="selectRubrikDestination" id="selectRubrikDestination" multiple="multiple" size="5" style="width: 150px;">
                        </select> <span class="error" id="errTxtRubrik"></span>
                  </div>
                  <div style="clear: both;"></div>
                  <label for="position">Posisi : </label>
                  <div style="float: left"> 
                        <select name="selectPositionSource" id="selectPositionSource" multiple="multiple" size="5" style="width: 150px;">
                              <?php foreach ($all_position as $position): ?>
                                    <option value="<?php echo $position->id; ?>"><?php echo $position->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div style="float: left"> 
                        <select name="hargaSource" id="hargaSource" multiple="multiple" size="5" style="width: 100px;" hidden>
                              <?php foreach ($all_harga as $harga): ?>
                                    <option value="<?php echo $harga->id_position; ?>"><?php echo "Rp. " . number_format($harga->harga, 0, ",", "."); ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div style="float: left; margin-top: 15px; margin-right: 8px;">
                        <a href="javascript:void(0);" id="positiontodestination">
                              <input id="button2" type="button" value=">>" style="width: 25px" />
                        </a>
                        <br>
                        <a href="javascript:void(0);" id="positiontosource">
                              <input id="button2" type="button" value="<<" style="width: 25px" />
                        </a>
                  </div>
                  <div style="float: left">
                        <select name="selectPositionDestination" id="selectPositionDestination" multiple="multiple" size="5" style="width: 150px;">
                        </select> <span class="error" id="errTxtPosition"></span>
                  </div>
                  <div style="float: left">
                        <select name="hargaDestination" id="hargaDestination" multiple="multiple" size="5" style="width: 120px;"></select>
                  </div>
                  <div style="clear: both;"></div>
                  <label for="name">CPM : </label> 
                  <span id="cpm_position" style="float: left">-</span>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('productgroup', 'insert', '<?php echo site_url("master_productgroup/insert"); ?>', '<?php echo site_url("master_productgroup/content"); ?>', '<?php echo site_url("master_productgroup/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_productgroup/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                  $("#selectKanal").change(function() {
                        loadListOption2('<?php echo site_url("master_productgroup/get_rubrik"); ?>', 'selectKanal', 'list_rubrik');
                        loadListOption3('<?php echo site_url("master_productgroup/get_harga"); ?>', 'selectKanal', 'hargaSource');
                  });
                                                                  		
                  $("#rubriktodestination").click(function() {
                        move("selectRubrikSource", "selectRubrikDestination");
                  });
                                                                  		
                  $("#rubriktosource").click(function() {
                        move("selectRubrikDestination", "selectRubrikSource");
                  });
                                                                  		
                  $("#positiontodestination").click(function() {
                        posisi = movePosition("selectPositionSource", "selectPositionDestination");
                        moveHarga("hargaSource", "hargaDestination", posisi);
                        tobeCpm("selectPositionDestination", "cpm_position");
                  });
                                                                  		
                  $("#positiontosource").click(function() {
                        move("selectPositionDestination", "selectPositionSource");
                        tobeCpm("selectPositionDestination", "cpm_position");
                  });
                                                                  
                  //                  $("#chkCpm").live("click", function() {
                  //                        if ($(this).is(":checked"))
                  //                              $(this).next("input[name=txtCpmQuota]").show();
                  //                        else
                  //                              $(this).next("input[name=txtCpmQuota]").hide();
                  //                  });
            });
                                                                    
            function move(source, destination) {
                  $("select[name="+source+"] option:selected").each(function() {
                        $("select[name="+destination+"]").append($(this).clone());
                        $(this).remove();
                  });
            }

            function movePosition(source, destination) {
                  var index;
				  $("select[name="+source+"] option:selected").each(function() {
                        $("select[name="+destination+"]").append($(this).clone());
						index = $(this).val();
                        $(this).remove();
                  });
				  // alert(index);
				  return index;
            }

            function moveHarga(source, destination, id) {
                  var index;
				  $("select[name="+source+"] option[value="+id+"]").each(function() {
                        $("select[name="+destination+"]").append($(this).clone());
						index = $(this).val();
                        $(this).remove();
                  });
				  // alert(index);
				  return index;
            }

            function tobeCpm(source, destination) {
                  var noData = true;
                  
                  $("#"+destination).empty();
                        
                  $("select[name="+source+"] option").each(function() {
                        noData = false;
                        
                        var data = "<input type='checkbox' name='chkCpm' value='" + $(this).val() + "' /> " + $(this).text() + "<br>";
                                                                        
                        $("#"+destination).append(data);
                  });
                  
                  if (noData == true)
                        $("#"+destination).text("-");
            }
      </script>
<?php endif; ?>