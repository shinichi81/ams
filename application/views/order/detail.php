<?php
$n = 0;
foreach ($all_detail as $detail):
      ?>
      <tr class='remove'>
            <td align='center'>
                  <select name='selectAds' id='selectAds'>
                        <?php
                        foreach ($all_ads as $ads):
                              $selected = "";
                              if ($detail->ads_id == $ads->id)
                                    $selected = "selected='selected'";
                              ?>
                              <option value='<?php echo $ads->id; ?>' <?php echo $selected; ?>><?php echo $ads->name; ?></option>
                              <?php
                        endforeach;
                        ?>
                  </select>
            </td>
            <td align='center'>
                  <select name='selectKanal' id='selectKanal'>
                        <?php
                        foreach ($all_kanal as $kanal):
                              $selected = "";
                              if ($detail->kanal_id == $kanal->id)
                                    $selected = "selected='selected'";
                              ?>
                              <option value='<?php echo $kanal->id; ?>' <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
                              <?php
                        endforeach;
                        ?>
                  </select>
            </td>
            <td align='center'>
                  <select name='selectProductGroup' id='selectProductGroup'>
                        <?php
                        foreach ($arr_productgroup[$n] as $productgroup):
                              $selected = "";
                              if ($detail->product_group_id == $productgroup->id)
                                    $selected = "selected='selected'";
                              ?>
                              <option value='<?php echo $productgroup->id; ?>' <?php echo $selected; ?>><?php echo $productgroup->name; ?></option>
                              <?php
                        endforeach;
                        ?>
                  </select>
            </td>
            <td align='center'>
                  <select name='selectPosition' id='selectPosition'>
                        <?php
                        $isCpmQuota = FALSE;
                        foreach ($arr_position[$n] as $position):
                              $selected = "";
                              if ($detail->position_id == $position->id) {
                                    $selected = "selected='selected'";
                                    if (in_array($position->id, $all_cpm_position[$n]))
                                          $isCpmQuota = TRUE;
                              }
                              ?>
                              <option value='<?php echo $position->id; ?>' <?php echo $selected; ?> rel='<?php echo (in_array($position->id, $all_cpm_position[$n])) ? "Y" : "N"; ?>'><?php echo $position->name; ?></option>
                              <?php
                        endforeach;
                        ?>
                  </select>
            </td>
            <td align='center'>
                  <input name='txtCpmQuota' type='text' style='width:50px; <?php echo ($isCpmQuota === TRUE) ? "" : "background-color:#DCDCDC;"; ?>' <?php echo ($isCpmQuota === TRUE) ? "" : "readonly='readonly'"; ?> value="<?php echo number_format($detail->cpm_quota, 0, ",", "."); ?>" onkeyup="currencySeparator(this, '.')" onkeydown="return numberOnly(event);" />
                  <a href='javascript:void(0);' <?php echo ($isCpmQuota === TRUE) ? "" : "style='display:none;'"; ?> id='show_cpm'><img src='<?php echo image_path("icons/info.ico"); ?>' align='top' /></a>
            </td>
            <td align='center'>
                  <input name='txtStartDate' class='txtStartDate' type='text' style='width:70px;' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->start_date; ?>" />
                  -
                  <input name='txtEndDate' class='txtEndDate' type='text' style='width:70px;' onmousedown="$(this).datepicker({dateFormat: 'yy-mm-dd', minDate: new Date(<?php echo date("Y"); ?>, <?php echo date("n") - 1; ?>, <?php echo date("j"); ?>)});" value="<?php echo $detail->end_date; ?>" />
            </td>
            <td align='center'>
                  <textarea name='txtMiscInfoPaket' id='txtMiscInfoPaket' style='height: 30px; width: 130px;'><?php echo $detail->misc_info; ?></textarea>
            </td>
            <td align='center'>
                  <button type='button' name='btnHapus' id='btnHapus' title='Hapus' class='btn'><img src='<?php echo image_url("icons/delete.gif"); ?>' alt='Hapus' /></button>
                  <div class='error' id='errConflict'></div>
            </td>
      </tr>
      <?php
      $n += 1;
endforeach;
?>