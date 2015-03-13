<?php if ($read == "Y"): ?>
<p>
	Nama : <?php echo $all_data->nama; ?>
</p>
<p>
	Harga : <?php echo "Rp. " . number_format($all_data->harga, 0, ",", "."); ?>
</p>
<?php endif; ?>