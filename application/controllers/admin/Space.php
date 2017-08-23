<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Space extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        //$this->load->model(ADMIN_DIR . '/AdminSettings', 'settings');
        $this->load->model(ADMIN_DIR . '/AdminSpace', 'spaceType');
        $this->load->library('form_validation');
    }
     public function index() {
        $data = array();
        $data['module_heading']   = 'Space Type List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/space/space_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function get_all_Space_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $response = $this->spaceType->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->spaceType->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $fc) {
            $no++;
            $possible_status_changes = '';
            $row = array();
            $row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $fc->id . '"/><span></span></label>';
            $row[] = ucfirst($fc->name);
            $row[] = date(DATE_FORMAT, $fc->createdDate);
            $row[] = date(DATE_FORMAT, $fc->updatedDate);
            if ($fc->status == 'active') {
                $row[] = '<button class="btn btn-success">Active</button>';
            } else if ($fc->status == 'inactive') {
                $row[] = '<button class="btn btn-warning">Inactive</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $fc->status . '</button>';
            }
            //add html for action
            $row[] = '<div class="btn-group btn-info">
                        <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                        <i class="fa fa-user"></i> Settings
                        <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                            <a  href="' . base_url(ADMIN_DIR . '/Settings/edit_space/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/Settings/delet_space/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->spaceType->count_all(),
            "recordsFiltered" => $this->spaceType->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }
    // Delete establishment type 
    public function deleteSpace() {
        $array = $this->uri->uri_to_assoc();
        $space = $array['delet_space'];
        $response = $this->spaceType->deleteSpaceType($space);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Space type has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/Settings/spaceList');
        } else {
            $this->session->set_flashdata('message_notification', 'Space type Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/spaceList');
        }
    }
     public function add() {
        $data = array();
        $data['module_heading']   = 'Add New space Type';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/space/space_add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_space(){
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Space Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Space Name',
                    'min_length' => 'Minimum 3 Characters Long Space Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Space Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Space type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/Settings/add_space');
        } else {
            $SpaceData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description')
            );
            $response = $this->spaceType->addSpace($SpaceData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Space Type has ben Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/spaceList');
            } else {
                $this->session->set_flashdata('message_notification', 'Space Type Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/add_space');
            }
        }
    }
    # Update space 
    public function updateSpace() {
        $data = array();
        $data['module_heading'] = 'Edit Space';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $SpaceID = $this->uri->segment('4');
        $data['space'] = $this->spaceType->viewSpace($SpaceID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/space/space_edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function update_Space() {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Space Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Space Name',
                    'min_length' => 'Minimum 3 Characters Long Space Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Space Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Space Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/edit_space/' . $this->input->post('id'));
        } else {

            $establishmentData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description'),
                "id" => $this->input->post('id')
            );
            $response = $this->spaceType->editEstablishment($establishmentData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Space Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/spaceList');
            } else {
                $this->session->set_flashdata('message_notification', 'Space Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/edit_space/' . $this->input->post('id'));
            }
        }
    }
}
