<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->model(ADMIN_DIR . '/AdminDashboard', 'dashboard');
    }

    public function index() {
        $data = array();
        $data['module_heading'] = 'Dashboard';
        $data['adminProfileInfo'] = $this->adminProfileInfo;

        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . DASHBOARD . '/index', $data);
        $this->load->view(ADMIN_DIR . '/include/footer', $data);
    }

}
