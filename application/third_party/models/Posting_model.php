<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Posting_model extends CI_Model
{

    public $table = 'jp_posting';
    public $id = 'id_job_posting';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('jp_kabupaten','jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten','left');
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->join('jp_perusahaan','jp_perusahaan.id_perusahaan=jp_posting.id_perusahaan','left');
        $this->db->join('jp_job_kategori','jp_job_kategori.kategori_id=jp_posting.id_kategori_job','left');
        $this->db->join('jp_job_title','jp_job_title.jobtitle_id=jp_posting.id_job_title','left');
        $this->db->like('nama_perusahaan', $q);
        $this->db->or_like('kab_kota', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('tipe_pekerjaan', $q);
        $this->db->or_like('tgl_posting', $q);
        $this->db->or_like('tgl_exp', $q);
        $this->db->or_like('rating', $q);
        $this->db->or_like('status_posting', $q);
        $this->db->or_like('jobtitle_nama', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get total rows
    function total_rows_perusahaan($q = NULL) {
        $this->db->join('jp_perusahaan','jp_perusahaan.id_perusahaan=jp_posting.id_perusahaan AND jp_perusahaan.username=jp_posting.userinput');
        $this->db->join('jp_job_kategori','jp_job_kategori.kategori_id=jp_posting.id_kategori_job','left');
        $this->db->join('jp_job_title','jp_job_title.jobtitle_id=jp_posting.id_job_title','left');
        $this->db->like('nama_perusahaan', $q);
        $this->db->or_like('kab_kota', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('tipe_pekerjaan', $q);
        $this->db->or_like('tgl_posting', $q);
        $this->db->or_like('tgl_exp', $q);
        $this->db->or_like('rating', $q);
        $this->db->or_like('status_posting', $q);
        $this->db->or_like('jobtitle_nama', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->join('jp_perusahaan','jp_perusahaan.id_perusahaan=jp_posting.id_perusahaan','left');
        $this->db->join('jp_job_kategori','jp_job_kategori.kategori_id=jp_posting.id_kategori_job','left');
        $this->db->join('jp_job_title','jp_job_title.jobtitle_id=jp_posting.id_job_title','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_perusahaan', $q);
        $this->db->or_like('kab_kota', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('tipe_pekerjaan', $q);
        $this->db->or_like('tgl_posting', $q);
        $this->db->or_like('tgl_exp', $q);
        $this->db->or_like('rating', $q);
        $this->db->or_like('status_posting', $q);
        $this->db->or_like('jobtitle_nama', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_perusahaan($limit, $start = 0, $q = NULL) {
        $this->db->join('jp_perusahaan','jp_perusahaan.id_perusahaan=jp_posting.id_perusahaan AND jp_perusahaan.username=jp_posting.userinput');
        $this->db->join('jp_job_kategori','jp_job_kategori.kategori_id=jp_posting.id_kategori_job','left');
        $this->db->join('jp_job_title','jp_job_title.jobtitle_id=jp_posting.id_job_title','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_perusahaan', $q);
        $this->db->or_like('kab_kota', $q);
        $this->db->or_like('kategori_nama', $q);
        $this->db->or_like('tipe_pekerjaan', $q);
        $this->db->or_like('tgl_posting', $q);
        $this->db->or_like('tgl_exp', $q);
        $this->db->or_like('rating', $q);
        $this->db->or_like('status_posting', $q);
        $this->db->or_like('jobtitle_nama', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function insert_perusahaan($data)
    {
        $this->db->insert('jp_perusahaan', $data);
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
    function get_jp_perusahaan()
    {
        return $this->db->get('jp_perusahaan')->result();
    }
    function get_jp_provinsi()
    {
        return $this->db->get('jp_provinsi')->result();
    }
    function get_jp_kabupaten()
    {
        return $this->db->get('jp_kabupaten')->result();
    }
    function get_jp_job_kategori()
    {
        return $this->db->get('jp_job_kategori')->result();
    }
    function get_jp_pendidikan()
    {
        return $this->db->get('jp_pendidikan')->result();
    }
    function get_jp_job_title()
    {
        return $this->db->get('jp_job_title')->result();
    }
}

/* End of file Posting_model.php */
/* Location: ./application/models/Posting_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 24 Jul 2017 05:01:47 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */