<table width="100%">
	<thead>
		<tr>
			<th width="40px"><a href="#">No</a></th>
        	<th><a href="#">Tanggal Request</a></th>
                <th><a href="#">No Request</a></th>
        	<th><a href="#">No Paket</a></th>
        	<th><a href="#">No Paket User</a></th>
        	<th><a href="#">AE / Sales</a></th>
        	<th><a href="#">Jenis Order</a></th>
        	<th><a href="#">Status</a></th>
        	<?php /*
            <th width="130px"><a href="#">Tanggal Buat</a></th>
            <th width="130px"><a href="#">Tanggal Update</a></th>
            */ ?>
        	<th><a href="#">Receive</a></th>
            <th width="80px">&nbsp;</th>
        </tr>
	</thead>
	<tbody>
		<?php 
		$no = $start_no;
		foreach ($all_data as $data): ?>
		<tr class="a-center">
        	<td><?php echo $no; ?></td>
        	<td><?php echo format_date($data->request_date, TRUE); ?></td>
                <td><?php echo $data->no_request; ?></td>
        	<td><?php echo $data->no_paket; ?></td>
        	<td><?php echo $data->no_paket_user; ?></td>
        	<td><?php echo $data->sales; ?></td>
        	<td><?php echo $data->request_type; ?></td>
        	<td><?php echo (empty($data->date_monitor) or $data->date_monitor == "0000-00-00 00:00:00") ? "Belum Diproses" : "Sudah Diproses"; ?></td>
            <?php /*
            <td><?php echo format_date($data->create_date); ?></td>
            <td><?php echo format_date($data->update_date); ?></td>
            */ ?>
			<?php // remark 8 april 2013 @tio
				$update_user = isset($data->update_user)?$data->update_user:'';
				$get_user_receive = $this->User_Model->get($update_user);
				$user_update = isset($get_user_receive->name)?$get_user_receive->name:'';
				$user_receive = isset($user_update)?$user_update:'';
			?>
        	<td><?php echo $user_receive; ?></td>
            <td>
            	<?php if ($read == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("receive/show_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
            	<?php endif; ?>
            	<?php if ($update == "Y"): ?>
            	<a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("receive/update_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user_edit.png"); ?>" title="Edit" width="16" height="16" /></a>
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
		$selectedY = "";
		$selectedN = "";
		$selectedNopaket = "";
		if ($order_by == "ALL")
			$selectedAll = "selected='selected'";
		elseif ($order_by == "Y")
			$selectedY = "selected='selected'";
		elseif ($order_by == "N")
			$selectedN = "selected='selected'";
		else
			$selectedNopaket = "selected='selected'";
		?>
		<select name="selectOrderBy" id="selectOrderBy">
			<option value="ALL" <?php echo $selectedAll; ?>>Semua</option>
			<option value="Y" <?php echo $selectedY; ?>>Sudah Diproses</option>
			<option value="N" <?php echo $selectedN; ?>>Belum Diproses</option>
			<option value="nopaket" <?php echo $selectedNopaket; ?>>No Paket</option>
		</select>
		<input type="text" name="txtSearch" id="txtSearch" <?php echo (empty($selectedNopaket)) ? "style='display: none;'" : "value='".$order_by."'"; ?> />
	</div>
</div>