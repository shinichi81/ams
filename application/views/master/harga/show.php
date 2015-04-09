<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="110px">Kanal</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->kanal; ?></td>
            </tr>
            <tr>
                  <td>Product</td>
                  <td>:</td>
                  <td><?php echo $all_data->product; ?></td>
            </tr>
            <tr>
                  <td>Posisi</td>
                  <td>:</td>
                  <td><?php echo $all_data->position; ?></td>
            </tr>
            <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td><?php echo "Rp. " . number_format($all_data->harga, 0, ",", "."); ?></td>
            </tr>
	  </table>
	  </p>
<?php endif; ?>