<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>ออเดอร์</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">ออเดอร์</a></li>
        <li class="breadcrumb-item active">ออเดอร์หน้าร้าน</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">ออเดอร์หน้าร้าน</h5>

            <table id='order_data' class="table" style="font-family: 'Kanit', sans-serif;">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>เลขที่ออเดอร์</th>
                  <th>
                    <b>ผู้ขาย</b>
                  </th>
                  <th>ประเภทการชำระ</th>
                  <th data-type="date" data-format="DD/MM/YYYY">วันที่ขาย</th>
                  <th>ยอดขาย</th>
                  <th>ส่วนลด</th>
                  <th>สถานะ</th>
                  <th>ใบเสร็จ</th>
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

  <div class="modal fade" id="editOrder" tabindex="1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">คืนสินค้า</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="return_product" class="row g-3">
            <table id="tbl_return_product" class="table table-striped">

            </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <a class="btn btn-primary" onclick="return_product('return_product')">คืนสินค้า</a>
        </div>
      </div>
    </div>
  </div>


</main><!-- End #main -->