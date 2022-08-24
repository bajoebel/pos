<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_job extends CI_Model {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    

    public function identitas(){
        $this->db->select('*');
        $this->db->from('tbl_web_identitas');
        $this->db->order_by('web_id');
        $this->db->limit(1);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }



    public function registrasi_member($data)
    {
        $this->db->insert('jp_member', $data);
        return $this->db->insert_id();
        
    }

    public function registrasi_company($data)
    {
        $this->db->insert('jp_perusahaan', $data);
        return $this->db->insert_id();
        
    }

    function total_rows_posting($jobtitle = NULL, $location = NULL, $category = NULL) {
        $this->db->select('*');
        $this->db->from('jp_posting');
        $this->db->join('jp_perusahaan', 'jp_posting.id_perusahaan=jp_perusahaan.id_perusahaan');
        $this->db->join('jp_provinsi', 'jp_posting.id_provinsi=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten', 'left');
        $this->db->join('jp_job_kategori', 'jp_job_kategori.kategori_id=jp_posting.id_kategori_job', 'left');
        $this->db->join('jp_job_title', 'jp_posting.id_job_title=jp_job_title.jobtitle_id', 'left');
        $this->db->where('status_posting', 'Publish');
        $this->db->group_start();
        $this->db->like('nama_kabupaten', $location);
        $this->db->or_like('nama_provinsi', $location);
        $this->db->or_like('kab_kota', $location);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->like('jobtitle_nama', $jobtitle);
        $this->db->like('kategori_nama', $category);
        $this->db->group_end();
        $this->db->order_by('jp_posting.tgl_posting','DESC');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_posting($limit, $start = 0, $jobtitle = NULL, $location = NULL, $category = NULL) {
        /*$this->db->join('jp_provinsi','jp_provinsi.id_provinsi=jp_kabupaten.id_provinsi');
        $this->db->order_by('posting_id', 'desc');
        $this->db->like('id_kabupaten', $keyword);
        $this->db->or_like('nama_kabupaten', $keyword);
        $this->db->or_like('nama_provinsi', $keyword);
        $this->db->or_like('jp_kabupaten.aktif', $keyword);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();*/

        $this->db->select('*');
        $this->db->from('jp_posting');
        $this->db->join('jp_perusahaan', 'jp_posting.id_perusahaan=jp_perusahaan.id_perusahaan');
        $this->db->join('jp_provinsi', 'jp_posting.id_provinsi=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten', 'left');
        $this->db->join('jp_job_kategori', 'jp_job_kategori.kategori_id=jp_posting.id_kategori_job', 'left');
        $this->db->join('jp_job_title', 'jp_posting.id_job_title=jp_job_title.jobtitle_id', 'left');
        $this->db->where('status_posting', 'Publish');
        $this->db->group_start();
        $this->db->like('nama_kabupaten', $location);
        $this->db->or_like('nama_provinsi', $location);
        $this->db->or_like('kab_kota', $location);
        $this->db->group_end();
        $this->db->group_start();
        $this->db->like('jobtitle_nama', $jobtitle);
        $this->db->like('kategori_nama', $category);
        $this->db->group_end();
        $this->db->order_by('jp_posting.tgl_posting','DESC');
        $this->db->limit($limit, $start);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }

    }

    
    public function menu_level1(){
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where('menu_utama_idx >', 0);
        $this->db->where('menu_sub_idx',0);
        $this->db->where('menu_status','Aktif');
        $this->db->order_by('menu_utama_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function biodata($id){
        $this->db->select('*');
        $this->db->from('jp_member');
        $this->db->join('jp_provinsi','jp_provinsi.id_provinsi=jp_member.member_provinsi_id', 'left');
        $this->db->join('jp_kabupaten','jp_kabupaten.id_kabupaten=jp_member.member_kabupaten_id', 'left');
        $this->db->where('member_id',$id);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function biodata_pemegang_sertifikat($certificate_id){
        $this->db->select('*');
        $this->db->from('tbl_pemegang_sertifikat_bnsp');
        $this->db->where('certificate_id',$certificate_id);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function biodata_perusahaan($perusahaan_id){
        $this->db->select('*');
        $this->db->from('tbl_perusahaan');
        $this->db->where('perusahaan_id',$perusahaan_id);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function jml_posting_perwilayah(){
        $this->db->select('jp_provinsi.id_provinsi,COUNT(id_job_posting) AS jml_post_per_daerah, nama_provinsi');
        $this->db->from('jp_posting');
        $this->db->join('jp_provinsi','jp_posting.id_provinsi=jp_provinsi.id_provinsi');
        $this->db->group_by('jp_provinsi.id_provinsi');
        $this->db->order_by('jp_provinsi.id_provinsi','desc');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function jml_posting_pertanggal(){
        $this->db->select('jp_provinsi.id_provinsi,COUNT(id_job_posting) AS jml_post_per_tanggal, substring(jp_posting.tgl_posting,1,10) as tgl_posting');
        $this->db->from('jp_posting');
        $this->db->join('jp_provinsi','jp_posting.id_provinsi=jp_provinsi.id_provinsi');
        $this->db->group_by('substring(jp_posting.tgl_posting,1,10)');
        $this->db->order_by('jp_provinsi.id_provinsi','desc');
        $this->db->limit(30);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    
    public function menu_level2($menu_utama_idx){
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where('menu_utama_idx', $menu_utama_idx);
        $this->db->where('menu_sub_idx > ',0);
        $this->db->where('menu_status','Aktif');
        $this->db->order_by('menu_utama_idx');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function jml_record($nama_tabel,$param,$param_val){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        if(!empty($param)) $this->db->where($param, $param_val);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->num_rows();
        }
        else
        {
            return 0; 
        }
    }

    public function jml_record_perwilayah($nama_tabel,$param,$param_val,$id){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where($param, $param_val);
        $this->db->where('id_provinsi',$id);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->num_rows();
        }
        else
        {
            return 0; 
        }
    }
    
    public function list_jobposting($parameter_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from('jp_posting');
        $this->db->join('jp_perusahaan', 'jp_posting.id_perusahaan=jp_perusahaan.id_perusahaan');
        $this->db->join('jp_provinsi', 'jp_posting.id_provinsi=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten', 'left');
        $this->db->join('jp_job_kategori', 'jp_job_kategori.kategori_id=jp_posting.id_kategori_job', 'left');
        //$this->db->join('jp_pendidikan', 'jp_posting.id_pendidikan=jp_pendidikan.id_pendidikan', 'left');
        $this->db->join('jp_job_title', 'jp_posting.id_job_title=jp_job_title.jobtitle_id', 'left');
        $this->db->where('status_posting', 'Publish');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_member($parameter_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from('jp_member');
        $this->db->join('jp_provinsi', 'jp_member.member_provinsi_id=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_member.member_kabupaten_id=jp_kabupaten.id_kabupaten', 'left');
        $this->db->where('member_status', 'Aktif');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_perusahaan($parameter_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from('jp_perusahaan');
        $this->db->where('status_perusahaan', 'Aktif');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_relasi($parameter_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from('jp_perusahaan_relasi');
        $this->db->where('relasi_status', 'Aktif');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_pemegang_sertifikat_bnsp($parameter_urut,$sampai,$dari){
        $this->db->select('*');
        $this->db->from('tbl_pemegang_sertifikat_bnsp');
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_jobposting_perwilayah($parameter_urut,$sampai,$dari,$id_prov){
        $this->db->select('*');
        $this->db->from('jp_posting');
        $this->db->join('jp_perusahaan', 'jp_posting.id_perusahaan=jp_perusahaan.id_perusahaan');
        $this->db->join('jp_provinsi', 'jp_posting.id_provinsi=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten', 'left');
        $this->db->join('jp_job_kategori', 'jp_job_kategori.kategori_id=jp_posting.id_kategori_job', 'left');
        //$this->db->join('jp_pendidikan', 'jp_posting.id_pendidikan=jp_pendidikan.id_pendidikan', 'left');
        //$this->db->join('jp_job_title', 'jp_posting.id_job_title=jp_job_title.id_job_title', 'left');
        $this->db->where('status_posting', 'Publish');
        $this->db->where('jp_posting.id_provinsi',$id_prov);
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function list_jobapply($parameter_urut,$sampai,$dari,$id){
        $this->db->select('*');
        $this->db->from('jp_member_apply');
        $this->db->join('jp_posting','jp_member_apply.apply_posting_id=jp_posting.id_job_posting');
        $this->db->join('jp_perusahaan', 'jp_posting.id_perusahaan=jp_perusahaan.id_perusahaan');
        $this->db->join('jp_provinsi', 'jp_posting.id_provinsi=jp_provinsi.id_provinsi', 'left');
        $this->db->join('jp_kabupaten', 'jp_posting.id_kabupaten=jp_kabupaten.id_kabupaten', 'left');
        $this->db->join('jp_job_kategori', 'jp_job_kategori.kategori_id=jp_posting.id_kategori_job', 'left');
        //$this->db->join('jp_pendidikan', 'jp_posting.id_pendidikan=jp_pendidikan.id_pendidikan', 'left');
        //$this->db->join('jp_job_title', 'jp_posting.id_job_title=jp_job_title.id_job_title', 'left');
        $this->db->where('apply_member_id', $id);
        $this->db->order_by($parameter_urut,'DESC');
        $q=$this->db->get('',$sampai,$dari);
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function banner($param){
        $this->db->select('*');
        $this->db->from('jp_banner');
        if(!empty($param)) $this->db->where('banner_status',$param);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function relasi($status){
        $this->db->select('*');
        $this->db->from('tbl_relasi');
        $this->db->where('relasi_status',$status);
        $this->db->order_by('relasi_id');
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    
    
    public function simpan($nama_tabel, $data, $key, $key_value){
        if($key_value!=""){
            $this->db->where($key, $key_value);
            $this->db->update($nama_tabel,$data);
        }else
        {
            $this->db->insert($nama_tabel, $data);
        }
    }
    
    public function hapus($nama_tabel,$key,$key_value){
        $this->db->where($key,$key_value);
        $this->db->delete($nama_tabel);
    }

    public function data_by_id($nama_tabel,$param,$param_val){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->where($param,$param_val);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }
    public function data_field_terakhir($nama_tabel,$nama_field,$where,$where_val,$order){
        $this->db->select($nama_field);
        $this->db->from($nama_tabel);
        $this->db->where($where,$where_val);
        $this->db->order_by($order,'desc');
        $this->db->limit(1);
        $q=$this->db->get();
        foreach ($q ->result_array() as $row) {
            $result=$row[$nama_field];
        }
        return $result;
    }
    public function ambil_provinsi($id_def,$nama_def) {
        $sql_prov=$this->db->get('jp_provinsi');   
        if($sql_prov->num_rows()>0){
            foreach ($sql_prov->result_array() as $row)
            {
                $result[$id_def]= $nama_def;
                $result[$row['id_provinsi']]= ucwords(strtolower($row['nama_provinsi']));
            }
            return $result;
        }
    }
    public function ambil_kabupaten($kode_prop){
        $this->db->where('id_provinsi',$kode_prop);
        $this->db->order_by('nama_kabupaten','asc');
        $sql_kabupaten=$this->db->get('jp_kabupaten');
        if($sql_kabupaten->num_rows()>0){

            foreach ($sql_kabupaten->result_array() as $row)
            {
                $result[$row['id_kabupaten']]= ucwords(strtolower($row['nama_kabupaten']));
            }
            } else {
               $result['-']= '- Belum Ada Kabupaten -';
            }
            return $result;
    }

    public function list_1_tabel($nama_tabel,$order,$order_val){
        $this->db->select('*');
        $this->db->from($nama_tabel);
        $this->db->order_by($order,$order_val);
        $q=$this->db->get();
        if ($q->num_rows() > 0){
            return $q->result_array();
        }
        else
        {
            return array(); 
        }
    }

    public function get_posting_byid($id){
        $this->db->where('id_job_posting',$id);
        return $this->db->get('jp_posting')->row();
        //return $query->row();
    }

    function cek_user($username, $userpass, $login_as)
    {
        $hash_1st=md5($userpass);
        $key=substr($hash_1st, 5,5);
        $new_hash=md5($key .$hash_1st .$key);
        if($login_as=="Pencari Kerja"){
            $this->db->where('member_username',$username);
            $this->db->where('member_password', $new_hash);
            $this->db->where('member_status','Aktif');
            return $this->db->get('jp_member')->row();
        }else{
            $this->db->where('username',$username);
            $this->db->where('userpass', $new_hash);
            $this->db->where('status_perusahaan','Aktif');
            return $this->db->get('jp_perusahaan')->row();
        }
          
    }

   
    
}
