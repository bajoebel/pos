<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rss extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	function list_post($limit){
		$this->db->select('*');
		$this->db->from('tbl_post');
		$this->db->order_by('post_id','DESC');
		$this->db->limit($limit);
		$q=$this->db->get();
        if($q->num_rows() >0){
            return $q->result_array();
        }else{
            return array();
        }
	}
	
}