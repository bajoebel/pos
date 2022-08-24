
<form action="<?php echo $action; ?>" method="post" enctype='multipart/form-data'> 
    
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Nama Lengkap</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="user_nama_lengkap" id="user_nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $user_nama_lengkap; ?>" />
                <?php echo form_error('user_nama_lengkap') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Jekel</label>
            </div>
            <div class="col-md-9">
                <select class="form-control" name="user_jekel" id="user_jekel " placeholder='Jekel'>
                        <option value='Laki-Laki' <?php if($user_jekel=="Laki-Laki") echo "selected" ?>>Laki-Laki</option>
                        <option value='Perempuan' <?php if($user_jekel=="Perempuan") echo "selected" ?>>Perempuan</option>
                </select>
                <?php echo form_error('user_jekel') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Alamat</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="user_alamat" id="user_alamat" placeholder="Alamat" value="<?php echo $user_alamat; ?>" />
                <?php echo form_error('user_alamat') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Email</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="user_email" id="user_email" placeholder="Email" value="<?php echo $user_email; ?>" />
                <?php echo form_error('user_email') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Kontak</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="user_kontak" id="user_kontak" placeholder="Kontak" value="<?php echo $user_kontak; ?>" />
                <?php echo form_error('user_kontak') ?>
            </div>
        </div>
    </div>
    <?php if(empty($username)) { ?>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Username</label>
            </div>
            <div class="col-md-9">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                <?php echo form_error('username') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Password</label>
            </div>
            <div class="col-md-9">
                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password" value="<?php echo $user_password; ?>" />
                <?php echo form_error('user_password') ?>
            </div>
        </div>
    </div>
    <?php } else{ ?>
    <input type="hidden" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
    <input type="hidden" class="form-control" name="user_password" id="user_password" placeholder="Password" value="<?php echo $user_password; ?>" />
    <?php } ?>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Group</label>
            </div>
            <div class="col-md-9">
                <select class="form-control" name="user_group_id" id="user_group_id " placeholder='Group Id'>
                    <?php 
                    foreach ($list_pmi_group as $list) {
                    ?>
                    <option value='<?php echo $list->group_id; ?>' <?php if ($list->group_id==$user_group_id) echo 'selected'; ?>><?php echo $list->group_name; ?></option>
                    <?php
                    }
                    ?>
                    
                </select>
                <?php echo form_error('user_group_id') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">&nbsp;</label>
            </div>
            <div class="col-md-9">
                <input type="checkbox" name="admin" value="Y" <?php if($admin=="Y") echo "checked"; ?>/>Admin
                <?php echo form_error('admin') ?>
                <input type="checkbox" name="user_status" value="Aktif" <?php if($user_status=="Aktif") echo "checked"; ?>/>Status
                <?php echo form_error('user_status') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">   
        <div class="form-group">
            <div class="col-md-3">
                <label for="varchar">Foto</label>
            </div>
            <div class="col-md-9">
                <input type="hidden" class="form-control" name="user_photo" id="user_photo" placeholder="User Photo" value="<?php echo $user_photo; ?>" />
                <input type="file" name="userfile">
                <?php echo form_error('user_photo') ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-9 pull-right">    
                <button type="submit" class="btn btn-danger">
                    <?php echo $button ?>
                </button> 
                <a href="<?php echo site_url('Users') ?>" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>
