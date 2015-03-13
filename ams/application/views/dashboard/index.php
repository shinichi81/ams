<div id="box">
	<h3 id="adduser">
		DASHBOARD
		<div class="right"><?php echo ina_month(date("m")) ." ". date("Y"); ?></div>
	</h3>
	<table width="100%" style="width: 220px; float: left;">
		<thead>
			<tr>
	            <th colspan="3"><a href="#">Total Order</a></th>
	        </tr>
			<tr>
				<th width="40px"><a href="#">No</a></th>
	        	<th><a href="#">Jenis</a></th>
	            <th><a href="#">Total</a></th>
	        </tr>
		</thead>
		<tbody>
			<tr>
	        	<td class="a-center">1</td>
	        	<td>Order Paket</td>
	            <td align="center"><?php echo $total_booking_paket; ?></td>
	        </tr>
	        <tr>
	        	<td class="a-center">2</td>
	        	<td>Booking Space</td>
	            <td align="center"><?php echo $total_booking_space; ?></td>
	        </tr> 
	        <tr>
	        	<td class="a-center">3</td>
	        	<td>Paket Deal</td>
	            <td align="center"><?php echo $total_paket_closing; ?></td>
	        </tr>
	        <tr>
	        	<td class="a-center">4</td>
	        	<td>Space ke Paket</td>
	            <td align="center"><?php echo $total_space_to_paket; ?></td>
	        </tr>
	        <tr>
	        	<td class="a-center">5</td>
	        	<td>Order Expired</td>
	            <td align="center"><?php echo $total_order_expired; ?></td>
	        </tr>
		</tbody>
	</table>
	<table width="100%" style="width: 340px; float: left;">
		<thead>
			<tr>
	            <th colspan="5"><a href="#">Booking Yang Request Tayang</a></th>
	        </tr>
			<tr>
				<th width="40px"><a href="#">No</a></th>
	        	<th><a href="#">Tanggal Order Tayang</a></th>
	        	<th><a href="#">No Paket</a></th>
	            <th><a href="#">&nbsp;</a></th>
	        </tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach($all_order_approve as $data): 
			?>
			<tr class="a-center">
	        	<td><?php echo $no; ?></td>
	        	<td><?php echo format_date($data->request_date, TRUE); ?></td>
	            <td><?php echo $data->no_paket; ?></td>
	            <td>
	            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("request/show_page"); ?>', '<?php echo $data->id; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
	            </td>
	        </tr>
	        <?php
	        	$no += 1;
	        endforeach; 
	        ?>
		</tbody>
	</table>
	<table width="100%" style="width: 340px; float: left;">
		<thead>
			<tr>
	            <th colspan="5"><a href="#">Laporan Occupancy</a></th>
	        </tr>
			<tr>
				<th width="40px"><a href="#">No</a></th>
	        	<th><a href="#">Kanal</a></th>
	        	<th><a href="#">Produk Grup</a></th>
	        	<th><a href="#">Posisi</a></th>
	            <th><a href="#">Occupancy</a></th>
	        </tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach($all_occupancy as $data):
			?>
			<tr class="a-center">
	        	<td><?php echo $no; ?></td>
	        	<td><?php echo $data["kanal"]; ?></td>
	            <td><?php echo $data["product_group"]; ?></td>
	            <td><?php echo $data["position"]; ?></td>
	            <td><?php echo $data["occupancy"]; ?>%</td>
	        </tr>
	        <?php
	        	if ($no == 5) break;
	        	$no += 1;
	        endforeach; 
	        ?>
		</tbody>
	</table>
	<div style="clear: both;"></div>
	<br>
	<table width="100%">
		<thead>
			<tr>
	            <th colspan="8"><a href="#">Booking Yang Akan Expired</a></th>
	        </tr>
			<tr>
				<th width="40px"><a href="#">No</a></th>
	        	<th><a href="#">Tanggal Request</a></th>
	        	<th><a href="#">No Paket</a></th>
	        	<th><a href="#">Agency</a></th>
	        	<th><a href="#">Client</a></th>
	        	<th><a href="#">Progress</a></th>
	        	<th><a href="#">Sisa Hari</a></th>
	            <th><a href="#">&nbsp;</a></th>
	        </tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach($arr_will_expired as $data): 
			?>
			<tr class="a-center">
	        	<td><?php echo $no; ?></td>
	        	<td><?php echo format_date($data["request_date"], TRUE); ?></td>
	            <td><?php echo $data["nomor"]; ?></td>
	            <td><?php echo $data["agency"]; ?></td>
	            <td><?php echo $data["client"]; ?></td>
	            <td><?php echo $data["progress"]; ?>%</td>
	            <td><?php echo $data["selisih"]; ?></td>
	            <td>
	            	<a href="javascript:void(0);" onclick="loadShowExpired('<?php echo site_url("dashboard/show_expired_page"); ?>', '<?php echo $data["nomor"]; ?>', '<?php echo $data["from"]; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
	            </td>
	        </tr>
	        <?php
	        	if ($no == 5) break;
	        	$no += 1;
	        endforeach; 
	        ?>
		</tbody>
	</table>
	<br>
	<table width="100%">
		<thead>
			<tr>
	            <th colspan="7"><a href="#">Order Paket Terbaru</a></th>
	        </tr>
			<tr>
				<th width="40px"><a href="#">No</a></th>
	        	<th><a href="#">Tanggal Request</a></th>
	        	<th><a href="#">No Paket</a></th>
	        	<th><a href="#">Agency</a></th>
	        	<th><a href="#">Client</a></th>
	        	<th><a href="#">Status</a></th>
	            <th><a href="#">&nbsp;</a></th>
	        </tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			foreach($all_latest as $data): 
			?>
			<tr class="a-center">
	        	<td><?php echo $no; ?></td>
	        	<td><?php echo format_date($data->request_date, TRUE); ?></td>
	            <td><?php echo $data->no_paket; ?></td>
	            <td><?php echo $data->agency; ?></td>
	            <td><?php echo $data->client; ?></td>
	            <td><?php echo ($data->approve == "Y") ? "Deal" : "Booking"; ?></td>
	            <td>
	            	<a href="javascript:void(0);" onclick="loadShow('<?php echo site_url("order/show_page"); ?>', '<?php echo $data->no_paket; ?>')"><img src="<?php echo image_path("icons/user.png"); ?>" title="Show" width="16" height="16" /></a>
	            </td>
	        </tr>
	        <?php
	        	$no += 1;
	        endforeach; 
	        ?>
		</tbody>
	</table>
	<br>
	<div id="chart_paket" style="width: 920px; height: 400px; margin-left: 10px;"></div>
	<br><br>
	<div id="chart_space" style="width: 920px; height: 400px; margin-left: 10px;"></div>
