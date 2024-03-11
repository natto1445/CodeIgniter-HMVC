<?php echo $this->load->view('template/navmain.php'); ?>
<style>
    .main_store {
        margin-top: 60px;
        padding: 20px 30px;
        transition: all 0.3s;
    }

    .detail {
        padding: 20px 0 0 0;
        font-size: 14px;
        font-weight: 500;
        color: #012970;
        font-family: "Poppins", sans-serif;
    }
</style>
<main id="" class="main main_store">

    <div class="pagetitle">
        <h1>หน้าร้าน</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">สินค้าทั้งหมด</a></li>
            </ol>
        </nav>
    </div>

    <div class="row" style='margin-bottom: 25px; justify-content: space-between;'>
        <div class="col-lg-4 col-sm-8">
            <select class="form-select" id="type_product" name="type_product" aria-label="Estatus_type">
                <option value="0">--สินค้าทั้งหมด--</option>
                <option value="999">สินค้าขายดี</option>
                <?php for ($i = 0; $i < count($rec_type); $i++) {?>
                    <option value="<?=$rec_type[$i]['code_type']?>"><?=$rec_type[$i]['name_type']?></option>
                <?php }?>
            </select>
        </div>

        <div class="col-lg-2 col-sm-4">
            <select class="form-select" id="orderby" name="orderby" aria-label="Estatus_type">
                <option value="0">เรียงลำดับข้อมูล</option>
                <option value="1">ราคาต่ำ - สูง</option>
                <option value="2">ราคาสูง - ต่ำ</option>
            </select>
        </div>
    </div>

    <section class="section dashboard">
        <div class="row">

            <div class="col-lg-12">
                <div id="list_product" class="row">

                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="viewcartfront" tabindex="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ตะกร้าสินค้าของฉัน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_product" class="row g-3">
                        <table id="detail_cart" class="table table-striped">

                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a class="btn btn-danger" onclick="clear_cart()">ลบข้อมูล</a>
                    <a class="btn btn-warning" onclick="update_cart('add_product')">อัพเดท</a>
                    <a class="btn btn-primary" onclick="save_cart('add_product')">สั่งซื้อ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmorder" tabindex="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการสั่งซื้อ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="confirm_order" class="row g-3">

                        <div class="col-md-12">
                        <label for="name_order" class="form-label">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name_order" name="name_order">
                        </div>
                        <div class="col-md-12">
                        <label for="address_order" class="form-label">ที่อยู่ในการจัดส่ง</label>
                        <textarea class="form-control" id="address_order" name="address_order" style="height: 100px;"></textarea>
                        </div>
                        <div class="col-md-12">
                        <label for="phone_order" class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" id="phone_order" name="phone_order">
                        </div>
                        <div class="col-md-12">
                        <label for="use_point_c" class="form-label">คะแนนที่ใช้</label>
                        <input type="text" class="form-control" id="use_point_c" name="use_point_c" readonly>
                        </div>

                        <table id="listbank" class="tabled">
                            <tbody>
                                <?php foreach ($bank_data as $k => $v) {?>
                                    <tr>
                                        <td style='text-align: center;'><img src="<?php echo base_url(); ?>public/pic_all/<?=$v['bank_pic']?>" style="width: 60px;"></td>
                                        <td><?=$v['bank_code']?></td>
                                        <td><?=$v['bank_owner']?></td>
                                        <td><?=$v['bank_branch']?></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>

                        <div class="col-md-12">
                            <label for="" class="form-label">ยอดเงินที่ต้องชำระ <a id="total_order"></a> บาท</label><br>
                            <label for="slip_order" class="form-label">อัพโหลดสลิปโอนเงิน :</label>
                            <input type="file" id="slip_order" name="slip_order" accept="image/*" onchange="previewpic(event)" required>
                        </div>

                        <div class="col-md-12" style="text-align: center;">
                        <a style='color: red;'>***หากไม่ทำการอัพโหลดสลิป ระบบจะให้อัพโหลดสลิปภายหลังในรายการออเดอร์***</a>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a class="btn btn-primary" onclick="view_cart_c()">ตรวจสอบรายการ</a>
                    <a class="btn btn-success" onclick="confirm_order('confirm_order')">ยืนยันคำสั่งสั่งซื้อ</a>
                </div>
            </div>
        </div>
    </div>
</main>