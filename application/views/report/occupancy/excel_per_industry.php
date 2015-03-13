<?php
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=report_per_industri.xls');
?>

<strong>
Report Occupancy per Industri<br>
Bulan : <?php echo inaDateNoTanggal($yearmonth); ?><br><br>
</strong>
<table width="100%" border="1">
	<thead>
		<tr bgcolor="#cccccc">
			<th width="40px">No</th>
			<th>Industri</th>
			<th>Total Hari</th>
			<th>Occupancy</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		foreach($all_occupancy as $data): 
		?>
		<tr class="a-center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data["industry"]; ?></td>
        	<td><?php echo $data["total_day"]; ?></td>
            <td><?php echo $data["occupancy"]; ?>%</td>
        </tr>
        <?php
        	$no += 1;
        endforeach; 
        ?>
	</tbody>
</table>