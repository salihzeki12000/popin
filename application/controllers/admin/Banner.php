<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends CI_Controller {

	
	public function __Construct()
	{
	   	 parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->load->model(ADMIN_DIR.'/AdminBanner','banner');
	}	
	
	public function lists()
	{
		$data = array();
		$data['module_heading'] = 'Banner List';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.HOME_BANNER.'/list',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function add()
	{
		$data = array();
		$data['module_heading'] = 'Add Banner';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.HOME_BANNER.'/add',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);
	} 
	
	public function edit()
	{
		$data = array();
		$data['module_heading'] = 'Edit Banner';
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		$banner_id = $this->uri->segment('4');
		$data['bannerInfo'] = $this->banner->viewBanner($banner_id);
		if(!empty($data['bannerInfo']))
		{
			$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
			$this->load->view(ADMIN_DIR.'/'.HOME_BANNER.'/edit',$data);		
			$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);	
		}
		else{
			$this->session->set_flashdata('message_notification','Something went wrong with this record, Please try again.');
			$this->session->set_flashdata('class',A_FAIL);
			redirect(ADMIN_DIR.'/banner/lists');
		}
	}
	
	public function get_all_list()
	{
			 if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
				 
					$response = $this->banner->updateStatus($_POST['id'],$_REQUEST['customActionName']);
				 	$status = $response['status'];
					$message = $response['message'];
				
		   }
		   $list = $this->banner->get_datatables();
       	   $data = array();
           $no = $_POST['start'];
		   $data = array();
        	$no = $_POST['start'];
		foreach ($list as $banner) {
			$no++;
            $possible_status_changes = '';
			$row = array();
			$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$banner->id.'"/><span></span></label>';
			$row[] = ucfirst($banner->caption);
			$row[] = '<img src="'.base_url('uploads/banner/thumb/'.$banner->image).'" alt="'.$banner->caption.'">';
           	$row[] = $banner->url;
		    $row[] = date(DATE_FORMAT,$banner->createdDate);
			$row[] = date(DATE_FORMAT,$banner->updatedDate);
			if($banner->status=='Active')
			{
				$row[] = '<button class="btn btn-success">'.$banner->status.'</button>';
			}
			else if($banner->status=='DeActive')
			{
				$row[] = '<button class="btn btn-warning">'.$banner->status.'</button>';
			}
			else
			{
				$row[] = '<button class="btn btn-danger">'.$banner->status.'</button>';
			}
			//add html for action
			
			$row[] = '<div class="btn-group btn-info">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/banner/edit/'.$banner->id).'"><i class="fa fa-pencil"></i> Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="'.base_url(ADMIN_DIR.'/banner/delete/'.$banner->id).'"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';
            $data[] = $row;
        }
 
 		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->banner->count_all(),
                        "recordsFiltered" => $this->banner->count_filtered(),
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
		$banner_id = $array['delete'];
		$response = $this->banner->deleteBanner($banner_id);	
		if($response>0)
			{
				$this->session->set_flashdata('message_notification','Banner Deleted Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/banner/lists');
			}
		else
			{
				$this->session->set_flashdata('message_notification','Banner Not Deleted Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/banner/lists');
			}
	}
	
	public function add_banner()
	{
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$config = array(
						array(
								'field' => 'caption',
								'label' => 'Banner Caption',
								'rules' => 'required|min_length[5]|max_length[50]',
								'errors' => array(
										'required' => 'Please Enter The Banner Caption',
										'min_length' => 'Minimum 5 Characters Long Banner Caption Is Required',
										'max_length' => 'Maximum 50 Characters Long Banner Caption Is Required'
								),
						),
						array(
								'field' => 'description',
								'label' => 'Banner Description',
								'rules' => 'required|min_length[20]|max_length[120]',
								'errors' => array(
										'required' => 'Please Enter The Banner Description',
										'min_length' => 'Minimum 20 Characters Long Banner Description Is Required',
										'max_length' => 'Maximum 120 Characters Long Banner Description Is Required'
								),
						),
						array(
								'field' => 'url',
								'label' => 'Banner Link',
								'rules' => 'required|valid_url',
								'errors' => array(
										'required' => 'Please Enter The Banner Link',
										'valid_url' => 'Please Enter Valid Banner URL'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Banner Status'
										),
						)
				);
		
		$this->form_validation->set_rules($config);
		
		$file_upload_error = false;
		if($_FILES['image']['name']!='')
				{
					$config['upload_path'] = './uploads/banner/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = '2500';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('image'))
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
				redirect(ADMIN_DIR.'/banner/add');
		}
		else
		{
			if($_FILES['image']['name']!='')
			{
					//Image Upload
					$upload_data = $this->upload->data();
					$this->load->library('image_lib');
					
					//Thumbnails Size
					$image_sizes = array(
						'thumb' => array(150, 100,'thumb'),
						'big' => array(870, 450,'big')
					);
					
					
					foreach ($image_sizes as $resize) {
						
						//Creating thumbnails code start
						$config = array(
							'image_library' => 'gd2',
							'source_image' => $upload_data['full_path'],
							'new_image' => './uploads/banner/'.$resize[2].'/'.$upload_data['file_name'],
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
				$image_name = 'default.jpg';
			}
			
			$bannerData = array(
									"caption"			=>	$this->input->post('caption'),
									"url"				=>  $this->input->post('url'),
									"description"   	=>  $this->input->post('description'),
									"image"				=>  $image_name,
									"status"			=>	$this->input->post('status'),
									"createdDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address()
								);
			$response = $this->banner->addBanner($bannerData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Home Page Banner Added Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/banner/lists');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Home Page Banner Not Added Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				 redirect(ADMIN_DIR.'/banner/add');
			}			
			
		}
	}
	public function update_banner()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		$config = array(
						array(
								'field' => 'caption',
								'label' => 'Banner Caption',
								'rules' => 'required|min_length[5]|max_length[50]',
								'errors' => array(
										'required' => 'Please Enter The Banner Caption',
										'min_length' => 'Minimum 5 Characters Long Banner Caption Is Required',
										'max_length' => 'Maximum 50 Characters Long Banner Caption Is Required'
								),
						),
						array(
								'field' => 'description',
								'label' => 'Banner Description',
								'rules' => 'required|min_length[10]|max_length[120]',
								'errors' => array(
										'required' => 'Please Enter The Banner Description',
										'min_length' => 'Minimum 10 Characters Long Banner Description Is Required',
										'max_length' => 'Maximum 120 Characters Long Banner Description Is Required'
								),
						),
						array(
								'field' => 'url',
								'label' => 'Banner Link',
								'rules' => 'required|valid_url',
								'errors' => array(
										'required' => 'Please Enter The Banner Link',
										'valid_url' => 'Please Enter Valid Banner URL'
								),
						),
						array(
								'field' => 'status',
								'label' => 'Status',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter The Banner Status'
										),
						)
				);
		$this->form_validation->set_rules($config);
			
		$file_upload_error = false;
		if($_FILES['image']['name']!='')
				{
					$config['upload_path'] = './uploads/banner/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = '2500';
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('image'))
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
				redirect(ADMIN_DIR.'/banner/edit/'.$this->input->post('id'));
		}
		else
		{
		
			if($_FILES['image']['name']!='')
			{
					//Image Upload
					$upload_data = $this->upload->data();
					$this->load->library('image_lib');
					
					//Thumbnails Size
					$image_sizes = array(
						'thumb' => array(150, 100,'thumb'),
						'big' => array(870, 450,'big')
					);
					
					
					foreach ($image_sizes as $resize) {
						
						//Creating thumbnails code start
						$config = array(
							'image_library' => 'gd2',
							'source_image' => $upload_data['full_path'],
							'new_image' => './uploads/banner/'.$resize[2].'/'.$upload_data['file_name'],
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
			if($upload_data['file_name']!='' and $this->input->post('oldImage')!='' and $this->input->post('oldImage')!='default.jpg')
			{
				@unlink("./uploads/banner/".$this->input->post('oldImage'));
				@unlink("./uploads/banner/big/".$this->input->post('oldImage'));
				@unlink("./uploads/banner/thumb/".$this->input->post('oldImage'));
				//It means you have to unlink the image
				$image_name = $upload_data['file_name'];
			}
			else
			{
				$image_name = $this->input->post('oldImage');
			}
			$bannerData = array(
									"caption"			=>	$this->input->post('caption'),
									"url"				=> 	$this->input->post('url'),
									"description" 		=>  $this->input->post('description'),
									"image"				=>  $image_name,
									"status"			=>	$this->input->post('status'),
									"updatedDate"		=>  strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 		=>  $this->input->ip_address(),
									"id"				=>  $this->input->post('id')
								);
			$response = $this->banner->editBanner($bannerData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Banner Updated Successfully');
				$this->session->set_flashdata('class',A_SUC);
				redirect(ADMIN_DIR.'/banner/lists/');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Banner Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/banner/edit/'.$this->input->post('id'));
			}			
			
		}
	
	}
}
?>
