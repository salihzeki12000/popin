<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __Construct() {

        parent::__Construct();
    }

    function index($msg = '') {
        $data = array();
        $data['module_heading'] = 'Admin Login';
        $this->load->view(ADMIN_DIR . '/' . PROFILE . '/login', $data);
    }

    public function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('adminUserName', 'Username', 'required', array('required' => 'Please Enter The User Name'));
        $this->form_validation->set_rules('adminPassword', 'Password', 'required', array('required' => 'Please Enter The Password'));
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/login');
        } else {
            $this->load->model(ADMIN_DIR . '/adminLogin', 'adminLogin');
            $admin_id = $this->adminLogin->doLogin($this->input->post());
            if ($admin_id != '' and $admin_id > 0) {
                //Insert data in to the Logins table code start
                $loginData = array(
                    "userId" => $admin_id,
                    "userType" => 'Admin',
                    "loginDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address()
                );
                $session_logs = $this->adminLogin->loginRecord($loginData);
                //Insert data in to the Logins table code end
                // Username and Password is true. So, we get user id in return from the Admin Model
                $this->session->set_userdata('admin_id', $admin_id);
                $this->session->set_userdata('admin_session_login_id', $session_logs);
                $this->session->set_flashdata('message_notification', 'You are logged in successfully');
                $this->session->set_flashdata('class', A_SUC);
                if (!$this->session->userdata('redirect_url')) {
                    redirect(ADMIN_DIR);
                } else {
                    redirect($this->session->userdata('redirect_url'));
                }
            } else {
                $this->session->set_flashdata('message_notification', 'Invalid username or password');
                $this->session->set_flashdata('class', A_FAIL);
                // Username and Password is wrong.
                redirect(ADMIN_DIR . '/login');
            }
        }
    }

}
