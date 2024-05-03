<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class product extends MY_Controller
{
    public $data = array();

    public $TYPE = [
        1 => "ใช้งาน",
        2 => "ไม่ใช้งาน",
        3 => "สินค้าขายดี",
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('product_lb');
        
        $this->load->model('tbl_order_model');

        if (!isset ($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function type_product()
    {

        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;

        $this->data['status'] = $this->TYPE;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/product/js/type_product.js')
            ->view('type_product', $this->data);
    }

    public function products()
    {
        $order = $this->tbl_order_model->get_order_online();
        $this->data['counr_order_online'] = $order;
        
        $this->data['status'] = $this->TYPE;
        $this->data['rec_type'] = $this->tbl_type_product_model->get_type_all();

        // $code = "P000014";

        // $this->load->library('zend'); //load library
        // $this->zend->load('Zend/Barcode'); //load in folder Zend

        //generate barcode
        // $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();

        // imagepng($imageResource, 'barcodes/' . $code . '.png');

        // $this->data['barcode'] = 'barcodes/' . $code . '.png';

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/product/js/products.js')
            ->view('products', $this->data);
    }

    public function get_product_id()
    {
        $this->product_lb->_get_product_id();
    }

    public function add_product()
    {
        $this->product_lb->_add_product();
    }

    public function edit_product()
    {
        $this->product_lb->_edit_product();
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
