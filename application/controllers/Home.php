<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(FRONT_DIR . '/FrontUser', 'user');
        $this->load->model(FRONT_DIR . '/FrontSpace', 'space');
        $this->load->helper('popin');
        $this->load->library('paypal_lib');
    }

    public function index() {
        if ($this->session->userdata('user_id') != '') {
            $data['userProfileInfo'] = $this->user->userProfileInfo();
        } else {
            $data = array();
        }
        $data['industries'] = $this->space->getDropdownData('industry');
        $data['featuredSpaces'] = $this->space->getFeaturedSpaces();
//        echo $this->db->last_query();
//        print_array($data['featuredSpaces']);
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-header', $data);
        $this->load->view(FRONT_DIR . '/home', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-footer');
    }
    
    public function workshops() {
        if ($this->session->userdata('user_id') != '') {
            $data['userProfileInfo'] = $this->user->userProfileInfo();
        } else {
            $data = array();
        }
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-header', $data);
        $this->load->view(FRONT_DIR . '/workshops', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-footer');
    }
    
    public function remove_all_filters(){
        $this->session->unset_userdata('filters');
        redirect('spaces');
    }

    public function spaces() {
        $this->load->library('pagination');
        $currentUser = '';
        if ($this->session->userdata('user_id') != '') {
            $data['userProfileInfo'] = $this->user->userProfileInfo();
            $currentUser = $this->session->userdata('user_id');
        } else {
            $data = array();
        }
        $requestedFilters = $this->input->post();
        if($this->session->has_userdata('filters')){
            if(!empty($requestedFilters)){
                $this->session->set_userdata('filters', $requestedFilters);
            }
        }else{
            $this->session->set_userdata('filters', $requestedFilters);
        }
        $filters = $this->session->userdata('filters');
        /* PAGINATION */
        $config = array();
        $config['base_url'] = site_url('spaces');
        $data['total_rows'] = $config['total_rows'] = $this->space->getActiveListingsCount($currentUser, $filters);
        $config['per_page'] = 30;
        $config['uri_segment'] = $this->input->get('per_page');
        //$choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = 3;
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '⟨';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '⟩';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = '&lt;&lt;';
        $config['last_link'] = '&gt;&gt;';


        $this->pagination->initialize($config);

        $page = ($config['uri_segment']) ? $config['uri_segment'] : 0;
        
        //print_array($filters);
        $data['space_types'] = $this->space->getDropdownData('space_types');
        $data['listings'] = $this->space->getActiveListings($currentUser, $filters, $config['per_page'], $page);
        //print_array($data['listings']);
        $data["links"] = $this->pagination->create_links();
        $data['start_page'] = $page + 1;
        if(empty($filters)){
            $data['per_page'] = $page + $config['per_page'];
        }elseif(!empty($filters) && count($data['listings']) <= $config['per_page']){
            $data['per_page'] = $page + $config['per_page'];
        }else{
            $data['per_page'] = count($data['listings']);
        }
        
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-header', $data);
        $this->load->view(FRONT_DIR . '/spaces', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-footer');
    }

    public function rooms($space_id = '') {
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $this->load->helper('inflector');
        $currentUser = '';
        if ($this->session->userdata('user_id') != NULL) {
            $data['userProfileInfo'] = $this->user->userProfileInfo();
            $currentUser = $this->session->userdata('user_id');
        }
        if (!empty($space_id)) {
            //$host_id = $this->session->userdata('user_id');
            $data['preview'] = $this->space->get_space_preview_data($space_id, $host_id = '');
            if (empty($data['preview']) || $data['preview']['host'] == $currentUser) {
                redirect('spaces');
            }
            $data['businessHours'] = json_encode($this->space->getSpaceSettings($space_id));
            $data['hostProfileInfo'] = $this->space->hostProfileInfo($data['preview']['host']);
            $data['wishlistMaster'] = $this->user->getWishLists($currentUser);
            $industry = $data['preview']['industryTypeId'];
            $establishment = $data['preview']['establishmentTypeId'];
            $data['amenities'] = $this->space->collectAmenities($industry, $establishment);
            $data['facilities'] = $this->space->getDropdownData('facilities');
            $data['cancellation_policies'] = $this->space->getDropdownData('cancellation_policies_master');
            $data['reviewsList'] = getMultiRecord('space_ratings','space',$space_id);
            
            $host_id = $this->session->userdata('user_id');
            $filters = array(
                'spaces.id !=' => $space_id,
                'spaces.host !=' => $host_id,
                'spaces.industryType' => $industry,
                'spaces.establishmentType' => $establishment,
                'spaces.status' => 'Active'
            );
            
            $data['similarListings'] = $this->space->getSimilarListings($filters);
            if ($this->session->has_userdata('user_id')){
                $userAddressBook = getMultiRecord('address_book', 'userID', $this->session->userdata('user_id'));
                foreach ($userAddressBook as $address) {
                    $data['addressBook'][] = $address['addUserID']; 
                }
                //print_array($data['addressBook']);
            }
            //print_array($data['preview']);
        }
        $data['search_nav'] = 1;
        $data['space_id'] = $space_id;
        $data['space_types'] = $this->space->getDropdownData('space_types');
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-header', $data);
        $this->load->view(FRONT_DIR . '/booking_management/booking', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/homepage-footer');
    }

    function send_message_submit() {
        $spaceId = $this->input->post('space');
        $hostId = $this->input->post('host');
        $guestId = $this->session->userdata('user_id');
        $checkIn = $this->input->post('checkIn');
        $checkOut = $this->input->post('checkOut');
        $professionals = $this->input->post('professionals');
        $message = $this->input->post('message');

        $messageBody = "<b>Check In: </b>{$checkIn}<br/><b>Check Out: </b>{$checkOut}<br/><br/>";
        $messageBody .= "<b>Number of professionals: </b>{$professionals}<br/><br/>";
        $messageBody .= nl2br($message);

        $rawData = array(
            'space_id' => $spaceId,
            'sender' => $guestId,
            'receiver' => $hostId,
            'message' => $messageBody,
            'status' => 'pending'
        );
        $rawData['createdDate'] = strtotime(date('Y-m-d H:i:s'));
        $rawData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
        $rawData['ipAddress'] = $this->input->ip_address();

        $response = $this->user->create_conversation($rawData);
        if ($response) {
            $result['success'] = TRUE;
            $result['message'] = 'Message sent successfully.';
        } else {
            $result['success'] = FALSE;
            $result['message'] = 'Message sending failed.';
        }
        echo json_encode($result);
        die();
    }

    function get_booking_info() {
        $rawData = $this->input->post();
        //echo date("H:i:s", strtotime($rawData['checkOutTime']));
        //print_array($rawData);
        $spaceData = $this->db->select('monFrom,monTo,tueFrom,tueTo,wedFrom,wedTo,thuFrom,thuTo,friFrom,friTo,satFrom,satTo,sunFrom,sunTo,minStay,minStayType,maxStay,maxStayType,base_price,currency,cleaningFee,daily_discount,weekly_discount')->get_where('spaces', array('id' => $rawData['space']))->row_array();

        // Start date & time
        $popin_date = DateTime::createFromFormat('m-d-Y', $rawData['checkIn']);
        $popin_time = date("H:i:s", strtotime($rawData['checkInTime']));
        // End date & time
        $popout_date = DateTime::createFromFormat('m-d-Y', $rawData['checkOut']);
        $popout_time = date("H:i:s", strtotime($rawData['checkOutTime']));

        $checkIn = strtotime($popin_date->format('Y-m-d'));
        $checkOut = strtotime($popout_date->format('Y-m-d'));
        
        // Calculate day difference
        $date1 = date_create(date("Y-m-d", $checkIn));
        $date2 = date_create(date("Y-m-d", $checkOut));
        $diff = date_diff($date1, $date2);
        $days = $diff->format("%a");
        
        // Calculate hour difference
        $datetime1 = new DateTime(date('Y-m-d H:i:s', strtotime($popin_time)));
        $datetime2 = new DateTime(date('Y-m-d H:i:s', strtotime($popout_time)));
        $oDiff = $datetime1->diff($datetime2);
        $dayHours = $oDiff->h;
        
        // Calculate business hours
        $checkInDay = strtolower(date("D", $checkIn));                
        $fromTime = $spaceData[$checkInDay.'From'];
        $toTime = $spaceData[$checkInDay.'To'];
        $businessHours = $toTime - $fromTime;

        $currencySymbol = getCurrency_symbol($spaceData['currency']);
        $basePrice = $spaceData['base_price'];
        $totalBasePrice = 0;
        
        //$checkInOut = unserialize(TIMES);
        
        if ($days > 0) {
            $tooltip = '<table class="table" style="margin-bottom: 0px;">
                                <thead><th colspan="2">Base Price Breakdown</th></thead>
                                <tbody>';
            while ($checkIn < $checkOut) {
                $dayPrice = $basePrice * $dayHours;
                // Apply Daily discount
                if ($days > 0 && $days < 7 && $spaceData['daily_discount'] > 0 && $businessHours == $dayHours) {
                    $dayPrice = $dayPrice - round($dayPrice * $spaceData['daily_discount'] / 100, 2);
                }
                $totalBasePrice += $dayPrice;
                $tooltip .= '<tr><td>' . date("m-d-Y", $checkIn) . ' ('.$dayHours.' hours)</td><td>' . $currencySymbol . $dayPrice . '</td></tr>';
                $checkIn = strtotime("+1 day", $checkIn);
            }
            // Apply Weekly discount
            if($days>=7 && $spaceData['weekly_discount']>0){
                $weekCount = $days/7;
                $totalBasePrice = $totalBasePrice - round($totalBasePrice * ($spaceData['daily_discount'] * $weekCount) / 100, 2);
            }
            
            $tooltip .= '<tr><th>Total Base Price</th><th>' . $currencySymbol . $totalBasePrice . '</th></tr>';
            $tooltip .= '</tbody>
                        </table>';
            
            $numberBooking = $days;
            $bookingType = "days";
            
            $priceBreakDown = $currencySymbol . $basePrice . ' x ' . $numberBooking . ' ' . $bookingType . ' ('.($numberBooking * $dayHours).' hours)';
            
        } else {
            $tooltip = '<table class="table" style="margin-bottom: 0px;">
                                <thead><th colspan="2">Base Price Breakdown</th></thead>
                                <tbody>';

            $dayPrice = $basePrice * $dayHours;
            
            $tooltip .= '<tr><td>' . date("m-d-Y", $checkIn) . ' ('.$dayHours.' hours)</td><td>' . $currencySymbol . $dayPrice . '</td></tr>';

            $tooltip .= '<tr><th>Total Base Price</th><th>' . $currencySymbol . $dayPrice . '</th></tr>';
            $tooltip .= '</tbody>
                        </table>';
            
            $numberBooking = $dayHours;
            $bookingType = "hours";
            $totalBasePrice = $dayPrice;
            
            $priceBreakDown = $currencySymbol . $basePrice . ' x ' . $numberBooking . ' ' . $bookingType;
        }
        
        // Add service charges
        $settings = getSingleRecord('settings', 'id', '1');
        $serviceCharges = 0;
        if ($settings->serviceFee > 0) {
            $serviceCharges = round($totalBasePrice * $settings->serviceFee / 100, 2);
        }
        // Additional costs (Service charge + Cleaning Fee)
        $additionalCosts = $serviceCharges;
        if ($spaceData['cleaningFee'] > 0) {
            $additionalCosts += $spaceData['cleaningFee'];
        }
        // Calculate Final price
        $finalAmount = $totalBasePrice + $additionalCosts;

        $response = '<tr>
                        <td>' . $priceBreakDown .
                ' <i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-container="body" data-placement="top" data-content=\'' . $tooltip . '\' data-html="true"></i></td>
                        <td align="right">' . $currencySymbol . $totalBasePrice . '</td>
                    </tr>';
        if ($days > 0 && $days < 7 && $spaceData['daily_discount'] > 0 && $businessHours == $dayHours) {
            $response .= '<tr>
                        <td>Daily discount of ' . $spaceData['daily_discount'] . '% is applied.</td>
                        <td></td>
                    </tr>';
        }elseif($days>=7 && $spaceData['weekly_discount']>0){
            $response .= '<tr>
                        <td>Weekly discount of ' . $spaceData['weekly_discount'] . '% is applied.</td>
                        <td></td>
                    </tr>';
        }
        if ($spaceData['cleaningFee'] > 0) {
            $response .= '<tr>
                        <td>Cleaning fee </td>
                        <td align="right">' . $currencySymbol . $spaceData['cleaningFee'] . '</td>
                    </tr>';
        }
        $response .= '<tr>
                        <td>Service fee <i class="fa fa-question-circle" data-toggle="popover" data-trigger="hover" data-container="body" data-placement="top" data-content="This help us run our platform and offer services like 24/7 support on your trip."></i></td>
                        <td align="right">' . $currencySymbol . $serviceCharges . '</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td align="right"><strong>' . $currencySymbol . $finalAmount . '</strong></td>
                    </tr>
                    <input type="hidden" name="currency" value="' . $spaceData['currency'] . '"><input type="hidden" name="basePrice" value="' . $basePrice . '">'
                . '<input type="hidden" name="totalBasePrice" value="' . $totalBasePrice . '">'
                . '<input type="hidden" name="addtionalCosts" value="' . $additionalCosts . '"><input type="hidden" name="totalAmount" value="' . $finalAmount . '">'
                . '<input type="hidden" name="bookingType" value="' . $bookingType . '"><input type="hidden" name="numberBooking" value="' . $numberBooking . '">';
        echo $response;
        die();
    }

    public function request_to_book() {
        $this->session->unset_userdata('checkout_amount');
        $rawData = $this->input->post();
        if (empty($rawData)) {
            redirect('spaces');
        }
        $userID = $this->session->userdata('user_id'); //current user id
        // Start date
        $popin_date = DateTime::createFromFormat('m-d-Y', $rawData['checkIn']);
        // End date
        $popout_date = DateTime::createFromFormat('m-d-Y', $rawData['checkOut']);

        $rawData['checkIn'] = $popin_date->format('Y-m-d');
        $rawData['checkInTime'] = date("H:i:s", strtotime($rawData['checkInTime']));
        
        $rawData['checkOut'] = $popout_date->format('Y-m-d');
        $rawData['checkOutTime'] = date("H:i:s", strtotime($rawData['checkOutTime']));
        
        $data['booking'] = $rawData;
        $data['spaceInfo'] = $this->user->spaceInfo($rawData['space']);
        $data['spaceGallery'] = $this->user->getSpaceGallery($rawData['space']);
        $data['userInfo'] = $this->user->userInfo($userID);
        $data['hostInfo'] = $this->user->userInfo($data['spaceInfo']['host']);
        $data['cancellation_policies'] = $this->space->getDropdownData('cancellation_policies_master');
        //print_array($data['spaceInfo'], TRUE);
        $this->load->view(FRONT_DIR . '/booking_management/booking_summary', $data);
    }
    
    public function applyPromoCode() {
        $checkout_amount = $this->session->userdata('checkout_amount');
        $promo_code = $this->input->post('promo_code');
        $promoCode = $this->db->select('value')->get_where('promo_codes', array('code' => $promo_code, 'status' => 'Active'))->row_array();
        if(empty($promoCode)){
            $response['code'] = 0;
            $response['success'] = 'danger';
            $response['message'] = "Invalid Promo Code.";
        }else{
            if($promoCode['value']){
                $discount = $promoCode['value'];
                $checkout_amount = $checkout_amount - round($checkout_amount * $discount / 100, 1);
                $this->session->set_userdata('checkout_amount',$checkout_amount);
                
                $response['code'] = 1;
                $response['success'] = 'success';
                $response['message'] = "Promo Code applied.";
                $response['discount'] = $discount."% off";
                $response['new_amount'] = "$".$checkout_amount."<sup>USD</sup>";
            }else{
                $response['code'] = 0;
                $response['success'] = 'danger';
                $response['message'] = "Invalid Promo Code.";
            }            
        }
        echo json_encode($response);
        die();
    }

    public function book_space() {
        $userID = $this->session->userdata('user_id'); //current user id
        $rawData = $this->input->post();
        //print_array($rawData);
        $spaceId = $rawData['space'];
        $spaceData = $this->db->select('host,spaceTitle,rentalRequests')->get_where('spaces', array('id' => $spaceId))->row_array();
            
        $rawData['user'] = $userID;
        if($spaceData['rentalRequests'] == 'No'){
            $rawData['partnerStatus'] = 'Accepted';
        }
        $rawData['checkIn'] = date("Y-m-d", strtotime($this->input->post('checkIn')));
        $rawData['checkOut'] = date("Y-m-d", strtotime($this->input->post('checkOut')));
        $rawData['createdDate'] = strtotime(date('Y-m-d H:i:s'));
        $rawData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
        $rawData['ipAddress'] = $this->input->ip_address();
        $bookingId = $this->space->insertBooking($rawData);
        
        if (!empty($bookingId)) {
            $this->session->set_userdata("bookingId", $bookingId);
            // Send message to the partner
            $checkIn = date("m-d-Y", strtotime($this->input->post('checkIn')));
            $checkOut = date("m-d-Y", strtotime($this->input->post('checkOut')));
            $professionals = $this->input->post('professionals');
            $message = $this->input->post('professionalNote');

            $messageBody = "<b>Check In: </b>{$checkIn}<br/><b>Check Out: </b>{$checkOut}<br/><br/>";
            $messageBody .= "<b>Number of professionals: </b>{$professionals}<br/><br/>";
            $messageBody .= nl2br($message);

            $rawData = array(
                'booking' => $bookingId,
                'space_id' => $spaceId,
                'sender' => $userID,
                'receiver' => $spaceData['host'],
                'subject' => 'A new space rental request created.',
                'message' => $messageBody
            );
            $rawData['createdDate'] = strtotime(date('Y-m-d H:i:s'));
            $rawData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
            $rawData['ipAddress'] = $this->input->ip_address();

            $this->user->create_conversation($rawData);

            //Set variables for paypal form
            $returnURL = site_url() . 'home/payment_success'; //payment success url
            $cancelURL = base_url() . 'home/payment_cancel'; //payment cancel url
            $notifyURL = base_url() . 'home/payment_ipn'; //ipn url

            $logo = 'http://www.neurons-it.in/Popin/uploads/site/thumb/logo.png';

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', $spaceData['spaceTitle']);
            $this->paypal_lib->add_field('custom', json_encode(array('userID'=>$userID, 'payFor' =>'rental')));
            $this->paypal_lib->add_field('item_number', $bookingId);
            $this->paypal_lib->add_field('amount', $this->session->userdata('checkout_amount'));
            $this->paypal_lib->image($logo);
            //$this->paypal_lib->add_field('currency_code', $this->session->userdata('checkout_currency'));

            $this->paypal_lib->paypal_auto_form();
        } else {
            $data['title'] = "Booking Failed";
            $data['message'] = "Your booking for this listing is failed due to some error.";
            //pass the transaction data to view
            $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
            $this->load->view(FRONT_DIR . '/booking_status', $data);
            $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
        }
    }

    function payment_success() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = "";

        //get the transaction data
        $data['paypalInfo'] = $this->input->post();
        $data['title'] = "Payment Submitted";
        $data['message'] = "Thank you! Your payment is being processed, and we’ll let you know when it’s been received.";
        //pass the transaction data to view
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/booking_management/booking_status', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    function payment_cancel() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = "";
        $bookingId = $this->session->userdata("bookingId");
        $this->db->where('id', $bookingId)->update('space_booking', array('paymentStatus' => 'Cancelled'));
        $this->session->unset_userdata("bookingId");
        $data['title'] = "Payment Cancelled";
        $data['message'] = "Your payment is cancelled successfully.";
        //pass the transaction data to view
        $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
        $this->load->view(FRONT_DIR . '/booking_management/booking_status', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }

    //insert transaction data
    public function insertTransaction($data = array()) {
        $insert = $this->db->insert('payments', $data);
        return $insert ? true : false;
    }

    function payment_ipn() {
        //paypal return transaction details array
        $paypalInfo = $this->input->post();

        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

        //check whether the payment is verified
        if (preg_match("/VERIFIED/i", $result)) {
            $custom = json_decode($paypalInfo['custom'], TRUE);
            $data['user_id'] = $custom['userID'];
            $data['paid_for'] = $custom['payFor'];
            $data['booking_id'] = $paypalInfo["item_number"];
            $data['txn_id'] = $paypalInfo["txn_id"];
            $data['payment_gross'] = $paypalInfo["mc_gross"];
            $data['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status'] = $paypalInfo["payment_status"];
            $data['payment_date'] = $paypalInfo["payment_date"];
            //insert the transaction data into the database
            $response = $this->insertTransaction($data);
            if ($response) {
                if($data['paid_for'] == 'rental'){
                    $updateData = array(
                        'paymentStatus' => ucfirst($data['payment_status']),
                        'transactionId' => $data['txn_id'],
                        'paymentAccount' => $data['payer_email'],
                        'updatedDate' => time()
                    );
                    $this->db->where('id', $data['booking_id'])->update('space_booking', $updateData);
                }elseif($data['paid_for'] == 'subscription'){
                    $updateData = array(
                        'valid_date' => strtotime("+30 days")
                    );
                    $this->db->where(array('user_id' => $data['user_id'], 'subscription_code' => $data['booking_id']))->update('user_subscriptions', $updateData);
                }                
            }
        }
    }

    # Customer USer profile

    public function viewProfile($userID = '') {
        if (empty($userID)) {
            redirect(base_url());
        }
        if ($this->session->has_userdata('user_id') && $this->session->userdata('user_id') == $userID) {
            $loginID = $this->session->userdata('user_id');
            $data['checkStatus'] = $this->user->checkContactList($userID, $loginID);
            $data['userProfileInfo'] = getSingleRecord('user', 'id', $userID);
            $data['customerID'] = $userID;
            $data['module_heading'] = 'My Profile';
            $data['checkProfile'] = "my_profile";
            $data['spaceList'] = $this->user->getSpaceList($loginID);
        } else {
            $header['step_info'] = "";
            $data['userProfileInfo'] = getSingleRecord('user', 'id', $userID);
            if ($this->session->has_userdata('user_id')){
                $userAddressBook = getMultiRecord('address_book', 'userID', $this->session->userdata('user_id'));
                foreach ($userAddressBook as $address) {
                    $data['addressBook'][] = $address['addUserID']; 
                }
                //print_array($data['addressBook']);
            }
            $data['checkProfile'] = "";
            $loginID = $userID;
            $data['customerID'] = $userID;
            $data['module_heading'] = 'My Profile';
            $data['spaceList'] = $this->user->getSpaceList($loginID);
        }
        $data['userWishLists'] = $this->user->getWishLists($userID, 'everyone');
        if ($userID == $this->session->userdata('user_id')) {
            $this->load->view(FRONT_DIR . '/' . INC . '/user-header', $data);
            $this->load->view(FRONT_DIR . '/user/userProfile', $data);
            $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
        } else {
            $header['search_nav'] = 1;
            $header['userProfileInfo'] = $this->user->userProfileInfo();
            $this->load->view(FRONT_DIR . '/' . INC . '/homepage-header',$header);
            $this->load->view(FRONT_DIR . '/user/userProfile', $data);
            $this->load->view(FRONT_DIR . '/' . INC . '/homepage-footer');
        }
    }

    # add customer data from the databse

    public function addContact() {
        $data = $this->input->post();
        $userID = $this->session->userdata('user_id');
        $contact = array();
        $contact['userID'] = $userID;
        $contact['addUserID '] = $data['contactUserID'];
        $contact['status'] = 'Active';
        $contact['createdDate'] = time();
        $contact['updatedDate'] = time();
        $contact['ipAddress '] = $this->input->ip_address();
        $check = $this->user->addContactList($contact);
        if ($check > 0) {
            echo 1;
        } else {
            echo 2;
        }
    }

}
