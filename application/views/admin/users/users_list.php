<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4">
            <button class="btn btn-success btn-sm" onclick="add();">Add Users</button>
        </div>
        <div class="col-sm-8 text-right form-inline">
            <div class="input-group">
                 <input type="text" class="form-control" name="q" id="q" value="<?php echo $q; ?>" onkeypress="view(0)" >
                <span class="input-group-btn">
                    <button class="btn btn-success" onclick ="view(0)">Search</button>
                </span>
            </div>
        </div>
    </div>
    
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th style="width: 10px;">No</th><th>User Nama Lengkap</th><th>User Jekel</th><th>User Alamat</th><th>User Email</th><th>User Kontak</th><th>User Status</th>
                <th style='width:100px;'>Action</th>
            <tr>
        </thead>
        <tbody id="users"></tbody>
        
    </table>
    <div class="row">
        <div class="col-sm-12 pull-right" style="text-align: left;">
            <div id="nav"></div>
            <div id="curidx"></div>
        </div>
    </div>
    
    <script type="text/javascript">
        window.onload(view(0));

        function view(start){
            var search;
            search=document.getElementById('q').value;
            $.ajax({
                url         : "<?php echo base_url() ."users/data?q="; ?>" + search + "&start=" +start,
                type        : "GET",
                dataType    : "json",
                data        : {get_param : 'value'},
                success     : function(data){
                    //menghitung jumlah data
                    jmlData = data.length;
                    
                    //variabel untuk menampung tabel yang akan digenerasikan
                    buatTabel = "";
                    pagination="";
                    row=0;
                    limit=0;
                    start=0;
                    pagination_count=0;
                    idx=0;
                    cur_idx=0;
                    next=limit;
                    prev=0;
                    //perulangan untuk menayangkan data dalam tabel
                    for(a = 1; a < jmlData; a++){
                        
                        //mencetak baris baru
                        buatTabel += "<tr>"
                            //membuat penomoran
                            + "<td>" + data[a]["start"] + "</td>"+ "<td>" + data[a]["user_nama_lengkap"] + "</td>"+ "<td>" + data[a]["user_jekel"] + "</td>"+ "<td>" + data[a]["user_alamat"] + "</td>"+ "<td>" + data[a]["user_email"] + "</td>"+ "<td>" + data[a]["user_kontak"] + "</td>"+ "<td>" + data[a]["user_status"] + "</td>"
                            + "<td style='width=100px;'>" + data[a]["aksi"] + "</td>"
                        + "<tr/>";
                        row=data[a]['row_count'];
                        limit=data[a]['limit'];
                        start=data[a]['start'];
                    }

                    pagination_count=row/limit;
                    sisa=start%limit;
                    cur_idx=start/limit;
                    cur_idx=Math.ceil(cur_idx);
                    prev=(cur_idx-2) * limit;
                    next=(cur_idx) * limit;
                    paging=Math.ceil(pagination_count);
                    if(cur_idx<=2) {
                        min=0; 
                        max=3;
                    }else {
                        min=cur_idx-2;
                        max=cur_idx+2;
                    }
                    for(i=0;i<paging;i++){
                        active='';
                        num=i+1;
                        if(i==0){
                            pagination+="<nav><ul class='pagination' style='margin-top:0px'><li><a href='#' class='btn btn-primary' >Record Count : " + row + "</a></li><li " + active + "><a href='#'  onclick='view(" + idx +")'>First</a></li>";
                            if(next<=row-sisa) pagination+="<li " + active + "><a href='#' onclick='view(" + next + ")'>Next</a></li>";
                            if(num==cur_idx) active="class='active'"; else active="";
                            pagination+="<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";      
                        }else if (i>0 && i<paging-1) {
                            if(num>=min && num<=max){
                                idx=limit*i;
                                if(num==cur_idx) active="class='active'"; else active="";
                                pagination+="<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
                            }
                            
                        }else{
                            idx=limit*i;
                            if(num==cur_idx) active="class='active'"; else active="";
                            pagination=pagination +"<li "+ active +"><a href='#' onclick='view(" + idx + ")'>" + num +"</a></li>"; 
                            if(prev>=0) pagination+="<li><a href='#' onclick='view(" + prev  + ")'>Prev</a></li>";
                            pagination+="<li><a href='#' onclick='view(" +idx + ")'>Last</a></li></ul></nav>";
                        }
                        if(idx==cur_idx) active="class='active'"; else active="";
                    }
                    document.getElementById("nav").innerHTML = pagination;
                    document.getElementById('users').innerHTML = buatTabel;
                }
            });
        }

        function add(){
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Users'); // Set Title to Bootstrap modal title
            document.getElementById('username').readOnly = false;
            document.getElementById('user_password').disabled = false;
            $('#method').val(save_method);
        }

        function save(){
          var url;
          url = "<?php echo site_url('users/save')?>";

           // ajax adding data to database
              $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: function(data)
                {
                   //if success close modal and reload ajax table
                   $('#modal_form').modal('hide');
                  location.reload();// for reload a page
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(url);
                }
            });
        }

        function edit(id)
        {
            var url;
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo base_url() .'users/edit'; ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#username').val(data.username);
                    $('#method').val(save_method);
                    $('#user_password').val(data.user_password);
                    $('#user_nama_lengkap').val(data.user_nama_lengkap);
                    $('#user_jekel').val(data.user_jekel);
                    $('#user_alamat').val(data.user_alamat);
                    $('#user_email').val(data.user_email);
                    $('#user_kontak').val(data.user_kontak);
                    if(data.user_status=='Aktif') document.getElementById("user_status").checked = true;
                    $('#user_photo').val(data.user_photo);
                    if(data.admin=='Y') document.getElementById("admin").checked = true;
                    $('#user_group_id').val(data.user_group_id);
                    document.getElementById('username').readOnly = true;
                    document.getElementById('user_password').disabled = true;
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus);
                }
            });
        }

        function remove(id)
        {
          if(confirm('Are you sure delete this data?'))
          {
            // ajax delete data from database
              $.ajax({
                url : "<?php echo base_url() .'users/delete';?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                   
                   location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

          }
        }
        
    </script>

    <!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Users</h3>
                </div>
                <form action="<?php echo base_url()."users/save"; ?>" method="post" id="form" class="form-horizontal" enctype='multipart/form-data'> 
                    <div class="modal-body form">
                        <input type="hidden" name="method" id="method" value="">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Username</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="User Password" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Nama Lengkap</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_nama_lengkap" id="user_nama_lengkap" placeholder="User Nama Lengkap" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Jekel</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control" name="user_jekel" id="user_jekel " placeholder='User Jekel'>
                                                <option value='Laki-Laki'>Laki-Laki</option>
                                                <option value='Perempuan'>Perempuan</option>
                                        </select>
                                    </div>
                                    </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Alamat</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_alamat" id="user_alamat" placeholder="User Alamat" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_email" id="user_email" placeholder="User Email" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Kontak</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_kontak" id="user_kontak" placeholder="User Kontak" value="" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Group Id</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control" name="user_group_id" id="user_group_id " placeholder='User Group Id'>
                                            <?php 
                                            foreach ($list_group as $list) {
                                            ?>
                                            <option value='<?php echo $list->group_id; ?>'><?php echo $list->group_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">User Photo</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="userfile" placeholder="User Photo" />
                                        <input type="hidden" name="user_photo" placeholder="User Photo" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">&nbsp;</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="user_status" id="user_status" value="Aktif" />User Status
                                        <input type="checkbox" name="admin" id="admin" value="Y" />Admin
                                    </div>
                                </div>  
                                
                            
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="btnSave"  class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--========================================================================================================
End of file users_list.php 
Location: ./application/views/users_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 20 Oct 2017 09:20:52 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->