</div>

<script type="text/javascript">
		
	var chart;
	$(document).ready(function() {
		// untuk chart paket
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart_paket',
				defaultSeriesType: 'line',
				marginRight: 130,
				marginBottom: 25
			},
			title: {
				text: 'Grafik Total Order Paket',
				x: -20 //center
			},
			subtitle: {
				text: '(Tahun <?php echo date("Y"); ?>)',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah Order'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				formatter: function() {
					return '<b>'+ this.series.name +'</b>: '+ this.y;
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 100,
				borderWidth: 0
			},
			series: [{
				name: 'Order',
				data: [
					<?php 
					foreach ($arr_order_paket as $order)
						echo $order .", ";
					?>
				]
			}, {
				name: 'Deal',
				data: [
					<?php 
					foreach ($arr_paket_closing as $closing)
						echo $closing .", ";
					?>
				]
			}],
			credits:{
				enabled:false
			}
		});
		
		// untuk chart space
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart_space',
				defaultSeriesType: 'line',
				marginRight: 130,
				marginBottom: 25
			},
			title: {
				text: 'Grafik Total Booking Space',
				x: -20 //center
			},
			subtitle: {
				text: '(Tahun <?php echo date("Y"); ?>)',
				x: -20
			},
			xAxis: {
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
			},
			yAxis: {
				title: {
					text: 'Jumlah Booking'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},
			tooltip: {
				formatter: function() {
					return '<b>'+ this.series.name +'</b>: '+ this.y;
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'top',
				x: -10,
				y: 100,
				borderWidth: 0
			},
			series: [{
				name: 'Booking',
				data: [
					<?php 
					foreach ($arr_booking_space as $booking)
						echo $booking .", ";
					?>
				]
			}, {
				name: 'Space ke Paket',
				data: [
					<?php 
					foreach ($arr_space_to_paket as $spaceToPaket)
						echo $spaceToPaket .", ";
					?>
				]
			}],
			credits:{
				enabled:false
			}
		});
	});
	
	function loadShowExpired(url, id, type) {
		// untuk show loading icon dan dialog box
		$("#show").html("<p><div align='center'><div class='loading'>&nbsp;</div>loading..</div></p>");
		$("#show").dialog({
			modal: true,
			width: "auto",
			buttons: {
				Tutup: function() {
					$(this).dialog("close");
				}
			}
		});
		
		$.post(url, {"id" : id, "type" : type},
			function(data) {
				$("#show").html(data);
				$("#show").dialog({
					modal: true,
					width: "auto",
					position: ['center', 'center'],
					buttons: {
						<?php if ($progress == "Y"): ?>
						Simpan: function() {
							if (type == "paket") {
								var progressUrl = "<?php echo site_url("order/progress"); ?>";
								var hdNoPaket = $("#hdNoPaket").val();
								var txtPercent = $("#percent").text();
								var arrParam = new Array(hdNoPaket, txtPercent);
							} else {
								var progressUrl = "<?php echo site_url("order_space/progress"); ?>";
								var hdNoSpace = $("#hdNoSpace").val();
								var txtPercent = $("#percent").text();
								var arrParam = new Array(hdNoSpace, txtPercent);
							}							
							
							$.post(progressUrl, {"arrParam" : arrParam},
								function(data) {
									if (data.status) {
										document.location.href = "<?php echo site_url("dashboard"); ?>";
									}
								}
							, "json");
						},
						<?php endif; ?>
						Tutup: function() {
							$(this).dialog("close");
						}
					}
				});
			}
		);
		/*$(".direk_isi").ajaxError(function(e, xhr, settings, exception) {
			//$(this).text( "Error requesting page " + xhr.status );
			$(this).text( "Error requesting page. Try again ");
		});*/
		return false;
	}
		
</script>