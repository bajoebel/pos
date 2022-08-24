<div class="col-sm-12">
    <div class="row">
        <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
        <div class="col-md-10">
        <h3>Laporan Data Stok Barang <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
            
        </div>
        <div class="col-md-2 ">
            <div class="pull-right">
                <a href="<?php echo base_url() ."laporan/barang/print" ?>" class="btn btn-default btn-xs" target="_blank"><span class="fa fa-print"></span></a>
                <a href="<?php echo base_url() ."laporan/barang/pdf" ?>" class="btn btn-danger btn-xs" target="_blank"><span class="fa fa-file-pdf-o"></span></a>
                <a href="<?php echo base_url() ."laporan/barang/excel" ?>" class="btn btn-success btn-xs" target="_blank"><span class="fa fa fa-file-excel-o"></span></a>
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="col-md-12" style="border-top:double #000; border-collapse: collapse;border-width: 1px">&nbsp;</div>
        </div>
        
        <p>&nbsp;</p>
        
    </div>
    
    <table class="table table-bordered" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Rak</th><th>Harga Pokok</th><th>Harga Jual</th><th>Stok</th><th>Keterangan</th><th>Kartu Stok</th>
            <tr>
        </thead>
        <tbody id="">
            <?php 
            $start=0;
            foreach ($barang_data as $b) {
                $start++;
                echo "
                <tr>
                    <td style=\"width: 10px;\">" .$start ."</td>
                    <td>" .$b->barang_kode ."</td>
                    <td>" .$b->barang_nama ."</td>
                    <td>" .$b->kategori_nama ."</td>
                    <td>" .$b->rak_nama ."</td>
                    <td>Rp. " .$b->harga_modal ."/" .$b->barang_satuan_kecil ."</td>
                    <td>" .$b->hjual ."</td>
                    <td>" .$b->stok_string ."</td>
                    <td> 1 " .$b->barang_satuan_besar ."=" .$b->barang_konversi ." " .$b->barang_satuan_kecil ."</td>
                    <td><button class='btn btn-default btn-sm' onclick='kartStok(\"".$b->barang_id."\",\"".$b->barang_nama."\")'><span class='fa fa-print'></span> Cetak Kartu Stok</button></td>
                <tr>";
            }
            ?>
        </tbody>
        
    </table>
    <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-default">Total Record : <?php echo $total_rows ?></a>
                <?php 
                if(!empty($report)) {
                    if($report=='Y'){ 
                        echo anchor(site_url('Banner/report'), 'Report', 'class="btn btn-success"'); 
                    } 
                }
                ?>    
            </div>

            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-12 pull-right" style="text-align: left;">
            <div id="nav"></div>
            <div id="curidx"></div>
        </div>
    </div>
    
    <script type="text/javascript">
        // window.onload(view(0));
        $(document).ready(function() {
            
            $('.tanggal').inputmask('yyyy-mm-dd', {
                'placeholder': 'yyyy-mm-dd'
            });
            $('.tanggal').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd"
            });
        });
        function kartStok(id,barang){
            $('#modal_form').modal('show');
            $('#barang_id').val(id);
            $('.modal-title').text('Cetak Kartu Stok '+barang); 
        }
        
        function cetak(){
            var dari=$('#dari').val();
            var sampai=$('#sampai').val();
            var id=$('#barang_id').val();
            window.open("<?= base_url() ."laporan/kartustok/"?>"+id+"?dari="+dari+"&sampai="+sampai)
        }
    </script>

    <!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <form action="<?php echo base_url() ."barang/save"; ?>" method="post" id="form" class="form-horizontal" enctype='multipart/form-data'>  -->
                    <div class="modal-header bg-green">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Barang</h3>
                    </div>

                    <div class="modal-body form">
                            <input type="hidden" class="form-control input-sm tanggal" name="barang_id" id="barang_id" placeholder="Barang Id" value="" />
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Dari</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm tanggal" name="dari" id="dari" placeholder="Dari" value="" />
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Sampai</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm tanggal" name="sampai" id="sampai" placeholder="Sampai" value="" />
                                </div>
                            </div>
                            
                    </div>

                    <div class="modal-footer">
                        <!--button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button-->
                        <button type="button" id="btnCetak" class="btn btn-success" onclick="cetak()">Cetak</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                <!-- </form> -->
            </div>
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--========================================================================================================
End of file barang_list.php 
Location: ./application/views/barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->