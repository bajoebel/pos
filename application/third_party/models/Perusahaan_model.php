<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Perusahaan_model extends CI_Model
{

    public $table = 'jp_perusahaan';
    public $id = 'id_perusahaan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_posting($perusahaan_id)
    {
        $this->db->join('jp_job_title','jp_posting.id_job_title=jp_job_title.jobtitle_id','left');
        $this->db->where('id_perusahaan',$perusahaan_id);
        $this->db->order_by('id_job_posting', $this->order);
        return $this->db->get('jp_posting')->result();
    }

    function get_permintaan($perusahaan_id)
    {
        $this->db->join('jp_job_produk','produk_id=permintaan_produk_id');
        $this->db->where('permintaan_perusahaan_id',$perusahaan_id);
        $this->db->order_by('permintaan_id', $this->order);
        return $this->db->get('jp_perusahaan_permintaan')->result();
    }

    // get data permintaann by id
    function get_permintaan_by_id($id)
    {
        $this->db->join('jp_job_produk','produk_id=permintaan_produk_id');
        $this->db->where('permintaan_id', $id);
        return $this->db->get('jp_perusahaan_permintaan')->row();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    
    public function member_premium(){
        $this->db->join('jp_job_produk','member_produk_id=produk_id','left');
        //$this->db->where('member_tipe', 'Premium');
        $this->db->order_by('member_nama');
        return $this->db->get('jp_member')->result();
    }
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_perusahaan', $q);
	$this->db->or_like('nama_perusahaan', $q);
	$this->db->or_like('status_perusahaan', $q);
	$this->db->or_like('alamat_perusahaan', $q);
	$this->db->or_like('telp_perusahaan', $q);
	$this->db->or_like('fax_perusahaan', $q);
	$this->db->or_like('email_perusahaan', $q);
	$this->db->or_like('website_perusahaan', $q);
	$this->db->or_like('deskripsi_perusahaan', $q);
	$this->db->or_like('logo_perusahaan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_perusahaan', $q);
	$this->db->or_like('nama_perusahaan', $q);
	$this->db->or_like('status_perusahaan', $q);
	$this->db->or_like('alamat_perusahaan', $q);
	$this->db->or_like('telp_perusahaan', $q);
	$this->db->or_like('fax_perusahaan', $q);
	$this->db->or_like('email_perusahaan', $q);
	$this->db->or_like('website_perusahaan', $q);
	$this->db->or_like('deskripsi_perusahaan', $q);
	$this->db->or_like('logo_perusahaan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insert_permintaan($data)
    {
        $this->db->insert('jp_perusahaan_permintaan', $data);
        return $this->db->insert_id();
    }

    function update_permintaan($id,$data)
    {
        $this->db->where('md5(permintaan_id)',$id);
        $this->db->update('jp_perusahaan_permintaan', $data);
        return $this->db->insert_id();
    }
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function get_permintaan_byid($id){
        $this->db->join('jp_job_produk','produk_id=permintaan_produk_id');
        $this->db->where('permintaan_id',$id);
        $this->db->order_by('permintaan_id', $this->order);
        return $this->db->get('jp_perusahaan_permintaan')->row();
        //return $query->row();
    }

    public function detail_permintaan($id){
        $this->db->join('jp_job_produk','produk_id=permintaan_produk_id');
        $this->db->join('jp_perusahaan','id_perusahaan=permintaan_perusahaan_id');
        $this->db->where('md5(permintaan_id)',$id);
        $this->db->order_by('permintaan_id', $this->order);
        return $this->db->get('jp_perusahaan_permintaan')->row();
        //return $query->row();
    }

    public function cek_cvenrol($field,$value){
        $this->db->where($field,$value);
        return $this->db->get('jp_perusahaan_enroll')->num_rows();
    }

    public function list_member($permintaan_id,$produk_id){
        $this->db->join('jp_job_produk','member_produk_id=produk_id','left');
        $this->db->join('jp_job_tipe','member_tipe_id=tipe_id','left');
        $this->db->join('jp_perusahaan_permintaan','permintaan_produk_id=produk_id','left');
        $this->db->join('jp_perusahaan_enroll','cvenrol_member_id=member_id','left');
        $this->db->where('member_produk_id',$produk_id);
        //$this->db->where('member_tipe','Premium');
        /*$this->db->group_start();
        $this->db->where('cvenrol_permintaan_id IS NULL');
        $this->db->or_where('cvenrol_permintaan_id<>',$permintaan_id);
        $this->db->group_end();
        $this->db->where('permintaan_id',$permintaan_id);
        $this->db->order_by('cvenrol_id','asc');*/
        return $this->db->get('jp_member')->result();
        
    }

    public function ambil_member_from($permintaan_id){
        $this->db->join('jp_job_produk','member_produk_id=produk_id');
        $this->db->join('jp_perusahaan_permintaan','permintaan_produk_id=produk_id');
        $this->db->join('jp_perusahaan_enroll','cvenrol_member_id=member_id','left');
        $this->db->where('member_tipe','Premium');
        $this->db->group_start();
        $this->db->where('cvenrol_permintaan_id IS NULL');
        $this->db->or_where('cvenrol_permintaan_id<>',$permintaan_id);
        $this->db->group_end();
        $this->db->where('permintaan_id',$permintaan_id);
        $this->db->order_by('cvenrol_id','asc');
        $sql_member=$this->db->get('jp_member');
        if($sql_member->num_rows()>0){

            foreach ($sql_member->result_array() as $row)
            {
                $result[$row['member_id']]= ucwords(strtolower($row['member_nama']) ."-" .strtolower($row['jobrole_nama']));
            }
        } else {
            $result['-']= '- Belum Ada Permintaan -';
        }
        return $result;
    }


    public function ambil_member_to($permintaan_id){
        $this->db->join('jp_member','cvenrol_member_id=member_id');
        $this->db->join('jp_job_produk','member_produk_id=produk_id');
        $this->db->where('cvenrol_permintaan_id',$permintaan_id);
        $this->db->order_by('cvenrol_id','asc');
        $sql_member=$this->db->get('jp_perusahaan_enroll');
        if($sql_member->num_rows()>0){

            foreach ($sql_member->result_array() as $row)
            {
                $result[$row['member_id']]= ucwords(strtolower($row['member_nama']) ."-" .strtolower($row['jobrole_nama']));
            }
            } else {
               $result['-']= '- Belum Ada Kabupaten -';
            }
            return $result;
    }

    public function generate_nomor_permintaan(){
        $this->db->order_by('permintaan_id', $this->order);
        $this->db->limit(1);
        $split1="INV";
        $split2="TLH";
        $split5="";
        $last_kode="";
        $exp_kode="";
        $bulan=explode("-", date("Y-m-d"));
        if($bulan[1]=='01') $split3="I";
        elseif($bulan[1]=='02') $split3="II";
        elseif($bulan[1]=='03') $split3="III";
        elseif($bulan[1]=='04') $split3="IV";
        elseif($bulan[1]=='05') $split3="V";
        elseif($bulan[1]=='06') $split3="VI";
        elseif($bulan[1]=='07') $split3="VII";
        elseif($bulan[1]=='08') $split3="VIII";
        elseif($bulan[1]=='09') $split3="IX";
        elseif($bulan[1]=='10') $split3="X";
        elseif($bulan[1]=='11') $split3="XI";
        elseif($bulan[1]=='12') $split3="XII";
        $split4=$bulan[0];

        $row = $this->db->get('jp_perusahaan_permintaan')->row();
        if ($row) {
            $last_kode=$row->permintaan_no; 
            $exp_kode=explode('/', $last_kode);
            $kode_int=(int) $exp_kode[4]; //konversi nilai string 0001 (nomerseri) ke integer 1
            $kode_baru=$kode_int+1;
            $split5=str_pad($kode_baru, 4, "0", STR_PAD_LEFT);
            $kode=$split1 ."/" .$split2 ."/" .$split3 ."/" .$split4 ."/" .$split5;
            
        }else{
            $kode=$split1 ."/" .$split2 ."/" .$split3 ."/" .$split4 ."/0001";
        }
        return $kode;
        //return $query->row();
    }

}

/* End of file Perusahaan_model.php */
/* Location: ./application/models/Perusahaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-08 05:42:54 */
/* http://harviacode.com */