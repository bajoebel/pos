<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    
    function __construct()
    {
        parent::__construct();
    }

    
    // get barang rows
    function barang_rows($param = NULL,$param_val=NULL) {
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->from('barang');
        return $this->db->count_all_results();
    }

    
    // get data with limit and search
    function barang_data($limit, $start = 0, $param = NULL,$param_val=NULL) {
        $this->db->select("*,GROUP_CONCAT(CONCAT(`harga_jual`, ' Per ', `satuan`)) AS hjual");
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->join('barang_hjual','a.barang_id=barang_hjual.barang_id');
        $this->db->group_by('a.barang_id');
        $this->db->order_by('a.barang_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('v_barang a')->result();
    }
    function stok_rows($param = NULL,$param_val=NULL) {
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->from('barang');
        return $this->db->count_all_results();
    }
    function stok_data($limit, $start = 0, $param = NULL,$param_val=NULL) {
        $this->db->select("*,GROUP_CONCAT(CONCAT(`harga_jual`, ' Per ', `satuan`)) AS hjual");
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->join('barang_hjual','a.barang_id=barang_hjual.barang_id');
        $this->db->group_by('a.barang_id');
        $this->db->order_by('a.barang_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('v_barang a')->result();
    }
    // get barang_rusak rows
    function barang_rusak_rows($param = NULL,$param_val=NULL) {
        $this->db->join('barang','rusak_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->group_by('barang_id');
        $this->db->from('barang_rusak');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function barang_rusak_data($limit, $start = 0, $param = NULL,$param_val=NULL) {
        $this->db->select('*,sum(rusak_jumlah) as jumlah');
        $this->db->join('barang','rusak_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->order_by('barang_id', 'desc');
        $this->db->group_by('barang_id');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_rusak')->result();
    }

    // get barang_exp rows
    function barang_exp_rows($param = NULL,$param_val=NULL) {
        $this->db->join('barang','exp_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->group_by('barang_id');
        $this->db->from('barang_exp');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function barang_exp_data($limit, $start = 0, $param = NULL,$param_val=NULL) {
        $this->db->select('*,sum(exp_jml) as jumlah');
        $this->db->join('barang','exp_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        $this->db->order_by('barang_id', 'desc');
        $this->db->group_by('barang_id');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_exp')->result();
    }

    // get barang rows
    function penjualan_rows($from = NULL,$to=NULL) {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('jual_tanggal >=', $from);
            $this->db->where('jual_tanggal <=', $to);
        }
        $this->db->group_by('jual_id');
        $this->db->from('barang_jual');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function penjualan_data($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->select('*,sum(detail_jumlah*detail_harga_satuan) as sub_total');
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('jual_tanggal >=', $from);
            $this->db->where('jual_tanggal <=', $to);
        }
        $this->db->order_by('barang_id', 'desc');
        $this->db->group_by('jual_id');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_jual')->result();
    }

    // get barang rows
    function penjualan_detail_rows($from = NULL,$to=NULL) {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('jual_tanggal >=', $from);
            $this->db->where('jual_tanggal <=', $to);
        }
        $this->db->from('barang_jual');
        return $this->db->get()->num_rows();
    }

    // get barang rows
    function pembelian_rows($from = NULL,$to=NULL) {
        $this->db->join('pemasok','masuk_pemasok_id=pemasok_id');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('masuk_tanggal >=', $from);
            $this->db->where('masuk_tanggal <=', $to);
        }
        $this->db->group_by('masuk_id');
        $this->db->from('barang_masuk');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function pembelian_data($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->select('*,sum(detail_jumlah*detail_harga_satuan) as sub_total');
        $this->db->join('pemasok','masuk_pemasok_id=pemasok_id');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('masuk_tanggal >=', $from);
            $this->db->where('masuk_tanggal <=', $to);
        }
        $this->db->order_by('barang_id', 'desc');
        $this->db->group_by('masuk_id');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_masuk')->result();
    }
    // get data with limit and search
    function penjualan_data_detail($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('jual_tanggal >=', $from);
            $this->db->where('jual_tanggal <=', $to);
        }
        $this->db->order_by('jual_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_jual')->result();
    }

    // get barang rows
    function pembelian_detail_rows($from = NULL,$to=NULL) {
        $this->db->join('pemasok','masuk_pemasok_id=pemasok_id');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('masuk_tanggal >=', $from);
            $this->db->where('masuk_tanggal <=', $to);
        }
        $this->db->from('barang_masuk');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function pembelian_data_detail($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->join('pemasok','masuk_pemasok_id=pemasok_id');
        $this->db->join('detail_masuk','masuk_id=detail_masuk_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('masuk_tanggal >=', $from);
            $this->db->where('masuk_tanggal <=', $to);
        }
        $this->db->order_by('masuk_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('barang_masuk')->result();
    }

    // get barang rows
    function return_rows($from = NULL,$to=NULL) {
        $this->db->join('barang_jual','return_jual_id=jual_id');
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_return','return_id=detail_return_id');
        $this->db->join('detail_jual','detail_detail_jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('return_tanggal >=', $from);
            $this->db->where('return_tanggal <=', $to);
        }
        $this->db->from('barang_return');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function return_data($limit, $start = 0, $from = NULL,$to=NULL) {
        //$this->db->select('*,sum(detail_return.detail_jumlah*detail_return_harga) as sub_total');
        $this->db->join('barang_return','return_id=detail_return_id');
        $this->db->join('barang_jual','return_jual_id=jual_id');
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->join('detail_jual','detail_detail_jual_id=detail_jual.detail_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('kategori','kategori_id=barang_kategori_id');
        $this->db->join('rak','rak_id=barang_rak_id','left');
        if(!empty($from) || !empty($to)){
            $this->db->where('return_tanggal >=', $from);
            $this->db->where('return_tanggal <=', $to);
        }
        $this->db->order_by('return_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('detail_return')->result();
    }

    // get barang rows
    function keuangan_rows($param = NULL,$param_val=NULL) {
        $this->db->join('akun','akun_id=transaksi_akun_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('transaksi_tglinput >=', $from);
            $this->db->where('transaksi_tglinput <=', $to);
        }
        $this->db->from('transaksi');
        $this->db->group_by('akun_id');
        return $this->db->get()->num_rows();
    }

    // get data with limit and search
    function keuangan_data($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->select('*,sum(transaksi_jumlah) as jumlah');
        $this->db->join('akun','akun_id=transaksi_akun_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('transaksi_tglinput >=', $from);
            $this->db->where('transaksi_tglinput <=', $to);
        }
        $this->db->group_by('akun_id');
        $this->db->order_by('transaksi_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('transaksi')->result();
    }

    // get data with limit and search
    function keuangan_data_detail($limit, $start = 0, $from = NULL,$to=NULL) {
        $this->db->join('akun','akun_id=transaksi_akun_id');
        if(!empty($from) || !empty($to)){
            $this->db->where('transaksi_tglinput >=', $from);
            $this->db->where('transaksi_tglinput <=', $to);
        }
        $this->db->order_by('transaksi_id', 'desc');
        $this->db->limit($limit, $start);
        return $this->db->get('transaksi')->result();
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
}

/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 24 Jul 2017 05:16:04 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */