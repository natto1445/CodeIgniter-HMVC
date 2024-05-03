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

    public function get_order_online()
    {
        $this->db->select('*');
        $this->db->where('order_type', 2);
        $this->db->where('status_order', 2);
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
