<?php
$no = 1;
foreach ($all_data as $data):
      ?>
      <tr class="a-center">
            <td class="a-center"><?php echo $no; ?></td>
            <td><?php echo format_date($data->request_date, TRUE); ?></td>
            <td><?php echo $data->no_space; ?></td>
            <td><?php echo $data->sales; ?></td>
            <td><?php echo $data->agency; ?></td>
            <td><?php echo $data->client; ?></td>
            <td>
                  <a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("order_space/show_page"); ?>', '<?php echo $data->no_space; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
                  <a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("order/insert_space_page/"); ?>', '<?php echo $data->no_space; ?>')"><img src="<?php echo image_path("icons/user_select.png"); ?>" title="Pilih" width="16" height="16" /></a>
            </td>
      </tr>
      <?php
      $no += 1;
endforeach;
?>