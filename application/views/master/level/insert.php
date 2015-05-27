<?php if ($create == "Y"): ?>
      <h3 id="adduser">FORM INPUT</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Nama : </label> 
                  <input name="txtName" id="txtName" type="text" /> <span class="error" id="errTxtName"></span>
                  <br>
                  <label for="keterangan">Keterangan : </label> 
                  <input name="txtKeterangan" id="txtKeterangan" type="text" />
                  <br>
                  <label for="name">Akses Data : </label> 
                  <input name="rdbAccessData" type="radio" value="0" checked="checked" /> Hanya data saya&nbsp;&nbsp;&nbsp;
                  <input name="rdbAccessData" type="radio" value="1" /> Semua data
                  <br>
                  <label for="contact">Akses : </label> 
                  <span class="error" id="errTxtAccess"></span>
                  <table style="width: 400px;">
                        <thead>
                              <tr>
                                    <th>Menu</th>
                                    <th>Sub Menu</th>
                                    <th>C</th>
                                    <th>R</th>
                                    <th>U</th>
                                    <th>D</th>
                                    <th>P</th>
                              </tr>
                        </thead>
                        <tbody id="level">
                              <tr align="center">
                                    <td>Kalender</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="CALENDAR|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Master</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Client</td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Unit</td>
                                    <td><input type="checkbox" name="chkAccess" value="UNIT|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="UNIT|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="UNIT|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="UNIT|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Agency</td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Level</td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Departemen</td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>User</td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Iklan</td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Kanal</td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Posisi</td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Harga</td>
                                    <td><input type="checkbox" name="chkAccess" value="HARGA|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="HARGA|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="HARGA|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="HARGA|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Produk Grup</td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Production</td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUCTION|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUCTION|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUCTION|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUCTION|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Kategori Industri</td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Sub Industri</td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Conflict Brand</td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Brandcomm</td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Cpm</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="CPM|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CPM|U" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Order</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Paket</td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|D" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|P" /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Space</td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|D" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|P" /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="ORDER_RECEIVE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="ORDER_RECEIVE|U" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Approve</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE|U" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Brandcomm</td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|D" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|P" /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>PO</td>
									<td></td>
                                    <td><input type="checkbox" name="chkAccess" value="PO|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PO|U" /></td>
									<td></td>
									<td></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Approve Manager</td>
									<td></td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE_MANAGER|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE_MANAGER|U" /></td>
									<td></td>
									<td></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Invoice</td>
									<td></td>
                                    <td><input type="checkbox" name="chkAccess" value="INVOICE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INVOICE|U" /></td>
									<td></td>
									<td></td>
                              </tr>
                              <tr align="center">
                                    <td>Timeline</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="TIMELINE|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Tayang</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Request</td>
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|R" /></td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="RECEIVE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="RECEIVE|U" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Backdate</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Request</td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_RECEIVE|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_RECEIVE|U" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Report</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" id="check_uncheck" value="" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Occupancy</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_OCCUPANCY|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Order</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_ORDER|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Closing</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_CLOSING|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Expired</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_EXPIRED|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Unapprove</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_UNAPPROVE|R" /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Offer Position</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|C" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|R" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|U" /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|D" /></td>
                                    <td>&nbsp;</td>
                              </tr>
                        </tbody>
                  </table>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('level', 'insert', '<?php echo site_url("master_level/insert"); ?>', '<?php echo site_url("master_level/content"); ?>', '<?php echo site_url("master_level/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Reset" onclick="loadForm('<?php echo site_url("master_level/insert_page"); ?>')" />
            </div>
      </form>

      <script type="text/javascript">
            $(document).ready(function() {
                  $("#check_uncheck").die('click').live("click", function() {
                        var index = $(this).parent().prevAll().length + 1;
                        var start = $(this).parents("tr").prevAll().length;
                        var end = "";
      			
                        $("#level tr").slice(start+1).each(function() {
                              var menu = $(this).children("td:nth-child(1)").text();
                              if ($.trim(menu) != "") {
                                    end = $(this).prevAll().length;
                                    return false;
                              }
                        });
      			
                        var isChecked = $(this).parents("tr").children("td:nth-child("+index+")").find("input:checkbox").is(":checked");
      			
                        if (end != "") {
                              $("#level tr").slice(start, end).each(function() {
                                    if (isChecked)
                                          $(this).children("td:nth-child("+index+")").find("input:checkbox").attr("checked", "checked");
                                    else
                                          $(this).children("td:nth-child("+index+")").find("input:checkbox").removeAttr("checked");
                              });
                        } else {
                              $("#level tr").slice(start).each(function() {
                                    if (isChecked)
                                          $(this).children("td:nth-child("+index+")").find("input:checkbox").attr("checked", "checked");
                                    else
                                          $(this).children("td:nth-child("+index+")").find("input:checkbox").removeAttr("checked");
                              });
                        }
                  });
            });
      </script>

<?php endif; ?>