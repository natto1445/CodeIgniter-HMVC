<?php
class user_lb
{
    public $CI;

    public $AUTH = [
        1 => "ลูกค้า",
        5 => "พนักงาน",
        9 => "ผู้ดูแลระบบ",
    ];

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_user_model');
    }

    public function _ajax_load_user()
    {
        $rec_person = $this->CI->tbl_user_model->get_personapp_all();

        if (!empty($rec_person)) {
            $html = '';
            $i = 1;
            foreach ($rec_person as $data) {

                $id = $data['id'];
                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['usr_fname'] . ' ' . $data['usr_lname'] . '</td>';
                $html .= '<td>' . $data['usr_mail'] . '</td>';
                $html .= '<td>' . $data['usr_tel'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_time_create'])) . '</td>';
                $html .= '<td>' . $this->AUTH[$data['auth']] . '</td>';
                $html .= "<td>
                    <div class='dropdown'>

                        <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
                            จัดการ
                        </a>

                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                            <li><a class='dropdown-item' data-usr_id='" . $data['id'] . "' data-usr_name='" . $data['usr_name'] . "' data-usr_fname='" . $data['usr_fname'] . "' data-usr_lname='" . $data['usr_lname'] . "' data-usr_mail='" . $data['usr_mail'] . "' data-usr_tel='" . $data['usr_tel'] . "' data-auth='" . $data['auth'] . "' data-usr_password='" . $data['usr_password'] . "' data-toggle='modal' data-target='#editType' onclick='editFunction(this)'>แก้ไข</a></li>
                            <li><a class='dropdown-item' onclick='deleteFunction($id)'>ลบ</a></li>
                        </ul>

                    </div>
                </td>";
                $html .= '</tr>';
                $i++;
            }
        } else {
            $html = '';
        }
        echo 'val^' . $html;
    }

    public function _edit_user()
    {
        $post = $this->CI->input->post();

        $data = array(
            "usr_name" => $post['Eusr_name'],
            "usr_fname" => $post['Eusr_fname'],
            "usr_lname" => $post['Eusr_lname'],
            "usr_mail" => $post['Eusr_mail'],
            "usr_tel" => $post['Eusr_tel'],
            "auth" => $post['Eauth'],
        );

        if (isset($post['repass'])) {
            $data = array(
                "usr_name" => $post['Eusr_name'],
                "usr_fname" => $post['Eusr_fname'],
                "usr_lname" => $post['Eusr_lname'],
                "usr_mail" => $post['Eusr_mail'],
                "usr_tel" => $post['Eusr_tel'],
                "auth" => $post['Eauth'],
                "usr_password" => $post['Eusr_password'],
            );
        }

        $this->CI->tbl_user_model->update_data($post['Eusr_id'], $data);

        echo json_encode(['update' => true]);
    }

    public function _del_user()
    {
        $user_id = $this->CI->input->post('user_id');

        $del = $this->CI->tbl_user_model->delete_data($user_id);

        if ($del) {
            echo json_encode(['del' => true]);
        }
    }

}
