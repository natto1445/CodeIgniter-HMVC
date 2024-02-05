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

    public function get_person($code)
    {
        $this->db->where('usr_id', $code);
        $this->db->from('tbl_user');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0]['usr_fname'];
        } else {
            return "";
        }
    }
}
