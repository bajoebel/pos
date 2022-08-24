
<div class="col-sm-12 col-xs-12" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php 
        if(!empty($add)) {
            if($add=='Y'){
                echo anchor(site_url('Users/add'),'<span class="fa fa-plus-circle"></span> Add', 'class="btn btn-danger "'); 
            }
        }
        ?>
    </div>
    
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    
    <div class="col-md-1 text-right"></div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('Users/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php 
                    if ($q <> '')
                    {
                    ?>
                    <a href="<?php echo site_url('Users'); ?>" class="btn btn-default">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-danger" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>

    <div class="col-sm-12 col-xs-12" style="overflow-x:auto;">
        <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>User Nama Lengkap</th>
            <th>User Jekel</th>
            <th>User Alamat</th>
            <th>User Email</th>
            <th>User Kontak</th>
            <th>User Status</th>
            <th>User Group Id</th>
            <th>Action</th>
        </tr>
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
            echo anchor(site_url('Users/update/'.$Users->username),'<span class="btn btn-primary btn-xs glyphicon glyphicon-edit"></span>'); 
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
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-default">Total Record : <?php echo $total_rows ?></a>
                <?php 
                if(!empty($report)) {
                    if($report=='Y'){ 
                        echo anchor(site_url('Users/report'), 'Report', 'class="btn btn-success"'); 
                    } 
                }
                ?>    
            </div>

            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </div>
</div>