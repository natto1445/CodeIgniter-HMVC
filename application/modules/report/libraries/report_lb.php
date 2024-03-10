<?php
class report_lb
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_order_model');
    }

    public function _get_report_date()
    {
        $post = $this->CI->input->post();
        // var_dump($post);

        $date_start = $post['date_start'] . " 00:00:00";
        $date_end = $post['date_end'] . " 23:59:59";

        // var_dump($date_start);
        // var_dump($date_end);

        $rec_data = $this->CI->tbl_order_model->report_date($date_start, $date_end);
        // var_dump($rec_data);

        $html = "";
        if (!empty($rec_data)) {

            $i = 1;

            foreach ($rec_data as $key => $value) {
                $html .= "<tr><td>{$i}</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td><td>ไมพบข้อมูล</td></tr>";
                $i++;
            }
        } else {
            $html = "<tr><td colspan='9' style='text-align: center;'>ไมพบข้อมูล</td></tr>";
        }

        echo json_encode(['html' => $html]);
    }

}
