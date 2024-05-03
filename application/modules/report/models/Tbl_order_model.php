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

    public function report_date($start, $end)
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("date_order >=", $start);
        $this->db->where("date_order <=", $end);
        $this->db->where("status_order", 99);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function report_sale($start, $end, $sale)
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("date_order >=", $start);
        $this->db->where("date_order <=", $end);
        $this->db->where("user_order", $sale);
        $this->db->where("status_order", 99);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function report_customer($start, $end, $customer)
    {
        $temp = array();

        $this->db->from($this->tableName);
        $this->db->where("date_order >=", $start);
        $this->db->where("date_order <=", $end);
        $this->db->where("customer_order", $customer);
        $this->db->where("status_order", 99);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function get_customer_all()
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

    public function get_sale_all()
    {
        $temp = array();

        $this->db->from('tbl_user');
        $this->db->where('auth >', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return $temp;
        }
    }

    public function get_person($code)
    {
        $this->db->where('usr_id', $code);
        $this->db->from('tbl_user');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0]['usr_fname'] . " " . $result[0]['usr_lname'];
        } else {
            return "";
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
