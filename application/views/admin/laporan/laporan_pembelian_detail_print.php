
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
<script>  
    function cetak(){  
        print();  
    }  
  
    function PrintPreview() {
        var toPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');
        popupWin.document.open();
        popupWin.document.write('<html><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="Print.css" media="screen"/></head><body">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</html>');
        popupWin.document.close();

    }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan pembelian</title>

<body onload="cetak()">
    <?php 
        function longdate($date){
            $d=explode('-', $date);
            $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
            return $new_date;
        }
    ?>
    <div style="width:1200px; margin:0 auto;  ">
        <table>
            <tr>
                <td>
                <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Pembelian <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5><?php if(!empty($from) || !empty($to)) echo "Dari Tanggal " .longdate($from) ." S/D " .longdate($to); else echo ""; ?></h5>
                </td>
            </tr>
        </table>
        <table class="table" border="1">
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th><th>Tanggal</th><th>Nama</th><th>Kategori</th><th style='text-align: right;'>Harga</th><th style='text-align: right;'>Jumlah</th><th style='text-align: right;'>Sub Total</th>
            <tr>
        </thead>
        <tbody id="">
            <?php 
            $start=0;
            $grand_total=0;
            foreach ($pembelian_data as $b) {
                $start++;
                $grand_total+=($b->detail_harga_satuan * $b->detail_jumlah);
                $satuan = $b->barang_satuan_besar;
                echo "
                <tr>
                    <td style=\"width: 10px;\">" .$start ."</td><td>" .longdate($b->masuk_tanggal) ."</td><td>" .$b->barang_nama ."</td><td>" .$b->kategori_nama ."</td><td style='text-align: right;'>Rp. " .$b->detail_harga_satuan ."/" .$satuan ."</td><td style='text-align: right;'>" .$b->detail_jumlah ." " .$satuan ."</td><td style='text-align: right;'>Rp. " .$b->detail_harga_satuan * $b->detail_jumlah ."</td>
                <tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" >Grand Total</th><th style='text-align: right;'>Rp. <?php echo $grand_total; ?></th>
            </tr>
        </tfoot>
        
    </table>
    </div>

</body>
</html>
