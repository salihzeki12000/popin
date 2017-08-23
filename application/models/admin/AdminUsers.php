<?php

class AdminUsers extends CI_Model {

    function __construct() {
        parent::__construct();
        $table = 'user';
    }

    var $table = 'user';
    var $select_fields = '*';
    var $where_condition = "id!='0'";
    var $column_order = array('id', 'id', 'firstName', 'lastName', 'avatar', 'email', 'gender', 'phone', 'createdDate', 'updatedDate', 'status', null); //set column field database for datatable orderable
    var $column_search = array('id', 'id', 'firstName', 'lastName', 'avatar', 'email', 'gender', 'phone', 'createdDate', 'updatedDate', 'status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'DESC'); // default order 

    private function get_datatables_query() {
        $this->db->from($this->table);
        $this->db->select($this->select_fields);
        $this->db->where($this->where_condition);
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 

            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        if (isset($_POST['firstName']) and $_POST['firstName'] != '') {
            $this->db->like('firstName', $_POST['firstName']);
        }
        if (isset($_POST['lastName']) and $_POST['lastName'] != '') {
            $this->db->like('lastName', $_POST['lastName']);
        }
        if (isset($_POST['phone']) and $_POST['phone'] != '') {
            $this->db->like('phone', $_POST['phone']);
        }
        if (isset($_POST['email']) and $_POST['email'] != '') {
            $this->db->like('email', $_POST['email']);
        }
        if (isset($_POST['gender']) and $_POST['gender'] != '') {
            $this->db->like('email', $_POST['email']);
        }

        if ((!empty($_POST['order_date_from']) and ! empty($_POST['order_date_to']))) {
            $from_date = explode('/', $_POST['order_date_from']);
            $from_date_ymd = strtotime($from_date[2] . '-' . $from_date[1] . '-' . $from_date[0]);
            $to_date = explode('/', $_POST['order_date_to']);
            ;
            $to_date_ymd = strtotime($to_date[2] . '-' . $to_date[1] . '-' . $to_date[0]);
            if ($from_date_ymd <= $to_date_ymd) {
                $this->db->where('createdDate >=', $from_date_ymd);
                $this->db->where('createdDate <=', $to_date_ymd);
            }
        }
        if ((!empty($_POST['order_date_from_updated']) and ! empty($_POST['order_date_to_updated']))) {
            $from_date = explode('/', $_POST['order_date_from_updated']);
            $from_date_ymd = strtotime($from_date[2] . '-' . $from_date[1] . '-' . $from_date[0]);
            $to_date = explode('/', $_POST['order_date_to_updated']);
            ;
            $to_date_ymd = strtotime($to_date[2] . '-' . $to_date[1] . '-' . $to_date[0]);
            if ($from_date_ymd <= $to_date_ymd) {
                $this->db->where('updatedDate >=', $from_date_ymd);
                $this->db->where('updatedDate <=', $to_date_ymd);
            }
        }
        if (isset($_POST['status']) and $_POST['status'] != '') {
            $this->db->where('status="' . $_POST['status'] . '"');
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables() {
        $this->get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function viewUser($userId) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $userId);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateStatus($id = array(), $status) {
        $affected_rows = '';
        foreach ($id as $id) {
            $wrong = false;
            $where = array("id" => $id);
            $this->db->where($where);
            $data = array("status" => $status);
            $this->db->update($this->table, $data);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows < 1) {
                $wrong = true;
            }
        }
        if ($wrong == true) {
            return array("status" => "NOT OK", "message" => "Selected User's Status Not Updated.");
        } else {
            return array("status" => "OK", "message" => "Selected User's Status Updated Successfully.");
        }
    }

    public function getCards($userId) {
        $this->db->select('*');
        $this->db->from('card_details');
        $this->db->where('user', $userId);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getUnverifiedUsers() {
        $this->db->select('id,firstName,lastName,avatar');
        $this->db->or_group_start();
            $this->db->where('establishmentLicence !=', '');
            $this->db->where('establishmentLicenseVerified', 'No');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('liabilityInsurance !=', '');
            $this->db->where('liabilityInsuranceVerified', 'No');
        $this->db->group_end();
        $this->db->or_group_start();
            $this->db->where('licenceCopy !=', '');
            $this->db->where('licenceCopyVerified', 'No');
        $this->db->group_end();
        $this->db->where('status', 'Active');
        return $this->db->get('user')->result();
    }
}

?>
