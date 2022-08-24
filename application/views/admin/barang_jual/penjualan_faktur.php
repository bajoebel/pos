<!DOCTYPE html>
<html>
<head>
	<title>Faktur</title>
	<style type="text/css">
		.baris{
			border-bottom: dotted #000;
			border-collapse: collapse;
			border-width: 1px;
			width: 300px;
			height: relative;
			padding: 2px;
			font-size: 9pt;
		}

		.table{
		    border:solid #00a65a;
		    border-collapse: collapse;
		    border-width: 1px;
		    width: 100%;
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
</head>
<body onload="cetak()">
	<?php 
	    function longdate($date){
	        $d=explode('-', $date);
	        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
	        return $new_date;
	    }
	?>
	<div class="baris"><b>IRA OK Grosir</b></div>
	<?php if(!empty($master_jual)){ ?>
	<div class="baris">
		<b>No #<?php echo $master_jual->jual_invoice; ?></b><br>
		<?php if(!empty($master_jual)) echo longdate($master_jual->jual_tanggal); ?><br>
		
		<?php echo $master_jual->pelanggan_nama; ?><br>
        Telp : <?php echo $master_jual->peanggan_kontak; ?><br>
        Alamat : <?php echo $master_jual->pelanggan_alamat; ?>  
	</div>
	<?php } ?>
	<div class="baris">
		<table class="table" border="1">
            <thead>
            <tr>
			<th>Qty</th>
                <th>Barang</th>
                <th style="text-align: right;">Harga</th>
                
                <th style="text-align: right;">Diskon</th>
                <th style="text-align: right;">Jumlah</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    $grand_total=0;
                    foreach ($detail_jual as $det) {
                        $sub_total=($det->detail_harga_satuan * $det->detail_jumlah)-$det->detail_diskon;
                        $grand_total=$grand_total+$sub_total;
                        ?>
                        <tr>
						<td ><?php if($master_jual->jual_tipe=='Ecer') echo $det->detail_jumlah ." " .$det->barang_satuan_kecil ; else echo $det->detail_jumlah ." " .$det->barang_satuan_besar ; ?></td>
                            <td><?php echo $det->barang_nama; ?></td>
                            <td style="text-align: right;">Rp. <?php echo $det->detail_harga_satuan; ?></td>
                            
                            <td style="text-align: right;">Rp. <?php echo $det->detail_diskon; ?></td>
                            <td style="text-align: right;">Rp. <?php echo $sub_total; ?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
            <tfoot>
            	<tr>
            		<td colspan="4">Total</td>
            		<td style="text-align: right;">Rp. <?php echo $grand_total; ?></td>
            	</tr>
            </tfoot>
          </table>
	</div>
	<div class="baris" style="text-align: center;">Terima Kasih Sudah Belanja</div>
</body>
</html>