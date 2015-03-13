<p>
	<table class="noborder">
		<tr>
			<td width="90px">Kanal</td>
			<td width="15px">:</td>
			<td><?php echo $selected_kanal; ?></td>
		</tr>
		<tr>
			<td>Produk Grup</td>
			<td>:</td>
			<td><?php echo $selected_product_group; ?></td>
		</tr>
		<tr>
			<td>Posisi</td>
			<td>:</td>
			<td><?php echo $selected_position; ?></td>
		</tr>
	</table>
	<table width="100%" border="1">
		<thead>
			<tr>
				<th>No Paket</th>
				<th>No Paket User</th>
				<th>Tanggal Request</th>
				<th>AE / Sales</th>
				<th>Agency</th>
				<th>Client</th>
				<th>Keterangan</th>
				<th>Progress</th>
				<th>Imps Quota/Day</th>
				<th>Approve</th>
				<th>Periode</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($all_data as $data): ?>
			<tr>
				<td><?php echo $data->nomor; ?></td>
				<td><?php echo $data->no_paket_user	; ?></td>
				<td><?php echo format_date($data->request_date, TRUE); ?></td>
				<td><?php echo $data->sales; ?></td>
				<td><?php echo $data->agency; ?></td>
				<td><?php echo $data->client; ?></td>
				<td><?php echo $data->misc_info; ?></td>
				<td><?php echo $data->progress; ?>%</td>
				<td align="right"><?php echo number_format($data->cpm_quota,0,",","."); ?></td>
				<td bgcolor="<?php echo ($data->approve == "Y") ? "#FFDE00" : "#12FF00"; ?>"><?php echo ($data->approve == "Y") ? "Ya" : "Belum"; ?></td>
				<td>
					<?php echo format_date($data->start_date, TRUE); ?>
			   		-
			   		<?php echo format_date($data->end_date, TRUE); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</p>