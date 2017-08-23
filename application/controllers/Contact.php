<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{

     public function __construct()
    {
         parent::__construct();
		 $this->load->model(FRONT_DIR.'/FrontPage','page');
		 $this->load->model(FRONT_DIR.'/FrontUser','user');
    }

	public function index()
	{
	if($this->session->userdata('user_id')!='')
	{
		$header['userProfileInfo'] = $this->user->userProfileInfo();
	}
	$header['module_heading'] = 'Contact Us';
	
	/*echo '<pre>';
	print_r($data['pageDetail']);
	exit;*/
	$this->load->view(FRONT_DIR.'/'.INC.'/user-header',$header);
    $this->load->view(FRONT_DIR.'/static_page/contact');
	$this->load->view(FRONT_DIR.'/'.INC.'/user-footer');
	}
	
 
 }
