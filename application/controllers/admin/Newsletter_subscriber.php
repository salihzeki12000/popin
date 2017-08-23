<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter_subscriber extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/adminNewsletterSubscriber', 'subscriber');
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data = array();
        $data['module_heading'] = 'Newsletter Subscriber List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . NEWS_SUBSCRIBER . '/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $response = $this->subscriber->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->subscriber->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ns) {
            $no++;
            $possible_status_changes = '';
            $row = array();
            $row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $ns->id . '"/><span></span></label>';
            $row[] = $ns->name;
            $row[] = $ns->userType;
            $row[] = $ns->email;
            $row[] = date(DATE_FORMAT, $ns->createdDate);
            $row[] = date(DATE_FORMAT, $ns->updatedDate);
            if ($ns->status == 'Pending') {
                $row[] = '<button class="btn btn-default">' . $ns->status . '</button>';
            } else if ($ns->status == 'Subscribed') {
                $row[] = '<button class="btn btn-success">' . $ns->status . '</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $ns->status . '</button>';
            }
            //add html for action

            $row[] = '<a class="btn btn-danger"  href="' . base_url(ADMIN_DIR . '/newsletter_subscriber/delete/' . $ns->id) . '"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subscriber->count_all(),
            "recordsFiltered" => $this->subscriber->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }

    public function delete() {
        $array = $this->uri->uri_to_assoc();
        $subscriber_id = $this->uri->segment('4');
        $response = $this->subscriber->deleteNewsletterSubscriber($subscriber_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Newsletter Subscriber Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/newsletter_subscriber/lists');
        } else {
            $this->session->set_flashdata('message_notification', 'Newsletter Subscriber Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/newsletter_subscriber/lists');
        }
    }

}

?>
