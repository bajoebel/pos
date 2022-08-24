<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4">
            <button class="btn btn-success btn-sm" onclick="add();">Add Transaksi</button>
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
        <thead style="">
            <tr>
                <th style="width: 10px;" rowspan="2">No</th>
                <th rowspan="2">Akun</th>
                <th colspan="2">Jumlah</th>
                <th rowspan="2">Catatan</th>
                <th rowspan="2">Tglinput</th>
                <th rowspan="2">Userinput</th>
                <th style='width:100px;' rowspan="2">Action</th>
            </tr>
            <tr>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody id="transaksi"></tbody>
        
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
                url         : "<?php echo base_url() ."transaksi/data?q="; ?>" + search + "&start=" +start,
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
                        if(data[a]["akun_jenis"]=='Kredit'){
                            kredit=data[a]["transaksi_jumlah"];
                            debet=0;
                        }else{
                            kredit=0;
                            debet=data[a]["transaksi_jumlah"];
                        }
                        //mencetak baris baru
                        buatTabel += "<tr>"
                            //membuat penomoran
                            + "<td>" + data[a]["start"] + "</td>"+ "<td>" + data[a]["akun_nama"] + "</td>"+ "<td>Rp. " + debet + "</td>"+ "<td>Rp. " + kredit + "</td>"+ "<td>" + data[a]["transaksi_catatan"] + "</td>"+ "<td>" + data[a]["transksi_tglinput"] + "</td>"+ "<td>" + data[a]["transksi_userinput"] + "</td>"
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
                    document.getElementById('transaksi').innerHTML = buatTabel;
                }
            });
        }

        function add(){
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Transaksi'); // Set Title to Bootstrap modal title
        }

        function save(){
          var url;
          url = "<?php echo site_url('transaksi/save')?>";

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
                url : "<?php echo base_url() .'transaksi/edit'?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#transaksi_id').val(data.transaksi_id);
                    $('#transaksi_akun_id').val(data.transaksi_akun_id);
                    $('#transaksi_jumlah').val(data.transaksi_jumlah);
                    $('#transaksi_catatan').val(data.transaksi_catatan);
                    $('#transksi_tglinput').val(data.transksi_tglinput);
                    $('#transaksi_tglupdate').val(data.transaksi_tglupdate);
                    $('#transksi_userinput').val(data.transksi_userinput);
                    $('#transaksi_userupdate').val(data.transaksi_userupdate);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Provinsi'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert(errorThrown);
                }
            });
        }

        function remove(id)
        {
          if(confirm('Are you sure delete this data?'))
          {
            // ajax delete data from database
              $.ajax({
                url : "<?php echo base_url() .'transaksi/delete';?>/"+id,
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
                    <h3 class="modal-title">Transaksi</h3>
                </div>

                <div class="modal-body form">
                    <form action="#" method="post" id="form" class="form-horizontal"> 
                        <input type="hidden" class="form-control" name="transaksi_id" id="transaksi_id" placeholder="Id" value="" />
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Akun</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="transaksi_akun_id" id="transaksi_akun_id " placeholder='Akun Id'>
                                    <?php 
                                    foreach ($list_akun as $list) {
                                    ?>
                                    <option value='<?php echo $list->akun_id; ?>'><?php echo $list->akun_nama; ?></option>
                                    <?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Jumlah</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="transaksi_jumlah" id="transaksi_jumlah" placeholder="Jumlah" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Catatan</label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="transaksi_catatan" id="transaksi_catatan" placeholder="Catatan"></textarea>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="transksi_tglinput" id="transksi_tglinput" placeholder="Transksi Tglinput" value="" />
                        <input type="hidden" class="form-control" name="transaksi_tglupdate" id="transaksi_tglupdate" placeholder="Tglupdate" value="" />
                        <input type="hidden" class="form-control" name="transksi_userinput" id="transksi_userinput" placeholder="Transksi Userinput" value="" />
                        <input type="hidden" class="form-control" name="transaksi_userupdate" id="transaksi_userupdate" placeholder="Userupdate" value="" />
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--========================================================================================================
End of file transaksi_list.php 
Location: ./application/views/transaksi_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 05 Dec 2017 11:27:40 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->