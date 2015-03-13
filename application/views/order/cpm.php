<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="100px">Kanal</td>
                  <td width="20px">:</td>
                  <td><?php echo $kanal; ?></td>
            </tr>
            <tr>
                  <td>Produk Grup</td>
                  <td>:</td>
                  <td><?php echo $product_group; ?></td>
            </tr>
            <tr>
                  <td>Posisi</td>
                  <td>:</td>
                  <td><?php echo $position; ?></td>
            </tr>
            <tr>
                  <td>Imps Quota/Day</td>
                  <td>:</td>
                  <td><?php echo number_format($cpm_quota, 0, ",", "."); ?></td>
            </tr>
      </table>

      <table class="noborder">
            <tr>
                  <td width="120px"><strong>Impression</strong></td>
                  <td width="20px">&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
      </table>
      <table>
            <thead>
                  <tr>
                        <th>Tanggal</th>
                        <th>Imps Used</th>
                        <th>Imps Remaining</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  foreach ($all_date as $row_date):
                        $day = $row_date;
                        $expDate = explode("-", $day);
                        $year = $expDate[0];
                        $month = $expDate[1];
                        $date = $expDate[2];

                        $cpmUsed = (isset($all_cpm[$year][$month][$date])) ? $all_cpm[$year][$month][$date] : 0;
                        $cpmRemaining = $cpm_quota - $cpmUsed;
                        ?>
                        <tr class='remove'>
                              <td align='center'>
                                    <?php echo format_date($row_date, TRUE); ?>
                              </td>
                              <td align='center'>
                                    <?php echo number_format($cpmUsed, 0, ",", "."); ?>
                              </td>
                              <td align='center'>
                                    <?php echo number_format($cpmRemaining, 0, ",", "."); ?>
                              </td>
                        </tr>
                        <?php
                  endforeach;
                  ?>
            </tbody>
      </table>
      </p>
<?php endif; ?>