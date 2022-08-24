<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pembelian extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Pembelian_model');
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
                
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Pembelian',
                'isi' => $this->load->view('admin/Pembelian/Pembelian_list', $data,true)
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
            $data = $this->Pembelian_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Pembelian_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->Pembelian_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->Pembelian_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'Pembelian_id'=>$row->Pembelian_id,
                    'Pembelian_nama'=>$row->Pembelian_nama,
                    'Pembelian_alamat'=>$row->Pembelian_alamat,
                    'peanggan_kontak'=>$row->peanggan_kontak,
                    'Pembelian_email'=>$row->Pembelian_email,
                    'Pembelian_image'=>$row->Pembelian_image,
                    'Pembelian_userinput'=>$row->Pembelian_userinput,
                    'Pembelian_status'=>$row->Pembelian_status,
                    'aksi'=>$edit ."|" .$delete
                );
            }
            echo json_encode($list);
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    /*save and update data*/
    public function save(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            if($this->input->post('Pembelian_status')=='Aktif') $Pembelian_status='Aktif';
            else $Pembelian_status='Tidak Aktif';
            $Pembelian_id=$this->input->post('Pembelian_id');
            $data = array(
                'Pembelian_nama' => $this->input->post('Pembelian_nama'),
                'Pembelian_alamat' => $this->input->post('Pembelian_alamat'),
                'peanggan_kontak' => $this->input->post('peanggan_kontak'),
                'Pembelian_email' => $this->input->post('Pembelian_email'),
                'Pembelian_image' => $this->input->post('Pembelian_image'),
                'Pembelian_userinput' => $this->input->post('Pembelian_userinput'),
                'Pembelian_status' => $Pembelian_status,
            );
            if(empty($Pembelian_id)){
                $insert = $this->Pembelian_model->save($data);
            }else{
                $this->Pembelian_model->update($data,$Pembelian_id);
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
            $data = $this->Pembelian_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Pembelian_model->delete($id);
            echo json_encode(array("status" => TRUE));
        }
        else{
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'Pembelian');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'Pembelian');
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

/* End of file Pembelian.php */
/* Location: ./application/models/Pembelian.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 19 Oct 2017 11:08:20 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */