<p>
	<table class="noborder">
		<tr>
			<td width="120px">No Space</td>
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
	</table>
	<table class="noborder">
		<tr>
			<td width="100px"><strong>SPACE</strong></td>
			<td width="20px">&nbsp;</td>
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
			<td width="120px">Conflict Brand</td>
			<td width="20px">:</td>
			<td><?php echo $all_data->is_restrict; ?></td>
		</tr>
		<tr>
			<td>Industri</td>
			<td>:</td>
			<td><?php echo $all_data->industry; ?></td>
		</tr>
		<?php if ($progress == "Y"): ?>
		<tr>
			<td valign="top">Progress</td>
			<td valign="top">:</td>
			<td>
				<span id="percent">0</span>%
				<div id="slider" style="width: 380px; margin-top: 10px;"></div>
				<input type="hidden" name="hdNoSpace" id="hdNoSpace" value="<?php echo $all_data->no_space; ?>" />
			</td>
		</tr>
		<?php endif; ?>
	</table>
</p>

<script type="text/javascript">
	$(function() {
		$("#slider").slider({
			range: "max",
			min: 0,
			max: 100,
			value: <?php echo $percent; ?>,
			step: 1,
			slide: function(event, ui) {
				if (ui.value >= <?php echo $percent; ?>)
					$("#percent").text(ui.value);
				else
					return false;
			},
		});
		$("#percent").text($("#slider").slider("value"));
	});
</script>