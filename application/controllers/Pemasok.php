<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pemasok extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Pemasok_model');
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
                'title' => 'List Pemasok',
                'isi' => $this->load->view('admin/pemasok/pemasok_list', $data,true)
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
            $data = $this->Pemasok_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Pemasok_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->pemasok_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->pemasok_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'pemasok_id'=>$row->pemasok_id,
                    'pemasok_nama'=>$row->pemasok_nama,
                    'pemasok_alamat'=>$row->pemasok_alamat,
                    'pemasok_kontak'=>$row->pemasok_kontak,
                    'pemasok_userinput'=>$row->pemasok_userinput,
                    'pemasok_status'=>$row->pemasok_status,
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
            if($this->input->post('pemasok_status')=='Aktif') $pemasok_status='Aktif';
            else $pemasok_status='Tidak Aktif';
            $pemasok_id=$this->input->post('pemasok_id');
            $data = array(
                'pemasok_nama' => $this->input->post('pemasok_nama'),
                'pemasok_alamat' => $this->input->post('pemasok_alamat'),
                'pemasok_kontak' => $this->input->post('pemasok_kontak'),
                'pemasok_userinput' => $this->input->post('pemasok_userinput'),
                'pemasok_status' => $pemasok_status,
            );
            if(empty($pemasok_id)){
                $insert = $this->Pemasok_model->save($data);
            }else{
                $this->Pemasok_model->update($data,$pemasok_id);
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
            $data = $this->Pemasok_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Pemasok_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'pemasok');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'pemasok');
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

/* End of file Pemasok.php */
/* Location: ./application/models/Pemasok.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 19 Oct 2017 11:03:48 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */