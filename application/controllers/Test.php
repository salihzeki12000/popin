<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("braintree_lib");
    }

    private function printJSON($var) {
        echo json_encode($var, JSON_PRETTY_PRINT);
    }

    public function get_token() {
        $token = $this->braintree_lib->create_client_token();
        //$this->printJSON($token);
        echo $token;
    }
    
    public function index() {
        $data['token'] = $this->braintree_lib->create_client_token();
        $this->load->view('braintree/test', $data);
    }
    
    function open(){
        $result['sql_details'] = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'host' => $this->db->hostname
        );
        
        print_array($result);
    }
}

?>
