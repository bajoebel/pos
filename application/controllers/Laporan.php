<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Laporan_model');
    }
    /*Load Data HTML*/
    public function index(){
        $auth=$this->_auth('laporan');
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $data=array(
                'q'     =>$q,
                'notif'=>$auth['notif'],
                'notif'=>$auth['notif'],
                'list_kategori'    => $this->Barang_model->get_kategori(),
                'list_rak'    => $this->Barang_model->get_rak(),
                'menu'=>$auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Barang',
                'isi' => $this->load->view('admin/laporan/laporan_barang', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }    
    }

    public function barang($file_type=NULL){
        $auth=$this->_auth('laporan/barang');
        $param = urldecode($this->input->get('p', TRUE));
        $param_val = urldecode($this->input->get('v', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($param <> '' || $param_val<>'') {
            $config['base_url'] = base_url() . 'laporan/barang.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
            $config['first_url'] = base_url() . 'laporan/barang.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
        } else {
            $config['base_url'] = base_url() . 'laporan/barang.html';
            $config['first_url'] = base_url() . 'laporan/barang.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->barang_rows($param, $param_val);
        $barang_data    = $this->Laporan_model->barang_data($config['per_page'], $start, $param, $param_val);
        $barang_report  = $this->Laporan_model->barang_data($config['total_rows'], 0, $param, $param_val);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'barang_data' => $barang_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan Barang',
                    'isi' => $this->load->view('admin/laporan/laporan_barang', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'barang_data' => $barang_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_barang_pdf',$data,true);
                    $pdfFilePath = "LAP_BRG_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_barang_exel', $data);
                }else{
                    $this->load->view('admin/laporan/laporan_barang_print', $data);
                }
            }    
        }
    }

    public function barang_rusak($file_type=NULL){
        $auth=$this->_auth('laporan/barang_rusak');
        $param = urldecode($this->input->get('p', TRUE));
        $param_val = urldecode($this->input->get('v', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($param <> '' || $param_val<>'') {
            $config['base_url'] = base_url() . 'laporan/barang_rusak.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
            $config['first_url'] = base_url() . 'laporan/barang_rusak.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
        } else {
            $config['base_url'] = base_url() . 'laporan/barang_rusak.html';
            $config['first_url'] = base_url() . 'laporan/barang_rusak.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->barang_rusak_rows($param, $param_val);
        $barang_rusak_data    = $this->Laporan_model->barang_rusak_data($config['per_page'], $start, $param, $param_val);
        $barang_rusak_report  = $this->Laporan_model->barang_rusak_data($config['total_rows'], 0, $param, $param_val);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'barang_data' => $barang_rusak_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan barang_rusak',
                    'isi' => $this->load->view('admin/laporan/laporan_barang_rusak', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'barang_data' => $barang_rusak_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_barang_rusak_pdf',$data,true);
                    $pdfFilePath = "LAP_BRG_RSK" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_barang_rusak_exel', $data);
                }else{
                    $this->load->view('admin/laporan/laporan_barang_rusak_print', $data);
                }
            }    
        }
    }

    public function barang_exp($file_type=NULL){
        $auth=$this->_auth('laporan/barang_exp');
        $param = urldecode($this->input->get('p', TRUE));
        $param_val = urldecode($this->input->get('v', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($param <> '' || $param_val<>'') {
            $config['base_url'] = base_url() . 'laporan/barang_exp.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
            $config['first_url'] = base_url() . 'laporan/barang_exp.html?p=' . urlencode($param) ."&v=" .urldecode($param_val);
        } else {
            $config['base_url'] = base_url() . 'laporan/barang_exp.html';
            $config['first_url'] = base_url() . 'laporan/barang_exp.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->barang_exp_rows($param, $param_val);
        $barang_exp_data    = $this->Laporan_model->barang_exp_data($config['per_page'], $start, $param, $param_val);
        $barang_exp_report  = $this->Laporan_model->barang_exp_data($config['total_rows'], 0, $param, $param_val);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'barang_data' => $barang_exp_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan barang exp',
                    'isi' => $this->load->view('admin/laporan/laporan_barang_exp', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'barang_data' => $barang_exp_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_barang_exp_pdf',$data,true);
                    $pdfFilePath = "LAP_BRG_EXP" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_barang_exp_exel', $data);
                }else{
                    $this->load->view('admin/laporan/laporan_barang_exp_print', $data);
                }
            }    
        }
    }
    public function penjualan($file_type=NULL,$file_type1=NULL){
        $auth=$this->_auth('laporan/penjualan');
        $from = urldecode($this->input->get('from', TRUE));
        $to = urldecode($this->input->get('to', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($from <> '' || $to<>'') {
            $config['base_url'] = base_url() . 'laporan/barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
            $config['first_url'] = base_url() . 'laporan/barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
        } else {
            $config['base_url'] = base_url() . 'laporan/barang.html';
            $config['first_url'] = base_url() . 'laporan/barang.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->penjualan_rows($from, $to);
        $penjualan_data    = $this->Laporan_model->penjualan_data($config['per_page'], $start, $from, $to);
        $penjualan_report  = $this->Laporan_model->penjualan_data($config['total_rows'], 0, $from, $to);

        $penjualan_data_detail    = $this->Laporan_model->penjualan_data_detail($config['per_page'], $start, $from, $to);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'penjualan_data' => $penjualan_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan Penjualan',
                    'isi' => $this->load->view('admin/laporan/laporan_penjualan', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'penjualan_data' => $penjualan_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_penjualan_pdf',$data,true);
                    $pdfFilePath = "LAP_JUAL_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_penjualan_exel', $data);
                }elseif($file_type=='print'){
                    $this->load->view('admin/laporan/laporan_penjualan_print', $data);
                }else{
                    $config['total_rows'] = $this->Laporan_model->penjualan_detail_rows($from, $to);
                    $penjualan_report_detail  = $this->Laporan_model->penjualan_data_detail($config['total_rows'], 0, $from, $to);
                    if($file_type1==""){
                        $data = array(
                            'penjualan_data' => $penjualan_data_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        $content=array(
                            'priv_count'=>$auth['priv_count'],
                            'title' => 'Laporan Penjualan',
                            'isi' => $this->load->view('admin/laporan/laporan_penjualan_detail', $data,true)
                        );
                        $x['content']=$this->load->view('template_form',$content,true);
                        $this->load->view('template',$x);
                    }else{
                        $detail = array(
                            'penjualan_data' => $penjualan_report_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        if($file_type1=='pdf'){
                            //print_r($penjualan_report_detail);
                            foreach ($penjualan_report_detail as $p) {
                                //echo "<br>Test";
                            }
                            $html=$this->load->view('admin/laporan/laporan_penjualan_detail_pdf',$detail,true);
                            $pdfFilePath = "LAP_JUAL_DET" .date('Ymdhis') .".pdf";
                            $this->load->library('m_pdf');
                            $pdf = $this->m_pdf->load();
                            $pdf->WriteHTML($html);
                            $pdf->Output($pdfFilePath, "D");
                        }elseif ($file_type1=='excel') {
                            $this->load->view('admin/laporan/laporan_penjualan_detail_exel', $detail);
                        }else{
                            $this->load->view('admin/laporan/laporan_penjualan_detail_print', $detail);
                        }
                    }
                    
                }
            }    
        }
    }

    public function pembelian($file_type=NULL,$file_type1=NULL){
        $auth=$this->_auth('laporan/pembelian');
        $from = urldecode($this->input->get('from', TRUE));
        $to = urldecode($this->input->get('to', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($from <> '' || $to<>'') {
            $config['base_url'] = base_url() . 'laporan/pembelian.html?from=' . urlencode($from) ."&to=" .urldecode($to);
            $config['first_url'] = base_url() . 'laporan/pembelian.html?from=' . urlencode($from) ."&to=" .urldecode($to);
        } else {
            $config['base_url'] = base_url() . 'laporan/pembelian.html';
            $config['first_url'] = base_url() . 'laporan/pembelian.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->pembelian_rows($from, $to);
        $pembelian_data    = $this->Laporan_model->pembelian_data($config['per_page'], $start, $from, $to);
        $pembelian_report  = $this->Laporan_model->pembelian_data($config['total_rows'], 0, $from, $to);

        $pembelian_data_detail    = $this->Laporan_model->pembelian_data_detail($config['per_page'], $start, $from, $to);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'pembelian_data' => $pembelian_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan pembelian',
                    'isi' => $this->load->view('admin/laporan/laporan_pembelian', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'pembelian_data' => $pembelian_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_pembelian_pdf',$data,true);
                    $pdfFilePath = "LAP_BELI_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_pembelian_exel', $data);
                }elseif($file_type=='print'){
                    $this->load->view('admin/laporan/laporan_pembelian_print', $data);
                }else{
                    $config['total_rows'] = $this->Laporan_model->pembelian_detail_rows($from, $to);
                    $pembelian_report_detail  = $this->Laporan_model->pembelian_data_detail($config['total_rows'], 0, $from, $to);
                    if($file_type1==""){
                        $data = array(
                            'pembelian_data' => $pembelian_data_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        $content=array(
                            'priv_count'=>$auth['priv_count'],
                            'title' => 'Laporan pembelian',
                            'isi' => $this->load->view('admin/laporan/laporan_pembelian_detail', $data,true)
                        );
                        $x['content']=$this->load->view('template_form',$content,true);
                        $this->load->view('template',$x);
                    }else{
                        $detail = array(
                            'pembelian_data' => $pembelian_report_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        if($file_type1=='pdf'){
                            //print_r($pembelian_report_detail);
                            foreach ($pembelian_report_detail as $p) {
                                //echo "<br>Test";
                            }
                            $html=$this->load->view('admin/laporan/laporan_pembelian_detail_pdf',$detail,true);
                            $pdfFilePath = "LAP_BELI_DET" .date('Ymdhis') .".pdf";
                            $this->load->library('m_pdf');
                            $pdf = $this->m_pdf->load();
                            $pdf->WriteHTML($html);
                            $pdf->Output($pdfFilePath, "D");
                        }elseif ($file_type1=='excel') {
                            $this->load->view('admin/laporan/laporan_pembelian_detail_exel', $detail);
                        }else{
                            $this->load->view('admin/laporan/laporan_pembelian_detail_print', $detail);
                        }
                    }
                    
                }
            }    
        }
    }

    public function return_barang($file_type=NULL,$file_type1=NULL){
        $auth=$this->_auth('laporan/return_barang');
        $from = urldecode($this->input->get('from', TRUE));
        $to = urldecode($this->input->get('to', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($from <> '' || $to<>'') {
            $config['base_url'] = base_url() . 'laporan/return_barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
            $config['first_url'] = base_url() . 'laporan/return_barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
        } else {
            $config['base_url'] = base_url() . 'laporan/return_barang.html';
            $config['first_url'] = base_url() . 'laporan/return_barang.html';
        }

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->return_rows($from, $to);
        if(!empty($from)) $from=$from ." 00:00:00";
        if(!empty($to)) $to=$to ." 23:59:59";
        $return_data    = $this->Laporan_model->return_data($config['per_page'], $start, $from, $to);
        $return_report  = $this->Laporan_model->return_data($config['total_rows'], 0, $from, $to);

        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'return_data' => $return_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan return',
                    'isi' => $this->load->view('admin/laporan/laporan_return', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'return_data' => $return_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_return_pdf',$data,true);
                    $pdfFilePath = "LAP_RET_BRG_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_return_exel', $data);
                }else{
                    $this->load->view('admin/laporan/laporan_return_print', $data);
                }
            }    
        }
    }


    public function keuangan($file_type=NULL,$file_type1=NULL){
        $auth=$this->_auth('laporan/keuangan');
        $from = urldecode($this->input->get('from', TRUE));
        $to = urldecode($this->input->get('to', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($from <> '' || $to<>'') {
            $config['base_url'] = base_url() . 'laporan/barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
            $config['first_url'] = base_url() . 'laporan/barang.html?from=' . urlencode($from) ."&to=" .urldecode($to);
        } else {
            $config['base_url'] = base_url() . 'laporan/barang.html';
            $config['first_url'] = base_url() . 'laporan/barang.html';
        }

        $config['per_page'] = $this->Laporan_model->keuangan_rows($from, $to);
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_model->keuangan_rows($from, $to);
        $keuangan_data    = $this->Laporan_model->keuangan_data($config['per_page'], $start, $from, $to);
        $keuangan_report  = $this->Laporan_model->keuangan_data($config['total_rows'], 0, $from, $to);

        $keuangan_data_detail    = $this->Laporan_model->keuangan_data_detail($config['per_page'], $start, $from, $to);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        if($auth['priv_count']>0){
            if($file_type==""){
                $data = array(
                    'keuangan_data' => $keuangan_data,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan keuangan',
                    'isi' => $this->load->view('admin/laporan/laporan_keuangan', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'keuangan_data' => $keuangan_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'from'=>$from,
                    'to'=>$to,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_keuangan_pdf',$data,true);
                    $pdfFilePath = "LAP_JUAL_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_keuangan_exel', $data);
                }elseif($file_type=='print'){
                    $this->load->view('admin/laporan/laporan_keuangan_print', $data);
                }else{
                    $config['total_rows'] = $this->Laporan_model->keuangan_detail_rows($from, $to);
                    $keuangan_report_detail  = $this->Laporan_model->keuangan_data_detail($config['total_rows'], 0, $from, $to);
                    if($file_type1==""){
                        $data = array(
                            'keuangan_data' => $keuangan_data_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        $content=array(
                            'priv_count'=>$auth['priv_count'],
                            'title' => 'Laporan keuangan',
                            'isi' => $this->load->view('admin/laporan/laporan_keuangan_detail', $data,true)
                        );
                        $x['content']=$this->load->view('template_form',$content,true);
                        $this->load->view('template',$x);
                    }else{
                        $detail = array(
                            'keuangan_data' => $keuangan_report_detail,
                            'start'=>$start,
                    'notif'=>$auth['notif'],
                            'from'=>$from,
                            'to'=>$to,
                            'pagination' => $this->pagination->create_links(),
                            'total_rows' => $config['total_rows'],
                            'start' => $start,
                            'menu'=>$auth['menu'],
                        );
                        if($file_type1=='pdf'){
                            //print_r($keuangan_report_detail);
                            foreach ($keuangan_report_detail as $p) {
                                //echo "<br>Test";
                            }
                            $html=$this->load->view('admin/laporan/laporan_keuangan_detail_pdf',$detail,true);
                            $pdfFilePath = "LAP_JUAL_DET" .date('Ymdhis') .".pdf";
                            $this->load->library('m_pdf');
                            $pdf = $this->m_pdf->load();
                            $pdf->WriteHTML($html);
                            $pdf->Output($pdfFilePath, "D");
                        }elseif ($file_type1=='excel') {
                            $this->load->view('admin/laporan/laporan_keuangan_detail_exel', $detail);
                        }else{
                            $this->load->view('admin/laporan/laporan_keuangan_detail_print', $detail);
                        }
                    }
                    
                }
            }    
        }
    }
    //Auth
    public function _auth($modul){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],$modul);
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],$modul);
        $x['add']='N';
        $x['update']='N';
        $x['delete']='N';
        $x['report']='N';
        foreach ($priv as $a) {
            $x['add']=$a['add1'];
            $x['update']=$a['update1'];
            $x['delete']=$a['delete1'];
            $x['report']=$a['report1'];
        }
        return $x;
    }

    public function kartustok($id,$file_type=null){
        $auth=$this->_auth('laporan/barang');
        $dari = urldecode($this->input->get('dari', TRUE));
        $sampai = urldecode($this->input->get('sampai', TRUE));
        
        
        if($auth['priv_count']>0){
            if($file_type==""){
                $stokawal=$this->db->query("SELECT a.idx,`jns_transaksi`,DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') AS `tgl_transaksi`,a.`barang_id`,`barang_nama`,
                SUM(`jml_masuk`) AS jml_masuk, SUM(`jml_keluar`) AS jml_keluar, `barang_satuan_kecil`,`barang_satuan_besar`,`a`.`konversi_satuan`
                FROM `log_transaksi` a JOIN `barang` b ON a.barang_id=b.barang_id  WHERE a.barang_id=$id AND DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') < '$dari' 
                GROUP BY a.`barang_id` ORDER BY a.idx")->row();

                $list=$this->db->query("SELECT a.idx,`jns_transaksi`,DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') AS `tgl_transaksi`,a.`barang_id`,`barang_nama`,
                SUM(`jml_masuk`) AS jml_masuk, SUM(`jml_keluar`) AS jml_keluar, `barang_satuan_kecil`,`barang_satuan_besar`,`a`.`konversi_satuan`
                FROM `log_transaksi` a JOIN `barang` b ON a.barang_id=b.barang_id  WHERE a.barang_id=$id AND DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') >='$dari'  AND DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') <='$sampai'
                GROUP BY a.`barang_id`,DATE_FORMAT(`tgl_transaksi`,'%Y-%m-%d') ORDER BY a.idx;")->result();
                $barang=$this->db->query("SELECT * from barang WHERE barang_id=$id")->row();
                $data = array(
                    'barang_data'=>$barang,
                    'stokawal' => $stokawal,
                    'list' => $list,
                    'dari'=>$dari,
                    'sampai'=>$sampai,
                );
                // $this->load->view('admin/laporan/laporan_kartustok_barang', $data);
                $content=array(
                    'priv_count'=>$auth['priv_count'],
                    'title' => 'Laporan Kartu Stok Barang',
                    'isi' => $this->load->view('admin/laporan/laporan_kartustok_barang', $data,true)
                );
                $x['content']=$this->load->view('template_form',$content,true);
                $this->load->view('template',$x);
            }else{
                $data = array(
                    'barang_data' => $barang_report,
                    'start'=>$start,
                    'notif'=>$auth['notif'],
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                    'menu'=>$auth['menu'],
                );
                if($file_type=='pdf'){
                    $html=$this->load->view('admin/laporan/laporan_barang_pdf',$data,true);
                    $pdfFilePath = "LAP_BRG_" .date('Ymdhis') .".pdf";
                    $this->load->library('m_pdf');
                    $pdf = $this->m_pdf->load();
                    $pdf->WriteHTML($html);
                    $pdf->Output($pdfFilePath, "D");
                }elseif ($file_type=='excel') {
                    $this->load->view('admin/laporan/laporan_barang_exel', $data);
                }else{
                    $this->load->view('admin/laporan/laporan_barang_print', $data);
                }
            }    
        }
    }
}