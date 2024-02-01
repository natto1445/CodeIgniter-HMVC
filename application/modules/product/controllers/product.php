<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product extends MY_Controller
{
    public $data = array();

    public $TYPE = [
        1 => "ใช้งาน",
        2 => "ไม่ใช้งาน",
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('product_lb');

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function type_product()
    {
        $this->data['status'] = $this->TYPE;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/product/js/type_product.js')
            ->view('type_product', $this->data);
    }

    public function products()
    {
        $this->data['status'] = $this->TYPE;
        $this->data['rec_type'] = $this->tbl_type_product_model->get_type_all();

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/product/js/products.js')
            ->view('products', $this->data);
    }

    public function add_product()
    {
        $this->product_lb->_add_product();
    }

    public function del_product()
    {
        $this->product_lb->_del_product();
    }

    public function ajax_load_type()
    {
        $this->product_lb->_ajax_load_type();
    }

    public function ajax_load_product()
    {
        $this->product_lb->_ajax_load_product();
    }

    public function add_type()
    {
        $this->product_lb->_add_type();
    }

    public function edit_type()
    {
        $this->product_lb->_edit_type();
    }

    public function del_type()
    {
        $this->product_lb->_del_type();
    }
}
