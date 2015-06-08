<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="60px">Nama</td>
			<td width="15px">:</td>
			<td><?php echo $all_data->name; ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $all_data->address; ?></td>
		</tr>
		<tr>
			<td>Kontak</td>
			<td>:</td>
			<td><?php echo $all_data->contact; ?></td>
		</tr>
	</table>
	  
		<table class="noborder">
            <tr>
                  <td valign="top">Unit</td>
                  <td valign="top">:</td>
                  <td>
                        <?php foreach ($all_unit as $unit): ?>
                              > <?php echo $unit->name; ?><br>
                        <?php endforeach; ?>
                  </td>
            </tr>
		</table>
</p>
<?php endif; ?>