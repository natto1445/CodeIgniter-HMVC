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
        $this->CI->load->model('tbl_delivery_order_model');
        $this->CI->load->model('tbl_store_model');
        $this->CI->load->model('tbl_user_model');
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
            echo json_encode(['count' => $count]);
        }

    }

    public function _add_cart_back()
    {
        $count = 0;

        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['noses' => true]);
        } else {
            $post = $this->CI->input->post();
            $count = $this->add_to_cart($post['product_code'], 1);
            echo json_encode(['count' => $count]);
        }

    }

    public function _save_cart_back()
    {
        $post = $this->CI->input->post();

        $product_code = $this->CI->input->post('product_code');
        $number = $this->CI->input->post('number');

        $num = 0;
        $total = 0;

        if (!isset($product_code) || count($product_code) == 0) {
            echo json_encode(['no' => true]);
            die();
        }

        for ($i = 0; $i < count($product_code); $i++) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($product_code[$i]);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $number[$i];

            $num += $number[$i];
            $total += $price;
        }

        $data_store = $this->CI->tbl_store_model->get_data();
        $data_user = $this->CI->tbl_user_model->get_person($_SESSION['usr_id']);

        $give_point = $data_store[0]->point > 1 ? floor($total / $data_store[0]->point) : 0;
        $usr_point = isset($data_user[0]['usr_point']) ? $data_user[0]['usr_point'] : 0;
        $sum_point = $give_point + $usr_point;

        $data_point = array(
            "usr_point" => $sum_point,
        );

        $this->CI->tbl_user_model->update_data($post['customer'], $data_point);

        $max_id = $this->CI->tbl_order_model->get_max_data();
        $newNumber = $max_id + 1;
        $new_id = "ODF" . str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        $data = array(
            "order_no" => $new_id,
            "order_type" => 1,
            "user_order" => $_SESSION['usr_id'],
            "customer_order" => $post['customer'],
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

    //<-------------------------------- front หน้าบ้าน -------------------------------->

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

        set_cookie('total_cart_front', $total, time() + 3600);

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

    public function _save_cart_font()
    {
        $product_code = $this->CI->input->post('product_code');
        $number = $this->CI->input->post('number');

        $cart = json_decode(get_cookie('cart_front'), true);

        if (!isset($cart)) {
            echo json_encode(['no' => true]);
            die();
        }

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

        $num = 0;
        $total = 0;

        foreach ($cart as $k => $v) {

            $data = $this->CI->tbl_product_model->get_product_wherecode($k);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $v;

            $num += $v;
            $total += $price;
        }

        set_cookie('total_cart_front', $total, time() + 3600);

        echo json_encode(['setcookie' => true, 'total' => $total]);
    }

    public function _confirm_order()
    {
        $post = $this->CI->input->post();
        $cart = json_decode(get_cookie('cart_front'), true);

        $num = 0;
        $total = 0;

        $name_file = null;
        $status_order = 1;

        if (!isset($_SESSION['usr_id'])) {
            echo json_encode(['nologin' => true]);
            die();
        }

        foreach ($cart as $key => $value) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($key);
            $price = (floatval($data[0]->price) - floatval($data[0]->discount_bath)) * $value;

            $num += $value;
            $total += $price;
        }

        $max_id = $this->CI->tbl_order_model->get_max_data();
        $newNumber = $max_id + 1;
        $new_id = "ODO" . str_pad($newNumber, 7, '0', STR_PAD_LEFT);

        if (!empty($_FILES['slip_order']['name'])) {

            $status_order = 2;

            $config['upload_path'] = './public/pic_slip/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = 'slip_' . date("Ymd") . '_' . $new_id;

            $this->CI->load->library('upload', $config);
            $this->CI->upload->do_upload('slip_order');
            $type = explode('.', $_FILES['slip_order']['name']);

            $name_file = $config['file_name'] . "." . $type[1];

            $data_store = $this->CI->tbl_store_model->get_data();
            $data_user = $this->CI->tbl_user_model->get_person($_SESSION['usr_id']);

            $give_point = $data_store[0]->point > 1 ? floor($total / $data_store[0]->point) : 0;
            $usr_point = isset($data_user[0]['usr_point']) ? $data_user[0]['usr_point'] : 0;
            $sum_point = $give_point + $usr_point;

            $data_point = array(
                "usr_point" => $sum_point,
            );

            $this->CI->tbl_user_model->update_data($_SESSION['usr_id'], $data_point);
        }

        $data = array(
            "order_no" => $new_id,
            "order_type" => 2,
            "user_order" => null,
            "customer_order" => $_SESSION['usr_id'],
            "date_order" => date("Y-m-d H:i:s"),
            "total_order" => $total,
            "discount_order" => 0,
            "slip_order" => $name_file,
            "status_order" => $status_order,
        );

        $this->CI->tbl_order_model->insert_data($data);

        foreach ($cart as $key => $value) {
            $data = $this->CI->tbl_product_model->get_product_wherecode($key);

            $data_detail = array(
                "order_no" => $new_id,
                "product_code" => $key,
                "num_product" => $value,
                "price_product" => $data[0]->price,
                "discount_product" => $data[0]->discount_bath,
                "status_detail" => 1,
            );

            $this->CI->tbl_order_detail_model->insert_data($data_detail);
        }

        $data_deli = array(
            "delivery_order" => $new_id,
            "delivery_tracking" => null,
            "delivery_name" => $post['name_order'],
            "delivery_address" => $post['address_order'],
            "delivery_tel" => $post['phone_order'],
            "delivery_date" => null,
            "delivery_send" => null,
            "delivery_status" => null,
        );

        $this->CI->tbl_delivery_order_model->insert_data($data_deli);

        delete_cookie('cart_front');

        echo json_encode(['save' => true]);

    }

    public function _confirm_order_last()
    {
        $post = $this->CI->input->post();

        $name_file = "";
        $status_order = 2;

        $config['upload_path'] = './public/pic_slip/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = 'slip_' . date("Ymd") . '_' . $post['order_no'];

        $this->CI->load->library('upload', $config);
        $this->CI->upload->do_upload('slip_order');
        $type = explode('.', $_FILES['slip_order']['name']);

        $name_file = $config['file_name'] . "." . $type[1];

        $data_store = $this->CI->tbl_store_model->get_data();
        $data_user = $this->CI->tbl_user_model->get_person($_SESSION['usr_id']);

        $give_point = $data_store[0]->point > 1 ? floor($post['total'] / $data_store[0]->point) : 0;
        $usr_point = isset($data_user[0]['usr_point']) ? $data_user[0]['usr_point'] : 0;
        $sum_point = $give_point + $usr_point;

        $data_point = array(
            "usr_point" => $sum_point,
        );

        $this->CI->tbl_user_model->update_data($_SESSION['usr_id'], $data_point);

        $data = array(
            "slip_order" => $name_file,
            "status_order" => $status_order,
        );

        $this->CI->tbl_order_model->update_data($post['order_id'], $data);

        $data_deli = array(
            "delivery_name" => $post['name_order'],
            "delivery_address" => $post['address_order'],
            "delivery_tel" => $post['phone_order'],
        );

        $this->CI->tbl_delivery_order_model->update_data($post['order_no'], $data_deli);

        echo json_encode(['save' => true]);
    }

    public function _clear_cart_front()
    {
        delete_cookie('cart_front');
        echo json_encode(['clear' => true]);
    }
}
