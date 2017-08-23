<?php

class AdminFaqCategory extends CI_Model {
	
	var $table = 'faq_category';
  	var $select_fields = 'id,name,createdDate,updatedDate,status';
   	var $where_condition = "id!='0'";
    var $column_order = array('id','id','name','createdDate','updatedDate','status',null); //set column field database for datatable orderable
    var $column_search = array('id','name','createdDate','updatedDate','status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'DESC'); // default order 
	
	 private function get_datatables_query()
		{
			$this->db->from($this->table);
			$this->db->select($this->select_fields);
			$this->db->where($this->where_condition);
			$i = 0;   
			
			foreach ($this->column_search as $item) // loop column 
			{
				
				if($_POST['search']['value']) // if datatable send POST for search
				{                 
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}
	 
					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
			 
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			if(isset($_POST['name']) and $_POST['name']!='')
			{
				//$this->db->where('fname="'.($_POST['fname']).'"');
				$this->db->like('name',$_POST['name']);
			}
			if((!empty($_POST['order_date_from']) and !empty($_POST['order_date_to'])))
			{
				$from_date = explode('/', $_POST['order_date_from']);
				$from_date_ymd = strtotime($from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
				$to_date = explode('/', $_POST['order_date_to']);;
				$to_date_ymd = strtotime($to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
				if($from_date_ymd<=$to_date_ymd)
				{
					$this->db->where('createdDate >=', $from_date_ymd);
					$this->db->where('createdDate <=', $to_date_ymd);
				}	
			}
			if((!empty($_POST['order_date_from_updated']) and !empty($_POST['order_date_to_updated'])))
			{
				$from_date = explode('/', $_POST['order_date_from_updated']);
				$from_date_ymd = strtotime($from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
				$to_date = explode('/', $_POST['order_date_to_updated']);;
				$to_date_ymd = strtotime($to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
				if($from_date_ymd<=$to_date_ymd)
				{
					$this->db->where('updatedDate >=', $from_date_ymd);
					$this->db->where('updatedDate <=', $to_date_ymd);
				}	
			}
			if(isset($_POST['status']) and $_POST['status']!='')
			{
				$this->db->where('status="'.$_POST['status'].'"');
			}
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}
	 public function get_datatables()
		{
			$this->get_datatables_query();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}
    public function count_filtered()
    {
        $this->get_datatables_query();
		$query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
		$this->db->from($this->table);
	    return $this->db->count_all_results();
    }
	
	
	
	public function addCategory($data){
        //Insert Query Goes here...
		$this->db->insert('faq_category',$data);
		return $this->db->affected_rows();
	}
	public function deleteFAQCategory($categoryId)
	{
		
		$this->db->where('id', $categoryId);
   		$this->db->delete($this->table); 
		return $this->db->affected_rows();
	}	
	public function editCategory($data)
	{
		$where = array("id"=>$data['id']);
		$this->db->where($where);
		$this->db->update('faq_category',$data);
		return $this->db->affected_rows();			
	}
	public function viewCategory($id)
	{
		$this->db->select('id,name,status');
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();		
		return $query->row();
	}
	public function check_exist_name($name,$faq_category=0)
	{
		$this->db->select('id')->from('faq_category');
		$this->db->where('name="'.$name.'"');
		
		if($faq_category>0)
		{
			$this->db->where('id!='.$faq_category);
		}
		
		$query = $this->db->get();
		return $query->row();
		
	}
	public function updateStatus($id = array(), $status)
	{
		$affected_rows = '';
		foreach($id as $id)
		{
			$wrong = false;
			$where = array("id"=>$id);
			$this->db->where($where);
			$data = array("status"=>$status);
			$this->db->update('faq_category',$data);
			$affected_rows = $this->db->affected_rows();	
			if($affected_rows<1)
			{
				$wrong = true;
			}
		}
		if($wrong == true)
		{
			return array("status"=>"NOT OK","message"=>"Selected FAQ's Category Status Not Updated Sucessfully");
		}
		else
		{
			return array("status"=>"OK","message"=>"Selected FAQ's Category Status Updated Successfully");
		}
	}
	
}

?>
