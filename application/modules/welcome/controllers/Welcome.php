<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends MY_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('library_main');

        if (!isset($_SESSION['usr_id']) || $_SESSION['auth'] < 5) {
            redirect('../storefront');
        }
    }

    public function index()
    {
        $this->library_main
            ->setJavascript($this->config->item('petshop') . 'public/welcome/js/index.js')
            ->setStyleSheet($this->config->item('petshop') . 'public/welcome/css/index.css')
            ->view('index', $this->data);
    }
}
