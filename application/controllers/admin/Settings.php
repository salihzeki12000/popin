<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(ADMIN_DIR . '/adminLogin', 'login');
        $this->login->check_isvalidated();
        $this->adminProfileInfo = $this->login->adminProfileInfo();
        $this->load->model(ADMIN_DIR . '/AdminSettings', 'settings');
        $this->load->model(ADMIN_DIR . '/AdminEstablishment', 'faq_category');
        $this->load->model(ADMIN_DIR . '/AdminIndustry', 'get_industry');
        $this->load->model(ADMIN_DIR . '/AdminAmenities', 'get_amenities');
        $this->load->model(ADMIN_DIR . '/AdminFacilities', 'facilities');
        $this->load->model(ADMIN_DIR . '/AdminPromoCodes', 'promo_codes');
        $this->load->library('form_validation');
    }
    function image_upload($filename, $path = 'site/', $oldImage = '') {
        $return = array();
        $config['upload_path'] = './uploads/' . $path;
        $config['allowed_types'] = 'gif|jpg|png|ico';

        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($filename)) {
            $return = array('error' => $this->upload->display_errors());
            return $return;
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
                    'new_image' => './uploads/' . $path . '/' . $resize[2] . '/' . $upload_data['file_name'],
                    'maintain_ration' => true,
                    'width' => $resize[0],
                    'height' => $resize[1]
                );

                if ($oldImage != '') {
                    //Unlink old images if have
                    @unlink("./uploads/" . $path . "/" . $resize[2] . "/" . $oldImage);
                    @unlink("./uploads/" . $path . "/" . $oldImage);
                }

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //Creating thumbnails code end
            }
            $return = array('error' => '', 'file_name' => $this->upload->data('file_name'));
            return $return;
        }
    }

    public function index() {
        $data = array();
        $data['module_heading'] = 'General and Site Settings';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $data['settings'] = $this->settings->settingInfo();
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SETTINGS . '/index', $data);
        $this->load->view(ADMIN_DIR . '/include/footer', $data);
    }

    public function general_settings() {
        /* echo '<pre>';
          print_r($_POST);
          print_r($_FILES);
          exit; */
        $config = array(
            array(
                'field' => 'siteName',
                'label' => 'Site Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Site Name'
                ),
            ),
            array(
                'field' => 'siteTitle',
                'label' => 'Site Title',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Site Title'
                ),
            ),
            array(
                'field' => 'metaKeyWords',
                'label' => 'Meta KeyWords',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Meta KeyWords'
                ),
            ),
            array(
                'field' => 'metaDescription',
                'label' => 'Meta Description',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Meta Description'
                ),
            ),
            array(
                'field' => 'metaAuthor',
                'label' => 'Meta Author',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Meta Author'
                ),
            ),
            array(
                'field' => 'siteEmail',
                'label' => 'Site Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid Email'
                ),
            )
        );

        if (empty($_FILES['logo']['name']) and $this->input->post('oldLogo') == '') {
            $logoError = array(
                'field' => 'logo',
                'label' => 'Logo',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Upload Logo'
                ),
            );
            array_push($config, $logoError);
        }
        if (empty($_FILES['favicon']['name']) and $this->input->post('oldFavicon') == '') {
            $faviconError = array(
                'field' => 'favicon',
                'label' => 'Favicon',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Upload Favicon'
                ),
            );
            array_push($config, $faviconError);
        }

        /* echo '<pre>';
          print_r($config);
          exit; */



        if (isset($_FILES['logo']) && $_FILES['logo']['name'] != '') {
            $logoResponse = $this->image_upload('logo', 'site/', $this->input->post('oldLogo'));
        }

        if (isset($_FILES['favicon']) && $_FILES['favicon']['name'] != '') {
            $faviconResponse = $this->image_upload('favicon', 'site/', $this->input->post('oldFavicon'));
        }

        /* echo '<pre>';
          print_r($logoResponse);
          print_r($faviconResponse);
          exit; */

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE or $logoResponse['error'] != '' or $faviconResponse['error'] != '') {
            $this->session->set_flashdata('message_notification', validation_errors() . $logoResponse['error'] . $faviconResponse['error']);
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings');
        } else {
            if ($logoResponse['file_name'] != '') {
                $logo = $logoResponse['file_name'];
            } else {
                $logo = $this->input->post('oldLogo');
            }
            if ($faviconResponse['file_name'] != '') {
                $favicon = $faviconResponse['file_name'];
            } else {
                $favicon = $this->input->post('oldFavicon');
            }

            $settingData = array(
                "siteName" => $this->input->post('siteName'),
                "siteTitle" => $this->input->post('siteTitle'),
                "metaKeyWords" => $this->input->post('metaKeyWords'),
                "metaDescription" => $this->input->post('metaDescription'),
                "metaAuthor" => $this->input->post('metaAuthor'),
                "siteNumber" => $this->input->post('siteNumber'),
                "siteEmail" => $this->input->post('siteEmail'),
                "logo" => $logo,
                "favicon" => $favicon
            );
            $response = $this->settings->adminSettingsUpdate($settingData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'General Settings Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings');
            } else {
                $this->session->set_flashdata('message_notification', 'No changes are done.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings');
            }
        }
    }

    public function contact_settings() {

        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'contactAddress',
                'label' => 'Contact Address',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Contact Address'
                ),
            ),
            array(
                'field' => 'contactEmail',
                'label' => 'Contact Email',
                'rules' => 'required|valid_email',
                'errors' => array(
                    'required' => 'Please Enter The Contact Email',
                    'valid_email' => 'Please Enter Valid Contact Email'
                ),
            ),
            array(
                'field' => 'contactNumber',
                'label' => 'Contact Number',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Contact Number'
                ),
            ),
            /*array(
                'field' => 'longitude',
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Longitude'
                ),
            ),
            array(
                'field' => 'latitude',
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Latitude'
                ),
            )*/
        );


        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings');
        } else {
            $settingData = array(
                "contactAddress" => $this->input->post('contactAddress'),
                "contactEmail" => $this->input->post('contactEmail'),
                "contactNumber" => $this->input->post('contactNumber'),
                "longitude" => $this->input->post('longitude'),
                "latitude" => $this->input->post('latitude')
            );
            $response = $this->settings->adminSettingsUpdate($settingData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Contact Settings Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings');
            } else {
                $this->session->set_flashdata('message_notification', 'No changes are done.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings');
            }
        }
    }

    public function emails_settings() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'emailSignature',
                'label' => 'Email Signature',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter Email Signature'
                ),
            ),
            array(
                'field' => 'supportEmail',
                'label' => 'Support Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid Support Email'
                ),
            ),
            array(
                'field' => 'careerEmail',
                'label' => 'Career Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid Career Email'
                ),
            ),
            array(
                'field' => 'fromEmail',
                'label' => 'From Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid From Email'
                ),
            ),
            array(
                'field' => 'replyEmail',
                'label' => 'Reply To Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid Reply To Email'
                ),
            ),
            array(
                'field' => 'noReplyEmail',
                'label' => 'No Reply Email',
                'rules' => 'valid_email',
                'errors' => array(
                    'valid_email' => 'Please Enter Valid No Reply Email'
                ),
            )
        );


        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings');
        } else {
            $settingData = array(
                "emailSignature" => $this->input->post('emailSignature'),
                "supportEmail" => $this->input->post('supportEmail'),
                "careerEmail" => $this->input->post('careerEmail'),
                "fromEmail" => $this->input->post('fromEmail'),
                "replyEmail" => $this->input->post('replyEmail'),
                "noReplyEmail" => $this->input->post('noReplyEmail')
            );
            $response = $this->settings->adminSettingsUpdate($settingData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Email Settings Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings');
            } else {
                $this->session->set_flashdata('message_notification', 'No changes are done.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings');
            }
        }
    }

    public function social_settings() {

        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $config = array(
            array(
                'field' => 'facebookLink',
                'label' => 'Facebook Page Link',
                'rules' => 'valid_url',
                'errors' => array(
                    'valid_url' => 'Please Enter Valid Facebook Page Link'
                ),
            ),
            array(
                'field' => 'instagramLink',
                'label' => 'Instagram Page Link',
                'rules' => 'valid_url',
                'errors' => array(
                    'valid_url' => 'Please Enter Valid Instagram Page Link'
                ),
            ),
            array(
                'field' => 'twitterLink',
                'label' => 'Twitter Page Link',
                'rules' => 'valid_url',
                'errors' => array(
                    'valid_url' => 'Please Enter Valid Twitter Page Link'
                ),
            ),
            array(
                'field' => 'linkedInLink',
                'label' => 'Google Plus Link',
                'rules' => 'valid_url',
                'errors' => array(
                    'valid_url' => 'Please Enter Valid Google Plus Link'
                ),
            ),
            array(
                'field' => 'googlePlusLink',
                'label' => 'LinkedIn Page Link',
                'rules' => 'valid_url',
                'errors' => array(
                    'valid_url' => 'Please Enter Valid LinkedIn Page Link'
                ),
            )
        );


        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings');
        } else {
            $settingData = array(
                "facebookLink" => $this->input->post('facebookLink'),
                "instagramLink" => $this->input->post('instagramLink'),
                "twitterLink" => $this->input->post('twitterLink'),
                "linkedInLink" => $this->input->post('linkedInLink'),
                "googlePlusLink" => $this->input->post('googlePlusLink')
            );
            $response = $this->settings->adminSettingsUpdate($settingData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Social Page Settings Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings');
            } else {
                $this->session->set_flashdata('message_notification', 'No changes are done.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings');
            }
        }
    }

    public function footer() {
        $data = array();
        $data['module_heading'] = 'Footer Static Page Settings';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $data['allStaticPages'] = $this->settings->getAllStaticPages();
        //$data['footerSetting'] = $this->settings->footerStaticPages();

        /* echo  '<pre>';
          //print_r($data['allStaticPages']);
          print_r($data['footerSetting']);
          exit; */

        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SETTINGS . '/footer_settings', $data);
        $this->load->view(ADMIN_DIR . '/include/footer', $data);
    }

    public function footer_settings() {
        /* echo '<pre>';
          print_r($_POST);
          exit; */
        $settingData = array(
            "section" => $this->input->post('section'),
            "page" => implode(',', $this->input->post('pages')),
            "updatedDate" => strtotime(date('Y-m-d H:i:s')),
            "ipAddress" => $this->input->ip_address()
        );
        $response = $this->settings->footerStaticPagesUpdate($settingData);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Footer Static Page Settings Updated Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/settings/footer');
        } else {
            $this->session->set_flashdata('message_notification', 'Footer Static Page Settings Not Updated Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/footer');
        }
    }
    public function establishment_list() {
        $data = array();
        $data['module_heading']   = 'Establishment Type List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SETTINGS . '/establishment_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    
    public function get_all_establishment_list() {
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
            $indurty = getSingleRecord('industry','id',$fc->industry_ID);
            $row[]   = ucfirst($indurty->industry_name);
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
                            <a  href="' . base_url(ADMIN_DIR . '/settings/updateEstablishment/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/settings/deleteEstablishment/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
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
    // Delete establishment type 
    public function deleteEstablishment() {
        $array = $this->uri->uri_to_assoc();
        $establishment = $array['deleteEstablishment'];
        $response = $this->faq_category->deleteEstablishmentType($establishment);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Establishment type has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/settings/establishment_list');
        } else {
            $this->session->set_flashdata('message_notification', 'Establishment type Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/establishment_list');
        }
    }
    public function updateEstablishment() {
        $data = array();
        $data['module_heading'] = 'Edit Establishment';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $establishmentID = $this->uri->segment('4');
        $data['establishment'] = $this->faq_category->viewEstablishment($establishmentID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SETTINGS . '/establishment_edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function update_Establishment() {
        $config = array(
            array(
                'field' => 'industry',
                'label' => 'industry',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Industry'
                ),
            ),
            array(
                'field' => 'name',
                'label' => 'Establishment Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Establishment Name',
                    'min_length' => 'Minimum 3 Characters Long Establishment Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Establishment Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Establishment Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/updateEstablishment/' . $this->input->post('id'));
        } else {

            $establishmentData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description'),
                "industry_ID" => $this->input->post('industry'),
                "id" => $this->input->post('id')
            );
            $response = $this->faq_category->editEstablishment($establishmentData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Establishment Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings/establishment_list/');
            } else {
                $this->session->set_flashdata('message_notification', 'Establishment Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings/updateEstablishment/' . $this->input->post('id'));
            }
        }
    }
      public function add() {
        $data = array();
        $data['module_heading']   = 'Add New Establishment Type';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/' . SETTINGS . '/establishment_add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_Establishment(){
        $config = array(
            array(
                'field' => 'industry',
                'label' => 'industry',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Industry'
                ),
            ),
            array(
                'field' => 'name',
                'label' => 'Establishment Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Establishment Name',
                    'min_length' => 'Minimum 3 Characters Long Establishment Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Establishment Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Establishment type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/settings/add');
        } else {
            $EstablishmentData = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description'),
                "industry_ID" => $this->input->post('industry')
            );
            $response = $this->faq_category->addEstablishment($EstablishmentData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Establishment Type has ben Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings/add');
            } else {
                $this->session->set_flashdata('message_notification', 'Establishment Type Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings/add');
            }
        }
    }
    public function industry_list() {
        $data = array();
        $data['module_heading']   = 'Industry List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/industry/industry_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
      public function get_all_industry_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $response = $this->get_industry->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->get_industry->get_datatables();
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
            $row[] = ucfirst($fc->industry_name);
            $row[] = date(DATE_FORMAT, $fc->create_date);
            $row[] = date(DATE_FORMAT, $fc->update_date);
            if ($fc->status == 'active') {
                $row[] = '<button class="btn btn-success">active</button>';
            } else if ($fc->status == 'inactive') {
                $row[] = '<button class="btn btn-warning">inactive</button>';
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
                            <a  href="' . base_url(ADMIN_DIR . '/Settings/updateIndustry/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/Settings/deleteIndustry/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->get_industry->count_all(),
            "recordsFiltered" => $this->get_industry->count_filtered(),
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
    public function deleteIndustry() {
        $array = $this->uri->uri_to_assoc();
        $indutry    = $array['deleteIndustry'];
        $response = $this->get_industry->deleteindustryValue($indutry);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Industry has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/Settings/industry_list');
        } else {
            $this->session->set_flashdata('message_notification', 'Industry Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/industry_list');
        }
    }
    public function addIndustry() {
        $data = array();
        $data['module_heading']   = 'Add New Industry';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/industry/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_psot_industry(){
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Industry Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Industry Name',
                    'min_length' => 'Minimum 3 Characters Long Industry Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Industry Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Industry type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/Settings/add_psot_industry');
        } else {
            $industryData = array(
                "industry_name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "create_date" => strtotime(date('Y-m-d H:i:s')),
                "update_date" => strtotime(date('Y-m-d H:i:s'))
            );
            $response = $this->get_industry->addSpace($industryData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Industry has ben Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/addIndustry');
            } else {
                $this->session->set_flashdata('message_notification', 'Industry Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/add_psot_industry');
            }
        }
    }
     # Update space 
    public function updateIndustry() {
        $data = array();
        $data['module_heading'] = 'Update Industry';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $industryID = $this->uri->segment('4');
        $data['industry'] = $this->get_industry->viewIndustry($industryID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/industry/edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function update_Industry() {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Industry Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Industry Name',
                    'min_length' => 'Minimum 3 Characters Long Industry Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Industry Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Industry Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/updateIndustry/' . $this->input->post('id'));
        } else {

            $industryData = array(
                "industry_name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "update_date" => strtotime(date('Y-m-d H:i:s')),
                "id" => $this->input->post('id')
            );
            $response = $this->get_industry->editIndustry($industryData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Industry Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/industry_list');
            } else {
                $this->session->set_flashdata('message_notification', 'Industry Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/updateIndustry/'.$this->input->post('id'));
            }
        }
    }
    # AMENITIES CODE START HERE
    public function amenities_list(){
        $data = array();
        $data['module_heading']   = 'Amenities List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/amenities/amenities_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function get_all_amenities_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $response = $this->get_amenities->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->get_amenities->get_datatables();
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
            $indurty       = getSingleRecord('industry','id',$fc->industry_id);
            $establishment = getSingleRecord('establishment_types','id',$fc->establishment_id);
            $row[]   = ucfirst($indurty->industry_name);
            $row[]   = ucfirst($establishment->name);
            $row[]   = ucfirst($fc->amenities_name);
            $row[]   = ($fc->amenitiesType == 1?'<button class="btn btn-danger">Important</button>':'<button class="btn btn-default">Not Important</button>');
            $row[]   = date(DATE_FORMAT, $fc->create_date);
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
                            <a  href="' . base_url(ADMIN_DIR . '/Settings/updateAmenities/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/Settings/deleteAmenities/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->get_amenities->count_all(),
            "recordsFiltered" => $this->get_amenities->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }
     public function addAmenities() {
        $data = array();
        $data['module_heading']   = 'Add New Amenities';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/amenities/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_psot_Amenities(){
        $config = array(
            array(
                'field' => 'industry',
                'label' => 'Industry list',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Industry'
                ),
            ),
            array(
                'field' => 'establishment',
                'label' => 'establishment list',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The establishment type'
                ),
            ),
            array(
                'field' => 'name',
                'label' => 'Amenities Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Amenities Name',
                    'min_length' => 'Minimum 3 Characters Long Amenities Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Amenities Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Amenities type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/Settings/addAmenities');
        } else {
            $amenities = array(
                "amenities_name"   => $this->input->post('name'),
                "status"           => $this->input->post('status'),
                "industry_id"      => $this->input->post('industry'),
                "establishment_id" => $this->input->post('establishment'),
                "amenitiesType"    => $this->input->post('important'),
                "create_date"      => strtotime(date('Y-m-d H:i:s')),
                "update_date"      => strtotime(date('Y-m-d H:i:s'))
            );
            $response = $this->get_amenities->addAmenities($amenities);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Amenities has ben Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/addAmenities');
            } else {
                $this->session->set_flashdata('message_notification', 'Amenities Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/addAmenities');
            }
        }
    }
     // Delete establishment type 
    public function deleteAmenities() {
        $array = $this->uri->uri_to_assoc();
        $amenities    = $array['deleteAmenities'];
        $response = $this->get_amenities->deleteAmenitiesValue($amenities);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Amenities has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/Settings/amenities_list');
        } else {
            $this->session->set_flashdata('message_notification', 'Amenities Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/amenities_list');
        }
    }
    # Update space 
    public function updateAmenities() {
        $data = array();
        $data['module_heading'] = 'Update Amenities';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $amenitiesID = $this->uri->segment('4');
        $data['amenities'] = $this->get_amenities->viewAmenities($amenitiesID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/amenities/edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function update_Amenities() {
        $config = array(
            array(
                'field' => 'industry',
                'label' => 'Industry list',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Industry'
                ),
            ),
            array(
                'field' => 'establishment',
                'label' => 'establishment list',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The establishment type'
                ),
            ),
            array(
                'field' => 'name',
                'label' => 'Amenities Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Amenities Name',
                    'min_length' => 'Minimum 3 Characters Long Amenities Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Amenities Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Amenities type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/updateAmenities/' . $this->input->post('id'));
        } else {

            $amenitiesData = array(
                "amenities_name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "industry_id" => $this->input->post('industry'),
                "establishment_id" => $this->input->post('establishment'),
                "amenitiesType"    => $this->input->post('important'),
                "update_date" => strtotime(date('Y-m-d H:i:s')),
                "id" => $this->input->post('id')
            );
            $response = $this->get_amenities->editAmenities($amenitiesData);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Amenities has ben Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/amenities_list');
            } else {
                $this->session->set_flashdata('message_notification', 'Amenities Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/updateAmenities/'.$this->input->post('id'));
            }
        }
    }
    
    /*public function importAmenities() {
        $this->load->library('PHPExcel');

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("Establishment-Amenities-List.xlsx");

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $industryName = trim($worksheet->getTitle());
            $industryData = array(
                "industry_name" => $industryName,
                "create_date" => strtotime(date('Y-m-d H:i:s')),
                "update_date" => strtotime(date('Y-m-d H:i:s'))
            );
            $industry = $this->get_industry->addSpace($industryData);

            foreach ($worksheet->getColumnIterator() as $column) {
                $columnIndex = $column->getColumnIndex();

                $cellIterator = $column->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                $i = 1;
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell) && !empty(trim($cell->getCalculatedValue()))) {
                        if($cell->getCoordinate() == $columnIndex.'2'){
                            $establishmentName = $cell->getCalculatedValue();
                            $EstablishmentData = array(
                                "name" => $establishmentName,
                                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                                "industry_ID" => $industry
                            );
                            $establishment = $this->faq_category->addEstablishment($EstablishmentData);
                        }
                        if($i >= 3){
                            $amenityName = $cell->getCalculatedValue();
                            
                            $amenities = array(
                                "amenities_name"   => $amenityName,
                                "industry_id"      => $industry,
                                "establishment_id" => $establishment,
                                "amenitiesType"    => '2',
                                "create_date"      => strtotime(date('Y-m-d H:i:s')),
                                "update_date"      => strtotime(date('Y-m-d H:i:s'))
                            );
                            $this->get_amenities->addAmenities($amenities);
                        }
                        //echo '        Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue(), EOL;
                    }
                    $i++;
                }
            }
        }
    }*/
    public function facilities() {
        $data = array();
        $data['module_heading']   = 'Facilities List';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/facilities/facilities_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function get_all_facilities_list() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $response = $this->facilities->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->facilities->get_datatables();
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
            $row[] = ucfirst($fc->name);
            $row[] = date(DATE_FORMAT, $fc->createdDate);
            $row[] = date(DATE_FORMAT, $fc->updatedDate);
            if ($fc->status == 'active') {
                $row[] = '<button class="btn btn-success">active</button>';
            } else if ($fc->status == 'inactive') {
                $row[] = '<button class="btn btn-warning">inactive</button>';
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
                            <a  href="' . base_url(ADMIN_DIR . '/Settings/updateFacilities/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/Settings/deleteFacilities/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->facilities->count_all(),
            "recordsFiltered" => $this->facilities->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }
    public function add_facilities() {
        $data = array();
        $data['module_heading']   = 'Add New Facilities';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/facilities/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_facilitiesPost(){
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Fashletices Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The facilities Name',
                    'min_length' => 'Minimum 3 Characters Long facilities Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long facilities Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The facilities type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', 'danger');
            redirect(ADMIN_DIR . '/settings/add_facilities');
        } else {
            $facilities = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "createdDate" => strtotime(date('Y-m-d H:i:s')),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description')
            );
            $response = $this->facilities->addfacilities($facilities);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Facilities has ben Added Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/settings/add_facilities');
            } else {
                $this->session->set_flashdata('message_notification', 'Facilities Type Not Added Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings/add_facilities');
            }
        }
    }
     # Update space 
    public function updateFacilities() {
        $data = array();
        $data['module_heading'] = 'Update Facilities';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $facilitiesID = $this->uri->segment('4');
        $data['facilities'] = $this->facilities->viewFacilities($facilitiesID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/facilities/edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
     public function update_facilities() {
       $config = array(
            array(
                'field' => 'name',
                'label' => 'Facilities Name',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Facilities Name',
                    'min_length' => 'Minimum 3 Characters Long Facilities Name Is Required',
                    'max_length' => 'Maximum 255 Characters Long Facilities Name Is Required'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Enter The Facilities type Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/facilities/' . $this->input->post('id'));
        } else {

            $facilities = array(
                "name" => $this->input->post('name'),
                "status" => $this->input->post('status'),
                "updatedDate" => strtotime(date('Y-m-d H:i:s')),
                "description" => $this->input->post('description'),
                "id" => $this->input->post('id')
            );
            $response = $this->facilities->editfacilities($facilities);
            if ($response > 0) {
                $this->session->set_flashdata('message_notification', 'Facilities Updated Successfully');
                $this->session->set_flashdata('class', A_SUC);
                redirect(ADMIN_DIR . '/Settings/facilities');
            } else {
                $this->session->set_flashdata('message_notification', 'Facilities Not Updated Successfully');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/Settings/facilities/'.$this->input->post('id'));
            }
        }
    }
         // Delete establishment type 
    public function deleteFacilities() {
        $array      = $this->uri->uri_to_assoc();
        $facilities = $array['deleteFacilities'];
        $response = $this->facilities->deletefacilitiesValue($facilities);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Facilities has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/Settings/facilities');
        } else {
            $this->session->set_flashdata('message_notification', 'Facilities Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/Settings/facilities');
        }
    }
    
    public function promo_codes() {
        $data = array();
        $data['module_heading']   = 'Promo Codes';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/promo_codes/promo_codes_list', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function get_all_promo_codes() {
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $response = $this->promo_codes->updateStatus($_POST['id'], $_REQUEST['customActionName']);
            $status = $response['status'];
            $message = $response['message'];
        }
        $list = $this->promo_codes->get_datatables();
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
            $row[] = trim($fc->code);
            $row[] = $fc->value;
            $row[] = ucfirst($fc->ownerType);
            $row[] = date(DATE_FORMAT, $fc->createdDate);
            if ($fc->status == 'Active') {
                $row[] = '<button class="btn btn-success">active</button>';
            } else if ($fc->status == 'Inactive') {
                $row[] = '<button class="btn btn-warning">inactive</button>';
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
                            <a  href="' . base_url(ADMIN_DIR . '/settings/update_promo_code/' . $fc->id) . '"><i class="fa fa-pencil"></i> Edit</a>
                            </li>
                          <li>
                           <a  href="' . base_url(ADMIN_DIR . '/settings/delete_promo_code/' . $fc->id) . '"><i class="fa fa-trash"></i> Delete</a>
                          </li>
                        </ul>
                    </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->facilities->count_all(),
            "recordsFiltered" => $this->facilities->count_filtered(),
            "data" => $data,
        );
        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {

            $output["customActionStatus"] = $status; // OK for success and NOt OK for fail. pass custom message(useful for getting status of group actions)
            $output["customActionMessage"] = $message; // pass custom message(useful for getting status of group actions)
        }
        //output to json format
        echo json_encode($output);
    }
    public function add_promo_code() {
        $data = array();
        $data['module_heading']   = 'Add New Promo Code';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/promo_codes/add', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function add_promo_code_submit(){
        $config = array(
            array(
                'field' => 'code',
                'label' => 'Promo Code',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Promo Code',
                    'min_length' => 'Minimum 3 Characters Long Promo Code Is Required',
                    'max_length' => 'Maximum 255 Characters Long Promo Code Is Required'
                ),
            ),
            array(
                'field' => 'value',
                'label' => 'Discount',
                'rules' => 'required|integer|greater_than[0]|less_than_equal_to[100]',
                'errors' => array(
                    'required' => 'Please Enter The Promo Code Discount Value'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/add_promo_code');
        } else {
            $isExist = $this->db->get_where('promo_codes', array('code' => trim($this->input->post('code'))))->num_rows();
            if($isExist == 0){
                $promo_codes = array(
                    "code" => trim($this->input->post('code')),
                    "value" => trim($this->input->post('value')),
                    "ownerId" => 1,
                    "createdDate" => time(),
                    "updatedDate" => time()
                );
                $response = $this->promo_codes->add_promo_codes($promo_codes);
                if ($response > 0) {
                    $this->session->set_flashdata('message_notification', 'Promo Code has been Added Successfully');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(ADMIN_DIR . '/settings/add_promo_code');
                } else {
                    $this->session->set_flashdata('message_notification', 'Promo Code Not Added Successfully');
                    $this->session->set_flashdata('class', A_FAIL);
                    redirect(ADMIN_DIR . '/settings/add_promo_code');
                }
            }else{
                $this->session->set_flashdata('message_notification', 'This promo code already exists.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings/add_promo_code');
            }
            
        }
    }
    # Update space 
    public function update_promo_code() {
        $data = array();
        $data['module_heading'] = 'Update Promo Code';
        $data['adminProfileInfo'] = $this->adminProfileInfo;
        $promo_codeID = $this->uri->segment('4');
        $data['promo_code'] = $this->promo_codes->viewPromoCode($promo_codeID);
        $this->load->view(ADMIN_DIR . '/' . INC . '/header', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/left-sidebar', $data);
        $this->load->view(ADMIN_DIR . '/promo_codes/edit', $data);
        $this->load->view(ADMIN_DIR . '/' . INC . '/footer', $data);
    }
    public function update_promo_code_submit() {
       $config = array(
            array(
                'field' => 'code',
                'label' => 'Promo Code',
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => array(
                    'required' => 'Please Enter The Promo Code',
                    'min_length' => 'Minimum 3 Characters Long Promo Code Is Required',
                    'max_length' => 'Maximum 255 Characters Long Promo Code Is Required'
                ),
            ),
            array(
                'field' => 'value',
                'label' => 'Discount',
                'rules' => 'required|integer|greater_than[0]|less_than_equal_to[100]',
                'errors' => array(
                    'required' => 'Please Enter The Promo Code Discount Value'
                ),
            ),
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please Select The Promo Code Status'
                ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_notification', validation_errors());
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/update_promo_code/' . $this->input->post('id'));
        } else {
            $isExist = $this->db->get_where('promo_codes', array('id !=' => $this->input->post('id'),'code' => trim($this->input->post('code'))))->num_rows();
            if($isExist == 0){
                $promo_codes = array(
                    "code" => trim($this->input->post('code')),
                    "value" => trim($this->input->post('value')),
                    "status" => $this->input->post('status'),
                    "ownerId" => 1,
                    "updatedDate" => time(),
                    "id" => $this->input->post('id')
                );
                $response = $this->promo_codes->update_promo_codes($promo_codes);
                if ($response > 0) {
                    $this->session->set_flashdata('message_notification', 'Promo Code Updated Successfully');
                    $this->session->set_flashdata('class', A_SUC);
                    redirect(ADMIN_DIR . '/settings/promo_codes');
                } else {
                    $this->session->set_flashdata('message_notification', 'Promo Code Not Updated Successfully');
                    $this->session->set_flashdata('class', A_FAIL);
                    redirect(ADMIN_DIR . '/settings/update_promo_code/' . $this->input->post('id'));
                }
            }else{
                $this->session->set_flashdata('message_notification', 'This promo code already exists.');
                $this->session->set_flashdata('class', A_FAIL);
                redirect(ADMIN_DIR . '/settings/update_promo_code/' . $this->input->post('id'));
            }
        }
    }
    public function delete_promo_code() {
        $array      = $this->uri->uri_to_assoc();
        $promo_code_id = $array['delete_promo_code'];
        $response = $this->promo_codes->deletePromoCode($promo_code_id);
        if ($response > 0) {
            $this->session->set_flashdata('message_notification', 'Promo Code has ben Deleted Successfully');
            $this->session->set_flashdata('class', A_SUC);
            redirect(ADMIN_DIR . '/settings/promo_codes');
        } else {
            $this->session->set_flashdata('message_notification', 'Promo Code Not Deleted Successfully');
            $this->session->set_flashdata('class', A_FAIL);
            redirect(ADMIN_DIR . '/settings/promo_codes');
        }
    }
}
