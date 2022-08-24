
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Piutang_model extends CI_Model
{
    public $table = 'view_piutang';
    public $key = 'piutang_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    function getPiutang()
    {
        $this->db->order_by($this->key, $this->order);
        return $this->db->get($this->table)->result();
    }
    function getPiutanglimit($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->key, $this->order);
        $this->db->like('piutang_id', $q);
                $this->db->or_like('piutang_invoice', $q);
                $this->db->or_like('pelanggan_nama', $q);
                $this->db->or_like('piutang_tgl', $q);
                $this->db->or_like('piutang_jml', $q);
                $this->db->or_like('jumlah_bayar', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    function countPiutang($q = NULL) {
        
        $this->db->like('piutang_id', $q);
        $this->db->or_like('piutang_invoice', $q);
        $this->db->or_like('pelanggan_nama', $q);
        $this->db->or_like('piutang_tgl', $q);
        $this->db->or_like('piutang_jml', $q);
        $this->db->or_like('jumlah_bayar', $q);
        return $this->db->get($this->table)->num_rows();
    }
    public function insertPiutang($data)
    {
        $this->db->insert('penerimaan_piutang', $data);
        return $this->db->insert_id();
    }
    public function deletePiutang($id)
    {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
    }
    public function getPiutang_by_id($id){
        $this->db->where($this->key,$id);
        return $this->db->get($this->table)->row();
    }
    function updatePiutang($data,$id){
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
    }

    function histori_bayar($id){
        $this->db->where('terima_piutangid',$id);
        return $this->db->get('penerimaan_piutang')->result();
    }
}