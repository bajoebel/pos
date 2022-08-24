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
            <small class="pull-right">Date: <?php if(!empty($master_jual)) echo longdate($master_jual->jual_tanggal); ?> <a href="<?php if(!empty($master_jual)) echo base_url()."pembelian_barang/ubah/" .$master_jual->jual_id; ?>"><span class="fa fa-pencil"></span></a></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <?php if(!empty($master_jual)){ ?>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          pelanggan
          <address>
            <strong><?php echo $master_jual->pelanggan_nama; ?></strong><br>
            Telp : <?php echo $master_jual->peanggan_kontak; ?><br>
            Alamat : <?php echo $master_jual->pelanggan_alamat; ?>           
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          &nbsp;
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice #<?php echo $master_jual->jual_invoice; ?></b><br>
          <br>
          <b>Tipe Penjualan:</b> <?php echo $master_jual->jual_tipe; ?><br>
          <b>Tanggal:</b> <?php echo longdate($master_jual->jual_tanggal); ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <?php 
      } 
      if(!empty($detail_jual)){

      ?>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
                <th>Nama Barang</th>
                <th style="text-align: right;">Harga</th>
                
                <th style="text-align: right;">Diskon</th>
                <th style="text-align: right;">Jumlah</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $grand_total=0;
                    foreach ($detail_jual as $det) {
                        $sub_total=($det->detail_harga_satuan * $det->detail_jumlah) - $det->detail_diskon;
                        $grand_total+=$sub_total;
                        ?>
                        <tr>
                          <td><?php if($master_jual->jual_tipe=='Ecer') echo $det->detail_jumlah ." " .$det->barang_satuan_kecil ; else echo $det->detail_jumlah ." " .$det->barang_satuan_besar ; ?></td>
                          <td><?php echo $det->barang_nama; ?></td>
                          <td style="text-align: right;">Rp. <?php echo $det->detail_harga_satuan; ?></td>
                          <td style="text-align: right;">Rp. <?php echo $det->detail_diskon; ?> </td>
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
      <?php if(!empty($master_jual)){ ?>
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url() ."penjualan/histori"; ?>" class="btn btn-success pull-left"><i class="fa fa-arrow-left "></i> Ke Daftar Barang jual
          </a>
          <a href="<?php echo base_url() ."penjualan/cetak/" .$master_jual->jual_id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <!--button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button-->
          
          <a href="<?php echo base_url() ."penjualan"; ?>" class="btn btn-success pull-right"><i class="fa fa-arrow-left "></i> Kembali Ke Form Penjualan
          </a>
          
        </div>
      </div>
      <?php } ?>
    </section>
</div>