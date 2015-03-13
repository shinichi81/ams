<table width="100%">
	<thead>
		<tr>
			<th width="40px"><a href="#">No</a></th>
        	<th><a href="#">Tipe</a></th>
        	<th><a href="#">Kanal</a></th>
        	<th><a href="#">Produk Grup</a></th>
        	<th><a href="#">Posisi</a></th>
        	<th><a href="#">Tanggal Buat</a></th>
        	<th><a href="#">Tanggal Update</a></th>
        	<?php /*
            <th width="130px"><a href="#">Tanggal Buat</a></th>
            <th width="130px"><a href="#">Tanggal Update</a></th>
            */ ?>
            <th width="100px">&nbsp;</th>
        </tr>
	</thead>
	<tbody>
		<?php 
		$no = $start_no;
		foreach ($all_data as $data): ?>
		<tr class="a-center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data->ads; ?></td>
        	<td><?php echo $data->kanal; ?></td>
        	<td><?php echo $data->product_group; ?></td>
        	<td><?php echo $data->position; ?></td>
        	<td><?php echo format_date($data->create_date, TRUE); ?></td>
        	<td><?php echo format_date($data->update_date, TRUE); ?></td>
            <?php /*
            <td><?php echo format_date($data->create_date); ?></td>
            <td><?php echo format_date($data->update_date); ?></td>
			*/ ?>
            <td>
            	<?php if ($read == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("offer_position/show_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($update == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("offer_position/update_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user_edit.png"); ?>" title="Edit" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($delete == "Y"): ?>
            	<a href="javascript:void(0);" onclick="show_dialog_delete('order', 'delete', '<?php echo site_url("offer_position/delete"); ?>', '<?php echo site_url("offer_position/content"); ?>', '<?php echo site_url("offer_position/insert_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user_delete.png"); ?>" title="Delete" width="16" height="16" /></a>
            	<?php endif; ?>
            </td>
        </tr>
        <?php
        	$no += 1; 
		endforeach;
        ?>
	</tbody>
</table>
<div id="pager">
	Halaman:
	<select name="selectPage" id="selectPage">
		<?php 
		for ($n=1; $n<=$total_page; $n++): 
			$selected = "";
			if ($page == $n)
				$selected = "selected='selected'"; 
		?>
		<option value="<?php echo $n; ?>" <?php echo $selected; ?>><?php echo $n; ?></option>
		<?php endfor; ?>
	</select> 
	dari <strong><?php echo $total_page; ?></strong> halaman
	
	<?php /*
	<div style="margin-right: 10px; float: right;">
		Cari Berdasarkan : 
		<?php 
		$selectedAll = "";
		$selectedT = "";
		$selectedF = "";
		$selectedY = "";
		$selectedN = "";
		$selectedNopaket = "";
		if ($order_by == "ALL")
			$selectedAll = "selected='selected'";
		elseif ($order_by == "T")
			$selectedT = "selected='selected'";
		elseif ($order_by == "F")
			$selectedF = "selected='selected'";
		elseif ($order_by == "Y")
			$selectedY = "selected='selected'";
		elseif ($order_by == "N")
			$selectedN = "selected='selected'";
		else
			$selectedNopaket = "selected='selected'";
		?>
		<select name="selectOrderBy" id="selectOrderBy">
			<option value="ALL" <?php echo $selectedAll; ?>>Semua</option>
			<option value="T" <?php echo $selectedT; ?>>Sudah Done</option>
			<option value="F" <?php echo $selectedF; ?>>Belum Done</option>
			<option value="Y" <?php echo $selectedY; ?>>Sudah Approve</option>
			<option value="N" <?php echo $selectedN; ?>>Belum Approve</option>
			<option value="nopaket" <?php echo $selectedNopaket; ?>>No Paket</option>
		</select>
		<input type="text" name="txtSearch" id="txtSearch" <?php echo (empty($selectedNopaket)) ? "style='display: none;'" : "value='".$order_by."'"; ?> />
	</div>
	*/ ?>
</div>