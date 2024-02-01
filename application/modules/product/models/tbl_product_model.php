<?php
class tbl_product_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_product';
    }

    public function get_max_data()
    {
        $this->db->select_max('id');
        $query = $this->db->get($this->tableName);

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }

    public function get_product_all()
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->join('tbl_type_product', 'tbl_product.code_type = tbl_type_product.code_type', 'left');
        // $this->db->order_by('status', 'ASC');
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
        $this->db->where('id', $id);
        $this->db->update($this->tableName, $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->tableName);

        if ($this->db->affected_rows() > 0) {
            return true; // Successfully deleted
        } else {
            return false; // Failed to delete or no matching record found
        }
    }
}
