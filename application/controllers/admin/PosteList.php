<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PosteList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->model(ADMIN_DIR . '/AdminMessage', 'message');
        $this->load->model(ADMIN_DIR . '/PostedListing', 'spaceType');
        $this->load->library('form_validation');
    }
     public function index() {
        $data = array();
        $data['module_heading']   = 'Posted listings';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/postedListing/listing', $data);
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
            $row[] = ucfirst($fc->spaceTitle);
            $industry = getSingleRecord('industry','id',$fc->industryType);
            $establishment = getSingleRecord('establishment_types','id',$fc->establishmentType);
            $space = getSingleRecord('space_types','id',$fc->spaceType);
            $row[] = $industry->industry_name.' / '.$establishment->name.' / '.$space->name;
            $row[] = $fc->professionalCapacity." Professionals<br/>".$fc->workSpaceCount." Workspaces";
            $row[] = getCurrency_symbol($fc->currency).$fc->base_price;
            $row[] = date(DATE_FORMAT, $fc->createdDate);
            if ($fc->isFeatured == 'Yes') {
                $row[] = '<button class="btn btn-success">'.$fc->isFeatured.'</button>';
            } else if ($fc->isFeatured == 'No') {
                $row[] = '<button class="btn btn-warning">'.$fc->isFeatured.'</button>';
            }
            if ($fc->status == 'Active') {
                $row[] = '<button class="btn btn-success">Active</button>';
            } else if ($fc->status == 'Deactive') {
                $row[] = '<button class="btn btn-warning">Deactive</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $fc->status . '</button>';
            }
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
    # user convercation message list code start here
    public function messageListing(){
        $data = array();
        $data['module_heading']   = 'Message listing';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/message/message_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function get_all_message_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $response = $this->message->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->message->get_datatables();
        // print_r($list);
        $data = array();
        $no = $_POST['start'];
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $fc) {
            $no++;
            $possible_status_changes = '';
            $row = array();
            $row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $fc->id . '"/><span></span></label>';
            //base_url(ADMIN_DIR . '/PosteList/viewMessage/' . $fc->id)
            $sender   = getSingleRecord('user','id',$fc->sender);
            $receiver = getSingleRecord('user','id',$fc->receiver);
            $row[]  = $sender->firstName.' '.$sender->lastName;
            $row[]  = $receiver->firstName.' '.$receiver->lastName;
            $row[]  = substr($fc->subject,0,20);
            $row[]  = substr($fc->message,0,50).(strlen($fc->message) > 50?' <a href="#">Read More...</a>':'');
            $row[]  = date(DATE_FORMAT, $fc->createdDate);
            if ($fc->status == 'read') {
                $row[] = '<button class="btn btn-info">Read</button>';
            } else if ($fc->status == 'new') {
                $row[] = '<button class="btn btn-warning">new</button>';
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
                            <a  href="#"><i class="fa fa-pencil"></i> View</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/PosteList/deleteMessage/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->message->count_all(),
            "recordsFiltered" => $this->message->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }
     # Update space 
    public function viewMessage() {
        $data = array();
        $data['module_heading'] = 'View Message';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $messageID = $this->uri->segment('4');
        $data['message'] = $this->message->getviewMessage($messageID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/message/view', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    // Delete establishment type 
    public function deleteMessage() {
        $array = $this->uri->uri_to_assoc();
        $getmessage    = $array['deleteMessage'];
        $response = $this->message->deleteMessageValue($getmessage);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Message has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/PosteList/messageListing');
        } else {
            $this->session->set_flashdata('message_notification', 'Message Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/PosteList/messageListing');
        }
    }
}
