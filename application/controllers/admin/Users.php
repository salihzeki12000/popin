<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->library('form_validation');
        $this->load->model(ADMIN_DIR . '/adminUsers', 'user');
    }

    public function index() {
        $this->lists();
    }

    public function lists() {
        $data = array();
        $data['module_heading'] = 'User Lists';
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/users/list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }

    public function get_all_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $response = $this->user->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $avatar = ($user->avatar != '' && file_exists('uploads/user/thumb/' . $user->avatar)) ? $user->avatar : 'user_pic-225x225.png';
            $row[] = '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="' . $user->id . '"/><span></span></label>';
            $row[] = '<img width="50" height="50" src="' . base_url('uploads/user/thumb/' . $avatar) . '" alt="' . $user->firstName . '&nbsp;' . $user->lastName . '">';
            $row[] = $user->firstName . '&nbsp;' . $user->lastName;
            $row[] = $user->email;
            $row[] = $user->phone;
            $row[] = $user->gender;
            $row[] = date(DATE_FORMAT, $user->createdDate);
            $row[] = date(DATE_FORMAT, $user->updatedDate);
            if ($user->status == 'Pending') {
                $row[] = '<button class="btn btn-default">' . $user->status . '</button>';
            } else if ($user->status == 'Active') {
                $row[] = '<button class="btn btn-success">' . $user->status . '</button>';
            } else if ($user->status == 'DeActive') {
                $row[] = '<button class="btn btn-warning">' . $user->status . '</button>';
            } else {
                $row[] = '<button class="btn btn-danger">' . $user->status . '</button>';
            }
            //add html for action

