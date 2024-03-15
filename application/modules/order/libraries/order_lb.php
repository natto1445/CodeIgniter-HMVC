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
        $this->CI->load->model('tbl_product_model');
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
                $status_order = $data['status_order'];
                $order_no = $data['order_no'];

                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['order_no'] . '</td>';
                $html .= '<td>' . $data['usr_fname'] . " " . $data['usr_lname'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_order'])) . '</td>';
                $html .= '<td>' . $data['total_order'] . '</td>';
                $html .= '<td>' . $data['discount_order'] . '</td>';
                $html .= '<td>' . $this->STATUS[$data['status_order']] . '</td>';
                $html .= '<td><a href=' . base_url() . "order/view_receipt?order=" . $id . ' type="button" target="_blank" class="btn btn-secondary"><i class="bi bi-file-earmark-text"></i></a></td>';

                // สลิปจ่ายเงิน
                if ($data['status_order'] != 1 && $data['status_order'] != 50) {
                    $html .= '<td><a class="btn btn-success"><i onclick="showslip_noline(\'' . $id . '\');" class="bi bi-file-ppt-fill"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }

                // สลิปส่งของ
                if ($data['status_order'] == 99) {
                    $html .= '<td><a class="btn btn-primary"><i onclick="showslip_delivery(\'' . $id . '\');" class="bi bi-box2"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }

                $html .= "<td>
                    <div class='dropdown'>

                    <a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
                        จัดการ
                    </a>

                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <li><a class='dropdown-item' data-id_order='" . $id . "' data-toggle='modal' data-target='#editOrder' onclick='editOrder(this)'>แก้ไข</a></li>";
                if ($status_order > 1) {
                    $html .= "<li><a class='dropdown-item' data-id_order='" . $id . "'  data-status_order='" . $status_order . "' data-order_no='" . $order_no . "' data-toggle='modal' data-target='#statusOrder' onclick='statusOrder(this)'>ปรับสถานะ</a></li>";
                }
                $html .= "<li><a class='dropdown-item' onclick='cancelOrder($id)'>ยกเลิก</a></li>
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

    public function _check_stock()
    {
        $post = $this->CI->input->post();
        $data_order_with_details = $this->CI->tbl_order_model->get_with_order_detail_where($post['order_no']);

        foreach ($data_order_with_details as $key => $value) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($value['product_code']);
            if ($value['num_product'] > $data[0]->num) {
                echo json_encode(['save' => false, 'message' => "สินค้า: " . $value['product_code'] . "ไม่เพียงพอ"]);
                return;
            }
        }

        echo json_encode(['save' => true, 'items' => $data_order_with_details]);
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
                $order_total = $data['total_order'] - $data['discount_order'];

                $html .= '<tr>';
                $html .= '<td>' . $i . '</td>';
                $html .= '<td>' . $data['order_no'] . '</td>';
                $html .= '<td>' . date("Y/m/d", strtotime($data['date_order'])) . '</td>';
                $html .= '<td>' . $data['total_order'] . '</td>';
                $html .= '<td>' . $data['discount_order'] . '</td>';

                // สลิปจ่ายเงิน
                if ($data['status_order'] > 1) {
                    $html .= '<td><a href=' . base_url() . "order/view_receipt?order=" . $id . ' type="button" target="_blank" class="btn btn-secondary"><i class="bi bi-file-earmark-text"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }

                // สลิปส่งของ
                if ($data['status_order'] == 99) {
                    $html .= '<td><a class="btn btn-primary"><i onclick="showslip_delivery(\'' . $id . '\');" class="bi bi-box2"></i></a></td>';
                } else {
                    $html .= '<td></td>';
                }

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

        $address = $order_data[0]->delivery_name . "\n" . $order_data[0]->delivery_address . "\n" . $order_data[0]->delivery_tel;

        $pic = isset($order_data[0]->slip_order) && !empty($order_data[0]->slip_order) ? "<img id='previewImage' src=" . base_url('public/pic_slip/' . $order_data[0]->slip_order) . " alt='Image Preview'>" : "<img id='previewImage' src=" . base_url('public/pic_all/default.png') . " alt='Image Preview'>";

        echo json_encode(['pic' => $pic, 'address' => $address]);
    }

    public function _ajax_slip_orderfront_deli()
    {
        $id = $this->CI->input->post('id');

        $order_data = $this->CI->tbl_order_model->get_slip_delivery($id);

        $pic = isset($order_data[0]->delivery_pic) && !empty($order_data[0]->delivery_pic) ? "<img id='previewImage' src=" . base_url('public/pic_delivery/' . $order_data[0]->delivery_pic) . " alt='Image Preview'>" : "<img id='previewImage' src=" . base_url('public/pic_all/default.png') . " alt='Image Preview'>";

        echo json_encode(['pic' => $pic]);
    }

    public function _update_status_orderfont()
    {
        $post = $this->CI->input->post();

        if ($post['status_order'] == 5) {
            $name_file = "";

            if (!empty($_FILES['slip_deli']['name'])) {

                $config['upload_path'] = './public/pic_delivery/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name'] = 'slip_deli_' . $post['id_order'];

                $this->CI->load->library('upload', $config);
                $this->CI->upload->do_upload('slip_deli');
                $type = explode('.', $_FILES['slip_deli']['name']);

                $name_file = $config['file_name'] . "." . $type[1];
            }

            $data_deli = array(
                "delivery_date" => date("Y-m-d H:i:s"),
                "delivery_send" => $_SESSION['usr_id'],
                "delivery_pic" => $name_file,
                "delivery_status" => 1,
            );

            $this->CI->tbl_order_model->update_order_deli($post['order_no'], $data_deli);

            $post['status_order'] = 99;
        }

        $data = array(
            "status_order" => $post['status_order'],
        );

        $this->CI->tbl_order_model->update_order($post['id_order'], $data);

        echo json_encode(['suc' => true]);
    }
}
