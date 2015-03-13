<div id="box">
      <h3 id="adduser">Report Closing per AE</h3>
      <div style="padding: 5px">
            AE / Sales:
            <select id="selectOrderBy">
                  <option value="-">-</option>
                  <?php foreach ($all_ae as $ae): ?>
                        <option value="<?php echo $ae->username; ?>"><?php echo $ae->name; ?></option>
                  <?php endforeach; ?>
            </select>
            Periode: 
            <input type="text" id="txtStartDate" style="width: 80px;" readonly="readonly" /> - <input type="text" id="txtEndDate" style="width: 80px;" readonly="readonly" />
            <?php /*
              <select id="selectMonth">
              <?php
              for ($i = 1; $i <= 12; $i++):
              $m = (strlen($i) == 1) ? "0" . $i : $i;
              ?>
              <option value="<?php echo $m; ?>"><?php echo ina_month($m); ?></option>
              <?php endfor; ?>
              </select>
              <select id="selectYear">
              <?php for ($i = 2012; $i <= 2030; $i++): ?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
              <?php endfor; ?>
              </select>
             */ ?>
            <input type="button" name="btnSearch" id="btnSearch" value="Cari" />
            <span class="red">* Periode adalah periode pembuatan paket oleh AE</span>
      </div>
      <div id="data">
            <!-- load data disini -->
      </div>
</div>

<script type="text/javascript">
      $(document).ready(function () {
            $("#txtStartDate").datepicker({
                  dateFormat: "yy-mm-dd",
                  maxDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)
            }); 
            $("#txtEndDate").datepicker({
                  dateFormat: "yy-mm-dd",
                  maxDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)
            }); 
      });
</script>