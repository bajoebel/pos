
<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=LAP_BRG_RSK" .date('Ymdhms') .".xls");
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
                    <h3>Laporan Data Barang Rusak <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
            </td>
        </tr>
    </table>
    <table class="table" border="1" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Jumlah</th>
            <tr>
        </thead>
        <tbody id="">
            <?php 
            $start=0;
            foreach ($barang_data as $b) {
                $start++;
                echo "
                <tr>
                    <td style=\"width: 10px;\">" .$start ."</td><td>" .$b->barang_kode ."</td><td>" .$b->barang_nama ."</td><td>" .$b->kategori_nama ."</td><td>" .$b->jumlah ." " .$b->barang_satuan_kecil ."</td>
                <tr>";
            }
            ?>
        </tbody>
        
    </table>
