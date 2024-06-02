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

    public function get_product_all()
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("tbl_product.status_product", 1);
        $this->db->where("tbl_product.num <= tbl_product.minstock");
        $this->db->join('tbl_type_product', 'tbl_product.code_type = tbl_type_product.code_type', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function get_product_exp()
    {

        $date_now = date("Y/m/d");

        $currentDate = new DateTime();

        $currentDate->modify('+5 months');

        $formattedDate = $currentDate->format('Y-m-d');

        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("tbl_product.status_product", 1);
        $this->db->where("tbl_product.date_exp <= '$formattedDate' OR tbl_product.date_exp <= '$date_now'");
        $this->db->join('tbl_type_product', 'tbl_product.code_type = tbl_type_product.code_type', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

}
