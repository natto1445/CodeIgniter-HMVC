<?php
class tbl_order_detail_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_order_detail';
    }

    public function get_cost_order($order_no)
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("order_no", $order_no);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

}
