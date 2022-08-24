<?php 
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=LAP_JUAL_" .date('Ymdhms') .".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
?>
<table>
            <tr>
                <td>
                <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                <h3>Laporan Data Penjualan <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5><?php if(!empty($from) || !empty($to)) echo "Dari Tanggal " .longdate($from) ." S/D " .longdate($to); else echo ""; ?></h5>
                </td>
            </tr>
        </table>
        <table class="table" border="1" >
            <thead class="bg-green">
                <tr>
                    <th style="width: 10px;">No</th><th>Invoice</th><th>Tipe</th><th>Pelanggan</th><th>Tanggal</th><th style="text-align: right;">Total</th>
                <tr>
            </thead>
            <tbody id="">
                <?php 
                //$start=0;
                $grand_total=0;
                foreach ($penjualan_data as $p) {
                    $start++;
                    $grand_total+=$p->sub_total;
                    echo "
                    <tr>
                        <td style=\"widtd: 10px;\">" .$start ."</td><td>" .$p->jual_invoice ."</td><td>" .$p->jual_tipe ."</td><td>" .$p->pelanggan_nama ."</td><td>" .longdate($p->jual_tanggal) ."</td><td style='text-align:right;'>Rp. " .$p->sub_total ."</td>
                    <tr>";
                }
                ?>
                <tfoot>
                    <tr>
                        <th colspan="5">Grand Total </th>
                        <th style="text-align: right;">Rp. <?php echo $grand_total; ?></th>
                    </tr>
                </tfoot>
                
            </tbody>
            
        </table>