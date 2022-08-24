<div class="col-sm-12">
    <div class="row">
        <div class="col-md-10">
        <?php $INFO=AUTHORITY::validateKey(KEY_INFO);  ?>
                    <h3>Laporan Data Barang Rusak <?= $INFO['data']->nama_toko?></h3>
                    <h4><?= $INFO['data']->alamat ." " .$INFO['data']->telp ?></h4>
                    <h5>Tanggal <?php echo date('d M Y') ?></h5>
            
        </div>
        <div class="col-md-2 ">
            <div class="pull-right">
                <a href="<?php echo base_url() ."laporan/barang_rusak/print" ?>" class="btn btn-default btn-xs" target="_blank"><span class="fa fa-print"></span></a>
                <a href="<?php echo base_url() ."laporan/barang_rusak/pdf" ?>" class="btn btn-danger btn-xs" target="_blank"><span class="fa fa-file-pdf-o"></span></a>
                <a href="<?php echo base_url() ."laporan/barang_rusak/excel" ?>" class="btn btn-success btn-xs" target="_blank"><span class="fa fa fa-file-excel-o"></span></a>
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="col-md-12" style="border-top:double #000; border-collapse: collapse;border-width: 1px">&nbsp;</div>
        </div>
        
        <p>&nbsp;</p>
        
    </div>
    
    <table class="table table-bordered" >
        <thead class="bg-green">
            <tr>
                <th style="width: 10px;">No</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Jumlah</th>
            <tr>
        </thead>
        <tbody id="">
            <?php 
            $start=0;
            foreach ($barang_data as $b) {
                $start++;
                echo "
                <tr>
                    <td style=\"width: 10px;\">" .$start ."</td><td>" .$b->barang_kode ."</td><td>" .$b->barang_nama ."</td><td>" .$b->kategori_nama ."</td><td>" .$b->jumlah ." " .$b->barang_satuan_kecil ."</td>
                <tr>";
            }
            ?>
        </tbody>
        
    </table>
    <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-default">Total Record : <?php echo $total_rows ?></a>
                <?php 
                if(!empty($report)) {
                    if($report=='Y'){ 
                        echo anchor(site_url('Banner/report'), 'Report', 'class="btn btn-success"'); 
                    } 
                }
                ?>    
            </div>

            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
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
                            + "<td>" + data[a]["start"] + "</td>"+ "<td>" + data[a]["barang_kode"] + "</td>"+ "<td>" + data[a]["barang_nama"] + "</td>"+ "<td>" + "Rp. "+ data[a]["barang_harga_pokok_baru"] +"/"+data[a]["barang_satuan_kecil"] + "</td>"+ "<td> Rp. " + data[a]["barang_harga_jual"] +"/" +data[a]["barang_satuan_kecil"] + "</td>"+ "<td>" + data[a]["barang_stok_besar"] + " " + data[a]["barang_satuan_besar"] +" " + data[a]["barang_stok_kecil"] +" " +data[a]["barang_satuan_kecil"] + "</td>"
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
            document.getElementById("satuan_pokok").innerHTML = sp;
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
                    $('#barang_nama').val(data.barang_nama);
                    $('#barang_description').val(data.barang_description);
                    $('#barang_harga_pokok_lama').val(data.barang_harga_pokok_lama);
                    $('#barang_harga_pokok_baru').val(data.barang_harga_pokok_baru);
                    $('#barang_harga_jual').val(data.barang_harga_jual);
                    $('#barang_harga_grosir').val(data.barang_harga_grosir);
                    $('#barang_satuan_besar').val(data.barang_satuan_besar);
                    $('#barang_satuan_kecil').val(data.barang_satuan_kecil);
                    $('#barang_stok_besar').val(data.barang_stok_besar);
                    $('#barang_stok_kecil').val(data.barang_stok_kecil);
                    $('#barang_diskon').val(data.barang_diskon);
                    $('#barang_konversi').val(data.barang_konversi);
                    $('#barang_image').val(data.barang_image);
                    $('#barang_userinput').val(data.barang_userinput);
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
        
    </script>

    <!--Modal-->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
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
                                    <label for="varchar">Description</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control input-sm" name="barang_description" id="barang_description" placeholder="Barang Description" value="" />
                                </div>
                            </div>
                            <input type="hidden" class="form-control input-sm" name="barang_harga_pokok_lama" id="barang_harga_pokok_lama" placeholder="Barang Harga Pokok Lama" value="" />
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Satuan</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control input-sm" name="barang_satuan_besar" id="barang_satuan_besar" placeholder="Satuan Besar" value="" onkeypress="satuan()" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control input-sm" name="barang_satuan_kecil" id="barang_satuan_kecil" placeholder="Satuan Kecil" value="" onkeypress="satuan()" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Harga Pokok</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="form-control input-sm" name="barang_harga_pokok_baru" id="barang_harga_pokok_baru" placeholder="Barang Harga Pokok Baru" value="" />
                                </div>
                                <div class="col-md-2" style="padding: 0px;"><label id="satuan_pokok"></label></div>
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

                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Diskon</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control input-sm" name="barang_diskon" id="barang_diskon" placeholder="Diskon" value="" />
                                </div>
                                <div class="col-md-2" style="padding: 0px;"><label> %</label></div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Stok</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control input-sm" name="barang_stok_besar" id="barang_stok_besar" placeholder="Satuan Besar" value="" onkeypress="satuan()" />
                                </div>
                                <div class="col-md-1" style="padding: 0px;" id="satuan_besar"><label>Kodi</label></div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control input-sm" name="barang_stok_kecil" id="barang_stok_kecil" placeholder="Stok Kecil" value="" onkeypress="satuan()" />
                                </div>
                                <div class="col-md-2" style="padding: 0px;"><label id="satuan_kecil">Pcs</label></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Konversi</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" class="form-control input-sm" name="barang_konversi" id="barang_konversi" placeholder="Konversi" value="" onkeypress="satuan()" />
                                </div>
                                <div class="col-md-2" style="padding: 0px;"><label id="satuan_konversi">Pcs/kodi</label></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="varchar">Image</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="hidden" class="form-control input-sm" name="barang_image" id="barang_image" placeholder="Barang Image" value="" />
                                    <input type="file" name="userfile">
                                </div>
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
</div>
<!--========================================================================================================
End of file barang_list.php 
Location: ./application/views/barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->