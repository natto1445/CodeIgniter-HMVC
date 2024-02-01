<?php
class login_lb
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_user_model');
    }

    public function _check_login()
    {
        $usr_name = $this->CI->input->post('usr_name');
        $usr_pass = $this->CI->input->post('usr_pass');

        $rec_data = $this->CI->tbl_user_model->get_data($usr_name, $usr_pass);
        if (empty($rec_data)) {
            echo json_encode(['failed' => true]);
        } else {
            $_SESSION['usr_id'] = $rec_data[0]->usr_id;
            $_SESSION['usr_name'] = $rec_data[0]->usr_name;
            $_SESSION['usr_fname'] = $rec_data[0]->usr_fname;
            $_SESSION['usr_lname'] = $rec_data[0]->usr_lname;
            $_SESSION['usr_mail'] = $rec_data[0]->usr_mail;
            $_SESSION['usr_tel'] = $rec_data[0]->usr_tel;
            $_SESSION['auth'] = $rec_data[0]->auth;

            echo json_encode(['success' => true]);
        }
    }

    public function _register_user()
    {
        $usr_name = $this->CI->input->post('usr_name');
        $usr_fname = $this->CI->input->post('usr_fname');
        $usr_lname = $this->CI->input->post('usr_lname');
        $usr_mail = $this->CI->input->post('usr_mail');
        $usr_tel = $this->CI->input->post('usr_tel');
        $usr_password = $this->CI->input->post('usr_password');
        $usr_password_c = $this->CI->input->post('usr_password_c');

        $max_id = $this->CI->tbl_user_model->get_max_data();
        $newNumber = $max_id + 1;
        $new_id = str_pad($newNumber, 10, '0', STR_PAD_LEFT);

        $data = array(
            "usr_id" => $new_id,
            "usr_name" => $usr_name,
            "usr_fname" => $usr_fname,
            "usr_lname" => $usr_lname,
            "usr_mail" => $usr_mail,
            "usr_tel" => $usr_tel,
            "usr_password" => $usr_password,
            "auth" => "1",
            "date_time_create" => date("Y-m-d H:i:s"),
        );

        $this->CI->tbl_user_model->insert_data($data);

        echo json_encode(['save' => true]);
    }
}
