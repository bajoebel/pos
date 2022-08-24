<table class="table table-bordered" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th style='width:100px;'>#</th>
            <tr>
        </thead>
        <tbody>
        	<?php 
        	$no=0;
        	$grantot=0;
        	$diskon=0;
        	foreach ($tmp as $t) {
        		$no++;
        		$grantot+=($t->tmp_jumlah * $t->tmp_hargasatuan);
        		$diskon+=$t->tmp_diskon;
        		?>
        		<input type="hidden" name="tmp_barangid[]" value="<?php echo $t->tmp_barangid ?>">
        		<input type="hidden" name="tmp_jumlah[]" value="<?php echo $t->tmp_jumlah ?>">
        		<input type="hidden" name="tmp_harga[]" value="<?php echo $t->tmp_hargasatuan ?>">
				<input type="hidden" name="tmp_hpppcs[]" value="<?php echo $t->tmp_hpppcs ?>">
				<input type="hidden" name="tmp_konversisatuan[]" value="<?php echo $t->tmp_konversisatuan ?>">
        		<input type="hidden" name="tmp_diskon[]" value="<?php echo $t->tmp_diskon ?>">
				<input type="hidden" name="tmp_satuan[]" value="<?php echo $t->tmp_satuan ?>">
				<input type="hidden" name="tmp_jmlsatuan[]" value="<?php echo $t->tmp_jumlah * $t->tmp_konversisatuan ?>">
        		<tr>
        			<td><?php echo $no; ?></td>
        			<td><?php echo $t->barang_nama ?></td>
        			<td class="text-right">Rp. <?php echo $t->tmp_hargasatuan ?></td>
        			<td><?php echo $t->tmp_jumlah ?></td>
        			<td class="text-right">Rp. <?php echo $t->tmp_jumlah * $t->tmp_hargasatuan; ?></td>
        			<td class="text-right">Rp. <?php echo $t->tmp_diskon ?></td>
        			<td class="text-right">
        				 <div class="btn-group">
						  <button type="button" class="btn btn-danger btn-xs" onclick="deleteTemp('<?= $t->tmp_id?>')"><span class="fa fa-remove"></span></button>
						</div> 
        			</td>
        		</tr>
        		<?PHP
        	}
        	?>
        	<tfoot class="bg-green">
        		<?php 
        		$tagihan=$grantot-$diskon;
        		?>
        		<input type="hidden" name="tagihan" value="<?php echo $tagihan; ?>">
        		<tr>
	        		<td colspan="4">Grantotal</td>
	        		<td class="text-right" colspan="3">Rp. <?php echo $grantot; ?></td>
	        	</tr>
	        	<tr>
	        		<td colspan="4">Diskon</td>
	        		<td class="text-right" colspan="3">Rp. <?php echo $diskon; ?></td>
	        	</tr>
	        	<tr>
	        		<td colspan="4">Tagihan</td>
	        		<td class="text-right" colspan="3">Rp. <?php echo $grantot-$diskon; ?></td>
	        	</tr>
        	</tfoot>
        	
        </tbody>
        
    </table>