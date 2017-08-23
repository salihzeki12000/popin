<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	
	public function __Construct()
	{
	   	 parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->image_path = realpath(APPPATH . '../uploads/page');
		 $this->load->model(ADMIN_DIR.'/adminPages','page');
		
		
	}
	
	public function lists()
	{
		$data = array();
		$data['module_heading'] = 'Pages List';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.CMS_PAGE.'/list',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function get_all_list()
	{
			 if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
					$response = $this->page->updateStatus($_POST['id'],$_REQUEST['customActionName']);
				 	$status = $response['status'];
					$message = $response['message'];
				
		   }
		   $list = $this->page->get_datatables();
       	   $data = array();
           $no = $_POST['start'];
		   $data = array();
        	$no = $_POST['start'];
		foreach ($list as $page) {
			$no++;
            $possible_status_changes = '';
			$row = array();
			$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$page->id.'"/><span></span></label>';
			if($page->featuredImage!='')
			{
				$row[] = '<img src="'.base_url('uploads/page/thumb/'.$page->featuredImage).'" alt="'.$page->pageName.'">';	
			}
			else
			{
				$row[] = 'No Featured Image';
			}
			$row[] = ucfirst($page->pageName); 
			$row[] = ucfirst($page->pageTitle); 
			$row[] = date(DATE_FORMAT,$page->createdDate);
			$row[] = date(DATE_FORMAT,$page->updatedDate);
			if($page->status=='Active')
			{
				$row[] = '<button class="btn btn-success">'.$page->status.'</button>';
			}
			else if($page->status=='DeActive')
			{
				$row[] = '<button class="btn btn-warning">'.$page->status.'</button>';
			}
			else
			{
				$row[] = '<button class="btn btn-danger">'.$page->status.'</button>';
			}
			//add html for action
			
			$row[] = '<div class="btn-group btn-info">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        
																					    <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/pages/edit/'.$page->id).'"><i class="fa fa-pencil"></i> Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/pages/delete/'.$page->id).'"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';
            $data[] = $row;
        }
 
 		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->page->count_all(),
                        "recordsFiltered" => $this->page->count_filtered(),
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
		$page_id = $array['delete'];
		$response = $this->page->deletePage($page_id);	
		if($response>0)
			{
				$this->session->set_flashdata('message_notification','Page Deleted Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/pages/lists');
			}
		else
			{
				$this->session->set_flashdata('message_notification','Page Not Deleted Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'pages/lists');
			}
	}
	
	public function add()
	{
		$data['module_heading'] = 'Add Page';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/include/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.CMS_PAGE.'/add',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	}
	
	public function edit()
	{
		$data['module_heading'] = 'Edit Page';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$page_id = $this->uri->segment('4');
		$data['pageInfo'] = $this->page->viewPage($page_id);
		
		/*echo '<pre>';
		print_r($data['pageInfo']);
		exit;*/
		if(!empty($data['pageInfo']))
		{
			$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
			$this->load->view(ADMIN_DIR.'/'.CMS_PAGE.'/edit',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
		}
		else
		{
			$this->lists();
		}
	}
	
	public function add_page()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$config = array(
						array(
								'field' => 'pageName',
								'label' => 'Page Name',
								'rules' => 'required|is_unique[static_page.pageName]',
								'errors' => array(
										'required' => 'Please Enter The Page Name',
										'is_unique'=> 'This Page Name Is Already Taken, Please Try With Another Name'
								),
						),
						array(
								'field' => 'pageTitle',
								'label' => 'Page Title',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Title'
								),
						),
						array(
								'field' => 'metaDescription',
								'label' => 'Meta Description',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Description'
								),
						),
						array(
								'field' => 'metaAuthor',
								'label' => 'Meta Author',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Author'
								),
						),
						array(
								'field' => 'metaKeywords',
								'label' => 'Meta Keywords',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Keywords'
								),
						),
						array(
								'field' => 'pageContent',
								'label' => 'Page Content',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Content'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Status'
										),
						)
				);
		
		$this->form_validation->set_rules($config);
		
		$file_upload_error = false;
		if($_FILES['featuredImage']['name']!='')
				{
					$config['upload_path'] = './uploads/page/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = '2500';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('featuredImage'))
					{
						$file_upload_error = true;
						$file_upload_error_message = '<p>'.$this->upload->display_errors().'</p>';
					}
				}
		else
				{
					$file_upload_error_message = '';
				}
		
		
		if($this->form_validation->run()== FALSE or ($file_upload_error == true))
		{
				$this->session->set_flashdata('message_notification',validation_errors().$file_upload_error_message);
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/pages/add');
		}
		else
		{
			
			if($_FILES['featuredImage']['name']!='')
			{
					//Image Upload
					$upload_data = $this->upload->data();
					$this->load->library('image_lib');
					
					//Thumbnails Size
					$image_sizes = array(
						'thumb' => array(262, 243,'thumb'),
						'big' => array(800, 600,'big'),
						'med' => array(600,400,'med')
					);
					
					
					foreach ($image_sizes as $resize) {
						
						//Creating thumbnails code start
						$config = array(
							'image_library' => 'gd2',
							'source_image' => $upload_data['full_path'],
							'new_image' => './uploads/page/'.$resize[2].'/'.$upload_data['file_name'],
							'maintain_ration' => true,
							'width' => $resize[0],
							'height' => $resize[1]
						);
					
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$this->image_lib->clear();
						
						//Creating thumbnails code end
					}
			}
			
			if($upload_data['file_name']!='')
			{
				//It means you have to unlink the image
				$image_name = $upload_data['file_name'];
			}
			else
			{
				$image_name = '';
			}
			
			$pageData = array(
									"pageName"			=>	$this->input->post('pageName'),
									"pageTitle"   		=>  $this->input->post('pageTitle'),
									"featuredImage"	    =>  $image_name,
									"metaDescription"	=> 	trim($this->input->post('metaDescription')),
									"metaKeywords" 	    => 	trim($this->input->post('metaKeywords')),
									"metaAuthor"		=> 	$this->input->post('metaAuthor'),
									"pageContent"		=>	$this->input->post('pageContent'),
									"url"				=> 	$this->generate_url($this->input->post('pageName')),
									"status"			=>	$this->input->post('status'),
									"createdDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->page->addPage($pageData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Page Added Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/pages/lists');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Page Not Added Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				 redirect(ADMIN_DIR.'/pages/add');
			}			
			
		}
	
	}
	
	public function update_page()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		$config = array(
						array(
								'field' => 'pageName',
								'label' => 'Page Name',
								'rules' => 'required|callback_check_name['.$this->input->post('id').']',
								'errors' => array(
										'required' => 'Please Enter The Page Name'
								),
						),
						array(
								'field' => 'pageTitle',
								'label' => 'Page Title',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Title'
								),
						),
						array(
								'field' => 'metaDescription',
								'label' => 'Meta Description',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Description'
								),
						),
						array(
								'field' => 'metaAuthor',
								'label' => 'Meta Author',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Author'
								),
						),
						array(
								'field' => 'metaKeywords',
								'label' => 'Meta Keywords',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Meta Keywords'
								),
						),
						array(
								'field' => 'pageContent',
								'label' => 'Page Content',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Content'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Page Status'
										),
						)
				);
		$this->form_validation->set_rules($config);
			
		$file_upload_error = false;
		if($_FILES['featuredImage']['name']!='')
				{
					$config['upload_path'] = './uploads/page/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = '2500';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('featuredImage'))
					{
						$file_upload_error = true;
						$file_upload_error_message = '<p>'.$this->upload->display_errors().'</p>';
					}
					else{
						$file_upload_error  = false;
					}
				}
		else
				{
					$file_upload_error_message = '';
				}
		if($this->form_validation->run()== FALSE or ($file_upload_error == true))
		{
				$this->session->set_flashdata('message_notification',validation_errors().$file_upload_error_message);
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/pages/edit/'.$this->input->post('id'));
		}
		else
		{
			if($_FILES['featuredImage']['name']!='')
			{
					//Image Upload
					$upload_data = $this->upload->data();
					$this->load->library('image_lib');
					
					//Thumbnails Size
					$image_sizes = array(
						'thumb' => array(262, 243,'thumb'),
						'big' => array(800, 600,'big')
					);
					
					
					foreach ($image_sizes as $resize) {
						
						//Creating thumbnails code start
						$config = array(
							'image_library' => 'gd2',
							'source_image' => $upload_data['full_path'],
							'new_image' => './uploads/page/'.$resize[2].'/'.$upload_data['file_name'],
							'maintain_ration' => true,
							'width' => $resize[0],
							'height' => $resize[1]
						);
					
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$this->image_lib->clear();
						
						//Creating thumbnails code end
					}
			}
			
			if($upload_data['file_name']!='' and $this->input->post('OldFeaturedImage')!='' and $this->input->post('OldFeaturedImage')!='default.jpg')
			{
				@unlink("./uploads/page/".$this->input->post('OldFeaturedImage'));
				@unlink("./uploads/page/big/".$this->input->post('OldFeaturedImage'));
				@unlink("./uploads/page/thumb/".$this->input->post('OldFeaturedImage'));
				//It means you have to unlink the image
				$image_name = $upload_data['file_name'];
			}
			else
			{
				$image_name = $this->input->post('OldFeaturedImage');
			}
			
			$pageData = array(
									"pageName"			=>	$this->input->post('pageName'),
									"pageTitle"   		=>  $this->input->post('pageTitle'),
									"featuredImage"		=>  $image_name,
									"metaDescription"	=> 	trim($this->input->post('metaDescription')),
									"metaKeywords" 	    => 	trim($this->input->post('metaKeywords')),	"metaAuthor"		=> 	$this->input->post('metaAuthor'),
									"pageContent"		=>	$this->input->post('pageContent'),
									"url"				=> 	$this->generate_url($this->input->post('pageName')),
									"status"			=>	$this->input->post('status'),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->page->editPage($pageData,$this->input->post('id'));
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Page Updated Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/pages/lists');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Page Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/pages/edit/'.$this->input->post('id'));
			}			
			
		}
	
	}
	
	public function check_exist_page_name()
	{
		
		if($this->input->post('pageName')!='')
		{
			if($this->input->post('page_id')!='')
			{
				$page_id = $this->input->post('page_id');
			}
			else
			{
				$page_id = 0;
			}
			$name_check  =$this->page->check_exist_page($this->input->post('pageName'),$page_id);
			if(!empty($name_check))
			{
				echo "false";
				exit;
			}
			else
			{
				echo "true";
				exit;
			}
		}
		else
		{
			echo "false";
			exit;
		}
	
	}
	
	public function check_name($field_value,$page_id)
	{
		$record = $this->page->check_exist_page($field_value,$page_id);
		if($record->id>0)
			{
				return false;
			}
			else
			{
				return true;
			}
	}
	public function generate_url($name)
	{
		$name = str_replace('.','',$name);
		$name = preg_replace('/\s+/','-',$name);
		$name = str_replace('&','',$name);
		$name = strtolower($name);
		return $name;
	}
}
?>
