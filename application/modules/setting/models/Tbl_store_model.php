<?php
class tbl_store_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_store';
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

    public function get_data()
    {
        $temp = array();

        $this->db->from($this->tableName);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_object();
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
}
