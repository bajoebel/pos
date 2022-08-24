
<!-- Content Header (Page header) -->
<!--section class="content-header">
    <h1>
        Dashboard
        <small>Data Hutang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> HUTANG</a></li>
        <li class="active"> INDEX</li>
    </ol>
</section-->

<!-- Main content -->
<section class="content">
    <?php if(!empty($notif)) echo $notif; ?>
    <div class="">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                    <!--button type="button" class="btn btn-success btn-sm" onclick="add()"><span class="fa fa-plus"></span> Tambah</button-->
                    </h3>
                    <div class="box-tools">
                        <form action="#" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="hidden" name="start" id="start" value="0">
                                <input type="text" name="q" id="q" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="getHutang(0)"><i class="fa fa-search"></i></button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead class="bg-green">
                            <th>#</th>
                            <th>Faktur</th>
                            <th>Pemasok </th>
                            <th>Tanggal</th>
                            <th class="text-right">Jumlah Hutang</th>
                            <th class="text-right">Jumlah Sudah Bayar</th><th class="text-right">#</th>
                        </thead>
                        <tbody id="data"></tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="btn-group" id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">COBA</h3>
                </div>

                <div class="modal-body form">
                    <form class="form-horizontal" method="POST" id="form" action="#" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" class="form-control" id="hutang_id" name="hutang_id" placeholder="Hutangid">
                            
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">FAKTUR</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="hutang_faktur" name="hutang_faktur" placeholder="Hutangfaktur" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">PEMASOK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pemasok_nama" name="pemasok_nama" placeholder="Pemasoknama" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">TANGGAL TRANSAKSI</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" id="hutang_tgl" name="hutang_tgl" placeholder="Hutangtgl" readonly>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">HUTANG</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control " id="hutang_jml" name="hutang_jml" placeholder="Hutangtgl" readonly>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">SUDAH BAYAR</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="jml_bayar" name="jml_bayar" placeholder="Jmlbayar" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">SISA HUTANG</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="sisa_hutang" name="sisa_hutang" placeholder="Jmlbayar" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">JUMLAH BAYAR</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control " id="jml_pembayaran" name="jml_pembayaran" placeholder="Jumlah Pembayaran" >
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <div class="modal fade" id="modal_histori" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">HISTORI BAYAR</h3>
                </div>

                <div class="modal-body form">
                    <div id="histori_bayar"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
<script type="text/javascript">
    var base_url= "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url() ."js/hutang.js"; ?>"></script>