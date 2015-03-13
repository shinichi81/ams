<?php if ($read == "Y"): ?>
<div id="box">
	<h3 id="adduser">TIMELINE</h3>
	<form id="form" method="post" action="<?php echo site_url("timeline/index"); ?>">
		<fieldset id="personal">
			<legend>Data</legend>
			<label for="kanal">Kanal : </label> 
			<select name="selectKanal" id="selectKanal" onchange="loadListOption2('<?php echo site_url("timeline/get_product_group") ?>', 'selectKanal', 'list_product_group')">
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
		</fieldset>
		<div align="center">
			<input id="button1" type="submit" name="btnSubmit" value="Lihat Timeline" />
		</div>
		<br>
		<fieldset id="timeline">
			<legend>Posisi</legend>
			<?php 
			foreach($all_position as $position):
				echo $position->name ." : "; 
			?>
			<iframe src="<?php echo site_url("timeline/show_timeline/".$selected_kanal."/".$selected_product_group."/".$position->id); ?>" width="900px;" height="190px;" allowtransparency="yes" frameborder="0" scrolling="no" ></iframe>
			<?php 
			endforeach; 
			?>
		</fieldset>
	</form>
</div>
<?php endif; ?>