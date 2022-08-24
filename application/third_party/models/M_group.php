<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_group extends CI_Model {

	
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_group');
        $this->db->like('group_name',$search,'both');
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
    public function privilage($group_id){
        $this->db->select('*');
        $this->db->from('tbl_nav');
        $this->db->join('tbl_nav_group','tbl_nav.id_nav=tbl_nav_group.id_nav','left');
        $this->db->where('id_group',$group_id);
        $this->db->order_by('tbl_nav.id_nav');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function hak_akses($group_id){
        $str_menu="";

        $this->db->select('*');
        $this->db->from('tbl_nav');
        $this->db->where('tbl_nav.status','Active');
        $this->db->order_by('parent_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            $menu_l1=$q->result_array();
            foreach ($menu_l1 as $l1) {
                $id_nav=$l1['id_nav'];
                $parent_idx=$l1['parent_idx'];
                $nav_title=$l1['nav_title'];
                $nav_url=$l1['nav_url'];
                $current=$this->uri->segment(2);
                
                $this->db->select('*');
                $this->db->from('tbl_nav_group');
                $this->db->where('id_nav', $id_nav);
                $this->db->where('id_group',$group_id);
                $q2=$this->db->get();
                /*Menu Level 2*/
                if($q2->num_rows() > 0) {
                    /*Jika Parent mempunyai Child*/
                    $menul2 =$q2->result_array();
                    foreach ($menul2 as $m2) {
                        if($m2['add1']=='Y') $add='checked'; else $add='';
                        if($m2['update1']=='Y') $update='checked'; else $update='';
                        if($m2['delete1']=='Y') $delete='checked'; else $delete='';
                    }
                    $str_menu=$str_menu .'<div class="col-sm-6 col-xs-6" >';
                    $str_menu=$str_menu .'<input type=hidden name="nav[]" value="' .$id_nav .'"><input type="checkbox" name="id_nav[]" value="' .$id_nav .'" checked>' .$nav_title .'</div>';
                    $str_menu=$str_menu .'<div class="col-sm-2 col-xs-2"><input type="checkbox" name="add[]" value="Y" ' .$add .'>Add</div>
                          <div class="col-sm-2 col-xs-2"><input type="checkbox" name="update[]" value="Y" ' .$update .'>Update</div>
                          <div class="col-sm-2 col-xs-2"><input type="checkbox" name="delete[]" value="Y" ' .$delete .'>Delete</div>';
                    //$str_menu=$str_menu ."</div>";
                }
                else{
                    /*Jika Parent Tidak ada Child*/
                    $str_menu=$str_menu .'<div class="col-sm-6 col-xs-6" >';
                    $str_menu=$str_menu .'<input type=hidden name="nav[]" value="' .$id_nav .'"><input type="checkbox" name="id_nav[]" value="' .$id_nav .'">' .$nav_title .'</div>';
                    $str_menu=$str_menu .'<div class="col-sm-2 col-xs-2"><input type="checkbox" name="add[]" value="Y">Add</div>
                          <div class="col-sm-2 col-xs-2"><input type="checkbox" name="update[]" value="Y">Update</div>
                          <div class="col-sm-2 col-xs-2"><input type="checkbox" name="delete[]" value="Y">Delete</div>';
                    //$str_menu=$str_menu ."</div>";
                }
            }
            return $str_menu;
        }
        else
        {
            return $str_menu;   
        }
    }
}
