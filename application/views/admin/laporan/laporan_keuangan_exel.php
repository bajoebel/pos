
<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=LAP_BRG_" .date('Ymdhms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<style type="text/css">
td{
    padding:0px 0px 10px 0px;
    font-size:16px;
}

.table{
    border:solid #00a65a;
    border-collapse: collapse;
    border-width: 1px;
    width: 100%;
}

.bg-green{
    background-color: #00a65a;
    color: #fff;
}
</style>
<table>
            <tr>
                <td>
                <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Keuangan <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
                </td>
            </tr>
        </table>
        <table class="table"  border="1">
            <thead class="bg-green">
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
