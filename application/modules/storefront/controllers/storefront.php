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
        $this->load->model('tbl_bank_model');
    }

    public function index()
    {
        $bank_data = $this->tbl_bank_model->get_bank_all();
        $rec_type = $this->tbl_type_product_model->get_type_all();
        $count = count(json_decode(get_cookie('cart_front'), true));

        $this->data['rec_type'] = $rec_type;
        $this->data['bank_data'] = $bank_data;
        $this->data['count_cart_front'] = $count;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/storefront/js/storefront.js')
            ->view('storefront', $this->data);
    }

    public function store()
    {
        $rec_type = $this->tbl_type_product_model->get_type_all();
        $count = count(json_decode(get_cookie('cart'), true));

        $this->data['rec_type'] = $rec_type;
        $this->data['count_cart'] = $count;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/storefront/js/store.js')
            ->view('store', $this->data);
    }

    public function get_product_wheretype()
    {
        $this->storefront_lb->_get_product_wheretype();
    }

    public function add_cart_front()
    {
        $this->storefront_lb->_add_cart_front();
    }

    public function add_cart_back()
    {
        $this->storefront_lb->_add_cart_back();
    }

    public function save_cart_back()
    {
        $this->storefront_lb->_save_cart_back();
    }

    public function delete_cart_back()
    {
        $this->storefront_lb->_delete_cart_back();
    }

    public function update_cart_back()
    {
        $this->storefront_lb->_update_cart_back();
    }

    public function view_cart_back()
    {
        $this->storefront_lb->_view_cart_back();
    }

    public function clear_cart_back()
    {
        $this->storefront_lb->_clear_cart_back();
    }

    //<-------------------------------- front หน้า่บ้าน -------------------------------->

    public function view_cart_front()
    {
        $this->storefront_lb->_view_cart_front();
    }

    public function save_cart_font()
    {
        $this->storefront_lb->_save_cart_font();
    }

    public function confirm_order()
    {
        $this->storefront_lb->_confirm_order();
    }

    public function update_cart_front()
    {
        $this->storefront_lb->_update_cart_front();
    }

    public function delete_cart_front()
    {
        $this->storefront_lb->_delete_cart_front();
    }

    public function clear_cart_front()
    {
        $this->storefront_lb->_clear_cart_front();
    }
}
