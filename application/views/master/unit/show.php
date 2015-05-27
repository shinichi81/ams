<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="150px">Nama Perusahaan</td>
			<td width="15px">:</td>
			<td><?php echo $all_data->perusahaan; ?></td>
		</tr>
		<tr>
			<td>Nama Unit</td>
			<td>:</td>
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
</p>
<?php endif; ?>