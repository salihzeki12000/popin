<?php

class AdminFaq extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	var $table = 'faq,faq_category';
  	var $select_fields = 'faq.*,faq_category.name';
   	var $where_condition = "faq.category=faq_category.id";
    var $column_order = array('faq.id','faq.id','faq_category.name','faq.question','faq.answer','faq.createdDate','faq.updatedDate','faq.status',null); //set column field database for datatable orderable
    var $column_search = array('faq.id','faq.id','faq_category.name','faq.question','faq.answer','faq.createdDate','faq.updatedDate','faq.status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('faq.id' => 'DESC'); // default order 
	
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
				$this->db->like('faq_category.name',$_POST['name']);
			}
			if(isset($_POST['question']) and $_POST['question']!='')
			{
				$this->db->like('faq.question',$_POST['question']);
			}
			if(isset($_POST['answer']) and $_POST['answer']!='')
			{
				$this->db->like('faq.answer',$_POST['answer']);
			}
			if(isset($_POST['category']) and $_POST['category']!='')
			{
				$this->db->where('faq_category.name="'.$_POST['category'].'"');
			}
			
			if((!empty($_POST['order_date_from']) and !empty($_POST['order_date_to'])))
			{
				$from_date = explode('/', $_POST['order_date_from']);
				$from_date_ymd = strtotime($from_date[2].'-'.$from_date[1].'-'.$from_date[0]);
				$to_date = explode('/', $_POST['order_date_to']);;
				$to_date_ymd = strtotime($to_date[2].'-'.$to_date[1].'-'.$to_date[0]);
				if($from_date_ymd<=$to_date_ymd)
				{
					$this->db->where('faq.createdDate >=', $from_date_ymd);
					$this->db->where('faq.createdDate <=', $to_date_ymd);
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
					$this->db->where('faq.updatedDate >=', $from_date_ymd);
					$this->db->where('faq.updatedDate <=', $to_date_ymd);
				}	
			}
			if(isset($_POST['status']) and $_POST['status']!='')
			{
				$this->db->where('faq.status="'.$_POST['status'].'"');
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
	
	
	
	
	
	public function getAllFAQCategory()
	{
		$where = array();
		$query = $this->db->select('id,name')->from('faq_category')->where("status!='Delete'")->order_by('name','DESC')->get();
		return $query->result();
	}
	public function deleteFaq($faqId)
	{
		
		$this->db->where('id', $faqId);
   		$this->db->delete('faq'); 
		return $this->db->affected_rows();
	}	
	
	public function addFaq($data){
        //Insert Query Goes here...
		$this->db->insert('faq',$data);
		return $this->db->affected_rows();
	}
	/*public function viewFaq($faqId)
	{
		$query = $this->db->select('faq.*,faq_category.name')
		->from('faq,faq_category')
		->where("faq_category.id=faq.category")
		->where('faq.id='.$faqId)
		->get();		
		return $query->row();	
	}*/
	
	public function viewFaq($faqId)
	{
		$this->db->select('faq.id,faq.question,faq.answer,faq_category.name,faq.category,faq.status');
		$this->db->from($this->table);
		$this->db->where('faq.id',$faqId);
		$query = $this->db->get();		
		return $query->row();
	}
	
	public function editFaq($data,$faqId)
	{
		$where = array("id"=>$faqId);
		$this->db->where($where);
		$this->db->update('faq',$data);
		return $this->db->affected_rows();			
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
			$this->db->update('faq',$data);
			$affected_rows = $this->db->affected_rows();	
			if($affected_rows<1)
			{
				$wrong = true;
			}
		}
		if($wrong == true)
		{
			return array("status"=>"NOT OK","message"=>"Selected FAQ's Status Not Updated Sucessfully");
		}
		else
		{
			return array("status"=>"OK","message"=>"Selected FAQ's Status Updated Successfully");
		}
	}
}

?>
