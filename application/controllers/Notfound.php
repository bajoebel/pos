<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        // Your own constructor code
        
    }
    
	public function index()
	{
        
        $x['judul']=" 404 Page Not Found";
        $x['isi']="<h1 align='center'>Maaf Halaman yang anda cari tidak ditemukan!!</h1>";
        $x['error']=$this->load->view('404',$x,true);
        $this->load->view('error',$x);

	}

    
}

