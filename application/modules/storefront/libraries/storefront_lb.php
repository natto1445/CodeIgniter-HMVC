<?php
class storefront_lb
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        // $this->CI->load->model('tbl_user_model');
    }

    public function _add_cart()
    {
        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['noses' => true]);
        }
    }

}
