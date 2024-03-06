<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

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
<main id="main" class="main main_store">

    <div class="pagetitle">
        <h1>หน้าร้าน</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">สินค้าทั้งหมด</a></li>
            </ol>
        </nav>
    </div>

    <div class="row" style='margin-bottom: 25px; justify-content: space-between;'>
        <div class="col-lg-4 col-sm-6">
            <select class="form-select" id="type_product" name="type_product" aria-label="type_product">
                <option value="0">--สินค้าทั้งหมด--</option>
                <?php for ($i = 0; $i < count($rec_type); $i++) { ?>
                    <option value="<?= $rec_type[$i]['code_type'] ?>">
                        <?= $rec_type[$i]['name_type'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="col-lg-4 col-sm-2">
            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="ช่องสำหรับยิงบาร์โค้ด">
        </div>

        <div class="col-lg-2 col-sm-2">
            <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewcart"
                onclick="view_cart()"><i class="bi bi-cart-plus"></i><span id='count_cart_back'
                    class="badge bg-primary badge-number">
                    <?= $count_cart ?>
                </span></a>
        </div>

        <div class="col-lg-2 col-sm-2">
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

    <div class="modal fade" id="viewcart" tabindex="1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ตะกร้าสินค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_product" class="row g-3">
                        <table id="detail_cart" class="table table-striped">

                        </table>

                        <div class="col-6">
                            <label for="customer" class="form-label">ลูกค้า</label><br>
                            <select style="width: 100%; line-height: 53px;" id="customer" name="customer"
                                aria-label="customer">
                                <option value="0">--ลูกค้า--</option>
                                <?php for ($i = 0; $i < count($user_all); $i++) { ?>
                                    <option value="<?= $user_all[$i]['usr_id'] ?>">
                                        <?= $user_all[$i]['usr_tel'] . "-" . $user_all[$i]['usr_fname'] . " " . $user_all[$i]['usr_lname'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="discount_last" class="form-label">ส่วนลดท้ายบิล</label>
                            <input type="number" id="discount_last" name="discount_last" class="form-control"
                                step='0.01'>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a class="btn btn-danger" onclick="clear_cart()">ลบข้อมูลทั้งหมด</a>
                    <a class="btn btn-warning" onclick="update_cart('add_product')">อัพเดท</a>
                    <a class="btn btn-primary" onclick="save_cart('add_product')">บันทึก</a>
                </div>
            </div>
        </div>
    </div>

</main>