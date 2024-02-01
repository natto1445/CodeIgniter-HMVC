<?php
defined('BASEPATH') or exit('No direct script access allowed');

class storefront extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('storefront_lb');

        $this->load->model('tbl_type_product_model');
    }

    public function index()
    {

        $rec_type = $this->tbl_type_product_model->get_type_all();

        $this->data['rec_type'] = $rec_type;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/storefront/js/storefront.js')
            ->view('storefront', $this->data);
    }

    public function add_cart()
    {
        $this->storefront_lb->_add_cart();
    }
}
