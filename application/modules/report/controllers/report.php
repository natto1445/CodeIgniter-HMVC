<?php
defined('BASEPATH') or exit('No direct script access allowed');

class report extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('report_lb');

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function report_date()
    {

        // $this->data['status'] = $this->TYPE;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/report/js/report_date.js')
            ->view('report_date', $this->data);

    }

    public function report_sale()
    {
        $this->library_main
            // ->setJavascript($this->config->item('petshop') . 'public/product/js/type_product.js')
            ->view('report_sale', $this->data);
    }

    public function report_customer()
    {
        $this->library_main
            // ->setJavascript($this->config->item('petshop') . 'public/product/js/type_product.js')
            ->view('report_customer', $this->data);
    }

    public function get_report_date()
    {
        $this->report_lb->_get_report_date();
    }

}
