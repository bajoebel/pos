<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/* 
| ------------------------------------------------------------------- 
| EMAIL CONFIG 
| ------------------------------------------------------------------- 
| Konfigurasi email keluar melalui mail server
| */  
$config=array();
$config['charset'] = 'utf-8';
$config['useragent'] = 'Talenhub';
$config['protocol']= "smtp";
$config['mailtype']= "html";
$config['smtp_host']= "mail.talenthub.co.id";//pengaturan smtp
$config['smtp_port']= "587";
$config['smtp_timeout']= "400";
$config['smtp_user']= "noreplay@talenthub.co.id"; // isi dengan email kamu
$config['smtp_pass']= "b4703b3l"; // isi dengan password kamu
$config['crlf']="\r\n"; 
$config['newline']="\r\n"; 
$config['wordwrap'] = TRUE;
/* End of file email.php */ 
/* Location: ./system/application/config/email.php */