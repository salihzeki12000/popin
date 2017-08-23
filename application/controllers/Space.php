<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Space extends CI_Controller {

    private $no_nav = 1;
    private $head_step_1 = "Step 1: Start with the basics";
    private $head_step_2 = "Step 2: Set the scene";
    private $head_step_3 = "Step 3: Get ready for Professionals";

    public function __construct() {
        parent::__construct();
        $this->load->model(FRONT_DIR . '/FrontUser', 'host');
        $this->load->model(FRONT_DIR . '/FrontUser', 'user');
        $this->load->model(FRONT_DIR . '/FrontSpace', 'space');
    }
    private function restrict_direct_access_steps($step = "", $page = ""){
        if(!$this->session->has_userdata('stepData')){
            redirect("Space");
        }
        if($step != ""){
            $stepData = $this->session->userdata('stepData');
            
            if($page != "" && !isset($stepData[$step][$page])){
                redirect("Space");
            }
            
            if(!isset($stepData[$step])){
                redirect("Space");
            }
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

    public function index() {
        $this->session->unset_userdata('stepData');
        
        $data['no_nav'] = $this->no_nav;
        $data['userProfileInfo'] = $this->user->userProfileInfo();
        
        $this->load->view(FRONT_DIR . '/' . INC . '/header', $data);
        $this->load->view(FRONT_DIR . '/space/new-listing-overview', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function become_a_partner($space_id = '') {
        $header['step_info'] = "";
        $data['hostProfileInfo'] = $this->host->userProfileInfo();

        if (empty($space_id)) {
            $stepData = $this->session->userdata('stepData');
            $space_id = $stepData['id'];
        }
        if (empty($space_id)) {
            redirect('listing');
        }else {
            $host_id = $this->session->userdata('user_id');
            $record = $this->space->get_space_data($space_id, $host_id);
            if(empty($record)){
                redirect('listing');
            }
            $this->session->set_userdata('stepData', $record);
        }
        $stepData = $this->session->userdata('stepData');
        if(empty($stepData)){
            redirect("Space");
        }
        
        //echo "<pre>"; print_r($stepData); echo "</pre>";
        if(strtolower($stepData['status']) == 'active'){
            redirect("manage-listing/".$stepData['id']);
        }
        
        if ($record['step_1_percentage'] == 100 && $record['step_2_percentage'] < 100){
            $view_file = 'become-a-partner-1';
        }elseif ($record['step_1_percentage'] == 100 && $record['step_2_percentage'] == 100 && $record['step_3_percentage'] < 100){
            $view_file = 'become-a-partner-2';
        }elseif ($record['step_1_percentage'] == 100 && $record['step_2_percentage'] == 100 && $record['step_3_percentage'] == 100){
            $view_file = 'become-a-partner-3';
        }else{
            $view_file = 'become-a-partner';
        }

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/' . $view_file, $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function preview_layout($space_id = '') {
        if (empty($space_id)) {
            redirect("Listing/listing");
        }
        $this->load->helper('inflector');
        $data['userProfileInfo'] = $this->host->userProfileInfo();
        

        if (!empty($space_id)) {
            $host_id = $this->session->userdata('user_id');
            $data['preview'] = $this->space->get_space_preview_data($space_id, $host_id);
            if(empty($data['preview'])){
                redirect('listing');
            }
            $data['hostProfileInfo'] = $this->space->hostProfileInfo($data['preview']['host']);
            $industry = $data['preview']['industryTypeId'];
            $establishment = $data['preview']['establishmentTypeId'];
            $data['amenities'] = $this->space->collectAmenities($industry, $establishment);
        }
        //echo "<pre>"; print_r($data); echo "</pre>";exit;
        $data['establishment_types'] = $this->space->getDropdownData('establishment_types');
        $data['space_types'] = $this->space->getDropdownData('space_types');
        $data['facilities'] = $this->space->getDropdownData('facilities');
        $data['cancellation_policies'] = $this->space->getDropdownData('cancellation_policies_master');
        
        $this->load->view(FRONT_DIR . '/include-partner/preview-header');
        $this->load->view(FRONT_DIR . '/space/preview-layout', $data);
    }

    public function establishment() {
        $header['step_info'] = $this->head_step_1;
        $requestData = $this->input->post('start');
        if (!empty($requestData)) {
            $stepData = array('start' => $requestData);
            $this->session->set_userdata('stepData', $stepData);
        } else {
            $stepData = $this->session->userdata('stepData');
        }
        $data['userProfileInfo'] = $this->host->userProfileInfo();
        $data['industries'] = $this->space->getDropdownData('industry');
        $data['establishment_types'] = $this->space->getDropdownData('establishment_types');
        $data['space_types'] = $this->space->getDropdownData('space_types');
        //echo "<pre>"; print_r($stepData); echo "</pre>";exit;
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-2', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function professionals() {   
        $userProfileInfo = $this->host->userProfileInfo();
        $header['step_info'] = $this->head_step_1;
        $stepData = $this->session->userdata('stepData');
        if (!empty($_POST)){
            $requestData = $this->input->post('page1');
        }
        else{
            $requestData = $stepData['step1']['page1'];
        }
        $estabLicenceFile = ''; $liabInsurance = '';
        if(isset($stepData['step1']['page1']['establishmentLicenceFile'])){
            $estabLicenceFile = $stepData['step1']['page1']['establishmentLicenceFile'];
        }else{
            $estabLicenceFile = trim($userProfileInfo->establishmentLicence);
        }
        
        if(isset($stepData['step1']['page1']['liabilityInsurance'])){
            $liabInsurance = $stepData['step1']['page1']['liabilityInsurance'];
        }else{
            $liabInsurance = trim($userProfileInfo->liabilityInsurance);
        }
        
        if(!isset($requestData['establishmentLicence'])){
            $requestData['establishmentLicence'] = trim($userProfileInfo->establishmentLicenceNumber);
        }
        

        if (!empty($requestData)) {
            $stepData['step1']['page1'] = $requestData;
            
            if(empty(trim($stepData['step1']['page1']['establishmentLicence']))){
                $this->session->set_flashdata('errors_3',"Please enter Establishment License Number.");
                redirect('Space/establishment');
            }
            
            if(isset($_FILES['establishmentLicenceFile']) && !empty($_FILES['establishmentLicenceFile']['name'])){
                $establishmentLicenceFile = $this->file_upload('establishmentLicenceFile');
                if ($establishmentLicenceFile['error'] == ''){
                    $stepData['step1']['page1']['establishmentLicenceFile'] = $establishmentLicenceFile['file_name'];
                }else{
                    $this->session->set_flashdata('errors_1',$establishmentLicenceFile['error']);
                    redirect('Space/establishment');
                }
            }else{
                if($estabLicenceFile != ""){
                    $stepData['step1']['page1']['establishmentLicenceFile'] = $estabLicenceFile;
                }else{
                    $this->session->set_flashdata('errors_1',"Please upload Establishment License File");
                    redirect('Space/establishment');
                }                
            }
            if(isset($_FILES['liabilityInsurance']) && !empty($_FILES['liabilityInsurance']['name'])){
                $liabilityInsurance = $this->file_upload('liabilityInsurance');
                if ($liabilityInsurance['error'] == ''){
                    $stepData['step1']['page1']['liabilityInsurance'] = $liabilityInsurance['file_name'];
                }else{
                    $this->session->set_flashdata('errors_2',$liabilityInsurance['error']);
                    redirect('Space/establishment');
                }
            }else{
                if($liabInsurance != ""){
                    $stepData['step1']['page1']['liabilityInsurance'] = $liabInsurance;
                }else{
                    $this->session->set_flashdata('errors_2',"Please upload Liability Insurance File");
                    redirect('Space/establishment');
                }                
            }
            $host_id = $this->session->userdata('user_id');
            if (!isset($stepData['id'])) {
                $insertData = $stepData['step1']['page1'];
                $insertData['host'] = $host_id;

                $stepData['id'] = $this->space->insertData($insertData);
            } else {
                $updateData = $stepData['step1']['page1'];                
                
                $this->space->updateData($updateData,$stepData['id'],$host_id);
            }
            // update user profile for documents
            $profileData = array(
                "updatedDate" => time(),
                "ipAddress" => $this->input->ip_address()
            );
            if($userProfileInfo->establishmentLicenceNumber == ""){
                $profileData['establishmentLicenceNumber'] = trim($stepData['step1']['page1']['establishmentLicence']);
            }
            if($userProfileInfo->establishmentLicence == ""){
                $profileData['establishmentLicence'] = $stepData['step1']['page1']['establishmentLicenceFile'];
            }
            if($userProfileInfo->liabilityInsurance == ""){
                $profileData['liabilityInsurance'] = $stepData['step1']['page1']['liabilityInsurance'];
            }   
            if(count($profileData) > 2){
                $this->space->editHost($profileData, $host_id);
            }
            
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',20);
            $this->session->set_userdata('stepData', $stepData);
        }
        $this->restrict_direct_access_steps('step1', 'page1');
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-3');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }
    
    public function professionals_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            //print_r($_POST);exit;
            $stepData['step1']['page2']['professionalCapacity'] = (int) $this->input->post('professionalCapacity');

            if (isset($stepData['id'])) {
                $updateData = $stepData['step1']['page2'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',30);
            }
        }
        $stepData['steps_completed'] = 2;
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }
    
    public function create_workspace_boxes(){
        $workspaces = $this->space->getDropdownData('space_types');
        $workspaceCount = $this->input->post('workspaces');
        
        $stepData = $this->session->userdata('stepData');
        if(isset($stepData['step1']['page2']['workSpaceDetail']) && !empty($stepData['step1']['page2']['workSpaceDetail'])){
            $workSpaceDetail = json_decode($stepData['step1']['page2']['workSpaceDetail'], TRUE);
        }
        $response = "";
        for($i = 1; $i<=$workspaceCount; $i++){
            $in_common = $common = $space_type = "";
            $button = "Add spaces";
            if(isset($workSpaceDetail["ws{$i}"])){
                $button = "Edit spaces";
                $spaceTypeInfo = $this->space->getDropdownDataRow('space_types', $workSpaceDetail["ws{$i}"]['sp']);
                if(!empty($spaceTypeInfo)){
                    $space_type = $spaceTypeInfo['name'];
                }
            }
            
            if(isset($workSpaceDetail["ws{$i}"]['cm'])){
                $in_common = "checked";
                $common = "In Common Space";
            }
            $response .='<li class="clearfix">
                            <div class="pull-left ws-box">
                                <strong>Workspace '.$i.'</strong>
                                <p class="workspace_type" style="margin-bottom: 5px;">'.$space_type.'</p>
                                <p class="workspace_info">'.$common.'</p>
                            </div>

                            <div class="pull-right">
                                <a class="btn btn-default add_spaces" href="javascript:;">'.$button.'</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="clearfix guest_open">
                                <div class="feild">
                                    <label>Type of workspace</label>
                                    <select class="selectbox" name="workSpaceDetail[ws'.$i.'][sp]"><option value=""></option>';
                                        foreach($workspaces as $v){
                                            $selected = "";
                                            if(isset($workSpaceDetail["ws{$i}"]) && $workSpaceDetail["ws{$i}"]['sp'] == $v['id']){
                                                $selected = "selected";
                                            }
                                            $response .='<option value="'.$v['id'].'" '.$selected.'>'.$v['name'].'</option>';
                                        }
                        $response .='</select>
                                </div>
                                <div class="feild">
                                    <label for="in-common-'.$i.'"><input id="in-common-'.$i.'" type="checkbox" name="workSpaceDetail[ws'.$i.'][cm]" value="1" '.$in_common.'> In common space</label>
                                </div>
                            </div>
                        </li>';
        }
        echo $response;
    }
    
    public function workspace_detail() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST)) {
                //print_r($_POST);exit;
                $stepData['step1']['page2']['workSpaceCount'] = (int) $this->input->post('workSpaceCount');
                $stepData['step1']['page2']['workSpaceDetail'] = json_encode($_POST['workSpaceDetail']);

                if (isset($stepData['id'])) {
                    $updateData = $stepData['step1']['page2'];
                    $host_id = $this->session->userdata('user_id');

                    $this->space->updateData($updateData, $stepData['id'], $host_id);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',40);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step1', 'page2');
        $header['step_info'] = $this->head_step_3;
        $data['workspace_options'] = $this->space->getDropdownData('workspace_options');
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/workspace-detail',$data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function bathrooms() {
        $this->restrict_direct_access_steps('step1', 'page2');
        $header['step_info'] = $this->head_step_1;
        
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-4');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function location() {
        $header['step_info'] = $this->head_step_1;
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            $stepData['step1']['page3']['bathrooms'] = (int) $this->input->post('bathrooms');
            $stepData['step1']['page3']['bathroomADACompliant'] = $this->input->post('bathroomADACompliant');
        }

        if (isset($stepData['id'])) {
            $updateData = $stepData['step1']['page3'];
            $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
            $updateData['ipAddress'] = $this->input->ip_address();
            $host_id = $this->session->userdata('user_id');
            $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
            $this->db->update('spaces', $updateData);
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',60);
        }

        $this->session->set_userdata('stepData', $stepData);
        // echo "<pre>";
        // print_r($stepData);
        // echo "</pre>";
        // exit;
        $this->restrict_direct_access_steps('step1', 'page3');
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-5');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function location_submit() {
        $stepData = $this->session->userdata('stepData');

        $requestData = $this->input->post('page4');
        if (!empty($requestData)) {
            $stepData['step1']['page4'] = $requestData;

            if (isset($stepData['id'])) {
                $updateData = $stepData['step1']['page4'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
            }
        }

        $all_countries = unserialize(ALL_COUNTRY);
        $country = $all_countries[$stepData['step1']['page4']['country']];

        $response = $stepData['step1']['page4'];
        $response['full_address'] = $stepData['step1']['page4']['streetAddress'];
        if (!empty($stepData['step1']['page4']['suiteBuilding'])){
            $response['full_address'] .= ' ' . $stepData['step1']['page4']['suiteBuilding'];
        }
        $response['full_address'] .= ', ' . $stepData['step1']['page4']['city'] . ', ';
        $response['full_address'] .= $stepData['step1']['page4']['state'] . ', ';
        $response['full_address'] .= $stepData['step1']['page4']['zipCode'] . ', ';
        $response['full_address'] .= $country;
        
        $stepData['start']['full_address'] = $response['full_address'];
        
        $this->session->set_userdata('stepData', $stepData);

        echo json_encode($response);
        exit;
    }

    public function geo_location_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            $stepData['step1']['page4']['latitude'] = $this->input->post('latitude');
            $stepData['step1']['page4']['longitude'] = $this->input->post('longitude');

            if (isset($stepData['id'])) {
                $updateData = $stepData['step1']['page4'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',80);
            }
        }

        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function amenities() {
        $this->restrict_direct_access_steps('step1', 'page4');
        $header['step_info'] = $this->head_step_1;
        $stepData = $this->session->userdata('stepData');
        $industry = $stepData['step1']['page1']['industryType'];
        $establishment = $stepData['step1']['page1']['establishmentType'];
        //echo "<pre>";print_r($stepData);echo "</pre>";
        $data['amenities'] = $this->space->collectAmenities($industry, $establishment);
        //echo $this->db->last_query();
        //print_array($data['amenities']);
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-6', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function amenities_submit() {
        $stepData = $this->session->userdata('stepData');
        //print_array($_POST,true);
        if (!empty($_POST['amenities'])) {
            $stepData['step1']['page5']['amenities'] = $this->input->post('amenities');

            if (isset($stepData['id'])) {
                //$updateData = implode(' | ', $stepData['step1']['page5']['amenities']);
                $updateData = json_encode($stepData['step1']['page5']['amenities']);

                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', array('amenities' => $updateData, 'updatedDate' => strtotime(date('Y-m-d H:i:s')), 'ipAddress' => $this->input->ip_address()));
            }
        }else{
            $stepData['step1']['page5']['amenities'] = array();
        }
        $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',90);
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function facilities() {
        $this->restrict_direct_access_steps('step1', 'page5');
        $header['step_info'] = $this->head_step_1;
        $data['facilities'] = $this->space->getDropdownData('facilities');
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-7',$data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function facilities_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST['facilities'])) {
            $stepData['step1']['page6']['facilities'] = $this->input->post('facilities');

            if (isset($stepData['id'])) {
                $updateData = json_encode($stepData['step1']['page6']['facilities']);

                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', array('facilities' => $updateData, 'updatedDate' => strtotime(date('Y-m-d H:i:s')), 'ipAddress' => $this->input->ip_address()));
            }
        }else{
            $stepData['step1']['page6']['facilities'] = array();
        }
        $this->space->setPercentageComplete($stepData['id'],$host_id,'step_1_percentage',100);
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    // Start Step 2
    public function photos() {
        $this->restrict_direct_access_steps('step1');
        $header['step_info'] = $this->head_step_2;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-9');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function ajax_upload_file() {
        $this->load->library('FileUploader');

        // initialize the FileUploader
        $FileUploader = new FileUploader('files', array(
            // Options will go here
            'uploadDir' => FCPATH . 'uploads/user/gallery/',
            'title' => array("photo_{random}", 10)
        ));

        // call to upload the files
        $upload = $FileUploader->upload();

        if ($upload['isSuccess']) {
            // get the uploaded files
            $files = $upload['files'];
        }
        if ($upload['hasWarnings']) {
            // get the warnings
            $warnings = $upload['warnings'];
        };
        $stepData = $this->session->userdata('stepData');
        //unset($stepData['step2']['gallery']);
        if (isset($upload['files'][0]['name']) && !empty($upload['files'][0]['name'])){
            $stepData['step2']['galleryImage'][] = $upload['files'][0]['name'];
        }
        $this->session->set_userdata('stepData', $stepData);

        echo json_encode($upload);
        exit;
    }

    public function ajax_remove_file() {
        $file = $this->input->post('file');
        $stepData = $this->session->userdata('stepData');
        if (isset($stepData['step2']['galleryImage'])) {
            $key = array_search($file, $stepData['step2']['galleryImage']);
            unset($stepData['step2']['galleryImage'][$key]);
        }
        if (isset($stepData['step2']['gallery'])) {
            $key = array_search($file, $stepData['step2']['gallery']);
            unset($stepData['step2']['gallery'][$key]);
            $result = $this->space->remove_gallery_image($stepData['id'], $file);
            $stepData['step2']['gallery'] = $result['gallery'];
            $stepData['step2']['fileuploader'] = $result['fileuploader'];
        }
        $this->session->set_userdata('stepData', $stepData);
        @unlink(FCPATH . 'uploads/user/gallery/' . $file);
    }

    public function gallery_submit() {
        $stepData = $this->session->userdata('stepData');

        if (isset($stepData['id']) && !empty($stepData['step2']['galleryImage'])) {
            $stepData['step2']['gallery'] = $stepData['step2']['galleryImage'];
            $i = 1;
            if(!isset($stepData['step2']['fileuploader'])){
                $fileuploader = array();
            }else{
                $fileuploader = json_decode($stepData['step2']['fileuploader'], TRUE);
            }
            
            foreach ($stepData['step2']['galleryImage'] as $value) {
                $this->db->insert('space_gallery', ['space' => $stepData['id'],
                    'image' => $value,
                    'position' => $i,
                    "createdDate" => strtotime(date('Y-m-d H:i:s')),
                    "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                    "ipAddress" => $this->input->ip_address()
                ]);
                $imageInfo = getimagesize(FCPATH."uploads/user/gallery/".$value);
                
                $image['name'] = $value;
                $image['type'] = $imageInfo['mime'];
                $image['size'] = $imageInfo['bits'];
                $image['file'] = "../uploads/user/gallery/".$value;
                $image['data']['url'] = base_url("uploads/user/gallery/".$value);
                
                array_push($fileuploader, $image);
                $i++;
            }
            $stepData['step2']['fileuploader'] = json_encode($fileuploader);
        }
        unset($stepData['step2']['galleryImage']);
        $host_id = $this->session->userdata('user_id');
        $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',40);
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function description() {        
        $header['step_info'] = $this->head_step_2;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-10');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function description_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            $stepData['step2']['page2'] = $this->input->post('page2');

            if (isset($stepData['id'])) {
                $updateData = $stepData['step2']['page2'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',50);
            }
        }

        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function space_description() {
        $this->restrict_direct_access_steps('step2','page2');
        $header['step_info'] = $this->head_step_2;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-11');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function space_description_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            $stepData['step2']['page3'] = $this->input->post('page3');

            if (isset($stepData['id'])) {
                $updateData = $stepData['step2']['page3'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',60);
            }
        }

        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function title() {
        $this->restrict_direct_access_steps('step2','page3');
        $header['step_info'] = $this->head_step_2;
        $data['hostProfileInfo'] = $this->host->userProfileInfo();

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-12', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function title_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            $stepData['step2']['page4'] = $this->input->post('page4');

            if (isset($stepData['id'])) {
                $updateData = $stepData['step2']['page4'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',70);
            }
        }
        $stepData['steps_completed'] = 2;
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    public function profile_photo() {
        $this->restrict_direct_access_steps('step2','page4');
        $header['step_info'] = $this->head_step_2;
        $data['hostProfileInfo'] = $this->host->userProfileInfo();
        if (!empty($data['hostProfileInfo']->avatar)){
            $stepData = $this->session->userdata('stepData');
            $host_id = $this->session->userdata('user_id');
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',90);
            redirect('Space/verify-phone');
        }

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-13', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function profile_photo_submit() {
        if ($_FILES['avatar']['name'] != '') {
            $config['upload_path'] = './uploads/user/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('avatar')) {
                echo $this->upload->display_errors();
                die();
            } else {
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
                $response = $this->space->editHost($profileData, $this->session->userdata('user_id'));
                if($response){
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
                }
                $stepData = $this->session->userdata('stepData');
                $host_id = $this->session->userdata('user_id');
                $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',90);
            }
        }

        exit;
    }

    public function verify_phone() {
        $header['step_info'] = $this->head_step_2;
        $data['hostProfileInfo'] = $this->host->userProfileInfo();
        /*$stepData = $this->session->userdata('stepData');

        $numberVerified = FALSE;
        if(isset($stepData['step2']['page6']['numberVerified'])){
            if(strtolower($stepData['step2']['page6']['numberVerified']) == 'yes'){
                $numberVerified = TRUE;
            }
        }elseif (trim($data['hostProfileInfo']->phone) != "" && strtolower($data['hostProfileInfo']->phone_verify)=='yes') {
            $numberVerified = TRUE;
        }
        
        if ($numberVerified){
            redirect('Space/become-a-partner/');
        }*/
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-14', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }
    
    public function ajax_verify_phoneNumber(){
        if (!empty($this->session->userdata('user_id'))) {
            //print_array($_POST,TRUE);
            $number = $this->input->post('phone');            
            $code  = generate_unique_code();
                    
            $client = new Twilio\Rest\Client(SID,TOKEN);
            $client->messages->create(
                $number,
                array(
                'from' => '+13237161344',
                'body' => "Verification code is ".$code
                )
            );
            $this->session->set_userdata('verification_code',$code);
            echo 1;
        }else{
            echo 0;
        }
        die();
    }
    public function ajax_verifyCode(){
        if(!isset($_POST['enterCode'])){
            echo 3;
            die();
        }
        $enterValue = $this->input->post('enterCode');
        
        if (!empty($enterValue)) {             
            if ($this->session->userdata('verification_code') == $enterValue) {
               $this->session->unset_userdata('code');
               echo 1;
            }else{
               echo 0;
            }
        }else{
            echo 2;
        }
        die();
    }

    public function phone_submit() {
        $stepData = $this->session->userdata('stepData');

        if (!empty($_POST)) {
            
            if(empty($_POST['country-code'])){
                $country_code = "+1";
            }else{
                $country_code = "+".$_POST['country-code'];
            }
            $stepData['step2']['page6']['mobileNumber'] = $country_code.'-'.$this->input->post('page6')['mobileNumber'];
            $stepData['step2']['page6']['numberVerified'] = 'Yes';
            //print_r($stepData['step2']['page6']);exit;
            if (isset($stepData['id'])) {
                $updateData = $stepData['step2']['page6'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
                
                $userProfileInfo = $this->host->userProfileInfo();
                if($userProfileInfo->phone == "" || $userProfileInfo->phone == $stepData['step2']['page6']['mobileNumber']){
                    $data['phone'] = $stepData['step2']['page6']['mobileNumber'];
                    $data['phone_verify'] = 'yes';
                    $data['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                    $data['ipAddress'] = $this->input->ip_address();
                    $this->space->editHost($data,$host_id);
                }
            }
        }
        $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',100);
        $this->session->set_userdata('stepData', $stepData);
        exit;
    }

    // Start Step 3
    public function professional_requirements() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST['requirements'])) {
                $stepData['step3']['page1']['requirements'] = $this->input->post('requirements');
                $updateData['professionalRequirements'] = implode(',', $stepData['step3']['page1']['requirements']);
            } else {
                $stepData['step3']['page1']['requirements'] = $updateData['professionalRequirements'] = "";
            }

            if (isset($stepData['id'])) {

                $host_id = $this->session->userdata('user_id');
                $this->space->updateData($updateData, $stepData['id'], $host_id);
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',10);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step2','page6');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-16');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function rules() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST)) {
                $stepData['step3']['page2'] = $this->input->post();
                if(isset($stepData['step3']['page2']['additionalRules'])){
                    $stepData['step3']['page2']['additionalRules'] = implode(" | ", $stepData['step3']['page2']['additionalRules']);
                }
                
                //echo "<pre>";print_r($stepData['step3']['page2']);echo "</pre>";exit;
                if (isset($stepData['id'])) {
                    $updateData = $stepData['step3']['page2'];
                    $host_id = $this->session->userdata('user_id');
                    $this->space->updateData($updateData,$stepData['id'],$host_id);
                }
                if(isset($stepData['step3']['page2']['additionalRules'])){
                    $stepData['step3']['page2']['additionalRules'] = explode(" | ", $stepData['step3']['page2']['additionalRules']);
                }
            }
            //echo "<pre>";print_r($stepData['step3']['page2']);echo "</pre>";exit;
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',20);
            $this->session->set_userdata('stepData', $stepData);
            redirect('Space/cleanup-procedures');
        }
        $this->restrict_direct_access_steps('step3','page1');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-17');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function cleanup_procedures() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST['cleanUpProcedures'])) {
                $stepData['step3']['page3']['cleanUpProcedures'] = $this->input->post('cleanUpProcedures');
                $updateData['cleanUpProcedure'] = implode(' | ', $stepData['step3']['page3']['cleanUpProcedures']);
            } else {
                $stepData['step3']['page3']['cleanUpProcedures'] = $updateData['cleanUpProcedure'] = "";
            }

            if (isset($stepData['id'])) {

                $host_id = $this->session->userdata('user_id');
                $this->space->updateData($updateData, $stepData['id'], $host_id);
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',40);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        //$stepData = $this->session->userdata('stepData'); echo "<pre>"; print_r($stepData); echo "</pre>";
        $this->restrict_direct_access_steps('step3','page2');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-18');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function review_professional_requirements() {
        $this->restrict_direct_access_steps('step3','page3');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-19');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function review_how_professional_book() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST)) {
                $stepData['step3']['page4'] = $this->input->post();

                if (isset($stepData['id'])) {
                    $updateData = $stepData['step3']['page4'];
                    $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                    $updateData['ipAddress'] = $this->input->ip_address();
                    $host_id = $this->session->userdata('user_id');
                    $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                    $this->db->update('spaces', $updateData);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',45);
            $this->session->set_userdata('stepData', $stepData);
            redirect('Space/hosting-terms');
        }
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-20');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function hosting_terms() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            $stepData['step3']['acceptHostingTerms'] = isset($_POST['acceptHostingTerms'])?1:0;

            if (isset($stepData['id'])) {
                $updateData['acceptHostingTerms'] = $stepData['step3']['acceptHostingTerms'];
                $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                $updateData['ipAddress'] = $this->input->ip_address();
                $host_id = $this->session->userdata('user_id');
                $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                $this->db->update('spaces', $updateData);
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',50);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','page4');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-21');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function availability_questions() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST)) {
                $stepData['step3']['page5'] = $this->input->post('page5');

                if (isset($stepData['id'])) {
                    $updateData = $stepData['step3']['page5'];
                    $updateData['updatedDate'] = strtotime(date('Y-m-d H:i:s'));
                    $updateData['ipAddress'] = $this->input->ip_address();
                    $host_id = $this->session->userdata('user_id');
                    $this->db->where(array('id' => $stepData['id'], 'host' => $host_id));
                    $this->db->update('spaces', $updateData);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',60);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','acceptHostingTerms');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-22');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function availability_settings() {
        $this->load->helper('html');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');
            //print_array($_POST,true);
            if (isset($_POST['page6']) && !empty($_POST)) {
                $updateData = $this->input->post('page6');
            } else {
                $updateData['minStay'] = (int) $this->input->post('minStay');
                $updateData['maxStay'] = (int) $this->input->post('maxStay');
                $updateData['minStayType'] = $this->input->post('minStayType');
                $updateData['maxStayType'] = $this->input->post('maxStayType');
            }
            if (isset($stepData['id'])) {
                $host_id = $this->session->userdata('user_id');
                $this->space->updateData($updateData, $stepData['id'], $host_id);
            }

            $stepData['step3']['page6'] = $this->space->getSpaceSettings($stepData['id'], $host_id);
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',70);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','page5');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-23');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function calendar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            //print_r($_POST);
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST)) {
                $calendarData = $this->input->post();

                if (isset($stepData['id'])) {

                    $response = $this->space->updateCalendarData($calendarData, $stepData['id']);
                    $stepData['step3']['calendar'] = $response;
                    //print_r($response);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',80);
            $this->session->set_userdata('stepData', $stepData);
            echo "success";
            die();
        }
        $this->restrict_direct_access_steps('step3','page6');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-24');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function price_settings() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST['page7'])) {
                $stepData['step3']['page7'] = $this->input->post('page7');

                if (isset($stepData['id'])) {
                    $updateData = $stepData['step3']['page7'];
                    $host_id = $this->session->userdata('user_id');

                    $this->space->updateData($updateData, $stepData['id'], $host_id);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',90);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','calendar');
        $header['step_info'] = $this->head_step_3;
        $data['hostProfileInfo'] = $this->host->userProfileInfo();
        
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-25', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }
    
    public function cancellation_policy() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST['cancellation_term'])) {
                $stepData['step3']['cancellation_term'] = $this->input->post('cancellation_term');

                if (isset($stepData['id'])) {
                    $updateData['cancellation_term'] = $stepData['step3']['cancellation_term'];
                    $host_id = $this->session->userdata('user_id');

                    $this->space->updateData($updateData, $stepData['id'], $host_id);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',95);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','cancellation_term');
        $header['step_info'] = $this->head_step_3;
        $data['hostProfileInfo'] = $this->host->userProfileInfo();
        $data['cancellation_policies'] = $this->space->getDropdownData('cancellation_policies_master');
        
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/cancellation-policy', $data);
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function additional_pricing() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $stepData = $this->session->userdata('stepData');

            if (!empty($_POST['page8'])) {
                $stepData['step3']['page8'] = $this->input->post('page8');

                if (isset($stepData['id'])) {
                    $updateData = $stepData['step3']['page8'];
                    $host_id = $this->session->userdata('user_id');

                    $this->space->updateData($updateData, $stepData['id'], $host_id);
                }
            }
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_3_percentage',100);
            $this->session->set_userdata('stepData', $stepData);
            die();
        }
        $this->restrict_direct_access_steps('step3','page7');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-26');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function booking_scenarios() {
        $this->restrict_direct_access_steps('step3','page8');
        $this->load->helper('popin');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-27');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function local_laws() {
        $this->restrict_direct_access_steps('step3','page8');
        $header['step_info'] = $this->head_step_3;

        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-28');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }

    public function publish_listing() {
        $stepData = $this->session->userdata('stepData');
        if(strtolower($stepData['status']) == 'active'){
            redirect("listing");
        }
        $this->validate_before_publish();
        $this->load->helper('popin');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if (!empty($_POST['space_id'])) {
                $updateData['status'] = 'Active';
                $space_id   = $this->input->post('space_id');
                $host_id    = $this->session->userdata('user_id');

                $this->space->updateData($updateData, $space_id, $host_id);
                $this->session->unset_userdata('stepData');
                redirect("listing");
            }
        }
        $this->restrict_direct_access_steps('step3','page8');
        $header['step_info'] = $this->head_step_3;
        //$stepData = $this->session->userdata('stepData');
        //echo "<pre>"; print_r($stepData); echo "</pre>";
        $this->load->view(FRONT_DIR . '/include-partner/header', $header);
        $this->load->view(FRONT_DIR . '/space/new-listing-29');
        $this->load->view(FRONT_DIR . '/' . INC . '/footer');
    }
    
    private function validate_before_publish() {
        $stepData = $this->session->userdata('stepData');
        if(!isset($stepData['step2']['gallery']) || empty($stepData['step2']['gallery'])){
            $host_id    = $this->session->userdata('user_id');
            $this->space->setPercentageComplete($stepData['id'],$host_id,'step_2_percentage',60,true);
            $this->session->set_userdata('stepData', $stepData);
            redirect('Space/become-a-partner');
        }
    }
}
