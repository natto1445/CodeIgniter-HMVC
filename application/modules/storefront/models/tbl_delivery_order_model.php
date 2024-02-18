<?php
class tbl_delivery_order_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_delivery_order';
    }

    public function insert_data($data)
    {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

}
