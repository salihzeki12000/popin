<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        //$this->load->library('session');
    }

    function index() {

        $this->load->model(ADMIN_DIR . '/adminLogin', 'adminLogin');
        $affected_rows = $this->adminLogin->sessionLogout($this->session->userdata('admin_session_login_id'));
        if ($affected_rows > 0) {
            $this->session->unset_userdata(array('admin_id', 'admin_session_login_id', 'redirect_url'));
            $this->session->set_flashdata('message_notification', 'You have been logged out successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/login');
        } else {
            $this->session->set_flashdata('message_notification', 'Something went wrong, Please try again later');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/');
        }
    }

}
