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

    public function get_Allorder_back()
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->join('tbl_user', 'tbl_order.user_order = tbl_user.usr_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function get_order_bill($id)
    {
        $temp = array();

        $this->db->where('order_id', $id);
        $this->db->from($this->tableName);
        $this->db->join('tbl_user', 'tbl_order.user_order = tbl_user.usr_id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $temp;
        }
    }

    public function cancel_order($id, $data)
    {
        $this->db->where('order_id', $id);
        $this->db->update($this->tableName, $data);
    }
}
