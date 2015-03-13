<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <label for="name">Nama : </label> 
                  <input name="txtName" id="txtName" type="text" value="<?php echo $all_data->name; ?>" /> <span class="error" id="errTxtName"></span>
                  <br>
                  <label for="keterangan">Ketarangan : </label> 
                  <input name="txtKeterangan" id="txtKeterangan" type="text" value="<?php echo $all_data->misc_info; ?>" />
                  <br>
                  <label for="name">Akses Data : </label> 
                  <input name="rdbAccessData" id="rdbAccessData" type="radio" value="0" <?php echo ($all_data->access_data == "0") ? "checked='checked'" : ""; ?> /> Hanya data saya&nbsp;&nbsp;&nbsp;
                  <input name="rdbAccessData" id="rdbAccessData" type="radio" value="1" <?php echo ($all_data->access_data == "1") ? "checked='checked'" : ""; ?> /> Semua data
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
                                    <td><input type="checkbox" name="chkAccess" value="CALENDAR|R" <?php echo (isset($all_access["CALENDAR|R"])) ? "checked='checked'" : ""; ?> /></td>
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
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|C" <?php echo (isset($all_access["CLIENT|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|R" <?php echo (isset($all_access["CLIENT|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|U" <?php echo (isset($all_access["CLIENT|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CLIENT|D" <?php echo (isset($all_access["CLIENT|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Agency</td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|C" <?php echo (isset($all_access["AGENCY|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|R" <?php echo (isset($all_access["AGENCY|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|U" <?php echo (isset($all_access["AGENCY|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="AGENCY|D" <?php echo (isset($all_access["AGENCY|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Level</td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|C" <?php echo (isset($all_access["LEVEL|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|R" <?php echo (isset($all_access["LEVEL|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|U" <?php echo (isset($all_access["LEVEL|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="LEVEL|D" <?php echo (isset($all_access["LEVEL|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Departemen</td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|C" <?php echo (isset($all_access["DEPARTMENT|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|R" <?php echo (isset($all_access["DEPARTMENT|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|U" <?php echo (isset($all_access["DEPARTMENT|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="DEPARTMENT|D" <?php echo (isset($all_access["DEPARTMENT|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>User</td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|C" <?php echo (isset($all_access["USER|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|R" <?php echo (isset($all_access["USER|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|U" <?php echo (isset($all_access["USER|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="USER|D" <?php echo (isset($all_access["USER|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Iklan</td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|C" <?php echo (isset($all_access["IKLAN|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|R" <?php echo (isset($all_access["IKLAN|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|U" <?php echo (isset($all_access["IKLAN|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="IKLAN|D" <?php echo (isset($all_access["IKLAN|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Kanal</td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|C" <?php echo (isset($all_access["KANAL|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|R" <?php echo (isset($all_access["KANAL|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|U" <?php echo (isset($all_access["KANAL|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="KANAL|D" <?php echo (isset($all_access["KANAL|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Posisi</td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|C" <?php echo (isset($all_access["POSISI|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|R" <?php echo (isset($all_access["POSISI|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|U" <?php echo (isset($all_access["POSISI|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="POSISI|D" <?php echo (isset($all_access["POSISI|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Produk Grup</td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|C" <?php echo (isset($all_access["PRODUKGRUP|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|R" <?php echo (isset($all_access["PRODUKGRUP|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|U" <?php echo (isset($all_access["PRODUKGRUP|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PRODUKGRUP|D" <?php echo (isset($all_access["PRODUKGRUP|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Kategori Industri</td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|C" <?php echo (isset($all_access["CATEGORYINDUSTRY|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|R" <?php echo (isset($all_access["CATEGORYINDUSTRY|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|U" <?php echo (isset($all_access["CATEGORYINDUSTRY|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CATEGORYINDUSTRY|D" <?php echo (isset($all_access["CATEGORYINDUSTRY|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Sub Industri</td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|C" <?php echo (isset($all_access["INDUSTRY|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|R" <?php echo (isset($all_access["INDUSTRY|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|U" <?php echo (isset($all_access["INDUSTRY|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="INDUSTRY|D" <?php echo (isset($all_access["INDUSTRY|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Conflict Brand</td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|C" <?php echo (isset($all_access["CONFLICTBRAND|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|R" <?php echo (isset($all_access["CONFLICTBRAND|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|U" <?php echo (isset($all_access["CONFLICTBRAND|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CONFLICTBRAND|D" <?php echo (isset($all_access["CONFLICTBRAND|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Brandcomm</td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|C" <?php echo (isset($all_access["MASTERBRANDCOMM|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|R" <?php echo (isset($all_access["MASTERBRANDCOMM|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|U" <?php echo (isset($all_access["MASTERBRANDCOMM|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="MASTERBRANDCOMM|D" <?php echo (isset($all_access["MASTERBRANDCOMM|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Cpm</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="CPM|R" <?php echo (isset($all_access["CPM|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="CPM|U" <?php echo (isset($all_access["CPM|U"])) ? "checked='checked'" : ""; ?> /></td>
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
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|C" <?php echo (isset($all_access["PAKET|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|R" <?php echo (isset($all_access["PAKET|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|U" <?php echo (isset($all_access["PAKET|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|D" <?php echo (isset($all_access["PAKET|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="PAKET|P" <?php echo (isset($all_access["PAKET|P"])) ? "checked='checked'" : ""; ?> /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Space</td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|C" <?php echo (isset($all_access["SPACE|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|R" <?php echo (isset($all_access["SPACE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|U" <?php echo (isset($all_access["SPACE|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|D" <?php echo (isset($all_access["SPACE|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="SPACE|P" <?php echo (isset($all_access["SPACE|P"])) ? "checked='checked'" : ""; ?> /></td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Approve</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE|R" <?php echo (isset($all_access["APPROVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="APPROVE|U" <?php echo (isset($all_access["APPROVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="ORDER_RECEIVE|R" <?php echo (isset($all_access["ORDER_RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="ORDER_RECEIVE|U" <?php echo (isset($all_access["ORDER_RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Brandcomm</td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|C" <?php echo (isset($all_access["BRANDCOMM|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|R" <?php echo (isset($all_access["BRANDCOMM|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|U" <?php echo (isset($all_access["BRANDCOMM|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|D" <?php echo (isset($all_access["BRANDCOMM|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BRANDCOMM|P" <?php echo (isset($all_access["BRANDCOMM|P"])) ? "checked='checked'" : ""; ?> /></td>
                              </tr>
                              <tr align="center">
                                    <td>Timeline</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="TIMELINE|R" <?php echo (isset($all_access["TIMELINE|R"])) ? "checked='checked'" : ""; ?> /></td>
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
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|C" <?php echo (isset($all_access["REQUEST|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|R" <?php echo (isset($all_access["REQUEST|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REQUEST|D" <?php echo (isset($all_access["REQUEST|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="RECEIVE|R" <?php echo (isset($all_access["RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="RECEIVE|U" <?php echo (isset($all_access["RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
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
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|C" <?php echo (isset($all_access["BACKDATE_REQUEST|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|R" <?php echo (isset($all_access["BACKDATE_REQUEST|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|U" <?php echo (isset($all_access["BACKDATE_REQUEST|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_REQUEST|D" <?php echo (isset($all_access["BACKDATE_REQUEST|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Receive</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_RECEIVE|R" <?php echo (isset($all_access["BACKDATE_RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="BACKDATE_RECEIVE|U" <?php echo (isset($all_access["BACKDATE_RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
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
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_OCCUPANCY|R" <?php echo (isset($all_access["REPORT_OCCUPANCY|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Order</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_ORDER|R" <?php echo (isset($all_access["REPORT_ORDER|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Closing</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_CLOSING|R" <?php echo (isset($all_access["REPORT_CLOSING|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Expired</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_EXPIRED|R" <?php echo (isset($all_access["REPORT_EXPIRED|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>&nbsp;</td>
                                    <td>Unapprove</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="REPORT_UNAPPROVE|R" <?php echo (isset($all_access["REPORT_UNAPPROVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                              </tr>
                              <tr align="center">
                                    <td>Offer Position</td>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|C" <?php echo (isset($all_access["OFFER_POSITION|C"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|R" <?php echo (isset($all_access["OFFER_POSITION|R"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|U" <?php echo (isset($all_access["OFFER_POSITION|U"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td><input type="checkbox" name="chkAccess" value="OFFER_POSITION|D" <?php echo (isset($all_access["OFFER_POSITION|D"])) ? "checked='checked'" : ""; ?> /></td>
                                    <td>&nbsp;</td>
                              </tr>
                        </tbody>
                  </table>
                  <input name="hdId" id="hdId" type="hidden" value="<?php echo $all_data->id; ?>" />
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Simpan" onclick="ajaxChange('level', 'update', '<?php echo site_url("master_level/update"); ?>', '<?php echo site_url("master_level/content"); ?>', '<?php echo site_url("master_level/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("master_level/insert_page"); ?>')" />
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