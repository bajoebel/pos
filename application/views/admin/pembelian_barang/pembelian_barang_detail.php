<?php 
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
?>
<div class="row">
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> IRA OK GROSIR.
            <small class="pull-right">Date: <?php if(!empty($master_masuk)) echo longdate($master_masuk->masuk_tanggal); ?> <a href="<?php if(!empty($master_masuk)) echo base_url()."pembelian_barang/ubah/" .$master_masuk->masuk_id; ?>"><span class="fa fa-pencil"></span></a></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <?php if(!empty($master_masuk)){ ?>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Pemasok
          <address>
            <strong><?php echo $master_masuk->pemasok_nama; ?></strong><br>
            Telp : <?php echo $master_masuk->pemasok_kontak; ?><br>
            Alamat : <?php echo $master_masuk->pemasok_alamat; ?>           
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          &nbsp;
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $master_masuk->masuk_nofaktur; ?></b><br>
          <br>
          <b>Tanggal:</b> <?php echo longdate($master_masuk->masuk_tanggal); ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php 
      } 
      if(!empty($detail_masuk)){

      ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th>Barang</th>
                <th style="text-align: right;">Harga</th>
                <th style="text-align: right;">Jml</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $grand_total=0;
                    foreach ($detail_masuk as $det) {
                        $sub_total=$det->detail_harga_satuan * $det->detail_jumlah;
                        $grand_total=$grand_total+$sub_total;
                        ?>
                        <tr>
                            <td><?php echo $det->barang_nama; ?></td>
                            <td style="text-align: right;">Rp. <?php echo $det->detail_harga_satuan; ?></td>
                            <td style="text-align: right;"><?php echo $det->detail_jumlah; ?></td>
                            <td style="text-align: right;">Rp. <?php echo $sub_total; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          &nbsp;
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          
          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%;" style="">Subtotal</th>
                <td style="text-align: right;"><b> Rp.  <?php echo $grand_total; ?></b></td>
              </tr>
              
            </tbody>
        </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php } ?>
      <!-- this row will not appear when printing -->
      <?php if(!empty($master_masuk)){ ?>
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url() ."pembelian_barang/histori"; ?>" class="btn btn-success pull-left"><i class="fa fa-arrow-left "></i> Ke Daftar Barang Masuk
          </a>
          <a href="<?php echo base_url() ."pembelian_barang/print/" .$master_masuk->masuk_id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <!--button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button-->
          
          <a href="<?php echo base_url() ."pembelian_barang"; ?>" class="btn btn-success pull-right"><i class="fa fa-arrow-left "></i> Kembali Ke Form Pembelian Barang
          </a>
          
        </div>
      </div>
      <?php } ?>
    </section>
</div>