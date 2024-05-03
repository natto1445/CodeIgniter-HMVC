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

    public function get_max_data()
    {
        $this->db->select_max('order_id');
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row()->order_id;
        } else {
            return 0;
        }
    }

    public function get_with_order_detail_where($order_no)
    {
        $temp = array();
        $this->db->where("tbl_order.order_no", $order_no);
        $this->db->from($this->tableName);
        $this->db->join('tbl_order_detail', 'tbl_order.order_no = tbl_order_detail.order_no', 'inner');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function insert_data($data)
    {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    public function update_data($id, $data)
    {
        $this->db->where('order_id', $id);
        $this->db->update($this->tableName, $data);
    }

    public function delete_data($id)
    {
        $this->db->where('order_id', $id);
        $this->db->delete($this->tableName);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
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
