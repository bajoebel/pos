<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Group_model');
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
                'title' => 'List Group',
                'isi' => $this->load->view('admin/group/group_list', $data,true)
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
            $data = $this->Group_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Group_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->group_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->group_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'group_id'=>$row->group_id,
                    'group_name'=>$row->group_name,
                    'status'=>$row->status,
                    'admin'=>$row->admin,
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
            if($this->input->post('status')=='Active') $status='Active';
            else $status='Non Active';
            if($this->input->post('admin')=='Y') $admin='Y';
            else $admin='N';
            $group_id=$this->input->post('group_id');
            $data = array(
                'group_name' => $this->input->post('group_name'),
                'status' => $status,
                'admin' => $admin,
                'info1' => $this->input->post('info1'),
                'info2' => $this->input->post('info2'),
            );
            if(empty($group_id)){
                $insert = $this->Group_model->save($data);
            }else{
                $this->Group_model->update($data,$group_id);
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
            $data = $this->Group_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Group_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'group');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'group');
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

/* End of file Group.php */
/* Location: ./application/models/Group.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 20 Oct 2017 09:12:39 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */