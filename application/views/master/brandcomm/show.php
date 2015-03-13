<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="60px">Item</td>
			<td width="15px">:</td>
			<td><?php echo $all_data->item; ?></td>
		</tr>
		<tr>
			<td>No Urut</td>
			<td>:</td>
			<td><?php echo $all_data->order_number; ?></td>
		</tr>
	</table>
</p>
<?php endif; ?>