<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Moduls extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Moduls_model');
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
                'title' => 'List Moduls',
                'isi' => $this->load->view('admin/moduls/moduls_list', $data,true)
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
            $data = $this->Moduls_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Moduls_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->moduls_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->moduls_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'moduls_id'=>$row->moduls_id,
                    'moduls_title'=>$row->moduls_title,
                    'moduls_url'=>$row->moduls_url,
                    'moduls_parent_idx'=>$row->moduls_parent_idx,
                    'moduls_child_idx'=>$row->moduls_child_idx,
                    'moduls_status'=>$row->moduls_status,
                    'info1'=>$row->info1,
                    'info2'=>$row->info2,
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
            if($this->input->post('moduls_status')=='Active') $moduls_status='Active';
            else $moduls_status='Non Active';
            $moduls_id=$this->input->post('moduls_id');
            $data = array(
                'moduls_title' => $this->input->post('moduls_title'),
                'moduls_url' => $this->input->post('moduls_url'),
                'moduls_parent_idx' => $this->input->post('moduls_parent_idx'),
                'moduls_child_idx' => $this->input->post('moduls_child_idx'),
                'moduls_status' => $moduls_status,
                'info1' => $this->input->post('info1'),
                'info2' => $this->input->post('info2'),
            );
            if(empty($moduls_id)){
                $insert = $this->Moduls_model->save($data);
            }else{
                $this->Moduls_model->update($data,$moduls_id);
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
            $data = $this->Moduls_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Moduls_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'moduls');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'moduls');
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

/* End of file Moduls.php */
/* Location: ./application/models/Moduls.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 20 Oct 2017 09:13:05 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */