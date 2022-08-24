<?php 
if(!empty($barang)){ ?>
	<div class="row">
		<div class="col-md-12" style="padding-bottom: 5px;">
			<div class="panel panel-success ">
				<div class="panel-heading bg-green">Tambah Barang 
					<div class="pull-right box-tools">
                		<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" onclick='closeForm()' >
                  		<i class="fa fa-times"></i></button>
              		</div>
				</div>
				<div class="panel-body">
				<input name="id" value="<?php echo $barang->barang_id ?>" type="hidden">
				<?php //print_r($barang) ?>
						<input name="nama" value="<?php echo $barang->barang_nama; ?>" type="hidden">
						<input name="tipe" value="<?php echo $tipe; ?>" type="hidden">
						<input name="satuan" id="satuan" value="" type="hidden">
						<div class="row form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Nama Barang:</label>
								<div class="col-sm-5">
								<label for="" class='form-control pull-left' style="text-aligh:'left'"><?php echo $barang->barang_nama; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">HPP / <?= $barang->barang_satuan_kecil ?>:</label>
								<div class="col-sm-5">
								<input name="hpp" id="hpp" value="<?php echo $barang->harga_modal; ?>" class="form-control input-sm" type="text" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Jenis Harga :</label>
								<div class="col-sm-5">
								<?php 
									$jenis_harga=$this->Barang_jual_model->getJenisHarga($barang->barang_id);
									if(empty($jenis_harga)) echo "<label>Jenis Harga Belum Diinput</label>";
									else{
										foreach ($jenis_harga as $jh ) {
											?>
											<input type="radio" name="jenisharga" id="jenisharga<?= $jh->idx?>" value="<?= $jh->idx ?>" onclick="setHarga(<?= $jh->harga_jual ?>,<?= $jh->jml_item_perpcs ?>,'<?= $jh->satuan ?>')"><b> Per <?= $jh->satuan?></b><br>
											<?php
										}
									}
								?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Harga Barang / <span class="satuan"></span>:</label>
								<div class="col-sm-5">
								<input name="harga" id="harga" value="" class="form-control input-sm" type="number" onkeyup="hitungDetail()">
								<input name="konversi_satuan" id="konversi_satuan" value="" type="hidden">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Stok Barang :</label>
								<div class="col-sm-5">
								<input name="stok_string" id="stok_string" value="<?= $barang->stok_string ?>" class="form-control input-sm" readonly type="text">
								<input name="stok" id="stok" value="<?= $barang->stok ?>" class="form-control input-sm"  type="hidden">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Qty (<span class="satuan"></span>):</label>
								<div class="col-sm-5">
								<input name="jml" id="jml" value="1" class="form-control input-sm" type="text" onkeyup="hitungDetail()">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Diskon:</label>
								<div class="col-sm-5">
								<input name="diskon" id="diskon" value="" type="text" class="form-control input-sm" onkeyup="hitungDetail()">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Sub Total:</label>
								<div class="col-sm-5">
								<input name="subtotal"  value="" type="text" id="subtotal" class="form-control input-sm" readonly>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">&nbsp;</label>
								<div class="col-sm-5">
								<button class="btn btn-success btn-sm" type='button' onclick="add_list(<?php echo $barang->barang_id;?>)"><span class="fa fa-plus"></span> Tambah</button>
								</div>
							</div>
						</div>
				</div>
			</div>
			
		</div>
	</div>
		
<?php } ?>