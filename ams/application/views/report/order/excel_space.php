<?php
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=report_order_paket.xls');
?>

<strong>
Report Order Space<br>
AE / Sales : <?php echo $ae; ?><br>
Periode : <?php echo ina_date($start_date) ." - ". ina_date($end_date); ?><br><br>
</strong>
<table width="100%" border="1">
	<thead>
		<tr bgcolor="#cccccc">
			<th width="40px">No</th>
        	<th>Tanggal Request</th>
        	<th>No Space</th>
        	<th>Agency</th>
        	<th>Client</th>
        	<?php /*
        	<th><a href="#">Jadi Paket</a></th>
            <th width="130px"><a href="#">Tanggal Buat</a></th>
            <th width="130px"><a href="#">Tanggal Update</a></th>
            */ ?>
        </tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		foreach ($all_data as $data): ?>
		<tr align="center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo format_date($data["requestdate"], TRUE); ?></td>
        	<td><?php echo $data["nospace"]; ?></td>
        	<td><?php echo $data["agency"]; ?></td>
        	<td><?php echo $data["client"]; ?></td>
        	<?php /*
        	<td><?php echo ($data->is_order_paket == "Y") ? "Ya" : "Belum"; ?></td>
            <td><?php echo format_date($data->create_date); ?></td>
            <td><?php echo format_date($data->update_date); ?></td>
            */ ?>
        </tr>
        <tr>
        	<td>&nbsp;</td>
        	<td colspan="4">
        		<table border="1">
					<thead>
						<tr bgcolor="#cccccc">
							<th>Iklan</th>
							<th>Kanal</th>
							<th>Produk Grup</th>
							<th>Posisi</th>
							<th>Periode</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data["detail"] as $detail): ?>
						<tr class='remove'>
							<td align='center'>
						   		<?php echo $detail["iklan"]; ?>
						   	</td>
						   	<td align='center'>
						   		<?php echo $detail["kanal"]; ?>
						   	</td>
						   	<td align='center'>
						   		<?php echo $detail["productgroup"]; ?>
						   	</td>
						   	<td align='center'>
						   		<?php echo $detail["position"]; ?>
						   	</td>
						   	<td align='center'>
						   		<?php echo $detail["periode"]; ?>
						   	</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
        	</td>
        </tr>
        <?php
        	$no += 1; 
		endforeach;
        ?>
	</tbody>
</table>