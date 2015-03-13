<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="100px">Tipe</td>
			<td width="20px">:</td>
			<td><?php echo $all_data->ads; ?></td>
		</tr>
		<tr>
			<td>Kanal</td>
			<td>:</td>
			<td><?php echo $all_data->kanal; ?></td>
		</tr>
		<tr>
			<td>Produk Grup</td>
			<td>:</td>
			<td><?php echo $all_data->product_group; ?></td>
		</tr>
		<tr>
			<td>Posisi</td>
			<td>:</td>
			<td><?php echo $all_data->position; ?></td>
		</tr>
		<tr>
			<td>Dimension</td>
			<td>:</td>
			<td><?php echo $all_data->dimension; ?></td>
		</tr>
		<tr>
			<td>Size</td>
			<td>:</td>
			<td><?php echo $all_data->size; ?></td>
		</tr>
		<tr>
			<td>Rate Period</td>
			<td>:</td>
			<td><?php echo ($all_data->rate_period == "W") ? "Weekly" : "Monthly "; ?></td>
		</tr>
		<tr>
			<td>Gross Rate</td>
			<td>:</td>
			<td><?php echo $all_data->gross_rate; ?></td>
		</tr>
		<tr>
			<td>Picture Name</td>
			<td>:</td>
			<td><?php echo $all_data->pictures_name; ?></td>
		</tr>
		<tr>
			<td>Imp</td>
			<td>:</td>
			<td><?php echo $all_data->imp; ?></td>
		</tr>
		<tr>
			<td>SOV</td>
			<td>:</td>
			<td><?php echo $all_data->sov; ?></td>
		</tr>
	</table>
</p>
<?php endif; ?>