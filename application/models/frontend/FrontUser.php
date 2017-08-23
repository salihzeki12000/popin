<?php

class FrontUser extends CI_Model {

    function __construct() {
        parent::__construct();
        //$table = 'user';
    }
    
    public function insertData($data, $table) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function getData($columns, $conditions, $table) {
        return $this->db->select($columns)->where($conditions)->get($table)->result_array();
    }

    public function check_exist_email($email, $id) {
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('email', $email);

        if ($id > 0) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query->row();
    }

    public function checkAccount($verficationCode) {
        $this->db->select('id,status');
        $this->db->from('user');
        $this->db->where('verificationCode', $verficationCode);
        $query = $this->db->get();
        return $query->row();
    }

    public function checkUser($email) {
        $this->db->select('id,firstName,lastName,email,password')->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    public function addUser($data) {
        //Insert Query Goes here...
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function addCancelDetail($data) {
        //Insert Query Goes here...
        $this->db->insert('cancel_reason', $data);
        return $this->db->insert_id();
    }

    public function userInfo($id, $select = "*") {
        $where = array("status" => 'Active', "id=" => $id);
        $query = $this->db->select($select)->from('user')->where($where)->get();
        return $query->row();
    }

    public function userProfileInfo() {
        if ($this->session->userdata('user_id') != NULL) {
            $where = array("status" => 'Active', "id=" => $this->session->userdata('user_id'));
            $query = $this->db->select('*')->from('user')->where($where)->get();
            return $query->row();
        } else {
            $this->check_isvalidated();
        }
    }

    public function check_isvalidated() {
        $this->session->unset_userdata('redirect_url');
        if (!$this->session->userdata('user_id')) {
            $this->session->set_userdata('redirect_url', base_url(uri_string()));
            $this->session->set_flashdata('message_notification', 'Please Login To Continue');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(base_url());
        }
    }

    public function editUser($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        return $this->db->affected_rows();
    }

    public function checkCurrentPassword($userData) {
        $where = array("id" => $userData['id']);
        $query = $this->db->select('id,status,password')->from('user')->where($where)->get();

        $user_data = $query->row();
        if ($this->encrypt->decode($user_data->password) == $userData['password']) {
            return $user_data;
        } else {
            return array();
        }
    }

    public function deleteUser($id) {

        $this->db->select('featuredImage');
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $image = $query->row();

        @unlink("./uploads/page/" . $image->featuredImage);
        @unlink("./uploads/page/big/" . $image->featuredImage);
        @unlink("./uploads/page/med/" . $image->featuredImage);
        @unlink("./uploads/page/thumb/" . $image->featuredImage);

        $this->db->where('id', $id);
        $this->db->delete('user');
        return $this->db->affected_rows();
    }

    public function doLogin($data) {
        unset($data['login_submit']);
        $where = array("email" => $data['login_email']);
        $query = $this->db->select('id,status,password')->from('user')->where($where)->get();

        $user_data = $query->row();
        if ($this->encryption->decrypt($user_data->password) == $this->input->post('login_password')) {
            return $user_data;
        } else {
            return array();
        }
    }

    public function loginRecord($data) {
        //Insert Query Goes here...
        $this->db->insert('login_logs', $data);
        return $this->db->insert_id();
    }

    public function sessionLogout($session_log) {

        //exit($session_log);
        $data = array("logoutDate" => strtotime(date('Y-m-d H:i:s')));
        $where = array("id" => $session_log);
        $this->db->where($where);
        $this->db->update('login_logs', $data);
        return $this->db->affected_rows();
    }

    public function addCard($data) {
        //Insert Query Goes here...
        $this->db->insert('card_details', $data);
        return $this->db->insert_id();
    }

    public function cardDetails() {
        $this->db->select('*');
        $this->db->from('card_details');
        $this->db->where('user', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result();
    }

    public function setDefault($card_id) {
        $data = array('updatedDate' => strtotime(date('Y-m-d H:i:s')), 'isPrimary' => 'No');
        $this->db->where('user', $this->session->userdata('user_id'));
        $this->db->update('card_details', $data);
        $all_card = $this->db->affected_rows();
        if ($all_card > 0) {
            $new_data = array("updatedDate" => strtotime(date('Y-m-d H:i:s')), "isPrimary" => "Yes");
            $this->db->where('id', $card_id);
            $this->db->update('card_details', $new_data);
            return $this->db->affected_rows();
        } else {
            $new_data = array("updatedDate" => strtotime(date('Y-m-d H:i:s')), "isPrimary" => "Yes");
            $this->db->where('id', $card_id);
            $this->db->update('card_details', $new_data);
            return $this->db->affected_rows();
        }
    }

    public function removeCard($card_id) {
        $this->db->where('user', $this->session->userdata('user_id'));
        $this->db->where('id', $card_id);
        $this->db->delete('card_details');
        return $this->db->affected_rows();
    }

    public function getLoginHistory($user_id) {
        $logs = $this->db->order_by('id', 'desc')->get_where('login_logs', array('userId' => $user_id, 'userType' => 'User'))->result_array();
        $response = array();
        if (!empty($logs)) {
            $this->load->helper('popin');

            foreach ($logs as $log) {
                $loginID = url_title($log['browser'] . "-" . $log['device'], "-", true);
                $data['agent'] = $log['browser'];
                $data['platform'] = $log['device'];
                //$data['location']   = empty($log['location'])||$log['ipAddress']!='::1'?get_location_from_ip($log['ipAddress']):$log['location'];
                $data['location'] = $log['location'];
                $data['ip_address'] = $log['ipAddress'];
                if (!empty($log['logoutDate'])) {
                    $data['login_status'] = "Logged Out";
                    $data['timestamp'] = date("F d \a\\t h:ia", $log['logoutDate']);
                    $data['last_seen'] = time_elapsed_string(date("Y-m-d H:i:s", $log['logoutDate']));
                } else {
                    $data['login_status'] = '<a href="#" class="logout-user" data-id="' . $log['id'] . '">Log Out</a>';
                    $data['timestamp'] = date("F d \a\\t h:ia", $log['loginDate']);
                    $data['last_seen'] = time_elapsed_string(date("Y-m-d H:i:s", $log['loginDate']));
                }

                $response[$loginID][] = $data;
            }
        }
        //echo "<pre>";print_r($response);exit;
        return $response;
    }

    function create_conversation($data) {
        $this->db->insert('conversation', $data);
        return $this->db->insert_id();
    }

    public function fetch_users($userId, $term)
    {
        $responseData = array();

        $users = $this->db->select('user.*')->join('address_book', 'user.id = address_book.addUserID')->where(array('address_book.userID' => $userId,'address_book.status' => 'Active'))->like('user.firstName', $term, 'both')->or_like('user.email', $term, 'both')->get('user')->result_array();

        foreach ($users as $user) {
            $item ['id']        = $user['id'];
            $item ['name']      = trim($user['firstName']) . " " . trim($user['lastName']);
            $item ['email']     = trim($user['email']);
            $avatar = ($user['avatar'] != '' && file_exists('uploads/user/thumb/' . $user['avatar'])) ? $user['avatar'] : 'user_pic-225x225.png';
            $item ['image']     = trim($avatar);

            array_push($responseData, $item);
        }
        sort($responseData);
        return json_encode($responseData);
    }

    public function spaceInfo($id, $select = "*") {
        $where = array("status" => 'Active', "id=" => $id);
        $query = $this->db->select($select)->from('spaces')->where($where)->get();
        return $query->row_array();
    }

    public function getSpaceGallery($space_id){
        $spaceGallery = $this->db->select('image')->order_by('position', 'asc')->get_where('space_gallery', array('space' => $space_id))->result_array();
        if(!empty($spaceGallery)){
            $response = array();
            foreach ($spaceGallery as $image) {
                $response[] = $image['image'];
            }
            return $response;
        }else{
            return false;
        }
    }
    
    public function bookingInfo($id, $select = "space_booking.*, payments.*, cancel_reason.reason") {
        $where = array("space_booking.id=" => $id);
        $this->db->join("payments", "space_booking.id = payments.booking_id", "left");
        $this->db->join("cancel_reason", "space_booking.id = cancel_reason.booking_id", "left");
        $query = $this->db->select($select)->from('space_booking')->where($where)->get();
        return $query->row_array();
    }
    
    function updateMessageStatus($userId, $status){
        $this->db->where(array('receiver' => $userId,'status'=>'new'));
        $this->db->update('conversation',array('status' => $status));
    }
    
    function getNewUserMessages($userId) {
        $this->db->select("msg.id,msg.subject,msg.message,msg.createdDate,user.firstName as fname,user.lastName as lname,user.avatar as picture");
        $this->db->join('user','msg.sender = user.id');
        $this->db->where(array('msg.receiver' => $userId));
        $this->db->where_in('msg.status', array('new','pending'));
        return $this->db->order_by('msg.createdDate', 'desc')->get('conversation as msg')->result_array();
    }
    
    // Get user inbox messages
    function getUserMessages($userId, $status = "", $requestData="") {
        $response = array();

        //$this->db->where("(sender = {$userId} OR receiver = {$userId}) AND parent = 0");
        $this->db->where('receiver', $userId);
        if ($status != "") {
            $this->db->where("status", $status);
        }
        if(!empty($requestData)){ $this->db->limit($requestData['limit'], $requestData['start']); }
        $conversations = $this->db->order_by('updatedDate', 'desc')->get('conversation')->result_array();
        //echo $this->db->last_query();
        if (!empty($conversations)) {
            foreach ($conversations as $conversation) {
                if ($conversation['parent'] != 0) {
                    $this->db->where('id', $conversation['parent']);
                    $conversation = $this->db->get('conversation')->row_array();
                }
                $userInfo = $this->userInfo($conversation['sender']);
                if (!empty($userInfo)) {
                    $response['messages'][$conversation['id']] = $conversation;
                    $response['messages'][$conversation['id']]['userInfo'] = array(
                        'fname' => $userInfo->firstName,
                        'lname' => $userInfo->lastName,
                        'picture' => ($userInfo->avatar != '' && file_exists('uploads/user/thumb/' . $userInfo->avatar)) ? $userInfo->avatar : 'user_pic-225x225.png',
                    );
                    if ($conversation['space_id']) {
                        $spaceInfo = $this->spaceInfo($conversation['space_id']);
                        $response['messages'][$conversation['id']]['spaceInfo'] = array(
                            'title' => $spaceInfo['spaceTitle'],
                            'country' => $spaceInfo['country'],
                        );
                    }
                    if ($conversation['booking']) {
                        $bookingInfo = $this->bookingInfo($conversation['booking'],'space_booking.partnerStatus,space_booking.checkIn,space_booking.checkOut,payments.currency_code,payments.payment_gross');
                        $response['messages'][$conversation['id']]['bookingInfo'] = $bookingInfo;
                    }
                    $this->db->where('parent', $conversation['id']);
                    $replyData = $this->db->order_by('id', 'asc')->get('conversation')->result_array();
                    if (!empty($replyData)) {
                        $response['messages'][$conversation['id']]['replies'] = $replyData;
                    }
                }
            }
        } else {
            $response['messages'] = array();
        }
        $this->db->where(array('receiver' => $userId));
        $response['allCount'] = $this->db->get('conversation')->num_rows();

        //$this->db->where(array('receiver' => $userId, 'status' => 'starred'));
        //$response['starCount'] = $this->db->get('conversation')->num_rows();
        $this->db->where(array('receiver' => $userId, 'status' => 'read'));
        $response['readCount'] = $this->db->get('conversation')->num_rows();

        $this->db->where(array('receiver' => $userId, 'status' => 'new'));
        $response['newCount'] = $this->db->get('conversation')->num_rows();

        $this->db->where(array('receiver' => $userId, 'status' => 'reservations'));
        $response['reserveCount'] = $this->db->get('conversation')->num_rows();

        $this->db->where(array('receiver' => $userId, 'status' => 'pending'));
        $response['pendingCount'] = $this->db->get('conversation')->num_rows();

        $this->db->where(array('receiver' => $userId, 'status' => 'archived'));
        $response['archiveCount'] = $this->db->get('conversation')->num_rows();
        //echo "<pre>";print_r($response);exit;
        return $response;
    }
    
    // get user outbox messages
    function getUserOubox($userId, $status = "", $requestData="") {
        $response = array();

        //$this->db->where("(sender = {$userId} OR receiver = {$userId}) AND parent = 0");
        $this->db->where('sender', $userId);
        if ($status != "") {
            $this->db->where("status", $status);
        }
        if(!empty($requestData)){ $this->db->limit($requestData['limit'], $requestData['start']); }
        $conversations = $this->db->order_by('updatedDate', 'desc')->get('conversation')->result_array();
        //echo $this->db->last_query();
        if (!empty($conversations)) {
            foreach ($conversations as $conversation) {
                if ($conversation['parent'] != 0) {
                    $this->db->where('id', $conversation['parent']);
                    $conversation = $this->db->get('conversation')->row_array();
                }
                $userInfo = $this->userInfo($conversation['receiver']);
                if (!empty($userInfo)) {
                    $response['messages'][$conversation['id']] = $conversation;
                    $response['messages'][$conversation['id']]['userInfo'] = array(
                        'fname' => $userInfo->firstName,
                        'lname' => $userInfo->lastName,
                        'picture' => ($userInfo->avatar != '' && file_exists('uploads/user/thumb/' . $userInfo->avatar)) ? $userInfo->avatar : 'user_pic-225x225.png',
                    );
                    if ($conversation['space_id']) {
                        $spaceInfo = $this->spaceInfo($conversation['space_id']);
                        $response['messages'][$conversation['id']]['spaceInfo'] = array(
                            'title' => $spaceInfo['spaceTitle'],
                            'country' => $spaceInfo['country'],
                        );
                    }
                    if ($conversation['booking']) {
                        $bookingInfo = $this->bookingInfo($conversation['booking'],'space_booking.partnerStatus,payments.currency_code,payments.payment_gross');
                        $response['messages'][$conversation['id']]['bookingInfo'] = $bookingInfo;
                    }
                    $this->db->where('parent', $conversation['id']);
                    $replyData = $this->db->order_by('id', 'asc')->get('conversation')->result_array();
                    if (!empty($replyData)) {
                        $response['messages'][$conversation['id']]['replies'] = $replyData;
                    }
                }
            }
        } else {
            $response['messages'] = array();
        }
        //echo "<pre>";print_r($response);exit;
        return $response;
    }
    
    function getUpcomingRentals($user){
        $response = array();
        $rentals = $this->db->where('user', $user)->order_by('updatedDate', 'desc')->limit('3')->get('space_booking')->result_array();
        if (!empty($rentals)) {
            $i=0;
            foreach ($rentals as $rental) {
                $response[$i]['booking'] = $rental;

                $spaceInfo = $this->spaceInfo($rental['space']);
                $response[$i]['space']['title'] = $spaceInfo['spaceTitle'];
                $response[$i]['space']['country'] = $spaceInfo['country'];
                $spaceGallery = $this->getSpaceGallery($rental['space']);
                if($spaceGallery){
                    $response[$i]['space']['image'] = base_url('uploads/user/gallery/'.$spaceGallery[0]);
                }else{
                    $response[$i]['space']['image'] = base_url('theme/front/img/nav-icon1.jpg');
                }
                $i++;
            }
            return $response;
        }else{
            return false;
        }
    }
    
    private function createRentalRecord($rawData){
        $i=0;$response = array();
        if (!empty($rawData)) {            
            foreach ($rawData as $rental) {
                $response[$i]['booking'] = $rental;

                $spaceInfo = $this->spaceInfo($rental['space']);
                $response[$i]['space']['title'] = $spaceInfo['spaceTitle'];
                $response[$i]['space']['city'] = $spaceInfo['city'];
                $response[$i]['space']['state'] = $spaceInfo['state'];
                $response[$i]['space']['country'] = $spaceInfo['country'];
                $spaceGallery = $this->getSpaceGallery($rental['space']);
                if($spaceGallery){
                    $response[$i]['space']['image'] = base_url('uploads/user/gallery/'.$spaceGallery[0]);
                }else{
                    $response[$i]['space']['image'] = base_url('theme/front/img/nav-icon1.jpg');
                }
                $i++;
            }
        }
        return $response;
    }
    
    function getUserRentals($user){
        $result = array();
        $today = date('Y-m-d');
        
        $upcoming = $this->db->where(array('user' => $user,'checkIn >' => $today))->order_by('updatedDate', 'desc')->get('space_booking')->result_array();
        $result['upcoming'] = $this->createRentalRecord($upcoming);
        
        $past = $this->db->where(array('user' => $user,'checkIn <=' => $today,'checkOut <=' => $today))->order_by('updatedDate', 'desc')->get('space_booking')->result_array();
        $result['past'] = $this->createRentalRecord($past);
//        echo "<pre>";
//        print_r($result);
//        exit;
        return $result;
    }
    
    function getUserReservations($user, $space){
        $this->db->select("space_booking.id as id, CONCAT(spaces.spaceTitle, ' · ', space_booking.professionals, ' Professional(s)') as title, space_booking.checkIn as start, space_booking.checkOut as end, CONCAT('".site_url('reservation-details')."', '/', space_booking.id) as url");
        $this->db->join('spaces', 'user.id = spaces.host');
        $this->db->join('space_booking', 'spaces.id = space_booking.space');
        $result = $this->db->where(array('user.id' => $user,'spaces.id'=>$space))->get('user')->result_array();

        //print_array($result);
        return $result;
    }
    
    function getReservations($user){
        $today = date('Y-m-d');
        
        $this->db->select("space_booking.*, spaces.spaceTitle as title");
        $this->db->join('spaces', 'user.id = spaces.host');
        $this->db->join('space_booking', 'spaces.id = space_booking.space');
        $result = $this->db->where(array('user.id' => $user,'space_booking.checkIn >' => $today))->order_by('space_booking.checkIn', 'asc')->get('user')->result_array();

        //print_array($result);exit;
        return $result;
    }
    
    function getPastReservations($user){
        $today = date('Y-m-d');
        
        $this->db->select("space_booking.*, spaces.spaceTitle as title");
        $this->db->join('spaces', 'user.id = spaces.host');
        $this->db->join('space_booking', 'spaces.id = space_booking.space');
        $result = $this->db->where(array('user.id' => $user,'space_booking.checkIn <=' => $today,'space_booking.checkOut <=' => $today))->order_by('space_booking.checkIn', 'asc')->get('user')->result_array();

        //print_array($result);exit;
        return $result;
    }

    function getWishLists($user, $privacy = '') {
        $this->db->select('id,user,name,privacy');
        if($privacy != ''){
            $this->db->where('privacy', $privacy);
        }
        $this->db->where('user', $user)->order_by('updatedDate','desc');
        $wishLists = $this->db->get('wishlist_master')->result_array();
        $response = array();
        if(!empty($wishLists)){
            $i = 0;
            foreach($wishLists as $wishList){
                $response[$i] = $wishList;
                $userLists = $this->getUserWishLists($wishList['id']);
                foreach($userLists as $userList){
                    $spaceInfo = $this->spaceInfo($userList['space_id']);
                    if(!empty($spaceInfo)){
                        $image = '';
                        $spaceGallery = $this->getSpaceGallery($spaceInfo['id']);
                        if($spaceGallery){
                            $image = base_url('uploads/user/gallery/'.$spaceGallery[0]);
                        }
                        $response[$i]['userLists'][] = array(
                            'space_id' => $spaceInfo['id'],
                            'title' => $spaceInfo['spaceTitle'],
                            'professionals' => $spaceInfo['professionalCapacity'],
                            'image' => $image
                        );
                    }                    
                }
                $i++;
            }
        }
        //echo "<pre>";        print_r($response);exit;
        return $response;
    }

    function getUserWishLists($wishlist) {

        return $this->db->select('space_id')->where(array('wishlist_id' => $wishlist, 'status' => 1))->order_by('id','desc')->get('wishlists')->result_array();

    }
    
    function getWishListMaster($wishlistID) {
        return $this->db->where(array('wishlist_master.id' => $wishlistID))->get('wishlist_master')->row_array();

    }
    
    function getWishListDetails($wishlistID) {
        $this->db->select('wishlist_master.id as wishlist_master_id, wishlist_master.name, wishlists.space_id, spaces.currency, spaces.base_price, spaces.spaceTitle, estb.name as establishment_type, space.name as space_type, spaces.workSpaceCount, spaces.latitude, spaces.longitude, spaces.totalRating as ratings');
        $this->db->join('wishlists', 'wishlist_master.id = wishlists.wishlist_id');
        $this->db->join('spaces', 'wishlists.space_id = spaces.id');
        $this->db->join('establishment_types as estb', 'spaces.establishmentType = estb.id');
        $this->db->join('space_types as space', 'spaces.spaceType = space.id');
        return $this->db->where(array('wishlist_master.id' => $wishlistID, 'wishlists.status' => 1))->order_by('wishlists.updatedDate','desc')->get('wishlist_master')->result_array();

    }

    function create_wishlist($data) {
        $this->db->insert('wishlist_master', $data);
        return $this->db->insert_id();
    }
    
    function update_wishlist_master($data, $condition) {
        $this->db->where($condition)->update('wishlist_master', $data);
        return $this->db->affected_rows();
    }
    
    function check_wishlist_record($data){
        return $this->db->where($data)->get('wishlists')->num_rows();
    }
    
    function check_space_in_wishlist($space_id){
        return $this->db->join('wishlist_master','wishlist_master.id=wishlists.wishlist_id')->where(array('space_id'  => $space_id,'status'=>1))->get('wishlists')->num_rows();
    }

    function add_to_wishlist($wishlist_id, $space_id) {
        $hasData = $this->db->where(array('wishlist_id' => $wishlist_id,'space_id'  => $space_id))->get('wishlists')->num_rows();
        if($hasData == 0){
            $rawData = array(
                'wishlist_id'    => $wishlist_id,
                'space_id'  => $space_id,
                'status' => 1,
                'createdDate'    => time(),
                'updatedDate'   => time(),
                'ipAddress'   => $this->input->ip_address()
            );
            $this->db->insert('wishlists', $rawData);
            $insert_id = $this->db->insert_id();
            
            $this->db->where('id', $wishlist_id)->update('wishlist_master', array('updatedDate'=>time()));
            return $insert_id;
        }
    }
    
    function update_wishlist($where) {
        $hasData = $this->db->where($where)->get('wishlists');
        if($hasData->num_rows() == 1){
            $data = $hasData->row_array();
            if($data['status'] == 1){                
                //already added => removed
                $status = 0;
            }else{
                // removed => added
                $status = 1;
            }
            $rawData = array(
                        'status' => $status,
                        'updatedDate'   => time(),
                        'ipAddress'   => $this->input->ip_address()
                    );
            $this->db->where($where)->update('wishlists', $rawData);
            
            if($status){ $this->db->where('id', $where['wishlist_id'])->update('wishlist_master', array('updatedDate'=>time()));}
            return $status;
        }
    }
    # get user activate Link
    public function getActivateLink($email)
    {
      return $this->db->get_where('user',array('email'=>$email))->row_array();
    }

    # get Contact list from the booking table
    public function bookContactList($userId,$requestData){
      $response = array();

      //$this->db->where("(sender = {$userId} OR receiver = {$userId}) AND parent = 0");
      $this->db->where('userID', $userId);
      $this->db->limit($requestData['limit'], $requestData['start']);
      $conversations = $this->db->order_by('id', 'desc')->get('address_book')->result_array();
      // echo $this->db->last_query();exit;
      if (!empty($conversations)) {
          $response['messages'] = $conversations;
      } else {
          $response['messages'] = array();
      }
      return $response;
    }
    # Add list of contact
    public function addContactList($request){
     $this->db->insert('address_book',$request);
     return $this->db->affected_rows();
    }
    public function checkContactList($addUserId,$userID){
      return $this->db->get_where('address_book',array('userID'=>$userID,'addUserID'=>$addUserId))->row_array();
    }
    public function getSpaceList($userID){
       $sql='SELECT `spaces`.*, `industry_name` AS industryName,a.name as establishmentName,b.name as spaceName from spaces INNER JOIN industry ON spaces.industryType=industry.id INNER JOIN establishment_types AS a ON spaces.establishmentType= a.id INNER JOIN space_types as b ON spaces.spaceType=b.id WHERE spaces.status= "Active" AND  spaces.host='.$userID;
      return $this->db->query($sql)->result();
    }
    public function checkAlreadyJoinAccount($userID, $currentUser=''){
        if(!empty($currentUser)){
            $joined = $this->db->get_where('join_account_master',array('provide_link_userID'=>$userID,'activate_link_userID'=>$currentUser))->num_rows();
            if ($joined == 1) {
                /*foreach ($query as $key => $value) {
                    $getUserInfo = getSingleRecord('user','id',$value['activate_link_userID']);
                    if (empty($getUserInfo)) {
                       return 'true';
                    }else{
                        return 'false';
                    }
                }*/
                return 'true';
            }else{
                return 'false';
            }
        }else{
            return 'false';
        }
    }
    # send invitation email from the user
    public function sendInvitationMail($emailList,$link,$userRecord){
        // $email,$from  Referral Link
         $smsmessage = '';
         $subjectTitle = "Welcome to Popin join with Us.";
          foreach ($emailList as $key => $value) {
              $email = $value;
              $smsmessage .= "Hi !\r\n\n";
              $smsmessage .= "&nbsp;&nbsp;&nbsp;".$userRecord->firstName." ".$userRecord->lastName." has ben send you Referral like.\n";
              $smsmessage .= "Click on the button below to Join with Popin";
              $smsmessage .= "<a href='".$link."' style='text-decoration: none;background: #f75134;padding: 15px 22px 15px 22px;border-radius: 10px;color: #ebf1de;font-size: 17px;font-weight: 800;'>Join With Us</a>";
              sendMailAdmin($email,$subjectTitle,$smsmessage,'Popin@Popin.com');
          }
          return 1;
    }
    #join acount
    public function joinNewAccount($userID,$joinUserId,$amount){
        $sql = 'UPDATE user SET referalAmount = referalAmount+'.$amount.' WHERE id='.$userID;
        $this->db->query($sql);
        $joinUser = array();
        $joinUser['provide_link_userID']  = $userID;
        $joinUser['activate_link_userID'] = $joinUserId;
        $joinUser['join_date']            = time();
        $this->db->insert('join_account_master',$joinUser);
    }
    # Send verify code
    public function addPaypalPreferences($requestData,$user_id){
      $paypal = array();
      $paypal['userId']       = $user_id;
      $paypal['method']       = "PayPal";
      $paypal['firstName']    = $requestData->userInfo->name->firstName;
      $paypal['lastName']     = $requestData->userInfo->name->lastName;
      $paypal['email']        = $requestData->userInfo->emailAddress;
      $paypal['accountId']    = $requestData->userInfo->accountId;
      $paypal['status']       = $requestData->responseEnvelope->ack;
      $paypal['build']        = $requestData->responseEnvelope->build;
      $paypal['accountType']  = $requestData->userInfo->accountType;
      $paypal['accountStatus']= $requestData->accountStatus;
      $paypal['correlationId']= $requestData->responseEnvelope->correlationId;
      $paypal['createDate']   = time();
      $paypal['updateDate']   = time();
      $this->db->insert('payout_preferences',$paypal);
      return $this->db->affected_rows();
    }
    public function createPaypalPreferenceList($userId){
      $query = $this->getListPaypal($userId);
      $html = '<table class="table">
                <thead>
                  <tr>
                    <th>Method</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Status</th>
                  </tr>
                </thead>
                    <tbody>';
      foreach ($query as $key => $getList) {
            $html .= '<tr>
                        <td>'.$getList->method.'</td>
                        <td>'.($getList->method == 'Bank Tranfer'? $getList->bank_name :$getList->firstName.' '.$getList->lastName).'</td>
                        <td>'.$getList->email.'</td>
                        <td>'.$getList->accountStatus.'</td>
                     </tr>';
      }
           $html .= '</tbody></table>';
           $html .= '<hr><button style="float: right;" id="nextMessageBox" class="btn-red">Add Payout Method</button>';
           return $html;
    }
    public function getListPaypal($userId){
       return $this->db->get_where('payout_preferences',array('userId'=>$userId))->result();      
    }
    public function banakDetailsAdd($userId,$requestData){
      $bank = array();
      $bank['userId']          = $userId;
      $bank['method']          = "Bank Tranfer";
      $bank['email  ']         = $requestData['accountNumber'];
      $bank['bankAccountType'] = $requestData['BankaccountType'];
      $bank['bank_country']    = $requestData['bankCountry'];
      $bank['currency   ']     = '';
      $bank['bank_name  ']     = $requestData['bankName'];
      $bank['ifsc_code  ']     = $requestData['ifscCode'];
      $bank['pan_number']      = $requestData['panNumber'];
      $bank['accountType']     = $requestData['accountType'];
      $bank['accountStatus']   = 'Pending';
      $bank['createDate']      = time();
      $bank['updateDate']      = time();
      $this->db->insert('payout_preferences',$bank); 
      return $this->db->affected_rows();
    }
    public function getTransactionsHostory($userId){
        $this->db->select("payments.*, space_booking.checkIn, space_booking.checkOut, space_booking.totalAmount, space_booking.currency, subscription_master.name as subscription_name, spaces.spaceTitle, CONCAT(spaces.city, ', ', spaces.state) as location");
        $this->db->join('space_booking', 'payments.booking_id = space_booking.id', 'left');
        $this->db->join('subscription_master', 'payments.booking_id = subscription_master.code', 'left');
        $this->db->join('spaces', 'space_booking.space = spaces.id', 'left');
        return $this->db->get_where('payments',array('user_id'=>$userId))->result_array();      
    }
    
    // User Documents section
    public function createUserDocs($user) {
        // User table documents
        $userDocs = $this->db->select('establishmentLicence,liabilityInsurance,licenceCopy')->where('id', $user)->get('user')->row_array();
        foreach ($userDocs as $key => $doc) {
            if(trim($doc) != ""){
                if($key == 'establishmentLicence'){
                    $doc_type = '1';
                }elseif($key == 'liabilityInsurance'){
                    $doc_type = '2';
                }else{
                    $doc_type = '3';
                }
                $isDocPresent = $this->db->get_where('user_documents', array('user' => $user, 'doc_type' => $doc_type, 'doc_name' => $doc))->num_rows();

                if($isDocPresent == 0){
                    $rawData = array(
                        'user' => $user,
                        'doc_type' => $doc_type,
                        'doc_name' => $doc,
                        'createdDate'   => time(),
                        'updatedDate'   => time(),
                        'ipAddress'   => $this->input->ip_address()
                    );
                    $this->db->insert('user_documents', $rawData);
                }
            }
        }
        // Space table documents
        $spaceDocs = $this->db->select('establishmentLicenceFile,liabilityInsurance')->where('host', $user)->get('spaces')->result_array();
        
        foreach ($spaceDocs as $spaceDoc) {
            foreach ($spaceDoc as $key => $doc) {
                if(trim($doc) != ""){
                    $isDocPresent = $this->db->where_in('doc_type', array('1','2'))->get_where('user_documents', array('user' => $user, 'doc_name' => $doc))->num_rows();
                
                    if($isDocPresent == 0){
                        $rawData = array(
                            'user' => $user,
                            'doc_type' => ($key == 'establishmentLicenceFile')?1:2,
                            'doc_name' => $doc,
                            'createdDate'   => time(),
                            'updatedDate'   => time(),
                            'ipAddress'   => $this->input->ip_address()
                        );
                        $this->db->insert('user_documents', $rawData);
                    }
                }
            }            
        }
    }
    
    public function insertUserDocs($user, $doc_name, $doc_type) {
        if($doc_name != ""){
            $isDocQuery = $this->db->get_where('user_documents', array('user' => $user, 'doc_name' => $doc_name, 'doc_type' => $doc_type));
                
            if($isDocQuery->num_rows() == 0){
                $rawData = array(
                    'user' => $user,
                    'doc_type' => $doc_type,
                    'doc_name' => $doc_name,
                    'createdDate'   => time(),
                    'updatedDate'   => time(),
                    'ipAddress'   => $this->input->ip_address()
                );
                $this->db->insert('user_documents', $rawData);
                $insertId = $this->db->insert_id();
                
                if($doc_type == '3'){
                    $this->setDefaultDoc($user, $insertId);
                }
                return $insertId;
            }else{
                $docInfo = $isDocQuery->row_array();
                $this->db->where(array('user' => $user, 'doc_name' => $doc_name, 'doc_type' => $doc_type));
                $this->db->update('user_documents', array('doc_status' => 'added', 'updatedDate'   => time()));
                $insertId = $this->db->insert_id();
                
                if($doc_type == '3'){
                    $this->setDefaultDoc($user, $docInfo['id']);
                }
                return $docInfo['id'];
            }
        }
    }
    
    public function getUserDocuments($user) {
        $response['establishment'] = $this->db->select('id,doc_name')->order_by('id', 'desc')->get_where('user_documents', array('user' => $user, 'doc_type' => '1', 'doc_status' => 'added'))->result_array();
        $response['liability'] = $this->db->select('id,doc_name')->order_by('id', 'desc')->get_where('user_documents', array('user' => $user, 'doc_type' => '2', 'doc_status' => 'added'))->result_array();
        $response['certificate'] = $this->db->select('id,doc_name')->order_by('id', 'desc')->get_where('user_documents', array('user' => $user, 'doc_type' => '3', 'doc_status' => 'added'))->result_array();
        
        return $response;
    }
    
    public function removeDoc($user_id, $doc_id) {
        $this->db->where('user', $user_id);
        $this->db->where('id', $doc_id);
        $this->db->update('user_documents', array('doc_status' => 'removed'));
        return $this->db->affected_rows();
    }
    
    public function setDefaultDoc($user_id, $doc_id) {
        $docInfo = $this->db->select('id,doc_name,doc_type')->get_where('user_documents', array('user' => $user_id, 'id' => $doc_id))->row_array();
        if(!empty($docInfo)){
            if($docInfo['doc_type'] == 1){
                $updateData['establishmentLicence'] = $docInfo['doc_name'];
                $updateData['establishmentLicenseVerified'] = 'Yes';
            }elseif($docInfo['doc_type'] == 2){
                $updateData['liabilityInsurance'] = $docInfo['doc_name'];
                $updateData['liabilityInsuranceVerified'] = 'Yes';
            }elseif($docInfo['doc_type'] == 3){
                $updateData['licenceCopy'] = $docInfo['doc_name'];
                $updateData['licenceCopyVerified'] = 'Yes';
            }
            $updateData['updatedDate'] = time();
            
            return $this->editUser($updateData, $user_id);
        }else{
            return 0;
        }
    }
    
    public function verifiedPhones($user_id, $user_phone) {
        return $this->db->select('distinct(mobileNumber)')->where(array('host' => $user_id, 'mobileNumber !=' => $user_phone, 'numberVerified' => 'Yes', 'status' => 'Active'))->get('spaces')->result_array();
    }
}

?>
