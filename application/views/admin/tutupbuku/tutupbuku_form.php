<?php 
  function longdate($date){
        $tgl=explode(' ', $date);
        $d=explode('-', $tgl[0]);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
  ?>
<form method="POST" action="<?php echo base_url() ."tutupbuku/save" ?>">
	<div class="col-md-6">
		<?php if(!empty($pengaturan)){ ?>
		<input type="hidden" name="akun_perkiraan" value="<?php echo $pengaturan->perkiraan_akun_id; ?>">
		<input type="hidden" name="akun_jual" value="<?php echo $pengaturan->penjualan_akun_id; ?>">
		<input type="hidden" name="akun_beli" value="<?php echo $pengaturan->pembelian_akun_id; ?>">
		<input type="hidden" name="akun_return" value="<?php echo $pengaturan->return_akun_id; ?>">
        <input type="hidden" name="akun_piutang" value="<?php echo $pengaturan->piutang_akun_id; ?>">
        <input type="hidden" name="akun_hutang" value="<?php echo $pengaturan->hutang_akun_id; ?>">
        <input type="hidden" name="akun_penerimaan_piutang" value="<?php echo $pengaturan->penerimaan_piutang; ?>">
        <input type="hidden" name="akun_pembayaran_hutang" value="<?php echo $pengaturan->pembayaran_hutang; ?>">
		<?php } ?>
		<table class="table table-bordered">
			<tr class="bg-green">
				<th colspan="2">Pembelian<span class="fa fa-cog pull-right" onclick="add()"></span></th>
			</tr>
			<tr>
				<th>Tanggal</th>
				<th style="text-align: right;">Jumlah</th>
			</tr>
			<?php 
			$totb=0;
			foreach($pembelian as $pembelian){ 
				$totb+= $pembelian->totalharga;
				?>
			<tr>
				<th><?php if(!empty($pembelian->masuk_tanggal)) echo longdate($pembelian->masuk_tanggal); ?></th>
				<th style="text-align: right;">
					<b>Rp. <?php if(!empty($pembelian->totalharga)) echo $pembelian->totalharga; ?></b>
					<input type="hidden" name="pembelian[]" value="<?php if(!empty($pembelian->totalharga)) echo $pembelian->totalharga; ?>">
					<input type="hidden" name="masuk_tanggal[]" value="<?php if(!empty($pembelian->masuk_tanggal)) echo $pembelian->masuk_tanggal; ?>">
				</th>
			</tr>
			<?php } ?>

			<tr style="background-color: #dee6de;">
				<th>Total Pembelian</th>
				<th style="text-align: right;">Rp. <?php echo $totb; ?></th>
			</tr>

			<tr class="bg-green">
				<th colspan="2">Return</th>
			</tr>
			<tr>
				<th>Tanggal</th>
				<th style="text-align: right;">Jumlah</th>
			</tr>
			<?php 
			$totr=0;
			foreach($return_b as $return_b){ 
				$totr+= $return_b->totalharga;
				?>
			<tr>
				<th><?php if(!empty($return_b->return_tanggal)) echo longdate($return_b->return_tanggal); ?></th>
				<th style="text-align: right;">
					<b>Rp. <?php if(!empty($return_b->totalharga)) echo $return_b->totalharga; ?></b>
					<input type="hidden" name="return_b[]" value="<?php if(!empty($return_b->totalharga)) echo $return_b->totalharga; ?>">
					<input type="hidden" name="return_tanggal[]" value="<?php if(!empty($return_b->return_tanggal)) echo $return_b->return_tanggal; ?>">
				</th>
			</tr>
			<?php } ?>

			<tr style="background-color: #dee6de;">
				<th>Total Return</th>
				<th style="text-align: right;">Rp. <?php echo $totr; ?></th>
			</tr>

			<tr class="bg-green">
				<th colspan="2">Penjualan</th>
			</tr>
			<tr>
				<th>Tanggal</th>
				<th style="text-align: right;">Jumlah</th>
			</tr>
			<?php 
			$totp=0;
			foreach($penjualan as $penjualan){ 
				$totp+= $penjualan->totalharga;
				?>
			<tr>
				<th><?php if(!empty($penjualan->jual_tanggal)) echo longdate($penjualan->jual_tanggal); ?></th>
				<th style="text-align: right;">
					Rp. <?php if(!empty($penjualan->totalharga)) echo $penjualan->totalharga; ?></b>
					<input type="hidden" name="penjualan[]" value="<?php if(!empty($penjualan->totalharga)) echo $penjualan->totalharga; ?>">
					<input type="hidden" name="jual_tanggal[]" value="<?php if(!empty($penjualan->jual_tanggal)) echo $penjualan->jual_tanggal; ?>">
						
				</th>
			</tr>
			<?php } ?>
			<tr style="background-color: #dee6de;">
				<th>Total Penjualan</th>
				<th style="text-align: right;">Rp. <?php echo $totp; ?></th>
			</tr>
			
            <tr class="bg-green">
                <th colspan="2">Hutang</th>
            </tr>
            <?php 
            $toth=0;
            foreach($hutang as $h){ 
                $toth+= $h->totalhutang;
                ?>
            <tr>
                <th><?php if(!empty($h->hutang_tgl)) echo longdate($h->hutang_tgl); ?></th>
                <th style="text-align: right;">
                    Rp. <?php if(!empty($h->totalhutang)) echo $h->totalhutang; ?></b>
                    <input type="hidden" name="totalhutang[]" value="<?php if(!empty($h->totalhutang)) echo $h->totalhutang; ?>">
                    <input type="hidden" name="hutang_tgl[]" value="<?php if(!empty($h->hutang_tgl)) echo $h->hutang_tgl; ?>">
                        
                </th>
            </tr>
            <?php } ?>
            <tr style="background-color: #dee6de;">
                <th>Total Hutang</th>
                <th style="text-align: right;">
                    <b>Rp. <?php echo $toth; ?></b>
                    <input type="hidden" name="total_hutang" value="<?php echo $toth; ?>">
                </th>
            </tr>
            <tr class="bg-green">
                <th colspan="2">Pembayaran Hutang</th>
            </tr>
            <?php 
            $toth=0;
            foreach($pembayaran_hutang as $h){ 
                $toth+= $h->totalbayar;
                ?>
            <tr>
                <th><?php if(!empty($h->bayar_tgl)) echo longdate($h->bayar_tgl); ?></th>
                <th style="text-align: right;">
                    Rp. <?php if(!empty($h->totalbayar)) echo $h->totalbayar; ?></b>
                    <input type="hidden" name="totalbayar[]" value="<?php if(!empty($h->totalbayar)) echo $h->totalbayar; ?>">
                    <input type="hidden" name="bayar_tgl[]" value="<?php if(!empty($h->bayar_tgl)) echo $h->bayar_tgl; ?>">
                </th>
            </tr>
            <?php } ?>
            <tr style="background-color: #dee6de;">
                <th>Pembayaran Hutang</th>
                <th style="text-align: right;">
                    <b>Rp. <?php echo $toth; ?></b>
                    <input type="hidden" name="total_pembayaran" value="<?php echo $toth; ?>">
                </th>
            </tr>
            <tr class="bg-green">
                <th colspan="2">Piutang</th>
            </tr>
            <?php 
            $toth=0;
            foreach($piutang as $h){ 
                $toth+= $h->totalpiutang;
                ?>
            <tr>
                <th><?php if(!empty($h->piutang_tgl)) echo longdate($h->piutang_tgl); ?></th>
                <th style="text-align: right;">
                    Rp. <?php if(!empty($h->totalpiutang)) echo $h->totalpiutang; ?></b>
                    <input type="hidden" name="totalpiutang[]" value="<?php if(!empty($h->totalpiutang)) echo $h->totalpiutang; ?>">
                    <input type="hidden" name="piutang_tgl[]" value="<?php if(!empty($h->piutang_tgl)) echo $h->piutang_tgl; ?>">
                </th>
            </tr>
            <?php } ?>

            <tr style="background-color: #dee6de;">
                <th>Total Piutang</th>
                <th style="text-align: right;">
                    <b>Rp. <?php echo $toth ?></b>
                    <input type="hidden" name="total_piutang" value="<?php echo $toth; ?>">
                    
                </th>
            </tr>
            

            <tr class="bg-green">
                <th colspan="2">Penerimaan Piutang</th>
            </tr>
            <?php 
            $toth=0;
            foreach($penerimaan_piutang as $h){ 
                $toth+= $h->totalterima;
                ?>
            <tr>
                <th><?php if(!empty($h->terima_tgl)) echo longdate($h->terima_tgl); ?></th>
                <th style="text-align: right;">
                    Rp. <?php if(!empty($h->totalterima)) echo $h->totalterima; ?></b>
                    <input type="hidden" name="totalterima[]" value="<?php if(!empty($h->totalterima)) echo $h->totalterima; ?>">
                    <input type="hidden" name="terima_tgl[]" value="<?php if(!empty($h->terima_tgl)) echo $h->terima_tgl; ?>">
                </th>
            </tr>
            <?php } ?>
            <tr style="background-color: #dee6de;">
                <th>Penerimaan Piutang</th>
                <th style="text-align: right;">
                    <b>Rp. <?php echo $toth; ?></b>
                    <input type="hidden" name="total_penerimaan" value="<?php echo $toth; ?>">
                    
                </th>
            </tr>
            <tr class="bg-green">
                <th colspan="2">Perkiraan</th>
            </tr>
            <tr style="background-color: #dee6de;">
                <th>Perkiraan Aset</th>
                <th style="text-align: right;">
                    <b>Rp. <?php if(!empty($perkiraan_aset)) echo $perkiraan_aset->perkiraan_aset; ?></b>
                    <input type="hidden" name="perkiraan_aset" value="<?php if(!empty($perkiraan_aset)) echo $perkiraan_aset->perkiraan_aset; ?>">
                    
                </th>
            </tr>
		</table>
		<input type="submit" name="tutupbuku" value="Tutup Buku" class="btn btn-success btn-block">
	</div>
</form>
<script type="text/javascript">
	function add(){
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Pengaturan'); // Set Title to Bootstrap modal title
    }

    function save(){
          var url;
          url = "<?php echo site_url('tutupbuku/save_setting')?>";

           // ajax adding data to database
              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: function(data)
                {
                   //if success close modal and reload ajax table
                   $('#modal_form').modal('hide');
                  location.reload();// for reload a page
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(url);
                }
            });
        }
