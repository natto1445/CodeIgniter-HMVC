<?php
defined('BASEPATH') or exit('No direct script access allowed');

class setting extends MY_Controller
{
    public $data = array();

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

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/setting/js/setting_bank.js')
            ->view('setting_bank', $this->data);
    }

    public function save_store()
    {
        $this->setting_lb->_save_store();
    }

}
