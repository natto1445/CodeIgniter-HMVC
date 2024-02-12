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

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function view_receipt()
    {
        $order_id = $this->input->get('order');

        $order_data = $this->tbl_order_model->get_order_bill($order_id);

        $order_no = isset($order_data[0]->order_no) ? $order_data[0]->order_no : 0;

        $detail_data = $this->tbl_order_detail_model->get_detail_bill($order_no);

        // var_dump($order_no);
        // var_dump($detail_data);

        $this->data['status'] = $this->STATUS;
        $this->data['order'] = $order_data;
        $this->data['detail'] = $detail_data;

        $this->load->view('view_receipt', $this->data);
    }

    public function order_front()
    {
        $this->data['status'] = $this->STATUS;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/order/js/order_front.js')
            ->view('order_front', $this->data);
    }

    public function order_back()
    {
        $this->data['status'] = $this->STATUS;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/order/js/order_back.js')
            ->view('order_back', $this->data);
    }

    public function ajax_load_orderback()
    {
        $this->order_lb->_ajax_load_orderback();
    }

    public function cancel_order_back()
    {
        $this->order_lb->_cancel_order_back();
    }
}
