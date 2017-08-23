<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subscriptions extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/AdminSubscriber', 'subscriber');
        $this->load->model(ADMIN_DIR . '/AdminSubscription', 'subscription');
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data = array();
        $data['module_heading'] = 'Subscriber List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SUBSCRIBER . '/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        $list = $this->subscriber->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ns) {
            $no++;
            $row = array();
            //$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $ns->id . '"/><span></span></label>';
            $user = getSingleRecord('user', 'id', $ns->user_id);
            $row[] = $user->firstName . ' ' .$user->lastName;
            
            $subscription = getSingleRecord('subscription_master', 'code', $ns->subscription_code);
            $row[] = $subscription->name;
            $row[] = date("d F, Y", $ns->subscribed_date);
            $row[] = ucwords($ns->subscribed_through);
            $row[] = $ns->subscribed_with;
            $row[] = date("d F, Y", $ns->valid_date);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subscriber->count_all(),
            "recordsFiltered" => $this->subscriber->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function manage_subscription_plans() {
        $data = array();
        $data['module_heading'] = 'Subscription Plans';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SUBSCRIBER . '/subscription_plan_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    
    public function get_all_subscription_list() {
        $list = $this->subscription->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ns) {
            $no++;
            $row = array();
            //$row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $ns->id . '"/><span></span></label>';
            $row[] = $ns->name;
            $row[] = $ns->details;
            $row[] = "$".$ns->amount;
            $row[] = date(DATE_FORMAT, $ns->createdDate);
            $row[] = date(DATE_FORMAT, $ns->updatedDate);
            //add html for action
            $row[] = '<div class="btn-group btn-info">
                        <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                        <i class="fa fa-user"></i> Settings
                        <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                            <a  href="' . base_url(ADMIN_DIR . '/subscriptions/update_subscription/' . $ns->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subscription->count_all(),
            "recordsFiltered" => $this->subscription->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function update_subscription() {
        $data = array();
        $data['module_heading'] = 'Update Subscription Details';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $subscriptionID = $this->uri->segment('4');
        $data['subscription'] = $this->subscription->viewSubscription($subscriptionID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SUBSCRIBER . '/edit_subscription_plan', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function update_subscription_submit() {
       $config = array(
            array(
                'field' => 'name',
                'label' => 'Subscription Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Subscription Name.'
                ),
            ),
            array(
                'field' => 'details',
                'label' => 'Subscription Details',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Subscription Details.'
                ),
            ),
            array(
                'field' => 'amount',
                'label' => 'Amount',
                'rules' => 'required|integer|greater_than[0]',
                'errors' => array(
                    'required' => 'Please Enter Subscription Amount.'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/subscriptions/update_subscription/' . $this->input->post('id'));
        } else {
            $subscription = array(
                "name" => trim($this->input->post('name')),
                "details" => trim($this->input->post('details')),
                "amount" => trim($this->input->post('amount')),
                "updatedDate" => time(),
                "id" => $this->input->post('id')
            );
            $response = $this->subscription->update_subscription_details($subscription);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Subscription Details Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/manage_subscription_plans');
            } else {
                $this->session->set_flashdata('message_notification', 'Subscription Details Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/subscriptions/update_subscription/' . $this->input->post('id'));
            }
        }
    }

    public function delete_subscription() {
        $array      = $this->uri->uri_to_assoc();
        $subscription_id = $array['delete_subscription'];
        $response = $this->subscription->deleteSubscription($subscription_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Subscription has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/manage_subscription_plans');
        } else {
            $this->session->set_flashdata('message_notification', 'Subscription Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/manage_subscription_plans');
        }
    }
}

?>
