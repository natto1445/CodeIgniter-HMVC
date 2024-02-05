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

        $this->db->from($this->tableName);
        $this->db->order_by('bank_status', 'ASC');
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
        $this->db->where('bank_id', $id);
        $this->db->update($this->tableName, $data);
    }

    public function delete_data($id)
    {
        $this->db->where('bank_id', $id);
        $this->db->delete($this->tableName);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
