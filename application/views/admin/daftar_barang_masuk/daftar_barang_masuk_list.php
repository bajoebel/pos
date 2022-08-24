<?php 
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-2"><a href="<?php echo base_url()."pembelian_barang"; ?>" class="btn btn-success">Add Barang Masuk</a></div>
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
                <th style="width: 10px;">No</th><th>Nofaktur</th><th>Pemasok</th><th>Tanggal</th><th>Total Transaksi</th><th>Userinput</th>
                <th style='width:100px;'>Action</th>
            <tr>
        </thead>
        <tbody id="daftar_barang_masuk"></tbody>
        
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
                url         : "<?php echo base_url() ."daftar_barang_masuk/data?q="; ?>" + search + "&start=" +start,
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
                            + "<td>" + data[a]["start"] + "</td>"+ "<td>" + data[a]["masuk_nofaktur"] + "</td>"+ "<td>" + data[a]["pemasok_nama"] + "</td>"+ "<td>" + data[a]["masuk_tanggal"] + "</td>"+ "<td>Rp. " + data[a]["total_transaksi"] + "</td>"+ "<td>" + data[a]["masuk_userinput"] + "</td>"
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
                    document.getElementById('daftar_barang_masuk').innerHTML = buatTabel;
                }
            });
        }

        function add(){
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Daftar_barang_masuk'); // Set Title to Bootstrap modal title
        }

        function save(){
          var url;
          url = "<?php echo site_url('daftar_barang_masuk/save')?>";

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
                url : "<?php echo base_url() .'daftar_barang_masuk/edit'?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#masuk_id').val(data.masuk_id);
                    $('#masuk_nofaktur').val(data.masuk_nofaktur);
                    $('#masuk_pemasok_id').val(data.masuk_pemasok_id);
                    $('#masuk_tanggal').val(data.masuk_tanggal);
                    $('#masuk_tutup_buku').val(data.masuk_tutup_buku);
                    $('#masuk_userinput').val(data.masuk_userinput);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Barang Masuk'); // Set title to Bootstrap modal title
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
                url : "<?php echo base_url() .'daftar_barang_masuk/delete';?>/"+id,
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
                    <h3 class="modal-title">Daftar_barang_masuk</h3>
                </div>

                <div class="modal-body form">
                    <form action="#" method="post" id="form" class="form-horizontal"> 
                        <input type="hidden" class="form-control" name="masuk_id" id="masuk_id" placeholder="Id" value="" />
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Nofaktur</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="masuk_nofaktur" id="masuk_nofaktur" placeholder="Nofaktur" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Pemasok Id</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="masuk_pemasok_id" id="masuk_pemasok_id" placeholder="Pemasok Id" value="" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Tanggal</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name='masuk_tanggal' class="form-control pull-right" id="datepicker" value="" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="varchar">Tutup Buku</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" name="masuk_tutup_buku" id="masuk_tutup_buku " placeholder='Tutup Buku'>
                                        <option value='Sudah'>Sudah</option>
                                        <option value='Belum'>Belum</option>
                                </select>
                            </div>
                            </div>
                        <input type="hidden" class="form-control" name="masuk_userinput" id="masuk_userinput" placeholder="Userinput" value="" />
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
End of file daftar_barang_masuk_list.php 
Location: ./application/views/daftar_barang_masuk_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 06 Nov 2017 09:01:08 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->