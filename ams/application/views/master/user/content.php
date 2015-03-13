<table width="100%">
	<thead>
		<tr>
			<th width="40px"><a href="#">No</a></th>
        	<th><a href="#">Username</a></th>
        	<th><a href="#">Nama</a></th>
        	<th><a href="#">Email</a></th>
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
        	<td><?php echo $data->username; ?></td>
        	<td><?php echo $data->name; ?></td>
        	<td><?php echo $data->email; ?></td>
            <td><?php echo format_date($data->create_date); ?></td>
            <td><?php echo format_date($data->update_date); ?></td>
            <td>
            	<?php if ($read == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("master_user/show_page"); ?>', '<?php echo $data->username; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($update == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("master_user/update_page"); ?>', '<?php echo $data->username; ?>')"><img src="<?php echo image_path("icons/user_edit.png"); ?>" title="Edit" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($delete == "Y"): ?>
            	<a href="javascript:void(0);" onclick="show_dialog_delete('user', 'delete', '<?php echo site_url("master_user/delete"); ?>', '<?php echo site_url("master_user/content"); ?>', '<?php echo site_url("master_user/insert_page"); ?>', '<?php echo $data->username; ?>')"><img src="<?php echo image_path("icons/user_delete.png"); ?>" title="Delete" width="16" height="16" /></a>
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
</div>