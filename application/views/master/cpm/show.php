<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="100px">Kanal</td>
                  <td width="15px">:</td>
                  <td><?php echo $all_data->kanal_name; ?></td>
            </tr>
            <tr>
                  <td>Product Group</td>
                  <td>:</td>
                  <td><?php echo $all_data->product_group_name; ?></td>
            </tr>
            <tr>
                  <td>Position</td>
                  <td>:</td>
                  <td><?php echo $all_data->position_name; ?></td>
            </tr>
            <tr>
                  <td>Cpm Quota</td>
                  <td>:</td>
                  <td><?php echo number_format($all_data->cpm_quota, 0, ",", "."); ?></td>
            </tr>
      </table>
      </p>
<?php endif; ?>