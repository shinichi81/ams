<a href="<?php echo site_url("report_occupancy/excel/per_posisi/".$monthyear); ?>" class="right pr_12 mt_25m" >
	<img src="<?php echo image_path("icons/excel.png"); ?>" title="Excel" width="16" height="16" />
</a>
<div class="clear"></div>
<table width="100%">
	<thead>
		<tr>
			<th width="40px"><a href="#">No</a></th>
			<th><a href="#">Kanal</a></th>
			<th><a href="#">Produk Grup</a></th>
			<th><a href="#">Posisi</a></th>
			<th><a href="#">Total Hari</a></th>
			<th><a href="#">Occupancy</a></th>			
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		foreach($all_occupancy as $data): 
		?>
		<tr class="a-center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data["kanal"]; ?></td>
            <td><?php echo $data["product_group"]; ?></td>
            <td><?php echo $data["position"]; ?></td>
            <td><?php echo $data["total_day"]; ?></td>
            <td><?php echo $data["occupancy"]; ?>%</td>
        </tr>
        <?php
        	$no += 1;
        endforeach; 
        ?>
	</tbody>
</table>