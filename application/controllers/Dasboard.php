<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasboard extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('captcha','date','text_helper','form','url'));
        $this->load->model('Auth_model');
    }

    public function index(){
        $id_group=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($id_group,'dasboard');
        $priv_count=$this->Auth_model->cek_privilage($id_group,'dasboard');
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        foreach ($priv as $a) {
            $x['add']=$a['add1'];
            $x['update']=$a['update1'];
            $x['delete']=$a['delete1'];
        }
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $username=$this->session->userdata('username');
        $x['data']='';
        $x['penjualan'] = $this->Auth_model->getPenjualan($this->session->userdata("username"));
        $x['pembelian'] = $this->Auth_model->getPembelian($this->session->userdata("username"));
        $x['piutang'] = $this->Auth_model->getPiutang($this->session->userdata("username"));
        $x['hutang'] = $this->Auth_model->getHutang($this->session->userdata("username"));
        //print_r($x);exit;
        if($priv_count>0){
            $x['content']=$this->load->view('admin/dasboard/view_dasboard',$x,true);
        }else{
            $x['content']=$this->load->view('access_denied',$x,true);
        }
        $this->load->view('template',$x);
    }
}
