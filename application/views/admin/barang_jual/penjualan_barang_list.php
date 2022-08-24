<style type="text/css">
    .baris {
        border-bottom: dotted #00a65a;
        border-width: 1px;
    }

    .pull-right {
        text-align: right;
    }
    .ui-autocomplete-loading {
        background: white url("<?php echo base_url() ?>ui-anim_basic_16x16.gif") right center no-repeat;
    }

    .ui-autocomplete-input {
        border: none;
        font-size: 14px;
        border: 1px solid #DDD !important;
        z-index: 1511;
        position: relative;
    }

    .ui-menu .ui-menu-item a {
        font-size: 12px;
    }

    /*.ui-autocomplete {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1510 !important;
        float: left;
        display: none;
        min-width: 160px;
        padding: 4px 0;
        margin: 2px 0 0 0;
        list-style: none;
        background-color: #ffffff;
        border-color: #ccc;
        border-color: rgba(0, 0, 0, 0.2);
        border-style: solid;
        border-width: 1px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        *border-right-width: 2px;
        *border-bottom-width: 2px;
    }*/
    /*.ui-autocomplete {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1050 !important;
        float: left;
        display: none;
        min-width: 160px;
        padding: 4px 0;
        margin: 2px 0 0 0;
        list-style: none;
        background-color: #ffffff;
        border-color: #ccc;
        border-color: rgba(0, 0, 0, 0.2);
        border-style: solid;
        border-width: 1px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
        *border-right-width: 2px;
        *border-bottom-width: 2px;
    }*/
    .ui-autocomplete {
        position: absolute;
        z-index: 1050 !important;
    }
    .ui-menu-item>a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }

    .ui-state-hover,
    .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
    .panel{
        border-radius:0px;
    }

