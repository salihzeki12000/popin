<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	
	public function __Construct()
	{
	   	 parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->image_path = realpath(APPPATH . '../uploads/blog');
		 $this->load->model(ADMIN_DIR.'/adminFaq','faq');
		
		
	}
	
	public function lists()
	{
		$data = array();
		$data['module_heading'] = 'FAQ List';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.FAQ.'/list',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function get_all_list()
	{
			 if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
					$response = $this->faq->updateStatus($_POST['id'],$_REQUEST['customActionName']);
				 	$status = $response['status'];
					$message = $response['message'];
				
		   }
		   $list = $this->faq->get_datatables();
       	   $data = array();
           $no = $_POST['start'];
		   $data = array();
        	$no = $_POST['start'];
		foreach ($list as $faq) {
			$no++;
            $possible_status_changes = '';
			$row = array();
			$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$faq->id.'"/><span></span></label>';
			$row[] = ucfirst($faq->question); 
			$row[] = $faq->answer;
			$row[] = $faq->name;
			$row[] = date(DATE_FORMAT,$faq->createdDate);
			$row[] = date(DATE_FORMAT,$faq->updatedDate);
			if($faq->status=='Active')
			{
				$row[] = '<button class="btn btn-success">'.$faq->status.'</button>';
			}
			else if($faq->status=='DeActive')
			{
				$row[] = '<button class="btn btn-warning">'.$faq->status.'</button>';
			}
			else
			{
				$row[] = '<button class="btn btn-danger">'.$faq->status.'</button>';
			}
			//add html for action
			
			$row[] = '<div class="btn-group btn-primary">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/faq/edit/'.$faq->id).'"><i class="fa fa-pencil"></i> Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/faq/delete/'.$faq->id).'"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';
            $data[] = $row;
        }
 
 		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->faq->count_all(),
                        "recordsFiltered" => $this->faq->count_filtered(),
                        "data" => $data,
						
                );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
				$output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
				$output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
		   }
		//output to json format
		  echo json_encode($output);
	}
	
	
	
	
	
	public function delete()
	{
		$array = $this->uri->uri_to_assoc();
		$faq_id = $array['delete'];
		$response = $this->faq->deleteFaq($faq_id);	
		if($response>0)
			{
				$this->session->set_flashdata('message_notification','FAQ Deleted Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/faq/lists/');
			}
		else
			{
				$this->session->set_flashdata('message_notification','FAQ Not Deleted Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/faq/lists/');
			}
	}
	
	public function add()
	{
		$data['module_heading'] = 'Add FAQ';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.FAQ.'/add',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	}
	
	
	public function edit()
	{
		$data['module_heading'] = 'Edit FAQ';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$faq_id = $this->uri->segment('4');
		$data['faqInfo'] = $this->faq->viewFaq($faq_id);
		if(!empty($data['faqInfo']))
		{
			$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
			$this->load->view(ADMIN_DIR.'/'.FAQ.'/edit',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
		}
		else
		{
			$this->lists();
		}
	}
	
	public function add_faq()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$config = array(
						array(
								'field' => 'question',
								'label' => 'Question',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Question'
								),
						),
						array(
								'field' => 'answer',
								'label' => 'Answer',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Answer'
								),
						),
						array(
								'field' => 'category',
								'label' => 'Category',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Select Category'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The FAQ Status'
										),
						)
				);
		
		$this->form_validation->set_rules($config);
		
		
		
		
		if($this->form_validation->run()== FALSE )
		{
				$this->session->set_flashdata('message_notification',validation_errors());
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/faq/add');
		}
		else
		{
			
			$faqData = array(
									"question"			=>	$this->input->post('question'),
									"answer"   			=>  $this->input->post('answer'),
									"category"			=>	$this->input->post('category'),
									"status"			=>	$this->input->post('status'),
									"createdDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->faq->addFaq($faqData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','FAQ Added Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/faq/lists');
			}
			else
			{
				$this->session->set_flashdata('message_notification','FAQ Not Added Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				 redirect(ADMIN_DIR.'/faq/add');
			}			
			
		}
	
	}
	
	public function update_faq()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$config = array(
						array(
								'field' => 'question',
								'label' => 'Question',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Question'
								),
						),
						array(
								'field' => 'answer',
								'label' => 'Answer',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Answer'
								),
						),
						array(
								'field' => 'category',
								'label' => 'Category',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Select Category'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The FAQ Status'
										),
						)
				);
		
		$this->form_validation->set_rules($config);
		
		
		
		
		if($this->form_validation->run()== FALSE )
		{
				$this->session->set_flashdata('message_notification',validation_errors());
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/faq/edit/'.$this->input->post('id'));
		}
		else
		{
			
			$faqData = array(
									"question"			=>	$this->input->post('question'),
									"answer"   			=>  $this->input->post('answer'),
									"category"			=>	$this->input->post('category'),
									"createdDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"status"			=>	$this->input->post('status'),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->faq->editFaq($faqData,$this->input->post('id'));
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','FAQ Updated Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/faq/lists');
			}
			else
			{
				$this->session->set_flashdata('message_notification','FAQ Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				 redirect(ADMIN_DIR.'/faq/edit/'.$this->input->post('id'));
			}			
			
		}
	
	}
}
?>
