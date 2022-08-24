<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Users_model');
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
                
                'list_group'    => $this->Users_model->get_group(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Users',
                'isi' => $this->load->view('admin/users/users_list', $data,true)
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
            $data = $this->Users_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Users_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick=\"edit('" .$row->username ."')\"><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick=\"remove('" .$row->username ."')\"><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'username'=>$row->username,
                    'user_password'=>$row->user_password,
                    'user_nama_lengkap'=>$row->user_nama_lengkap,
                    'user_jekel'=>$row->user_jekel,
                    'user_alamat'=>$row->user_alamat,
                    'user_email'=>$row->user_email,
                    'user_kontak'=>$row->user_kontak,
                    'user_status'=>$row->user_status,
                    'user_photo'=>$row->user_photo,
                    'admin'=>$row->admin,
                    'user_group_id'=>$row->user_group_id,
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
            if($this->input->post('user_status')=='Aktif') $user_status='Aktif';
            else $user_status='Tidak Aktif';
            if($this->input->post('admin')=='Y') $admin='Y';
            else $admin='N';
            $username=$this->input->post('username');
            $hash_1st=md5($this->input->post('user_password'));
            $key=substr($hash_1st, 5,5);
            $new_hash=md5($key .$hash_1st .$key);
            $ext = explode(".", $_FILES['userfile']['name']);
            $ext = end($ext);
            $file="USER_" .str_replace(" ","-",date("YmdHis")) ."." .$ext;
            $this->_file_upload('./upload/users/original',$file,'gif|jpg|png');
                
            if($_FILES['userfile']['name']!=""){
                if (!$this->upload->do_upload())
                {
                    $error['upload'] = array('error' => $this->upload->display_errors());
                    //$this->session->set_flashdata('message', $error);
                    $user_photo=$this->input->post('user_photo');
                }
                else
                {
                    $user_photo=$file;
                }
            }else{
                $user_photo=$this->input->post('user_photo');
            }
            if($this->input->post('method')=='add'){
                $data = array(
                    'username'      => $this->input->post('username'),
                    'user_password' => $new_hash,
                    'user_nama_lengkap' => $this->input->post('user_nama_lengkap'),
                    'user_jekel' => $this->input->post('user_jekel'),
                    'user_alamat' => $this->input->post('user_alamat'),
                    'user_email' => $this->input->post('user_email'),
                    'user_kontak' => $this->input->post('user_kontak'),
                    'user_status' => $user_status,
                    'user_photo' => $this->input->post('user_photo'),
                    'admin' => $admin,
                    'user_group_id' => $this->input->post('user_group_id'),
                );
                $insert = $this->Users_model->save($data);
            }else{
                $data = array(
                    'user_nama_lengkap' => $this->input->post('user_nama_lengkap'),
                    'user_jekel' => $this->input->post('user_jekel'),
                    'user_alamat' => $this->input->post('user_alamat'),
                    'user_email' => $this->input->post('user_email'),
                    'user_kontak' => $this->input->post('user_kontak'),
                    'user_status' => $user_status,
                    'user_photo' => $this->input->post('user_photo'),
                    'admin' => $admin,
                    'user_group_id' => $this->input->post('user_group_id'),
                );
                $this->Users_model->update($data,$username);
            }

            if(!empty($_FILES['userfile']['name'])){
                $thumb['image_library']     = 'gd2';
                $thumb['source_image']      = './upload/users/original/' .$file;
                $thumb['create_thumb']      = FALSE;
                $thumb['maintain_ratio']    = TRUE;
                $thumb['width']             = 250;
                $thumb['height']            = 250;
                $thumb['new_image']         = './upload/users/thumb/' .$file; 
                $this->load->library('image_lib', $thumb);
                //$this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    $error['thumb']= $this->image_lib->display_errors();
                }

                $icon['image_library']     = 'gd2';
                $icon['source_image']      = './upload/users/original/' .$file;
                $icon['create_thumb']      = FALSE;
                $icon['maintain_ratio']    = TRUE;
                $icon['width']             = 128;
                $icon['height']            = 128;
                $icon['new_image']         = './upload/users/icon/' .$file; 
                $this->image_lib->clear();
                $this->image_lib->initialize($icon);
                //$this->image_lib->resize();
                if (!$this->image_lib->resize()) {
                    $error['icon']= $this->image_lib->display_errors();
                }
            }
            if(!empty($error)) $this->session->set_flashdata('error',$error);
            $this->session->set_flashdata('message','Data users berhasil disimpan');
            header('location:' .base_url() ."users");
            //echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //Proses Load data for update 
    public function edit($id){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $data = $this->Users_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Users_model->delete($id);
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'users');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'users');
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

    public function _file_upload($path,$filename,$filetype){
        $config['upload_path']          = $path;
        $config['allowed_types']        = $filetype;
        $config['max_size']             = 500;
        $config['max_width']            = 700;
        $config['max_height']           = 700;
        $config['overwrite']        = true;
        $config['file_name']            = $filename;
        $this->load->library('upload', $config);
    }
}

/* End of file Users.php */
/* Location: ./application/models/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 20 Oct 2017 09:20:52 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */