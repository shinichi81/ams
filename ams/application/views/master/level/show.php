<?php if ($read == "Y"): ?>
      <p>
      <table class="noborder">
            <tr>
                  <td width="100px">Nama</td>
                  <td width="20px">:</td>
                  <td><?php echo $all_data->name; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?php echo $all_data->misc_info; ?></td>
            </tr>
            <tr>
                  <td>Akses Data</td>
                  <td>:</td>
                  <td><?php echo ($all_data->access_data == "0") ? "Hanya data saya" : "Semua data"; ?></td>
            </tr>
            <tr>
                  <td>Akses</td>
                  <td>:</td>
                  <td>&nbsp;</td>
            </tr>
      </table>
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
            <tbody>
                  <tr align="center">
                        <td>Kalender</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CALENDAR|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>Master</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Client</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CLIENT|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CLIENT|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CLIENT|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CLIENT|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Agency</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["AGENCY|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["AGENCY|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["AGENCY|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["AGENCY|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Level</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["LEVEL|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["LEVEL|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["LEVEL|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["LEVEL|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Departemen</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["DEPARTMENT|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["DEPARTMENT|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["DEPARTMENT|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["DEPARTMENT|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>User</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["USER|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["USER|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["USER|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["USER|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Iklan</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["IKLAN|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["IKLAN|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["IKLAN|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["IKLAN|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Kanal</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["KANAL|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["KANAL|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["KANAL|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["KANAL|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Posisi</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["POSISI|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["POSISI|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["POSISI|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["POSISI|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Produk Grup</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PRODUKGRUP|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PRODUKGRUP|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PRODUKGRUP|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PRODUKGRUP|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Kategori Industri</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CATEGORYINDUSTRY|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CATEGORYINDUSTRY|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CATEGORYINDUSTRY|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CATEGORYINDUSTRY|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Sub Industri</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["INDUSTRY|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["INDUSTRY|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["INDUSTRY|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["INDUSTRY|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Conflict Brand</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CONFLICTBRAND|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CONFLICTBRAND|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CONFLICTBRAND|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CONFLICTBRAND|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Brandcomm</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["MASTERBRANDCOMM|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["MASTERBRANDCOMM|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["MASTERBRANDCOMM|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["MASTERBRANDCOMM|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Cpm</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CPM|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["CPM|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>Order</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Paket</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PAKET|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PAKET|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PAKET|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PAKET|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["PAKET|P"])) ? "checked='checked'" : ""; ?> /></td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Space</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["SPACE|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["SPACE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["SPACE|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["SPACE|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["SPACE|P"])) ? "checked='checked'" : ""; ?> /></td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Approve</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["APPROVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["APPROVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Receive</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["ORDER_RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["ORDER_RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Brandcomm</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BRANDCOMM|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BRANDCOMM|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BRANDCOMM|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BRANDCOMM|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BRANDCOMM|P"])) ? "checked='checked'" : ""; ?> /></td>
                  </tr>
                  <tr align="center">
                        <td>Timeline</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["TIMELINE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>Tayang</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Request</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REQUEST|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REQUEST|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REQUEST|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Receive</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>	
                  <tr align="center">
                        <td>Backdate</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Request</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_REQUEST|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_REQUEST|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_REQUEST|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_REQUEST|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Receive</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_RECEIVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["BACKDATE_RECEIVE|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>	
                  <tr align="center">
                        <td>Report</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Occupancy</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REPORT_OCCUPANCY|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Order</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REPORT_ORDER|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Closing</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REPORT_CLOSING|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Expired</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REPORT_EXPIRED|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>&nbsp;</td>
                        <td>Unapprove</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["REPORT_UNAPPROVE|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                  </tr>
                  <tr align="center">
                        <td>Offer Position</td>
                        <td>&nbsp;</td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["OFFER_POSITION|C"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["OFFER_POSITION|R"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["OFFER_POSITION|U"])) ? "checked='checked'" : ""; ?> /></td>
                        <td><input type="checkbox" disabled="disabled" <?php echo (isset($all_access["OFFER_POSITION|D"])) ? "checked='checked'" : ""; ?> /></td>
                        <td>&nbsp;</td>
                  </tr>
            <tbody>
      </table>
      </p>
<?php endif; ?>