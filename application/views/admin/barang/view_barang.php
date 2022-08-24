<div class="">
<table class="table table-bordered">
	<thead class="bg-green">
		<tr>
			<td>No</td>
			<td>Nama Barang</td>
			<td>Harga / Satuan</td>
			<td>#</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=0;
		foreach ($barang as $b) {
			$no++;
			?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $b->barang_nama ?></td>
				<td><?php 
				if($tipe=="Grosir") echo $b->barang_harga_grosir ."/" .$b->barang_satuan_besar; 
				else echo $b->barang_harga_jual ."/" .$b->barang_satuan_kecil;  ?></td>
				<td><a href="#" class="btn btn-success btn-xs btn-block" onclick="detail('<?php echo $b->barang_id; ?>')">Pilih</a></td>
			</tr>
			<?php
		}
		?>
		
	</tbody>
</table>
</div>
