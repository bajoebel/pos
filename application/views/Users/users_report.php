
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style type="text/css">
td{
    padding:0px 0px 10px 0px;
    font-size:16px;
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
<title>Laporan Users</title>

<body onload="cetak()">
    <div style="width:800px; margin:0 auto;  ">
        <div style="height:1200px">
            <div style="width:700px; margin:0 auto;  ">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                    <th>Username</th>
                    <th>User Password</th>
                    <th>User Nama Lengkap</th>
                    <th>User Jekel</th>
                    <th>User Alamat</th>
                    <th>User Email</th>
                    <th>User Kontak</th>
                    <th>User Status</th>
                    <th>User Photo</th>
                    <th>Admin</th>
                    <th>User Group Id</th></tr>
                    <?php
                    foreach ($Users_data as $Users)
                    {
                    ?>
                    <tr>
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $Users->user_nama_lengkap ?></td>
                        <td><?php echo $Users->user_jekel ?></td>
                        <td><?php echo $Users->user_alamat ?></td>
                        <td><?php echo $Users->user_email ?></td>
                        <td><?php echo $Users->user_kontak ?></td>
                        <td><?php echo $Users->user_status ?></td>
                        <td><?php echo $Users->user_group_id ?></td>
                        <td style="text-align:center" width="200px">
                        <?php 
                        echo anchor(site_url('Users/read/'.$Users->username),'<span class="btn btn-success btn-xs glyphicon glyphicon-search"></span>');
                        if(!empty($update)) {
                            if($update=='Y'){
                                echo ' | '; 
                                echo anchor(site_url('Users/update/'.$Users->username),'<span class="btn btn-danger btn-xs glyphicon glyphicon-edit"></span>'); 
                                }
                            }
                        if(!empty($delete)) {
                            if($delete=='Y'){
                                echo ' | '; 
                                echo anchor(site_url('Users/delete/'.$Users->username),'<span class="btn btn-danger btn-xs glyphicon glyphicon-remove-circle"></span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                            } 
                        }
                        ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
