<?php
defined('BASEPATH') or exit('No direct script access allowed');

class setting extends MY_Controller
{
    public $data = array();

    public $TYPE = [
        1 => "ใช้งาน",
        2 => "ไม่ใช้งาน",
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('setting_lb');

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function setting_store()
    {
        $store_data = $this->tbl_store_model->get_data();

        $this->data['store_data'] = !empty($store_data) ? $store_data : "";

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/setting/js/setting_store.js')
            ->view('setting_store', $this->data);
    }

    public function setting_bank()
    {
        $this->data['status'] = $this->TYPE;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/setting/js/setting_bank.js')
            ->view('setting_bank', $this->data);
    }

    public function save_store()
    {
        $this->setting_lb->_save_store();
    }

    public function ajax_load_bank()
    {
        $this->setting_lb->_ajax_load_bank();
    }

    public function save_bank()
    {
        $this->setting_lb->_save_bank();
    }

    public function edit_bank()
    {
        $this->setting_lb->_edit_bank();
    }

    public function del_bank()
    {
        $this->setting_lb->_del_bank();
    }

}
