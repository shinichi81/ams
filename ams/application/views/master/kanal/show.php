<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="50px">Nama</td>
			<td width="15px">:</td>
			<td><?php echo $all_data->name; ?></td>
		</tr>
		<tr>
			<td valign="top">Rubrik</td>
			<td valign="top">:</td>
			<td>
				<?php foreach ($all_rubrik as $rubrik): ?>
				> <?php echo $rubrik->name; ?><br>
				<?php endforeach; ?>
			</td>
		</tr>
	</table>
</p>
<?php endif; ?>