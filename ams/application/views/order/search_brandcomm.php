<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM SEARCH</h3>
      <form id="form">
            <fieldset id="result">
                  <legend>Hasil Pencarian</legend>
                  <table width="100%">
                        <thead>
                              <tr>
                                    <th width="40px"><a href="#">No</a></th>
                                    <th><a href="#">Tanggal Request</a></th>
                                    <th><a href="#">No Brandcomm</a></th>
                                    <th><a href="#">Order By</a></th>
                                    <?php /*
                                      <th width="130px"><a href="#">Tanggal Buat</a></th>
                                      <th width="130px"><a href="#">Tanggal Update</a></th>
                                     */ ?>
                                    <th width="100px">&nbsp;</th>
                              </tr>
                        </thead>
                        <tbody>
                              <?php foreach ($all_data as $key => $data): ?>
                                    <tr class="a-center">
                                          <td><?php echo++$key; ?></td>
                                          <td><?php echo format_date($data->request_date, TRUE); ?></td>
                                          <td><?php echo $data->no_brandcomm; ?></td>
                                          <td><?php echo $data->name; ?></td>
                                          <?php /*
                                            <td><?php echo format_date($data->create_date); ?></td>
                                            <td><?php echo format_date($data->update_date); ?></td>
                                           */ ?>
                                          <td>
                                                <a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("brandcomm/show_page"); ?>', '<?php echo $data->no_brandcomm; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
                                                <a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("order/insert_brandcomm_page/"); ?>', '<?php echo $data->no_brandcomm; ?>')"><img src="<?php echo image_path("icons/user_select.png"); ?>" title="Pilih" width="16" height="16" /></a>
                                          </td>
                                    </tr>
                                    <?php
                                    $no += 1;
                              endforeach;
                              ?>
                        </tbody>
                  </table>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center"> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("order/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>