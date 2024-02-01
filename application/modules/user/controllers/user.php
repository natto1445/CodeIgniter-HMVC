<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends MY_Controller
{
    public $data = array();

    public $AUTH = [
        1 => "ลูกค้า",
        5 => "พนักงาน",
        9 => "ผู้ดูแลระบบ",
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_lb');
    }

    public function index()
    {
        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }

        $this->data['auth'] = $this->AUTH;

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/user/js/index.js')
            ->view('index', $this->data);
    }

    public function edit_user()
    {
        $this->user_lb->_edit_user();
    }

    public function del_user()
    {
        $this->user_lb->_del_user();
    }

    public function ajax_load_user()
    {
        $this->user_lb->_ajax_load_user();
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('../storefront');
    }
}
