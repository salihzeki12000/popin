<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_template extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/adminEmails', 'emails');
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data = array();
        $data['module_heading'] = 'Email Template List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . EMAIL_TEMPLATE . '/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $response = $this->emails->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->emails->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $email) {
            $no++;
            $possible_status_changes = '';
            $row = array();
            $row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $email->id . '"/><span></span></label>';
            $row[] = $email->emailType;
            $row[] = $email->subject;
            $row[] = $email->note;
            $row[] = date(DATE_FORMAT, $email->createdDate);
            $row[] = date(DATE_FORMAT, $email->updatedDate);
            if ($email->status == 'Active') {
                $row[] = '<button class="btn btn-success">' . $email->status . '</button>';
            } else if ($email->status == 'DeActive') {
                $row[] = '<button class="btn btn-warning">' . $email->status . '</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $email->status . '</button>';
            }
            //add html for action

            $row[] = '<div class="btn-group btn-info">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        
																					    <li>
                                                                                            <a  href="' . base_url(ADMIN_DIR . '/email_template/edit/' . $email->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="' . base_url(ADMIN_DIR . '/email_template/delete/' . $email->id) . '"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->emails->count_all(),
            "recordsFiltered" => $this->emails->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }

    public function view($id) {
        $data = $this->emails->viewEmail($id);
        echo json_encode($data);
    }

    public function delete() {
        $array = $this->uri->uri_to_assoc();
        $email_id = $array['delete'];
        $response = $this->emails->deleteEmail($email_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Email Template Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/email_template/lists');
        } else {
            $this->session->set_flashdata('message_notification', 'Email Template Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/email_template/lists');
        }
    }

    public function edit() {
        $data['module_heading'] = 'Edit Page';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $email_id = $this->uri->segment('4');
        $data['emailInfo'] = $this->emails->viewEmail($email_id);

        /* echo '<pre>';
          print_r($data['emailInfo']);
          exit; */
        if (!empty($data['emailInfo'])) {
            $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
            $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
            $this->load->view(ADMIN_DIR . '/' . EMAIL_TEMPLATE . '/edit', $data);
            $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
        } else {
            $this->lists();
        }
    }

    public function add() {
        $data['module_heading'] = 'Add Email';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/include/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . EMAIL_TEMPLATE . '/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function add_email() {

        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $config = array(
            array(
                'field' => 'emailType',
                'label' => 'Email Type',
                'rules' => 'required|is_unique[emails.emailType]',
                'errors' => array(
                    'required' => 'Please Enter The Email Type',
                    'is_unique' => 'This Email Type Is Already Taken, Please Try With Another Type'
                ),
            ),
            array(
                'field' => 'subject',
                'label' => 'Email Subject',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Subject'
                ),
            ),
            array(
                'field' => 'note',
                'label' => 'Email Note',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Note'
                ),
            ),
            array(
                'field' => 'content',
                'label' => 'Email Content',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Content'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Status'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/email_template/add');
        } else {
            $emailData = array(
                "emailType" => $this->input->post('emailType'),
                "subject" => $this->input->post('subject'),
                "note" => $this->input->post('note'),
                "content" => $this->input->post('content'),
                "status" => $this->input->post('status'),
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->emails->addEmail($emailData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Email Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/email_template/lists');
            } else {
                $this->session->set_flashdata('message_notification', 'Email Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/email_template/add');
            }
        }
    }

    public function update_email() {

        /*echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'subject',
                'label' => 'Email Subject',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Subject'
                ),
            ),
            array(
                'field' => 'note',
                'label' => 'Email Note',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Subject'
                ),
            ),
            array(
                'field' => 'content',
                'label' => 'Email Content',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Content'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Email Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/email_template/edit/' . $this->input->post('id'));
        } else {

            $emailData = array(
                "subject" => $this->input->post('subject'),
                "note" => $this->input->post('note'),
                "content" => $this->input->post('content'),
                "status" => $this->input->post('status'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->emails->editEmail($emailData, $this->input->post('id'));
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Email Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/email_template/lists');
            } else {
                $this->session->set_flashdata('message_notification', 'Email Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/email_template/edit/' . $this->input->post('id'));
            }
        }
    }

    public function check_exist_email_subject() {
        if ($this->input->post('emailType') != '') {
            $email_subject_check = $this->emails->check_exist_email_subject($this->input->post('emailType'));
            if (!empty($email_subject_check)) {
                echo "false";
                exit;
            } else {
                echo "true";
                exit;
            }
        } else {
            echo "false";
            exit;
        }
    }

}

?>
