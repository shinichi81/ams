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
                                    <th><a href="#">No Paket</a></th>
                                    <th><a href="#">No Paket User</a></th>
                                    <th><a href="#">Agency</a></th>
                                    <th><a href="#">Client</a></th>
                                    <th width="50px">&nbsp;</th>
                              </tr>
                        </thead>
                        <tbody id="addme">
                              <?php
                              $no = 1;
                              foreach ($all_data as $data):
                                    ?>
                                    <tr class="a-center">
                                          <td class="a-center"><?php echo $no; ?></td>
                                          <td><?php echo format_date($data->request_date, TRUE); ?></td>
                                          <td><?php echo $data->no_paket; ?></td>
                                          <td><?php echo $data->no_paket_user; ?></td>
                                          <td><?php echo $data->agency; ?></td>
                                          <td><?php echo $data->client; ?></td>
                                          <td>
                                                <a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("order/show_page"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
                                                <a href="javascript:void(0);" onclick="loadForm('<?php echo site_url("backdate_request/insert_request_page/"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/user_select.png"); ?>" title="Pilih" width="16" height="16" /></a>
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
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("backdate_request/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>