<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function cek_user($username, $password, $status){

       /* $hash_1st=md5($this->input->post('user_password1'));
                    $key=substr($hash_1st, 5, 5);
                    $new_hash=md5($key .$hast_1st .$key);
                    $baru=md5($new_hash);*/

        $hash_1st=md5($password);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->where('user_password', $new_hash);
        //$this->db->where('user_password', $password);
        $this->db->where('user_status',$status);
        $q=$this->db->get();
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
    }

    public function cek_member($username,$password,$status){
        $hash_1st=md5($password);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        $this->db->select('*');
        $this->db->from('jp_member');
        $this->db->where('member_username', $username);
        $this->db->where('member_password', $new_hash);
        //$this->db->where('user_password', $password);
        if(!empty($status)) $this->db->where('member_status',$status);
        $q=$this->db->get();
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
    }
    public function tampil_data($nama_tabel){
        $q=$this->db->get($nama_tabel);
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    public function jumlah_data($nama_tabel){

        $q=$this->db->get($nama_tabel);
        return $q->num_rows();
    }
    public function post_galery(){
        $this->db->select('*');
        $this->db->from('tbl_album');
        $this->db->join('tbl_photo','album_id=photo_album_id');
        $this->db->where('album_post','Aktif');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    
    public function tampil_data_post(){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->join('tbl_post_kategori','post_kategori_id=kategori_id');
        $this->db->order_by("post_id", "DESC");
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function tampil_data_project(){
        $this->db->select('*');
        $this->db->from('tbl_prj');
        $this->db->join('tbl_prj_kategori','tbl_prj.prj_kategori_id=tbl_prj_kategori.prj_kategori_id');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function tampil_data_komentar(){
        $this->db->select('*');
        $this->db->from('tbl_komentar');
        $this->db->join('tbl_post','komentar_post_id=post_id');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    public function tampil_data_testimoni(){
        $this->db->select('*');
        $this->db->from('tbl_testimoni');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    public function info(){
        $this->db->select('*');
        $this->db->from('tbl_web_identitas');
        $this->db->order_by('web_id','DESC');
        $this->db->limit(1);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    
    public function tampil_data_byid($nama_tabel,$key,$key_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where($key,$key_value);
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function simpan($nama_tabel, $data, $key, $key_value){
        if($key_value!=""){
            $this->db->where($key, $key_value);
            $this->db->update($nama_tabel,$data);
        }else
        {
            $this->db->insert($nama_tabel, $data);
        }
    }
    
    public function hapus($nama_tabel,$key,$key_value){
        $this->db->where($key,$key_value);
        $this->db->delete($nama_tabel);
    }
}
