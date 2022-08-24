<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang_exp extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Barang_exp_model');
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
                
                'list_barang'    => $this->Barang_exp_model->get_barang(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Barang_exp',
                'isi' => $this->load->view('admin/barang_exp/barang_exp_list', $data,true)
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
            $data = $this->Barang_exp_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Barang_exp_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->exp_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->exp_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'exp_id'=>$row->exp_id,
                    'barang_nama'=>$row->barang_nama,
                    'exp_exp_date'=>$row->exp_exp_date,
                    'exp_jml'=>$row->exp_jml,
                    'exp_inputat'=>$row->exp_inputat,
                    'exp_userinput'=>$row->exp_userinput,
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
            $exp_id=$this->input->post('exp_id');
            $data = array(
                'exp_barang_id' => $this->input->post('exp_barang_id'),
                'exp_exp_date' => $this->input->post('exp_exp_date'),
                'exp_jml' => $this->input->post('exp_jml'),
                'exp_inputat' => date('Y-m-d'),
                'exp_userinput' => $auth['username'],
            );
            if(empty($exp_id)){
                $insert = $this->Barang_exp_model->save($data);
            }else{
                $this->Barang_exp_model->update($data,$exp_id);
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
            $data = $this->Barang_exp_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Barang_exp_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'barang_exp');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'barang_exp');
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

/* End of file Barang_exp.php */
/* Location: ./application/models/Barang_exp.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 13 Dec 2017 09:32:55 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */