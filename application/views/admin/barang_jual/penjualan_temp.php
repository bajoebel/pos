<table class="table table-bordered" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th>
                <th>Nama Barang</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Jumlah</th>
				<th class="text-right">Diskon</th>
                <th class="text-right">Sub Total</th>
                <th style='width:50px;'>#</th>
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
        		<input type="hidden" name="tmp_diskon[]" value="<?php echo $t->tmp_diskon ?>">
				<input type="hidden" name="tmp_tipeharga[]" value="<?php echo $t->tmp_tipeharga ?>">
				<input type="hidden" name="tmp_jmlsatuan[]" value="<?php echo $t->tmp_jumlah * $t->tmp_konversisatuan ?>">
				<input type="hidden" name="tmp_konversisatuan[]" value="<?php echo $t->tmp_konversisatuan ?>">
				<input type="hidden" name="tmp_satuan[]" value="<?php echo $t->tmp_satuan ?>">
        		<tr>
        			<td><?php echo $no; ?></td>
        			<td><?php echo $t->barang_nama ?></td>
        			<td class="text-right">Rp. <?php echo $t->tmp_hargasatuan ?></td>
        			<td class="text-right"><?php echo $t->tmp_jumlah ." " .$t->satuan ?></td>
					<td class="text-right">Rp. <?php echo $t->tmp_diskon ?></td>
        			<td class="text-right">Rp. <?php echo ($t->tmp_jumlah * $t->tmp_hargasatuan) -$t->tmp_diskon; ?></td>
        			<td class="text-right">
        				 <div class="btn-group">
						  <button type="button" class="btn btn-danger btn-xs" onclick="deleteTemp('<?= $t->tmp_id; ?>')"><span class="fa fa-remove"></span></button>
						</div> 
        			</td>
        		</tr>
        		<?PHP
        	}
        	?>
        	<tfoot class="">
        		<?php 
        		$tagihan=$grantot-$diskon;
        		?>
        		<input type="hidden" name="tagihan" value="<?php echo $tagihan; ?>">
        		<tr>
	        		<td colspan="7"><b>Grantotal <div class='pull-right'>Rp. <?php echo $grantot; ?></div></b></td>
	        	</tr>
	        	<tr>
	        		<td colspan="7"><b>Diskon <div class='pull-right'>Rp. <?php echo $diskon; ?></div></b></td>
	        	</tr>
	        	<tr>
	        		<!--td colspan="6">Tagihan</td-->
	        		<td class="" colspan="7"><b>Tagihan <div class='pull-right'>Rp. <?php echo $grantot-$diskon; ?></div></b></td>
	        	</tr>
        	</tfoot>
        	
        </tbody>
        
    </table>