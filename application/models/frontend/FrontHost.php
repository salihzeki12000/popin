<?php

class FrontHost extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$table = 'host';
	}    
	
	public function check_exist_email($email,$id)
	{
		$this->db->select('id');
		$this->db->from('host');
		$this->db->where('email',$email);
		
		if($id>0)
		{
			$this->db->where('id',$id);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	public function checkUser($email)
	{
		$this->db->select('id,firstName,lastName,email,password')->from('host');
		$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function addHost($data){
        //Insert Query Goes here...
		$this->db->insert('host',$data);
		return $this->db->insert_id();
	}
	public function hostProfileInfo()
	{
		if($this->session->userdata('host_id')!= NULL)
		{
			$where = array("status"=>'Active',"id=" =>$this->session->userdata('host_id'));
			$query = $this->db->select('*')->from('host')->where($where)->get();		
			return $query->row();
		}
		else
		{
			$this->check_isvalidated();
		}
	}
	
	public function check_isvalidated(){
		$this->session->unset_userdata('redirect_url');
		if(! $this->session->userdata('host_id')){
			$this->session->set_userdata('redirect_url', base_url(uri_string()));
			$this->session->set_flashdata('message_notification','Please Login To Continue');
			$this->session->set_flashdata('class',A_FAIL);
            redirect(base_url());
        }
    }
	public function editHost($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update('host',$data);
		return $this->db->affected_rows();			
	}
	public function deleteHost($id)
	{
		
		$this->db->select('featuredImage');
		$this->db->from('host');
		$this->db->where('id',$id);
		$query = $this->db->get();		
		$image = $query->row();
		
		@unlink("./uploads/page/".$image->featuredImage);
		@unlink("./uploads/page/big/".$image->featuredImage);
		@unlink("./uploads/page/med/".$image->featuredImage);
		@unlink("./uploads/page/thumb/".$image->featuredImage);
		
		$this->db->where('id', $id);
   		$this->db->delete('host'); 
		return $this->db->affected_rows();
	}
	
	public function doLogin($data){
        unset($data['login_submit']);
		$where = array("email"=>$data['login_email']);
		$query = $this->db->select('id,status,password')->from('host')->where($where)->get();
		
		$host_data = $query->row();
		if($this->encrypt->decode($host_data->password) == $this->input->post('login_password'))
		{
			return $host_data;
		}
		else
		{
			return array();
		}
	}
	
	public function loginRecord($data)
	{
		//Insert Query Goes here...
		$this->db->insert('login_logs',$data);
		return $this->db->insert_id();
	}
	public function sessionLogout($session_log)
	{
		
		//exit($session_log);
		$data = array("logoutDate"=>strtotime(date('Y-m-d H:i:s')));
		$where = array("id"=>$session_log);
		$this->db->where($where);
		$this->db->update('login_logs',$data);
		return $this->db->affected_rows();	
	}
}
?>