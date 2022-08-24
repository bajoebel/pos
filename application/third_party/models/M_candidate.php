<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_candidate extends CI_Model {

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
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_candidat');
        
        $this->db->group_start();
        $this->db->like('candidat_nama',$search,'both');
        $this->db->or_like('candidat_alamat',$search,'both');
        $this->db->or_like('candidat_email',$search,'both');
        $this->db->or_like('candidat_telp',$search,'both');
        $this->db->or_like('candidat_personal_website',$search,'both');
        $this->db->or_like('candidat_pendidikan_terakhir',$search,'both');
        $this->db->or_like('candidat_sertifikat',$search,'both');
        $this->db->or_like('candidat_skill',$search,'both');
        $this->db->order_by($parameter_urut,$jns_urut);
        $this->db->group_end();
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
