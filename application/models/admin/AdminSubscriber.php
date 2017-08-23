<?php

class AdminSubscriber extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $table = 'user_subscriptions';
    var $select_fields = '*';
    var $where_condition = "id!='0'";
    var $column_order = array('id', 'user_id', 'subscription_code', 'subscribed_date', 'subscribed_through', 'subscribed_with', 'valid_date'); //set column field database for datatable orderable
    var $column_search = array('id', 'user_id', 'subscription_code', 'subscribed_date', 'subscribed_through', 'subscribed_with', 'valid_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
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
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
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
}

?>
