<?php
class report_lb
{
    public $CI;

    public $TYPE = [
        1 => "ออเดอร์หน้าร้าน",
        2 => "ออเดอร์ออนไลน์",
    ];

    public $PAY_TYPE = [
        1 => "เงินสด",
        2 => "เงินโอน",
    ];

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_order_model');
        $this->CI->load->model('tbl_order_detail_model');
    }

    public function get_datesoteThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strDay = date("j", strtotime($strDate));
        $strMonth = date("n", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค", "ก.พ", "มี.ค", "เม.ย", "พ.ค", "มิ.ย", "ก.ค", "ส.ค", "ก.ย", "ต.ค", "พ.ย", "ธ.ค");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    public function _get_report_date()
    {
        $post = $this->CI->input->post();

        $date_start = $post['date_start'] . " 00:00:00";
        $date_end = $post['date_end'] . " 23:59:59";

        $rec_data = $this->CI->tbl_order_model->report_date($date_start, $date_end);

        $html = "";
        if (!empty($rec_data)) {

            $i = 1;
            $tt_total = 0;
            $tt_discount = 0;
            $tt_net = 0;

            foreach ($rec_data as $key => $value) {

                $order_no = $value["order_no"];
                $order_type = $this->TYPE[$value["order_type"]];
                $pay_type = $this->PAY_TYPE[$value["pay_type"]];
                $user_order = isset($value["user_order"]) ? $this->CI->tbl_order_model->get_person($value["user_order"]) : "-";
                $customer_order = isset($value["customer_order"]) ? $this->CI->tbl_order_model->get_person($value["customer_order"]) : "-";
                $date_order = $this->get_datesoteThai($value["date_order"]);
                $total_order = $value["total_order"];
                $discount_order = $value["discount_order"];
                $total = number_format($total_order - $discount_order, 2);

                $data_cost_order = $this->CI->tbl_order_detail_model->get_cost_order($value["order_no"]);

                $cost_order = 0;
                foreach ($data_cost_order as $key => $value) {
                    $cost_order += $value['num_product'] * $value['cost_product'];
                }

                $tt_total += $total_order;
                $tt_discount += $discount_order;
                $tt_net += ($total_order - $discount_order);

                $html .= "<tr><td style='text-align: center;'>{$i}</td><td>{$order_no}</td><td>{$order_type}</td><td>{$pay_type}</td><td>{$date_order}</td><td>{$customer_order}</td><td>{$user_order}</td><td>" . number_format($cost_order, 2) . "</td><td>{$total_order}</td><td>{$discount_order}</td><td>{$total}</td></tr>";
                $i++;
            }

            $html .= "<tr><td colspan='7'></td><td style='text-align: center;'><b>รวม</b></td><td><b>" . number_format($tt_total, 2) . "</b></td><td><b>" . number_format($tt_discount, 2) . "</b></td><td><b>" . number_format($tt_net, 2) . "</b></td></tr>";
        } else {
            $html = "<tr><td colspan='11' style='text-align: center;'>ไมพบข้อมูล</td></tr>";
        }

        echo json_encode(['html' => $html]);
    }

    public function _get_report_sale()
    {
        $post = $this->CI->input->post();

        $date_start = $post['date_start'] . " 00:00:00";
        $date_end = $post['date_end'] . " 23:59:59";

        $rec_data = $this->CI->tbl_order_model->report_sale($date_start, $date_end, $post['sale']);

        $html = "";
        if (!empty($rec_data)) {

            $i = 1;
            $tt_total = 0;
            $tt_discount = 0;
            $tt_net = 0;

            foreach ($rec_data as $key => $value) {

                $order_no = $value["order_no"];
                $order_type = $this->TYPE[$value["order_type"]];
                $pay_type = $this->PAY_TYPE[$value["pay_type"]];
                $user_order = isset($value["user_order"]) ? $this->CI->tbl_order_model->get_person($value["user_order"]) : "-";
                $customer_order = isset($value["customer_order"]) ? $this->CI->tbl_order_model->get_person($value["customer_order"]) : "-";
                $date_order = $this->get_datesoteThai($value["date_order"]);
                $total_order = $value["total_order"];
                $discount_order = $value["discount_order"];
                $total = number_format($total_order - $discount_order, 2);

                $data_cost_order = $this->CI->tbl_order_detail_model->get_cost_order($value["order_no"]);

                $cost_order = 0;
                foreach ($data_cost_order as $key => $value) {
                    $cost_order += $value['num_product'] * $value['cost_product'];
                }

                $tt_total += $total_order;
                $tt_discount += $discount_order;
                $tt_net += ($total_order - $discount_order);

                $html .= "<tr><td style='text-align: center;'>{$i}</td><td>{$order_no}</td><td>{$order_type}</td><td>{$pay_type}</td><td>{$date_order}</td><td>{$customer_order}</td><td>{$user_order}</td><td>" . number_format($cost_order, 2) . "</td><td>{$total_order}</td><td>{$discount_order}</td><td>{$total}</td></tr>";
                $i++;
            }

            $html .= "<tr><td colspan='7'></td><td style='text-align: center;'><b>รวม</b></td><td><b>" . number_format($tt_total, 2) . "</b></td><td><b>" . number_format($tt_discount, 2) . "</b></td><td><b>" . number_format($tt_net, 2) . "</b></td></tr>";
        } else {
            $html = "<tr><td colspan='11' style='text-align: center;'>ไมพบข้อมูล</td></tr>";
        }

        echo json_encode(['html' => $html]);
    }

    public function _get_report_customer()
    {
        $post = $this->CI->input->post();

        $date_start = $post['date_start'] . " 00:00:00";
        $date_end = $post['date_end'] . " 23:59:59";

        $rec_data = $this->CI->tbl_order_model->report_customer($date_start, $date_end, $post['customer']);

        $html = "";
        if (!empty($rec_data)) {

            $i = 1;
            $tt_total = 0;
            $tt_discount = 0;
            $tt_net = 0;

            foreach ($rec_data as $key => $value) {

                $order_no = $value["order_no"];
                $order_type = $this->TYPE[$value["order_type"]];
                $pay_type = $this->PAY_TYPE[$value["pay_type"]];
                $user_order = isset($value["user_order"]) ? $this->CI->tbl_order_model->get_person($value["user_order"]) : "-";
                $customer_order = isset($value["customer_order"]) ? $this->CI->tbl_order_model->get_person($value["customer_order"]) : "-";
                $date_order = $this->get_datesoteThai($value["date_order"]);
                $total_order = $value["total_order"];
                $discount_order = $value["discount_order"];
                $total = number_format($total_order - $discount_order, 2);

                $data_cost_order = $this->CI->tbl_order_detail_model->get_cost_order($value["order_no"]);

                $cost_order = 0;
                foreach ($data_cost_order as $key => $value) {
                    $cost_order += $value['num_product'] * $value['cost_product'];
                }

                $tt_total += $total_order;
                $tt_discount += $discount_order;
                $tt_net += ($total_order - $discount_order);

                $html .= "<tr><td style='text-align: center;'>{$i}</td><td>{$order_no}</td><td>{$order_type}</td><td>{$pay_type}</td><td>{$date_order}</td><td>{$customer_order}</td><td>{$user_order}</td><td>" . number_format($cost_order, 2) . "</td><td>{$total_order}</td><td>{$discount_order}</td><td>{$total}</td></tr>";
                $i++;
            }

            $html .= "<tr><td colspan='7'></td><td style='text-align: center;'><b>รวม</b></td><td><b>" . number_format($tt_total, 2) . "</b></td><td><b>" . number_format($tt_discount, 2) . "</b></td><td><b>" . number_format($tt_net, 2) . "</b></td></tr>";
        } else {
            $html = "<tr><td colspan='11' style='text-align: center;'>ไมพบข้อมูล</td></tr>";
        }

        echo json_encode(['html' => $html]);
    }

}
