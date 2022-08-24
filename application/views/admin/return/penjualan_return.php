<?php 
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-md-6 text-left form-inline">
            <div class="input-group">
                <form method="GET" action="<?php echo base_url() ."return_barang/index.html" ?>">
                    <input type="text" class="form-control" name="q" id="q" value="<?php echo $q; ?>" placeholder="Masukkan No Invoice" >
                    <span class="input-group-btn">
                        <button class="btn btn-success" >Search</button>
                    </span>
                </form>

            </div>
        </div>
        <div class="col-md-6">
            <a href="<?php echo base_url() ."return_barang/histori" ?>" class="btn btn-success pull-right">Histori Return</a>
        </div>
    </div>

    <?php if(!empty($master_jual)) { ?>
    <div class="row">
        <div class="row">
        <section class="invoice">
            <form action="<?php echo base_url() ."return_barang/save" ?>" method="POST">
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
          <input type="hidden" name="return_jual_id" value="<?php echo $master_jual->jual_id; ?>">
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Pelanggan
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
                    <th>Barang</th>
                    <th style="text-align: right;">Harga</th>
                    <th style="text-align: right;">Jml</th>
                    <th style="text-align: right;">Alasan</th>
                    <th style="text-align: right;">Pengembalian Pembayaran</th>

                    <!--th style="text-align: right; width: 100px;">Return</th-->
                </tr>
                </thead>
                <tbody>
                    <?php 
                        $grand_total=0;
                        $no=0;
                        foreach ($detail_jual as $det) {
                            $no++;
                            $sub_total=($det->detail_harga_satuan * $det->detail_jumlah)-$det->detail_diskon;
                            $grand_total=$grand_total+$sub_total;
                            // $hargapcs=($sub_total / $det->detail_jumlah)/$det->detail_konversi_satuan;
                            ?>
                            <tr>
                                <td><?php echo $det->barang_nama; ?></td>
                                <td style="text-align: right;">@ Rp. <?php echo $det->detail_harga_satuan ." X "; ?> <?php echo $det->detail_jumlah ." " .$det->detail_satuan ; if(!empty($det->detail_diskon)) echo " - (Diskon Rp." .$det->detail_diskon .")"; echo " = Rp." .$sub_total; ?>
                                    <input type="hidden" name="detail_detail_jual_id<?php echo $no ?>" id="detail_detail_jual_id" value="<?php echo $det->detail_id; ?>">
                                    <input type="hidden" name="hargapsatuan<?php echo $no ?>" id="hargasatuan<?php echo $no ?>" value="<?php echo $det->detail_harga_satuan; ?>">
                                    <input type="hidden" name="barang_id<?php echo $no ?>" id="barang_id<?php echo $no ?>" value="<?php echo $det->detail_barang_id; ?>">
                                    <input type="hidden" name="konversi<?php echo $no ?>" id="konversi<?php echo $no ?>" value="<?php echo $det->detail_konversi_satuan; ?>">
                                    <input type="hidden" name="detail_satuan<?php echo $no ?>" id="detail_satuan<?php echo $no ?>" value="<?php echo $det->detail_satuan; ?>">
                                </td>
                                <td style="text-align: right;">
                                <!-- <label for="">Jumlah Retur</label> -->
                                    <select class="form-control select2" name="jml_return<?php echo $no ?>" id="jml_return<?php echo $no ?>" onchange="get_harga(<?php echo $no; ?>)">
                                        <?php 
                                        // if($master_jual->jual_tipe=='Grosir') 
                                        //     $val= $det->detail_jumlah * $det->barang_konversi ; 
                                        // else 
                                        //     $val= $det->detail_jumlah ;
                                        $ret=$this->Barang_jual_model->cekRetur($det->detail_id);
                                        if(empty($ret)) $val= $det->detail_jumlah ;
                                        else $val=$det->detail_jumlah-$ret->detail_jumlah;
                                        for($i=0;$i<=$val;$i++){
                                            if($i==0) echo "<option value='$i'>$i </option>";
                                            else echo "<option value='$i'>$i " .$det->detail_satuan ."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td style="text-align: right;">
                                    <select class="form-control" name="alasan<?php echo $no ?>">
                                        <option value="Rusak">Rusak</option>
                                        <option value="Expire">Expire</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </td>
                                <td style="text-align: right;"><input type="number" name="jml_uang<?php echo $no ?>" id="jml_uang<?php echo $no ?>" class="form-control" value="0" required></td>
                                <!--td style="text-align: right;"><a href="#" class="btn btn-success btn-xs" onclick="return_barang(<?php //echo $det->detail_id; ?>)">Return</a></td-->
                            </tr>
                            <?php
                        }
                    ?>
                    <tfoot>
                        <tr>
                            <th>Sub Total</th>
                            <th style="text-align: right;">Rp.  <?php echo $grand_total; ?></th>
                            <th colspan="2"></th>
                            <th><div id="grand_total"></div></th>
                        </tr>
                    </tfoot>
                    
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

            <input type="hidden" name="jmldata" id="jmldata" value="<?php echo $no; ?>">
          <?php } ?>
          <!-- this row will not appear when printing -->
          <?php if(!empty($master_jual)){ ?>
          <div class="row no-print">
            <div class="col-xs-12">
              <input type="submit" name="save" value="Save" class="btn btn-success pull-right">
            </div>
          </div>
          <?php } ?>
      </form>
        </section>
    </div>
    </div>
    <?php } else{
        if(!empty($q)){

        }
        
    }?>
    
