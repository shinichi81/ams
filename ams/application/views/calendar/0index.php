<div id="box">
	<h3 id="adduser">Kalender</h3>
	<form id="form" method="post" action="<?php echo site_url("calendar/index"); ?>">
		<fieldset id="personal">
			<legend>Data</legend>
			<label for="kanal">Kanal : </label> 
			<select name="selectKanal" id="selectKanal" onchange="loadListOption2('<?php echo site_url("calendar/get_product_group") ?>', 'selectKanal', 'list_product_group')">
				<?php 
				foreach ($all_kanal as $kanal): 
					$selected = "";
					if ($kanal->id == $selected_kanal)
						$selected = "selected='selected'"; 
				?>
				<option value="<?php echo $kanal->id; ?>" <?php echo $selected; ?>><?php echo $kanal->name; ?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<label for="productgroup">Produk Grup : </label> 
			<select name="selectProductGroup" id="selectProductGroup" class="list_product_group">
				<?php 
				foreach ($all_product_group as $product_group):
					$selected = "";
					if ($product_group->id == $selected_product_group)
						$selected = "selected='selected'";  
				?>
				<option value="<?php echo $product_group->id; ?>" <?php echo $selected; ?>><?php echo $product_group->name; ?></option>
				<?php endforeach; ?>
			</select>
			
			<br>
			<label for="month">Bulan : </label> 
			<select name="selectMonth" id="selectMonth">
				<?php
				for ($n=1; $n<=12; $n++):
					$selected = "";
					if (strlen($n) == 1)
						$n = "0".$n; 
					if ($n == $selected_month)
						$selected = "selected='selected'";
				?>
				<option value="<?php echo $n; ?>" <?php echo $selected; ?>><?php echo ina_month($n); ?></option>
				<?php endfor; ?>
			</select>
			-
			<select name="selectYear" id="selectYear">
				<?php 
				for ($n=2012; $n<=date("Y")+20; $n++):
					$selected = "";
					if ($n == $selected_year)
						$selected = "selected='selected'";  
				?>
				<option value="<?php echo $n; ?>" <?php echo $selected; ?>><?php echo $n; ?></option>
				<?php endfor; ?>
			</select>
		</fieldset>
		<div align="center">
			<input id="button1" type="submit" name="btnSubmit" value="Lihat Kalender" />
		</div>
		<br>
		<fieldset id="timeline">
			<legend>Posisi</legend>
			<table class="noborder" style="width: 400px; float: left;">
			<?php
			//foreach($all_position as $position):
			for ($n=0; $n<count($all_position); $n+=2):
				echo "<tr>";
				echo "<td>";
				echo "<a href='javascript:void(0);' onclick='loadShow(\"".site_url("calendar/detail/".$selected_kanal."/".$selected_product_group."/".$all_position[$n]->id."/".$selected_month."/".$selected_year)."\")'>
					  	<img style='vertical-align: middle;' src='".image_path("icons/detail.gif")."' title='Detail' width='16' height='16' />
					  <a>&nbsp;";
				echo $all_position[$n]->name ." : ";
				echo "</td>";
				echo "</tr>"; 
			?>
			<tr>
			<td>
			<iframe src="<?php echo site_url("calendar/show_calendar/".$selected_kanal."/".$selected_product_group."/".$all_position[$n]->id."/".$selected_month."/".$selected_year); ?>" width="400px;" height="230px;" allowtransparency="yes" frameborder="0" scrolling="no" ></iframe>
			</td>
			</tr>
			<?php 
			endfor; 
			?>
			</table>
			
			<table class="noborder" style="width: 400px; float: left;">
			<?php
			//foreach($all_position as $position):
			for ($n=1; $n<count($all_position); $n+=2):
				echo "<tr>";
				echo "<td>";
				echo "<a href='javascript:void(0);' onclick='loadShow(\"".site_url("calendar/detail/".$selected_kanal."/".$selected_product_group."/".$all_position[$n]->id."/".$selected_month."/".$selected_year)."\")'>
					  	<img style='vertical-align: middle;' src='".image_path("icons/detail.gif")."' title='Detail' width='16' height='16' />
					  <a>&nbsp;";
				echo $all_position[$n]->name ." : ";
				echo "</td>";
				echo "</tr>"; 
			?>
			<tr>
			<td>
			<iframe src="<?php echo site_url("calendar/show_calendar/".$selected_kanal."/".$selected_product_group."/".$all_position[$n]->id."/".$selected_month."/".$selected_year); ?>" width="400px;" height="230px;" allowtransparency="yes" frameborder="0" scrolling="no" ></iframe>
			</td>
			</tr>
			<?php 
			endfor; 
			?>
			</table>
		</fieldset>
	</form>
</div>