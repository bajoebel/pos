<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_company extends CI_Model {

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
	public function tampil_data($parameter_urut,$jns_urut,$search,$sampai,$dari,$username){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_perusahaan');
        
        $this->db->group_start();
        $this->db->like('perusahaan_nama',$search,'both');
        $this->db->or_like('perusahaan_alamat',$search,'both');
        $this->db->or_like('perusahaan_telp',$search,'both');
        $this->db->or_like('perusahaan_fax',$search,'both');
        $this->db->or_like('perusahaan_email',$search,'both');
        $this->db->or_like('perusahaan_website',$search,'both');
        $this->db->or_like('perusahaan_nama_pic',$search,'both');
        $this->db->or_like('perusahaan_telp_pic',$search,'both');
        $this->db->or_like('perusahaan_industri',$search,'both');
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

    public function view_all_data($parameter_urut,$jns_urut,$search,$sampai,$dari,$username){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_perusahaan');
        $this->db->where('userinput',$username);
        $this->db->or_where('assignment_to',$username);
        $this->db->group_start();
        $this->db->like('perusahaan_nama',$search,'both');
        $this->db->or_like('perusahaan_alamat',$search,'both');
        $this->db->or_like('perusahaan_telp',$search,'both');
        $this->db->or_like('perusahaan_fax',$search,'both');
        $this->db->or_like('perusahaan_email',$search,'both');
        $this->db->or_like('perusahaan_website',$search,'both');
        $this->db->or_like('perusahaan_nama_pic',$search,'both');
        $this->db->or_like('perusahaan_telp_pic',$search,'both');
        $this->db->group_end();
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

    public function all_data($parameter_urut,$jns_urut,$search,$sampai,$dari){
        if(!empty($search)){
            $sampai=0;
            $dari=0;
        }
        $this->db->select('*');
        $this->db->from('tbl_perusahaan');
        $this->db->group_start();
        $this->db->like('perusahaan_nama',$search,'both');
        $this->db->or_like('perusahaan_alamat',$search,'both');
        $this->db->or_like('perusahaan_telp',$search,'both');
        $this->db->or_like('perusahaan_fax',$search,'both');
        $this->db->or_like('perusahaan_email',$search,'both');
        $this->db->or_like('perusahaan_website',$search,'both');
        $this->db->or_like('perusahaan_nama_pic',$search,'both');
        $this->db->or_like('perusahaan_telp_pic',$search,'both');
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
