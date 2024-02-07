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
    <h1>Setting</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">ตั้งค่าระบบ</a></li>
        <li class="breadcrumb-item active">ข้อมูลธนาคาร</li>
      </ol>
    </nav>
  </div>

  <div class="div" style="margin-bottom: 20px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBank">เพิ่มข้อมูล</button>
  </div>

  <div class="modal fade" id="addBank" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="add_bank" class="row g-3">

            <div class="col-md-12 d-flex justify-content-center align-items-center">
              <div id="imageContainer">
                  <img id="previewImage" src="<?=$pic?>" alt="Image Preview">
              </div>
            </div>

            <div class="col-md-12">
              <label for="pic_bank" class="form-label">อัพโหลดรูป :</label>
              <input type="file" id="pic_bank" name="pic_bank" accept="image/*" onchange="previewpic(event)" required>
            </div>

            <div class="col-6">
              <label for="bank_code" class="form-label">เลขที่บัญชี</label>
              <input type="text" class="form-control" id="bank_code" name="bank_code">
            </div>

            <div class="col-6">
              <label for="bank_name" class="form-label">ธนาคาร</label>
              <input type="text" class="form-control" id="bank_name" name="bank_name">
            </div>

            <div class="col-6">
              <label for="bank_branch" class="form-label">สาขาเปิดบัญชี</label>
              <input type="text" class="form-control" id="bank_branch" name="bank_branch">
            </div>

            <div class="col-6">
              <label for="bank_owner" class="form-label">ชื่อบัญชี</label>
              <input type="text" class="form-control" id="bank_owner" name="bank_owner">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <a class="btn btn-primary" onclick="save('add_bank')">บันทึก</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editBank" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">แก้ไขข้อมูล</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="edit_bank" class="row g-3">

            <div class="col-md-12 d-flex justify-content-center align-items-center">
              <div id="EimageContainer">
                  <img id="EpreviewImage" src="<?=$pic?>" alt="EImage Preview">
              </div>
            </div>

            <div class="col-md-12">
              <label for="Epic_bank" class="form-label">อัพโหลดรูป :</label>
              <input type="file" id="Epic_bank" name="Epic_bank" accept="image/*" onchange="Epreviewpic(event)" required>
            </div>

            <div class="col-6">
              <label for="Ebank_code" class="form-label">เลขที่บัญชี</label>
              <input type="text" class="form-control" id="Ebank_code" name="Ebank_code">
              <input type="hidden" id="Ebank_id" name="Ebank_id">
            </div>

            <div class="col-6">
              <label for="Ebank_name" class="form-label">ธนาคาร</label>
              <input type="text" class="form-control" id="Ebank_name" name="Ebank_name">
            </div>

            <div class="col-6">
              <label for="Ebank_branch" class="form-label">สาขาเปิดบัญชี</label>
              <input type="text" class="form-control" id="Ebank_branch" name="Ebank_branch">
            </div>

            <div class="col-6">
              <label for="Ebank_owner" class="form-label">ชื่อบัญชี</label>
              <input type="text" class="form-control" id="Ebank_owner" name="Ebank_owner">
            </div>

            <div class="col-6">
              <label for="Ebank_status" class="form-label">สถานะ</label>
              <select class="form-select" id="Ebank_status" name="Ebank_status" aria-label="Estatus_type">
                <?php foreach ($status as $key => $value) {?>
                  <option value="<?=$key?>">
                    <?=$value?>
                  </option>
                <?php }?>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <a class="btn btn-warning" onclick="edit('edit_bank')">แก้ไข</a>
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

            <table id='bank_data' class="table" style="font-family: 'Kanit', sans-serif;">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>เลขที่บัญชี</th>
                  <th>
                    <b>ธนาคาร</b>
                  </th>
                  <th>สาขาเปิดบัญชี</th>
                  <th>ชื่อบัญชี</th>
                  <th>สถานะ</th>
                  <th>จัดการ</th>
                </tr>
              </thead>
              <tbody class='data-bank'>

              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>



</main><!-- End #main -->