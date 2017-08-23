<?php

class FrontPage extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getPageDetail($url) {
        $this->db->select('*');
        $this->db->from('static_page');
        $this->db->where('url', $url);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getFaqs() {
        $result = array();
        $faqCategories = $this->db->where('status', 'Active')->get('faq_category')->result();
        foreach ($faqCategories as $faqCategory) {
            $faqs = $this->db->select('id,question,answer')->where(array('category' => $faqCategory->id, 'status' => 'Active'))->get('faq')->result_array();
            $result[$faqCategory->name] = $faqs;
        }
        
        //print_array($result);
        return $result;
    }
    
    public function submitContactRequest($data) {
        $this->db->insert('contact_request', $data);
        return $this->db->insert_id();
    }
}

?>