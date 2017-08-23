<?php

class FrontCommon extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$table = 'newsletter_subscriber';
	}    
	
	public function getSiteDetails()
	{
		$this->db->select('*');
		$this->db->from('settings');
		$query = $this->db->get();		
		return $query->row();
	}
	
	
	
}
?>