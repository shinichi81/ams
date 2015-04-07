<?php if ($read == "Y"): ?>
      <p>
		<table class="noborder">
            <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?php echo $all_data->name; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info; ?></td>
            </tr>
		</table>
		
      </p>
<?php endif; ?>