//            $row[] = '<a class="btn btn-primary" href="javascript:void(0);" title="View Partner" onClick="view_user(' . $user->id . ');"><i class="fa fa-eye"></i> View</a>';
            $row[] = '<a class="btn btn-primary" href="'.site_url('admin/users/edit/'.$user->id).'" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user->count_all(),
            "recordsFiltered" => $this->user->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }

    public function edit($id) {
        if(empty($id)){redirect('admin/users');}
        $data = $this->user->viewUser($id);
        //print_array($data, TRUE);
        $languages = explode(',', $data->languages);

        $all_cards = $this->user->getCards($data->id);

        if ($data->countryResidence != '') {
            $countryRes = $data->countryResidence;
        } else {
            $countryRes = '';
        }
        $all_lang = '';

        foreach ($languages as $lang) {
            $all_lang .= $lang . ',';
        }

        if ($data->establishmentLicence != '') {
            $establishmentLicence = '<a href="' . base_url('uploads/user/document/' . $data->establishmentLicence) . '" class="btn btn-info waves-effect waves-light btn-sm" target="_blank">View</a>';
        
            if ($data->establishmentLicenseVerified == 'No') {
                $establishmentLicence .= '&nbsp;&nbsp;&nbsp;<button class="btn btn-primary waves-effect waves-light btn-sm doc-verification" type="button" data-doc-name="Establishment License" data-doc-type="establishmentLicenseVerified" data-user-id="'.$data->id.'">Click to verify</button>';
            }else{
                $establishmentLicence .= '&nbsp;&nbsp;&nbsp;<span class="label label-success">Verified</span>';
            }
        } else {
            $establishmentLicence = '<span class="label label-danger">No Establishment Licence Uploaded</span>';
        }

        if ($data->liabilityInsurance != '') {
            $liabilityInsurance = '<a href="' . base_url('uploads/user/document/' . $data->liabilityInsurance) . '" class="btn btn-info waves-effect waves-light btn-sm" target="_blank">View</a>';
        
            if ($data->liabilityInsuranceVerified == 'No') {
                $liabilityInsurance .= '&nbsp;&nbsp;&nbsp;<button class="btn btn-primary waves-effect waves-light btn-sm doc-verification" type="button" data-doc-name="Liability Insurance" data-doc-type="liabilityInsuranceVerified" data-user-id="'.$data->id.'">Click to verify</button>';
            }else{
                $liabilityInsurance .= '&nbsp;&nbsp;&nbsp;<span class="label label-success">Verified</span>';
            }
        } else {
            $liabilityInsurance = '<span class="label label-danger">No Liability Insurance Uploaded</span>';
        }

        if ($data->licenceCopy != '') {
            $licenceCopy = '<a href="' . base_url('uploads/user/document/' . $data->licenceCopy) . '" class="btn btn-info waves-effect waves-light btn-sm" target="_blank">View</a>';
            if ($data->licenceCopyVerified == 'No') {
                $licenceCopy .= '&nbsp;&nbsp;&nbsp;<button class="btn btn-primary waves-effect waves-light btn-sm doc-verification" type="button" data-doc-name="License/Certificate Copy" data-doc-type="licenceCopyVerified" data-user-id="'.$data->id.'">Click to verify</button>';
            }else{
                $licenceCopy .= '&nbsp;&nbsp;&nbsp;<span class="label label-success">Verified</span>';
            }
        } else {
            $licenceCopy = '<span class="label label-danger">No Licence Copy Uploaded</span>';
        }

        if ($data->status == 'Pending') {
            $status = '<button class="btn btn-default">' . $data->status . '</button>';
        } else if ($data->status == 'Active') {
            $status = '<button class="btn btn-success">' . $data->status . '</button>';
        } else if ($data->status == 'DeActive') {
            $status = '<button class="btn btn-warning">' . $data->status . '</button>';
        } else {
            $status = '<button class="btn btn-danger">' . $data->status . '</button>';
        }
        
        $avatar = ($data->avatar != '' && file_exists('uploads/user/thumb/' . $data->avatar)) ? $data->avatar : 'user_pic-225x225.png';

        $profileDetail = array(
            'id'=>$data->id,
            'firstName' => $data->firstName,
            'lastName' => $data->lastName,
            'email' => $data->email,
            'gender' => $data->gender,
            'dob' => $data->dobDay . '&nbsp;' . $data->dobMonth . '&nbsp;' . $data->dobYear,
            'dobDay' => $data->dobDay,
            'dobMonth' => $data->dobMonth,
            'dobYear' => $data->dobYear,
            'phone' => $data->phone,
            'language' => $data->language,
            'currency' => $data->currency,
            'address' => $data->address,
            'aboutYou' => $data->aboutYou,
            'businessName' => $data->businessName,
            'businessNumber' => $data->businessNumber,
            'schoolInstitution' => $data->schoolInstitution,
            'licenceCertificate' => $data->licenceCertificate,
            'timeZone' => $data->timeZone,
            'languages' => rtrim($all_lang, ','),
            'emergencyContacts' => $data->emergencyContacts,
            'shippingAddress' => $data->shippingAddress,
            'picture' => $avatar,
            'avatar' => '<img id="userAvatar" width="100" height="100" src="' . base_url('uploads/user/thumb/' . $avatar) . '" alt="' . $data->firstName . '&nbsp;' . $data->lastName . '">',
            'licenceCopy' => $licenceCopy,
            'establishmentLicence' => $establishmentLicence,
            'liabilityInsurance' => $liabilityInsurance,
            'establishmentLicenceNumber' => $data->establishmentLicenceNumber,
            'googleVerified' => $data->googleVerified,
            'googleEmail' => $data->googleEmail,
            'verificationCode' => $data->verificationCode,
            'paypalEmail' => $data->paypalEmail,
            'status' => $status,
            'notificationNumber' => $data->notificationNumber,
            'numberNotification' => $data->numberNotification,
            'rentalUpdates' => $data->rentalUpdates,
            'otherUpdates' => $data->otherUpdates,
            'generalPromotionalEmail' => $data->generalPromotionalEmail,
            'rentalReviewReminders' => $data->rentalReviewReminders,
            'accountActivity' => $data->accountActivity,
            'reciveCalls' => $data->reciveCalls,
            'countryResidence' => $countryRes,
            'cards' => $all_cards
        );

//        echo '<pre>';
//        print_r($profileDetail);
//        exit;

        //echo json_encode($profileDetail);
        $value['module_heading'] = 'Edit User';        
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $value);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar');
        $value['profileDetail'] = $profileDetail;
        $this->load->view(ADMIN_DIR . '/users/edit', $value);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer');
    }
    function verifyDoc(){
        $dbColumn = $this->input->post('column');
        $user = $this->input->post('user');
        $rawData[$dbColumn] = "Yes";
        $this->db->where('id',$user)->update('user', $rawData);
        if ($this->db->affected_rows()) {

            $response['class'] = A_SUC;
            $response['message'] = 'Your Profile Updated Successfully';
        } else {
            $response['class'] = A_FAIL;
            $response['message'] = 'Your Profile Not Updated Successfully';
        }
        echo json_encode($response);
        die();
    }
    function update_profile() {
        $rawData = $this->input->post();
        if(!empty($rawData['languages'])){
            $rawData['languages'] = implode(',', $rawData['languages']);
        }
        $rawData['numberNotification'] = isset($rawData['numberNotification'])?$rawData['numberNotification']:'No';
        $rawData['rentalUpdates'] = isset($rawData['rentalUpdates'])?$rawData['rentalUpdates']:'No';
        $rawData['otherUpdates'] = isset($rawData['otherUpdates'])?$rawData['otherUpdates']:'No';
        $rawData['generalPromotionalEmail'] = isset($rawData['generalPromotionalEmail'])?$rawData['generalPromotionalEmail']:'No';
        $rawData['rentalReviewReminders'] = isset($rawData['rentalReviewReminders'])?$rawData['rentalReviewReminders']:'No';
        $rawData['accountActivity'] = isset($rawData['accountActivity'])?$rawData['accountActivity']:'No';
        $rawData['reciveCalls'] = isset($rawData['reciveCalls'])?$rawData['reciveCalls']:'No';
        
        $user = $rawData['user'];
        if(!empty($user)){
            if ($_FILES['avatar']['name'] != '') {
                $config['upload_path'] = './uploads/user/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('avatar')) {
                    $file_upload_error_message = '<p>' . $this->upload->display_errors() . '</p>';
                    $this->session->set_flashdata('class', 'danger');
                    $this->session->set_flashdata('message_notification', $file_upload_error_message);
                    redirect('admin/users/edit/'.$user);
                }
                if ($_FILES['avatar']['name'] != '') {
                    //Image Upload
                    $upload_data = $this->upload->data();
                    $this->load->library('image_lib');

                    //Thumbnails Size
                    $image_sizes = array(
                        'thumb' => array(150, 100, 'thumb'),
                        'med' => array(300, 300, 'med'),
                        'big' => array(800, 600, 'big')
                    );


                    foreach ($image_sizes as $resize) {

                        //Creating thumbnails code start
                        $config = array(
                            'image_library' => 'gd2',
                            'source_image' => $upload_data['full_path'],
                            'new_image' => './uploads/user/' . $resize[2] . '/' . $upload_data['file_name'],
                            'maintain_ration' => true,
                            'width' => $resize[0],
                            'height' => $resize[1]
                        );

                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();

                        //Creating thumbnails code end
                    }
                }
                if ($upload_data['file_name'] != '') {
                    $rawData['avatar'] = $upload_data['file_name'];
                    /*@unlink("./uploads/user/" . $this->input->post('oldAvatar'));
                    @unlink("./uploads/user/big/" . $this->input->post('oldAvatar'));
                    @unlink("./uploads/user/med/" . $this->input->post('oldAvatar'));
                    @unlink("./uploads/user/thumb/" . $this->input->post('oldAvatar'));*/
                    //It means you have to unlink the image
                }
            }
            unset($rawData['user']);
            
            $this->db->where('id',$user)->update('user', $rawData);
            if($this->db->affected_rows()){
                $this->session->set_flashdata('class', 'success');
                $this->session->set_flashdata('message_notification', 'User profile details updated successfully.');
            }else{
                $this->session->set_flashdata('class', 'info');
                $this->session->set_flashdata('message_notification', 'Nothing updated.');
            }
            redirect('admin/users/edit/'.$user);
        }else{
            $this->session->set_flashdata('class', 'danger');
            $this->session->set_flashdata('message_notification', 'Invalid.');
            redirect('admin/users');
        }
    }
}

?>