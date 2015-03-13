<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td>Industri</td>
                  <td>:</td>
                  <td><?php echo $all_data->industry_name; ?></td>
            </tr>
            <tr>
                  <td valign="top">Sub Industri</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($selected_subindustry as $subindustry): ?>
                              > <?php echo $subindustry->name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
      </table>
      </p>
<?php endif; ?>