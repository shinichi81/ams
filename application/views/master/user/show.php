<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="90px">Username</td>
			<td width="15px">:</td>
			<td><?php echo $all_data->username; ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?php echo $all_data->name; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td>:</td>
			<td><?php echo $all_data->email; ?></td>
		</tr>
		<tr>
			<td>Departemen</td>
			<td>:</td>
			<td><?php echo $all_data->department; ?></td>
		</tr>
		<tr>
			<td>Level</td>
			<td>:</td>
			<td><?php echo $all_data->level; ?></td>
		</tr>
	</table>
</p>
<?php endif; ?>