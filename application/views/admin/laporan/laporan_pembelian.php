<?php 
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
?>

<div class="col-sm-12">
    <div class="col-md-12 bg-green">
        <h5>Filter</h5>
    </div>
    <br>&nbsp;
    <div class="pull-right" style="border-bottom:solid #000; border-collapse: collapse; border-width: 1px;padding: 10px 0px">
        <form action="<?php echo site_url('laporan/pembelian'); ?>" class="form-inline" method="get">
            <a href="<?php echo base_url() ."laporan/pembelian/detail" ?>" class="btn btn-warning"><i class="fa fa-search-plus"></i></a>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input name="from" class="form-control pull-right" id="datepicker" value="<?php if(!empty($from)) echo $from; ?>" required="" type="text" placeholder="From">
            </div>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input name="to" class="form-control pull-right" id="datepicker1" value="<?php if(!empty($to)) echo $to; ?>" required="" type="text" placeholder="To">
            </div>
            <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            <a href="<?php echo base_url() ."laporan/pembelian/print.html"; if(!empty($from) || !empty($to)) echo "?from=" .$from ."&to=" .$to; ?>" class="btn btn-default"><i class="fa fa-print"></i></a>
            <a href="<?php echo base_url() ."laporan/pembelian/pdf.html"; if(!empty($from) || !empty($to)) echo "?from=" .$from ."&to=" .$to; ?>" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></a>
            <a href="<?php echo base_url() ."laporan/pembelian/excel.html"; if(!empty($from) || !empty($to)) echo "?from=" .$from ."&to=" .$to; ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i></a>
        </form>
    </div>
    <div class="row">
        <div class="col-md-10">
        <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Pembelian <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5><?php if(!empty($from) || !empty($to)) echo "Dari Tanggal " .longdate($from) ." S/D " .longdate($to); else echo ""; ?></h5>
        </div>
        
        <div class="col-md-12">
            <div class="col-md-12" style="border-top:double #000; border-collapse: collapse;border-width: 1px">&nbsp;</div>
        </div>
        
        <p>&nbsp;</p>
        
    </div>
    
    <table class="table table-bordered" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th><th>No faktur</th><th>pemasok</th><th>Tanggal</th><th style="text-align: right;">Total</th>
            <tr>
        </thead>
        <tbody id="">
            <?php 
            //$start=0;
            $grand_total=0;
            foreach ($pembelian_data as $p) {
                $start++;
                $grand_total+=$p->sub_total;
                echo "
                <tr>
                    <td style=\"widtd: 10px;\">" .$start ."</td><td>" .$p->masuk_nofaktur ."</td><td>" .$p->pemasok_nama ."</td><td>" .longdate($p->masuk_tanggal) ."</td><td style='text-align:right;'>Rp. " .$p->sub_total ."</td>
                <tr>";
            }
            ?>
            <tfoot>
                <tr>
                    <th colspan="4">Grand Total </th>
                    <th style="text-align: right;">Rp. <?php echo $grand_total; ?></th>
                </tr>
            </tfoot>
            
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
    
    
</div>
<!--========================================================================================================
End of file laporan_pembelian.php 
Location: ./application/views/laporan_pembelian.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->