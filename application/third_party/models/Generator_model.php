<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generator_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    //Menampilkan List Tabel
    function daftar_tabel($dbname){
        $this->db->select('TABLE_NAME,ENGINE');
        $this->db->where('TABLE_SCHEMA',$dbname);
        return $this->db->get('information_schema.TABLES')->result();
    }

    //Menampilkan Column Tabel
    function daftar_column($dbname,$tablename){
        $this->db->select('ORDINAL_POSITION,COLUMN_NAME,IS_NULLABLE,DATA_TYPE,COLUMN_TYPE,CHARACTER_MAXIMUM_LENGTH,COLUMN_KEY,EXTRA');
        $this->db->where('TABLE_SCHEMA',$dbname);
        $this->db->where('TABLE_NAME',$tablename);
        return $this->db->get('information_schema.COLUMNS')->result();
    }

    //Menampilkan Relasi Tabel
    function relasi_tabel($dbname,$tablename){
        $this->db->select('ORDINAL_POSITION,COLUMN_NAME,REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME');
        $this->db->where('TABLE_SCHEMA',$dbname);
        $this->db->where('TABLE_NAME',$tablename);
        return $this->db->get('information_schema.KEY_COLUMN_USAGE')->result();
    }
    

}

/* End of file Candidat_model.php */
/* Location: ./application/models/Candidat_model.php */
/* Please DO NOT modify this information : */