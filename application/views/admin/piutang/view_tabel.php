<!-- Main content -->
<section class="content">
    <?php if(!empty($notif)) echo $notif; ?>
    <div class="">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">
                    
                    </h3>
                    <div class="box-tools">
                        <form action="#" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="hidden" name="start" id="start" value="0">
                                <input type="text" name="q" id="q" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" onclick="getPiutang(0)"><i class="fa fa-search"></i></button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead class="bg-green">
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Pelanggan </th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Jumlah Sudah Bayar</th>
                            <th class="text-right">#</th>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">COBA</h3>
                </div>

                <div class="modal-body form">
                    <form class="form-horizontal" method="POST" id="form" action="#" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" class="form-control" id="piutang_id" name="piutang_id" placeholder="Piutangid">
                            
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">INVOICE</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="piutang_invoice" name="piutang_invoice" placeholder="Piutanginvoice" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">PELANGGAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pelanggan_nama" name="pelanggan_nama" placeholder="Pelanggannama" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">TANGGAL</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" id="piutang_tgl" name="piutang_tgl" placeholder="Piutangtgl" readonly="">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">JUMLAH</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="piutang_jml" name="piutang_jml" placeholder="Piutangjml" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">SUDAH DIBAYAR</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlah_bayar" name="jumlah_bayar" placeholder="Jumlahbayar" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">JUMLAH TAGIHAN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan" placeholder="Tagihan" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">JUMLAH BAYAR</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran" placeholder="Pembayaran" >
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
<script src="<?php echo base_url() ."js/piutang.js"; ?>"></script>