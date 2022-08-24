<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_general extends CI_Model {

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
        $hash_1st=md5($password);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->join('tbl_group','tbl_user.id_group=tbl_group.id_group');
        $this->db->where('username', $username);
        $this->db->where('user_password', $new_hash);
        //$this->db->where('status', $password);
        $this->db->where('user_status',$status);
        $q=$this->db->get();
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
    }

    public function tampil_data($nama_tabel,$parameter_urut,$jns_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->order_by($parameter_urut,$jns_urut);
        $q=$this->db->get('',$sampai,$dari);
		if ($q->num_rows() > 0){
			return $q->result_array();
        }
		else
		{
			return array();	
		}
    }

    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
    public function generateCouponCode($length = 6, $pass=5) {
      $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $random_number=rand(1,9);
      $low_chart=str_shuffle('abcdefghijklmnopqrstuvwxyz');
      $khusus=substr(str_shuffle('@#!*'),0,1);
      $ret = '';
      $ret2='';
      for($i = 0; $i < $length; ++$i) {
        $random = str_shuffle($chars);
        $ret .= $random[0];
      }

      for($j = 0; $j < $pass; ++$j) {
        $random2 = str_shuffle($chars);
        $ret2 .= $random2[0];
      }
      return $ret ."-" .$random_number .$khusus .$ret2 ;
    }
    
    public function tampil_data_perfield($nama_tabel,$key,$key_value){
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

    public function tampil_data_range($nama_tabel,$key,$key_value){
        $val=explode('-', $key_value);
        $tgl_awal=$val[0] ."-" .$val[1] ."-" .$val[2];
        $tgl_akhir=$val[3] ."-" .$val[4] ."-" .$val[5]; 
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where( $key .' BETWEEN "' .$tgl_awal. '" and "' .$tgl_akhir .'"');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function total_data($nama_tabel,$parameter_field,$parameter_value){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        if(!empty($parameter_field) && !empty($parameter_value)){
            $this->db->where($parameter_field,$parameter_value);
        }
        $q=$this->db->get();
        return $q->num_rows();
    }
    public function total_task($username){
        $this->db->select('*');
        $this->db->from('tm_company');
        $this->db->join('tm_assignment','tm_assignment.id_company=tm_company.id_company');
        $this->db->where('tm_assignment.assignment_to',$username);
        $q=$this->db->get();
        return $q->num_rows();
     }
    public function total_pesan($assignment_to,$status){
        $this->db->select('*');
        $this->db->from('tm_assignment');
        $this->db->where('assignment_to', $assignment_to);
        $this->db->where('status',$status);
        $q=$this->db->get();
        return $q->num_rows();
    }

    public function detail_pesan($assignment_to,$status){
        $this->db->select('*');
        $this->db->from('tm_assignment');
        $this->db->join('tbl_user','username=assignment_from');
        $this->db->where('assignment_to', $assignment_to);
        $this->db->where('status',$status);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    public function save($nama_tabel, $data, $key, $key_value){
        if(!empty($key_value)){
            $this->db->where($key, $key_value);
            $this->db->update($nama_tabel,$data);
        }else
        {
            $this->db->insert($nama_tabel, $data);
        }
    }
    
    public function remove($nama_tabel,$key,$key_value){
        $this->db->where($key,$key_value);
        $this->db->delete($nama_tabel);
    }

    public function menu($group_id){
        $str_menu="";

        $this->db->select('tbl_group.id_group,tbl_nav.id_nav,nav_title, nav_url,parent_idx,child_idx,tbl_nav.status,add1,update1,delete1');
        $this->db->from('tbl_nav_group');
        $this->db->join('tbl_nav','tbl_nav_group.id_nav=tbl_nav.id_nav');
        $this->db->join('tbl_group','tbl_nav_group.id_group=tbl_group.id_group');
        $this->db->where('parent_idx >', 0);
        $this->db->where('child_idx',0);
        $this->db->where('tbl_nav.status','Active');
        $this->db->where('tbl_group.id_group',$group_id);
        $this->db->order_by('parent_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            $menu_l1=$q->result_array();
            foreach ($menu_l1 as $l1) {
                $parent_idx=$l1['parent_idx'];
                $nav_title=$l1['nav_title'];
                
                $nav_url=$l1['nav_url'];
                $current=$this->uri->segment(2);
                //$url=explode('/', string)
                //if($current==$nav_url)
                //$str_menu='<li class="current-menu-item menu-item-has-children">';
                /*Menu Level 2*/
                $this->db->select('tbl_group.id_group,tbl_nav.id_nav,nav_title,nav_url,parent_idx,child_idx, tbl_nav.status,add1,update1,delete1');
                $this->db->from('tbl_nav_group');
                $this->db->join('tbl_nav','tbl_nav_group.id_nav=tbl_nav.id_nav');
                $this->db->join('tbl_group','tbl_nav_group.id_group=tbl_group.id_group');
                $this->db->where('parent_idx', $parent_idx);
                $this->db->where('child_idx > ',0);
                $this->db->where('tbl_nav.status','Active');
                $this->db->where('tbl_group.id_group',$group_id);
                $this->db->order_by('child_idx');
                $q2=$this->db->get();
                /*Menu Level 2*/
                if($q2->num_rows() > 0) {
                    /*Jika Parent mempunyai Child*/
                    $str_menu=$str_menu .'<li class="dropdown">';
                    $str_menu=$str_menu .'<a href="#" class="dropdown-toggle" data-toggle="dropdown">' .$nav_title .'</a>';
                    $str_menu=$str_menu .'<ul class="dropdown-menu" role="menu">';
                    $menu_l2=$q2->result_array();
                    foreach ($menu_l2 as $l2) {
                        $str_menu=$str_menu .'<li><a href="' .base_url() .$l2['nav_url'] .'">' .$l2['nav_title'] .'</a></li>';
                    }
                    $str_menu=$str_menu .'</ul>';
                    $str_menu=$str_menu .'</li>';
                }
                else{
                    /*Jika Parent Tidak ada Child*/
                    if($nav_url!="dasboard" || $nav_url!="home"){
                        $str_menu=$str_menu .'<li><a href="' .base_url() .strtolower($nav_url) .'">' .$nav_title .'<span class="sr-only">' .$nav_title .'</span>' .'</a></li>';
                    }
                    
                }
            }
            return $str_menu;
        }
        else
        {
            return $str_menu;   
        }
    }

    public function task_detail_count(){
        $this->db->select('tbl_user.id_group,admin,username,user_fullname,COUNT(assignment_from) AS assign_count,group_name,curdate() as call_date');
        $this->db->from('tbl_user');
        $this->db->join('tbl_group','tbl_user.id_group=tbl_group.id_group','left');
        $this->db->join('tm_assignment','tbl_user.username=tm_assignment.assignment_from','left');
        $this->db->where('admin','N');
        $this->db->group_by('username');
        $this->db->order_by('tbl_user.id_group');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function tampil_data_user($id_group){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_group',$id_group);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
     public function get_privilage($id_group,$link){
        $this->db->select('tbl_nav_group.id_nav,tbl_group.id_group,tbl_nav.nav_title,tbl_nav.nav_url, add1,update1, delete1,report1');
        $this->db->from('tbl_nav_group');
        $this->db->join('tbl_group','tbl_group.id_group=tbl_nav_group.id_group');
        $this->db->join('tbl_nav','tbl_nav_group.id_nav=tbl_nav.id_nav');
        $this->db->where('tbl_nav_group.id_group',$id_group);
        $this->db->where('tbl_nav.nav_url',$link);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
     }

     public function cek_privilage($id_group,$link){
        $this->db->select('tbl_nav_group.id_nav,tbl_group.id_group,tbl_nav.nav_title,tbl_nav.nav_url, add1,update1, delete1,report1');
        $this->db->from('tbl_nav_group');
        $this->db->join('tbl_group','tbl_group.id_group=tbl_nav_group.id_group');
        $this->db->join('tbl_nav','tbl_nav_group.id_nav=tbl_nav.id_nav');
        $this->db->where('tbl_nav_group.id_group',$id_group);
        $this->db->where('tbl_nav.nav_url',$link);
        $q=$this->db->get();
        return $q->num_rows();
     }
    public function ambil_provinsi($id_def,$nama_def) {
        $sql_prov=$this->db->get('jp_provinsi');   
        if($sql_prov->num_rows()>0){
            foreach ($sql_prov->result_array() as $row)
            {
                $result[$id_def]= $nama_def;
                $result[$row['id_provinsi']]= ucwords(strtolower($row['nama_provinsi']));
            }
            return $result;
        }
    }
    public function ambil_kabupaten($kode_prop){
        $this->db->where('id_provinsi',$kode_prop);
        $this->db->order_by('nama_kabupaten','asc');
        $sql_kabupaten=$this->db->get('jp_kabupaten');
        if($sql_kabupaten->num_rows()>0){

            foreach ($sql_kabupaten->result_array() as $row)
            {
                $result[$row['id_kabupaten']]= ucwords(strtolower($row['nama_kabupaten']));
            }
            } else {
               $result['-']= '- Belum Ada Kabupaten -';
            }
            return $result;
    }
    
}
