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

        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_date.js')
            ->view('report_date', $this->data);

    }

    public function get_report_date_pdf()
    {
        $get = $this->input->get();

        $rec = $this->report_lb->_get_report_date_pdf($get);

        $this->data['arr_rec'] = $rec;
        $this->data['date_start'] = $get['date_start'];
        $this->data['date_end'] = $get['date_end'];

        $this->load->view('report_date_pdf', $this->data);
    }

    public function report_sale()
    {

        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $data_sale = $this->tbl_order_model->get_sale_all();

        $this->data['sale'] = $data_sale;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_sale.js')
            ->view('report_sale', $this->data);
    }

    public function get_report_sale_pdf()
    {
        $get = $this->input->get();

        $rec = $this->report_lb->_get_report_sale_pdf($get);

        $this->data['arr_rec'] = $rec;
        $this->data['date_start'] = $get['date_start'];
        $this->data['date_end'] = $get['date_end'];

        $sale = $this->tbl_order_model->get_person($get['sale']);

        $this->data['sale'] = $sale;

        $this->load->view('report_sale_pdf', $this->data);
    }

    public function report_customer()
    {

        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $data_cus = $this->tbl_order_model->get_customer_all();

        $this->data['customer'] = $data_cus;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_customer.js')
            ->view('report_customer', $this->data);
    }

    public function get_report_customer_pdf()
    {

        $get = $this->input->get();

        $rec = $this->report_lb->_get_report_customer_pdf($get);

        $this->data['arr_rec'] = $rec;
        $this->data['date_start'] = $get['date_start'];
        $this->data['date_end'] = $get['date_end'];

        $customer = $this->tbl_order_model->get_person($get['customer']);

        $this->data['customer'] = $customer;

        $this->load->view('report_customer_pdf', $this->data);
    }

    public function report_minstock()
    {
        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_minstock.js')
            ->view('report_minstock', $this->data);
    }

    public function get_report_minstock_pdf()
    {
        $get = $this->input->get();

        $minstock = $this->report_lb->_get_report_minstock_pdf($get);

        $this->data['minstock'] = $minstock;
        $this->data['date'] = date("d/m/Y");

        $this->load->view('report_minstock_pdf', $this->data);
    }

    public function product_exp()
    {
        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/product_exp.js')
            ->view('product_exp', $this->data);
    }

    public function get_report_product_exp_pdf()
    {
        $get = $this->input->get();

        $minstock = $this->report_lb->_get_report_product_exp_pdf($get);

        $this->data['minstock'] = $minstock;
        $this->data['date'] = date("d/m/Y");

        $this->load->view('report_product_exp_pdf', $this->data);
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

    public function get_report_minstock()
    {
        $this->report_lb->_get_report_minstock();
    }

    public function get_report_product_exp()
    {
        $this->report_lb->_get_report_product_exp();
    }

}
