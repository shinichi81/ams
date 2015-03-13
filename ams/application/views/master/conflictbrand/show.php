<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="100px">Industri</td>
			<td width="20px">:</td>
			<td><?php echo $selected_industry->name; ?></td>
		</tr>
		<tr>
			<td>Kanal</td>
			<td>:</td>
			<td><?php echo $selected_kanal->name; ?></td>
		</tr>
		<tr>
			<td>Produk Grup</td>
			<td>:</td>
			<td><?php echo $selected_product_group->name; ?></td>
		</tr>
		<tr>
			<td valign="top">Posisi Tersisa</td>
			<td valign="top">:</td>
			<td>
				<?php foreach ($all_position as $position): ?>
				> <?php echo $position->name; ?><br>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<td valign="top">Rule</td>
			<td valign="top">:</td>
			<td>
				<?php foreach ($all_rule_name as $rule): ?>
				> <?php echo $rule; ?><br>
				<?php endforeach; ?>
			</td>
		</tr>
	</table>
</p>
<?php endif; ?>