</style>
<div class="col-sm-12">
    <form action="#" method="POST" id="form" onsubmit="return false">
        <div class="row">
            <div class="col-md-3" style="border-right: solid #00a65a; border-width: 1px;">

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
                                    <label for="varchar">Tipe Penjualan</label>
                                </div>
                                <div class="col-md-12">
                                    <select id="jual_tipe" name="jual_tipe" class="form-control input-sm" onchange="clearTemp()">
                                        <option value="Grosir">Grosir</option>
                                        <option value="Ecer">Ecer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Cara Bayar</label>
                                </div>
                                <div class="col-md-12">
                                    <select id="cara_bayar" name="cara_bayar" class="form-control input-sm">
                                        <option value="Tinai">Tunai</option>
                                        <option value="Kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box box-default">
                    <!--================================================================================================
                    Data pelanggan
                    =================================================================================================-->
                    <div class="box-header with-border bg-green">
                        <h3 class="box-title"> Pelanggan</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="varchar">Pelanggan</label>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control input-sm select2" name="jual_pelanggan_id" id="jual_pelanggan_id" onchange="add_pelanggan()" placeholder='pelanggan'>
                                        <?php
                                        foreach ($list_pelanggan as $list) {
                                        ?>
                                            <option value='<?php echo $list->pelanggan_id; ?>'><?php echo $list->pelanggan_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                        <option value="New">Add new</option>
                                    </select>
                                </div>
                                <div id="pelanggan">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <a href="<?php echo base_url() . "penjualan/histori"; ?>" class="btn btn-success btn-block">Lihat Histori</a>
            </div>
            <div class="col-md-9">
            
                <div class="input-group">
                    <input type="text" class="form-control" name="q" id="q" value="">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" >Search</button>
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
                    <div class="col-md-12" id="nav"></div>
                    <div id="temp"></div>
                    <hr>
                    <div class="col-md-12 text-right"><button class="btn btn-success" type="button" onclick="save()">Simpan</button></div>
                </div>
                
                <!--====================================================================================================
                END List Data Barang
                =====================================================================================================-->
            </div>

        </div>
    </form>
    
    

    <!--Modal-->
    <!--div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Barang</h3>
                </div>

                <div class="modal-body form">

                    
                </div>

                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div-->

</div>

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
                    // if(jual_tipe=='Grosir'){
                    //     let header = {
                    //         barang_id: "KODE",
                    //         barang_nama: "NAMA BARANG",
                    //         harga_jual_grosir: "HARGA",
                    //         barang_satuan_besar: "SATUAN",
                    //         isheader: true
                    //     };
                    //     console.clear();
                    //     self._renderItemData(ul, header);
                    //     $.each(items, function(index, item) {
                    //         self._renderItemData(ul, item);
                    //     });
                    //     //alert("ada")
                    //     //console.log(header);
                    // }else{
                    //     //alert('ecer')
                    //     var jual_tipe=$('#jual_tipe').val();
                    //     //alert(jual_tipe);
                        
                    //     let header = {
                    //         barang_kode: "KODE",
                    //         barang_nama: "NAMA BARANG",
                    //         harga_modal: "HPP",
                    //         stok_string: "STOK",
                    //         isheader: true
                    //     };
                    //     self._renderItemData(ul, header);
                    //     $.each(items, function(index, item) {
                    //         self._renderItemData(ul, item);
                    //     });
                    // }
                    let header = {
                            barang_kode: "KODE",
                            barang_nama: "NAMA BARANG",
                            harga_modal: "HPP",
                            stok_string: "STOK",
                            isheader: true
                        };
                        self._renderItemData(ul, header);
                        $.each(items, function(index, item) {
                            self._renderItemData(ul, item);
                        });
                    
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
                    // if(jual_tipe=='Grosir'){
                    //     var content = "<div class='row ui-menu-item-wrapper'>" +
                    //     "<div class='col-xs-2'>" + item.barang_kode + "</div>" +
                    //     "<div class='col-xs-4'>" + item.barang_nama + "</div>" +
                    //     "<div class='col-xs-2'>" + item.harga_modal + "</div>" +
                    //     "<div class='col-xs-2'>" + item.stok_string + "</div>" +
                    //     "</div>";
                    // }else{
                    //     var content = "<div class='row ui-menu-item-wrapper'>" +
                    //     "<div class='col-xs-2'>" + item.barang_id + "</div>" +
                    //     "<div class='col-xs-4'>" + item.barang_nama + "</div>" +
                    //     "<div class='col-xs-2'>" + item.harga_jual_pcs + "</div>" +
                    //     "<div class='col-xs-2'>" + item.barang_satuan_kecil + "</div>" +
                    //     "</div>";
                    // }
                    var content = "<div class='row ui-menu-item-wrapper'>" +
                        "<div class='col-xs-2'>" + item.barang_kode + "</div>" +
                        "<div class='col-xs-4'>" + item.barang_nama + "</div>" +
                        "<div class='col-xs-2'>" + item.harga_modal + "</div>" +
                        "<div class='col-xs-2'>" + item.stok_string + "</div>" +
                        "</div>";
                    
                    li.html(content);
                    console.log(content);

                    return li.appendTo(ul);
                }

            });

            $("#q").caribarang({
                minLength: 1,
                source: function(request, response) {
                    var url = "<?= base_url() . "penjualan/caribarang" ?>";
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
                    //alert("harga Focus");
                    $('#harga').focus();
                    //setBarangJual(ui.item['KDBRG'], ui.item['NMBRG'], ui.item['NMSATUAN'], ui.item['NMKTBRG'], ui.item['JSTOK'], ui.item['HJUAL']);
                    return false;
                }
            });

            $('#q').keydown(function(e) {
                console.log("harga...");
                if (e.keyCode == 13) {
                    var kode=$('#q').val();
                    var tipe = $('#jual_tipe').val();
                    var url = "<?php echo base_url() . "penjualan/barcodebarang/"; ?>" + kode + "/" + tipe;
                    console.log(url);
                    // alert(url)
                    $('#q').val("");
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
                            if(data.status==true){
                                $('#tambah-barang').show();
                                $('#priview_barang').html(data['barang']);
                                $('#detail-temp').hide();
                                $('#harga').focus();
                            }else{
                                alert("Maaf Data Tidak Ditemukan")
                                closeForm()
                            }
                            
                            //document.getElementById('priview_barang').innerHTML = data["barang"];
                            //console.log(data["barang"]);
                        }
                    });
                }
            });

            $('#harga').keydown(function(e) {
                console.log("harga...");
                if (e.keyCode == 13) {
                    $('#jml').focus();
                }
            });

            $('#harga').keydown(function(e) {
                if (e.keyCode == 13) {
                    $('#diskon').focus();
                }
            });
        });
        
        

        // function view(start) {
        //     var search;
        //     search = document.getElementById('q').value;
        //     var tipe = $('#jual_tipe').val();
        //     if (search.length > 0) $('#search_barang').show();
        //     else $('#search_barang').hide();
        //     var url = "<?php echo base_url() . "penjualan/data_barang?q="; ?>" + search + "&start=" + start + "&tipe=" + tipe;
        //     $.ajax({
        //         url: url,
        //         type: "GET",
        //         dataType: "json",
        //         data: {
        //             get_param: 'value'
        //         },
        //         success: function(data) {
        //             //menghitung jumlah data
        //             jmlData = data.length;

        //             //variabel untuk menampung tabel yang akan digenerasikan
        //             //buatTabel = "";
        //             pagination = "";
        //             row = data["row_count"];
        //             limit = data["limit"];
        //             start = data["start"];
        //             pagination_count = 0;
        //             idx = 0;
        //             cur_idx = 0;
        //             next = limit;
        //             prev = 0;
        //             satuan = '';
        //             harga = 0;

        //             pagination_count = row / limit;
        //             sisa = start % limit;
        //             cur_idx = (start + data["limit"]) / limit;
        //             cur_idx = Math.ceil(cur_idx);
        //             prev = (cur_idx - 2) * limit;
        //             next = (cur_idx) * limit;
        //             paging = Math.ceil(pagination_count);
        //             console.log(cur_idx);
        //             if (cur_idx <= 2) {
        //                 min = 0;
        //                 max = 3;
        //             } else {
        //                 min = cur_idx - 2;
        //                 max = cur_idx + 2;
        //             }
        //             for (i = 0; i < paging; i++) {
        //                 active = '';
        //                 num = i + 1;
        //                 if (i == 0) {
        //                     pagination += "<nav><ul class='pagination' style='margin-top:0px'><li><a href='#' class='btn btn-primary' >Record Count : " + row + "</a></li><li " + active + "><a href='#'  onclick='view(" + idx + ")'>First</a></li>";
        //                     if (next <= row - sisa) pagination += "<li " + active + "><a href='#' onclick='view(" + next + ")'>Next</a></li>";
        //                     if (num == cur_idx) active = "class='active'";
        //                     else active = "";
        //                     pagination += "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
        //                 } else if (i > 0 && i < paging - 1) {
        //                     if (num >= min && num <= max) {
        //                         idx = limit * i;
        //                         if (num == cur_idx) active = "class='active'";
        //                         else active = "";
        //                         pagination += "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
        //                     }

        //                 } else {
        //                     idx = limit * i;
        //                     if (num == cur_idx) active = "class='active'";
        //                     else active = "";
        //                     pagination = pagination + "<li " + active + "><a href='#' onclick='view(" + idx + ")'>" + num + "</a></li>";
        //                     if (prev >= 0) pagination += "<li><a href='#' onclick='view(" + prev + ")'>Prev</a></li>";
        //                     pagination += "<li><a href='#' onclick='view(" + idx + ")'>Last</a></li></ul></nav>";
        //                 }
        //                 if (idx == cur_idx) active = "class='active'";
        //                 else active = "";
        //             }

        //             if (row > limit) document.getElementById("nav").innerHTML = pagination;
        //             else $('#nav').html("");
        //             $('#barang').html(data["barang"]);
        //             // document.getElementById('barang').innerHTML = data["barang"];
        //         }
        //     });
        // }

        function detail(barang_id) {
            var tipe = $('#jual_tipe').val();
            var url = "<?php echo base_url() . "penjualan/detail_barang/"; ?>" + barang_id + "/" + tipe;
            console.log(url);
            // alert(url)
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
            disc = 0;
            tot = 0;
            j = 0;
            var st=$('#subtotal').val();
            var jml =$('#jml').val();

            var hpp=$('#hpp').val(); //hpp perpcs
            var konversi = $('#konversi_satuan').val();
            var jmljual = parseFloat(jml)*parseFloat(konversi);  //jumlah jual dalam satuan pcs/kecil
            var harga = $('#harga').val(); //Harga Per Jenis Jual
            var hargapcs = parseFloat(harga)/parseFloat(konversi); //Harga Jual per pcs/satuan kecil
            //var hj=parseInt(st) / jmljual;
            var stok=$('#stok').val();
            if(hargapcs<=parseFloat(hpp)){
                alert('Harga Jual tidak boleh lebih kecil dari harga pokok penjualan(HPP)');
                return false;
            }
            if(parseFloat(stok)<jmljual){
                alert('Stok tidak mencukupi');
                return false;
            }
            url = "<?php echo base_url() . "penjualan/add_list"; ?>/" + barang_id;
            console.log(url);
            // ajax adding data to database
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: 'JSON',
                success: function(data) {
                    //alert(data["message"]);
                    console.clear();
                    console.log(data);
                    getTemp();
                    $('#q').val("");
                    //view(0);
                    //$('#modal_form').modal('hide');
                    $('#tambah-barang').hide();
                    $('#priview_barang').html('');
                    $('#detail-temp').show();
                    hituangDetail();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(url);
                }
            });
        }

        function getTemp() {
            var url = "<?php echo base_url() . "penjualan/gettemp"; ?>";
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

        function clearTemp() {
            var url = "<?php echo base_url() . "penjualan/cleartemp"; ?>";
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
        function add_pelanggan() {
            id_perusahaan = document.getElementById("jual_pelanggan_id").value;
            //alert(id_perusahaan);
            if (id_perusahaan == 'New') {
                pelanggan = '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<input type="text" class="form-control" name="pelanggan_nama" id="pelanggan_nama" placeholder="Nama" value="" required />' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<input type="text" class="form-control" name="pelanggan_kontak" id="pelanggan_kontak" placeholder="Kontak" value="" required />' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<input type="text" class="form-control" name="pelanggan_email" id="pelanggan_email" placeholder="Email" value="" required />' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<div class="col-md-12">' +
                    '<textarea class="form-control" id="pelanggan_alamat" name="pelanggan_alamat" placeholder="Alamat" required></textarea>' +
                    '</div>' +
                    '</div>';
                document.getElementById('pelanggan').innerHTML = pelanggan;
            } else {
                pelanggan = '';
                document.getElementById('pelanggan').innerHTML = pelanggan;
            }
        }

        function add() {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-footer').show();
            $('.modal-title').text('Add Barang'); // Set Title to Bootstrap modal title
        }
        function closeForm(){
            $('#tambah-barang').hide();
            $('#priview_barang').html('');
            $('#detail-temp').show();
            getTemp();
        }
        function save() {
            var url;
            url = "<?php echo site_url('penjualan/save') ?>";

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
                    getTemp();
                    window.location = "<?php echo base_url() . "penjualan/detail/"; ?>" + data["jual_id"];
                    //alert(data["jual_id"]);
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
                    $('.modal-footer').show();
                    $('.modal-title').text('Edit Provinsi'); // Set title to Bootstrap modal title
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function deleteTemp(id) {
            if (confirm('Are you sure delete this data?')) {
                // ajax delete data from database
                $.ajax({
                    url: "<?php echo base_url() . 'penjualan/delete'; ?>/" + id,
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
            var qty=$('#jml').val();
            var diskon=$('#diskon').val();
            

            if(qty=='') qty=0;
            if(diskon=='') diskon=0;
            var subtotal=parseFloat(harga)*parseFloat(qty) - parseFloat(diskon);
            $('#subtotal').val(subtotal);
        }
        function setHarga(harga,konversi,satuan){
            $('#harga').val(harga);
            $('#konversi_satuan').val(konversi);
            $('#satuan').val(satuan)
            $('.satuan').html(satuan)
            hitungDetail()
        }
    </script>
<!--========================================================================================================
End of file pembelian_barang_list.php 
Location: ./application/views/pembelian_barang_list.php 
Please DO NOT modify this information : 
Generated by Codeigniter CRUD Generator V1 20 Oct 2017 03:12:27 
Copyright @ 2017 By Wanhar Azri S.Kom 
============================================================================================================-->