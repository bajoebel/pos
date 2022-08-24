
getPiutang(0);
function getPiutang(start){
    $('#start').val(start);
    var search = $('#q').val();
    var active="class='btn btn-primary btn-sm'";
    var url=base_url + "piutang/data?q=" + search + "&start=" +start;
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        success : function(data){
            //menghitung jumlah data
            console.clear();
            if(data["status"]==true){
                var piutang    = data["data"];
                var jmlData=piutang.length;
                var limit   = data["limit"]
                var tabel   = "";
                //Create Tabel
                for(var i=0; i<jmlData;i++){
                    start++;
                    tabel+="<tr>";
                    tabel+="<td>"+start+"</td>";
                    
                    tabel+="<td>"+piutang[i]["piutang_invoice"]+"</td>";
                    tabel+="<td>"+piutang[i]["pelanggan_nama"]+"</td>";
                    tabel+="<td>"+piutang[i]["piutang_tgl"]+"</td>";
                    tabel+="<td>"+piutang[i]["piutang_jml"]+"</td>";
                    if(piutang[i]["jumlah_bayar"]==null){
                        tabel+="<td class='text-right'>Rp. 0</td>";
                    }else{
                        tabel+="<td class='text-right'>Rp. "+piutang[i]["jumlah_bayar"]+"</td>";
                    }
                    //tabel+="<td>"+piutang[i]["jumlah_bayar"]+"</td>";
                    tabel+='<td class=\'text-right\'><div class="btn-group"><button type=\'button\' class=\'btn btn-success btn-xs\' onclick=\'edit("' +piutang[i]["piutang_id"] +'")\'><span class=\'fa fa-gear\' ></span> Bayar</button>';
                    tabel+='<button type=\'button\' class=\'btn btn-primary btn-xs\' onclick=\'histori("' +piutang[i]["piutang_id"] +'")\'><span class=\'fa fa-tasks\' ></span> Histori</button></div></td>'
                    tabel+="</tr>";
                }
                $('#data').html(tabel);
                //Create Pagination
                if(data["row_count"]<=limit){
                    $('#pagination').html("");
                }else{
                    var pagination="";
                    var btnIdx="";
                    jmlPage=Math.ceil(data["row_count"]/limit);
                    offset  = data["start"] % limit;
                    curIdx  = Math.ceil((data["start"]/data["limit"])+1);
                    prev    = (curIdx-2) * data["limit"];
                    next    = (curIdx) * data["limit"];
                    
                    var curSt=(curIdx*data["limit"])-jmlData;
                    var st=start;
                    var btn="btn-default";
                    var lastSt=(jmlPage*data["limit"])-jmlData
                    var btnFirst="<button class='btn btn-default btn-sm' onclick='getPiutang(0)'><span class='fa fa-angle-double-left'></span></button>";
                    if(curIdx>1){
                        var prevSt=((curIdx-1)*data["limit"])-jmlData;
                        btnFirst+="<button class='btn btn-default btn-sm' onclick='getPiutang("+prevSt+")'><span class='fa fa-angle-left'></span></button>";
                    }

                    var btnLast="";
                    if(curIdx<jmlPage){
                        var nextSt=((curIdx+1)*data["limit"])-jmlData;
                        btnLast+="<button class='btn btn-default btn-sm' onclick='getPiutang("+nextSt+")'><span class='fa fa-angle-right'></span></button>";
                    }
                    btnLast+="<button class='btn btn-default btn-sm' onclick='getPiutang("+lastSt+")'><span class='fa fa-angle-double-right'></span></button>";
                    
                    if(jmlPage>=25){
                        if(curIdx>=20){
                            var idx_start=curIdx - 20;
                            var idx_end=idx_start+ 25;
                            if(idx_end>=jmlPage) idx_end=jmlPage;
                        }else{
                            var idx_start=1;
                            var idx_end=25;
                        }
                        for (var j = idx_start; j<=idx_end; j++) {
                            st=(j*data["limit"])-jmlData;
                            if(curSt==st)  btn="btn-success"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getPiutang("+ st +")'>" + j +"</button>";
                        }
                    }else{
                        for (var j = 1; j<=jmlPage; j++) {
                            st=(j*data["limit"])-jmlData;
                            if(curSt==st)  btn="btn-success"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getPiutang("+ st +")'>" + j +"</button>";
                        }
                    }
                    pagination+=btnFirst + btnIdx + btnLast;
                    $('#pagination').html(pagination);
                }
            }
        }
    });
}
function add(){
    save_method = 'add';
    $('#form')[0].reset(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Tambah Data Piutang'); 
}
function save(){
    var url;
    url = base_url + "piutang/save";
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function(data)
        {
            $('#modal_form').modal('hide');
            var start=$('#start').val();
            getPiutang(start);
            alert(data["message"]);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            
            alert("Gagal Menyimpan data");
        }
    });
}
function edit(id)
{
    var url;
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url : base_url + "piutang/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data["status"]==false){
                alert(data["message"]);
                //alert(data["message"]);
            }else{
                var piutang = data["data"];
                
                $('#piutang_id').val(piutang.piutang_id);
                $('#piutang_invoice').val(piutang.piutang_invoice);
                $('#pelanggan_nama').val(piutang.pelanggan_nama);
                $('#piutang_tgl').val(piutang.piutang_tgl);
                $('#piutang_jml').val(piutang.piutang_jml);
                var tagihan=piutang.piutang_jml-piutang.jumlah_bayar;
                $('#jumlah_bayar').val(piutang.jumlah_bayar);
                $('#jumlah_tagihan').val(tagihan);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Edit Data Piutang'); 
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("Gagal Mengambil data");
        }
    });
}
function histori(id)
{
    var url;
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url : base_url + "piutang/histori/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           $('#modal_histori').modal('show'); 
                $('#histori_bayar').html(data)
                $('.modal-title').text('Histori Pembayaran'); 
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            
            alert("Gagal saat Pengambilan data")
        }
    });
}
function hapus(id){
    swal({
      title: "Apakah Anda Yakin?",
      text: "Data ini akan dihapus dari database",
      type: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya, Saya Yakin!",
      cancelButtonText: "Tidak, Tolong Batalkan!",
      closeOnConfirm: true,
      closeOnCancel: true
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({
            url : base_url + "piutang/delete/" +id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var start=$('#start').val();
                getPiutang(start);
            },
            error: function (jqXHR, textStatus, errorThrown){
                swal({
                 title: "Terjadi Kesalahan..!",
                 text: "Gagal Saat Pengapusan data",
                 type: "error",
                 timer: 5000
                });
            }
        });
      } else {
        swal("Batal", "Data Tidak jadi dihapus :)", "error");
      }
    });
}