<?php
class tbl_type_product_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_type_product';
    }

    public function get_type_all()
    {
        $temp = array();

        $this->db->select('code_type, name_type');
        $this->db->where('status', 1);
        $this->db->from('tbl_type_product');
        $this->db->order_by('status', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

}
