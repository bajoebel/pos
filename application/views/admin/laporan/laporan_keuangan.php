<div class="col-sm-12">
    <div class="row">
        <div class="col-md-10">
        <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Keuangan <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
        </div>
        <div class="col-md-2 ">
            <div class="pull-right">
                <a href="<?php echo base_url() ."laporan/keuangan/print" ?>" class="btn btn-default btn-xs" target="_blank"><span class="fa fa-print"></span></a>
                <a href="<?php echo base_url() ."laporan/keuangan/pdf" ?>" class="btn btn-danger btn-xs" target="_blank"><span class="fa fa-file-pdf-o"></span></a>
                <a href="<?php echo base_url() ."laporan/keuangan/excel" ?>" class="btn btn-success btn-xs" target="_blank"><span class="fa fa fa-file-excel-o"></span></a>
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="col-md-12" style="border-top:double #000; border-collapse: collapse;border-width: 1px">&nbsp;</div>
        </div>
        
        <p>&nbsp;</p>
        
    </div>
    
    <table class="table table-bordered" >
        <thead style="">
            <tr>
                <th style="width: 10px;" rowspan="2">No</th>
                <th rowspan="2">Akun</th>
                <th colspan="2" style="text-align: center;">Jumlah</th>
            </tr>
            <tr>
                <th style="text-align: right;">Debet</th>
                <th style="text-align: right;">Kredit</th>
            </tr>
        </thead>
        <tbody id="">

            <?php 
            $tot_kredit=0;
            $tot_debet=0;
            $start=1;
            foreach($keuangan_data as $k){
                if($k->akun_jenis=='Debet'){
                    $debet=$k->jumlah;
                    $kredit=0;
                }else{
                    $kredit=$k->jumlah;
                    $debet=0;
                }
                $tot_debet+=$debet;
                $tot_kredit+=$kredit;
                echo '
            <tr>
                <td style="width: 10px;">' .$start++ .'</td>
                <td>' .$k->akun_nama .'</td>
                <td style="text-align: right;">Rp. ' .$debet .'</td>
                <td style="text-align: right;">Rp. ' .$kredit .'</td>
            </tr>
            ';
            }?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Debet</th>
                <th style="text-align: right;">Rp. <?php echo $tot_debet; ?></th>
            </tr>
            <tr>
                <th colspan="3">Total Kredit</th>
                <th style="text-align: right;">Rp. <?php echo $tot_kredit; ?></th>
            </tr>
            <tr>
                <th colspan="3">Laba Rugi</th>
                <th style="text-align: right;">Rp. <?php echo $tot_debet-$tot_kredit; ?></th>
            </tr>
        </tfoot>
    </table>
    <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-default">Total Record : <?php echo $total_rows ?></a>
            </div>

            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
<!--========================================================================================================
End of file barang_list.php 
Location: ./application/views/barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->