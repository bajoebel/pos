<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_Model {

    public function cek_user($username, $password, $status){
        $hash_1st=md5($password);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('group','users.user_group_id=group.group_id');
        $this->db->where('username', $username);
        $this->db->where('user_password', $new_hash);
        //$this->db->where('status', $password);
        $this->db->where('user_status',$status);
        $q=$this->db->get();
        //print_r($q->result());  exit;
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
    }

    function longdate($date){
        $d=explode('-', $date);
        $m=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $new_date=$d[2] ." " .$m[intval($d[1])] ." " .$d[0];
        return $new_date;
    }
    
    public function menu($group_id,$actived=1){
        $str_menu="";

        $this->db->select('group.group_id,moduls.moduls_id,moduls_title, moduls_url,moduls_parent_idx,moduls_child_idx,moduls.moduls_status,add1,update1,delete1,moduls.icon');
        $this->db->from('moduls_group');
        $this->db->join('moduls','moduls_group.moduls_id=moduls.moduls_id');
        $this->db->join('group','moduls_group.group_id=group.group_id');
        $this->db->where('moduls_parent_idx >', 0);
        $this->db->where('moduls_child_idx',0);
        $this->db->where('moduls.moduls_status','Active');
        $this->db->where('group.group_id',$group_id);
        $this->db->order_by('moduls_parent_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            $menu_l1=$q->result_array();
            foreach ($menu_l1 as $l1) {
                $moduls_parent_idx=$l1['moduls_parent_idx'];
                $moduls_title=$l1['moduls_title'];
                
                $moduls_url=$l1['moduls_url'];
                $current=$this->uri->segment(2);
                //$url=explode('/', string)
                //if($current==$moduls_url)
                //$str_menu='<li class="current-menu-item menu-item-has-children">';
                /*Menu Level 2*/
                $this->db->select('group.group_id,moduls.moduls_id,moduls_title,moduls_url,moduls_parent_idx,moduls_child_idx, moduls.moduls_status,add1,update1,delete1,moduls.icon');
                $this->db->from('moduls_group');
                $this->db->join('moduls','moduls_group.moduls_id=moduls.moduls_id');
                $this->db->join('group','moduls_group.group_id=group.group_id');
                $this->db->where('moduls_parent_idx', $moduls_parent_idx);
                $this->db->where('moduls_child_idx > ',0);
                $this->db->where('moduls.moduls_status','Active');
                $this->db->where('group.group_id',$group_id);
                $this->db->order_by('moduls_child_idx');
                $q2=$this->db->get();
                /*Menu Level 2*/
                if($q2->num_rows() > 0) {
                    /*Jika Parent mempunyai Child*/
                    $str_menu=$str_menu . '<li class="treeview">';
                    $str_menu=$str_menu .'<a href="#"><i class="'.$l1["icon"].'"></i> ' .$moduls_title . '<span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span></a>';
                    $str_menu=$str_menu . '<ul class="treeview-menu" role="menu">';
                    $menu_l2=$q2->result_array();
                    foreach ($menu_l2 as $l2) {
                        if($moduls_url!="dasboard" || $moduls_url!="home"){
                            $str_menu=$str_menu .'<li><a href="' .base_url() .$l2['moduls_url'] . '"><i class="fa fa-dot-circle-o"></i>' .$l2['moduls_title'] .'</a></li>';
                        }
                    }
                    $str_menu=$str_menu .'</ul>';
                    $str_menu=$str_menu .'</li>';
                }
                else{
                    /*Jika Parent Tidak ada Child*/
                    if($moduls_url!="dasboard"){
                        $str_menu=$str_menu .'<li><a href="' .base_url() .strtolower($moduls_url) . '"><i class="' . $l1["icon"] . '"></i>' .$moduls_title .'<span class="sr-only">' .$moduls_title .'</span>' .'</a></li>';
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

    public function get_privilage($group_id,$link){
        $this->db->select('moduls_group.moduls_id,group.group_id,moduls.moduls_title,moduls.moduls_url, add1,update1, delete1,report1');
        $this->db->from('moduls_group');
        $this->db->join('group','group.group_id=moduls_group.group_id');
        $this->db->join('moduls','moduls_group.moduls_id=moduls.moduls_id');
        $this->db->where('moduls_group.group_id',$group_id);
        $this->db->where('moduls.moduls_url',$link);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
     }

    public function cek_privilage($group_id,$link){
        $this->db->select('moduls_group.moduls_id,group.group_id,moduls.moduls_title,moduls.moduls_url, add1,update1, delete1,report1');
        $this->db->from('moduls_group');
        $this->db->join('group','group.group_id=moduls_group.group_id');
        $this->db->join('moduls','moduls_group.moduls_id=moduls.moduls_id');
        $this->db->where('moduls_group.group_id',$group_id);
        $this->db->where('moduls.moduls_url',$link);
        $q=$this->db->get();
        return $q->num_rows();
    }

    public function get_notif(){
        $query=$this->db->query("SELECT barang_image,barang_nama,(`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) as stok, `barang_satuan_kecil`,`barang_min_stok` FROM `barang` WHERE (`barang_stok_besar` *`barang_konversi` + `barang_stok_kecil`) <= `barang_min_stok`");
        $a["jml_notif"]=$query->num_rows();
        $a["notif_detail"]=$query->result();
        return $a;
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

    public function save($nama_tabel, $data, $key, $key_value){
        if(!empty($key_value)){
            $this->db->where($key, $key_value);
            $this->db->update($nama_tabel,$data);
        }else
        {
            $this->db->insert($nama_tabel, $data);
        }
    }

    function getPenjualan($user){
        $this->db->select('SUM(detail_harga_satuan*detail_jumlah)-detail_diskon as penjualan');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->where('jual_tanggal',date('Y-m-d'));
        $this->db->where('jual_userinput',$user);
        return $this->db->get('barang_jual')->row();
    }
    function getPembelian($user){
        $this->db->select('SUM(detail_harga_satuan*detail_jumlah) - detail_diskon as pembelian');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->where('masuk_tanggal',date('Y-m-d'));
        $this->db->where('masuk_userinput',$user);
        return $this->db->get('barang_masuk')->row();
    }

    function getPiutang($user){
        $this->db->select('SUM(piutang_jml) as piutang');
        $this->db->where('piutang_tgl',date('Y-m-d'));
        $this->db->where('piutang_userinput',$user);
        return $this->db->get('piutang')->row();
    }

    function getHutang($user){
        $this->db->select('SUM(hutang_jml) as hutang');
        $this->db->where('hutang_tgl',date('Y-m-d'));
        $this->db->where('hutang_userinput',$user);
        return $this->db->get('hutang')->row();
    }
}