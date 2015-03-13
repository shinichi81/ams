<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Nama : </label> 
                  <input name="txtName" id="txtName" type="text" size="50" value="<?php echo $all_data->industry_name; ?>"/> <span class="error" id="errTxtName"></span>
                  <br>
                  <label for="kanal">Sub Industry : </label>
                  <div style="float: left"> 
                        <select name="selectSubIndustrySource" id="selectSubIndustrySource" multiple="multiple" size="5" style="width: 150px;">
                              <?php foreach ($all_subindustry as $subindustry): ?>
                                    <option value="<?php echo $subindustry->id; ?>"><?php echo $subindustry->name; ?></option>
                              <?php endforeach; ?>
                        </select>
                  </div>
                  <div style="float: left; margin-top: 15px; margin-right: 8px;">
                        <a href="javascript:void(0);" id="subindustrytodestination">
                              <input id="button2" type="button" value=">>" style="width: 25px" />
                        </a>
                        <br>
                        <a href="javascript:void(0);" id="subindustrytosource">
                              <input id="button2" type="button" value="<<" style="width: 25px" />
                        </a>
                  </div>
                  <div style="float: left">	
                        <select name="selectSubIndustryDestination" id="selectSubIndustryDestination" multiple="multiple" size="5" style="width: 150px;">
                              <?php foreach ($selected_subindustry as $subindustry): ?>
                                    <option value="<?php echo $subindustry->id; ?>"><?php echo $subindustry->name; ?></option>
                              <?php endforeach; ?>
                        </select> <span class="error" id="errTxtSubIndustry"></span>
                  </div>
                  <div style="clear: both;"></div>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('industry_cat', 'update', '<?php echo site_url("master_industry_cat/update"); ?>', '<?php echo site_url("master_industry_cat/content"); ?>', '<?php echo site_url("master_industry_cat/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_industry_cat/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                                    		
                  $("#subindustrytodestination").click(function() {
                        move("selectSubIndustrySource", "selectSubIndustryDestination");
                  });
                                    		
                  $("#subindustrytosource").click(function() {
                        move("selectSubIndustryDestination", "selectSubIndustrySource");
                  });
            });
                                    	
            function move(source, destination) {
                  $("select[name="+source+"] option:selected").each(function() {
                        $("select[name="+destination+"]").append($(this).clone());
                        $(this).remove();
                  });
            }
      </script>
<?php endif; ?>