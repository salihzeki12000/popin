<?php

class AdminSettings extends CI_Model {
	private $table;
        
	function __construct(){
            parent::__construct();    
            $this->table = 'settings';
	}
	
	public function settingInfo(){
        $query = $this->db->select('*')->from($this->table)->get();		
		return $query->row();
	}
	public function adminSettingsUpdate($settingData)
	{
		$this->db->update($this->table,$settingData);
		return $this->db->affected_rows();
	}	
	
	public function getAllFooterPages($section){
        $query = $this->db->select('section,page')->from('footer_pages')->where('section',$section)->get();		
		return $query->row();
	}
	
	public function getAllStaticPages()
	{
		$query = $this->db->select('id,pageName')->from('static_page')->where('status','Active')->get();		
		return $query->result();
	}
	public function footerStaticPagesUpdate($data)
	{
		$where = array("section"=>$data['section']);
		$this->db->where($where);
		$this->db->update('footer_pages',$data);
		return $this->db->affected_rows();
	}
	
	public function getPageDetail($pageId)
	{
		$query = $this->db->select('pageName,url')->from('static_page')->where('id',$pageId)->get();		
		return $query->row();
	}
}

?>
