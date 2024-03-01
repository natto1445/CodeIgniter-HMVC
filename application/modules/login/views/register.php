<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="<?php echo base_url(); ?>/assets/img/pet.png" alt="">
                <span class="d-none d-lg-block">เพ็ททาวน์</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">ลงทะเบียน</h5>
                </div>

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

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                      <label class="form-check-label" for="acceptTerms">ฉันเห็นด้วยและยอมรับ <a
                          href="#">ข้อกำหนดและเงื่อนไข</a></label>
                      <div class="invalid-feedback">คุณต้องตกลงก่อนที่จะส่ง.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <a class="btn btn-primary w-100" onclick="save_register('register')">สร้างบัญชีผู้ใช้งาน</a>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">มีบัญชีผู้ใช้งานแล้ว? <a href="<?php echo base_url(); ?>login">เข้าสู่ระบบ</a>
                    </p>
                  </div>
                </form>

              </div>
            </div>

            <div class="credits">
              Designed by <a href="https://web.facebook.com/natthanon123?locale=th_TH">Dev Natthanon</a>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
</main><!-- End #main -->