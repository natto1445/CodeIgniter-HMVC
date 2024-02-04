<?php
class storefront_lb
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_product_model');
    }

    public function _get_product_wheretype()
    {
        $post = $this->CI->input->post();
        $rec_data = $this->CI->tbl_product_model->get_product_wheretype($post['type'], $post['order']);

        $html = "";
        if (!empty($rec_data)) {
            foreach ($rec_data as $key => $value) {

                $html .= "<div class='col-xxl-3 col-md-4'>
                            <div class='card'>
                                <img src='https://res-5.cloudinary.com/central-pet-n-me/image/upload/c_lpad,dpr_2.0,f_auto,q_auto/v1/media/catalog/product/2/1/2101011130002-6_1.jpg?_i=AB' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $value['name_product'] . "</h5>
                                    <p class='card-text'>" . $value['detail'] . "</p>
                                    <span class='text-muted small pt-2 ps-1'>จำนวนที่มี </span><span class='text-success small pt-1 fw-bold'>" . $value['num'] . " " . $value['unit'] . "</span>
                                    <span class='text-muted small pt-2 ps-1'>ราคา/ชิ้น </span><span class='text-secondary small pt-1 fw-bold'>" . $value['price'] . " บาท</span><br>
                                    <a style='margin-top: 15px;' class='btn btn-primary btn-sm' onclick='add_cart(" . $value['id_product'] . ")'>หยิบใส่ตะกร้า</a>
                                </div>
                            </div>
                        </div>";
            }
        }

        echo json_encode(['html' => $html]);
    }

    public function _add_cart()
    {
        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['noses' => true]);
        }
    }

}
