<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Daftar_barang_masuk extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Daftar_barang_masuk_model');
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
                'title' => 'List Daftar barang masuk',
                'isi' => $this->load->view('admin/daftar_barang_masuk/daftar_barang_masuk_list', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }
    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
    /*Load Data JSON*/
    public function data(){
        $auth=$this->_auth();
        if($auth['priv_count']){
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));
            $limit = 10;
            $data = $this->Daftar_barang_masuk_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Daftar_barang_masuk_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $total_transaksi=$this->Daftar_barang_masuk_model->total_transaksi($row->masuk_id);

                if(!empty($total_transaksi)) $tot=$total_transaksi->tot; else $tot=0;
                $edit="<a href='" .base_url() ."pembelian_barang/detail/" .$row->masuk_id ."' class='btn btn-success btn-xs'><span class='fa fa-search'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->masuk_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'masuk_id'=>$row->masuk_id,
                    'masuk_nofaktur'=>$row->masuk_nofaktur,
                    'pemasok_nama'=>$row->pemasok_nama,
                    'masuk_tanggal'=>$this->longdate($row->masuk_tanggal),
                    'masuk_tutup_buku'=>$row->masuk_tutup_buku,
                    'masuk_userinput'=>$row->masuk_userinput,
                    'total_transaksi'=>$tot,
                    'aksi'=>$edit ."|" .$delete
                );
                //print_r($tot);
            //echo "<br><br>";
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
            $masuk_id=$this->input->post('masuk_id');
            $data = array(
                'masuk_nofaktur' => $this->input->post('masuk_nofaktur'),
                'masuk_pemasok_id' => $this->input->post('masuk_pemasok_id'),
                'masuk_tanggal' => $this->input->post('masuk_tanggal'),
                'masuk_tutup_buku' => $this->input->post('masuk_tutup_buku'),
                'masuk_userinput' => $this->input->post('masuk_userinput'),
            );
            if(empty($masuk_id)){
                $insert = $this->Daftar_barang_masuk_model->save($data);
            }else{
                $this->Daftar_barang_masuk_model->update($data,$masuk_id);
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
            $data = $this->Daftar_barang_masuk_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Daftar_barang_masuk_model->delete($id);
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //Auth
    public function _auth(){
        $this->load->model('Auth_model');
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'daftar_barang_masuk');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'daftar_barang_masuk');
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

/* End of file Daftar_barang_masuk.php */
/* Location: ./application/models/Daftar_barang_masuk.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 06 Nov 2017 09:01:08 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */