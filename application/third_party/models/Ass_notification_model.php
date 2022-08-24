<?php
Class Ass_notification_model extends CI_Model
{
 
  function notification_list($limit){
	  $logged_in=$this->session->userdata('logged_in');
		
	  if($this->input->post('search')){
	 $this->db->or_like('ass_notification.nid',$this->input->post('search'));
	 $this->db->or_like('ass_notification.title',$this->input->post('search'));
	 $this->db->or_like('ass_notification.message',$this->input->post('search'));
	 $this->db->or_like('ass_notification.notification_date',$this->input->post('search'));
	 $this->db->or_like('ass_notification.click_action',$this->input->post('search'));
	 $this->db->or_like('ass_notification.notification_to',$this->input->post('search'));
	  }
	  if($logged_in['su'] == '0'){
	  $uid=$logged_in['uid'];
	  $this->db->or_where('ass_notification.uid',$uid);
	$this->db->or_where('ass_notification.uid','0');
		
	  }
	  $this->db->join('ass_users','ass_users.uid=ass_notification.uid','left');
		$this->db->limit($this->config->item('number_of_rows'),$limit);
		$this->db->order_by('nid','desc');
		$query=$this->db->get('ass_notification');
		return $query->result_array();
		
	 
 }
 
 
 function insert_notification($result,$nval){

         $userdata=array(
         'title'=>$this->input->post('title'),
         'message'=>$this->input->post('message'),
         'click_action'=>$this->input->post('click_action'),
         'uid'=>$this->input->post('uid'),
         'notification_to'=>$nval,
         'response'=>$result,
         
         );
         $this->db->insert('ass_notification',$userdata);
         
 
 
 }
 
 
 
   
 
}
?>
