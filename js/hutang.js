
getHutang(0);
function getHutang(start){
    $('#start').val(start);
    var search = $('#q').val();
    var active="class='btn btn-primary btn-sm'";
    var url=base_url + "hutang/data?q=" + search + "&start=" +start;
    $.ajax({
        url     : url,
        type    : "GET",
        dataType: "json",
        data    : {get_param : 'value'},
        success : function(data){
            //menghitung jumlah data
            console.clear();
            if(data["status"]==true){
                var hutang    = data["data"];
                var jmlData=hutang.length;
                var limit   = data["limit"]
                var tabel   = "";
                //Create Tabel
                for(var i=0; i<jmlData;i++){
                    start++;
                    tabel+="<tr>";
                    tabel+="<td>"+start+"</td>";
                    tabel+="<td>"+hutang[i]["hutang_faktur"]+"</td>";
                    tabel+="<td>"+hutang[i]["pemasok_nama"]+"</td>";
                    tabel+="<td>"+hutang[i]["hutang_tgl"]+"</td>";
                    tabel+="<td class='text-right'>Rp. "+hutang[i]["hutang_jml"]+"</td>";
                    if(hutang[i]["jml_bayar"]==null){
                        tabel+="<td class='text-right'>Rp. 0</td>";
                    }else{
                        tabel+="<td class='text-right'>Rp. "+hutang[i]["jml_bayar"]+"</td>";
                    }
                    
                    tabel+='<td class=\'text-right\'><div class="btn-group"><button type=\'button\' class=\'btn btn-success btn-xs\' onclick=\'edit("' +hutang[i]["hutang_id"] +'")\'><span class=\'fa fa-gear\' ></span> Bayar</button>';
                    tabel+='<button type=\'button\' class=\'btn btn-primary btn-xs\' onclick=\'histori("' +hutang[i]["hutang_id"] +'")\'><span class=\'fa fa-tasks\' ></span> Histori</button></div></td>'
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
                    var btnFirst="<button class='btn btn-default btn-sm' onclick='getHutang(0)'><span class='fa fa-angle-double-left'></span></button>";
                    if(curIdx>1){
                        var prevSt=((curIdx-1)*data["limit"])-jmlData;
                        btnFirst+="<button class='btn btn-default btn-sm' onclick='getHutang("+prevSt+")'><span class='fa fa-angle-left'></span></button>";
                    }

                    var btnLast="";
                    if(curIdx<jmlPage){
                        var nextSt=((curIdx+1)*data["limit"])-jmlData;
                        btnLast+="<button class='btn btn-default btn-sm' onclick='getHutang("+nextSt+")'><span class='fa fa-angle-right'></span></button>";
                    }
                    btnLast+="<button class='btn btn-default btn-sm' onclick='getHutang("+lastSt+")'><span class='fa fa-angle-double-right'></span></button>";
                    
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
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getHutang("+ st +")'>" + j +"</button>";
                        }
                    }else{
                        for (var j = 1; j<=jmlPage; j++) {
                            st=(j*data["limit"])-jmlData;
                            if(curSt==st)  btn="btn-success"; else btn= "btn-default";
                            btnIdx+="<button class='btn " +btn +" btn-sm' onclick='getHutang("+ st +")'>" + j +"</button>";
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
    $('.modal-title').text('Tambah Data Hutang'); 
}
function save(){
    var url;
    url = base_url + "hutang/save";
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
            getHutang(start);
            swal({
             title: "Sukses",
             text: data["message"],
             type: "success",
             timer: 5000
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal({
             title: "Terjadi Kesalahan ",
             text: "Gagal Menyimpan Data",
             type: "error",
             timer: 5000
            });
        }
    });
}
function edit(id)
{
    var url;
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url : base_url + "hutang/edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if(data["status"]==false){
                alert(data["message"]);
                
                //alert(data["message"]);
            }else{
                var hutang = data["data"];
                
                $('#hutang_id').val(hutang.hutang_id);
                $('#hutang_faktur').val(hutang.hutang_faktur);
                $('#pemasok_nama').val(hutang.pemasok_nama);
                $('#hutang_tgl').val(hutang.hutang_tgl);
                $('#hutang_jml').val(hutang.hutang_jml);
                $('#jml_bayar').val(hutang.jml_bayar);
                var sisa=hutang.hutang_jml-hutang.jml_bayar;
                $('#sisa_hutang').val(sisa);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Pembayaran Hutang'); 
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            
            alert("Gagal saat Pengambilan data")
        }
    });
}

function histori(id)
{
    var url;
    save_method = 'update';
    $('#form')[0].reset(); 
    $.ajax({
        url : base_url + "hutang/histori/" + id,
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
            url : base_url + "hutang/delete/" +id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var start=$('#start').val();
                getHutang(start);
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