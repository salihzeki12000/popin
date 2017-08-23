<?php

class AdminLogin extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function doLogin($data) {
        unset($data['submit']);
        $where = array("status" => 'Active', "uname" => $data['adminUserName'], "password" => md5($data['adminPassword']));
        $query = $this->db->select('id')->from('admin')->where($where)->or_where('email', $data['adminUserName'])->get();
        return $query->row('id');
    }

    public function loginRecord($data) {
        //Insert Query Goes here...
        $this->db->insert('login_logs', $data);
        return $this->db->insert_id();
    }

    public function adminProfileInfo() {
        if ($this->session->userdata('admin_id') != NULL) {
            $where = array("status" => 'Active', "id=" => $this->session->userdata('admin_id'));
            $query = $this->db->select('*')->from('admin')->where($where)->get();
            return $query->row();
        } else {
            $this->check_isvalidated();
        }
    }

    public function sessionLogout($session_log) {
        $data = array("logoutDate" => strtotime(date('Y-m-d H:i:s')));
        $where = array("id" => $session_log, 'userType' => 'Admin');
        $this->db->where($where);
        $this->db->update('login_logs', $data);
        return $this->db->affected_rows();
    }

    public function check_isvalidated() {
        $this->session->unset_userdata('redirect_url');
        if (!$this->session->has_userdata('admin_id')) {
            $this->session->set_userdata('redirect_url', base_url(uri_string()));
            $this->session->set_flashdata('message_notification', 'Please login to continue');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/login');
        }
    }

}

?>
