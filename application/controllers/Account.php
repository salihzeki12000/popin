<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('PaypalVerification');
        $this->load->model(FRONT_DIR . '/FrontUser', 'user');
        $this->load->model(FRONT_DIR . '/FrontEmails', 'all_emails');
        $this->load->model(FRONT_DIR . '/FrontSubscriber', 'subscriber');
    }

    public function index() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Account Notifications';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/account', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function payment_methods() {
        $userID = $this->session->userdata('user_id'); //current user id
        $data['cardDetails'] = $this->user->cardDetails();
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Payment Methods';
        $data['subscription'] = getSingleRecord('subscription_master', 'code', 'scheduler');
        if(trim($data['userProfileInfo']->currency) != "USD" && !empty($data['subscription'])){
            $finalExchangedAmount = $this->currencyconverter->convert('USD', trim($data['userProfileInfo']->currency), $data['subscription']->amount, true, 1);
        }
        $data['my_subscription'] = getSingleRecord('user_subscriptions', 'user_id', $userID);
        $data['paypalInfo'] = $this->input->post();
        if(!empty($data['paypalInfo'])){
            $isExist = $this->db->get_where('user_subscriptions',array('user_id'=> $userID, 'subscription_code' => $data['paypalInfo']["item_number"]))->num_rows();
            if($isExist == 0){
                $insertData = array(
                    'user_id' => $userID,
                    'subscription_code' => $data['paypalInfo']["item_number"],
                    'subscribed_date' => strtotime($data['paypalInfo']['payment_date']),
                    'subscribed_through' => 'paypal',
                    'subscribed_with' => $data['paypalInfo']["payer_email"]
                );
                $this->db->insert('user_subscriptions', $insertData);
            }            
        }
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/payment_methods', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }
    
    public function buy_subscription() {
        $this->load->library('paypal_lib');
        $userID = $this->session->userdata('user_id'); //current user id
        $rawData = $this->input->post();
        //print_array($rawData, true);
        if (!empty($rawData)) {
            $this->session->set_userdata("subscription_code", $rawData['subscription_code']);            
            $subscription = getSingleRecord('subscription_master', 'code', 'scheduler');
            //Set variables for paypal form
            $returnURL = site_url() . 'account/payment-methods'; //payment success url
            $cancelURL = base_url() . 'account/payment-methods'; //payment cancel url
            $notifyURL = base_url() . 'home/payment_ipn'; //ipn url

            $logo = 'http://www.neurons-it.in/Popin/uploads/site/thumb/logo.png';

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', $rawData['subscription_name']);            
            $this->paypal_lib->add_field('item_number', $rawData['subscription_code']);
            $this->paypal_lib->add_field('custom', json_encode(array('userID'=>$userID, 'payFor' =>'subscription')));
            $this->paypal_lib->add_field('amount', $subscription->amount);
            $this->paypal_lib->image($logo);
            //$this->paypal_lib->add_field('currency_code', $this->session->userdata('checkout_currency'));

            $this->paypal_lib->paypal_auto_form();
        } else {
            echo '<center><h3><strong>Failed</strong></h3><h4>Invalid subscription details.</h4></center>';
            die();
        }
    }

    public function payout_preferences() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading']  = 'Payout Preferences';
        $data['result']          = $this->user->createPaypalPreferenceList($this->session->userdata('user_id'));
        $data['check']          = $this->user->getListPaypal($this->session->userdata('user_id'));
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/payout_preferences', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function transaction_history() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Transaction History';
        $data['histories'] = $this->user->getTransactionsHostory($this->session->userdata('user_id'));
        //print_array($data['histories']);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/transaction_history', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function privacy() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Privacy';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/privacy', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function security() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Security';
        $data['loginHistory'] = $this->user->getLoginHistory($this->session->userdata('user_id'));
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/security', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function connected_apps() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Connected Apps';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/connected_apps', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function settings() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Account Settings';
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/settings', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function badges() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Badges';
        $reviewsList = getMultiRecord('space_ratings','reviewOnId',$data['userProfileInfo']->id);
        $data['Reviews'] = number_format(count($reviewsList));
        //$referenceList = getMultiRecord('join_account_master','provide_link_userID',$data['userProfileInfo']->id);
        //$data['References'] = number_format(count($referenceList));
        $data['References'] = 0;
        $data['Listings'] = $this->user->getData('id, spaceTitle, totalRating', array('host'=>$data['userProfileInfo']->id,'status'=>'Active'), 'spaces');
        //print_array($data['Listings']);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/user/badges', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    public function submit_notifications() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $accountNotificationData = array(
            "notificationNumber" => $this->input->post('notificationNumber'),
            "numberNotification" => $this->input->post('numberNotification'),
            "rentalUpdates" => $this->input->post('rentalUpdates'),
            "otherUpdates" => $this->input->post('otherUpdates'),
            "generalPromotionalEmail" => $this->input->post('generalPromotionalEmail'),
            "rentalReviewReminders" => $this->input->post('rentalReviewReminders'),
            "accountActivity" => $this->input->post('accountActivity'),
            "reciveCalls" => $this->input->post('reciveCalls'),
            "updatedDate" => strtotime(date('Y-m-d H:i:s')),
            "ipAddress" => $this->input->ip_address()
        );
        $response = $this->user->editUser($accountNotificationData, $this->session->userdata('user_id'));

        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Your Account Notifications Updated Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('account'));
        } else {
            $this->session->set_flashdata('message_notification', 'Your Account Notifications Not Updated Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account'));
        }
    }

    public function submit_payment() {
        /* echo '<pre>';
          print_r($_POST);
          print_r($_FILES);
          exit; */
        $config = array(
            array(
                'field' => 'paypalEmail',
                'label' => 'Paypal Email',
                'rules' => 'required|valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid Paypal Email Address'
                ),
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/payment-methods'));
        } else {
            $paymentData = array(
                "paypalEmail" => $this->input->post('paypalEmail'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->user->editUser($paymentData, $this->session->userdata('user_id'));

            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Paypal Email Address Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url('account/payment-methods'));
            } else {
                $this->session->set_flashdata('message_notification', 'Paypal Email Address Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('account/payment-methods'));
            }
        }
    }

    public function submit_security() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $user_id = $this->session->userdata('user_id');
        $config = array(
            array(
                'field' => 'currentPassword',
                'label' => 'Current Password',
                'rules' => 'required|callback_check_password[' . $user_id . ']',
                'errors' => array(
                    'required' => 'Please Enter Your Current Password',
                    'check_password' => 'Please Enter Correct Your Current Password'
                ),
            ),
            array(
                'field' => 'newPassword',
                'label' => 'New Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Your New Password'
                ),
            ),
            array(
                'field' => 'confirmNewPassword',
                'label' => 'Confirm New Password',
                'rules' => 'required|matches[newPassword]',
                'errors' => array(
                    'required' => 'Please Enter Your Confirm New Password',
                    'matches' => 'New Password And Confirm New Password Should Match'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/security'));
        } else {
            $securityData = array(
                "password" => $this->encrypt->encode($this->input->post('newPassword')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );

            $response = $this->user->editUser($securityData, $this->session->userdata('user_id'));
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Password Changed Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url('account/security'));
            } else {
                $this->session->set_flashdata('message_notification', 'Password Not Changed Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('account/security'));
            }
        }
    }

    public function submit_settings() {
        $settingsData = array(
            "countryResidence" => $this->input->post('val'),
            "updatedDate" => strtotime(date('Y-m-d H:i:s')),
            "ipAddress" => $this->input->ip_address()
        );
        $response = $this->user->editUser($settingsData, $this->session->userdata('user_id'));
        if ($response > 0) {
          echo 'true';
            // $this->session->set_flashdata('message_notification', 'Country of residance is updated successfully.');
            // $this->session->set_flashdata('class', A_SUC);
            // redirect(base_url('account/settings'));
        } else {
          echo 'false';
            // $this->session->set_flashdata('message_notification', 'Failed to update Country of Residance.');
            // $this->session->set_flashdata('class', A_FAIL);
            // redirect(base_url('account/settings'));
        }
    }

    public function cancel_account() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $user_id = $this->session->userdata('user_id');

        $config = array(
            array(
                'field' => 'cancel_password',
                'label' => 'Password',
                'rules' => 'required|callback_check_password[' . $user_id . ']',
                'errors' => array(
                    'required' => 'Please Enter Your Password',
                    'check_password' => 'Please Enter Correct Password To Cancel Your Account'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            if ($this->session->userdata('user_id') != '') {
                redirect(base_url('account/settings'));
            } else {
                redirect(base_url('account/security'));
            }
        } else {

            $cancelData = array(
                "status" => 'Cancel',
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "ipAddress" => $this->input->ip_address()
            );
            $queryResponse = $this->user->editUser($cancelData, $this->session->userdata('user_id'));

            if ($queryResponse > 0) {

                $affected_rows = $this->user->sessionLogout($this->session->userdata('session_login_id'));
                $this->session->unset_userdata('session_login_id');
                $this->session->unset_userdata('user_id');


                $this->session->set_flashdata('message_notification', 'Your Account Cancelled Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url(''));
            } else {
                $this->session->set_flashdata('message_notification', 'Your Account Not Cancelled Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                if ($this->session->userdata('user_id') != '') {
                    redirect(base_url('account/settings'));
                } else {
                    redirect(base_url('account/security'));
                }
            }
        }
    }

    public function check_password($field_value) {
        $user = array("id" => $this->session->userdata('user_id'), "password" => $field_value);
        $record = $this->user->checkCurrentPassword($user);

        if (!empty($record)) {
            return true;
        } else {
            return false;
        }
    }

    public function submit_card() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */

        $config = array(
            array(
                'field' => 'cardNumber',
                'label' => 'Card Number',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Card Number'
                ),
            ),
            array(
                'field' => 'expirationMonth',
                'label' => 'Expiration Month',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select Expiration Month'
                ),
            ),
            array(
                'field' => 'expirationYear',
                'label' => 'Expiration Year',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Expiration Year'
                ),
            )
        );

        $card_response = $this->validateCreditcard_number($this->input->post('cardNumber'));
        /* echo '<pre>';
          print_r($card_response);
          exit; */
        if ($card_response['card_type'] == 'Invalid') {
            $cardError = array(
                'field' => 'cardNumber',
                'label' => 'Card Number',
                'rules' => 'callback_check_card_type[' . $card_response['card_type'] . ']',
                'errors' => array(
                    'check_card_type' => 'Please Enter Valid Card Number'
                ),
            );
            array_push($config, $cardError);
        }


        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/payment-methods'));
        } else {
            $cardData = array(
                "cardNumber" => $this->input->post('cardNumber'),
                "expirationMonth" => $this->input->post('expirationMonth'),
                "expirationYear" => $this->input->post('expirationYear'),
                "cardType" => $card_response['card_type'],
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "status" => 'Active',
                "user" => $this->session->userdata('user_id'),
                "ipAddress" => $this->input->ip_address()
            );
            $response = $this->user->addCard($cardData, $this->session->userdata('user_id'));
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Card Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(base_url('account/payment-methods'));
            } else {
                $this->session->set_flashdata('message_notification', 'Card Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('account/payment-methods'));
            }
        }
    }

    public function validateCreditcard_number($cc_num) {
        $credit_card_number = $this->sanitize($cc_num);
        // Get the first digit
        $data = array();
        $firstnumber = substr($credit_card_number, 0, 1);
        // Make sure it is the correct amount of digits. Account for dashes being present.
        switch ($firstnumber) {
            case 3:
                $data['card_type'] = "American Express";
                if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $credit_card_number)) {
                    //return 'This is not a valid American Express card number';
                    $data['status'] = 'false';
                    return $data;
                }
                break;
            case 4:
                $data['card_type'] = "Visa";
                if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return 'This is not a valid Visa card number';
                    $data['status'] = 'false';
                    return $data;
                }
                break;
            case 5:
                $data['card_type'] = "MasterCard";
                if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return 'This is not a valid MasterCard card number';
                    $data['status'] = 'false';
                    return $data;
                }
                break;
            case 6:
                $data['card_type'] = "Discover";
                if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number)) {
                    //return 'This is not a valid Discover card number';
                    $data['status'] = 'false';
                    return $data;
                }
                break;
            default:
                //return 'This is not a valid credit card number';
                $data['card_type'] = "Invalid";
                $data['status'] = 'false';
                return $data;
        }
        // Here's where we use the Luhn Algorithm
        $credit_card_number = str_replace('-', '', $credit_card_number);
        $map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
        $sum = 0;
        $last = strlen($credit_card_number) - 1;
        for ($i = 0; $i <= $last; $i++) {
            $sum += $map[$credit_card_number[$last - $i] + ($i & 1) * 10];
        }
        if ($sum % 10 != 0) {
            //return 'This is not a valid credit card number';
            $data['status'] = 'false';
            return $data;
        }
        // If we made it this far the credit card number is in a valid format
        $data['status'] = 'true';
        return $data;
    }

    function sanitize($value) {
        return trim(strip_tags($value));
    }

    public function check_card_type($string, $valid) {
        if ($valid == 'Invalid') {
            return false;
        } else {
            return true;
        }
    }

    public function set_default() {
        $last = $this->uri->total_segments();
        $card_id = $this->uri->segment($last);
        $response = $this->user->setDefault($card_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Your Card Set Default Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('account/payment-methods'));
        } else {
            $this->session->set_flashdata('message_notification', 'Your Card Not Set Default Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/payment-methods'));
        }
    }
    
    public function set_default_document() {
        $last = $this->uri->total_segments();
        $doc_id = $this->uri->segment($last);
        $user_id = $this->session->userdata('user_id');
        $response = $this->user->setDefaultDoc($user_id, $doc_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Your Document Set Default Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('user/trust'));
        } else {
            $this->session->set_flashdata('message_notification', 'Your Document Not Set Default Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('user/trust'));
        }
    }

    public function remove_card() {
        $last = $this->uri->total_segments();
        $card_id = $this->uri->segment($last);
        $response = $this->user->removeCard($card_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Card Removed Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('account/payment-methods'));
        } else {
            $this->session->set_flashdata('message_notification', 'Card Not Removed Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/payment-methods'));
        }
    }
    
    public function remove_document() {
        $last = $this->uri->total_segments();
        $doc_id = $this->uri->segment($last);
        $user_id = $this->session->userdata('user_id');
        $response = $this->user->removeDoc($user_id, $doc_id);
        if ($response > 0) {
            $docInfo = $this->db->get_where('user_documents', array('user' => $user_id, 'id' => $doc_id))->row_array();
            @unlink("./uploads/user/document/" . $docInfo['doc_name']);
            if($docInfo['doc_type'] == '3'){
                $this->db->where('user', $user_id);
                $this->db->where('id', $docInfo['id']);
                $this->db->delete('user_documents');
            }
            $this->session->set_flashdata('message_notification', 'Document Removed Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('user/trust'));
        } else {
            $this->session->set_flashdata('message_notification', 'Document Not Removed Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('user/trust'));
        }
    }

    function logout_user_log() {
        $id = $this->input->post('log_id');

        $logData = array(
            "logoutDate" => strtotime(date('Y-m-d H:i:s')),
            "ipAddress" => $this->input->ip_address()
        );
        $this->db->where('id', $id);
        $this->db->update('login_logs', $logData);
        if($this->db->affected_rows()){
            echo 1;
        }else{
            echo 0;
        }
        die();
    }

    function submit_gift_card() {
        $cardCode   = $this->input->post('giftCardCode');
        $giftBal    = $this->input->post('giftCardBalance');
        if (empty($cardCode)) {
            $this->session->set_flashdata('message_notification', 'You have entered an invalid code.');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url('account/payment-methods'));
        }else{
            $this->db->where_not_in('status', array('inactive','used'));
            $cardQuery = $this->db->get_where('gift_card_codes', array('code' => $cardCode));
            if($cardQuery->num_rows() == 0){
                $this->session->set_flashdata('message_notification', 'You have entered an invalid code.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(base_url('account/payment-methods'));
            }else{
                $cardData = $cardQuery->row_array();

                $user_id = $this->session->userdata('user_id');
                $data = array(
                    "giftCardBalance" => $giftBal + $cardData['amount'],
                    "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address()
                );
                $response = $this->user->editUser($data, $user_id);
                if($response){
                    $this->db->update('gift_card_codes', array('status' => 'used'), array('code' => $cardCode));
                }
            }
            $this->session->set_flashdata('message_notification', 'Gift Card code applied successfully.');
            $this->session->set_flashdata('class', A_SUC);
            redirect(base_url('account/payment-methods'));
        }

    }
    public function checkPaypal_Preferences(){
         $data = $this->input->post();
         $user_id = $this->session->userdata('user_id');
         $check   = $this->paypalverification->paypal($data['firstName'],$data['lastName'],$data['email']);
         if ($check->responseEnvelope->ack == 'Failure') {
            echo $check->error[0]->message.'||'.$check->responseEnvelope->ack;
         }else{
             $this->user->addPaypalPreferences($check,$user_id);
             $list = $this->user->createPaypalPreferenceList($user_id);
             echo $check->accountStatus.'||'.$check->responseEnvelope->ack.'||'.$list;
         }
    }
    public function addBank_details(){
        $data = $this->input->post();
        $user_id = $this->session->userdata('user_id');
        $check = $this->user->banakDetailsAdd($user_id,$data);
        if ($check > 0) {
            echo $list = $this->user->createPaypalPreferenceList($user_id);
        }else{
            echo '1';
        }
    }
}
