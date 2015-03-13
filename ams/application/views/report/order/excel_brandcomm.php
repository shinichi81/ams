<?php
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=report_order_brandcomm.xls');
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
        	<th>No Brandcomm</th>
        	<th>Sales</th>
        	<th>Marketing</th>
        	<?php /*<th>Done</th>
        	<th>Approve</th>
        	
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
        	<td><?php echo $data["nobrandcomm"]; ?></td>
        	<td><?php echo $data["order_by"]; ?></td>
        	<td><?php echo $data["updateuser"]; ?></td>
        	<?php /*
			<td><?php echo ($data["done"] == "Y") ? "Ya" : "Belum"; ?></td>
        	<td><?php echo ($data["approve"] == "Y") ? "Ya" : "Belum"; ?></td>
        	
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
							<th>No</th>
							<th colspan="3">Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data["detail"] as $detail): ?>
						<tr class='remove'>
							<td align='left'>
						   		<?php echo $detail["item"]; ?>
						   	</td>
						   	<td align='left' colspan="3">
						   		<?php echo $detail["detail"]; ?>
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