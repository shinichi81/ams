<table width="100%">
      <thead>
            <tr>
                  <th width="40px"><a href="#">No</a></th>
                  <th><a href="#">Tanggal Request</a></th>
                  <th><a href="#">No Paket</a></th>
                  <th><a href="#">No Paket User</a></th>
                  <th><a href="#">Agency</a></th>
                  <th><a href="#">Client</a></th>
                  <th><a href="#">Approve</a></th>
                  <?php /*
                    <th width="130px"><a href="#">Tanggal Buat</a></th>
                    <th width="130px"><a href="#">Tanggal Update</a></th>
                   */ ?>
                  <th width="80px">&nbsp;</th>
            </tr>
      </thead>
      <tbody>
            <?php
            $no = $start_no;
            foreach ($all_data as $data):
                  ?>
                  <tr class="a-center">
                        <td class="a-center"><?php echo $no; ?></td>
                        <td><?php echo format_date($data->request_date, TRUE); ?></td>
                        <td><?php echo $data->no_paket; ?></td>
                        <td><?php echo $data->no_paket_user; ?></td>
                        <td><?php echo $data->agency; ?></td>
                        <td><?php echo $data->client; ?></td>
                        <td><?php echo ($data->approve == "Y") ? "Ya" : "Belum"; ?></td>
                        <?php /*
                          <td><?php echo format_date($data->create_date); ?></td>
                          <td><?php echo format_date($data->update_date); ?></td>
                         */ ?>
                        <td>
                              <?php if ($read == "Y"): ?>
                                    <a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("approve/show_page"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
                              <?php endif; ?>
                              <?php if ($update == "Y" and ($data->approve == "N" or $data->nopo == "N")): ?>
                                    <a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("approve/update_page"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/user_edit.png"); ?>" title="Edit" width="16" height="16" /></a>
                              <?php endif; ?>
                              <?php //remark tgl 3 april 2013 @tio
									//if ($update == "Y" and $data->approve == "Y" and $data->is_request == "N"):
									if ($update == "Y" and $data->approve == "Y"): ?>
                                    <a href="javascript:void(0);" onclick="show_dialog_delete('approve', 'unapprove', '<?php echo site_url("approve/unapprove"); ?>', '<?php echo site_url("approve/content"); ?>', '<?php echo site_url("approve/insert_page"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/delete.gif"); ?>" title="Unapprove" width="16" height="16" /></a>
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
            for ($n = 1; $n <= $total_page; $n++):
                  $selected = "";
                  if ($page == $n)
                        $selected = "selected='selected'";
                  ?>
                  <option value="<?php echo $n; ?>" <?php echo $selected; ?>><?php echo $n; ?></option>
            <?php endfor; ?>
      </select> 
      dari <strong><?php echo $total_page; ?></strong> halaman

      <div style="margin-right: 10px; float: right;">
            Berdasarkan : 
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
                  <option value="Y" <?php echo $selectedY; ?>>Sudah Approve</option>
                  <option value="N" <?php echo $selectedN; ?>>Belum Approve</option>
                  <option value="nopaket" <?php echo $selectedNopaket; ?>>No Paket</option>
            </select>
            <input type="text" name="txtSearch" id="txtSearch" <?php echo (empty($selectedNopaket)) ? "style='display: none;'" : "value='" . $order_by . "'"; ?> />
      </div>
</div>