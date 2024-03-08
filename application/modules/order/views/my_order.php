<?php echo $this->load->view('template/navmain.php'); ?>

<?php
$pic = base_url('public/pic_all/default.png');
?>
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

    #imageContainer {
        width: 150px;
        height: 150px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    #previewImage {
        width: 100%;
        height: auto;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>ออเดอร์</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">รายการออเดอร์ของฉัน</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ออเดอร์ออนไลน์</h5>

                        <table id='myorder_data' class="table" style="font-family: 'Kanit', sans-serif;">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>เลขที่ออเดอร์</th>
                                    <th data-type="date" data-format="DD/MM/YYYY">วันที่ซื้อ</th>
                                    <th>ยอดสั่งซื้อ</th>
                                    <th>ส่วนลด</th>
                                    <th>ใบเสร็จ</th>
                                    <th>เลขพัสดุ</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class='data-myorder'>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="pay_order" tabindex="1">
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
                            <input type="hidden" id="order_id" name="order_id">
                            <input type="hidden" id="order_no" name="order_no">
                            <input type="hidden" id="total" name="total">
                        </div>
                        <div class="col-md-12">
                            <label for="address_order" class="form-label">ที่อยู่ในการจัดส่ง</label>
                            <textarea class="form-control" id="address_order" name="address_order"
                                style="height: 100px;"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="phone_order" class="form-label">เบอร์โทร</label>
                            <input type="text" class="form-control" id="phone_order" name="phone_order">
                        </div>

                        <table id="listbank" class="tabled">
                            <tbody>
                                <?php foreach ($bank_data as $k => $v) { ?>
                                    <tr>
                                        <td style='text-align: center;'><img
                                                src="<?php echo base_url(); ?>public/pic_all/<?= $v['bank_pic'] ?>"
                                                style="width: 60px;"></td>
                                        <td>
                                            <?= $v['bank_code'] ?>
                                        </td>
                                        <td>
                                            <?= $v['bank_owner'] ?>
                                        </td>
                                        <td>
                                            <?= $v['bank_branch'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div id="imageContainer">
                                <img id="previewImage" src="<?= $pic ?>" alt="Image Preview">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="" class="form-label">ยอดเงินที่ต้องชำระ <a id="total_order"></a> บาท</label><br>
                            <label for="slip_order" class="form-label">อัพโหลดสลิปโอนเงิน :</label>
                            <input type="file" id="slip_order" name="slip_order" accept="image/*"
                                onchange="previewpic(event)" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a class="btn btn-success" onclick="confirm_order('confirm_order')">ยืนยันคำสั่งสั่งซื้อ</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show_slip_deli" tabindex="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">สลิปการจัดส่ง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="confirm_order" class="row g-3">

                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div id="imageContainer_deli">
                                <img id="previewImage" src="<?= $pic ?>" alt="Image Preview">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


</main><!-- End #main -->