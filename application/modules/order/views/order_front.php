<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<?php
$pic = base_url('public/pic_all/default.png');
?>

<style>
  #imageContainer {
    width: 300px;
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
        <li class="breadcrumb-item"><a href="#">ออเดอร์</a></li>
        <li class="breadcrumb-item active">ออเดอร์ออนไลน์</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ออเดอร์ออนไลน์</h5>

            <table id='order_data' class="table" style="font-family: 'Kanit', sans-serif;">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>เลขที่ออเดอร์</th>
                  <th>
                    <b>ลูกค้า</b>
                  </th>
                  <th data-type="date" data-format="DD/MM/YYYY">วันที่ขาย</th>
                  <th>ยอดขาย</th>
                  <th>ส่วนลด</th>
                  <th>สถานะ</th>
                  <th>ใบเสร็จ</th>
                  <th>สลิป</th>
                  <th>สลิปจัดส่ง</th>
                  <th>จัดการ</th>
                </tr>
              </thead>
              <tbody class='data-order'>

              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

  <div class="modal fade" id="show_slip" tabindex="1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">สลิปการโอนเงิน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="confirm_order" class="row g-3">

            <div class="col-md-12 d-flex justify-content-center align-items-center">
              <div id="imageContainer">
                <img id="previewImage" src="<?=$pic?>" alt="Image Preview">
              </div>
            </div>

            <div class="col-md-12">
              <label for="address_order" class="form-label">ที่อยู่ในการจัดส่ง</label>
                            <textarea class="form-control" id="address_order" name="address_order"
                                style="height: 100px;" readonly></textarea>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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
                <img id="previewImage" src="<?=$pic?>" alt="Image Preview">
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

  <div class="modal fade" id="statusOrder" tabindex="1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">อัพเดทสถานะออเดอร์</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="FstatusOrder" class="row g-3">

            <div class="col-md-6">
              <label for="status_order" class="form-label">สถานะ</label>
              <select class="form-select" id="status_order" name="status_order" aria-label="status_order">
                <?php foreach ($status as $key => $value) {?>

                  <?php if ($key >= 2 && $key != 50) {?>

                    <option value="<?=$key?>">
                      <?=$value?>
                    </option>

                  <?php }?>
                <?php }?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="slip_deli" class="form-label">อัพโหลดสลิปจัดส่ง :</label>
              <input type="file" id="slip_deli" name="slip_deli" accept="image/*">
              <input type="hidden" id="id_order" name="id_order">
              <input type="hidden" id="order_no" name="order_no">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <a class="btn btn-primary" onclick="update_Status('FstatusOrder')">อัพเดท</a>
        </div>
      </div>
    </div>
  </div>


</main><!-- End #main -->