<?php

class FrontSubscriber extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$table = 'newsletter_subscriber';
	}    
	
	
	
	
	public function addSubscriber($data){
        //Insert Query Goes here...
		$this->db->insert('newsletter_subscriber',$data);
		return $this->db->insert_id();
	}
	
	public function editSubscriber($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('newsletter_subscriber',$data);
		return $this->db->affected_rows();			
	}
	public function deleteHost($id)
	{		
		$this->db->where('id', $id);
   		$this->db->delete('newsletter_subscriber'); 
		return $this->db->affected_rows();
	}
}
?>