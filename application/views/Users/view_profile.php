<?php if(!empty($this->session->userdata('username'))){?>
<div class="col-sm-3 col-sm-12">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Foto</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div style="text-align: center; border-style: solid;border-radius: 5px; border-width: 1px;padding: 2px;">
        <img src="<?php if(!empty($user_photo)) echo base_url() ."upload/user/thumb/" .$user_photo; else echo base_url() ."images/default.jpg"; ?>">
        
      </div>
      <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#upload">Upload</a>
    </div>
  </div>
</div>
<div class="col-sm-9 col-sm-12">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">User Form</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form method="post" action='<?php echo base_url(); ?>profile/save'>
        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >User Fullname</label>
            <div class="col-sm-9 col-xs-12">
              <input type=text name='user_nama_lengkap' class="form-control input-sm" value="<?php if(!empty($user_nama_lengkap)) echo $user_nama_lengkap; ?>" required>
            </div>
          </div>
        </div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >User Email</label>
            <div class="col-sm-9 col-xs-12">
              <input type=text name='user_email' class="form-control input-sm" value="<?php if(!empty($user_email)) echo $user_email; ?>" required>
            </div>
          </div>
        </div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >User Telp</label>
            <div class="col-sm-9 col-xs-12">
              <input type=text name='user_kontak' class="form-control input-sm" value="<?php if(!empty($user_kontak)) echo $user_kontak; ?>" required>
            </div>
          </div>
        </div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >User Address</label>
            <div class="col-sm-9 col-xs-12">
            <textarea name="user_alamat" class="form-control input-sm"><?php if(!empty($user_alamat)) echo $user_alamat; ?></textarea>
            </div>
          </div>
        </div>

        <div class='form-group'>
          <label class="col-sm-3 control-label" ></label>
          <div class="col-sm-9"><p align="right">
            <input class='btn btn-primary input-sm' type=submit value=Save>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Change Password</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form method="post" action='<?php echo base_url(); ?>profile/change_password'>
        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Old Password</label>
            <div class="col-sm-9 col-xs-12">
              <input type=password name='old_password' class="form-control input-sm" value="" required>
            </div>
          </div>
        </div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >New Password</label>
            <div class="col-sm-9 col-xs-12">
              <input type=password name='new_password' class="form-control input-sm" value="" required>
            </div>
          </div>
        </div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Retype Password</label>
            <div class="col-sm-9 col-xs-12">
              <input type=password name='retype_password' class="form-control input-sm" value="" required>
            </div>
          </div>
        </div>

        <div class='form-group'>
          <label class="col-sm-3 control-label" ></label>
          <div class="col-sm-9"><p align="right">
            <input class='btn btn-primary input-sm' type=submit value='Change Password'>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="upload" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Foto</h4>
              </div>
              <div class="modal-body">
              
                <div class="row">
                  <form method="post" action="<?php echo base_url() ."profile/upload_foto"; ?>" enctype="multipart/form-data">
                    <div class="col-md-12">
                      
                      <div class="form-group">
                        <input type="file" name="userfile">
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <input type="submit" name="upload" class="btn btn-primary fa fa-upload" value="Upload">
                        
                      </div>
                    </div>
                  </form>
                  
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
<?php }else{
  $this->load->view('access_denied');
} ?>