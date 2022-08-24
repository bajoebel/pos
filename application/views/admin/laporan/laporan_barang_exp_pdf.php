
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Barang</title>

<body onload="cetak()">
    <div style="width:1200px; margin:0 auto;  ">
        <table>
            <tr>
                <td>
                <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Barang  Expire <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
                </td>
            </tr>
        </table>
        <table class="table" border="1">
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
    </div>

</body>
</html>
