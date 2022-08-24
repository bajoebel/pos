<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Tutupbuku_model extends CI_Model
{
    public $table = 'transaksi';
    public $key = 'transaksi_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    //get all data
    function get_transaksi()
    {
        $this->db->order_by($this->key, 'desc');
        return $this->db->get($this->table)->result();
    }
    // get penjualan
    function get_penjualan($username) {
        $this->db->select('jual_id,jual_tanggal,sum(detail_harga_satuan*detail_jumlah) as totalharga,detail_jual_tipe,barang_satuan_besar,barang_satuan_kecil');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('jual_tutup_buku','Belum');
        $this->db->where('jual_userinput',$username);
        $this->db->group_by('jual_tanggal');
        return $this->db->get('barang_jual')->result();
    }

    function get_pengaturan(){
        return $this->db->get('tutupbuku')->row();
    }
    // get pembelian
    function get_pembelian($username) {
        $this->db->select('masuk_id,masuk_tanggal,sum(detail_harga_satuan*detail_jumlah) as totalharga,barang_satuan_besar,barang_satuan_kecil');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('masuk_tutup_buku','Belum');
        $this->db->where('masuk_userinput',$username);
        $this->db->group_by('masuk_tanggal');
        return $this->db->get('barang_masuk')->result();
    }

    // get pembelian
    function get_return($username) {
        $this->db->select('return_tanggal,sum(detail_return_harga) as totalharga');
        $this->db->join('detail_return','return_id=detail_return_id');
        $this->db->where('return_tutup_buku','Belum');
        $this->db->where('return_userinput',$username);
        $this->db->group_by('return_tanggal');
        return $this->db->get('barang_return')->result();
    }
    function get_hutang($username){
        $this->db->select('hutang_tgl,SUM(hutang_jml) as totalhutang');
        $this->db->where('hutang_tutupbuku','Belum');
        $this->db->where('hutang_userinput',$username);
        $this->db->group_by('hutang_tgl');
        return $this->db->get("hutang")->result();
    }
    function get_piutang($username){
        $this->db->select('piutang_tgl,SUM(piutang_jml) as totalpiutang');
        $this->db->where('piutang_tutupbuku','Belum');
        $this->db->where('piutang_userinput',$username);
        $this->db->group_by('piutang_tgl');
        return $this->db->get("piutang")->result();
    }
    function get_pembayaran_hutang($username){
        $this->db->select('bayar_tgl,SUM(bayar_jml) as totalbayar');
        $this->db->where('bayar_tutupbuku','Belum');
        $this->db->where('bayar_userinput',$username);
        $this->db->group_by('bayar_tgl');
        return $this->db->get("pembayaran_hutang")->result();
    }
    function get_penerimaan_piutang($username){
        $this->db->select('terima_tgl,SUM(terima_jumlah) as totalterima');
        $this->db->where('terima_tutupbuku','Belum');
        $this->db->where('terima_userinput',$username);
        $this->db->group_by('terima_tgl');
        return $this->db->get("penerimaan_piutang")->result();
    }
    function cek_akun_transaksi($akun_id){
        $this->db->where('transaksi_akun_id',$akun_id);
        $data=$this->db->get('transaksi')->row();
        if(!empty($data)) return $data->transaksi_id;
        else return 0;
    }

     // get Perkiraan Assets
    function get_perkiraan_aset() {
        $this->db->select('SUM(harga_pokok_perpcs*jml_stok_pcs) AS perkiraan_aset');
        return $this->db->get('view_barang')->row();
    }
    //Save Data
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    //delete data
    public function delete($id)
    {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
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
    function get_akun()
    {
        return $this->db->get('akun')->result();
    }

    //Save Data
    public function save_setting($data)
    {
        $this->db->insert('tutupbuku', $data);
        return $this->db->insert_id();
    }

    // update data
    function update_setting($data,$id){
        $this->db->where('tutupbuku_id', $id);
        $this->db->update('tutupbuku', $data);
    }
    
}

/* End of file Tutupbuku_model.php */
/* Location: ./application/models/Tutupbuku_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 05 Dec 2017 11:27:40 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */