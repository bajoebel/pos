<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_navigation extends CI_Model {

	
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_nav');
        $this->db->like('nav_title',$search,'both');
        $this->db->like('nav_url',$search,'both');
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
}
