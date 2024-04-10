<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('report_lb');

        $this->load->model('tbl_order_model');

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function report_date()
    {
        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_date.js')
            ->view('report_date', $this->data);

    }

    public function report_sale()
    {
        $data_sale = $this->tbl_order_model->get_sale_all();

        $this->data['sale'] = $data_sale;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_sale.js')
            ->view('report_sale', $this->data);
    }

    public function report_customer()
    {
        $data_cus = $this->tbl_order_model->get_customer_all();

        $this->data['customer'] = $data_cus;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_customer.js')
            ->view('report_customer', $this->data);
    }

    public function get_report_date()
    {
        $this->report_lb->_get_report_date();
    }

    public function get_report_sale()
    {
        $this->report_lb->_get_report_sale();
    }

    public function get_report_customer()
    {
        $this->report_lb->_get_report_customer();
    }

}
