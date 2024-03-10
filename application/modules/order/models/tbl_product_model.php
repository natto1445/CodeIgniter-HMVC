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

    public function get_product_wheretype($type, $order)
    {
        $temp = array();

        if ($type != '0') {
            $this->db->where("tbl_type_product.code_type", $type);
        }

        switch ($order) {
            case '1':
                $this->db->order_by("tbl_product.price", "ASC");
                break;

            case '2':
                $this->db->order_by("tbl_product.price", "DESC");
                break;

            default:
                break;
        }

        $this->db->where("tbl_product.status_product", 1);
        $this->db->from($this->tableName);
        $this->db->join('tbl_type_product', 'tbl_product.code_type = tbl_type_product.code_type', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function get_product_wherecode($code)
    {
        $temp = array();

        $this->db->where("product_code", $code);
        $this->db->from($this->tableName);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_object();
        } else {
            return $temp;
        }
    }

    public function update_data($id, $data)
    {
        $this->db->where('product_code', $id);
        $this->db->update($this->tableName, $data);
    }
}
