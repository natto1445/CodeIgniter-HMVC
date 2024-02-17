<?php
class tbl_bank_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_bank';
    }

    public function get_bank_all()
    {
        $temp = array();

        $this->db->where("bank_status", 1);
        $this->db->from($this->tableName);
        $this->db->order_by('bank_status', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }
}
