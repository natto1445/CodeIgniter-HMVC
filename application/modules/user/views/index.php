<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>จัดการ</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">จัดการ</a></li>
          <li class="breadcrumb-item active">ผู้ใช้งาน</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="div" style="margin-bottom: 20px;">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">เพิ่มข้อมูล</button>
    </div>


    <div class="modal fade" id="addUser" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เพิ่มข้อมูล</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form id='register' class="row g-3 needs-validation">
                  <div class="col-12">
                      <label for="usr_name" class="form-label">ชื่อผู้ใช้งาน</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="usr_name" class="form-control" id="usr_name" required>
                        <div class="invalid-feedback">โปรดระบุชื่อผู้ใช้งาน.</div>
                      </div>
                    </div>

                    <div class="row col-12">
                      <div class="col-6">
                        <label for="usr_fname" class="form-label">ชื่อ</label>
                        <input type="text" name="usr_fname" class="form-control" id="usr_fname" required>
                        <div class="invalid-feedback">โปรดระบุชื่อ!</div>
                      </div>

                      <div class="col-6">
                        <label for="usr_lname" class="form-label">นามสกุล</label>
                        <input type="text" name="usr_lname" class="form-control" id="usr_lname" required>
                        <div class="invalid-feedback">โปรดระบุนามสกุล!</div>
                      </div>
                    </div>

                    <div class="row col-12">
                      <div class="col-6">
                        <label for="usr_mail" class="form-label">E-mail</label>
                        <input type="email" name="usr_mail" class="form-control" id="usr_mail" required>
                        <div class="invalid-feedback">โปรดระบุ E-mail!</div>
                      </div>

                      <div class="col-6">
                        <label for="usr_tel" class="form-label">เบอร์โทร</label>
                        <input type="text" name="usr_tel" class="form-control" id="usr_tel" required>
                        <div class="invalid-feedback">โปรดระบุเบอร์โทร!</div>
                      </div>
                    </div>

                    <div class="row col-12">
                      <div class="col-6">
                        <label for="usr_password" class="form-label">รหัสผ่าน</label>
                        <input type="password" name="usr_password" class="form-control" id="usr_password" required>
                        <div class="invalid-feedback">โปรดระบุรหัสผ่าน!</div>
                      </div>

                      <div class="col-6">
                        <label for="usr_password_c" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="usr_password_c" class="form-control" id="usr_password_c" required>
                        <div class="invalid-feedback">โปรดยืนยันรหัสผ่าน!</div>
                      </div>
                    </div>

                  </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <a class="btn btn-primary" onclick="save_register('register')">บันทึก</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">แก้ไขข้อมูล</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

          <form id='editUserForm' class="row g-3 needs-validation">
            <div class="col-12">
                <label for="Eusr_name" class="form-label">ชื่อผู้ใช้งาน</label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                  <input type="text" name="Eusr_name" class="form-control" id="Eusr_name" required>
                  <input type="hidden" name="Eusr_id" id="Eusr_id" required>
                  <div class="invalid-feedback">โปรดระบุชื่อผู้ใช้งาน.</div>
                </div>
              </div>

              <div class="row col-12">
                <div class="col-6">
                  <label for="Eusr_fname" class="form-label">ชื่อ</label>
                  <input type="text" name="Eusr_fname" class="form-control" id="Eusr_fname" required>
                  <div class="invalid-feedback">โปรดระบุชื่อ!</div>
                </div>

                <div class="col-6">
                  <label for="Eusr_lname" class="form-label">นามสกุล</label>
                  <input type="text" name="Eusr_lname" class="form-control" id="Eusr_lname" required>
                  <div class="invalid-feedback">โปรดระบุนามสกุล!</div>
                </div>
              </div>

              <div class="row col-12">
                <div class="col-6">
                  <label for="Eusr_mail" class="form-label">E-mail</label>
                  <input type="email" name="Eusr_mail" class="form-control" id="Eusr_mail" required>
                  <div class="invalid-feedback">โปรดระบุ E-mail!</div>
                </div>

                <div class="col-6">
                  <label for="Eusr_tel" class="form-label">เบอร์โทร</label>
                  <input type="text" name="Eusr_tel" class="form-control" id="Eusr_tel" required>
                  <div class="invalid-feedback">โปรดระบุเบอร์โทร!</div>
                </div>
              </div>

              <div class="col-12">
                  <label for="Eauth" class="form-label">สถานะ</label>
                    <select class="form-select" id="Eauth" name="Eauth" aria-label="Estatus_type">
                      <?php foreach ($auth as $key => $value) {?>
                        <option value="<?=$key?>"><?=$value?></option>
                      <?php }?>
                    </select>
                </div>

              <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="repass"  name="repass">
                    <label class="form-check-label" for="repass">
                      ต้องการแก้ไขรหัสผ่าน
                    </label>
                  </div>
              </div>

              <div class="row col-12">
                <div class="col-6">
                  <label for="Eusr_password" class="form-label">รหัสผ่าน</label>
                  <input type="password" name="Eusr_password" class="form-control" id="Eusr_password" required>
                  <div class="invalid-feedback">โปรดระบุรหัสผ่าน!</div>
                </div>

                <div class="col-6">
                  <label for="Eusr_password_c" class="form-label">ยืนยันรหัสผ่าน</label>
                  <input type="password" name="Eusr_password_c" class="form-control" id="Eusr_password_c" required>
                  <div class="invalid-feedback">โปรดยืนยันรหัสผ่าน!</div>
                </div>
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <a class="btn btn-warning" onclick="edit('editUserForm')">แก้ไข</a>
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

              <table id='user_data' class="table" style="font-family: 'Kanit', sans-serif;">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>
                      <b>ชื่อ-นามสกุล</b>
                    </th>
                    <th>E-mail</th>
                    <th>เบอร์โทร</th>
                    <th data-type="date" data-format="DD/MM/YYYY">วันที่สร้าง</th>
                    <th>สิทธิ์</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody class='data-user'>

                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>



  </main><!-- End #main -->
