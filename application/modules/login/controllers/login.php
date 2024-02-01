<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('login_lb');
    }

    public function index()
    {
        if (isset($_SESSION['usr_id'])) {
            redirect('../storefront');
        }

        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/login/js/index.js')
            ->view('login', $this->data);
    }

    public function check()
    {
        $this->login_lb->_check_login();
    }

    public function register()
    {
        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/login/js/index.js')
            ->view('register', $this->data);
    }

    public function register_user()
    {
        $this->login_lb->_register_user();
    }
}
