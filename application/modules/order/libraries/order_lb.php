<?php
class order_lb
{
    public $CI;

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
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_order_model');
    }

    public function _ajax_load_orderback()
    {
        $rec_data = $this->CI->tbl_order_model->get_Allorder_back();

        if (!empty($rec_data)) {
            $html = '';
            $i = 1;
            foreach ($rec_data as $data) {

                $id = $data['order_id'];

                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['order_no'] . '</td>';
                $html .= '<td>' . $data['usr_fname'] . " " . $data['usr_lname'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_order'])) . '</td>';
                $html .= '<td>' . $data['total_order'] . '</td>';
                $html .= '<td>' . $data['discount_order'] . '</td>';
                $html .= '<td>' . $this->STATUS[$data['status_order']] . '</td>';
                $html .= '<td><a href=' . base_url() . "order/view_receipt?order=" . $id . ' type="button" target="_blank" class="btn btn-secondary"><i class="bi bi-file-earmark-text"></i></a></td>';
                $html .= "<td>
                    <div class='dropdown'>

                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
                        จัดการ
                    </a>

                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <li><a class='dropdown-item' data-id_order='" . $id . "' data-toggle='modal' data-target='#editOrder' onclick='editOrder(this)'>แก้ไข</a></li>
                        <li><a class='dropdown-item' onclick='cancelOrder($id)'>ยกเลิก</a></li>
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

    public function _ajax_load_orderfront()
    {
        $rec_data = $this->CI->tbl_order_model->get_Allorder_front();

        if (!empty($rec_data)) {
            $html = '';
            $i = 1;
            foreach ($rec_data as $data) {

                $id = $data['order_id'];

                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['order_no'] . '</td>';
                $html .= '<td>' . $data['usr_fname'] . " " . $data['usr_lname'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_order'])) . '</td>';
                $html .= '<td>' . $data['total_order'] . '</td>';
                $html .= '<td>' . $data['discount_order'] . '</td>';
                $html .= '<td>' . $this->STATUS[$data['status_order']] . '</td>';
                $html .= '<td><a href=' . base_url() . "order/view_receipt?order=" . $id . ' type="button" target="_blank" class="btn btn-secondary"><i class="bi bi-file-earmark-text"></i></a></td>';
                if ($data['status_order'] > 1) {
                    $html .= '<td><a class="btn btn-success"><i onclick="showslip_noline(\'' . $id . '\');" class="bi bi-file-ppt-fill"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }
                $html .= "<td>
                    <div class='dropdown'>

                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
                        จัดการ
                    </a>

                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <li><a class='dropdown-item' data-id_order='" . $id . "' data-toggle='modal' data-target='#editOrder' onclick='editOrder(this)'>แก้ไข</a></li>
                        <li><a class='dropdown-item' onclick='cancelOrder($id)'>ยกเลิก</a></li>
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

    public function _ajax_load_myorder()
    {
        $rec_data = $this->CI->tbl_order_model->get_Myorder($_SESSION['usr_id']);

        if (!empty($rec_data)) {
            $html = '';
            $i = 1;
            foreach ($rec_data as $data) {

                $id = $data['order_id'];

                $order_no = $data['order_no'];
                $order_total = $data['total_order'];

                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['order_no'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_order'])) . '</td>';
                $html .= '<td>' . $data['total_order'] . '</td>';
                $html .= '<td>' . $data['discount_order'] . '</td>';
                if ($data['status_order'] > 1) {
                    $html .= '<td><a href=' . base_url() . "order/view_receipt?order=" . $id . ' type="button" target="_blank" class="btn btn-secondary"><i class="bi bi-file-earmark-text"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }
                $html .= '<td></td>';

                if ($data['status_order'] > 1) {
                    $html .= '<td style="text-align: center;">' . $this->STATUS[$data['status_order']] . '</td>';
                } else {
                    $html .= '<td style="text-align: center;"><a onclick="pay_order(\'' . $id . '\',\'' . $order_no . '\',\'' . $order_total . '\');" class="btn btn-success"><i class="bi bi-currency-dollar"></i>ชำระเงิน</a></td>';
                }

                $html .= '</tr>';
                $i++;
            }
        } else {
            $html = '';
        }
        echo 'val^' . $html;
    }

    public function _cancel_order_back()
    {
        $order_id = $this->CI->input->post('order_id');

        $data = array(
            "status_order" => 50,
        );

        $this->CI->tbl_order_model->cancel_order($order_id, $data);

        echo json_encode(['cancel' => true]);
    }

    public function _cancel_order_front()
    {
        $order_id = $this->CI->input->post('order_id');

        $data = array(
            "status_order" => 50,
        );

        $this->CI->tbl_order_model->cancel_order($order_id, $data);

        echo json_encode(['cancel' => true]);
    }

    public function _ajax_slip_orderfront()
    {
        $id = $this->CI->input->post('id');

        $order_data = $this->CI->tbl_order_model->get_order_bill($id);

        $pic = isset($order_data[0]->slip_order) && !empty($order_data[0]->slip_order) ? "<img id='previewImage' src=" . base_url('public/pic_slip/' . $order_data[0]->slip_order) . " alt='Image Preview'>" : "<img id='previewImage' src=" . base_url('public/pic_all/default.png') . " alt='Image Preview'>";

        echo json_encode(['pic' => $pic]);
    }
}