</script>
<!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Pengaturan</h3>
                </div>

                <div class="modal-body form">
                    <form action="#" method="post" id="form" class="form-horizontal"> 
                        <input type="hidden" class="form-control" name="tutupbuku_id" id="tutupbuku_id"  value="<?php if(!empty($pengaturan)) echo $pengaturan->tutupbuku_id; ?>" />
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Penjualan</label>
                            </div>
                            <div class="col-md-9">
                            	<select name="penjualan_akun_id" class="form-control ">
                            		<?php 
                            		foreach ($akun as $a) {
                            			?>
                            			<option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->penjualan_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                            			<?php
                            		}
                            		?>
                            	</select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Pembelian</label>
                            </div>
                            <div class="col-md-9">
                            	<select name="pembelian_akun_id" class="form-control ">
                            		<?php 
                            		foreach ($akun as $a) {
                            			?>
                            			<option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->pembelian_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                            			<?php
                            		}
                            		?>
                            	</select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Return</label>
                            </div>
                            <div class="col-md-9">
                            	<select name="return_akun_id" class="form-control ">
                            		<?php 
                            		foreach ($akun as $a) {
                            			?>
                            			<option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->return_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                            			<?php
                            		}
                            		?>
                            	</select>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Perkiraan</label>
                            </div>
                            <div class="col-md-9">
                            	<select name="perkiraan_akun_id" class="form-control ">
                            		<?php 
                            		foreach ($akun as $a) {
                            			?>
                            			<option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->perkiraan_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                            			<?php
                            		}
                            		?>
                            	</select>
                                
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Piutang</label>
                            </div>
                            <div class="col-md-9">
                                <select name="piutang_akun_id" class="form-control ">
                                    <?php 
                                    foreach ($akun as $a) {
                                        ?>
                                        <option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->piutang_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun Hutang</label>
                            </div>
                            <div class="col-md-9">
                                <select name="hutang_akun_id" class="form-control ">
                                    <?php 
                                    foreach ($akun as $a) {
                                        ?>
                                        <option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->hutang_akun_id) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Penerimaan Piutang</label>
                            </div>
                            <div class="col-md-9">
                                <select name="penerimaan_piutang" class="form-control ">
                                    <?php 
                                    foreach ($akun as $a) {
                                        ?>
                                        <option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->penerimaan_piutang) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Pembayaran Hutang</label>
                            </div>
                            <div class="col-md-9">
                                <select name="pembayaran_hutang" class="form-control ">
                                    <?php 
                                    foreach ($akun as $a) {
                                        ?>
                                        <option value="<?php echo $a->akun_id ?>" <?php if($a->akun_id==$pengaturan->pembayaran_hutang) echo "selected"; ?>><?php echo $a->akun_nama ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="kategori_userinput" id="kategori_userinput" placeholder="Kategori Userinput" value="" />
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
