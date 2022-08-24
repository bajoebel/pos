<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		//$this->load->library(array('form_validation', 'Recaptcha'));
		$this->load->helper(array('captcha','date','text_helper','form','url'));
		$this->load->library('pagination');
		$this->load->model('Auth_model');
		//$this->load->model('m_profile');
		//$this->load->helper(array('captcha','url'));
		//session_start();
	}

	public function index(){
		$x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
		$username=$this->session->userdata('username');
		
		/*tampil_data_perfield($nama_tabel,$key,$key_value)*/
		
		$data=$this->Auth_model->tampil_data_perfield('users','username',$username);
		foreach ($data as $d) {
			# code...
			$x['username']=$username;
			$x['user_password']=$d['user_password'];
			$x['user_nama_lengkap']=$d['user_nama_lengkap'];
			$x['user_email']=$d['user_email'];
			$x['user_kontak']=$d['user_kontak'];
			$x['user_alamat']=$d['user_alamat'];
			$x['user_status']=$d['user_status'];
			$x['user_photo']=$d['user_photo'];
		}
		$x['content']=$this->load->view('Users/view_profile',$x,true);
		$this->load->view('template',$x);
	}

	public function save(){
		$username=$this->session->userdata('username');
		$data=array(
			'username'=>$username,
			'user_nama_lengkap'=>$this->input->post('user_nama_lengkap'),
			'user_email'=>$this->input->post('user_email'),
			'user_kontak'=>$this->input->post('user_kontak'),
			'user_alamat'=>$this->input->post('user_alamat')
		);
		$this->Auth_model->save('users', $data, 'username', $username);
		$messege= array(
			'messege'=> "Data Berhasil Disimpan"
		);
		$this->session->set_flashdata('success',$messege);
		header('location:'.base_url().'profile');
	}

	public function upload_foto(){
		$file="USER_" .date('dmY') ."_" .$_FILES['userfile']['name'];
        $config['upload_path']          = './upload/user/original/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 3000;
        $config['max_height']           = 1600;
        $config['overwrite']            = true;
        $config['file_name']            = $file;
		
		$this->load->library('upload', $config);
        if($_FILES['userfile']['name']!=""){
            if ( ! $this->upload->do_upload('userfile'))
            {
            	
				$pesan=$this->upload->display_errors();
				$messege= array(
					'messege'=> $pesan
				);
				$this->session->set_flashdata('message',$messege);
                header('location:'.base_url().'profile');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                //$user_photo=$this->upload->file_name;
                $data= array(
                	'user_photo'=>$file
                );
                $this->Auth_model->save("users",$data,"username",$this->session->userdata('username'));
                $thumb['image_library']     = 'gd2';
                $thumb['source_image']      = './upload/user/original/' .$file;
                $thumb['create_thumb']      = FALSE;
                $thumb['maintain_ratio']    = TRUE;
                $thumb['width']             = 350;
                $thumb['height']            = 250;
                $thumb['new_image']         = './upload/user/thumb/' .$file; 
                $this->load->library('image_lib', $thumb);
                $this->image_lib->resize();
                $icon['image_library']     = 'gd2';
                $icon['source_image']      = './upload/user/original/' .$file;
                $icon['create_thumb']      = FALSE;
                $icon['maintain_ratio']    = TRUE;
                $icon['width']             = 100;
                $icon['new_image']         = './upload/user/icon/' .$file; 
                $this->image_lib->clear();
                $this->image_lib->initialize($icon);
                $this->image_lib->resize();
              	$messege= array(
					'messege'=> "Foto Berhasil diupload"
				);
				
				$this->session->set_flashdata('success',$messege);
                header("location:".base_url()."profile");
            }
        }
        else
        {
            $messege= array(
				'messege'=> "Tidak ada file yang dipilih"
			);
				
			$this->session->set_flashdata('message',$messege);
            header("location:".base_url()."profile");
        }
	}

	public function change_password(){
		$username=$this->session->userdata('username');
		$current_password=$this->session->userdata('user_password');
		$old_password=$this->input->post('old_password');
		$new_password=$this->input->post('new_password');
		$retype_password=$this->input->post('retype_password');
		if($current_password==$old_password){
			if ($new_password==$retype_password) {

				$hash_1st=md5($this->input->post('new_password'));
                $key=substr($hash_1st, 5,5);
                $new_hash=md5($key .$hash_1st .$key);

				$data=array('user_password'=>$new_hash);
				$this->db->where('username',$username);
				$this->db->update('users',$data);
				$messege= array(
					'messege'=> "Password Berhasil diubah"
				);
				$this->session->set_flashdata('success',$messege);
				header('location:'.base_url().'profile');
			}
			else{
				$messege= array(
					'messege'=> "Periksa Kembali Password yang anda input"
				);
				$this->session->set_flashdata('message',$messege);
				header('location:'.base_url().'profile');
			}
        }
        else{
        	$messege= array(
				'messege'=> "Password yang anda input salah"
			);
			$this->session->set_flashdata('message',$messege);
			header('location:'.base_url().'profile');
        }
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/assesmen.php */