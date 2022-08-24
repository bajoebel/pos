<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaksi extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Transaksi_model');
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
                'list_akun'    => $this->Transaksi_model->get_akun(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Transaksi',
                'isi' => $this->load->view('admin/transaksi/transaksi_list', $data,true)
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
            $data = $this->Transaksi_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Transaksi_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->transaksi_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->transaksi_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'transaksi_id'=>$row->transaksi_id,
                    'akun_nama'=>$row->akun_nama,
                    'akun_jenis'=>$row->akun_jenis,
                    'transaksi_jumlah'=>$row->transaksi_jumlah,
                    'transaksi_catatan'=>$row->transaksi_catatan,
                    'transksi_tglinput'=>$row->transksi_tglinput,
                    'transaksi_tglupdate'=>$row->transaksi_tglupdate,
                    'transksi_userinput'=>$row->transksi_userinput,
                    'transaksi_userupdate'=>$row->transaksi_userupdate,
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
            $transaksi_id=$this->input->post('transaksi_id');
            if(empty($transaksi_id)){
                $userinput=$auth['username'];
                $userupdate=$auth['username'];
            }else{
                $userinput=$this->input->post('transksi_userinput');
                $userupdate=$auth['username'];
            }
            $data = array(
                'transaksi_akun_id'     => $this->input->post('transaksi_akun_id'),
                'transaksi_jumlah'      => $this->input->post('transaksi_jumlah'),
                'transaksi_catatan'     => $this->input->post('transaksi_catatan'),
                'transksi_tglinput'     => date('Y-m-d'),
                'transaksi_tglupdate'   => date('Y-m-d'),
                'transksi_userinput'    => $userinput,
                'transaksi_userupdate'  => $userinput,
            );
            if(empty($transaksi_id)){
                $insert = $this->Transaksi_model->save($data);
            }else{
                $this->Transaksi_model->update($data,$transaksi_id);
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
            $data = $this->Transaksi_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Transaksi_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'transaksi');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'transaksi');
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

/* End of file Transaksi.php */
/* Location: ./application/models/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 05 Dec 2017 11:27:40 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */