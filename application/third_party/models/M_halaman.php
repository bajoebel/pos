<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_halaman extends CI_Model {

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
    public function json_berita($limit){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->join('tbl_komentar','komentar_post_id=post_id','left');
        $this->db->join('tbl_post_kategori','post_kategori_id=kategori_id','left');
        $this->db->where('post_status_publish','Publish');
        $this->db->order_by('post_tgl', 'DESC');
        $this->db->limit($limit);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function identitas(){
        $this->db->select('*');
        $this->db->from('tbl_web_identitas');
        $this->db->order_by('web_id');
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

    public function relasi($status){
        $this->db->select('*');
        $this->db->from('tbl_relasi');
        $this->db->where('relasi_status',$status);
        $this->db->order_by('relasi_id');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function json_galeri($limit){
        $this->db->select('*');
        $this->db->from('tbl_album');
        $this->db->where('album_slid','Aktif');
        $this->db->limit($limit);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function menu_level1(){
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where('menu_utama_idx >', 0);
        $this->db->where('menu_sub_idx',0);
        $this->db->where('menu_status','Aktif');
        $this->db->order_by('menu_utama_idx');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function menu_level2($menu_utama_idx){
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where('menu_utama_idx', $menu_utama_idx);
        $this->db->where('menu_sub_idx > ',0);
        $this->db->where('menu_status','Aktif');
        $this->db->order_by('menu_utama_idx');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function galeri(){
        $this->db->select('*');
        $this->db->from('tbl_album');
        $this->db->join('tbl_photo','album_id=photo_album_id');
        $this->db->where('album_slid', 'Aktif');
        $this->db->where('photo_status', 'Publish');
        $this->db->order_by('album_id','DESC');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function urutan_posting($parameter_urut, $limit){
        $this->db->select('*, sum(komentar_id) as jml_komentar');
        $this->db->from('tbl_post');
        $this->db->join('tbl_komentar', 'post_id=komentar_post_id', 'left');
        $this->db->join('tbl_post_kategori', 'post_kategori_id=kategori_id');
        $this->db->where('post_status_publish', 'Publish');
        $this->db->limit($limit);
        $this->db->group_by('post_id');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    public function urutan_posting_per_page($parameter_urut, $sampai,$dari){
        $this->db->select('*, sum(komentar_id) as jml_komentar');
        $this->db->from('tbl_post');
        $this->db->join('tbl_komentar', 'post_id=komentar_post_id', 'left');
        $this->db->join('tbl_post_kategori', 'post_kategori_id=kategori_id','left');
        $this->db->where('post_status_publish', 'Publish');
        $this->db->group_by('post_id');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function daftar_client(){
        $this->db->select('*');
        $this->db->from('tbl_client');
        $this->db->where('client_status', 'Aktif');
        $this->db->order_by('client_id','DESC');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    
    public function komentar(){
        $this->db->select('*');
        $this->db->from('tbl_komentar');
        $this->db->where('komentar_status','Aktif');
        $this->db->order_by('komentar_tgl', 'DESC');
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }
    
    public function banner($param){
        $this->db->select('*');
        $this->db->from('tbl_banner');
        if(!empty($param)) $this->db->where('banner_status',$param);
        $q=$this->db->get();
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    public function service($param){
        $this->db->select('*');
        $this->db->from('tbl_service');
        if(!empty($param)) $this->db->where('service_status',$param);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function detail_service($service_id){
        $this->db->select('*');
        $this->db->from('tbl_service');
        $this->db->where('service_id',$service_id);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function testimoni($param){
        $this->db->select('*');
        $this->db->from('tbl_testimoni');
        if(!empty($param)) $this->db->where('testimoni_status_publish',$param);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    
    public function post_perkategori($parameter_urut,$post_kategori_id,$sampai,$dari){
        $this->db->select('*, sum(komentar_id) as jml_komentar');
        $this->db->from('tbl_post');
        $this->db->join('tbl_komentar', 'post_id=komentar_post_id', 'left');
        $this->db->where('post_status_publish', 'Publish');
        $this->db->where('post_kategori_id', $post_kategori_id);
        $this->db->group_by('post_id');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    public function detail_berita($link){
        $this->db->select('*');
        $this->db->from('tbl_post');
        $this->db->where('link',$link);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    public function posting($parameter_urut,$utama,$limit){
        $this->db->select('*, sum(komentar_id) as jml_komentar');
        $this->db->from('tbl_post');
        $this->db->join('tbl_komentar', 'post_id=komentar_post_id', 'left');
        $this->db->join('tbl_post_kategori', 'post_kategori_id=kategori_id');
        $this->db->where('post_status_publish', 'Publish');
        $this->db->where('utama', $utama);
        $this->db->limit($limit);
        $this->db->group_by('post_id');
        $this->db->order_by($parameter_urut,'DESC');
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
