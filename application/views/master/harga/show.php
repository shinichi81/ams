<?php if ($read == "Y"): ?>
<p>
	Kanal : <?php echo $all_data->kanal; ?>
</p>
<p>
	Rubrik : <?php echo $all_data->rubrik; ?>
</p>
<p>
	Product : <?php echo $all_data->product; ?>
</p>
<p>
	Posisi : <?php echo $all_data->position; ?>
</p>
<p>
	Harga : <?php echo "Rp. " . number_format($all_data->harga, 0, ",", "."); ?>
</p>
<?php endif; ?>