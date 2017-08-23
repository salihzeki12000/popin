<?php

class AdminTransactions extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $table = 'payments';
    var $select_fields = '*';
    var $where_condition = "payment_id!='0'";
    var $column_order = array('user_id', 'paid_for', 'booking_id', 'txn_id', 'payment_gross', 'payer_email', 'payment_date', 'payment_status'); //set column field database for datatable orderable
    var $column_search = array('payment_id', 'user_id', 'booking_id', 'txn_id', 'paid_for', 'payment_gross', 'currency_code', 'payer_email', 'payment_status', 'payment_date'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('payment_id' => 'DESC'); // default order 

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
        if (isset($_POST['paid_for']) and $_POST['paid_for'] != '') {
            $this->db->where('paid_for="' . $_POST['paid_for'] . '"');
        }
        if (isset($_POST['payment_status']) and $_POST['payment_status'] != '') {
            $this->db->where('payment_status="' . $_POST['payment_status'] . '"');
        }
        
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else{
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
}

?>
