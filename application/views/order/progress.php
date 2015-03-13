<?php if ($progress == "Y"): ?>
      <h3 id="adduser">FORM PROGRESS</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="budget">Progress : </label>
                  <span id="percent">0</span>%
                  <div id="slider" style="width: 500px; margin-left: 115px;"></div>
                  <input type="hidden" name="hdNoPaket" id="hdNoPaket" value="<?php echo $no_paket; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('order', 'progress', '<?php echo site_url("order/progress"); ?>', '<?php echo site_url("order/content"); ?>', '<?php echo site_url("order/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("order/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(function() {
                  $("#slider").slider({
                        range: "max",
                        min: 0,
                        max: 100,
                        value: <?php echo $percent; ?>,
                        step: 1,
                        slide: function(event, ui) {
                              if (ui.value >= <?php echo $percent; ?>)
                              $("#percent").text(ui.value);
                              else
                                    return false;
                        },
                  });
                  $("#percent").text($("#slider").slider("value"));
            });
      </script>

<?php endif; ?>