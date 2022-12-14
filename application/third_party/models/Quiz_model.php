<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quiz_model extends CI_Model
{

    public $table = 'tst_quiz';
    public $id = 'quiz_id';
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
        $this->db->like('quiz_produk_id', $q);
        $this->db->or_like('quiz_nama', $q);
        $this->db->or_like('quiz_tglaktif', $q);
        $this->db->or_like('quiz_tglexp', $q);
        $this->db->or_like('quiz_lamapengerjaan', $q);
        $this->db->or_like('quiz_status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->join('jp_job_produk','quiz_produk_id=produk_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('quiz_produk_id', $q);
        $this->db->or_like('quiz_nama', $q);
        $this->db->or_like('quiz_tglaktif', $q);
        $this->db->or_like('quiz_tglexp', $q);
        $this->db->or_like('quiz_lamapengerjaan', $q);
        $this->db->or_like('quiz_status', $q);
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
    function get_tst_produk()
    {
        return $this->db->get('jp_job_produk')->result();
    }

    function list_unit_byquiz($quiz_id){
        $this->db->join('jp_job_produk','quiz_produk_id=produk_id');
        $this->db->join('jp_job_produk_relasi','relasi_produk_id=produk_id');
        $this->db->join('jp_job_unit','relasi_unit_id=unit_id');
        $this->db->join('tst_alokasi','alokasi_quiz_id=quiz_id AND alokasi_unit_id=unit_id','left');
        $this->db->where('quiz_id',$quiz_id);
        return $this->db->get($this->table)->result();
    }

    function get_quiz_byid($quiz_id)
    {
        $this->db->where($this->id,$quiz_id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
}

/* End of file Quiz_model.php */
/* Location: ./application/models/Quiz_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 05 Jul 2017 01:41:15 */