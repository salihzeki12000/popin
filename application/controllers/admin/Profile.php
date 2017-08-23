<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	
	public function __Construct()
	{
	   	parent::__Construct();
	   	 $this->load->model(ADMIN_DIR.'/adminLogin','login');
		 $this->login->check_isvalidated();
		 $this->adminProfileInfo = $this->login->adminProfileInfo();
		 $this->load->library('form_validation');
 	     $this->image_path = realpath(APPPATH . '../uploads/admin');
		 $this->load->model(ADMIN_DIR.'/adminProfile','profile');
		
	}
	
		
		
	public function index($data = array())
	{
		$data['adminProfileInfo'] = $this->adminProfileInfo;
		
		/*echo '<pre>';
		print_r($data['adminProfileInfo']);
		exit;*/
		$data['module_heading'] = 'My Profile';
		$this->load->view(ADMIN_DIR.'/'.INC.'/header',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/left-sidebar',$data);		
		$this->load->view(ADMIN_DIR.'/'.PROFILE.'/profile',$data);		
		$this->load->view(ADMIN_DIR.'/'.INC.'/footer',$data);	
	}
	
	public function edit_personal_info()
	{
		
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$config = array(
						array(
								'field' => 'name',
								'label' => 'Name',
								'rules' => 'required|min_length[6]|max_length[30]',
								'errors' => array(
										'required' => 'Please Enter The Full Name',
										'min_length' => 'Minimum 6 Characters Long Full Name Required',
										'max_length' => 'Maximum 30 Characters Long Full Name Required'
								),
						),
						array(
								'field' => 'uname',
								'label' => 'User Name',
								'rules' => 'required|min_length[3]|max_length[15]',
								'errors' => array(
										'required' => 'Please Enter The Username',
										'min_length' => 'Minimum 3 Characters Long Username Required',
										'max_length' => 'Maximum 12 Characters Long Username Required'
								),
						),
						array(
								'field' => 'email',
								'label' => 'Email',
								'rules' => 'required|valid_email',
								'errors' => array(
											'required' => 'Please Enter Email Address',
											'valid_email' => 'Please Enter Valid Email Address'
								),
						)
				);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run()== FALSE)
		{
				$this->session->set_flashdata('message_notification',validation_errors());
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile');
		}
		else
		{
			$profileData = array(
									"name"					=>	$this->input->post('name'),
									"uname"					=>	$this->input->post('uname'),
									"email"					=>	$this->input->post('email'),
									"updatedDate"			=> strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 			=>  $this->input->ip_address()
								);
			$response = $this->profile->adminProfileUpdate($profileData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Profile Updated Successfully');
				$this->session->set_flashdata('class',A_SUC);
			 	redirect(ADMIN_DIR.'/profile');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Profile Is Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile');
			}			
		}
	
	
	}
	public function edit_avatar_info()
	{
		/*echo '<pre>';
		print_r($_FILES);
		print_r($_POST);
		exit;*/
		
			$file_upload_error = false;
			if($_FILES['avatar']['name']!='')
				{
					$config['upload_path'] = './uploads/admin/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '2000';
					$config['max_width'] = '3000';
					$config['max_height'] = '2500';
					
					$this->load->library('upload', $config);
					if(!$this->upload->do_upload('avatar'))
					{
						$file_upload_error = true;
						$file_upload_error_message = '<p>'.$this->upload->display_errors().'</p>';
					}
					$form_validation_error = false;
				}
				else
				{
						$post_config = array(
							array(
									'field' => 'avatar',
									'label' => 'Avatar',
									'rules' => 'required',
									'errors' => array(
											'required' => 'Please Uplaod Your Avatar'
									),
							)
					);
					$this->form_validation->set_rules($post_config);
					if($this->form_validation->run()== FALSE)
					{
						$form_validation_error = true;
					}
					$file_upload_error_message = '';
				}
		if($form_validation_error == true or ($file_upload_error == true))
		{
				$this->session->set_flashdata('message_notification',validation_errors().$file_upload_error_message);
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile/');
		}
		else
		{
			
			if($_FILES['avatar']['name']!='')
			{
					//Image Upload
					$upload_data = $this->upload->data();
					$this->load->library('image_lib');
					
					//Thumbnails Size
					$image_sizes = array(
						'thumb' => array(150, 100,'thumb'),
						'med' => array(300, 300,'med'),
						'big' => array(800, 600,'big')
					);
					
					
					foreach ($image_sizes as $resize) {
						
						//Creating thumbnails code start
						$config = array(
							'image_library' => 'gd2',
							'source_image' => $upload_data['full_path'],
							'new_image' => './uploads/admin/'.$resize[2].'/'.$upload_data['file_name'],
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
				$image_name = $upload_data['file_name'];
				@unlink("./uploads/admin/".$this->input->post('old_avatar'));
				@unlink("./uploads/admin/big/".$this->input->post('old_avatar'));
				@unlink("./uploads/admin/med/".$this->input->post('old_avatar'));
				@unlink("./uploads/admin/thumb/".$this->input->post('old_avatar'));
				//It means you have to unlink the image
			}
			else
			{
				$image_name = $this->input->post('old_avatar');
			}
			
			$profileData = array(
									"avatar"				=>  $image_name,
									"updatedDate"			=> strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 			=>  $this->input->ip_address()
								);
			$response = $this->profile->adminProfileUpdate($profileData,$this->session->userdata('admin_id'));
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Profile Avatar Updated Successfully');
				$this->session->set_flashdata('class',A_SUC);
			 	redirect(ADMIN_DIR.'/profile/');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Profile Avatar Is Not Updated Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile');
			}			
		}
	
	
	}
	
	public function edit_change_password()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		$customer_id = $this->input->post('customer_id');
		$config = array(
						array(
								'field' => 'current_password',
								'label' => 'Current Password',
								'rules' => 'required|callback_check_password['.$customer_id.']',
								'errors' => array(
										'required' => 'Please Enter Your Current Password',
										'check_password' => 'Please Enter Correct Your Current Password'
								),
						),
						array(
								'field' => 'new_password',
								'label' => 'New Password',
								'rules' => 'required',
								'errors' => array(
										'required' => 'Please Enter Your New Password'
								),
						),
						array(
								'field' => 'confirm_new_password',
								'label' => 'Confirm New Password',
								'rules' => 'required|matches[new_password]',
								'errors' => array(
										'required' => 'Please Enter Your Confirm New Password',
										'matches'  => 'New Password And Confirm New Password Should Match'
								),
						)
				);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run()== FALSE)
		{
				$this->session->set_flashdata('message_notification',validation_errors());
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile');
		}
		else
		{
			$profileData = array(
									"base64_value"  		=>  base64_encode($this->input->post('new_password')),
									"password"				=> md5($this->input->post('new_password')),
									"updatedDate"			=> strtotime(date('Y-m-d H:i:s')),
									"ipAddress" 			=>  $this->input->ip_address()
								);
			$response = $this->profile->adminProfileUpdate($profileData);
			if($response>0)
			{
				$this->session->set_flashdata('message_notification','Password Changed Successfully');
				$this->session->set_flashdata('class',A_SUC);
			 	redirect(ADMIN_DIR.'/profile/');
			}
			else
			{
				$this->session->set_flashdata('message_notification','Password Not Changed Successfully');
				$this->session->set_flashdata('class',A_FAIL);
				redirect(ADMIN_DIR.'/profile/');
			}			
		}
	
	}
	
	public function check_password($field_value)
	{
			$admin = array("id"=>$this->session->userdata('admin_id'),"password"=>$field_value);
			$record = $this->profile->check_current_password($admin);
			if($record->id>0)
			{
				return true;
			}
			else
			{
				return false;
			}
	}
}
?>