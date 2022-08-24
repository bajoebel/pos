<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Return_barang extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Barang_jual_model');
        $this->load->model('Barang_jual_model');
    }

    /*Load Data HTML*/
    public function index(){
        $q = urldecode($this->input->get('q', TRUE));
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $master=$this->Barang_jual_model->get_master_jual($q);
            if(!empty($master)) $jual_id=$master->jual_id; else $jual_id='';
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'master_jual'    => $master,
                'detail_jual'    => $this->Barang_jual_model->get_detail_jual($jual_id),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Return Barang',
                'isi' => $this->load->view('admin/return/penjualan_return', $data,true)
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
                'title' => 'List Barang jual',
                'isi' => $this->load->view('admin/return/penjualan_return_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }

    /*Load Data JSON*/
    public function data(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 10;
            $data = $this->Barang_jual_model->get_limit_data_return($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Barang_jual_model->total_rows_return($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->detail_return_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->detail_return_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'detail_retun_id'=>$row->detail_return_id,
                    'barang_nama'=>$row->barang_nama,
                    'pelanggan_nama'=>$row->pelanggan_nama,
                    'jml_return'=>$row->jml_return,
                    'detail_alasan_return'=>$row->detail_alasan_return,
                    'detail_return_harga'=>$row->detail_return_harga,
                    'return_tanggal'=>$row->return_tanggal,
                    'detail_harga_satuan'=>$row->detail_harga_satuan,
                    'barang_diskon'=>$row->barang_diskon,
                    'barang_satuan_besar'=>$row->barang_satuan_kecil,
                    'barang_satuan_kecil'=>$row->barang_satuan_kecil,
                    'detail_satuan'=>$row->detail_satuan,
                    'aksi'=>$delete
                );
            }
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    
    //Proses Load data for update 
    public function edit($id){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $data = $this->Barang_jual_model->get_return_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Barang_jual_model->delete_return($id);
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
            //2. Simpan Tabel Barang_jual
            $master=array(
                'return_jual_id'=>$this->input->post('return_jual_id'),
                'return_tanggal' => date('Y-m-d H:i:s'),
                'return_userinput' => $auth['username'],
            );
            $return_id = $this->Barang_jual_model->save_return($master);
            //3. Simpan Ke Tabel detail_jual
            $jml_trans=$this->input->post('jmldata');
            for($i=1;$i<=$jml_trans;$i++){
                if($this->input->post('jml_return' .$i)>0){
                    $detail[]=array(
                        'detail_return_id'      => $return_id,
                        'detail_detail_jual_id' => $this->input->post('detail_detail_jual_id' .$i),
                        'detail_alasan_return'  => $this->input->post('alasan' .$i),
                        'detail_jumlah'         => $this->input->post('jml_return' .$i),
                        'detail_return_harga'   => $this->input->post('jml_uang' .$i),
                        'detail_konversi_satuan'=> $this->input->post('konversi' .$i),
                        'detail_satuan'   => $this->input->post('detail_satuan' .$i)
                    );
                    $log=array(
                        'no_referensi'=>$return_id,
                        'jenis_ret'=>'JL',
                        'jual_id'=> $this->input->post('return_jual_id'),
                        'barang_id'=>$this->input->post('barang_id' .$i),
                        'jumlah'=>$this->input->post('jml_return' .$i),
                        'userinput'=>$auth['username']
                    );
                    $sisa=$this->Barang_jual_model->insertLogRet($log);
                }
            }
            if(!empty($detail)){
                $this->db->insert_batch('detail_return',$detail);
            }
            $this->session->set_flashdata('message', 'Data Berhasil Disimpan');
            header('location:' .base_url() ."Return_barang");
            //echo json_encode(array("status" => TRUE,"return_id" => $return_id));
        }else{
            //echo json_encode(array("status" => FALSE));
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

    //Add List
    public function add_list($barang_id=null){
        $data=array(
            'barang_id' => $this->input->post('id'),
            'barang_nama'=> $this->input->post('nama'),
            'barang_harga'=> $this->input->post('harga'),
            'jumlah'    => $this->input->post('jml'),
            'diskon'    => $this->input->post('diskon')
        );
        echo json_encode($data);
    }
    //Auth
    public function _auth(){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'return_barang');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'return_barang');
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