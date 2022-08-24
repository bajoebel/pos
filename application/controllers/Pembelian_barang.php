<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pembelian_barang extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Pembelian_barang_model');
    }
    /*Load Data HTML*/
    public function index(){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=4;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'list_pemasok'    => $this->Pembelian_barang_model->get_pemasok(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Transaksi Barang Masuk',
                'isi' => $this->load->view('admin/pembelian_barang/pembelian_barang_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }

    public function detail($masuk_id=null){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'master_masuk'    => $this->Pembelian_barang_model->get_master_masuk($masuk_id),
                'detail_masuk'    => $this->Pembelian_barang_model->get_detail_masuk($masuk_id),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Transaksi Barang Masuk',
                'content' => $this->load->view('admin/pembelian_barang/pembelian_barang_detail', $data,true)
            );
            //$x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$content);
        } 
    }
    /*Load Data JSON*/
    public function data(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 4;
            $data = $this->Pembelian_barang_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Pembelian_barang_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->barang_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->barang_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'barang_id'=>$row->barang_id,
                    'barang_kode'=>$row->barang_kode,
                    'barang_kategori_id'=>$row->barang_kategori_id,
                    'barang_rak_id'=>$row->barang_rak_id,
                    'barang_nama'=>$row->barang_nama,
                    'barang_description'=>$row->barang_description,
                    'barang_harga_pokok_lama'=>$row->barang_harga_pokok_lama,
                    'barang_harga_pokok_baru'=>$row->barang_harga_pokok_baru,
                    'barang_harga_jual'=>$row->barang_harga_jual,
                    'barang_harga_grosir'=>$row->barang_harga_grosir,
                    'barang_satuan_besar'=>$row->barang_satuan_besar,
                    'barang_satuan_kecil'=>$row->barang_satuan_kecil,
                    'barang_stok_besar'=>$row->barang_stok_besar,
                    'barang_stok_kecil'=>$row->barang_stok_kecil,
                    'barang_diskon'=>$row->barang_diskon,
                    'barang_konversi'=>$row->barang_konversi,
                    'barang_image'=>$row->barang_image,
                    'barang_userinput'=>$row->barang_userinput,
                    'barang_status'=>$row->barang_status,
                    'aksi'=>$edit ."|" .$delete
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
                'data'=>$this->Pembelian_barang_model->cariBarang($param)
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
            $barang = $this->Pembelian_barang_model->data_barang($limit, $start, $q);
            $row_count=$this->Pembelian_barang_model->total_barang($q);
            $data=array(
                'tipe'      => $tipe,
                'barang'    => $barang
            );
            $v_barang=$this->load->view('admin/pembelian_barang/view_barang', $data, true);
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
     public function detail_barang($id_barang){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $barang = $this->Pembelian_barang_model->detail_barang($id_barang);
            $data=array(
                'barang'    => $barang
            );
            $v_barang=$this->load->view('admin/pembelian_barang/detail_barang', $data, true);
            $list=array(
                'barang'    => $v_barang
            );
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    function gettemp(){
        $data=array('tmp'=>$this->Pembelian_barang_model->getTemp());
        $view = $this->load->view('admin/pembelian_barang/pembelian_temp',$data,true);
        echo json_encode($view);
    }
    public function histori(){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Daftar barang masuk',
                'isi' => $this->load->view('admin/daftar_barang_masuk/daftar_barang_masuk_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }
    /*save and update data*/
    public function save(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            //1. Jika Pemasok ID ="New" Simpan Data Pemasok baru kemudian simpan pemasok_id ke variabel
            $pemasok_id=$this->input->post('masuk_pemasok_id');
            if($pemasok_id=='New'){
                $pemasok=array(
                    'pemasok_nama'=>$this->input->post('pemasok_nama'),
                    'pemasok_kontak'=>$this->input->post('pemasok_kontak'),
                    'pemasok_alamat'=>$this->input->post('pemasok_alamat')
                );
                $this->load->model('pemasok_model');
                $pemasok_id=$this->pemasok_model->save($pemasok);
            }
            //2. Simpan Tabel Barang_masuk
            $master=array(
                'masuk_nofaktur' => $this->input->post('masuk_nofaktur'),
                'masuk_pemasok_id' => $pemasok_id,
                'masuk_tanggal' => $this->input->post('masuk_tanggal'),
                'masuk_carabayar'   =>$this->input->post('cara_bayar'),
                'masuk_userinput' => $auth['username'],
            );
            $masuk_id = $this->Pembelian_barang_model->save($master);
            //3. Simpan Ke Tabel detail_masuk
            $barang_id=$this->input->post('tmp_barangid');
            $harga=$this->input->post('tmp_harga');
            $jumlah=$this->input->post('tmp_jumlah');
            $diskon=$this->input->post('tmp_diskon');

            $hpppcs=$this->input->post('tmp_hpppcs');
            $tmp_konversisatuan=$this->input->post('tmp_konversisatuan');
            $tmp_satuan=$this->input->post('tmp_satuan');
            $cara_bayar=$this->input->post('cara_bayar');
            $tmp_jmlsatuan=$this->input->post('tmp_jmlsatuan');
            $jml_trans=count($barang_id);
            for($i=0;$i<$jml_trans;$i++){
                $detail[]=array(
                    'detail_masuk_id'   => $masuk_id,
                    'detail_barang_id'=>$barang_id[$i],
                    'detail_jumlah'=>$jumlah[$i],
                    'detail_diskon'=>$diskon[$i],
                    'detail_harga_satuan'=>$harga[$i],
                    'detail_hpppcs'=>$hpppcs[$i],
                    'detail_konversi'=>$tmp_konversisatuan[$i],
                    'detail_satuan'=>$tmp_satuan[$i]
                );
                // Insert log Transaksi
                
                $log=array(
                    'jns_transaksi'=>'BL',
                    'tgl_transaksi'=>date('Y-m-d H:i:s'),
                    'tgl_masuk'=>date('Y-m-d'),
                    'no_referensi'=>$masuk_id,
                    'barang_id'=>$barang_id[$i],
                    'harga_modal'=>$hpppcs[$i],
                    'jml_masuk'=>$tmp_jmlsatuan[$i],
                    'jml_keluar'=>0,
                    'konversi_satuan'=>$tmp_konversisatuan[$i],
                    'userinput'=>  $auth['username']
                );

                $this->Pembelian_barang_model->insertLog($log);
            }
            if(!empty($detail)){
                $this->db->insert_batch('detail_masuk',$detail);
            }
            
            
            $this->Pembelian_barang_model->deleteTemp(session_id());
            if($cara_bayar=="Kredit"){
                $hutang=array(
                    'hutang_tgl'        => date('Y-m-d'),
                    'hutang_transaksi'  =>'PB',
                    'hutang_koderef'    => $masuk_id,
                    'hutang_jml'        => $this->input->post('tagihan'),
                    'hutang_userinput'  => $auth['username']
                );
                $this->db->insert('hutang',$hutang);
            }
            $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
            echo json_encode(array("status" => TRUE,"masuk_id" => $masuk_id));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function add_list($barang_id=null){
        /*$data=array(
            'barang_id' => $this->input->post('id'),
            'barang_nama'=> $this->input->post('nama'),
            'barang_harga'=> $this->input->post('harga'),
            'jumlah'    => $this->input->post('jml')
        );
        echo json_encode($data);*/
        $data=array(
            'tmp_barangid'      => $this->input->post('id'),
            'tmp_jumlah'        => $this->input->post('jml'),
            'tmp_hargasatuan'   => $this->input->post('harga'),
            'tmp_hpppcs'        => $this->input->post('hpppcs'),
            'tmp_konversisatuan'=> $this->input->post('konversi'),
            'tmp_diskon'        => $this->input->post('diskon'),
            'tmp_satuan'        => $this->input->post('satuan'),
            'tmp_session'       => session_id(),
        );
        $response = $this->Pembelian_barang_model->addTemp($data);
        //$data=session_id();
        
        echo json_encode($response);
    }
    //Proses Load data for update 
    public function edit($id){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $data = $this->Pembelian_barang_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Pembelian_barang_model->delete($id);
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function deletetemp($id)
    {
        $auth = $this->_auth();
        if ($auth['delete']) {
            $this->Pembelian_barang_model->deleteTempByid($id);
            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("status" => FALSE));
        }
    }
    //Auth
    public function _auth(){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'pembelian_barang');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'pembelian_barang');
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

/* End of file Pembelian_barang.php */
/* Location: ./application/models/Pembelian_barang.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 20 Oct 2017 03:12:27 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */