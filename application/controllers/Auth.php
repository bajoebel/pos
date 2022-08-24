<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('captcha','date','text_helper','form','url'));
        $this->load->model('Auth_model');
    }
    
    
    public function index(){
        header('location:'.base_url().'auth/login');
    }
    
    public function login(){
        $this->load->view('auth/view_login');   
    }

    public function cekuser(){
        $data_login=$this->Auth_model->cek_user($this->input->post('username'),$this->input->post('user_password'),'Aktif');  
        //print_r($data_login); exit;
        $count=0;
        foreach($data_login as $row){
            $count=$count+1;
            $user = array(
                'username'          => $this->input->post('username'),
                'user_password'     => $this->input->post('user_password'),
                'user_nama_lengkap' => $row['user_nama_lengkap'],
                'user_akses_level'   => $row['group_id'],
                'user_photo'        => $row['user_photo'],
                'admin'             => $row['admin'],
                'base_url'          => base_url()
            );
            $this->session->set_userdata($user);
            if($row['admin']=='Y'){
                header("location:".base_url()."dasboard");
            }else{
                header("location:".base_url()."dasboard");
            }
            
        }
        if($count==0){
            echo "<script>alert('Tidak Berhak Login'); document.location.href='" .base_url() ."auth';</script>";
        }
    }

    public function log_out(){
        $this->session->sess_destroy();
        header('location:'.base_url());
    }   
    
    
}