<style type="text/css">
    .baris {
        border-bottom: dotted #00a65a;
        border-width: 1px;
    }

    .pull-right {
        text-align: right;
    }
</style>
<div class="col-sm-12">
    <form action="#" method="POST" id="form">
        <div class="row">
            <div class="col-md-4" style="border-right: solid #00a65a; border-width: 1px;">

                <div class="box box-default">
                    <!--================================================================================================
                    List Master Pembelian
                    =================================================================================================-->
                    <div class="box-header with-border bg-green">
                        <h3 class="box-title"> Transaksi</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Nofaktur</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="masuk_nofaktur" id="masuk_nofaktur" placeholder="Masuk Nofaktur" value="" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Tanggal Masuk</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name='masuk_tanggal' class="form-control pull-right datepicker" id="datepicker" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Cara Bayar</label>
                                </div>
                                <div class="col-md-12">

                                    <select class="form-control input-sm select2" name="cara_bayar" id="cara_bayar" placeholder='Pemasok'>

                                        <option value="Tunai">Tunai</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-default">
                    <!--================================================================================================
                    Data Pemasok
                    =================================================================================================-->
                    <div class="box-header with-border bg-green">
                        <h3 class="box-title"> Pemasok</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Pemasok</label>
                                </div>
                                <div class="col-md-12">

                                    <select class="form-control input-sm select2" name="masuk_pemasok_id" id="masuk_pemasok_id" onchange="add_pemasok()" placeholder='Pemasok'>
                                        <?php
                                        foreach ($list_pemasok as $list) {
                                        ?>
                                            <option value='<?php echo $list->pemasok_id; ?>'><?php echo $list->pemasok_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="New">Add new</option>
                                    </select>
                                </div>
                                <div id="pemasok">


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--div class="box box-default">
                    <div class="box-header with-border bg-green">
                        <h3 class="box-title"> Keranjang</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div id="detail"></div>
                            <div id="totalharga"></div>
                        </div>

                    </div>   
                </div-->

                <a href="<?php echo base_url() . "pembelian_barang/histori" ?>" class="btn btn-success btn-block">Lihat Histori</a>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" onclick="view(0)">Search</button>
                        
                    </span>
                </div>

                <!--====================================================================================================
            List Data Barang
            =====================================================================================================-->
                <!--div class="box box-default">
                <div class="box-header with-border bg-green">
                    <h3 class="box-title"> List Data Barang</h3>
                </div>

                <div class="box-body">
                    <div class='row'>
                        <div id="barang"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="nav"></div>
                        </div>
                    </div>
                </div>
                
            </div-->
                <!--div id="search_barang" style="display: none;">
                    <div id="barang"></div>
                    <div class="col-md-12" id="nav"></div>
                </div-->
                <div id="tambah-barang" style='display:none'>
                <div id="priview_barang"></div>
                </div>

                <div id="detail-temp">
                <div id="temp"></div>
                <hr>
                <div class="col-md-12 text-right"><button class="btn btn-success" type="button" onclick="save()">Simpan</button></div>
                </div>
                <!--div class="box box-default">
                <div class="box-header with-border bg-green">
                    <h3 class="box-title"> List Data Barang</h3>
                </div>

                <div class="box-body">
                    <div class='row'>
                        <div id="barang"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="nav"></div>
                        </div>
                    </div>
                </div>
                
            </div-->
            </div>

        </div>
    </form>

    <script type="text/javascript">
        //window.onload(view(0));
        $(document).ready(function() {
            //kosongkanObjEntry();
            //view(0);
            getTemp();
            $.widget("custom.caribarang", $.ui.autocomplete, {
                _create: function() {
                    this._super();
                    this.widget().menu("option", "items", "> li:not(.ui-autocomplete-header)");
                },
                _renderMenu(ul, items) {
                    var self = this;
                    //ul.addClass("container");
                    var jual_tipe=$('#jual_tipe').val();
                    //alert(jual_tipe);
                    if(jual_tipe=='Grosir'){
                        let header = {
                            barang_id: "KODE",
                            barang_nama: "NAMA BARANG",
                            harga_jual_grosir: "HARGA",
                            barang_satuan_besar: "SATUAN",
                            isheader: true
                        };
                        console.clear();
                        self._renderItemData(ul, header);
                        $.each(items, function(index, item) {
                            self._renderItemData(ul, item);
                        });
                        //alert("ada")
                        //console.log(header);
                    }else{
                        //alert('ecer')
                        var jual_tipe=$('#jual_tipe').val();
                        //alert(jual_tipe);
                        
                        let header = {
                            barang_id: "KODE",
                            barang_nama: "NAMA BARANG",
                            harga_jual_pcs: "HARGA",
                            barang_satuan_kecil: "SATUAN",
                            isheader: true
                        };
                        self._renderItemData(ul, header);
                        $.each(items, function(index, item) {
                            self._renderItemData(ul, item);
                        });
                    }
                    
                        /*let header = {
                            barang_id: "KODE",
                            barang_nama: "NAMA BARANG",
                            harga_jual_pcs: "HARGA",
                            barang_satuan_kecil: "SATUAN",
                            isheader: true
                        };*/
                        console.clear();
                        
                    

                },
                _renderItemData(ul, item) {
                    return this._renderItem(ul, item).data("ui-autocomplete-item", item);
                },
                _renderItem(ul, item) {
                    var li = $("<li class='ui-menu-item' role='presentation'></li>");
                    if (item.isheader)
                        li = $("<li class='ui-autocomplete-header' role='presentation'  style='font-weight:bold !important;'></li>");
                    var jual_tipe=$('#jual_tipe').val();
                    if(jual_tipe=='Grosir'){
                        var content = "<div class='row ui-menu-item-wrapper'>" +
                        "<div class='col-xs-2'>" + item.barang_id + "</div>" +
                        "<div class='col-xs-4'>" + item.barang_nama + "</div>" +
                        "<div class='col-xs-2'>" + item.harga_jual_grosir + "</div>" +
                        "<div class='col-xs-2'>" + item.barang_satuan_besar + "</div>" +
                        "</div>";
                    }else{
                        var content = "<div class='row ui-menu-item-wrapper'>" +
                        "<div class='col-xs-2'>" + item.barang_id + "</div>" +
                        "<div class='col-xs-4'>" + item.barang_nama + "</div>" +
                        "<div class='col-xs-2'>" + item.harga_jual_pcs + "</div>" +
                        "<div class='col-xs-2'>" + item.barang_satuan_kecil + "</div>" +
                        "</div>";
                    }
                    
                    
                    li.html(content);
                    console.log(content);

                    return li.appendTo(ul);
                }

            });

            $("#q").caribarang({
                minLength: 1,
                source: function(request, response) {
                    var url = "<?= base_url() . "pembelian_barang/caribarang" ?>";
                    console.log(url);
                    $.ajax({
                        url:url,
                        dataType: "JSON",
                        method: "GET",
                        data: {
                            param1: request.term
                        },
                        success: function(data) {
                            console.log(data)
                            var barang = data.data;
                            response(barang.slice(0, 15));
                        },
                        error: function(jqXHR, ajaxOption, errorThrown) {
                            console.log(errorThrown);
                        }
                    });
                },
                focus: function(event, ui) {
                    /*$("#KDDOKTER").val(ui.item['NRP']);
                    $("#NMDOKTER").val(ui.item['pgwNama']);*/
                    $("#q").removeClass("ui-autocomplete-loading");
                    return false;
                },
                select: function(event, ui) {
                    
                    $("#q").removeClass("ui-autocomplete-loading");
                    $('#q').val("");
                    detail(ui.item['barang_id']);
                    //setBarangJual(ui.item['KDBRG'], ui.item['NMBRG'], ui.item['NMSATUAN'], ui.item['NMKTBRG'], ui.item['JSTOK'], ui.item['HJUAL']);
                    return false;
                }
            });
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
        
        //view(0);
        //getTemp();

        function view(start) {
            var search;
            search = document.getElementById('q').value;
            if (search.length > 0) $('#search_barang').show();
            else $('#search_barang').hide();
            $.ajax({
                url: "<?php echo base_url() . "pembelian_barang/data_barang?q="; ?>" + search + "&start=" + start,
                type: "GET",
                dataType: "json",
                data: {
                    get_param: 'value'
                },
                success: function(data) {
                    //menghitung jumlah data
                    jmlData = data.length;

                    //variabel untuk menampung tabel yang akan digenerasikan
                    buatTabel = "";
                    pagination = "";
                    row = 0;
                    limit = 0;
                    start = 0;
                    pagination_count = 0;
                    idx = 0;
                    cur_idx = 0;
                    next = limit;
                    prev = 0;

                    pagination_count = row / limit;
                    sisa = start % limit;
                    cur_idx = start / limit;
                    cur_idx = Math.ceil(cur_idx);
                    prev = (cur_idx - 2) * limit;
                    next = (cur_idx) * limit;
                    paging = Math.ceil(pagination_count);
                    if (cur_idx <= 2) {
                        min = 0;
                        max = 3;
                    } else {
                        min = cur_idx - 2;
                        max = cur_idx + 2;
                    }
                    for (i = 0; i < paging; i++) {
                        active = '';
                        num = i + 1;
                        if (i == 0) {
                            pagination += "<nav><ul class='pagination' style='margin-top:0px'><li><a href='#' class='btn btn-primary' >Record Count : " + row + "</a></li><li " + active + "><a href='#'  onclick='view(" + idx + ")'>First</a></li>";
                            if (next <= row - sisa) pagination += "<li " + active + "><a href='#' onclick='view(" + next + ")'>Next</a></li>";
                            if (num == cur_idx) active = "class='active'";
                            else active = "";
                            pagination += "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
                        } else if (i > 0 && i < paging - 1) {
                            if (num >= min && num <= max) {
                                idx = limit * i;
                                if (num == cur_idx) active = "class='active'";
                                else active = "";
                                pagination += "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
                            }

                        } else {
                            idx = limit * i;
                            if (num == cur_idx) active = "class='active'";
                            else active = "";
                            pagination = pagination + "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
                            if (prev >= 0) pagination += "<li><a href='#' onclick='view(" + prev + ")'>Prev</a></li>";
                            pagination += "<li><a href='#' onclick='view(" + idx + ")'>Last</a></li></ul></nav>";
                        }
                        if (idx == cur_idx) active = "class='active'";
                        else active = "";
                    }
                    //document.getElementById("nav").innerHTML = pagination;
                    //document.getElementById('barang').innerHTML = buatTabel;
                    if (row > limit) document.getElementById("nav").innerHTML = pagination;
                    else $('#nav').html("");

                    document.getElementById('barang').innerHTML = data["barang"];
                }
            });
        }

        function getTemp() {
            var url = "<?php echo base_url() . "pembelian_barang/gettemp"; ?>";
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    get_param: 'value'
                },
                success: function(data) {
                    $('#temp').html(data);
                }
            });
        }

        function detail(barang_id) {
            var tipe = $('#jual_tipe').val();
            var url = "<?php echo base_url() . "pembelian_barang/detail_barang/"; ?>" + barang_id;
            console.log(url);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                data: {
                    get_param: 'value'
                },
                success: function(data) {
                    //menghitung jumlah data
                    //$('#modal_form').modal('show');
                    //$('.modal-footer').hide();
                    $('#tambah-barang').show();
                    $('#priview_barang').html(data['barang']);
                    $('#detail-temp').hide();
                    //document.getElementById('priview_barang').innerHTML = data["barang"];
                    //console.log(data["barang"]);
                }
            });
        }
        j = 0;

        function add_list(barang_id) {
            var url;
            var div;
            url = "<?php echo base_url() . "pembelian_barang/add_list"; ?>/" + barang_id;
            // ajax adding data to database
            //alert(url)
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: function(data) {
                    getTemp();
                    $('#q').val("");
                    $('#tambah-barang').hide();
                    $('#priview_barang').html('');
                    $('#detail-temp').show();
                    alert("Berhasil Ditambahkan")
                    //hituangDetail();
                    //view();
                    //$('#modal_form').modal('hide');

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(url);
                }
            });
        }

        function add_pemasok() {
            id_perusahaan = document.getElementById("masuk_pemasok_id").value;
            //alert(id_perusahaan);
            if (id_perusahaan == 'New') {
                pemasok = '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<input type="text" class="form-control" name="pemasok_nama" id="pemasok_nama" placeholder="Nama" value="" />' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<input type="text" class="form-control" name="pemasok_kontak" id="pemasok_kontak" placeholder="Kontak" value="" />' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<textarea class="form-control" id="pemasok_alamat" name="pemasok_alamat" placeholder="Alamat"></textarea>' +
                    '</div>' +
                    '</div>';
                document.getElementById('pemasok').innerHTML = pemasok;
            } else {
                pemasok = '';
                document.getElementById('pemasok').innerHTML = pemasok;
            }
        }

        function add() {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Barang'); // Set Title to Bootstrap modal title
        }

        function save() {
            var url;
            url = "<?php echo site_url('pembelian_barang/save') ?>";

            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: function(data) {
                    //if success close modal and reload ajax table
                    //$('#modal_form').modal('hide');
                    //location.reload();// for reload a page
                    window.location = "<?php echo base_url() . "pembelian_barang/detail/"; ?>" + data["masuk_id"];
                    //alert(data["masuk_id"]);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(url);
                }
            });
        }

        function edit(id) {
            var url;
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url() . 'barang/edit' ?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
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
                    $('#barang_satuan').val(data.barang_satuan);
                    $('#barang_image').val(data.barang_image);
                    $('#barang_userinput').val(data.barang_userinput);
                    if (data.barang_status == 'Aktif') document.getElementById("barang_status").checked = true;
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Provinsi'); // Set title to Bootstrap modal title
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function remove(id) {
            if (confirm('Are you sure delete this data?')) {
                // ajax delete data from database
                $.ajax({
                    url: "<?php echo base_url() . 'barang/delete'; ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {

                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        }

        function deleteTemp(id) {
            if (confirm('Are you sure delete this data?')) {
                // ajax delete data from database
                $.ajax({
                    url: "<?php echo base_url() . 'pembelian_barang/deletetemp'; ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {

                        getTemp();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });

            }
        }
        function hitungDetail(){
            var harga=$('#harga').val();
            var konversi=$('#konversi').val();
            var hpppcs = parseFloat(harga) / parseFloat(konversi);
            $('#hpppcs').val(hpppcs);
            var qty=$('#jml').val();
            var diskon=$('#diskon').val();
            if(qty=='') qty=0;
            if(diskon=='') diskon=0;
            var subtotal=parseFloat(harga)*parseInt(qty) - parseInt(diskon);
            $('#subtotal').val(subtotal);
        }
        function closeForm(){
            $('#tambah-barang').hide();
            $('#priview_barang').html('');
            $('#detail-temp').show();
            getTemp();
        }
        function setJenisHarga(konversi,satuan){
            $('#konversi').val(konversi);
            var hpppcs=$('#hpppcs').val();
            var hppsatuan = hpppcs * konversi;
            $('#harga').val(hppsatuan);
            $('.satuan').html(satuan);
            $('#satuan').val(satuan);
            hitungDetail()
        }
    </script>

    <!--Modal-->
    <!--Modal-->
    <!--div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Barang</h3>
                </div>

                <div class="modal-body form">

                    <div id="priview_barang"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div-->
</div>
<!--========================================================================================================
End of file pembelian_barang_list.php 
Location: ./application/views/pembelian_barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 20 Oct 2017 03:12:27 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->