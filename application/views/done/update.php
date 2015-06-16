<?php if ($update == "Y"): ?>
      <h3 id="adduser">FORM UPDATE</h3>
      <form id="form">
            <fieldset id="personal">
                  <legend>Data</legend>
                  <div style="float: left; width: 400px;">
                        <label for="nopaket">No Paket : </label> 
                        <input name="txtNoPaket" id="txtNoPaket" type="text" disabled="disabled" value="<?php echo $all_data->no_paket; ?>" /> <span class="error" id="errTxtNoPaket"></span>
                        <br>
                        <label for="nopaketuser">No Paket User : </label> 
                        <input name="txtNoPaketUser" id="txtNoPaketUser" type="text" value="<?php echo $all_data->no_paket_user; ?>" /> <span class="error" id="errTxtNoPaketUser"></span>
                        <br>
                        <label for="agency">Perusahaan : </label> 
                        <input name="txtAgency" id="txtAgency" type="text" disabled="disabled" value="<?php echo $all_data->agency; ?>" />
                        <br>
                        <label for="unit">Unit : </label> 
                        <input name="txtUnit" id="txtUnit" type="text" disabled="disabled" value="<?php echo $all_data->unit; ?>" />
                        <br>
                        <label for="client">Brand : </label> 
                        <input name="txtClient" id="txtClient" type="text" disabled="disabled" value="<?php echo $all_data->client; ?>" />
						<br />
                        <label for="budget">Budget : </label> 
                        <input name="txtBudget" id="txtBudget" type="text" disabled="disabled" value="<?php echo $all_data->budget; ?>" />
                        <br>
                        <label for="campaign">Campaign : </label> 
                        <input name="txtCampaign" id="txtCampaign" type="text" disabled="disabled" value="<?php echo $all_data->campaign; ?>" />
                        <br>
                  </div>
            </fieldset>
            <?php if (count($all_data_brandcomm) > 0): ?>
                  <fieldset id="brandcomm">
                        <legend>Brandcomm</legend>
                        <!-- <div style="float: left; width: 400px;">
                                <label for="nopaket">No Brandcomm : </label> 
                                <input name="txtNoBrandcomm" id="txtNoBrandcomm" type="text" disabled="disabled" value="<?php echo $all_data->no_brandcomm; ?>" />
                                <br> -->
                        <label for="nopaket">No Brandcomm : </label>
                        <input name='txtNoBrandcomm' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->no_brandcomm; ?>" />
                        <br>
                        <label for="nopaket">Start Date : </label>
                        <input name='txtStartDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->start_date; ?>" />
                        <br>
                        <label for="nopaket">End Date : </label>
                        <input name='txtEndDate' type='text' size='9' disabled="disabled" value="<?php echo $all_data_brandcomm->end_date; ?>" />
                        <!-- </div> -->
                        <table>
                              <thead>
                              <th width="40px">No</th>
                              <th>Item</th>
                              <th>Detail</th>
                              </thead>
                              <tbody>
                                    <?php foreach ($all_detail_brandcomm as $key => $detail_brandcomm): ?>
                                          <tr>
                                                <td align="center"><?php echo ($key + 1); ?></td>
                                                <td><?php echo $detail_brandcomm->item; ?></td>
                                                <td><?php echo $detail_brandcomm->detail; ?></td>
                                          </tr>
                                    <?php endforeach; ?>
                              </tbody>
                        </table>
                  </fieldset>
                  <fieldset id="personal">
                        <legend>Feedback Client</legend>
                        <label for="feedback">Status : </label>
                        <?php echo ($all_data_brandcomm->enable_feedback == "Y") ? "Enable" : "Disable"; ?>
                        <br>
                        <label for="feedback">Feedback : </label>
                        <textarea id="txtFeedback" disabled="disabled" style="height: 100px; width: 550px;" name="txtFeedback"><?php echo $all_data_brandcomm->feedback; ?></textarea>
                  </fieldset>
            <?php endif; ?>
            <fieldset id="paket">
                  <legend>Paket</legend>
                  <span class="error" id="errPaket"></span>
                  <table>
                        <thead>
                        <th>Iklan</th>
                        <th>Kanal</th>
                        <th>Produk Grup</th>
                        <th>Posisi</th>
                        <th>CPM Quota</th>
                        <th>Periode</th>
                        <th>Keterangan</th>
						<th>Harga / hari</th>
						<th>Harga Total</th>
                        </thead>
                        <tbody id="addme">
                              <?php foreach ($all_detail as $detail): ?>
                                    <tr class='remove'>
                                          <td align='center'>
                                                <?php echo $detail["ads"]; ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo $detail["kanal"]; ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo $detail["product_group"]; ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo $detail["position"]; ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo number_format($detail["cpm_quota"], 0, ",", "."); ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo format_date($detail["start_date"], TRUE); ?>
                                                -
                                                <?php echo format_date($detail["end_date"], TRUE); ?>
                                          </td>
                                          <td align='center'>
                                                <?php echo $detail["misc_info"]; ?>
                                          </td>
										<td align='center'>
											  <?php echo number_format($detail["harga"],0,",","."); ?>
										</td>
										<td align='center'>
											  <?php echo number_format($detail["total"] ,0,",",".");?>
										</td>
                                    </tr>
                              <?php endforeach; ?>
                        </tbody>
                  </table>
      <table class="noborder">
            <tr>
                  <td width="150px">Harga Paket Gross</td>
                  <td width="20px">:</td>
				  <td><?= "Rp. " . number_format($all_data->paket_gross,0,",",".");?></td>
            </tr>
            <tr>
                  <td>Diskon</td>
                  <td>:</td>
                  <td><?php echo $all_data->diskon . " %"; ?></td>
            </tr>
			<tr>
				  <td>Diskon (Nominal)</td>
				  <td>:</td>
				  <td><?= "Rp. " . number_format($all_data->diskon_nominal,0,",",".");?></td>
			</tr>
            <tr>
                  <td>Additional Diskon</td>
                  <td>:</td>
                  <td><?php echo $all_data->additional_diskon . " %"; ?></td>
            </tr>
			<tr>
				  <td>Additional Diskon (Nominal)</td>
				  <td>:</td>
				  <td><?= "Rp. " . number_format($all_data->additional_diskon_nominal,0,",",".");?></td>
			</tr>
            <tr>
                  <td>Total Harga Paket</td>
                  <td>:</td>
                  <td><?php echo "Rp. " . number_format($all_data->paket_total, 0, ",", ".");?></td>
            </tr>
      </table>				  
            </fieldset>
	  <?php if (count($all_production) > 0): ?>
			<fieldset id="production">
                  <legend>Production</legend>
				  <table>
						<thead>
									<th>Production</th>
									<th>Quantity</th>
									<th>Keterangan</th>
									<th>Harga</th>
									<th>Harga Total</th>
						</thead>
						<tbody>
							  <?php foreach ($all_production as $production): ?>
									<tr class='remove'>
										  <td align='center'>
												<?php echo $production["production"]; ?>
										  </td>
										  <td align='center'>
												<?php echo $production["quantity"]; ?>
										  </td>
										  <td align='center'>
												<?php echo $production["keterangan"]; ?>
										  </td>
										  <td align='center'>
												<?php echo number_format($production["harga"],0,",","."); ?>
										  </td>
										  <td align='center'>
												<?php echo number_format($production['harga_total'],0,",","."); ?>
										  </td>
									</tr>
									<?php endforeach; ?>
						</tbody>
				  </table>

				  <table class="noborder">
						<tr>
							  <td width="150px">Total Harga Produksi</td>
							  <td width="20px">:</td>
							  <td><?php echo "Rp. " . number_format($all_data->produksi_total, 0, ",", ".");?></td>
						</tr>
				  </table>
				  <br />
			</fieldset>
      <?php endif; ?>
	  <?php if (count($all_event) > 0): ?>
            <fieldset id="event">
                  <legend>Event</legend>
				<table>
						<thead>
							  <tr>
									<th>Event</th>
									<th>Periode</th>
									<th>Keterangan</th>
									<th>Harga</th>
							  </tr>
						</thead>
						<tbody>
							  <?php foreach ($all_event as $event): ?>
									<tr class='remove'>
										  <td align='center'>
												<?php echo $event["event"]; ?>
										  </td>
										  <td align='center'>
												<?php echo format_date($event["start_date"], TRUE); ?>
												-
												<?php echo format_date($event["end_date"], TRUE); ?>
										  </td>
										  <td align='center'>
												<?php echo $event["keterangan"]; ?>
										  </td>
										  <td align='center'>
												<?php echo number_format($event["biaya"],0,",","."); ?>
										  </td>
									</tr>
									<?php endforeach; ?>
						</tbody>
				  </table>

				  <table class="noborder">
						<tr>
							  <td width="150px">Total Harga Event</td>
							  <td width="20px">:</td>
							  <td><?php echo "Rp. " . number_format($all_data->event_total, 0, ",", ".");?></td>
						</tr>
				  </table>
			</fieldset>
      <?php endif; ?>
			<fieldset id="biaya">
				<legend>Biaya</legend>
				<label>Harga (sebelum pajak) :</label>
				<?php echo "Rp. " . number_format($all_data->paket_total + $all_data->produksi_total + $all_data->event_total , 0, ",", ".");?>
				<p>
				<label>Pajak :</label>
				<?php echo "Rp. " . number_format($all_data->pajak , 0, ",", ".");?>
				</p>
				<p>
				<label>Total :</label>
				<?php echo "Rp. " . number_format($all_data->total , 0, ",", ".");?>
				</p>
			</fieldset>
            <fieldset id="conflict">
                  <legend>Conflict Brand</legend>
                  <label for="conflictbrand">Conflict Brand : </label> 
                  <?php echo $all_data->is_restrict; ?>
                  <p>
                  <label for="industry">Industry : </label> 
                  <?php echo isset($name_cat_industry)?$name_cat_industry:'-'; ?>
				  </p>
                  <p>
                  <label for="industry">Sub Industry : </label> 
                  <?php echo $all_data->industry; ?>
				  </p>
            </fieldset>
            <div class="ajax-loader" style="display: none;">&nbsp;</div>
            <div align="center">
                  <input id="button1" type="button" value="Done" onclick="ajaxChange('done', 'update', '<?php echo site_url("done/update"); ?>', '<?php echo site_url("done/content"); ?>', '<?php echo site_url("done/insert_page"); ?>')" /> 
                  <input id="button2" type="button" value="Kembali" onclick="loadForm('<?php echo site_url("done/insert_page"); ?>')" />
            </div>
      </form>
<?php endif; ?>