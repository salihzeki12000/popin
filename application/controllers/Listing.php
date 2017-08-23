<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','html','path','form','cookie'));
        $this->load->model(FRONT_DIR . '/FrontUser', 'user');
        $this->load->model(FRONT_DIR . '/FrontSpace', 'space_model');
    }

    public function Listing() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        
        //$host_id = $this->session->userdata('user_id');
        
        //$data['userSpaceData'] = $this->db->get_where('spaces', array('host' => $host_id))->result_array();
        //$spaceGallery = $this->db->select('image')->order_by('position', 'asc')->get_where('space_gallery', array('space' => $space_id))->result_array();

        $user_id = $this->session->userdata('user_id');
        $rawdata['user_id']    = $user_id;
        $rawdata['page']        = '1';
        $rawdata['limit']       = 9;
        if($rawdata['page']==1){
            $rawdata['start']   = 0;  
        }else{
            $rawdata['start']   = ($rawdata['page']-1)*$rawdata['limit'];
        }
        $modelData['data']  = $this->space_model->get_user_listings($rawdata);
        $modelData['page']  = $rawdata['page'];
        $modelData['limit'] = $rawdata['limit'];
        $data['listings']   = $this->listingBuilderHTML($modelData);
        $data['inprogress']  = $this->space_model->get_user_listings_inprogress($rawdata);
        $data['module_heading'] = 'My Listing';
        $this->load->view('frontend/listing/listing', $data);
    }

    public function listingData(){
        if(isset($_POST)){
            if($this->input->post('user_id')){
                $user_id = $this->input->post('user_id');
            }else{
                $user_id = $this->session->userdata('user_id');
            }
            $rawdata['user_id']    = $user_id;
            $rawdata['page']        = $this->input->post('page');
            $rawdata['limit']       = 9;
            if($rawdata['page']==1){
                $rawdata['start']   = 0;  
            }else{
                $rawdata['start']   = ($rawdata['page']-1)*$rawdata['limit'];
            }
            $modelData['data']  = $this->space_model->get_user_listings($rawdata);
            $modelData['page']  = $rawdata['page'];
            $modelData['limit'] = $rawdata['limit'];
            $messasgeData = $this->listingBuilderHTML($modelData);
            echo $messasgeData;
        }
    }

    private function listingBuilderHTML($modelData){
        $HTML='';
        if(count($modelData['data'])==0){
            /*if($modelData['page']==1):
                $HTML.='<section class="msg-box">                    
                            <div class="col-md-12">
                                <h5 class="text-center">'.lang('msg-no-msg').'</h5>
                            </div>
                        </section>';
            else:
                $HTML.='<section class="msg-box">                    
                        <div class="col-md-12">
                            <h5 class="text-center">'.lang('msg-no-more-msg').'</h5>
                        </div>
                    </section>';
            endif;
            $HTML.="<input type='hidden' class='nextpage' value='0'>";   */ 
        }else{
            if(count($modelData['data'])!=$modelData['limit']){
                $page = '0';
            }else{
                $page = $modelData['page']+1;
            }
            foreach($modelData['data'] as $spaceData){
                $establishmentType = $this->space_model->getDropdownDataRow('establishment_types', $spaceData['establishmentType']);
                if(!empty($establishmentType)){
                    $spaceData['establishmentType'] = $establishmentType['name'];
                }
                $spaceType = $this->space_model->getDropdownDataRow('space_types', $spaceData['spaceType']);
                if(!empty($spaceType)){
                    $spaceData['spaceType'] = $spaceType['name'];
                }
                $spaceGallery = $this->db->select('image')->order_by('position', 'asc')->limit('1')->get_where('space_gallery', array('space' => $spaceData['id']))->row_array();
                //$basePrice = (!empty($spaceData['base_price']))? getCurrency_symbol($spaceData['currency']). number_format($spaceData['base_price']):'';
                
                $HTML.='<div class="media">
                            <div class="media-left">
                                <div class="inner">
                                    <img src="'. base_url('uploads/user/gallery/'.$spaceGallery['image']).'" alt="" />
                                </div>
                            </div>
                            <div class="media-body media-middle">
                                <h4>'. $spaceData['spaceTitle']. '</h4>
                                <h4>'.$spaceData['spaceType'].' in '.$spaceData['city'].', '.$spaceData['state'].'</h4>
                                <p>Last updated on '.date("d F, Y",$spaceData['updatedDate']).'</p>
                                <div class="three-btn">
                                    <a href="'. site_url('manage-listing/'.$spaceData['id']).'" class="btn2">Manage listing</a>
                                    <a href="'. site_url('view-reservations/'.$spaceData['id']).'" class="green-btn">View Reservations</a>
                                    <a target="_blank" href="'. site_url('preview-listing/'.$spaceData['id']).'"><button class="btn">Preview</button></a>
                                </div>
                            </div>
                        </div><hr>';
            }
            $HTML.="<input type='hidden' class='nextpage' value='".$page."'>";
        }
        return $HTML;
    }
    
    public function preview_listing($space_id = '') {
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $this->load->helper('inflector');
        $header['userProfileInfo'] = $data['userProfileInfo'] = $this->user->userProfileInfo();
        

        if (!empty($space_id)) {
            $host_id = $this->session->userdata('user_id');
            $data['preview'] = $this->space_model->get_space_preview_data($space_id, $host_id);
            if(empty($data['preview'])){
                redirect('listing');
            }
            $data['hostProfileInfo'] = $this->space_model->hostProfileInfo($data['preview']['host']);
            $industry = $data['preview']['industryTypeId'];
            $establishment = $data['preview']['establishmentTypeId'];
            $data['amenities'] = $this->space_model->collectAmenities($industry, $establishment);
        }
        //print_array($data);
        $data['establishment_types'] = $this->space_model->getDropdownData('establishment_types');
        $data['space_types'] = $this->space_model->getDropdownData('space_types');
        $data['facilities'] = $this->space_model->getDropdownData('facilities');
        $data['cancellation_policies'] = $this->space_model->getDropdownData('cancellation_policies_master');
        $data['reviewsList'] = getMultiRecord('space_ratings','space',$space_id);
        $header['search_nav'] = 1;
        $data['space_id'] = $space_id;
        //$this->load->view(FRONT_DIR . '/' . INC . '/homepage-header', $header);
        $this->load->view(FRONT_DIR . '/include-partner/preview-header');
        $this->load->view(FRONT_DIR . '/listing/preview-listing', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/user-footer');
    }
    
    public function manage_listing($space_id = '') {
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $this->load->helper('inflector');
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        if (!empty($space_id)) {
            $host_id = $this->session->userdata('user_id');
            $data['listing'] = $this->space_model->get_space_preview_data($space_id, $host_id);
            if(empty($data['listing'])){
                redirect('listing');
            }
            
            $data['industries'] = $this->space_model->getDropdownData('industry');
            $data['establishment_types'] = $this->space_model->getDropdownData('establishment_types');
            $data['space_types'] = $this->space_model->getDropdownData('space_types');
            $industry = $data['listing']['industryTypeId'];
            $establishment = $data['listing']['establishmentTypeId'];
            $data['amenities'] = $this->space_model->collectAmenities($industry, $establishment);
            $data['facilities'] = $this->space_model->getDropdownData('facilities');
            $data['cancellation_policies'] = $this->space_model->getDropdownData('cancellation_policies_master');
        }
        //print_array($data['listing']);
        $data['space_id'] = $space_id;
        $data['module_heading'] = "Manage Listing";
        $this->load->view(FRONT_DIR . '/listing/manage-listing', $data);
    }
    
    public function update_listing_details() {
        $user_id = $this->session->userdata('user_id');
        $space_id = $this->input->post('space_id');
        $rawData = $this->input->post();
        unset($rawData['space_id']);
        //print_array($rawData, TRUE);
        if(isset($rawData['professionalCapacity'])){
            $rawData['professionalCapacity']    = (int) $rawData['professionalCapacity'];
            $rawData['workSpaceCount']          = (int) $rawData['workSpaceCount'];
            $rawData['workSpaceDetail']         = json_encode($rawData['workSpaceDetail']);
        }
        if(isset($rawData['amenities'])){
            $rawData['amenities'] = json_encode($rawData['amenities']);
        }
        if(isset($rawData['facilities'])){
            $rawData['facilities'] = json_encode($rawData['facilities']);
        }
        if(isset($rawData['professionalRequirements'])){
            $rawData['professionalRequirements'] = implode(",",$rawData['professionalRequirements']);
        }
        if(isset($rawData['additionalRules'])){
            $rawData['additionalRules'] = implode(" | ",$rawData['additionalRules']);
        }elseif(isset($rawData['ageRequirements']) && !isset($rawData['additionalRules'])){
            $rawData['additionalRules'] = "";
        }
        $this->space_model->updateData($rawData, $space_id, $user_id);
        
        $response['success'] = true;
        if(isset($rawData['latitude']) && isset($rawData['longitude'])){
            $response['address'] = true;
            
            $all_countries = unserialize(ALL_COUNTRY);
            $country = $all_countries[$rawData['country']];
            
            $response['full_address'] = $rawData['streetAddress'];
            if (!empty($rawData['suiteBuilding'])){
                $response['full_address'] .= ' ' . $rawData['suiteBuilding'];
            }
            $response['full_address'] .= ', ' . $rawData['city'] . ', ';
            $response['full_address'] .= $rawData['state'] . ', ';
            $response['full_address'] .= $rawData['zipCode'] . ', ';
            $response['full_address'] .= $country;
        }
        echo json_encode($response);
        die();
    }
    
    public function view_reservations($space_id = '') {
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        if (!empty($space_id)) {
            $host_id = $this->session->userdata('user_id');
            $data['listing'] = $this->space_model->get_space_preview_data($space_id, $host_id);
            if(empty($data['listing'])){
                redirect('listing');
            }
        }
        //print_array($data['listing']);
        $data['space_id'] = $space_id;
        $data['module_heading'] = "View Reservations";
        $this->load->view(FRONT_DIR . '/listing/view-reservations', $data);
    }
    
    public function reservation_details($booking_id = '') {
        $data['search_nav'] = 1;
        $data['module_heading'] = 'Reservation Details';
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['bookingInfo'] = $this->user->bookingInfo($booking_id);
        //print_array($data['bookingInfo']);
        if(empty($data['bookingInfo'])){
            redirect('rentals');
        }
        $data['spaceInfo'] = $this->user->spaceInfo($data['bookingInfo']['space']);
        $data['userInfo'] = $this->user->userInfo($data['bookingInfo']['user']);
        $data['hostInfo'] = $this->user->userInfo($data['spaceInfo']['host']);
        $this->load->view(FRONT_DIR . '/listing/reservation_details',$data);
    }
    
    public function update_reservation_request() {
        $bookingId = $this->input->post('id');
        $bookingStatus = $this->input->post('status');
        
        $this->db->update('space_booking', array('partnerStatus' => $bookingStatus, 'updatedDate'=>time()), array('id' => $bookingId));
        if($this->db->affected_rows()){
            if($bookingStatus == 'Accepted'){
                $this->db->update('conversation', array('status' => 'reservations'), array('booking' => $bookingId));
            }
            if($bookingStatus == 'Rejected'){
                $this->db->insert('cancel_reason', array('booking_id' => $bookingId, 'reason' => $this->input->post('reason'), 'createdDate'=>time(), 'updatedDate'=>time(),'ipAddress'=>$this->input->ip_address()));
            }
        }
    }
    
    public function manage_calendar($space_id = '') {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $rawData = $this->input->post();
            if (!empty($rawData)) {
                $space_id = $this->input->post('space_id');
                $calendarData = $this->input->post('dates');

                $this->space_model->updateCalendarData($calendarData, $space_id);
            }
            echo "success";
            die();
        }
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        if (!empty($space_id)) {
            $host_id = $this->session->userdata('user_id');
            $data['listing'] = $this->space_model->get_space_data($space_id, $host_id);
            if(empty($data['listing'])){
                redirect('listing');
            }
        }
        //print_array($data['listing']);
        $data['space_id'] = $space_id;
        $data['module_heading'] = "Manage Calendar";
        $this->load->view(FRONT_DIR . '/listing/manage-calendar', $data);
    }
    
    public function fetch_reservations() {
        //echo '[{"title":"All Day Event","start":"2017-05-01"},{"title":"Long Event","start":"2017-05-07","end":"2017-05-10"},{"id":999,"title":"Repeating Event","start":"2017-05-09T16:00:00"},{"id":999,"title":"Repeating Event","start":"2017-05-16T16:00:00"},{"title":"Conference","start":"2017-05-11","end":"2017-05-13"},{"title":"Meeting","start":"2017-05-12 10:30","end":"2017-05-12 12:30"},{"title":"Lunch","start":"2017-05-12 12:30:00"},{"title":"Meeting","start":"2017-05-12T14:30:00"},{"title":"Happy Hour","start":"2017-05-12T17:30:00"},{"title":"Dinner","start":"2017-05-12T20:00:00"},{"title":"Birthday Party","start":"2017-05-13T07:00:00"},{"title":"Click for Google","url":"http://google.com/","start":"2017-05-28"}]';
        $userID = $this->session->userdata('user_id'); 
        $spaceID = $this->input->post('space_id');
        $hostReservations = $this->user->getUserReservations($userID, $spaceID);
        echo json_encode($hostReservations);
    }

    public function my_upcoming_reservations() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'My Reservations';
        $userID = $this->session->userdata('user_id'); 
        $data['myReservations'] = $this->user->getReservations($userID);
        $this->load->view('frontend/listing/listing2', $data);
    }

    public function my_past_reservations() {
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        $data['module_heading'] = 'Past Reservations';
        $userID = $this->session->userdata('user_id'); 
        $data['pastReservations'] = $this->user->getPastReservations($userID);
        $this->load->view('frontend/listing/listing3', $data);
    }

}
