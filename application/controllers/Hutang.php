<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {
    private $akses=array();
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('hutang_model');
        $level=$this->session->userdata('level');
        
    }
        
	public function index(){
        $auth=$this->_auth();
        if($auth['priv_count']>0){
            $data=array(
                'menu'=>$auth['menu']
            );
            
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'Data Hutang',
                'isi' => $this->load->view('admin/hutang/view_tabel', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }
        else{
            $this->session->set_flashdata('error', 'Opps... Session expired' );
            header('location:'.base_url() ."login");
        }
        
    }
    function histori($id=""){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $list=array(
                'data'     => $this->hutang_model->histori_bayar($id),
            );
            $res= $this->load->view('admin/hutang/histori_bayar', $list,true);
            echo json_encode($res);
        }
    }
	public function data(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 20;
            $row_count=$this->hutang_model->countHutang($q);
            $list=array(
                'status'    => true,
                'message'   => "OK",
                'start'     => $start,
                'row_count' => $row_count,
                'limit'     => $limit,
                'data'     => $this->hutang_model->getHutanglimit($limit,$start,$q),
            );
        }else{
            $list=array(
                'status'    => false,
                'message'   => "Anda tidak berhak untuk mengakases halaman ini",
                'data'      => array()
            );
        }
        header('Content-Type: application/json');
        echo json_encode($list);
    }
	function edit($id=""){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $row=$this->hutang_model->getHutang_by_id($id);
            if(!empty($row)){
                $response=array(
                    'status'    => true,
                    'message'   => "OK",
                    'data'      => $row
                );
            }else{
                $response=array(
                    'status'    => false,
                    'message'   => "Data Tidak ditemukan",
                    'data'      => array()
                );
            }
            
        }else{
            $response=array(
                'status'    => false,
                'message'   => "Anda tidak berhak untuk mengakases halaman ini"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
	function save(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            $hutang_id=$this->input->post('hutang_id');
            $data = array(
                'bayar_tgl' => date('Y-m-d'),
                'bayar_hutangid' => $hutang_id,
                'bayar_jml' => $this->input->post('jml_pembayaran'),
                'bayar_userinput' => $auth['username'],
            );
            $insert = $this->hutang_model->insertHutang($data);
            header('Content-Type: application/json');
            echo json_encode(array("status" => TRUE,"message"=>"Data berhasil di simpan"));
            
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => False, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
    }
	/*function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->hutang_model->deleteHutang($id);
            header('Content-Type: application/json');
            echo json_encode(array("status" => TRUE, "message"=> "Data Berhasil dihapus"));
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status" => FALSE, "message"=> "Anda tidak berhak untuk mengakases halaman ini"));
        }
        
    }*/
	
    public function _auth(){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'barang');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'barang');
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