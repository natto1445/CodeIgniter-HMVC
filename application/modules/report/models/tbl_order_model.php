<?php
class tbl_order_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_order';
    }

    public function report_date($start, $end)
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("date_order >=", $start);
        $this->db->where("date_order <=", $end);
        $this->db->where("status_order", 99);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

}
