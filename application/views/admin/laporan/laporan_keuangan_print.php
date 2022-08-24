
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
<title>Laporan Barang</title>

<body onload="cetak()">
    <div style="width:1200px; margin:0 auto;  ">
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
    </div>

</body>
</html>
