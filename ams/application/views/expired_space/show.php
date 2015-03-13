<?php if ($read == "Y"): ?>
<p>
	<table class="noborder">
		<tr>
			<td width="100px">No Space</td>
			<td width="20px">:</td>
			<td><?php echo $all_data->no_space; ?></td>
		</tr>
		<tr>
			<td>Agency</td>
			<td>:</td>
			<td><?php echo $all_data->agency; ?></td>
		</tr>
		<tr>
			<td>Client</td>
			<td>:</td>
			<td><?php echo $all_data->client; ?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td><?php echo $all_data->misc_info; ?></td>
		</tr>
		<tr>
			<td>AE / Sales</td>
			<td>:</td>
			<td><?php echo $all_data->sales; ?></td>
		</tr>
		<tr>
			<td>Jadi Paket</td>
			<td>:</td>
			<td><?php echo ($all_data->is_order_paket == "Y") ? "Ya" : "Belum"; ?></td>
		</tr>
		<tr>
			<td>Space</td>
			<td>:</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table>
		<thead>
			<th>Iklan</th>
			<th>Kanal</th>
			<th>Produk Grup</th>
			<th>Posisi</th>
			<th>Periode</th>
			<th>Keterangan</th>
		</thead>
		<tbody>
			<?php
			$n = 0; 
			foreach ($all_detail as $detail): 
			?>
			<tr class='remove'>
				<td align='center'>
			   		<?php echo $arr_ads[$n]->name; ?>
			   	</td>
			   	<td align='center'>
			   		<?php echo $arr_kanal[$n]->name; ?>
			   	</td>
			   	<td align='center'>
			   		<?php echo $arr_productgroup[$n]->name; ?>
			   	</td>
			   	<td align='center'>
			   		<?php echo $arr_position[$n]->name; ?>
			   	</td>
			   	<td align='center'>
			   		<?php echo format_date($detail->start_date, TRUE); ?>
			   		-
			   		<?php echo format_date($detail->end_date, TRUE); ?>
			   	</td>
			   	<td align='center'>
			   		<?php echo $detail->misc_info; ?>
			   	</td>
			</tr>
			<?php
				$n += 1; 
			endforeach; 
			?>
		</tbody>
	</table>
	<table class="noborder">
		<tr>
			<td width="100px">Conflict Brand</td>
			<td width="20px">:</td>
			<td><?php echo $all_data->is_restrict; ?></td>
		</tr>
		<tr>
			<td>Industri</td>
			<td>:</td>
			<td><?php echo $all_data->industry; ?></td>
		</tr>
		<tr>
			<td>Progress</td>
			<td>:</td>
			<td><?php echo $all_data->progress; ?>%</td>
		</tr>
	</table>
</p>
<?php endif; ?>