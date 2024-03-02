<?php
class tbl_user_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_user';
    }

    public function get_personapp_all()
    {
        $temp = array();

        $this->db->from('tbl_user');
        $this->db->where('auth', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }
}
