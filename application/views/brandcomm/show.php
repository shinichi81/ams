<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="150px">No Brandcomm</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->no_brandcomm; ?></td>
            </tr>
            <tr>
                  <td>Order By</td>
                  <td>:</td>
                  <td><?php echo $all_data->name; ?></td>
            </tr>
            <tr>
                  <td>Order Date</td>
                  <td>:</td>
                  <td><?php echo format_date($all_data->start_date, TRUE); ?></td>
            </tr>
            <tr>
                  <td>Deadline Date</td>
                  <td>:</td>
                  <td><?php echo format_date($all_data->end_date, TRUE); ?></td>
            </tr>
            <tr>
                  <td>Done</td>
                  <td>:</td>
                  <td><?php echo ($all_data->done == "Y") ? "Ya" : "Belum"; ?></td>
            </tr>
            <tr>
                  <td>Approve</td>
                  <td>:</td>
                  <td><?php echo ($all_data->approve == "Y") ? "Ya" : "Belum"; ?></td>
            </tr>
            <tr>
                  <td>Jadi Paket</td>
                  <td>:</td>
                  <td><?php echo ($all_data->is_order_paket == "Y") ? "Ya" : "Belum"; ?></td>
            </tr>
      </table>
      <table class="noborder">
            <tr>
                  <td width="150px"><strong>ITEM</strong></td>
                  <td width="20px">&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
      </table>
      <table>
            <thead>
                  <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Detail</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  foreach ($all_detail as $key => $detail):
                        ?>
                        <tr class='remove'>
                              <td align='center'>
                                    <?php echo++$key; ?>
                              </td>
                              <td>
                                    <?php echo $detail->item; ?>
                              </td>
                              <td align='center'>
                                    <?php echo $detail->detail; ?>
                              </td>
                        </tr>
                        <?php
                  endforeach;
                  ?>
            </tbody>
      </table>
      <table class="noborder">
            <tr>
                  <td width="150px">Status Feedback Client</td>
                  <td width="20px">:</td>
                  <td><?php echo ($all_data->enable_feedback == "Y") ? "Enable" : "Disable"; ?></td>
            </tr>
            <tr>
                  <td>Feedback Client</td>
                  <td>:</td>
                  <td><?php echo $all_data->feedback; ?></td>
            </tr>
            <tr>
                  <td>Progress</td>
                  <td>:</td>
                  <td><?php echo $all_data->progress; ?>%</td>
            </tr>
      </table>
      </p>
<?php endif; ?>