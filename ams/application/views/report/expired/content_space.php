<a href="<?php echo site_url("report_expired_ae/excel/" . $type . "/" . $ae . "/" . $start_date . "/" . $end_date); ?>" class="right pr_12 mt_25m" >
      <img src="<?php echo image_path("icons/excel.png"); ?>" title="Excel" width="16" height="16" />
</a>
<div class="clear"></div>
<table width="100%">
      <thead>
            <tr>
                  <th width="40px"><a href="#">No</a></th>
                  <th><a href="#">Tanggal Request</a></th>
                  <th><a href="#">No Space</a></th>
                  <th><a href="#">Agency</a></th>
                  <th><a href="#">Client</a></th>
                  <?php /*
                    <th><a href="#">Jadi Paket</a></th>
                    <th width="130px"><a href="#">Tanggal Buat</a></th>
                    <th width="130px"><a href="#">Tanggal Update</a></th>
                   */ ?>
                  <th width="100px">&nbsp;</th>
            </tr>
      </thead>
      <tbody>
            <?php
            $no = $start_no;
            foreach ($all_data as $data):
                  ?>
                  <tr class="a-center">
                        <td><?php echo $no; ?></td>
                        <td><?php echo format_date($data->request_date, TRUE); ?></td>
                        <td><?php echo $data->no_space; ?></td>
                        <td><?php echo $data->agency; ?></td>
                        <td><?php echo $data->client; ?></td>
                        <?php /*
                          <td><?php echo ($data->is_order_paket == "Y") ? "Ya" : "Belum"; ?></td>
                          <td><?php echo format_date($data->create_date); ?></td>
                          <td><?php echo format_date($data->update_date); ?></td>
                         */ ?>
                        <td><a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("expired_space/show_page"); ?>', '<?php echo $data->no_space; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a></td>
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
</div>