<?php
defined('BASEPATH') or exit('No direct script access allowed');

class order extends MY_Controller
{
    public $data = array();

    public $STATUS = [
        1 => "ยังไม่ชำระ",
        2 => "ชำระแล้ว",
        3 => "ยืนยันออเดอร์",
        4 => "เตรียมสินค้า",
        5 => "จัดส่งแล้ว",
        99 => "สำเร็จ",
        50 => "ยกเลิก",
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('order_lb');

        $this->load->model('tbl_order_model');
        $this->load->model('tbl_order_detail_model');
        $this->load->model('tbl_bank_model');
    }

    public function view_receipt()
    {
        $order_id = $this->input->get('order');

        $order_data = $this->tbl_order_model->get_order_bill($order_id);

        $order_no = isset($order_data[0]->order_no) ? $order_data[0]->order_no : 0;

        $detail_data = $this->tbl_order_detail_model->get_detail_bill($order_no);

        $this->data['status'] = $this->STATUS;
        $this->data['order'] = $order_data;
        $this->data['detail'] = $detail_data;

        $this->load->view('view_receipt', $this->data);
    }

    public function order_front()
    {

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }

        $this->data['status'] = $this->STATUS;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/order/js/order_front.js')
            ->view('order_front', $this->data);
    }

    public function order_back()
    {

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }

        $this->data['status'] = $this->STATUS;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/order/js/order_back.js')
            ->view('order_back', $this->data);
    }

    public function my_order()
    {
        $cart_front = json_decode(get_cookie('cart_front'), true);

        $count = isset($cart_front) ? count($cart_front) : 0;

        $this->data['count_cart_front'] = $count;

        $bank_data = $this->tbl_bank_model->get_bank_all();
        $this->data['bank_data'] = $bank_data;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/order/js/my_order.js')
            ->view('my_order', $this->data);
    }

    public function ajax_load_orderback()
    {
        $this->order_lb->_ajax_load_orderback();
    }

    public function ajax_load_orderfront()
    {
        $this->order_lb->_ajax_load_orderfront();
    }

    public function ajax_load_myorder()
    {
        $this->order_lb->_ajax_load_myorder();
    }

    public function cancel_order_back()
    {
        $this->order_lb->_cancel_order_back();
    }

    public function cancel_order_front()
    {
        $this->order_lb->_cancel_order_front();
    }

    public function ajax_slip_orderfront()
    {
        $this->order_lb->_ajax_slip_orderfront();
    }
}
