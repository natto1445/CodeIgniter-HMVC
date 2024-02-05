<?php
class setting_lb
{
    public $CI;

    public $TYPE = [
        1 => "ใช้งาน",
        2 => "ไม่ใช้งาน",
    ];

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_store_model');
        $this->CI->load->model('tbl_bank_model');
    }

    public function _save_store()
    {
        $post = $this->CI->input->post();

        $store_data = $this->CI->tbl_store_model->get_data();
        if (empty($store_data)) {

            $data = array(
                "store_code" => $post['store_code'],
                "store_name" => $post['store_name'],
                "store_address" => $post['store_address'],
                "store_logo" => "",
                "store_tel" => $post['store_tel'],
                "date_create" => date("Y-m-d H:i:s"),
                "user_create" => $_SESSION['usr_id'],
            );

            $this->CI->tbl_store_model->insert_data($data);

            echo json_encode(['save' => true]);
        } else {

            $data = array(
                "store_code" => $post['store_code'],
                "store_name" => $post['store_name'],
                "store_address" => $post['store_address'],
                "store_logo" => "",
                "store_tel" => $post['store_tel'],
                "date_create" => date("Y-m-d H:i:s"),
                "user_create" => $_SESSION['usr_id'],
            );

            $this->CI->tbl_store_model->update_data($store_data[0]->id, $data);

            echo json_encode(['save' => true]);
        }
    }

    public function _ajax_load_bank()
    {
        $rec_bank = $this->CI->tbl_bank_model->get_bank_all();

        if (!empty($rec_bank)) {
            $html = '';
            $i = 1;
            foreach ($rec_bank as $data) {

                $id = $data['bank_id'];
                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['bank_code'] . '</td>';
                $html .= '<td>' . $data['bank_name'] . '</td>';
                $html .= '<td>' . $data['bank_branch'] . '</td>';
                $html .= '<td>' . $data['bank_owner'] . '</td>';
                $html .= '<td>' . $this->TYPE[$data['bank_status']] . '</td>';
                $html .= "<td>
                    <div class='dropdown'>

                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
                        จัดการ
                    </a>

                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <li><a class='dropdown-item' data-bank_id='" . $data['bank_id'] . "' data-bank_code='" . $data['bank_code'] . "' data-bank_name='" . $data['bank_name'] . "' data-bank_branch='" . $data['bank_branch'] . "' data-bank_owner='" . $data['bank_owner'] . "' data-bank_status='" . $data['bank_status'] . "' data-toggle='modal' data-target='#editType' onclick='editFunction(this)'>แก้ไข</a></li>
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

    public function _save_bank()
    {
        $post = $this->CI->input->post();

        $data = array(
            "bank_code" => $post['bank_code'],
            "bank_name" => $post['bank_name'],
            "bank_branch" => $post['bank_branch'],
            "bank_owner" => $post['bank_owner'],
            "bank_status" => 1,
            "date_create" => date("Y-m-d H:i:s"),
            "user_create" => $_SESSION['usr_id'],
        );

        $this->CI->tbl_bank_model->insert_data($data);

        echo json_encode(['save' => true]);
    }

    public function _edit_bank()
    {
        $post = $this->CI->input->post();

        $data = array(
            "bank_code" => $post['Ebank_code'],
            "bank_name" => $post['Ebank_name'],
            "bank_branch" => $post['Ebank_branch'],
            "bank_owner" => $post['Ebank_owner'],
            "bank_status" => $post['Ebank_status'],
        );

        $this->CI->tbl_bank_model->update_data($post['Ebank_id'], $data);

        echo json_encode(['update' => true]);
    }

    public function _del_bank()
    {
        $bank_id = $this->CI->input->post('bank_id');

        $del = $this->CI->tbl_bank_model->delete_data($bank_id);

        if ($del) {
            echo json_encode(['del' => true]);
        }
    }

}
