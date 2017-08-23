<?php

class AdminProfile extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->mtable = 'admin';
	}
	
	public function adminProfileInfo($admin_id){
        $where = array("status"=>'1',"id"=>$admin_id);
    	$query = $this->db->select('*')->from('admin')->where($where)->get();		
		return $query->row();
	}
	public function adminProfileUpdate($profileDetails)
	{
		$this->db->where('id',$this->session->userdata('admin_id'));
		$this->db->update('admin',$profileDetails);
		return $this->db->affected_rows();
	}
	public function check_current_password($admin)
	{
		$where = array('password'=>md5($admin['password']),"id"=>$admin['id']);
		$query = $this->db->select('id')->from('admin')->where($where)->get();
		return $query->row();
	}
	
}

?>
