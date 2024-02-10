<?php
class tbl_order_detail_model extends CI_Model
{

    public $tableName;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->tableName = 'tbl_order_detail';
    }

    public function get_detail_bill($id)
    {
        $temp = array();

        $this->db->where('order_no', $id);
        $this->db->from($this->tableName);
        $this->db->join('tbl_product', 'tbl_product.product_code = tbl_order_detail.product_code', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }
}
