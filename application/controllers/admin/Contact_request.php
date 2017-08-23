<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_request extends CI_Controller {

	
	public function __Construct()
	{
	   	 parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->load->model(ADMIN_DIR.'/adminContactRequest','contact');
		
		
	}
	
	public function index()
	{
		$this->lists();
	}
	
	public function lists()
	{
		$data = array();
		$data['module_heading'] = 'Contact Requests';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.CON_REQ.'/list',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function get_all_list()
	{
			 if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
					$response = $this->contact->updateStatus($_POST['id'],$_REQUEST['customActionName']);
				 	$status = $response['status'];
					$message = $response['message'];
				
		   }
		   $list = $this->contact->get_datatables();
       	   $data = array();
           $no = $_POST['start'];
		   $data = array();
        	$no = $_POST['start'];
		foreach ($list as $cr) {
			$no++;
            $possible_status_changes = '';
			$row = array();
			$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$cr->id.'"/><span></span></label>';
			$row[] = ucfirst($cr->subject); 
			$row[] = $cr->name;
			$row[] = $cr->email;
			$row[] = $cr->number;
			$row[] = date(DATE_FORMAT,$cr->createdDate);
			$row[] = date(DATE_FORMAT,$cr->updatedDate);
			if($cr->status=='Pending')
			{
				$row[] = '<button class="btn btn-default">'.$cr->status.'</button>';
			}
			else if($cr->status=='Active')
			{
				$row[] = '<button class="btn btn-success">'.$cr->status.'</button>';
			}
			else if($cr->status=='DeActive')
			{
				$row[] = '<button class="btn btn-warning">'.$cr->status.'</button>';
			}
			else
			{
				$row[] = '<button class="btn btn-danger">'.$cr->status.'</button>';
			}
			//add html for action
			
			$row[] = '<div class="btn-group btn-info">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                       <li>
                                                                                            <a href="javascript:void(0);" title="View Contact Request" onClick="view_contact_request('.$cr->id.');"><i class="fa fa-eye"></i> View</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/contact_request/delete/'.$cr->id).'"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';           $data[] = $row;
        }
 
 		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->contact->count_all(),
                        "recordsFiltered" => $this->contact->count_filtered(),
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
		$contact_id = $this->uri->segment('4');
		$response = $this->contact->deleteContactRequest($contact_id);	
		if($response>0)
			{
				$this->session->set_flashdata('message_notification','Contact Request Deleted Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/contact_request');
			}
		else
			{
				$this->session->set_flashdata('message_notification','Contact Request Not Deleted Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/contact_request');
			}
	}
	
	public function view($id)
	{
		$data = $this->contact->viewContactRequest($id);
		echo json_encode($data);
	}
	
	public function edit()
	{
		$data['module_heading'] = 'Edit Contact Request';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$contact_id = $this->uri->segment('4');
		$data['contactInfo'] = $this->contact->viewContactRequest($contact_id);
		if(!empty($data['contactInfo']))
		{
			$this->load->view(ADMIN_DIR.'/'.ADMIN_HEADER_VERSION.'/common/header',$data);		
			$this->load->view(ADMIN_DIR.'/'.ADMIN_LEFT_SIDEBAR_VERSION.'/common/sidebar',$data);		
			$this->load->view(ADMIN_DIR.'/'.ADMIN_PAGE_DASHBOARD_VERSION.'/contact_request_edit',$data);		
			$this->load->view(ADMIN_DIR.'/'.ADMIN_FOOTER_VERSION.'/common/footer',$data);
		}
		else
		{
			$this->lists();
		}
	}
	
	public function update_contact_request()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		$config = array(
						array(
								'field' => 'name',
								'label' => 'Name',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Requester Name'
								),
						),
						array(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Subject'
								),
						),
						array(
								'field' => 'email',
								'label' => 'Email',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Email Address'
								),
						),
						array(
								'field' => 'number',
								'label' => 'Number',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Number'
								),
						),
						array(
								'field' => 'message',
								'label' => 'Message',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Message'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Status'
										),
						)
				);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run()== FALSE )
		{
				$this->session->set_flashdata('message_notification',validation_errors());
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/contact_request/');
		}
		else
		{
			$contactRequestData = array(
									"name"				=>	$this->input->post('name'),
									"subject"			=>	$this->input->post('subject'),
									"email"				=>	$this->input->post('email'),
									"number"			=>	$this->input->post('number'),
									"message"			=>	$this->input->post('message'),
									"status"			=>	$this->input->post('status'),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->contact->editContactRequest($contactRequestData,$this->input->post('id'));
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Contact Request Updated Successfully');
				$this->session->set_flashdata('class',A_SUCCESS);
				redirect(ADMIN_DIR.'/contact_request/'); 
			}
			else
			{
				$this->session->set_flashdata('message_notification','Contact Request Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/contact_request/');
			}			
			
		}	
	}
	}
?>
