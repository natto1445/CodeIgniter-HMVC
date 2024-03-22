<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<?php
$pic = base_url('public/pic_all/default.png');
?>

<style>
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

    #EimageContainer {
        width: 150px;
        height: 150px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    #EpreviewImage {
        width: 100%;
        height: auto;
    }
</style>

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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">เพิ่มข้อมูล</button>
    </div>


    <div class="modal fade" id="addproduct" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เพิ่มข้อมูลสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add_product" class="row g-3">

                <div class="col-md-12 d-flex justify-content-center align-items-center">
                  <div id="imageContainer">
                      <img id="previewImage" src="<?=$pic?>" alt="Image Preview">
                  </div>
                </div>

                <div class="col-md-12">
                  <label for="pic_product" class="form-label">อัพโหลดรูป :</label>
                  <input type="file" id="pic_product" name="pic_product" accept="image/*" onchange="previewpic(event)" required>
                </div>

                <div class="col-md-6">
                  <label for="name_type" class="form-label">ประเภทสินค้า</label>
                  <select class="form-select" id='code_type' name='code_type' aria-label="Default select example">
                    <option value="0">--ระบุประเภทสินค้า--</option>
                    <?php for ($i = 0; $i < count($rec_type); $i++) {?>
                    <option value="<?=$rec_type[$i]['code_type']?>"><?=$rec_type[$i]['name_type']?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="name_product" class="form-label">ชื่อสินค้า</label>
                  <input type="text" class="form-control" id="name_product" name="name_product">
                </div>

                <div class="col-md-6">
                  <label for="num" class="form-label">จำนวนสินค้า</label>
                  <input type="number" class="form-control" id="num" name="num" value='0' step='1'>
                </div>

                <div class="col-md-6">
                  <label for="minstock" class="form-label">สต๊อกขั้นต่ำ</label>
                  <input type="number" class="form-control" id="minstock" name="minstock" value='0' step='1'>
                </div>

                <div class="col-md-6">
                  <label for="cost" class="form-label">ราคาทุน</label>
                  <input type="number" class="form-control" id="cost" name="cost" value='0' step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="price" class="form-label">ราคาขาย</label>
                  <input type="number" class="form-control" id="price" name="price" value='0' step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="discount_per" class="form-label">ส่วนลดเปอร์เซ็นต์</label>
                  <input type="number" class="form-control" id="discount_per" name="discount_per" value='0' step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="discount_bath" class="form-label">ส่วนลดบาท</label>
                  <input type="number" class="form-control" id="discount_bath" name="discount_bath" value='0' step='0.01'>
                </div>

                <div class="col-md-12">
                  <a class="btn btn-success btn-sm" onclick="cal()">คำนวณ</a>
                </div>

                <div class="col-md-6">
                  <label for="unit" class="form-label">หน่วยสินค้า</label>
                  <input type="text" class="form-control" id="unit" name="unit" value='ชิ้น'>
                </div>

                <div class="col-md-6">
                  <label for="inputDate" class="col-md-6 col-form-label">วันที่หมดอายุ</label>
                  <div class="col-md-6">
                    <input type="date" class="form-control" id='date_exp' name='date_exp'>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="detail" name="detail" style="height: 100px;"></textarea>
                    <label for="detail">รายละเอียดสินค้า</label>
                  </div>
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

    <div class="modal fade" id="editProduct" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">แก้ไขข้อมูลสินค้า</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="edit_product" class="row g-3">

                <div class="col-md-12 d-flex justify-content-center align-items-center">
                  <div id="EimageContainer">
                      <img id="EpreviewImage" src="<?=$pic?>" alt="EImage Preview">
                  </div>
                </div>

                <div class="col-md-12">
                  <label for="Epic_product" class="form-label">อัพโหลดรูป :</label>
                  <input type="file" id="Epic_product" name="Epic_product" accept="image/*" onchange="Epreviewpic(event)" required>
                </div>

                <div class="col-md-12">
                  <label for="Eproduct_code" class="form-label">Barcode สินค้า</label>
                </div>

                <div class="col-md-6">
                  <label for="name_type" class="form-label">ประเภทสินค้า</label>
                  <select class="form-select" id='Ecode_type' name='Ecode_type' aria-label="Default select example">
                    <option value="0">--ระบุประเภทสินค้า--</option>
                    <?php for ($i = 0; $i < count($rec_type); $i++) {?>
                    <option value="<?=$rec_type[$i]['code_type']?>"><?=$rec_type[$i]['name_type']?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for="Eproduct_code" class="form-label">รหัสสินค้า</label>
                  <input type="text" class="form-control" id="Eproduct_code" name="Eproduct_code" readonly>
                  <input type="hidden" id="Eid_product" name="Eid_product">
                </div>

                <div class="col-md-6">
                  <label for="Ename_product" class="form-label">ชื่อสินค้า</label>
                  <input type="text" class="form-control" id="Ename_product" name="Ename_product">
                </div>

                <div class="col-md-6">
                  <label for="Estatus" class="form-label">สถานะ</label>
                    <select class="form-select" id="Estatus" name="Estatus" aria-label="Estatus">
                      <?php foreach ($status as $key => $value) {?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                    </select>
                </div>

                <div class="col-md-6">
                  <label for="Enum" class="form-label">จำนวนสินค้า</label>
                  <input type="number" class="form-control" id="Enum" name="Enum" step='1'>
                </div>

                <div class="col-md-6">
                  <label for="Eminstock" class="form-label">สต๊อกขั้นต่ำ</label>
                  <input type="number" class="form-control" id="Eminstock" name="Eminstock" step='1'>
                </div>

                <div class="col-md-6">
                  <label for="Ecost" class="form-label">ราคาทุน</label>
                  <input type="number" class="form-control" id="Ecost" name="Ecost" step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="Eprice" class="form-label">ราคาขาย</label>
                  <input type="number" class="form-control" id="Eprice" name="Eprice" step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="Ediscount_per" class="form-label">ส่วนลดเปอร์เซ็นต์</label>
                  <input type="number" class="form-control" id="Ediscount_per" name="Ediscount_per" step='0.01'>
                </div>

                <div class="col-md-6">
                  <label for="Ediscount_bath" class="form-label">ส่วนลดบาท</label>
                  <input type="number" class="form-control" id="Ediscount_bath" name="Ediscount_bath" step='0.01'>
                </div>

                <div class="col-md-12">
                  <a class="btn btn-success btn-sm" onclick="cal()">คำนวณ</a>
                </div>

                <div class="col-md-6">
                  <label for="Eunit" class="form-label">หน่วยสินค้า</label>
                  <input type="text" class="form-control" id="Eunit" name="Eunit">
                </div>

                <div class="col-md-6">
                  <label for="inputDate" class="col-md-6 col-form-label">วันที่หมดอายุ</label>
                  <div class="col-md-6">
                    <input type="date" class="form-control" id='Edate_exp' name='Edate_exp'>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="Edetail" name="Edetail" style="height: 100px;"></textarea>
                    <label for="Edetail">รายละเอียดสินค้า</label>
                  </div>
                </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <a class="btn btn-warning" onclick="edit('edit_product')">อัพเดท</a>
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
