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
                  <?php foreach ($all_detail as $key => $detail): ?>
                        <tr>
                              <td align="center"><?php echo ($key + 1); ?></td>
                              <td><?php echo $detail->item; ?></td>
                              <td><?php echo $detail->detail; ?></td>
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