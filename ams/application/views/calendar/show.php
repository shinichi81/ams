<html>
  <head>
    <title>Kalender</title>
	<?php
	echo css("style.css"); 
	echo css("jquery-ui/jquery.ui.all.css"); 
	?>
	</head>
  	<body>  		
		<div class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;">
			<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all">
			<div class="ui-datepicker-title">
			<span class="ui-datepicker-month"><?php echo ina_month($month); ?></span>
			<span class="ui-datepicker-year"><?php echo $year; ?></span>
			</div>
			</div>
			<table class="ui-datepicker-calendar">
				<thead>
					<th>Su</th>
					<th>Mo</th>
					<th>Tu</th>
					<th>We</th>
					<th>Th</th>
					<th>Fr</th>
					<th>Sa</th>
				</thead>
				<tbody>
					<?php
					$end = (isset($arr_date[5][0])) ? 6 : 5;
										
					for ($row=0; $row<$end; $row++) {
						echo "<tr>";
						for ($col=0; $col<7; $col++) {
							$date = (isset($arr_date[$row][$col])) ? $arr_date[$row][$col] : "&nbsp;";
							
							$bgcolor = "#E8F4FD"; // blue
							if (in_array($date, $arr_closing))
								$bgcolor = "#FFDE00"; // orange
							else if (in_array($date, $arr_booking))
								$bgcolor = "#12FF00"; // green
							
							echo "<td><a class='ui-state-default' style='background-image: none;background-color: ".$bgcolor."' href='#'>".$date."</a></td>";
						}
						echo "</tr>";
					} 
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>