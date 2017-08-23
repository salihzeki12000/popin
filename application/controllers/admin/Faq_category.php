<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq_category extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/AdminFaqCategory', 'faq_category');
    }

    public function check_exist_name() {

        if ($this->input->post('name') != '') {
            if ($this->input->post('faq_category_id') != '') {
                $faq_category_id = $this->input->post('faq_category_id');
            } else {
                $faq_category_id = 0;
            }
            $name_check = $this->faq_category->check_exist_name($this->input->post('name'), $faq_category_id);
            if (!empty($name_check)) {
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

    public function lists() {
        $data = array();
        $data['module_heading'] = 'FAQ Category List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . FAQ_CAT . '/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function add() {
        $data = array();
        $data['module_heading'] = 'Add FAQ Category';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . FAQ_CAT . '/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function edit() {
        $data = array();
        $data['module_heading'] = 'Edit FAQ Category';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $faq_category_id = $this->uri->segment('4');
        $data['faq_category_detail'] = $this->faq_category->viewCategory($faq_category_id);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . FAQ_CAT . '/edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $response = $this->faq_category->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->faq_category->get_datatables();
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
            if ($fc->status == 'Active') {
                $row[] = '<button class="btn btn-success">' . $fc->status . '</button>';
            } else if ($fc->status == 'DeActive') {
                $row[] = '<button class="btn btn-warning">' . $fc->status . '</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $fc->status . '</button>';
            }
            //add html for action

            $row[] = '<div class="btn-group btn-info">
                                                                                    <a data-toggle="dropdown" href="javascript:;" class="btn purple" aria-expanded="true">
                                                                                        <i class="fa fa-user"></i> Settings
                                                                                        <i class="fa fa-angle-down"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        <li>
                                                                                            <a  href="' . base_url(ADMIN_DIR . '/faq_category/edit/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a  href="' . base_url(ADMIN_DIR . '/faq_category/delete/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->faq_category->count_all(),
            "recordsFiltered" => $this->faq_category->count_filtered(),
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
        $category_id = $array['delete'];
        $response = $this->faq_category->deleteFAQCategory($category_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'FAQ Category Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/faq_category/lists');
        } else {
            $this->session->set_flashdata('message_notification', 'FAQ Category Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/faq_category/lists');
        }
    }

    public function add_category() {
        /* echo '<pre>';
          print_r($_POST);
          print_r($_FILES);
          exit; */

        $config = array(
            array(
                'field' => 'name',
                'label' => 'Category Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Category Name',
                    'min_length' => 'Minimum 3 Characters Long Category Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Category Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The FAQ Category Status'
                ),
            )
        );

        $this->form_validation->set_rules($config);


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/faq_category/add');
        } else {
            $categoryData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->faq_category->addCategory($categoryData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'FAQ Category Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/faq_category/lists');
            } else {
                $this->session->set_flashdata('message_notification', 'FAQ Category Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/faq_category/add');
            }
        }
    }

    public function update_category() {

        /* echo '<pre>';
          print_r($_POST);
          print_r($_FILES);
          exit; */
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Category Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Category Name',
                    'min_length' => 'Minimum 3 Characters Long Category Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Category Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The FAQ Category Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/faq_category/edit/' . $this->input->post('id'));
        } else {

            $categoryData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address(),
                "id" => $this->input->post('id')
            );
            $response = $this->faq_category->editCategory($categoryData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'FAQ Category Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/faq_category/lists/');
            } else {
                $this->session->set_flashdata('message_notification', 'FAQ Category Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/faq_category/edit/' . $this->input->post('id'));
            }
        }
    }

}

?>
