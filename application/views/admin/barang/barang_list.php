<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4">
            <button class="btn btn-success btn-sm" onclick="add();">Add Barang</button>
        </div>
        <div class="col-sm-8 text-right form-inline">
            <div class="input-group">
                 <input type="text" class="form-control input-sm" name="q" id="q" value="<?php echo $q; ?>" onkeyup="view(0)" >
                <span class="input-group-btn">
                    <button class="btn btn-success" onclick ="view(0)">Search</button>
                </span>
            </div>
        </div>
    </div>
    
    <table class="table table-bordered" >
        <thead>
            <tr>
                <th style="width: 10px;">No</th><th>Kode</th><th>Nama</th><th>Harga Pokok</th>
                <th>Stok</th><th>Min Stok</th>
                <th style='width:150px;'>Action</th>
            <tr>
        </thead>
        <tbody id="barang"></tbody>
        
    </table>
    <div class="row">
        <div class="col-sm-12 pull-right" style="text-align: left;">
            <div id="nav"></div>
            <div id="curidx"></div>
        </div>
    </div>
    
    <script type="text/javascript">
        view(0)

        function view(start){
            var search;
            search=document.getElementById('q').value;
            $.ajax({
                url         : "<?php echo base_url() ."barang/data?q="; ?>" + search + "&start=" +start,
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
                            + "<td>" + data[a]["start"] + "</td>"+ "<td>" + data[a]["barang_kode"] + "</td>"+ 
                            "<td>" + data[a]["barang_nama"] + "</td>"+ "<td>" + "Rp. "+ data[a]["harga_modal"] +"/"+data[a]["barang_satuan_kecil"] + "</td>"+ 
                            "<td>" +data[a]["stok_string"] + "</td><td>" +data[a]["barang_min_stok"] + " " +data[a]["barang_satuan_kecil"] +"</td>"
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
                    document.getElementById('barang').innerHTML = buatTabel;
                }
            });
        }

        function add(){
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Barang'); // Set Title to Bootstrap modal title
            $('#disablededit').show();
        }
        function hitungHPPpcs(){
            var hppSB=$('#barang_harga_pokok_baru').val();
            var konv = $('#barang_konversi').val();
            var hppSK=parseFloat(hppSB)/parseInt(konv);
            $('#barang_harga_pokok_baru_pcs').val(hppSK);
        }
        function save(){
          var url;
          url = "<?php echo site_url('barang/save')?>";

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

        function satuan(){
            sb=document.getElementById("barang_satuan_besar").value;
            sk=document.getElementById("barang_satuan_kecil").value;
            skpersb=sk +"/"+sb;
            sp="/"+sb;
            sj="/"+sk;
            document.getElementById("satuan_besar").innerHTML = sb;
            document.getElementById("satuan_kecil").innerHTML = sk;
            document.getElementById("satuan_min_stok").innerHTML = sk;
            document.getElementById("satuan_pokok").innerHTML = sp;
            document.getElementById("satuan_pokok_pcs").innerHTML = "/"+sk;
            document.getElementById("satuan_jual").innerHTML = sj;
            document.getElementById("satuan_grosir").innerHTML = sp;
            document.getElementById("satuan_konversi").innerHTML = skpersb;
            //alert("test");
        }

        function edit(id)
        {
            var url;
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo base_url() .'barang/edit'?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#barang_id').val(data.barang_id);
                    $('#barang_kode').val(data.barang_kode);
                    document.getElementById('barang_kategori_id').value = data.barang_kategori_id;
                    document.getElementById('barang_rak_id').value = data.barang_rak_id;
                    $('#barang_kategori_id').val(data.barang_kategori_id);
                    $('#barang_rak_id').val(data.barang_rak_id);
                    $('#barang_min_stok').val(data.barang_min_stok);
                    $('#barang_nama').val(data.barang_nama);
                    $('#barang_harga_pokok_lama').val(data.barang_harga_pokok_lama);
                    $('#barang_harga_pokok_baru').val(data.barang_harga_pokok_baru);
                    $('#barang_harga_jual').val(data.barang_harga_jual);
                    $('#barang_harga_grosir').val(data.barang_harga_grosir);
                    $('#barang_satuan_besar').val(data.barang_satuan_besar);
                    $('#barang_satuan_kecil').val(data.barang_satuan_kecil);
                    $('#barang_stok_besar').val(data.barang_stok_besar);
                    $('#barang_stok_kecil').val(data.barang_stok_kecil);
                    $('#barang_description').val(data.barang_description);
                    $('#barang_konversi').val(data.barang_konversi);
                    $('#barang_userinput').val(data.barang_userinput);
                    $('#disablededit').hide();
                    if(data.barang_status=='Aktif') document.getElementById("barang_status").checked = true;
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title
                    satuan();
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
                url : "<?php echo base_url() .'barang/delete';?>/"+id,
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

        function hapusHarga(id)
        {
          if(confirm('Apakah Harga Ini Akan Dihapus?'))
          {
            // ajax delete data from database
              $.ajax({
                url : "<?php echo base_url() .'barang/hapusharga';?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                   
                    a=$('#barangid').val();
                        b=$('#barang_nama').val();
                        c=$('#satuankecil').val();
                        setHarga(a,b,c)
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

          }
        }
        
        function setHarga(barangid,namabarang,satuankecil,satuanbesar){
            $.ajax({
                url         : "<?php echo base_url() ."barang/list_harga_jual/"; ?>" + barangid,
                type        : "GET",
                dataType    : "json",
                data        : {get_param : 'value'},
                success     : function(data){
                    //menghitung jumlah data
                    $('#modal_harga').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Set Harga Jual ' + namabarang); // Set title to Bootstrap modal title
                    $('#satuankecil').html(satuankecil)
                    jmlData = data.length;
                    
                    //variabel untuk menampung tabel yang akan digenerasikan
                    buatTabel = "";
                    
                    for(a = 0; a < jmlData; a++){
                        
                        //mencetak baris baru
                        buatTabel += "<tr>"
                            //membuat penomoran
                            + "<td>Rp. " + data[a]["harga_jual"] + "</td>"+ 
                            "<td>Per " + data[a]["satuan"] + "</td>"+ 
                            "<td>" + data[a]["jml_item_perpcs"] +" "+satuankecil + "</td>"+
                            "<td style='width=100px;'><button class='btn btn-danger btn-sm' type='button'><span class='fa fa-remove' onclick='hapusHarga(\""+data[a]['idx']+"\")'></span></button></td>"
                        + "<tr/>";
                    }
                    buatTabel += "<tr>"
                            //membuat penomoran
                            + "<td><input type='hidden' name='barang_id' id='barangid' class='form-control' value='"+barangid+"'>"+
                            "<input type='hidden' name='barang_nama' id='barang_nama' class='form-control' value='"+namabarang+"'>"+
                            "<input type='hidden' name='satuankecil' id='satuankecil' class='form-control' value='"+satuankecil+"'>"+
                            "<input type='text' name='hjual' id='hjual' class='form-control'></td>"+ 
                            "<td><input type='text' name='satuan' id='satuan' class='form-control'></td>"+ 
                            "<td><input type='text' name='jml_item_perpcs' id='jml_item_perpcs' class='form-control'></td>"+
                            "<td style='width=100px;'><button class='btn btn-primary btn-sm' type='button'><span class='fa fa-plus' onclick='addHarga()'></span></button></td>"
                        + "<tr/>";
                    $('#list-hjual').html(buatTabel);
                   
                }
            });
        }
        function addHarga(){
            var url;
            url = "<?php echo site_url('barang/addharga')?>";

            // ajax adding data to database
                $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#form1').serialize(),
                    dataType: 'JSON',
                    success: function(data)
                    {
                        alert(data.message)
                        a=$('#barangid').val();
                        b=$('#barang_nama').val();
                        c=$('#satuankecil').val();
                        setHarga(a,b,c)
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert(url);
                    }
                });
        }
    </script>

    <!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo base_url() ."barang/save"; ?>" method="post" id="form" class="form-horizontal" enctype='multipart/form-data'> 
                    <div class="modal-header bg-green">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Barang</h3>
                    </div>

                    <div class="modal-body form">
                            <input type="hidden" class="form-control input-sm" name="barang_id" id="barang_id" placeholder="Barang Id" value="" />
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Kode</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" name="barang_kode" id="barang_kode" placeholder="Barang Kode" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Kategori</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control input-sm" name="barang_kategori_id" id="barang_kategori_id" placeholder='Barang Kategori Id'>
                                        <?php 
                                        foreach ($list_kategori as $list) {
                                        ?>
                                        <option value='<?php echo $list->kategori_id; ?>'><?php echo $list->kategori_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                                </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Rak</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control input-sm" name="barang_rak_id" id="barang_rak_id" placeholder='Barang Rak Id'>
                                        <?php 
                                        foreach ($list_rak as $list) {
                                        ?>
                                        <option value='<?php echo $list->rak_id; ?>'><?php echo $list->rak_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Nama</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" name="barang_nama" id="barang_nama" placeholder="Barang Nama" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Keterangan</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="barang_description" id="barang_description" class="form-control" cols="30" rows="5"></textarea>
                                    
                                </div>
                            </div>
                            <input type="hidden" class="form-control input-sm" name="barang_harga_pokok_lama" id="barang_harga_pokok_lama" placeholder="Barang Harga Pokok Lama" value="" />
                            <div id="disablededit">    
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Satuan</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control input-sm" name="barang_satuan_besar" id="barang_satuan_besar" placeholder="Satuan Besar" value="" onkeyup="satuan()" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-sm" name="barang_satuan_kecil" id="barang_satuan_kecil" placeholder="Satuan Kecil" value="" onkeyup="satuan()" />
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Konversi</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control input-sm" name="barang_konversi" id="barang_konversi" placeholder="Konversi" value="" onkeyup="satuan()" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label id="satuan_konversi">Pcs/kodi</label></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Harga Pokok</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control input-sm" name="barang_harga_pokok_baru" id="barang_harga_pokok_baru" placeholder="Barang Harga Pokok Baru" value="" onkeyup="hitungHPPpcs()"/>
                                    </div>
                                    <div class="col-md-1" style="padding: 0px;"><label id="satuan_pokok"></label></div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control input-sm" name="barang_harga_pokok_baru_pcs" id="barang_harga_pokok_baru_pcs" placeholder="Barang Harga Pokok Baru" value="" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label id="satuan_pokok_pcs"></label></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Harga Jual Ecer</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control input-sm" name="barang_harga_jual" id="barang_harga_jual" placeholder="Harga Jual" value="" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label id="satuan_jual"></label></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Harga Jual Grosir</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control input-sm" name="barang_harga_grosir" id="barang_harga_grosir" placeholder="Harga grosir" value="" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label id="satuan_grosir"></label></div>
                                </div>

                                <!--div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Diskon</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control input-sm" name="barang_diskon" id="barang_diskon" placeholder="Diskon" value="" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label> %</label></div>
                                </div-->
                                
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="varchar">Stok</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control input-sm" name="barang_stok_besar" id="barang_stok_besar" placeholder="Satuan Besar" value="" onkeyup="satuan()" />
                                    </div>
                                    <div class="col-md-1" style="padding: 0px;" id="satuan_besar"><label>Kodi</label></div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control input-sm" name="barang_stok_kecil" id="barang_stok_kecil" placeholder="Stok Kecil" value="" onkeyup="satuan()" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0px;"><label id="satuan_kecil">Pcs</label></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Min Stok</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control input-sm" name="barang_min_stok" id="barang_min_stok" placeholder="Min Stok" value="" onkeyup="satuan()" />
                                </div>
                                <div class="col-md-2" style="padding: 0px;"><label id="satuan_min_stok">Pcs</label></div>
                            </div>
                            
                            
                            <input type="hidden" class="form-control input-sm" name="barang_userinput" id="barang_userinput" placeholder="Barang Userinput" value="" />
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">&nbsp;</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="checkbox" name="barang_status" id="barang_status" value="Aktif" />Barang Status
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <!--button type="button" id="btnSave" onclick="save()" class="btn btn-success">Save</button-->
                        <button type="submit" id="btnSave" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

    <!--Modal-->
    <div class="modal fade" id="modal_harga" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                    <div class="modal-header bg-green">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Barang</h3>
                    </div>

                    <div class="modal-body form">
                    <form action="#" method="post" id="form1" class="form-horizontal" enctype='multipart/form-data'> 
                        
                        <table class="table">
                            <tr>
                                <td>Harga</td>
                                <td>Satuan</td>
                                <td>Konversi (<span id='satuankecil'></span>)</td>
                                <td>#</td>
                            </tr>
                            <tbody id='list-hjual'></tbody>
                        </table>
                    </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
            </div>
        </div><!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--========================================================================================================
End of file barang_list.php 
Location: ./application/views/barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->