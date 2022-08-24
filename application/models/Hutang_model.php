
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Hutang_model extends CI_Model
{
    public $table = 'view_hutang';
    public $key = 'hutang_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    function getHutang()
    {
        $this->db->order_by($this->key, $this->order);
        return $this->db->get($this->table)->result();
    }
    function getHutanglimit($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->key, $this->order);
        $this->db->like('hutang_id', $q);
                $this->db->or_like('hutang_faktur', $q);
                $this->db->or_like('pemasok_nama', $q);
                $this->db->or_like('hutang_tgl', $q);
                $this->db->or_like('jml_bayar', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    function countHutang($q = NULL) {
        
        $this->db->like('hutang_id', $q);
        $this->db->or_like('hutang_faktur', $q);
        $this->db->or_like('pemasok_nama', $q);
        $this->db->or_like('hutang_tgl', $q);
        $this->db->or_like('jml_bayar', $q);
        return $this->db->get($this->table)->num_rows();
    }
    public function insertHutang($data)
    {
        $this->db->insert('pembayaran_hutang', $data);
        return $this->db->insert_id();
    }
    public function deleteHutang($id)
    {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
    }
    public function getHutang_by_id($id){
        $this->db->where($this->key,$id);
        return $this->db->get($this->table)->row();
    }
    function updateHutang($data,$id){
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
    }
    function histori_bayar($id){
        $this->db->where('bayar_hutangid',$id);
        return $this->db->get('pembayaran_hutang')->result();
    }
}