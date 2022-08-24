<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends CI_Model
{

    public $table = 'jp_member';
    public $id = 'member_id';
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

    // get Pendidikan
    function get_pendidikan($member_id)
    {
        $this->db->where('riwayat_pdd_member_id',$member_id);
        $this->db->order_by('riwayat_pdd_id', $this->order);
        return $this->db->get('jp_member_riwayat_pdd')->result();
    }

    function get_tipe()
    {
        $this->db->where('tipe_status','Aktif');
        $this->db->order_by('tipe_id', $this->order);
        return $this->db->get('jp_job_tipe')->result();
    }

    function get_sumber()
    {
        $this->db->where('sumber_status','Aktif');
        $this->db->order_by('sumber_id');
        return $this->db->get('jp_member_sumber')->result();
    }

    function get_produk()
    {
        $this->db->where('produk_status','Aktif');
        $this->db->order_by('produk_id', $this->order);
        return $this->db->get('jp_job_produk')->result();
    }

    public function get_pendidikan_byid($id){
        $this->db->where('riwayat_pdd_id',$id);
        $this->db->order_by('riwayat_pdd_id', $this->order);
        return $this->db->get('jp_member_riwayat_pdd')->row();
        //return $query->row();
    }

    public function delete_pendidikan_byid($id)
    {
        $this->db->where('riwayat_pdd_id', $id);
        $this->db->delete('jp_member_riwayat_pdd');
    }

    public function update_pendidikan($where, $data)
    {
        $this->db->update('jp_member_riwayat_pdd', $data, $where);
        return $this->db->affected_rows();
    }
    
    // get Pendidikan
    function get_sertifikasi($member_id)
    {
        $this->db->where('sertifikasi_member_id',$member_id);
        $this->db->order_by('sertifikasi_id', $this->order);
        return $this->db->get('jp_member_sertifikasi')->result();
    }

    public function get_sertifikasi_byid($id){
        $this->db->where('sertifikasi_id',$id);
        $this->db->order_by('sertifikasi_id', $this->order);
        return $this->db->get('jp_member_sertifikasi')->row();
        //return $query->row();
    }

    public function delete_sertifikasi_byid($id)
    {
        $this->db->where('sertifikasi_id', $id);
        $this->db->delete('jp_member_sertifikasi');
    }

    public function update_sertifikasi($where, $data)
    {
        $this->db->update('jp_member_sertifikasi', $data, $where);
        return $this->db->affected_rows();
    }

    function get_organisasi($member_id)
    {
        $this->db->where('organisasi_member_id',$member_id);
        $this->db->order_by('organisasi_id', $this->order);
        return $this->db->get('jp_member_organisasi')->result();
    }

    public function get_organisasi_byid($id){
        $this->db->where('organisasi_id',$id);
        $this->db->order_by('organisasi_id', $this->order);
        return $this->db->get('jp_member_organisasi')->row();
        //return $query->row();
    }

    public function delete_organisasi_byid($id)
    {
        $this->db->where('organisasi_id', $id);
        $this->db->delete('jp_member_organisasi');
    }

    public function update_organisasi($where, $data)
    {
        $this->db->update('jp_member_organisasi', $data, $where);
        return $this->db->affected_rows();
    }

    function get_skill($member_id)
    {
        $this->db->where('skill_member_id',$member_id);
        $this->db->order_by('skill_id', $this->order);
        return $this->db->get('jp_member_skill')->result();
    }

    public function get_skill_byid($id){
        $this->db->where('skill_id',$id);
        $this->db->order_by('skill_id', $this->order);
        return $this->db->get('jp_member_skill')->row();
        //return $query->row();
    }

    public function delete_skill_byid($id)
    {
        $this->db->where('skill_id', $id);
        $this->db->delete('jp_member_skill');
    }

    public function update_skill($where, $data)
    {
        $this->db->update('jp_member_skill', $data, $where);
        return $this->db->affected_rows();
    }

    function get_pengalaman($member_id)
    {
        $this->db->where('pengalaman_member_id',$member_id);
        $this->db->order_by('pengalaman_id', $this->order);
        return $this->db->get('jp_member_pengalaman')->result();
    }

    public function get_pengalaman_byid($id){
        $this->db->where('pengalaman_id',$id);
        $this->db->order_by('pengalaman_id', $this->order);
        return $this->db->get('jp_member_pengalaman')->row();
        //return $query->row();
    }

    public function delete_pengalaman_byid($id)
    {
        $this->db->where('pengalaman_id', $id);
        $this->db->delete('jp_member_pengalaman');
    }

    public function update_pengalaman($where, $data)
    {
        $this->db->update('jp_member_pengalaman', $data, $where);
        return $this->db->affected_rows();
    }

    function get_project($member_id)
    {
        $this->db->where('project_member_id',$member_id);
        $this->db->order_by('project_id', $this->order);
        return $this->db->get('jp_member_project')->result();
    }

    public function get_project_byid($id){
        $this->db->where('project_id',$id);
        $this->db->order_by('project_id', $this->order);
        return $this->db->get('jp_member_project')->row();
        //return $query->row();
    }

    public function delete_project_byid($id)
    {
        $this->db->where('project_id', $id);
        $this->db->delete('jp_member_project');
    }

    public function update_project($where, $data)
    {
        $this->db->update('jp_member_project', $data, $where);
        return $this->db->affected_rows();
    }

    function get_dokumen($member_id)
    {
        $this->db->where('dokumen_member_id',$member_id);
        $this->db->order_by('dokumen_id', $this->order);
        return $this->db->get('jp_member_dokumen')->result();
    }

    public function get_dokumen_byid($id){
        $this->db->where('dokumen_id',$id);
        $this->db->order_by('dokumen_id', $this->order);
        return $this->db->get('jp_member_dokumen')->row();
        //return $query->row();
    }

    public function delete_dokumen_byid($id)
    {
        $this->db->where('dokumen_id', $id);
        $this->db->delete('jp_member_dokumen');
    }

    public function update_dokumen($where, $data)
    {
        $this->db->update('jp_member_dokumen', $data, $where);
        return $this->db->affected_rows();
    }

    public function simpan_dokumen($data)
    {
        $this->db->insert('jp_member_dokumen', $data);
        return $this->db->insert_id();
    }

    public function simpan_pendidikan($data)
    {
        $this->db->insert('jp_member_riwayat_pdd', $data);
        return $this->db->insert_id();
    }

    public function simpan_sertifikasi($data)
    {
        $this->db->insert('jp_member_sertifikasi', $data);
        return $this->db->insert_id();
    }

    public function simpan_organisasi($data)
    {
        $this->db->insert('jp_member_organisasi', $data);
        return $this->db->insert_id();
    }

    public function simpan_skill($data)
    {
        $this->db->insert('jp_member_skill', $data);
        return $this->db->insert_id();
    }

    public function simpan_pengalaman($data)
    {
        $this->db->insert('jp_member_pengalaman', $data);
        return $this->db->insert_id();
    }

    public function simpan_project($data)
    {
        $this->db->insert('jp_member_project', $data);
        return $this->db->insert_id();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->join('jp_provinsi','member_provinsi_id=id_provinsi','left');
        $this->db->join('jp_kabupaten','member_kabupaten_id=id_kabupaten','left');
        $this->db->join('jp_job_produk','member_produk_id=produk_id','left');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->join('jp_member_sumber','member_sumber_id=sumber_id');
        $this->db->like('member_id', $q);
    	$this->db->or_like('member_nama', $q);
    	$this->db->or_like('member_provinsi_id', $q);
    	$this->db->or_like('member_kabupaten_id', $q);
    	$this->db->or_like('member_alamat', $q);
    	$this->db->or_like('member_jenis_kelamin', $q);
    	$this->db->or_like('member_email', $q);
    	$this->db->or_like('member_no_telp', $q);
    	$this->db->or_like('member_personal_website', $q);
    	$this->db->or_like('member_fhoto', $q);
    	$this->db->or_like('member_status', $q);
    	$this->db->or_like('member_username', $q);
    	$this->db->or_like('member_password', $q);
    	$this->db->or_like('member_deskripsi_diri', $q);
    	$this->db->or_like('member_tgl_lahir', $q);
    	$this->db->or_like('member_tgl_daftar', $q);
    	$this->db->or_like('member_last_login', $q);
    	$this->db->or_like('member_voucher', $q);
    	$this->db->or_like('member_token', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->join('jp_member_sumber','member_sumber_id=sumber_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('member_id', $q);
    	$this->db->or_like('member_nama', $q);
    	$this->db->or_like('member_provinsi_id', $q);
    	$this->db->or_like('member_kabupaten_id', $q);
    	$this->db->or_like('member_alamat', $q);
    	$this->db->or_like('member_jenis_kelamin', $q);
    	$this->db->or_like('member_email', $q);
    	$this->db->or_like('member_no_telp', $q);
    	$this->db->or_like('member_personal_website', $q);
    	$this->db->or_like('member_fhoto', $q);
    	$this->db->or_like('member_status', $q);
    	$this->db->or_like('member_username', $q);
    	$this->db->or_like('member_password', $q);
    	$this->db->or_like('member_deskripsi_diri', $q);
    	$this->db->or_like('member_tgl_lahir', $q);
    	$this->db->or_like('member_tgl_daftar', $q);
    	$this->db->or_like('member_last_login', $q);
    	$this->db->or_like('member_voucher', $q);
    	$this->db->or_like('member_token', $q);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

}

/* End of file Member_model.php */
/* Location: ./application/models/Member_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-06-09 05:16:40 */
/* http://harviacode.com */