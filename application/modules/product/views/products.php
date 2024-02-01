<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>จัดการ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">จัดการ</a></li>
          <li class="breadcrumb-item active">สินค้า</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="div" style="margin-bottom: 20px;">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addType">เพิ่มข้อมูล</button>
    </div>


    <div class="modal fade" id="addType" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เพิ่มข้อมูล</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add_product" class="row g-3">
                <div class="col-12">
                  <label for="name_type" class="form-label">ชื่อประเภทสินค้า</label>
                  <input type="text" class="form-control" id="name_type" name="name_type">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <a class="btn btn-primary" onclick="save('add_product')">บันทึก</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editType" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">แก้ไขข้อมูล</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit_product" class="row g-3">
                <div class="col-12">
                  <label for="Ecode_type" class="form-label">รหัสประเภทสินค้า</label>
                  <input type="text" class="form-control" id="Ecode_type" name="Ecode_type" readonly>
                  <input type="hidden" id="Eid_type" name="Eid_type">
                </div>
                <div class="col-12">
                  <label for="Ename_type" class="form-label">ชื่อประเภทสินค้า</label>
                  <input type="text" class="form-control" id="Ename_type" name="Ename_type">
                </div>
                <div class="col-12">
                  <label for="Estatus_type" class="form-label">สถานะ</label>
                    <select class="form-select" id="Estatus_type" name="Estatus_type" aria-label="Estatus_type">
                      <?php foreach ($status as $key => $value) {?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                    </select>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <a class="btn btn-warning" onclick="edit('edit_product')">แก้ไข</a>
          </div>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">จัดการข้อมูลผู้ใช้งาน</h5>

              <table id='product_data' class="table" style="font-family: 'Kanit', sans-serif;">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>
                      <b>ชื่อสินค้า</b>
                    </th>
                    <th>ประเภทสินค้า</th>
                    <th>จำนวน</th>
                    <th>สต๊อกขั้นต่ำ</th>
                    <th>ราคาทุน</th>
                    <th>ราคาขาย</th>
                    <th>หน่วย</th>
                    <th>สถานะ</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody class='data-product'>

                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>



  </main><!-- End #main -->
