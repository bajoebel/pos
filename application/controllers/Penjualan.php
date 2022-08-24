<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penjualan extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Barang_jual_model');
    }

    /*Load Data HTML*/
    public function index(){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'list_pelanggan'    => $this->Barang_jual_model->get_pelanggan(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Penjualan Barang',
                'isi' => $this->load->view('admin/barang_jual/penjualan_barang_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }

    /*Load Data HTML*/
    public function histori(){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'list_pelanggan'    => $this->Barang_jual_model->get_pelanggan(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Barang_jual',
                'isi' => $this->load->view('admin/barang_jual/barang_jual_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }
    /*Load Data JSON*/
    public function data(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $list[]=array();
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 10;
            $data = $this->Barang_jual_model->get_limit_data($limit, $start, $q);

            $row_count=$this->Barang_jual_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->jual_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->jual_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'jual_id'=>$row->jual_id,
                    'jual_invoice'=>$row->jual_invoice,
                    'jual_tipe'=>$row->jual_tipe,
                    'pelanggan_nama'=>$row->pelanggan_nama,
                    'jual_tanggal'=>$row->jual_tanggal,
                    'jual_tutup_buku'=>$row->jual_tutup_buku,
                    'jual_userinput'=>$row->jual_userinput,
                    'aksi'=>$delete
                );
            }
            echo json_encode($list);

        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    function caribarang(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $param=$this->input->get('param1');
            $list=array(
                'kode'=>true,
                'data'=>$this->Barang_jual_model->cariBarang($param)
            );
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    public function data_barang(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $list[]=array();
            $q = urldecode($this->input->get('q', TRUE));
            $tipe = urldecode($this->input->get('tipe', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 4;
            $barang = $this->Barang_jual_model->data_barang($limit, $start, $q);
            $row_count=$this->Barang_jual_model->total_barang($q);
            $data=array(
                'tipe'      => $tipe,
                'barang'    => $barang
            );
            $v_barang=$this->load->view('admin/barang/view_barang', $data, true);
            $list=array(
                'start'     =>$start,
                'row_count' => $row_count,
                'limit'     => $limit,
                'barang'    => $v_barang
            );
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function detail_barang($id_barang, $tipe="Grosir"){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $barang = $this->Barang_jual_model->detail_barang($id_barang);
            $data=array(
                'barang'    => $barang,
                'tipe'      => $tipe
            );
            $v_barang=$this->load->view('admin/barang/detail_barang', $data, true);
            $list=array(
                'barang'    => $v_barang
            );
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    public function barcodebarang($kode="", $tipe="Grosir"){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $barang = $this->Barang_jual_model->detail_barang_by_kode($kode);
            $data=array(
                'barang'    => $barang,
                'tipe'      => $tipe
            );
            if(empty($barang)) {
                $status=false; 
                $v_barang="Barang Tidak Ditemukan";
            }else {
                $status=true;
                $v_barang=$this->load->view('admin/barang/detail_barang', $data, true);
            }
            
            $list=array(
                'status'=>$status,
                'barang'    => $v_barang,
                
            );
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE,'message'=>'Session Expired'));
        }
    }

    public function thumb(){
        $auth=$this->_auth();
        $this->load->model("Barang_model");
        if($auth['priv_count']){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 10;
            $view="";
            $data = $this->Barang_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Barang_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $view.="
                <div class=\"col-md-3\" style=\"padding-bottom: 5px;text-align: center;\">
                    <div style=\"border: solid #00a65a;border-width: 1px;\">
                        <img src=\"" .base_url() ."upload/barang/icon/" .$row->barang_image ."\" width=\"128px\">
                        <h5><b>Energen</b><br>
                        <form id=\"form" .$row->barang_id ."\" method=\"POST\" action=\"" .base_url() ."pembelian_barang/add_list\">
                            <input name=\"id\" value=\"" .$row->barang_id ."\" type=\"hidden\">
                            <input name=\"nama\" value=\"" .$row->barang_nama ."\" type=\"hidden\">
                            <div class=\"col-md-12\">
                                <input name=\"harga\" value=\"" .$row->barang_harga_grosir ."\" class=\"form-control input-sm\" type=\"number\">
                                <input name=\"diskon\" value=\"" .$row->barang_diskon ."\" type=\"hidden\">
                                <input name=\"jml\" value=\"1\" class=\"form-control input-sm\" type=\"text\">
                                <b>Kotak</b><br>Diskon " .$row->barang_diskon ." % <br>
                            </div>
                        </form>
                        <button class=\"btn btn-success fa fa-plus\" onclick=\"add_list(" .$row->barang_id .",\"#form1" .$row->barang_id ."\";)\"></button>
                        </h5>
                    </div>
                </div>";
                $list=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'view'=>$view,
                );
                
            }
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    /*save and update data*/
    public function save1(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            if($this->input->post('jual_tutup_buku')=='Sudah') $jual_tutup_buku='Sudah';
            else $jual_tutup_buku='Belum';
            $jual_id=$this->input->post('jual_id');
            $data = array(
                'jual_invoice' => $this->input->post('jual_invoice'),
                'jual_tipe' => $this->input->post('jual_tipe'),
                'jual_pelanggan_id' => $this->input->post('jual_pelanggan_id'),
                'jual_tanggal' => $this->input->post('jual_tanggal'),
                'jual_tutup_buku' => $jual_tutup_buku,
                'jual_userinput' => $this->input->post('jual_userinput'),
            );
            if(empty($jual_id)){
                $insert = $this->Barang_jual_model->save($data);
            }else{
                $this->Barang_jual_model->update($data,$jual_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //Proses Load data for update 
    public function edit($id){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $data = $this->Barang_jual_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Barang_jual_model->deleteTempByid($id);
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    /*save and update data*/
    public function save(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            //1. Jika pelanggan ID ="New" Simpan Data pelanggan baru kemudian simpan pelanggan_id ke variabel
            $pelanggan_id=$this->input->post('jual_pelanggan_id');
            if($pelanggan_id=='New'){
                $pelanggan=array(
                    'pelanggan_nama'=>$this->input->post('pelanggan_nama'),
                    'peanggan_kontak'=>$this->input->post('pelanggan_kontak'),
                    'pelanggan_email'=>$this->input->post('pelanggan_email'),
                    'pelanggan_alamat'=>$this->input->post('pelanggan_alamat'),
                    'pelanggan_userinput'=>$auth['username']
                );
                $this->load->model('pelanggan_model');
                $pelanggan_id=$this->pelanggan_model->save($pelanggan);
            }
            //2. Simpan Tabel Barang_jual
            $invoice=$this->Barang_jual_model->buat_invoice();
            $master=array(
                'jual_invoice' => $invoice,
                'jual_tipe'=>$this->input->post('jual_tipe'),
                'jual_carabayar'=>$this->input->post('cara_bayar'),
                'jual_pelanggan_id' => $pelanggan_id,
                'jual_tanggal' => date('Y-m-d'),
                'jual_userinput' => $auth['username'],
            );
            $jual_id = $this->Barang_jual_model->save($master);
            //3. Simpan Ke Tabel detail_jual
            $barang_id=$this->input->post('tmp_barangid');
            $tipeharga=$this->input->post('tmp_tipeharga');
            $harga=$this->input->post('tmp_harga');
            $jumlah=$this->input->post('tmp_jumlah');
            $diskon=$this->input->post('tmp_diskon');
            $jml_trans=count($barang_id);
            $jmlpcs=$this->input->post('tmp_jmlsatuan');
            $konversi=$this->input->post('tmp_konversisatuan');
            $satuan=$this->input->post('tmp_satuan');
            for($i=0;$i<$jml_trans;$i++){
                $detail[]=array(
                    'detail_jual_id'   => $jual_id,
                    'detail_barang_id'=>$barang_id[$i],
                    'detail_jual_tipe'=>$this->input->post('jual_tipe'),
                    'detail_tipe_harga'=>$tipeharga[$i],
                    'detail_jumlah'=>$jumlah[$i],
                    'detail_harga_satuan'=>$harga[$i],
                    'detail_diskon'=>$diskon[$i],
                    'detail_konversi_satuan'=>$konversi[$i],
                    'detail_jmlsatuan'=>$jmlpcs[$i],
                    'detail_satuan'=>$satuan[$i],
                    'detail_status'=>'Checkout'
                );
                
                //Insert data ke log transaksi fifo
                
                $log=array(
                    'jns_transaksi'=>'JL',
                    'tgl_transaksi'=>date('Y-m-d H:i:s'),
                    'no_referensi'=>$jual_id,
                    'barang_id'=>$barang_id[$i],
                    'jumlah'=>$jmlpcs[$i],
                    'konversi_satuan'=>$konversi[$i],
                    'userinput'=>$auth['username']
                );
                // $log=array(
                //     'jns_transaksi'=>'JL',
                //     'no_referensi'=>$jual_id,
                //     'barang_id'=>$barang_id[$i],
                //     'jml_masuk'=>
                //     'jml_keluar'
                //     'konversi_satuan'
                //     'userinput'
                // );
                $sisa=$this->Barang_jual_model->insertLog($log);
            }
            if(!empty($detail)){
                $this->db->insert_batch('detail_jual',$detail);
            }
            //4.delete from tmp
            $this->Barang_jual_model->deleteTemp(session_id());
            //5. SImpan ke tabel Pitang kalau pembayaran kredit
            $piutang=array(
                'piutang_transaksi' => 'PJ',
                'piutang_tgl'       => date('Y-m-d'),
                'piutang_koderef'   => $jual_id,
                'piutang_jml'       => $this->input->post('tagihan'),
                'piutang_userinput' => $auth['username'],
            );
            $this->db->insert('piutang',$piutang);
            $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
            echo json_encode(array("status" => TRUE,"jual_id" => $jual_id));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //Detail
    public function detail($jual_id=null){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'master_jual'    => $this->Barang_jual_model->get_master_jual($jual_id),
                'detail_jual'    => $this->Barang_jual_model->get_detail_jual($jual_id),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Transaksi Barang jual',
                'content' => $this->load->view('admin/barang_jual/penjualan_barang_detail', $data,true)
            );
            //$x['content']=$this->load->view('template_form',$content,true);
            //print_r($this->Barang_jual_model->get_detail_jual($jual_id));
            $this->load->view('template',$content);
        } 
    }

    public function cetak($jual_id=null){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'master_jual'    => $this->Barang_jual_model->get_master_jual($jual_id),
                'detail_jual'    => $this->Barang_jual_model->get_detail_jual($jual_id),
                'menu'=>$auth['menu']
            );
            
            $this->load->view('admin/barang_jual/penjualan_faktur', $data);
        } 
    }

    //Add List
    public function add_list($barang_id=null){
        
        $data=array(
            'tmp_jualtipe'      => $this->input->post('tipe'),
            'tmp_tipeharga'      => $this->input->post('jenisharga'),
            'tmp_barangid'      => $this->input->post('id'),
            'tmp_jumlah'        => $this->input->post('jml'),
            'tmp_hargasatuan'   => $this->input->post('harga'),
            'tmp_konversisatuan'   => $this->input->post('konversi_satuan'),
            'tmp_diskon'        => $this->input->post('diskon'),
            'tmp_satuan'        => $this->input->post('satuan'),
            'tmp_session'       => session_id(),
        );
        $response = $this->Barang_jual_model->addTemp($data);
        //$data=session_id();
        
        echo json_encode($response);
    }
    function gettemp(){
        $data=array('tmp'=>$this->Barang_jual_model->getTemp());
        $view = $this->load->view('admin/barang_jual/penjualan_temp',$data,true);
        echo json_encode($view);
    }

    function cleartemp(){
        $this->db->where('tmp_session',session_id());
        $this->db->delete('tmp_jual');
        $data=array('tmp'=>$this->Barang_jual_model->getTemp());
        $view = $this->load->view('admin/barang_jual/penjualan_temp',$data,true);
        echo json_encode($view);
    }
    //Auth
    public function _auth(){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'penjualan');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'penjualan');
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $x['add']=$a['add1'];
            $x['update']=$a['update1'];
            $x['delete']=$a['delete1'];
            $x['report']=$a['report1'];
        }
        return $x;
    }
}

/* End of file Barang_jual.php */
/* Location: ./application/models/Barang_jual.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 06 Nov 2017 10:54:47 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */