<?php
class storefront_lb
{
    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->database();
        $this->CI->load->model('tbl_product_model');
        $this->CI->load->model('tbl_order_model');
        $this->CI->load->model('tbl_order_detail_model');
    }

    public function _get_product_wheretype()
    {
        $post = $this->CI->input->post();
        $rec_data = $this->CI->tbl_product_model->get_product_wheretype($post['type'], $post['order']);

        $html = "";
        if (!empty($rec_data)) {
            foreach ($rec_data as $key => $value) {

                $product_pic = isset($value['pic_product']) && !empty($value['pic_product']) ? base_url('public/pic_product/' . $value['pic_product']) : base_url('public/pic_all/default.png');
                $product_code = $value['product_code'];

                $html .= "<div class='col-xxl-3 col-md-4'>
                            <div class='card'>
                                <img src='" . $product_pic . "' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $value['name_product'] . "</h5>
                                    <p class='card-text'>" . $value['detail'] . "</p>
                                    <span class='text-muted small pt-2 ps-1'>จำนวนที่มี </span><span class='text-success small pt-1 fw-bold'>" . $value['num'] . " " . $value['unit'] . "</span>
                                    <span class='text-muted small pt-2 ps-1'>ราคา/ชิ้น </span><span class='text-secondary small pt-1 fw-bold'>" . $value['price'] . " บาท</span><br>";
                if ($value['num'] > 0) {
                    $html .= "<a style='margin-top: 15px;' class='btn btn-primary btn-sm' data-product_code='" . $product_code . "' onclick='add_cart(this)'>หยิบใส่ตะกร้า</a>";
                } else {
                    $html .= "<a style='margin-top: 15px;' class='btn btn-danger btn-sm'>สินค้าหมด</a>";
                }
                $html .= "</div>
                            </div>
                        </div>";
            }
        }

        echo json_encode(['html' => $html]);
    }

    public function _add_cart_front()
    {
        $count = 0;

        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['noses' => true]);
        } else {
            $post = $this->CI->input->post();
            $count = $this->add_to_cart_front($post['product_code'], 1);
        }

        echo json_encode(['count' => $count]);
    }

    public function _add_cart_back()
    {
        $count = 0;

        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['noses' => true]);
        } else {
            $post = $this->CI->input->post();
            $count = $this->add_to_cart($post['product_code'], 1);
        }

        echo json_encode(['count' => $count]);
    }

    public function _save_cart_back()
    {
        $post = $this->CI->input->post();

        $product_code = $this->CI->input->post('product_code');
        $number = $this->CI->input->post('number');

        $num = 0;
        $total = 0;

        for ($i = 0; $i < count($product_code); $i++) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($product_code[$i]);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $number[$i];

            $num += $number[$i];
            $total += $price;
        }

        $max_id = $this->CI->tbl_order_model->get_max_data();
        $newNumber = $max_id + 1;
        $new_id = "ODF" . str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        $data = array(
            "order_no" => $new_id,
            "order_type" => 1,
            "user_order" => $_SESSION['usr_id'],
            "customer_order" => null,
            "date_order" => date("Y-m-d H:i:s"),
            "total_order" => $total,
            "discount_order" => $post['discount_last'],
            "status_order" => 99,
        );

        $this->CI->tbl_order_model->insert_data($data);

        for ($i = 0; $i < count($product_code); $i++) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($product_code[$i]);

            $data_detail = array(
                "order_no" => $new_id,
                "product_code" => $product_code[$i],
                "num_product" => $number[$i],
                "price_product" => $data[0]->price,
                "discount_product" => $data[0]->discount_bath,
                "status_detail" => 1,
            );

            $this->CI->tbl_order_detail_model->insert_data($data_detail);
        }

        delete_cookie('cart');

        echo json_encode(['save' => true]);
    }

    public function add_to_cart($product_id, $quantity = 1)
    {
        $cart = json_decode(get_cookie('cart'), true);

        if (!$cart) {
            $cart = array();
        }

        if (array_key_exists($product_id, $cart)) {
            $cart[$product_id] += $quantity;
        } else {
            $cart[$product_id] = $quantity;
        }

        set_cookie('cart', json_encode($cart), time() + 3600);

        $cartCount = count($cart);
        return $cartCount;
    }

    public function add_to_cart_front($product_id, $quantity = 1)
    {
        $cart = json_decode(get_cookie('cart_front'), true);

        if (!$cart) {
            $cart = array();
        }

        if (array_key_exists($product_id, $cart)) {
            $cart[$product_id] += $quantity;
        } else {
            $cart[$product_id] = $quantity;
        }

        set_cookie('cart_front', json_encode($cart), time() + 3600);

        $cartCount = count($cart);
        return $cartCount;
    }

    public function _update_cart_back()
    {
        $product_code = $this->CI->input->post('product_code');
        $number = $this->CI->input->post('number');

        $cart = json_decode(get_cookie('cart'), true);

        for ($i = 0; $i < count($product_code); $i++) {

            if (array_key_exists($product_code[$i], $cart)) {

                if ($number[$i] > 0) {
                    $cart[$product_code[$i]] = $number[$i];
                } else {
                    unset($cart[$product_code[$i]]);
                }
            }
        }

        set_cookie('cart', json_encode($cart), time() + 3600);
        echo json_encode(['update' => true]);
    }

    public function _delete_cart_back()
    {
        $product_code = $this->CI->input->post('product_code');

        $cart = json_decode(get_cookie('cart'), true);
        unset($cart[$product_code]);

        set_cookie('cart', json_encode($cart), time() + 3600);
        echo json_encode(['delete' => true]);
    }

    public function _view_cart_back()
    {
        $cart = json_decode(get_cookie('cart'), true);

        $html = "<thead>
                    <tr>
                    <th scope='col'>ชื่อสินค้า</th>
                    <th scope='col'>ราคา</th>
                    <th scope='col'>ส่วนลด</th>
                    <th scope='col' style='width: 10%;'>จำนวน</th>
                    <th scope='col'>ราคารวม</th>
                    <th scope='col' style='width: 10%;'>ลบ</th>
                    </tr>
                </thead>
                <tbody>";

        $num = 0;
        $total = 0;

        foreach ($cart as $k => $v) {

            $data = $this->CI->tbl_product_model->get_product_wherecode($k);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $v;

            $html .= "<tr><td>" . $data[0]->name_product . "</td><td>" . $data[0]->price . "</td><td>" . $data[0]->discount_bath . "</td><td><input type='hidden' id='product_code' name='product_code[]' value='" . $k . "'><input type='number' class='form-control' id='number' name='number[]' value='" . $v . "' step='1'></td><td>" . number_format($price) . "</td><td><a class='btn btn-danger btn-sm' data-product_code='" . $k . "' onclick='delete_cart(this)'>x</a></tr>";
            $num += $v;
            $total += $price;
        }

        $html .= "<tr><td colspan='4'>รวมสินค้า</td><td>" . $num . "</td><td>" . number_format($total) . "</td></tr></tbody>";

        echo json_encode(['html' => $html]);
    }

    public function _clear_cart_back()
    {
        delete_cookie('cart');
        echo json_encode(['clear' => true]);
    }

    //<-------------------------------- front หน้า่บ้าน -------------------------------->

    public function _view_cart_front()
    {
        $cart = json_decode(get_cookie('cart_front'), true);

        $html = "<thead>
                    <tr>
                    <th scope='col'>ชื่อสินค้า</th>
                    <th scope='col'>ราคา</th>
                    <th scope='col'>ส่วนลด</th>
                    <th scope='col' style='width: 10%;'>จำนวน</th>
                    <th scope='col'>ราคารวม</th>
                    <th scope='col' style='width: 10%;'>ลบ</th>
                    </tr>
                </thead>
                <tbody>";

        $num = 0;
        $total = 0;

        foreach ($cart as $k => $v) {

            $data = $this->CI->tbl_product_model->get_product_wherecode($k);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $v;

            $html .= "<tr><td>" . $data[0]->name_product . "</td><td>" . $data[0]->price . "</td><td>" . $data[0]->discount_bath . "</td><td><input type='hidden' id='product_code' name='product_code[]' value='" . $k . "'><input type='number' class='form-control' id='number' name='number[]' value='" . $v . "' step='1'></td><td>" . number_format($price) . "</td><td><a class='btn btn-danger btn-sm' data-product_code='" . $k . "' onclick='delete_cart(this)'>x</a></tr>";
            $num += $v;
            $total += $price;
        }

        $html .= "<tr><td colspan='4'>รวมสินค้า</td><td>" . $num . "</td><td>" . number_format($total) . "</td></tr></tbody>";

        echo json_encode(['html' => $html]);
    }

    public function _delete_cart_front()
    {
        $product_code = $this->CI->input->post('product_code');

        $cart = json_decode(get_cookie('cart_front'), true);
        unset($cart[$product_code]);

        set_cookie('cart_front', json_encode($cart), time() + 3600);
        echo json_encode(['delete' => true]);
    }

    public function _update_cart_front()
    {
        $product_code = $this->CI->input->post('product_code');
        $number = $this->CI->input->post('number');

        $cart = json_decode(get_cookie('cart_front'), true);

        for ($i = 0; $i < count($product_code); $i++) {

            if (array_key_exists($product_code[$i], $cart)) {

                if ($number[$i] > 0) {
                    $cart[$product_code[$i]] = $number[$i];
                } else {
                    unset($cart[$product_code[$i]]);
                }
            }
        }

        set_cookie('cart_front', json_encode($cart), time() + 3600);
        echo json_encode(['update' => true]);
    }

    public function _clear_cart_front()
    {
        delete_cookie('cart_front');
        echo json_encode(['clear' => true]);
    }
}
