<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transactions extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/AdminTransactions', 'transactions');
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data = array();
        $data['module_heading'] = 'Transactions';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/transactions/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        $list = $this->transactions->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transaction) {
            $no++;
            $row = array();
            //$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $ns->id . '"/><span></span></label>';
            $user = getSingleRecord('user', 'id', $transaction->user_id);
            $row[] = $user->firstName . ' ' .$user->lastName;
            
            $row[] = ucfirst($transaction->paid_for);
            if($transaction->paid_for == 'rental'){
                $space = getSingleRecord('spaces', 'id', $transaction->booking_id, 'spaceTitle');
                
                $row[] = $space->spaceTitle;
            }elseif($transaction->paid_for == 'subscription'){
                $subscription = getSingleRecord('subscription_master', 'code', $transaction->booking_id, 'name');
                
                $row[] = $subscription->name;
            }
            
            $row[] = $transaction->txn_id;
            //$subscription = getSingleRecord('subscription_master', 'code', $ns->subscription_code);
            //$row[] = $transaction->name;
            $row[] = getCurrency_symbol($transaction->currency_code).$transaction->payment_gross;
            $row[] = $transaction->payer_email;
            $row[] = date(DATE_FORMAT, strtotime($transaction->payment_date));
            $row[] = $transaction->payment_status;
            //$row[] = "";
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transactions->count_all(),
            "recordsFiltered" => $this->transactions->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

?>