</div>
<script type="text/javascript">
    function return_barang(id)
        {
            //var url;
            //save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            //$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo base_url() .'return_barang/edit'?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    //alert("ID : " + data.barang_nama);
                    $('#detail_id').val(id);
                    //$('#barang_nama').val(data.barang_nama);
                    harga="@ Rp. " + data.detail_harga_satuan;
                    jml=data.detail_jumlah;
                    subtotal=data.detail_jumlah * data.detail_harga_satuan;
                    jml_return="<select class='form-control' name='jml_return'>";
                    for(i=0;i<jml;i++){
                        val=i+1;
                        jml_return+="<option value='" +val +"'>" +val +"</option>"
                    }
                    jml_return+="</select>";
                    document.getElementById("barang_nama").innerHTML = data.barang_nama;
                    document.getElementById("detail_harga_satuan").innerHTML =harga;
                    document.getElementById("detail_jumlah").innerHTML = data.detail_jumlah;
                    document.getElementById("jml").innerHTML = jml_return;
                    document.getElementById("subtotal").innerHTML = subtotal;
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Return Barang'); // Set title to Bootstrap modal title
                    //satuan();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(url);
                }
            });
        }
    function get_harga(no){
        hargasatuan = document.getElementById("hargasatuan" + no).value;
        jml_return = document.getElementById("jml_return" + no).value;
        jmldata = document.getElementById("jmldata").value;
        tot=hargasatuan*jml_return;
        var a = document.getElementById("jml_uang"+no);
        a.value = parseInt(tot);
        //alert(jmldata);
        jr=0;
        hr=0;
        t=0;
        grand_total=0;
        for(i=1;i<=jmldata;i++){
            jr = document.getElementById("jml_return" + i).value;
            hr = document.getElementById("hargasatuan" + i).value;
            t=jr*hr;
            grand_total=grand_total + t;
        }
        document.getElementById("grand_total").innerHTML = "Rp. " + parseInt(grand_total);
        //alert(grand_total);
    }
</script>

<!--Modal-->

    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Reurn Barang</h3>
                </div>

                <div class="modal-body form">
                    <form action="#" method="post" id="form" class="form-horizontal"> 
                        <input type="hidden" name="detail_id" id="detail_id">
                        <table width="100%" class="table table-striped">
                            <tr>
                                <th colspan="2">Detail Transaksi</th>
                            </tr>
                            <tr>
                                <th>Barang</th>
                                <td><label id="barang_nama"></label></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td><label id="detail_harga_satuan"></label> X <label id="detail_jumlah"></label> = <b>Rp.</b> <label id="subtotal"></label></td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td><div id="jml"></div></td>
                            </tr>
                            <tr>
                                <th>Alasan</th>
                                <td><textarea class="form-control" name="alasan_return"></textarea></td>
                            </tr>
                        </table>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Return</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->