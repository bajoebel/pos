<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_harga_model extends CI_Model
{

    public $table = 'jp_job_harga';
    public $id = 'harga_id';
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
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('harga_tipe_id', $q);
        $this->db->or_like('harga_produk_id', $q);
        $this->db->or_like('harga', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('harga_tipe_id', $q);
        $this->db->or_like('harga_produk_id', $q);
        $this->db->or_like('harga', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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
    function get_jp_job_tipe()
    {
        return $this->db->get('jp_job_tipe')->result();
    }
    function get_jp_job_produk()
    {
        return $this->db->get('jp_job_produk')->result();
    }
}

/* End of file Job_harga_model.php */
/* Location: ./application/models/Job_harga_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 24 Jul 2017 07:36:14 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */