<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(FRONT_DIR . '/FrontUser', 'user');
        $this->load->model(FRONT_DIR . '/FrontEmails', 'all_emails');
        $this->load->model(FRONT_DIR . '/FrontSubscriber', 'subscriber');
        // $this->load->library('encrypt');
        $this->load->library('encryption');
    }

    public function ajax_submit_basic() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        if ($this->input->post('col') == 'firstName') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'First Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your First Name'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'lastName') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Last Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your Last Name'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'gender') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Last Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Select Your Gender'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'dobMonth') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'DOB Month',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your DOB Month'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'dobDay') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'DOB Day',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your DOB Day'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'dobYear') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'DOB Year',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your DOB Year'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'phone') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Phone',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter Your Phone Number'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'language') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Preferred Language',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Select Your Preferred Language'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'currency') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Preferred Currency',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Select Your Preferred Currency'
                    ),
                )
            );
        } else if ($this->input->post('col') == 'businessName') {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Business Name',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Enter The Business Name'
                    ),
                )
            );
        } else {
            $config = array(
                array(
                    'field' => 'val',
                    'label' => 'Describe Yourself',
                    'rules' => 'trim',
                    'errors' => array(
                        'trim' => 'Please Enter This Field'
                    ),
                )
            );
        }

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $response['class'] = A_FAIL;
            $response['message'] = validation_errors();
        } else {
            if ($this->input->post('col') == 'languages') {
                $field_value = implode(',', $this->input->post('val'));
            } else {
                $field_value = $this->input->post('val');
            }
            //exit($field_value);
            $userUpdateData = array(
                $this->input->post('col') => $field_value,
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $id = $this->user->editUser($userUpdateData, $this->session->userdata('user_id'));
            if ($id > 0) {

                $response['class'] = A_SUC;
                $response['message'] = 'Your Profile Updated Successfully';
            } else {
                $response['class'] = A_FAIL;
                $response['message'] = 'Your Profile Not Updated Successfully';
            }
        }

        echo json_encode($response);
    }

    public function activation() {
        $last = $this->uri->total_segments();
        $verficationCode = $this->uri->segment($last);
        //$verficationCode = 'dff25d9b99b20dcb440c87f6529461dc';

        $response = $this->user->checkAccount($verficationCode);

        if (!empty($response)) {
            if ($response->status == 'Active') {
                $this->session->set_flashdata('message_notification', 'Your Email Address Is Already Verified');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url());
            } else if ($response->status == 'Pending') {
                $userUpdateData = array(
                    "status" => 'Active',
                    "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address()
                );
                $id = $this->user->editUser($userUpdateData, $response->id);
                if ($id > 0) {
                    $this->session->set_flashdata('message_notification', 'You have successfullu verified your email address.Sign in below');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('message_notification', 'Something Went Wrong, Please Try Again Later');
                    $this->session->set_flashdata('class', A_FAIL);
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('message_notification', 'Your Account is ' . $response->status . ', Please Contact Admin To Active Your Account');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('message_notification', 'Invalid Request, Please Try Again Later');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url());
        }
    }

    function file_upload($filename, $path = 'user/document/', $oldFile = '') {
        $return = array();
        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|pdf';


        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($filename)) {
            $return = array('error' => $this->upload->display_errors());
            return $return;
        } else {
            //Image Upload
            //$upload_data = $this->upload->data();
            if ($oldFile != '') {
                //Unlink old images if have
                @unlink("./uploads/" . $path . "/" . $oldFile);
            }


            $return = array('error' => '', 'file_name' => $this->upload->data('file_name'));
            return $return;
        }
    }

    public function profile() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'My Profile';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/profile', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }
    public function reviews() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading']  = 'Reviews';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/reviews', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function references() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();

        /* echo '<pre>';
          print_r($userProfileInfo);
          exit; */

        $data['module_heading'] = 'References';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/references', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function index() {
        $this->profile();
    }

    public function photo() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();

        $data['module_heading'] = 'My Photo';

        /* echo '<pre>';
          print_r($userProfileInfo);
          exit; */

        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/avatar', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function trust() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();

        $data['module_heading'] = 'Trust and Verification';
        $this->user->createUserDocs($this->session->userdata('user_id'));
        $data['userDocuments'] = $this->user->getUserDocuments($this->session->userdata('user_id'));
        $data['userPhones'] = $this->user->verifiedPhones($this->session->userdata('user_id'), $data['userProfileInfo']->phone);
        //print_array($data['userPhones']);

        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/trust', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }
    
    public function upload_documents() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();

        $data['module_heading'] = 'Establishment License';

        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/upload-documents', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function submit_trust() {
        //print_array($_POST);
        //print_array($_FILES, TRUE);
        
        if (isset($_FILES['establishmentLicence']) && $_FILES['establishmentLicence']['name'] != '') {
            $establishmentLicenceResponse = $this->file_upload('establishmentLicence', 'user/document/', $this->input->post('OldEstablishmentLicence'));
            //print_array($establishmentLicenceResponse, TRUE);
            if ($establishmentLicenceResponse['file_name'] != '') {
                $establishmentLicence = $establishmentLicenceResponse['file_name'];
                $this->user->insertUserDocs($this->session->userdata('user_id'), $establishmentLicence, '1');
            } else {
                $this->session->set_flashdata('message_notification', $establishmentLicenceResponse['error']);
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('user/trust'));
            }
        }else{
            $establishmentLicence = $this->input->post('OldEstablishmentLicence');
        }
        
        if (isset($_FILES['liabilityInsurance']) && $_FILES['liabilityInsurance']['name'] != '') {
            $liabilityInsuranceResponse = $this->file_upload('liabilityInsurance', 'user/document/', $this->input->post('OldLiabilityInsurance'));
            
            if ($liabilityInsuranceResponse['file_name'] != '') {
                $liabilityInsurance = $liabilityInsuranceResponse['file_name'];
                $this->user->insertUserDocs($this->session->userdata('user_id'), $liabilityInsurance, '2');
            } else {
                $this->session->set_flashdata('message_notification', $liabilityInsuranceResponse['error']);
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('user/trust'));
            }
        }else{
            $liabilityInsurance = $this->input->post('OldLiabilityInsurance');
        }

        if (isset($_FILES['licenceCopy']) && $_FILES['licenceCopy']['name'] != '') {
            $licenceCopyResponse = $this->file_upload('licenceCopy', 'user/document/', $this->input->post('OldLicenceCopy'));
            
            if ($licenceCopyResponse['file_name'] != '') {
                $licenceCopy = $licenceCopyResponse['file_name'];
                $this->user->insertUserDocs($this->session->userdata('user_id'), $licenceCopy, '3');
            } else {
                $this->session->set_flashdata('message_notification', $licenceCopyResponse['error']);
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('user/trust'));
            }
        }else{
            $licenceCopy = $this->input->post('OldLicenceCopy');
        }

        /*$settingData = array(            
            "establishmentLicence" => $establishmentLicence,
            "liabilityInsurance" => $liabilityInsurance,
            "licenceCopy" => $licenceCopy,
            "updatedDate" => strtotime(date('Y-m-d H:i:s')),
            "ipAddress" => $this->input->ip_address()
        );
        $response = $this->user->editUser($settingData, $this->session->userdata('user_id'));*/
        
        $this->session->set_flashdata('message_notification', 'Documents Uploaded Successfully');
        $this->session->set_flashdata('class', A_SUC);
        redirect(base_url('user/trust'));
    }

    public function submit_avatar() {

        /* echo '<pre>';
          print_r($_FILES);
          print_r($_POST);
          exit; */

        $file_upload_error = false;
        if ($_FILES['avatar']['name'] != '') {
            $config['upload_path'] = './uploads/user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('avatar')) {
                $file_upload_error = true;
                $file_upload_error_message = '<p>' . $this->upload->display_errors() . '</p>';
            }
            $form_validation_error = false;
        } else {
            $post_config = array(
                array(
                    'field' => 'avatar',
                    'label' => 'Avatar',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Please Uplaod Your Avatar'
                    ),
                )
            );
            $this->form_validation->set_rules($post_config);
            if ($this->form_validation->run() == FALSE) {
                $form_validation_error = true;
            }
            $file_upload_error_message = '';
        }
        if ($form_validation_error == true or ( $file_upload_error == true)) {
            $this->session->set_flashdata('message_notification', validation_errors() . $file_upload_error_message);
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('user/photo'));
        } else {

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
                $image_name = $upload_data['file_name'];
                /*@unlink("./uploads/user/" . $this->input->post('oldAvatar'));
                @unlink("./uploads/user/big/" . $this->input->post('oldAvatar'));
                @unlink("./uploads/user/med/" . $this->input->post('oldAvatar'));
                @unlink("./uploads/user/thumb/" . $this->input->post('oldAvatar'));*/
                //It means you have to unlink the image
            } else {
                $image_name = $this->input->post('oldAvatar');
            }

            $profileData = array(
                "avatar" => $image_name,
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->user->editUser($profileData, $this->session->userdata('user_id'));
            if ($response > 0) {
                // save user previous images
                $userData = array(
                    "user"          => $this->session->userdata('user_id'),
                    "image"         => $image_name,
                    "isProfile"     => "Yes",
                    "createdDate"   => time(),
                    "updatedDate"   => time(),
                    "ipAddress"     => $this->input->ip_address()
                );
                $this->user->insertData($userData,'user_gallery');
                
                $this->session->set_flashdata('message_notification', 'Profile Avatar Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url('/user/photo'));
            } else {
                $this->session->set_flashdata('message_notification', 'Profile Avatar Is Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('/user/photo'));
            }
        }
    }

    public function google_verification() {
        // Include the google api php libraries
        include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

        // Google Project API Credentials
        $clientId = '962031527806-lgqqsh28c4cn3g15c758i7pcasct4g33.apps.googleusercontent.com';
        $clientSecret = '5rrDAy51MKP6M0kYZY86XbZt';
        $redirectUrl = base_url() . 'user/google_verification';

        // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName(SITE_DISPNAME);
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            /* echo '<pre>';
              print_r($userProfile);
              echo $this->session->userdata('user_id');
              exit; */
            $updateData = array(
                "googleVerified" => 'Yes',
                "firstName" => $userProfile['given_name'],
                "lastName" => $userProfile['family_name'],
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address(),
                "googleEmail" => $userProfile['email'],
                "gender" => ucfirst($userProfile['gender'])
            );
            $updateRecord = $this->user->editUser($updateData, $this->session->userdata('user_id'));
            if ($updateRecord > 0) {
                $this->session->set_flashdata('message_notification', 'Your Account Is Verfied With Google And Profile Has Been Updated');
                $this->session->set_flashdata('class', A_SUC);
            } else {
                $this->session->set_flashdata('message_notification', 'Your Account Is Not Verified With Google, Please Try Again Later');
                $this->session->set_flashdata('class', A_FAIL);
            }
        } else {
            $this->session->set_flashdata('message_notification', 'Something Went Wrong, Please Try Again Later In Some Time');
            $this->session->set_flashdata('class', A_FAIL);
        }
        redirect(base_url('user/trust'));
    }

    public function google_login() {
        // Include the google api php libraries
        include_once APPPATH . "libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH . "libraries/google-api-php-client/contrib/Google_Oauth2Service.php";

        // Google Project API Credentials
        $clientId = '962031527806-lgqqsh28c4cn3g15c758i7pcasct4g33.apps.googleusercontent.com';
        $clientSecret = '5rrDAy51MKP6M0kYZY86XbZt';
        $redirectUrl = base_url() . 'user/google_login';

        // Google Client Configuration
        $gClient = new Google_Client();
        $gClient->setApplicationName(SITE_DISPNAME);
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectUrl);
        $google_oauthV2 = new Google_Oauth2Service($gClient);

        if (isset($_REQUEST['code'])) {
            $gClient->authenticate();
            $this->session->set_userdata('token', $gClient->getAccessToken());
            redirect($redirectUrl);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $gClient->setAccessToken($token);
        }

        if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
            // Preparing data for database insertion
            //print_array($userProfile, TRUE);

            $check_user = $this->user->checkUser($userProfile['email']);

            /* echo '<pre>';
              print_r($check_user);
              exit; */
            if (!empty($check_user)) {
                // Already registered with this email address
                $updateData = array(
                    "gender" => ucfirst($userProfile['gender']),
                    "googleVerified" => 'Yes',
                    "firstName" => $userProfile['given_name'],
                    "lastName" => $userProfile['family_name'],
                    "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address(),
                    "status" => 'Active',
                    "googleEmail" => $userProfile['email']
                );
                $updateRecord = $this->user->editUser($updateData, $check_user->id);
                if ($updateRecord > 0) {
                    $this->load->library('user_agent');
                    if ($this->agent->is_browser())
                    {
                        $agent = $this->agent->browser(); //$this->agent->version();
                    }
                    elseif ($this->agent->is_robot())
                    {
                        $agent = $this->agent->robot();
                    }
                    elseif ($this->agent->is_mobile())
                    {
                        $agent = $this->agent->mobile();
                    }
                    else
                    {
                        $agent = 'Unidentified User Agent';
                    }
                    $loginData = array(
                        "userId" => $check_user->id,
                        "loginDate" => strtotime(date('Y-m-d H:i:s')),
                        "device" => $this->agent->platform(),
                        "browser" => $agent,
                        "ipAddress" => $this->input->ip_address(),
                        "location" => get_location_from_ip($this->input->ip_address())
                    );
                    $session_logs = $this->user->loginRecord($loginData);
                    //Insert data in to the Logins table code end
                    // Username and Password is true. So, we get user id in return from the Admin Model
                    $this->session->set_userdata('user_id', $check_user->id);
                    $this->session->set_userdata('session_login_id', $session_logs);
                    $this->session->set_flashdata('message_notification', 'Your Account Is Verfied With Google And Profile Has Been Updated');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(site_url('dashboard'));
                } else {
                    $this->session->set_flashdata('message_notification', 'Something Went Wrong, Please Try Again Later In Some Time');
                    $this->session->set_flashdata('class', A_FAIL);
                    redirect(base_url());
                }
            } else {
                // Register with google
                $this->google_register($userProfile);
                /*$password = $this->randomString();
                $userRegisterData = array(
                    "googleVerified" => 'Yes',
                    "firstName" => $userProfile['given_name'],
                    "lastName" => $userProfile['family_name'],
                    "createdDate" => strtotime(date('Y-m-d H:i:s')),
                    "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address(),
                    "status" => 'Active',
                    "googleEmail" => $userProfile['email'],
                    "email" => $userProfile['email'],
                    "password" => $this->encryption->encrypt($password),
                    "gender" => ucfirst($userProfile['gender'])
                );
                $id = $this->user->addUser($userRegisterData);
                if ($id > 0) {
                    $userName = $userProfile['name'];

                    //Email Should Be Sent
                    $emailTemplate = $this->all_emails->getEmailTemplate('social-register');
                    if (!empty($emailTemplate)) {
                        $siteEmailDetails = $this->all_emails->emailDetails();

                        $emailContent = $emailTemplate->content;
                        $replaceVariables = array("{signature}" => $siteEmailDetails->emailSignature,
                            "{name}" => $userName,
                            "{social}" => 'Google',
                            "{email}" => $userProfile['email'],
                            "{password}" => $password
                        );
                        $subject = $emailTemplate->subject;
                        $from = array('email' => $siteEmailDetails->fromEmail, 'name' => $siteEmailDetails->siteName);
                        $replyEmail = array('email' => $siteEmailDetails->replyEmail, 'name' => $siteEmailDetails->siteName);
                        $to = array('email' => $userProfile['email'], 'name' => $userName);
                        $this->all_emails->sendEmail($subject, $emailContent, $replaceVariables, $to, $from, $replyEmail);
                        //If this email is exist and active then only email should be sent
                    }

                    $this->session->set_flashdata('message_notification', 'Your Registration Has Been Done Successfully');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(base_url());
                } else {
                    $this->session->set_flashdata('message_notification', 'Your Registration Has Not Been Done Successfully');
                    $this->session->set_flashdata('class', A_FAIL);
                    redirect(base_url());
                }*/
            }
        }
    }
    
    private function google_register($googleProfile){
        /*$googleProfile = array
                (
                    'id' => '104386481530242034094',
                    'email' => 'shshnk1408@gmail.com',
                    'verified_email' => 1,
                    'name' => 'Shashank Shekhar',
                    'given_name' => 'Shashank',
                    'family_name' => 'Shekhar',
                    'link' => 'https://plus.google.com/+ShashankShekhar1408',
                    'picture' => 'https://lh6.googleusercontent.com/-sGUwH0RWFy8/AAAAAAAAAAI/AAAAAAAAACk/CDBWb_-9p1U/photo.jpg',
                    'gender' => 'male',
                    'locale' => 'en'
                );*/
        
        //print_array($userProfile);
        $this->session->set_userdata('googleProfile', $googleProfile);
        $this->session->set_flashdata('google_notification', 'Your account information is: ');
        $this->session->set_flashdata('class', A_SUC);
        redirect(base_url());
    } 

    public function submit_register() {
         // echo '<pre>';
         //  print_r($_POST);
         //  exit;
        $config = array(
            array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your First Name'
                ),
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your Last Name'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => array(
                    'required' => 'Please Enter The Banner Link',
                    'valid_email' => 'Please Enter Valid Email Address',
                    'is_unique' => 'This Email Address Is Already Exist, Please Use Another Email Address'
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Password'
                ),
            ),
            array(
                'field' => 'dobMonth',
                'label' => 'DOB Month',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Month'
                ),
            ),
            array(
                'field' => 'dobDay',
                'label' => 'DOB Day',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Day'
                ),
            ),
            array(
                'field' => 'dobYear',
                'label' => 'DOB Year',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Year'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url());
        } else {
            $userRegisterData = $this->input->post();
            
            $userRegisterData['password']            = $this->encryption->encrypt($userRegisterData['password']);
            if(!isset($userRegisterData['googleVerified'])){
                $userRegisterData['verificationCode']    = md5($userRegisterData['email']);
            }            
            $userRegisterData['newsLetter']          = isset($_POST['newsLetter'])?$_POST['newsLetter']:'No';
            $userRegisterData['status']              = isset($_POST['googleVerified'])?'Active':'Pending';
            $userRegisterData['createdDate']         = time();
            $userRegisterData['updatedDate']         = time();
            $userRegisterData['ipAddress']           = $this->input->ip_address();
            if(isset($userRegisterData['picture'])){
                $this->load->library('image_lib');
                $userRegisterData['avatar'] = 'googleAvatar-' . $userRegisterData['googleId']. '.jpg';
                $savePath = './uploads/user/'.$userRegisterData['avatar'];
                save_image($userRegisterData['picture'], $savePath);
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
                        'source_image' => $savePath,
                        'new_image' => './uploads/user/' . $resize[2] . '/' . $userRegisterData['avatar'],
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
            unset($userRegisterData['picture']);unset($userRegisterData['googleId']);
            //print_array($userRegisterData);exit;
            $id = $this->user->addUser($userRegisterData);
            if ($id > 0) {
                $userName = $userRegisterData['firstName'] . ' ' . $userRegisterData['lastName'];
                if ($userRegisterData['newsLetter'] == 'Yes') {
                    // It means user wants to subscribe newsletter
                    $subscriberData = array(
                        "user" => $id,
                        "name" => $userName,
                        "status" => 'Pending',
                        "email" => $this->input->post('email'),
                        "createdDate" => time(),
                        "updatedDate" => time(),
                        "ipAddress" => $this->input->ip_address()
                    );

                    $this->subscriber->addSubscriber($subscriberData);
                }
                
                if(isset($userRegisterData['verificationCode'])){
                    //Email Should Be Sent
                    $emailTemplate = $this->all_emails->getEmailTemplate('user-register');
                    if (!empty($emailTemplate)) {
                        $siteEmailDetails = $this->all_emails->emailDetails();
                        $emailContent = $emailTemplate->content;
                        $replaceVariables = array("{signature}" => $siteEmailDetails->emailSignature,
                            "{name}" => $userName,
                            "{activationLink}" => '<a href="' . base_url('user/activation/' . $userRegisterData['verificationCode']) . '">here</a>'
                        );
                        $subject = $emailTemplate->subject;
                        $from = array('email' => $siteEmailDetails->fromEmail, 'name' => $siteEmailDetails->siteName);
                        $replyEmail = array('email' => $siteEmailDetails->replyEmail, 'name' => $siteEmailDetails->siteName);
                        $to = array('email' => $userRegisterData['email'], 'name' => $userName);

                        $this->all_emails->sendEmail($subject, $emailContent, $replaceVariables, $to, $from, $replyEmail);

                        //If this email is exist and active then only email should be sent
                        $this->session->set_flashdata('message_notification', 'Your registration has been done successfully, please verify your email-address.');
                        $this->session->set_flashdata('class', A_SUC);
                        redirect(base_url());
                    }
                }else{
                    $this->load->library('user_agent');
                    if ($this->agent->is_browser())
                    {
                        $agent = $this->agent->browser(); //$this->agent->version();
                    }
                    elseif ($this->agent->is_robot())
                    {
                        $agent = $this->agent->robot();
                    }
                    elseif ($this->agent->is_mobile())
                    {
                        $agent = $this->agent->mobile();
                    }
                    else
                    {
                        $agent = 'Unidentified User Agent';
                    }
                    $loginData = array(
                        "userId" => $id,
                        "loginDate" => strtotime(date('Y-m-d H:i:s')),
                        "device" => $this->agent->platform(),
                        "browser" => $agent,
                        "ipAddress" => $this->input->ip_address(),
                        "location" => get_location_from_ip($this->input->ip_address())
                    );
                    $session_logs = $this->user->loginRecord($loginData);
                    $this->session->unset_userdata('googleProfile');
                    //Insert data in to the Logins table code end
                    // Username and Password is true. So, we get user id in return from the Admin Model
                    $this->session->set_userdata('user_id', $id);
                    $this->session->set_userdata('session_login_id', $session_logs);
                    redirect(site_url('dashboard'));
                }
            } else {
                $this->session->set_flashdata('message_notification', 'Your Registration Has Not Been Done Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url());
            }
        }
    }
   # add referral amount and user registration
    public function submit_referral_register(){
      // echo '<pre>';
      //     print_r($_POST);
      //     exit;
        $config = array(
            array(
                'field' => 'reg_firstName',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your First Name'
                ),
            ),
            array(
                'field' => 'reg_lastName',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your Last Name'
                ),
            ),
            array(
                'field' => 'reg_email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => array(
                    'required' => 'Please Enter The Banner Link',
                    'valid_email' => 'Please Enter Valid Email Address',
                    'is_unique' => 'This Email Address Is Already Exist, Please Use Another Email Address'
                ),
            ),
            array(
                'field' => 'reg_password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Password'
                ),
            ),
            array(
                'field' => 'reg_dobMonth',
                'label' => 'DOB Month',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Month'
                ),
            ),
            array(
                'field' => 'reg_dobDay',
                'label' => 'DOB Day',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Day'
                ),
            ),
            array(
                'field' => 'reg_dobYear',
                'label' => 'DOB Year',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Year'
                ),
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('referral/'.$this->input->post('referralID')));
        } else {
            $activationLink = md5($this->input->post('reg_email'));
            $newsLetter = isset($_POST['newsLetter'])?$_POST['newsLetter']:'No';
            $pass = $this->input->post('reg_password');
            $userRegisterData = array(
                "firstName" => $this->input->post('reg_firstName'),
                "lastName" => $this->input->post('reg_lastName'),
                "email" => $this->input->post('reg_email'),
                "password" => $this->encryption->encrypt($pass),
                "dobMonth" => $this->input->post('reg_dobMonth'),
                "dobDay" => $this->input->post('reg_dobDay'),
                "dobYear" => $this->input->post('reg_dobYear'),
                "verificationCode" => $activationLink,
                "status" => 'Pending',
                "newsLetter" => $newsLetter,
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "referalAmount" => $this->input->post('joinUserAmount'),
                "ipAddress" => $this->input->ip_address()
            );
            $id = $this->user->addUser($userRegisterData);
            if ($id > 0) {
                $this->user->joinNewAccount($this->input->post('userID'),$id,$this->input->post('userAmount'));
                $userName = $this->input->post('reg_firstName') . ' ' . $this->input->post('reg_lastName');
                if ($newsLetter == 'Yes') {
                    // It means user wants to subscribe newsletter
                    $subscriberData = array(
                        "user" => $id,
                        "name" => $userName,
                        "status" => 'Pending',
                        "email" => $this->input->post('reg_email'),
                        "createdDate" => strtotime(date('Y-m-d H:i:s')),
                        "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                        "ipAddress" => $this->input->ip_address()
                    );

                    $this->subscriber->addSubscriber($subscriberData);
                }

                //Email Should Be Sent
                $emailTemplate = $this->all_emails->getEmailTemplate('user-register');
                if (!empty($emailTemplate)) {
                    $siteEmailDetails = $this->all_emails->emailDetails();
                    $emailContent = $emailTemplate->content;
                    $replaceVariables = array("{signature}" => $siteEmailDetails->emailSignature,
                        "{name}" => $userName,
                        "{activationLink}" => '<a href="' . base_url('user/activation/' . $activationLink) . '">here</a>'
                    );
                    $subject = $emailTemplate->subject;
                    $from = array('email' => $siteEmailDetails->fromEmail, 'name' => $siteEmailDetails->siteName);
                    $replyEmail = array('email' => $siteEmailDetails->replyEmail, 'name' => $siteEmailDetails->siteName);
                    $to = array('email' => $this->input->post('reg_email'), 'name' => $userName);

                    $sendEmail = $this->all_emails->sendEmail($subject, $emailContent, $replaceVariables, $to, $from, $replyEmail);

                    //If this email is exist and active then only email should be sent
                    $this->session->set_flashdata('message_notification', 'Your registration has been done successfully, please verify your email-address.');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(base_url());
                }


            } else {
                $this->session->set_flashdata('message_notification', 'Your Registration Has Not Been Done Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('referral/'.$this->input->post('referralID')));
            }
        }
    }
    public function check_exist_email() {
        if ($this->input->post('reg_email') != '' || $this->input->post('email') != '') {
            $email = (isset($_POST['email']))?$this->input->post('email'):$this->input->post('reg_email');
            if ($this->input->post('id') != '') {
                $id = $this->input->post('id');
            } else {
                $id = 0;
            }
            $email_check = $this->user->check_exist_email($email, $id);
            if (!empty($email_check)) {
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

    public function submit_login() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $this->form_validation->set_rules('login_email', 'Email', 'required', array('required' => 'Please Enter The Email Address'));
        $this->form_validation->set_rules('login_password', 'Password', 'required', array('required' => 'Please Enter The Password'));
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url());
        } else {
            $record = $this->user->doLogin($this->input->post());
            $status = $record->status;
            if (!empty($record)) {

                if ($status == 'Active') {
                    $this->load->library('user_agent');
                    if ($this->agent->is_browser())
                    {
                        $agent = $this->agent->browser(); //$this->agent->version();
                    }
                    elseif ($this->agent->is_robot())
                    {
                        $agent = $this->agent->robot();
                    }
                    elseif ($this->agent->is_mobile())
                    {
                        $agent = $this->agent->mobile();
                    }
                    else
                    {
                        $agent = 'Unidentified User Agent';
                    }

                    $user_id = $record->id;
                    $this->load->helper('popin');
                    //Insert data in to the Logins table code start
                    $loginData = array(
                        "userId" => $user_id,
                        "loginDate" => strtotime(date('Y-m-d H:i:s')),
                        "device" => $this->agent->platform(),
                        "browser" => $agent,//$this->input->user_agent()
                        "ipAddress" => $this->input->ip_address(),
                        "location" => get_location_from_ip($this->input->ip_address())
                    );
                    $session_logs = $this->user->loginRecord($loginData);
                    //Insert data in to the Logins table code end
                    // Username and Password is true. So, we get user id in return from the Admin Model
                    $this->session->set_userdata('user_id', $user_id);
                    $this->session->set_userdata('session_login_id', $session_logs);
                    $this->session->set_flashdata('message_notification', 'You Are Logged In Successfully');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(base_url() . "dashboard");
                } else {

                  $this->session->set_flashdata('message_notification', 'Your account status is ' . strtolower($status) . ', please verify your email-address.<a href="'.base_url('user/resendVerifyEmail').'/'.urlencode($this->input->post('login_email')).'">Click here </a>Resend verification Link');
                  $this->session->set_flashdata('class', A_FAIL);

                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('message_notification', 'Invalid Email or Password');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url());
            }
        }
    }

    public function logout() {
        $affected_rows = $this->user->sessionLogout($this->session->userdata('session_login_id'));
        $this->session->unset_userdata('session_login_id');
        $this->session->unset_userdata('user_id');
        $this->session->set_flashdata('alert_message', 'You have been logged out successfully.');
        $this->session->set_flashdata('class', A_SUC);
        redirect(base_url());
    }

    public function forgot_password() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $this->form_validation->set_rules('forgot_email', 'Email Address', 'required', array('required' => 'Please Enter The Email Address'));
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
        } else {
            // It checks the email address of that username/email enters in forgot password options
            $record = $this->user->checkUser($this->input->post('forgot_email'));
            if (!empty($record)) {

                //Email Should Be Sent
                /* echo '<pre>';
                  print_r($record);
                  exit; */


                $userName = $record->firstName . '&nbsp;' . $record->lastName;
                $emailTemplate = $this->all_emails->getEmailTemplate('forgot-password');
                if (!empty($emailTemplate)) {
                    $siteEmailDetails = $this->all_emails->emailDetails();

                    $emailContent = $emailTemplate->content;
                    $replaceVariables = array("{signature}" => $siteEmailDetails->emailSignature,
                        "{name}" => $userName,
                        "{email}" => $this->input->post('forgot_email'),
                        "{password}" => $this->encryption->decrypt($record->password)
                    );
                    $subject = $emailTemplate->subject;
                    $from = array('email' => $siteEmailDetails->fromEmail, 'name' => $siteEmailDetails->siteName);
                    $replyEmail = array('email' => $siteEmailDetails->replyEmail, 'name' => $siteEmailDetails->siteName);
                    $to = array('email' => $this->input->post('forgot_email'), 'name' => $userName);
                    $sendEmail = $this->all_emails->sendEmail($subject, $emailContent, $replaceVariables, $to, $from, $replyEmail);
                    if ($sendEmail == true) {
                        $this->session->set_flashdata('message_notification', 'Your Login Details Are Sent To Your Email Address');
                        $this->session->set_flashdata('class', A_SUC);
                    } else {
                        $this->session->set_flashdata('message_notification', 'Something Went Wrong, Please Try Again Later In Some Time');
                        $this->session->set_flashdata('class', A_FAIL);
                    }

                    //If this email is exist and active then only email should be sent
                } else {
                    $this->session->set_flashdata('message_notification', 'Something Went Wrong, Please Try Again Later');
                    $this->session->set_flashdata('class', A_FAIL);
                }
            } else {
                $this->session->set_flashdata('message_notification', 'This Email Is Not Registered With ' . SITE_DISPNAME);
                $this->session->set_flashdata('class', A_FAIL);
            }
        }

        redirect(base_url());
    }

    public function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    public function submit_basic() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'firstName',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your First Name'
                ),
            ),
            array(
                'field' => 'lastName',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your Last Name'
                ),
            ),
            array(
                'field' => 'dobMonth',
                'label' => 'DOB Month',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Month'
                ),
            ),
            array(
                'field' => 'dobDay',
                'label' => 'DOB Day',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Day'
                ),
            ),
            array(
                'field' => 'dobYear',
                'label' => 'DOB Year',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your DOB Year'
                ),
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your Phone Number'
                ),
            ),
            array(
                'field' => 'language',
                'label' => 'DOB Year',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select Your Language'
                ),
            ),
            array(
                'field' => 'currency',
                'label' => 'Currency',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select Your Currency'
                ),
            ),
            array(
                'field' => 'businessName',
                'label' => 'Business Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your Business Name'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('user/profile'));
        } else {
            $userUpdateData = array(
                "firstName" => $this->input->post('firstName'),
                "lastName" => $this->input->post('lastName'),
                "dobMonth" => $this->input->post('dobMonth'),
                "dobDay" => $this->input->post('dobDay'),
                "dobYear" => $this->input->post('dobYear'),
                "phone" => $this->input->post('phone'),
                "language" => $this->input->post('language'),
                "currency" => $this->input->post('currency'),
                "businessName" => $this->input->post('businessName'),
                "businessNumber" => $this->input->post('businessNumber'),
                "address" => $this->input->post('address'),
                "aboutYou" => $this->input->post('aboutYou'),
                "schoolInstitution" => $this->input->post('schoolInstitution'),
                "licenceCertificate" => $this->input->post('licenceCertificate'),
                "timeZone" => $this->input->post('timeZone'),
                "languages" => implode(',', $this->input->post('languages')),
                "emergencyContacts" => $this->input->post('emergencyContacts'),
                "shippingAddress" => $this->input->post('shippingAddress'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $id = $this->user->editUser($userUpdateData, $this->session->userdata('user_id'));
            if ($id > 0) {
                $this->session->set_flashdata('message_notification', 'Your Profile Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url('user/profile'));
            } else {
                $this->session->set_flashdata('message_notification', 'Your Profile Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('user/profile'));
            }
        }
    }

    public function cancel_account() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'canCancel',
                'label' => 'Can Cancel',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please confirm you choice to cancel your ' . SITE_DISPNAME . ' account.'
                ),
            )
        );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('user/settings'));
        } else {
            $updateUser = array(
                "status" => 'Cancel',
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->user->editUser($updateUser, $this->session->userdata('user_id'));
            if ($response > 0) {
                $$message = '';
                $getrecord = getSingleRecord('user','id',$this->session->userdata('user_id'));
                $email     = $getrecord->email;
                $subject    = "Popin account has ben Cancelled";
                $message   = "Dear ".$getrecord->firstName."\r\n\n";
                $message  .= "Your popin account has ben Cancelled successfully";
                sendMail($email,$subject,$message);
                $affected_rows = $this->user->sessionLogout($this->session->userdata('session_login_id'));
                $this->session->unset_userdata('session_login_id');
                $this->session->unset_userdata('user_id');

                $this->session->set_flashdata('message_notification', 'Your Account Cancelled Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url(''));
            } else {
                $this->session->set_flashdata('message_notification', 'Your Account Not Cancelled Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('account/settings'));
            }
        }
    }
    # Resend varification email if user not activate account
    public function resendVerifyEmail($email){
      $emailTemplate = $this->all_emails->getEmailTemplate('user-register');
       $getEmailID   = urldecode($email);
      $getData     =  $this->user->getActivateLink($getEmailID);
       $activationLink = $getData['verificationCode'];
       $userName = $getData['firstName'].' '.$getData['lastName'];
      if (!empty($emailTemplate)) {
          $siteEmailDetails = $this->all_emails->emailDetails();
          $emailContent = $emailTemplate->content;
          $replaceVariables = array("{signature}" => $siteEmailDetails->emailSignature,
              "{name}" => $userName,
              "{activationLink}" => '<a href="' . base_url('user/activation/' . $activationLink) . '">here</a>'
          );
          $subject = $emailTemplate->subject;
          $from = array('email' => $siteEmailDetails->fromEmail, 'name' => $siteEmailDetails->siteName);
          $replyEmail = array('email' => $siteEmailDetails->replyEmail, 'name' => $siteEmailDetails->siteName);
          $to = array('email' => $this->input->post('reg_email'), 'name' => $userName);
          $sendEmail = $this->all_emails->sendEmail($subject, $emailContent, $replaceVariables, $to, $from, $replyEmail);
          //If this email is exist and active then only email should be sent
          $this->session->set_flashdata('message_notification', 'Resend Verification email has been sent successfully, please verify your email-address.');
          $this->session->set_flashdata('class', A_SUC);
          redirect(base_url());
      }
    }
    public function ajax_verify_phoneNumber(){
            if (!empty($this->session->userdata('user_id'))) {
                    $phone = $this->input->post('phone');
                    $code  = $this->input->post('code');
                    $number = $code.''.$phone;
                    $this->db->where('id',$this->session->userdata('user_id'));
                    $this->db->update('user',array('phone'=>$code.'-'.$phone));
                    $code  = generate_unique_code();
                    $client = new Twilio\Rest\Client(SID,TOKEN);
                    $client->messages->create(
                    $number,
                    array(
                    'from' => '+13237161344',
                    'body' => "Verification code is ".$code,
                    // 'statusCallback' => "http://requestb.in/1234abcd"
                    )
                   );
                $this->session->set_userdata('code',$code);
                echo 1;
        }
    }
    public function ajax_verifyCode(){
        if (!empty($this->session->userdata('user_id'))) {
             $enterValue = $this->input->post('enterCode');
             if ($this->session->userdata('code') == $enterValue) {
                   $this->db->where('id',$this->session->userdata('user_id'));
                   $this->db->update('user',array('phone_verify'=>'yes'));
                   $this->session->unset_userdata('code');
                   echo '1';
             }else{
                   echo '2';
             }
             
       }
    }
    public function checkSessionVerifyCode(){
        $enterValue = $this->input->post('enterValue');
        if ($enterValue == $this->session->userdata('code')) {
            echo 'true';
        }else{
            echo 'false';
        }
    }
}
