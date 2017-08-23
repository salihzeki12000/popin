<?php

class AdminAmenities extends CI_Model {

    var $table = 'amenities';
    var $select_fields = 'id,amenities_name,establishment_id,amenitiesType,create_date,update_date,status,industry_id';
    var $where_condition = "id!='0'";
    var $column_order = array('id', 'id', 'industry_name', 'establishment_id', 'amenitiesType', 'create_date', 'update_date', 'status', 'industry_id', null); //set column field database for datatable orderable
    var $column_search = array('id', 'industry_name', 'establishment_id', 'amenitiesType', 'create_date', 'update_date', 'status', 'industry_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order 

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
        if (isset($_POST['industry_name']) and $_POST['industry_name'] != '') {
            //$this->db->where('fname="'.($_POST['fname']).'"');
            $this->db->like('industry_name', $_POST['industry_name']);
        }
        if (isset($_POST['industry']) and $_POST['industry'] != '') {
            $this->db->like('industry_id', $_POST['industry']);
        }
        if (isset($_POST['establishment']) and $_POST['establishment'] != '') {
            $this->db->like('establishment_id', $_POST['establishment']);
        }
        if ((!empty($_POST['order_date_from']) and ! empty($_POST['order_date_to']))) {
            $from_date = explode('/', $_POST['order_date_from']);
            $from_date_ymd = strtotime($from_date[2] . '-' . $from_date[1] . '-' . $from_date[0]);
            $to_date = explode('/', $_POST['order_date_to']);
            ;
            $to_date_ymd = strtotime($to_date[2] . '-' . $to_date[1] . '-' . $to_date[0]);
            if ($from_date_ymd <= $to_date_ymd) {
                $this->db->where('create_date >=', $from_date_ymd);
                $this->db->where('create_date <=', $to_date_ymd);
            }
        }
        if ((!empty($_POST['order_date_from_updated']) and ! empty($_POST['order_date_to_updated']))) {
            $from_date = explode('/', $_POST['order_date_from_updated']);
            $from_date_ymd = strtotime($from_date[2] . '-' . $from_date[1] . '-' . $from_date[0]);
            $to_date = explode('/', $_POST['order_date_to_updated']);
            ;
            $to_date_ymd = strtotime($to_date[2] . '-' . $to_date[1] . '-' . $to_date[0]);
            if ($from_date_ymd <= $to_date_ymd) {
                $this->db->where('update_date >=', $from_date_ymd);
                $this->db->where('update_date <=', $to_date_ymd);
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

    public function addAmenities($data) {
        //Insert Query Goes here...
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function deleteAmenitiesValue($amenitiesID) {
        $this->db->where('id', $amenitiesID);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function editAmenities($data) {
        $where = array("id" => $data['id']);
        $this->db->where($where);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function viewAmenities($id) {
        $this->db->select('id,industry_id,amenities_name,amenitiesType,establishment_id,status');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateStatus($id = array(), $status) {
        $affected_rows = '';
        foreach ($id as $id) {
            $wrong = false;
            $where = array("id" => $id);
            $this->db->where($where);
            if ($status == '1' || $status == '2') {
                $data = array("amenitiesType" => $status);
            } else {
                $data = array("status" => $status);
            }
            $this->db->update($this->table, $data);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows < 1) {
                $wrong = true;
            }
        }
        if ($wrong == true) {
            return array("status" => "NOT OK", "message" => "Selected Amenities Status Not Updated Sucessfully");
        } else {
            return array("status" => "OK", "message" => "Selected Amenities Status Updated Successfully");
        }
    }

}

?>
