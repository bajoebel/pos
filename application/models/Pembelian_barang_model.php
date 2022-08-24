<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Pembelian_barang_model extends CI_Model
{
    public $table = 'barang';
    public $key = 'barang_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    //get all data
    function get_pembelian_barang()
    {
        $this->db->order_by($this->key, 'desc');
        return $this->db->get($this->table)->result();
    }
    function getJenisHarga($barang_id){
        $this->db->where('barang_id',$barang_id);
        $this->db->order_by('jml_item_perpcs','desc');
        return $this->db->get('barang_hjual')->result();
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->key);
        $this->db->like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        $this->db->or_like('barang_description', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        $this->db->or_like('barang_description', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //Save Data
    public function save($data)
    {
        $this->db->insert('barang_masuk', $data);
        return $this->db->insert_id();
    }
    //delete data
    public function delete($id)
    {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
    }
    function deleteTempByid($id){
        $this->db->where('tmp_id', $id);
        $this->db->delete('tmp_beli');
    }
    //Get data by id
    public function get_by_id($id){
        $this->db->where($this->key,$id);
        return $this->db->get($this->table)->row();
    }
    // update data
    function update($data,$id){
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
    }
    function get_pemasok()
    {
        return $this->db->get('pemasok')->result();
    }

    function get_master_masuk($masuk_id)
    {
        $this->db->join('pemasok','masuk_pemasok_id=pemasok_id');
        $this->db->where('masuk_id',$masuk_id);
        return $this->db->get('barang_masuk')->row();
    }

    function get_detail_masuk($masuk_id)
    {
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('detail_masuk_id',$masuk_id);
        return $this->db->get('detail_masuk')->result();
    }
    function data_barang($limit, $start = 0, $q = NULL) {
        $this->db->order_by('barang_nama');
        $this->db->like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        $this->db->or_like('barang_description', $q);
        $this->db->limit($limit, $start);
        return $this->db->get('barang')->result();
    }
    function cariBarang($q = NULL) {
        $this->db->order_by('barang_nama');
        $this->db->like('barang_id', $q);
        $this->db->or_like('barang_nama', $q);
        return $this->db->get('view_barang')->result();
    }
    // get total rows
    function total_barang($q = NULL) {
        $this->db->like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        $this->db->or_like('barang_description', $q);
        $this->db->from('barang');
        return $this->db->count_all_results();
    }
    function detail_barang($barang_id) {
        $this->db->where('barang_id', $barang_id);
        return $this->db->get('v_barang')->row();
    }
    
    function addTemp($data){
        $this->db->where('tmp_session', $data['tmp_session']);
        $this->db->where('tmp_barangid', $data['tmp_barangid']);
        $ada=$this->db->get('tmp_beli')->num_rows();
        if($ada){
            $this->db->where('tmp_session', $data['tmp_session']);
            $this->db->where('tmp_barangid', $data['tmp_barangid']);
            $this->db->update('tmp_beli',$data);
            $response=array('status'=>true,'message'=>'Update Successed');
            return $response;
        }else{
            $this->db->insert('tmp_beli',$data);
            $id=$this->db->insert_id();
            if($id){
                $response=array('status'=>true,'message'=>'Insert Successed');
                return $response;
            }else{
                $response=array('status'=>false,'message'=>'ERROR');
                return $response;
            }
        }
    }    
    function deleteTemp($session){
        $this->db->where('tmp_session',$session);
        $this->db->delete('tmp_beli');

    }

    function gettemp(){
        $this->db->where('tmp_session',session_id());
        $this->db->join('barang','tmp_barangid=barang_id');
        return $this->db->get('tmp_beli')->result();
    }

    // function insertLog($log){
    //     $data=array(
    //         'jns_transaksi'=>'JL',
    //         'tgl_transaksi'=>date('Y-m-d H:i:s'),
    //         'tgl_masuk'=>$log['tgl_masuk'],
    //         'no_referensi'=>$log['no_referensi'],
    //         'barang_id'=>$log['barang_id'],
    //         'harga_modal'=>$log['harga_modal'],
    //         'jml_masuk'=>$jml_masuk,
    //         'jml_keluar'=>$jml_keluar,
    //         'konversi_satuan'=>$log['konversi_satuan'],
    //         'userinput'=> $log['userinput']
    //     );
    //     $id=$this->saveLog($data);
    // }
    function insertLog($data){
        $this->db->insert('log_transaksi',$data);
        return $this->db->insert_id();
    }
}

/* End of file Pembelian_barang_model.php */
/* Location: ./application/models/Pembelian_barang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 20 Oct 2017 03:12:27 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */