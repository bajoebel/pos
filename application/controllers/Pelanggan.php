<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pelanggan extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Pelanggan_model');
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
                'title' => 'List Pelanggan',
                'isi' => $this->load->view('admin/pelanggan/pelanggan_list', $data,true)
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
            $data = $this->Pelanggan_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Pelanggan_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->pelanggan_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->pelanggan_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'pelanggan_id'=>$row->pelanggan_id,
                    'pelanggan_nama'=>$row->pelanggan_nama,
                    'pelanggan_alamat'=>$row->pelanggan_alamat,
                    'peanggan_kontak'=>$row->peanggan_kontak,
                    'pelanggan_email'=>$row->pelanggan_email,
                    'pelanggan_image'=>$row->pelanggan_image,
                    'pelanggan_userinput'=>$row->pelanggan_userinput,
                    'pelanggan_status'=>$row->pelanggan_status,
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
            if($this->input->post('pelanggan_status')=='Aktif') $pelanggan_status='Aktif';
            else $pelanggan_status='Tidak Aktif';
            $pelanggan_id=$this->input->post('pelanggan_id');
            $data = array(
                'pelanggan_nama' => $this->input->post('pelanggan_nama'),
                'pelanggan_alamat' => $this->input->post('pelanggan_alamat'),
                'peanggan_kontak' => $this->input->post('peanggan_kontak'),
                'pelanggan_email' => $this->input->post('pelanggan_email'),
                'pelanggan_image' => $this->input->post('pelanggan_image'),
                'pelanggan_userinput' => $this->input->post('pelanggan_userinput'),
                'pelanggan_status' => $pelanggan_status,
            );
            if(empty($pelanggan_id)){
                $insert = $this->Pelanggan_model->save($data);
            }else{
                $this->Pelanggan_model->update($data,$pelanggan_id);
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
            $data = $this->Pelanggan_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Pelanggan_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'pelanggan');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'pelanggan');
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

/* End of file Pelanggan.php */
/* Location: ./application/models/Pelanggan.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 19 Oct 2017 11:08:20 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */