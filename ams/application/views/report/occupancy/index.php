<div id="box">
	<h3 id="adduser">Report Occupancy</h3>
	<div style="padding: 5px">
		Tipe:
		<select id="selectOrderBy">
			<option value="per_posisi">Per Posisi</option>
			<option value="per_kanal">Per Kanal</option>
			<option value="per_produk_grup">Per Produk Grup</option>
			<option value="per_industri">Per Industri</option>
			<option value="per_agency">Per Agency</option>
			<option value="per_client">Per Client</option>
		</select>
		Periode: 
		<select id="selectMonth">
			<?php 
			for ($i=1; $i<=12; $i++):
				$m = (strlen($i) == 1) ? "0".$i : $i;
			?>
			<option value="<?php echo $i; ?>"><?php echo ina_month($m); ?></option>
			<?php endfor; ?>
		</select>
		<select id="selectYear">
			<?php for ($i=2012; $i<=2030; $i++): ?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php endfor; ?>
		</select>
		<input type="button" name="btnSearch" id="btnSearch" value="Cari" />
	</div>
	<div id="data">
		<!-- load data disini -->
	</div>
</div>