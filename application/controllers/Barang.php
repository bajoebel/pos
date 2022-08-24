<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Barang_model');
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
                'list_kategori'    => $this->Barang_model->get_kategori(),
                'list_rak'    => $this->Barang_model->get_rak(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Barang',
                'isi' => $this->load->view('admin/barang/barang_list', $data,true)
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
            $data = $this->Barang_model->get_limit_data($limit, $start, $q);
            $list[]=array();
            $row_count=$this->Barang_model->total_rows($q);
            foreach ($data as $row) {
                $start++;
                $harga="<a href='#' class='btn btn-warning btn-xs' onclick='setHarga(" .$row->barang_id .",\"".$row->barang_nama."\",\"".$row->barang_satuan_kecil."\",\"".$row->barang_satuan_besar."\")'><span class='fa fa-plus'></span> Set Harga</a>";
                $edit="<a href='#' class='btn btn-primary btn-xs' onclick='edit(" .$row->barang_id .")'><span class='fa fa-pencil'></span></a>";
                $delete="<a href='#' class='btn btn-danger btn-xs' onclick='remove(" .$row->barang_id .")'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                $list[]=array(
                    'start' =>$start,
                    'row_count' => $row_count,
                    'limit'     => $limit,
                    'barang_id'=>$row->barang_id,
                    'barang_kode'=>$row->barang_kode,
                    'barang_nama'=>$row->barang_nama,
                    'harga_modal'=>$row->harga_modal,
                    'stok'=>$row->stok,
                    'barang_min_stok'=>$row->barang_min_stok,
                    'barang_satuan_kecil'=>$row->barang_satuan_kecil,
                    'barang_satuan_besar'=>$row->barang_satuan_besar,
                    'barang_min_stok'=>$row->barang_min_stok,
                    'barang_konversi'=>$row->barang_konversi,
                    'stok_string'=>$row->stok_string,
                    'aksi'=>$harga."|".$edit ."|" .$delete
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
            //$error['x']="";
            $error=array();
            if($this->input->post('barang_status')=='Aktif') $barang_status='Aktif';
            else $barang_status='Tidak Aktif';

            $barang_id=$this->input->post('barang_id');
            $harga_pokok_lama=$this->input->post('barang_harga_pokok_lama');
            if(empty($harga_pokok_lama)) $barang_harga_pokok_lama=$this->input->post('barang_harga_pokok_baru');
            else $barang_harga_pokok_lama=$this->input->post('barang_harga_pokok_lama');
            /*
            $ext = explode(".", $_FILES['userfile']['name']);
            $ext = end($ext);
            $file="BRG_" .str_replace(" ","-",date("YmdHis")) ."." .$ext;
            $this->_file_upload('./upload/barang/original',$file,'gif|jpg|png');
                
            if($_FILES['userfile']['name']!=""){
                if (!$this->upload->do_upload())
                {
                    $error['upload'] = array('error' => $this->upload->display_errors());
                    //$this->session->set_flashdata('message', $error);
                    $barang_image=$this->input->post('barang_image');
                }
                else
                {
                    $barang_image=$file;
                }
            }else{
                $barang_image=$this->input->post('barang_image');
            }
            */
            $data = array(
                'barang_kode' => $this->input->post('barang_kode'),
                'barang_kategori_id' => $this->input->post('barang_kategori_id'),
                'barang_min_stok' => $this->input->post('barang_min_stok'),
                'barang_rak_id' => $this->input->post('barang_rak_id'),
                'barang_nama' => $this->input->post('barang_nama'),
                'barang_harga_pokok_lama' => $barang_harga_pokok_lama,
                'barang_harga_pokok_baru' => $this->input->post('barang_harga_pokok_baru'),
                'barang_harga_jual' => $this->input->post('barang_harga_jual'),
                'barang_harga_grosir' => $this->input->post('barang_harga_grosir'),
                'barang_satuan_besar' => $this->input->post('barang_satuan_besar'),
                'barang_satuan_kecil' => $this->input->post('barang_satuan_kecil'),
                'barang_stok_besar' => $this->input->post('barang_stok_besar'),
                'barang_stok_kecil' => $this->input->post('barang_stok_kecil'),
                'barang_konversi' => $this->input->post('barang_konversi'),
                'barang_description'=> $this->input->post('barang_description'),
                'barang_userinput' => $auth['username'],
                'barang_status' => $barang_status,
            );
            if(empty($barang_id)){
                $insert = $this->Barang_model->save($data);
                // Insert Log Transaksi
                $jml_masuk=($this->input->post('barang_stok_besar')*$this->input->post('barang_konversi'))+$this->input->post('barang_stok_kecil');
                $jml_keluar=0;
                $log=array(
                    'jns_transaksi'=>'SA',
                    'tgl_transaksi'=>date('Y-m-d H:i:s'),
                    'tgl_masuk'=>date('Y-m-d'),
                    'no_referensi'=>$insert,
                    'barang_id'=>$insert,
                    'harga_modal'=>$this->input->post('barang_harga_pokok_baru_pcs'),
                    'jml_masuk'=>$jml_masuk,
                    'jml_keluar'=>$jml_keluar,
                    'konversi_satuan'=>$this->input->post('barang_konversi'),
                    'userinput'=> $auth['username']
                );
                $this->db->insert('log_transaksi',$log);
                //Insert Jenis Harga
                $hjual[]=array(
                    'barang_id'=>$insert,
                    'harga_jual'=>$this->input->post('barang_harga_jual'),
                    'jml_item_perpcs'=>1,
                    'satuan'=>$this->input->post('barang_satuan_kecil')
                );
                $hjual[]=array(
                    'barang_id'=>$insert,
                    'harga_jual'=>$this->input->post('barang_harga_grosir'),
                    'jml_item_perpcs'=>$this->input->post('barang_konversi'),
                    'satuan'=>$this->input->post('barang_satuan_besar')
                );
                $this->db->insert_batch('barang_hjual',$hjual);

            }else{
                $this->Barang_model->update($data,$barang_id);
            }
            /*if(!empty($_FILES['userfile']['name'])){
                $thumb['image_library']     = 'gd2';
                $thumb['source_image']      = './upload/barang/original/' .$file;
                $thumb['create_thumb']      = FALSE;
                $thumb['maintain_ratio']    = TRUE;
                $thumb['width']             = 250;
                $thumb['height']            = 250;
                $thumb['new_image']         = './upload/barang/thumb/' .$file; 
                $this->load->library('image_lib', $thumb);
                //$this->image_lib->resize();

                if (!$this->image_lib->resize()) {
                    $error['thumb']= $this->image_lib->display_errors();
                }

                $icon['image_library']     = 'gd2';
                $icon['source_image']      = './upload/barang/original/' .$file;
                $icon['create_thumb']      = FALSE;
                $icon['maintain_ratio']    = TRUE;
                $icon['width']             = 128;
                $icon['height']            = 128;
                $icon['new_image']         = './upload/barang/icon/' .$file; 
                $this->image_lib->clear();
                $this->image_lib->initialize($icon);
                //$this->image_lib->resize();
                if (!$this->image_lib->resize()) {
                    $error['icon']= $this->image_lib->display_errors();
                }
            }*/
            $this->session->set_flashdata('error',$error);
            $this->session->set_flashdata('message','Data Barang berhasil disimpan');
            //echo json_encode(array("status" => TRUE));
            header('location:' .base_url() ."barang");
        }else{
            header('loacation:' .base_url() ."barang");
        }
    }
    public function addharga(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            
            $data = array(
                'barang_id' => $this->input->post('barang_id'),
                'harga_jual' => $this->input->post('hjual'),
                'jml_item_perpcs' => $this->input->post('jml_item_perpcs'),
                'satuan' => $this->input->post('satuan')
            );
            $this->db->insert('barang_hjual',$data);
            echo json_encode(array('status'=>true,'message'=>'Harga Berhasil Ditambahkan'));
        }else{
            echo json_encode(array('status'=>false,'message'=>'Tidak Memiliki Hak Akses'));
        }
    }
    function list_harga_jual($barangid){
        $this->db->where('barang_id',$barangid);
        $data=$this->db->get('barang_hjual')->result();
        echo json_encode($data);
    }
    
    //Proses Load data for update 
    public function edit($id){
        $auth=$this->_auth();
        if($auth['update']=='Y' || $auth['report']=='Y'){
            $data = $this->Barang_model->get_by_id($id);
            echo json_encode($data);
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }
    //delete data by id
    public function delete($id){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->Barang_model->delete($id);
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    function hapusharga($idx){
        $auth=$this->_auth();
        if($auth['delete']){
            $this->db->where('idx',$idx);
            $this->db->delete('barang_hjual');
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
        $priv=$this->Auth_model->get_privilage($x['id_group'],'barang');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'barang');
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

    public function test(){
        $this->load->model('Auth_model');
        $a=$this->Auth_model->get_notif();
        print_r($a);
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

/* End of file Barang.php */
/* Location: ./application/models/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 21 Oct 2017 07:12:17 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */