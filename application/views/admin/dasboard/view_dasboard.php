<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="<?php echo base_url()."penjualan"; ?>">
            	<span class="info-box-icon bg-aqua"><i class="fa fa-cart-plus "></i></span>
            
	            <div class="info-box-content">
	              <span class="info-box-text">Penjualan</span>
	              <span class="info-box-number">Rp. <?php if(!empty($penjualan->penjualan)) echo $penjualan->penjualan; else echo "0"; ?><small></small></span>
	            </div>
	        </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="<?php echo base_url()."pembelian_barang"; ?>">
	            <span class="info-box-icon bg-red"><i class="fa fa-cart-arrow-down"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Pembelian</span>
	              <span class="info-box-number">Rp. <?php if(!empty($pembelian->pembelian)) echo $pembelian->pembelian; else echo "0"; ?></span>
	            </div>
	        </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="<?php echo base_url()."piutang"; ?>">
	            <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Penerimaan Piutang</span>
	              <span class="info-box-number">Rp. <?php if(!empty($piutang->piutang)) echo $piutang->piutang; else echo "0"; ?></span>
	            </div>
	        </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
          	<a href="<?php echo base_url()."hutang"; ?>">
	            <span class="info-box-icon bg-yellow"><i class="fa fa-paypal"></i></span>

	            <div class="info-box-content">
	              <span class="info-box-text">Pembayaran Hutang</span>
	              <span class="info-box-number">Rp. <?php  if(!empty($hutang->hutang))  echo $hutang->hutang; else echo "0"; ?></span>
	            </div>
	        </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>