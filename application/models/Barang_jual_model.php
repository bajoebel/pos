<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Barang_jual_model extends CI_Model
{
    public $table = 'barang_jual';
    public $key = 'jual_id';
    public $order = 'DESC';
    function __construct()
    {
        parent::__construct();
    }
    //get all data
    function get_barang_jual()
    {
        $this->db->order_by($this->key, 'desc');
        return $this->db->get($this->table)->result();
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->order_by($this->key);
            $this->db->like('jual_invoice', $q);
            $this->db->or_like('jual_tipe', $q);
            $this->db->or_like('pelanggan_nama', $q);
            $this->db->or_like('jual_tanggal', $q);
            $this->db->or_like('jual_userinput', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    // get total rows
    function total_rows($q = NULL) {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
            $this->db->like('jual_invoice', $q);
            $this->db->or_like('jual_tipe', $q);
            $this->db->or_like('pelanggan_nama', $q);
            $this->db->or_like('jual_tanggal', $q);
            $this->db->or_like('jual_userinput', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function cariBarang($q = NULL) {
        $this->db->order_by('barang_nama');
        $this->db->like('barang_id', $q);
        $this->db->or_like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        return $this->db->get('v_barang')->result();
    }

    function data_barang($limit, $start = 0, $q = NULL) {
        $this->db->order_by('barang_nama');
        $this->db->like('barang_kode', $q);
        $this->db->or_like('barang_nama', $q);
        $this->db->or_like('barang_description', $q);
        $this->db->limit($limit, $start);
        return $this->db->get('barang')->result();
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
    function detail_barang_by_kode($barang_id) {
        $this->db->where('barang_kode', $barang_id);
        return $this->db->get('v_barang')->row();
    }
    function getJenisHarga($barang_id){
        $this->db->where('barang_id',$barang_id);
        $this->db->order_by('jml_item_perpcs','desc');
        return $this->db->get('barang_hjual')->result();
    }

    // get data with limit and search
    function get_limit_data_return($limit, $start = 0, $q = NULL) {
        $this->db->select('pelanggan_nama,detail_return.detail_id as detail_return_id,jual_tipe,detail_harga_satuan,barang_diskon,barang_nama,detail_return.detail_jumlah as jml_return, detail_alasan_return,detail_return_harga,return_tanggal,barang_satuan_besar,barang_satuan_kecil,detail_return.detail_satuan');
        $this->db->join('detail_return','detail_return_id=return_id');
        $this->db->join('detail_jual','detail_detail_jual_id=detail_jual.detail_id');
        $this->db->join('barang_jual','jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->order_by('return_id');
        $this->db->like('barang_nama', $q);
        $this->db->or_like('detail_return.detail_jumlah', $q);
        $this->db->or_like('detail_alasan_return', $q);
        $this->db->or_like('detail_return_harga', $q);
        $this->db->or_like('return_tanggal', $q);
        $this->db->or_like('barang_satuan_besar', $q);
        $this->db->or_like('barang_satuan_kecil', $q);
        $this->db->limit($limit, $start);
        return $this->db->get('barang_return')->result();
    }
    // get total rows
    function total_rows_return($q = NULL) {
        $this->db->join('detail_return','detail_return_id=return_id');
        $this->db->join('detail_jual','detail_detail_jual_id=detail_jual_id');
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->like('barang_nama', $q);
        $this->db->or_like('detail_return.detail_jumlah', $q);
        $this->db->or_like('detail_alasan_return', $q);
        $this->db->or_like('detail_return_harga', $q);
        $this->db->or_like('return_tanggal', $q);
        $this->db->or_like('barang_satuan_besar', $q);
        $this->db->or_like('barang_satuan_kecil', $q);
        $this->db->from('barang_return');
        return $this->db->count_all_results();
    }

    //Save Data
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save_return($data)
    {
        $this->db->insert('barang_return', $data);
        return $this->db->insert_id();
    }

    function get_master_jual($jual_id)
    {
        $this->db->join('pelanggan','jual_pelanggan_id=pelanggan_id');
        $this->db->where('jual_id',$jual_id);
        $this->db->or_where('jual_invoice',$jual_id);
        return $this->db->get('barang_jual')->row();
    }

    function get_detail_jual($jual_id)
    {
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('detail_jual_id',$jual_id);
        return $this->db->get('detail_jual')->result();
    }

    function get_detail_return($jual_id)
    {
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('detail_jual_id',$jual_id);
        return $this->db->get('detail_jual')->result();
    }
    function cekRetur($detail_id){
        $this->db->select("*,SUM(detail_jumlah) as detail_jumlah");
        $this->db->where('detail_detail_jual_id',$detail_id);
        $this->db->group_by('detail_detail_jual_id');
        return $this->db->get('detail_return')->row();
    }
    function get_return_by_id($detail_id)
    {
        $this->db->join('barang','detail_barang_id=barang_id');
        $this->db->where('detail_id',$detail_id);
        return $this->db->get('detail_jual')->row();
    }

    //delete data
    public function delete($id)
    {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);

        $this->db->where('detail_jual_id', $id);
        $this->db->delete('detail_jual');
    }

    public function delete_return($id)
    {
        $this->db->where('detail_id', $id);
        $this->db->delete('detail_return');
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
    function get_pelanggan()
    {
        return $this->db->get('pelanggan')->result();
    }

    public function buat_invoice(){
        $this->db->order_by('jual_id', $this->order);
        $this->db->limit(1);
        $split1="INV";
        $split2="OK";
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

        $row = $this->db->get('barang_jual')->row();
        if ($row) {
            $last_kode=$row->jual_invoice; 
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
    
    function addTemp($data){
        $this->db->where('tmp_session', $data['tmp_session']);
        $this->db->where('tmp_barangid', $data['tmp_barangid']);
        $ada=$this->db->get('tmp_jual')->num_rows();
        if($ada){
            $this->db->where('tmp_session', $data['tmp_session']);
            $this->db->where('tmp_barangid', $data['tmp_barangid']);
            $this->db->update('tmp_jual',$data);
            $response=array('status'=>true,'message'=>'Update Successed');
            return $response;
        }else{
            $this->db->insert('tmp_jual',$data);
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
        $this->db->delete('tmp_jual');

    }

    function deleteTempByid($id)
    {
        $this->db->where('tmp_id', $id);
        $this->db->delete('tmp_jual');
    }

    function gettemp(){
        $this->db->where('tmp_session',session_id());
        $this->db->join('barang b','a.tmp_barangid=b.barang_id');
        $this->db->join('barang_hjual c','a.tmp_tipeharga=c.idx');
        return $this->db->get('tmp_jual a')->result();
    }
    function insertLog($log){
        $this->db->where('barang_id',$log['barang_id']);
        $this->db->where('stok >',0);
        $this->db->order_by('tgl_masuk');
        $cek=$this->db->get('v_stokbarang')->row();
        if($cek->stok >= $log['jumlah']){
            //Jika Stok Pertama besar sama dengan jumlah jual
            $jml_masuk=0;
            $jml_keluar=$log['jumlah'];
            $data=array(
                'jns_transaksi'=>'JL',
                'tgl_transaksi'=>date('Y-m-d H:i:s'),
                'tgl_masuk'=>$cek->tgl_masuk,
                'no_referensi'=>$log['no_referensi'],
                'barang_id'=>$log['barang_id'],
                'harga_modal'=>$cek->harga_modal,
                'jml_masuk'=>$jml_masuk,
                'jml_keluar'=>$jml_keluar,
                'konversi_satuan'=>$log['konversi_satuan'],
                'userinput'=> $log['userinput']
            );
            $id=$this->saveLog($data);
            return $id;
        }else{
            if($log['jns_transaksi']=="JL"){
                $jml_masuk=0;
                $jml_keluar=$cek->stok;
            }else if($log['jns_transaksi']=="BL"){
                $jml_masuk=$cek->stok;
                $jml_keluar=0;
            }else if($log['jns_transaksi']=="RJL"){
                $jml_masuk=$cek->stok;
                $jml_keluar=0;
            }else if($log['jns_transaksi']=="RBL"){
                $jml_masuk=0;
                $jml_keluar=$cek->stok;
            }else if($log['jns_transaksi']=="EXP"){
                $jml_masuk=0;
                $jml_keluar=$cek->stok;
            }
            $data=array(
                'jns_transaksi'=>'JL',
                'tgl_transaksi'=>date('Y-m-d H:i:s'),
                'tgl_masuk'=>$cek->tgl_masuk,
                'no_referensi'=>$log['no_referensi'],
                'barang_id'=>$log['barang_id'],
                'harga_modal'=>$cek->harga_modal,
                'jml_masuk'=>$jml_masuk,
                'jml_keluar'=>$jml_keluar,
                'konversi_satuan'=>$log['konversi_satuan'],
                'userinput'=> $log['userinput']
            );
            $this->saveLog($data);
            $sisa = $log['jumlah']-$cek->stok;
            $log2=array(
                'jns_transaksi'=>$log['jns_transaksi'],
                'tgl_transaksi'=>$log['tgl_transaksi'],
                'no_referensi'=>$log['no_referensi'],
                'barang_id'=>$log['barang_id'],
                'jumlah'=>$sisa,
                'konversi_satuan'=>$log['konversi_satuan'],
                'userinput'=>$log['userinput']
            );
            $this->insertLog($log2);
        }
    }
    function insertLogRet($log){
        $this->db->where('no_referensi',$log['jual_id']);
        $this->db->where('jns_transaksi',$log['jenis_ret']);
        $this->db->where('barang_id',$log['barang_id']);
        $this->db->order_by('tgl_masuk');
        $cek=$this->db->get('log_transaksi')->row();
        $jmlret=$log['jumlah']*$cek->konversi_satuan;
        if($cek->jml_keluar >= $jmlret){
            //Jika Stok Pertama besar sama dengan jumlah jual
            $jml_masuk=$jmlret;
            $jml_keluar=0;
            $data=array(
                'jns_transaksi'=>'RJL',
                'tgl_transaksi'=>date('Y-m-d H:i:s'),
                'tgl_masuk'=>$cek->tgl_masuk,
                'no_referensi'=>$log['no_referensi'],
                'barang_id'=>$log['barang_id'],
                'harga_modal'=>$cek->harga_modal,
                'jml_masuk'=>$jml_masuk,
                'jml_keluar'=>$jml_keluar,
                'konversi_satuan'=>$cek->konversi_satuan,
                'userinput'=> $log['userinput']
            );
            $id=$this->saveLog($data);
            return $id;
        }else{
            $jml_masuk=$cek->jml_keluar;
            $jml_keluar=0;
            $data=array(
                'jns_transaksi'=>'RJL',
                'tgl_transaksi'=>date('Y-m-d H:i:s'),
                'tgl_masuk'=>$cek->tgl_masuk,
                'no_referensi'=>$log['no_referensi'],
                'barang_id'=>$log['barang_id'],
                'harga_modal'=>$cek->harga_modal,
                'jml_masuk'=>$jml_masuk,
                'jml_keluar'=>$jml_keluar,
                'konversi_satuan'=>$cek->konversi_satuan,
                'userinput'=> $log['userinput']
            );
            $this->saveLog($data);
            $sisa = ($jmlret-$cek->jml_keluar)/$cek->konversi_satuan;
            
            $log2=array(
                'no_referensi'=>$log['no_referensi'],
                'jenis_ret'=>'JL',
                'jual_id'=> $log['jual_id'],
                'barang_id'=>$log['barang_id'],
                'jumlah'=>$sisa,
                'userinput'=>$auth['username']
            );
            $this->insertLogRet($log2);
        }
    }
    function saveLog($data){
        $this->db->insert('log_transaksi',$data);
        return $this->db->insert_id();
    }
}

/* End of file Barang_jual_model.php */
/* Location: ./application/models/Barang_jual_model.php */
/* Please DO NOT modify this information : */
/* Generated by Codeigniter CRUD Generator V1 06 Nov 2017 10:54:47 */
/* Copyright @ 2017 By Wanhar Azri S.Kom */