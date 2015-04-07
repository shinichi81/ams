<table width="100%">
	<thead>
		<tr>
			<th width="40px"><a href="#">No</a></th>
        	<th><a href="#">Nama</a></th>
        	<th><a href="#">Keterangan</a></th>
            <th width="130px"><a href="#">Tanggal Buat</a></th>
            <th width="130px"><a href="#">Tanggal Update</a></th>
            <th width="80px">&nbsp;</th>
        </tr>
	</thead>
	<tbody>
		<?php 
		$no = $start_no;
		foreach ($all_data as $data): ?>
		<tr class="a-center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo $data->name; ?></td>
        	<td><?php echo $data->misc_info; ?></td>
            <td><?php echo format_date($data->create_date); ?></td>
            <td><?php echo format_date($data->update_date); ?></td>
            <td>
            	<?php if ($read == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("master_kanal/show_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($update == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("master_kanal/update_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user_edit.png"); ?>" title="Edit" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($delete == "Y"): ?>
            	<a href="javascript:void(0);" onclick="show_dialog_delete('kanal', 'delete', '<?php echo site_url("master_kanal/delete"); ?>', '<?php echo site_url("master_kanal/content"); ?>', '<?php echo site_url("master_kanal/insert_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user_delete.png"); ?>" title="Delete" width="16" height="16" /></a>
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
	
	<div style="margin-right: 10px; float: right;">
		Cari Berdasarkan : 
		<?php 
		$selectedAll = "";
		$selectedName = "";
		if ($order_by == "ALL")
			$selectedAll = "selected='selected'";
		else
			$selectedName = "selected='selected'";
		?>
		<select name="selectOrderBy" id="selectOrderBy">
			<option value="ALL" <?php echo $selectedAll; ?>>Semua</option>
			<option value="nopaket" <?php echo $selectedName; ?>>Nama</option>
		</select>
		<input type="text" name="txtSearch" id="txtSearch" <?php echo (empty($selectedName)) ? "style='display: none;'" : "value='".$order_by."'"; ?> />
	</div>
</div>