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
					<input name="nama" value="<?php echo $barang->barang_nama; ?>" type="hidden">
					<input name="tipe" value="<?php //echo $tipe; ?>" type="hidden">
					<input name="konversi" id="konversi" value="1" type="hidden">
					<input type="hidden" name="hpppcs" id='hpppcs' value="<?= $barang->harga_modal ?>">
					<input type="hidden" name="satuan" id='satuan' value="">
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
							<label for="Nama Barang">Nama Barang</label>
						</div>
						<div class="col-md-9">
							<label for="" class='form-control col-md-9 pull-left' style="text-aligh:'left'"><?php echo $barang->barang_nama; ?></label>	
						</div>
					</div>
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
							<label for="Nama Barang">Satuan</label>
						</div>
						<div class="col-md-9">
						<?php 
							$jenis_harga=$this->Pembelian_barang_model->getJenisHarga($barang->barang_id);
							if(empty($jenis_harga)) echo "<label>Jenis Harga Belum Diinput</label>";
							else{
								foreach ($jenis_harga as $jh ) {
								?>
								<input type="radio" name="jenisharga" id="jenisharga<?= $jh->idx?>" value="<?= $jh->idx ?>" onclick="setJenisHarga(<?= $jh->jml_item_perpcs ?>,'<?= $jh->satuan ?>')"><b> Per <?= $jh->satuan?></b><br>
								<?php
								}
							}
						?>	
						</div>
					</div>
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
							<label for="" >Harga Barang / <span class='satuan'><?= $barang->barang_satuan_kecil ?></span></label>
						</div>
						<div class="col-md-9">
							
							<input name="harga" id="harga" value="<?php echo $barang->harga_modal; ?>" class="form-control col-md-9 input-sm" type="number" onkeyup="hitungDetail()">
						</div>
					</div>
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
								<label for="">Qty (<span class='satuan'><?= $barang->barang_satuan_kecil ?></span>)</label>
						</div>
						<div class="col-md-9">
								<input name="jml" id="jml" value="1" class="form-control input-sm" type="text" onkeyup="hitungDetail()">
						</div>
					</div>
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
								<label for="">Diskon</label>
						</div>
						<div class="col-md-9">
								<input name="diskon" id="diskon" value="" type="text" class="form-control input-sm" onkeyup="hitungDetail()">
						</div>
					</div>
					<div class="row" style="padding-bottom:5px">
						<div class="col-md-3">
								<label for="">Sub Total</label>
						</div>
						<div class="col-md-9">
							<div class="input-group">
								<input name="subtotal"  value="<?php echo $barang->harga_modal;  ?>" type="text" id="subtotal" class="form-control input-sm" readonly>
								<span class="input-group-btn">
									<button type='button' class="btn btn-success btn-sm btn-block" id="btnAddList" onclick="add_list(<?php echo $barang->barang_id;?>)"><i class='fa fa-plus'></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
<?php } ?>