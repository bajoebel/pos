<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tutupbuku extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Tutupbuku_model');
    }

    public function index(){
    	$auth=$this->_auth();
        if($auth['priv_count']>0){
            $limit=10;
            $q="";
            $this->load->model('Akun_model');
            $sekarang=date('Y-m-d');
            $data=array(
                'q'             => $q,
                'notif'         => $auth["notif"],
                'penjualan'     => $this->Tutupbuku_model->get_penjualan($auth['username']),
                'pembelian'     => $this->Tutupbuku_model->get_pembelian($auth['username']),
                'return_b'      => $this->Tutupbuku_model->get_return($auth['username']),
                'hutang'        => $this->Tutupbuku_model->get_hutang($auth['username']),
                'piutang'       => $this->Tutupbuku_model->get_piutang($auth['username']),
                'pembayaran_hutang'      => $this->Tutupbuku_model->get_pembayaran_hutang($auth['username']),
                'penerimaan_piutang'      => $this->Tutupbuku_model->get_penerimaan_piutang($auth['username']),
                'perkiraan_aset'=> $this->Tutupbuku_model->get_perkiraan_aset(),
                'pengaturan'    => $this->Tutupbuku_model->get_pengaturan(),
                'akun'          => $this->Akun_model->get_akun(),
                'menu'          => $auth['menu']
            );
            $content=array(
                'priv_count'=>$auth['priv_count'],
                'title' => 'List Transaksi',
                'isi' => $this->load->view('admin/tutupbuku/tutupbuku_form', $data,true)
            );
            $x['content']=$this->load->view('template_form',$content,true);
            $this->load->view('template',$x);
        }   
    }

    /*save and update data*/
    public function save_setting(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            $tutupbuku_id=$this->input->post('tutupbuku_id');
            $data = array(
                'penjualan_akun_id' => $this->input->post('penjualan_akun_id'),
                'pembelian_akun_id' => $this->input->post('pembelian_akun_id'),
                'perkiraan_akun_id' => $this->input->post('perkiraan_akun_id'),
                'return_akun_id'    => $this->input->post('return_akun_id'),
                'piutang_akun_id'    => $this->input->post('piutang_akun_id'),
                'hutang_akun_id'    => $this->input->post('hutang_akun_id'),
                'penerimaan_piutang'    => $this->input->post('penerimaan_piutang'),
                'pembayaran_hutang'    => $this->input->post('pembayaran_hutang'),
            );
            if(empty($tutupbuku_id)){
                $insert = $this->Tutupbuku_model->save_setting($data);
            }else{
                $this->Tutupbuku_model->update_setting($data,$tutupbuku_id);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function save(){
        $auth=$this->_auth();
        if($auth['add']=='Y'){
            $akun_perkiraan=$this->input->post('akun_perkiraan');
            $akun_jual=$this->input->post('akun_jual');
            $akun_beli=$this->input->post('akun_beli');
            $akun_return=$this->input->post('akun_return');
            $akun_piutang=$this->input->post('akun_piutang');
            $akun_hutang=$this->input->post('akun_hutang');
            $akun_penerimaan_piutang=$this->input->post('akun_penerimaan_piutang');
            $akun_pembayaran_hutang=$this->input->post('akun_pembayaran_hutang');

            $perkiraan_aset=$this->input->post('perkiraan_aset');
            $penjualan_tanggal=$this->input->post('jual_tanggal');
            $pembelian_tanggal=$this->input->post('masuk_tanggal');
            $return_tanggal=$this->input->post('return_tanggal');
            $hutang_tgl=$this->input->post('hutang_tgl');
            $piutang_tgl=$this->input->post('piutang_tgl');
            $bayar_tgl=$this->input->post('bayar_tgl');
            $terima_tgl=$this->input->post('terima_tgl');
            //input array
            $pembelian=$this->input->post('pembelian');
            $penjualan=$this->input->post('penjualan');
            $return_b=$this->input->post('return_b');
            $totalhutang=$this->input->post('totalhutang');
            $totalpiutang=$this->input->post('totalpiutang');
            $totalbayar=$this->input->post('totalbayar');
            $totalterima=$this->input->post('totalterima');
            $j=0;
            if(!empty($penjualan)){
                foreach ($penjualan as $p) {
                    //echo "<br>".$p;
                    $jual[]=array(
                        'transaksi_akun_id' => $akun_jual,
                        'transaksi_jumlah'   => $p,
                        'transaksi_catatan'=>'Penjualan Tanggal ' .$penjualan_tanggal[$j],
                        'transaksi_tgl' => $penjualan_tanggal[$j],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    $this->db->where('jual_userinput',$auth["username"]);
                    $jtb=array('jual_tutup_buku'=>'Sudah');
                    $this->db->where('jual_tanggal',$penjualan_tanggal[$j]);
                    $this->db->update('barang_jual',$jtb);

                    $j++;
                }
            }
            

            $b=0;
            if(!empty($pembelian)){
                foreach ($pembelian as $p) {
                    //echo "<br>".$p;
                    $beli[]=array(
                        'transaksi_akun_id' => $akun_beli,
                        'transaksi_jumlah'   => $p,
                        'transaksi_tgl' => $pembelian_tanggal[$b],
                        'transaksi_catatan'=>'Barang Masuk Tanggal ' .$pembelian_tanggal[$b],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    

                    $btb=array('masuk_tutup_buku'=>'Sudah');
                    $this->db->where('masuk_userinput',$auth["username"]);
                    $this->db->where('masuk_tanggal',$pembelian_tanggal[$b]);
                    $this->db->update('barang_masuk',$btb);

                    $b++;
                }
            }
            

            $r=0;
            if(!empty($return_b)){
                foreach ($return_b as $p) {
                    //echo "<br>".$p;
                    $retun[]=array(
                        'transaksi_akun_id' => $akun_return,
                        'transaksi_jumlah'   => $p,
                        'transaksi_tgl' => $return_tanggal[$r],
                        'transaksi_catatan'=>'Barang Return Tanggal ' .$return_tanggal[$r],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    
                    $rtb=array('return_tutup_buku'=>'Sudah');
                    $this->db->where('return_userinput',$auth["username"]);
                    $this->db->where('return_tanggal',$return_tanggal[$r]);
                    $this->db->update('barang_return',$rtb);

                    $r++;
                }
            }
            
            $idx=0;
            if(!empty($totalhutang)){
                foreach ($totalhutang as $p) {
                    //echo "<br>".$p;
                    $hutang[]=array(
                        'transaksi_akun_id' => $akun_hutang,
                        'transaksi_jumlah'   => $p,
                        'transaksi_tgl' => $hutang_tgl[$idx],
                        'transaksi_catatan'=>'Pembelian Kredit Tanggal ' .$hutang_tgl[$idx],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    
                    $rtb=array('hutang_tutupbuku'=>'Sudah');
                    $this->db->where('hutang_userinput',$auth["username"]);
                    $this->db->where('hutang_tgl',$hutang_tgl[$idx]);
                    $this->db->update('hutang',$rtb);

                    $idx++;
                }
            }

            $idx=0;
            if(!empty($totalpiutang)){
                foreach ($totalpiutang as $p) {
                    //echo "<br>".$p;
                    $piutang[]=array(
                        'transaksi_akun_id' => $akun_piutang,
                        'transaksi_tgl' => $piutang_tgl[$idx],
                        'transaksi_jumlah'   => $p,
                        'transaksi_catatan'=>'Penjualan Kredit Tanggal ' .$piutang_tgl[$idx],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    
                    $rtb=array('piutang_tutupbuku'=>'Sudah');
                    $this->db->where('piutang_userinput',$auth["username"]);
                    $this->db->where('piutang_tgl',$piutang_tgl[$idx]);
                    $this->db->update('piutang',$rtb);

                    $idx++;
                }
            }

            $idx=0;
            if(!empty($totalbayar)){
                foreach ($totalbayar as $p) {
                    //echo "<br>".$p;
                    $bayar[]=array(
                        'transaksi_akun_id' => $akun_pembayaran_hutang,
                        'transaksi_jumlah'   => $p,
                        'transaksi_tgl' => $bayar_tgl[$idx],
                        'transaksi_catatan'=>'Pembayaran Hutang Tanggal ' .$bayar_tgl[$idx],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    
                    $rtb=array('bayar_tutupbuku'=>'Sudah');
                    $this->db->where('bayar_userinput',$auth["username"]);
                    $this->db->where('bayar_tgl',$bayar_tgl[$idx]);
                    $this->db->update('pembayaran_hutang',$rtb);

                    $idx++;
                }
            }

            $idx=0;
            if(!empty($totalterima)){
                foreach ($totalterima as $p) {
                    //echo "<br>".$p;
                    $terima[]=array(
                        'transaksi_akun_id' => $akun_penerimaan_piutang,
                        'transaksi_jumlah'   => $p,
                        'transaksi_tgl' => $terima_tgl[$idx],
                        'transaksi_catatan'=>'Pembayaran Hutang Tanggal ' .$terima_tgl[$idx],
                        'transksi_tglinput'=>date('Y-m-d'),
                        'transaksi_tglupdate'=>date('Y-m-d'),
                        'transksi_userinput'=>$auth['username'],
                        'transaksi_userupdate'=>$auth['username']
                    );
                    
                    $rtb=array('terima_tutupbuku'=>'Sudah');
                    $this->db->where('terima_userinput',$auth["username"]);
                    $this->db->where('terima_tgl',$terima_tgl[$idx]);
                    $this->db->update('penerimaan_piutang',$rtb);

                    $idx++;
                }
            }
            $perkiraan=array(
                'transaksi_akun_id' => $akun_perkiraan,
                'transaksi_jumlah'   => $perkiraan_aset,
                'transaksi_catatan'=>'Barang Return Tanggal ' .date('Y-m-d'),
                'transksi_tglinput'=>date('Y-m-d'),
                'transaksi_tglupdate'=>date('Y-m-d'),
                'transksi_userinput'=>$auth['username'],
                'transaksi_userupdate'=>$auth['username']
            );

            $cek=$this->Tutupbuku_model->cek_akun_transaksi($akun_perkiraan);
            if($cek > 0) {
                $this->db->where('transaksi_id',$cek);
                $this->db->update('transaksi',$perkiraan);
            }else{
                $this->db->insert('transaksi',$perkiraan);
            }
            if(!empty($jual)) $this->db->insert_batch('transaksi',$jual);
            if(!empty($beli)) $this->db->insert_batch('transaksi',$beli);
            if(!empty($retun)) $this->db->insert_batch('transaksi',$retun);
            if(!empty($hutang)) $this->db->insert_batch('transaksi',$hutang);
            if(!empty($piutang)) $this->db->insert_batch('transaksi',$piutang);
            if(!empty($bayar)) $this->db->insert_batch('transaksi',$bayar);
            if(!empty($terima)) $this->db->insert_batch('transaksi',$terima);
            $this->session->set_flashdata('message','Proses Tutup Buku Selesai');
            header('location:' .base_url() ."tutupbuku");
        } else{
            $this->session->set_flashdata('message','Anda TIdak berhak akses');
            header('location:' .base_url() ."tutupbuku");
        }
    }
    //Auth
    public function _auth(){
        $this->load->model('Auth_model');
        $x['notif']=$this->Auth_model->get_notif();
        $x['menu']=$this->Auth_model->menu($this->session->userdata('user_akses_level'));
        $x['username']=$this->session->userdata('username');
        $x['id_group']=$this->session->userdata('user_akses_level');
        $priv=$this->Auth_model->get_privilage($x['id_group'],'tutupbuku');
        $x['priv_count']=$this->Auth_model->cek_privilage($x['id_group'],'tutupbuku');
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
}