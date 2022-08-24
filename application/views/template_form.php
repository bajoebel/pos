<?php if($priv_count>0){?>
<div class="box box-default">
    <div class="box-header with-border bg-green">
        <h3 class="box-title"> <?php echo $title; ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>

    <div class="box-body">
        <div class='row'>
            <?php if(!empty($isi)) echo $isi; ?>
        </div>
    </div>
    
</div>
<?php }else{
  $this->load->view('access_denied');
} ?>
