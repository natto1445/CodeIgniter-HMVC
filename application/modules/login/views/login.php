<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="<?php echo base_url(); ?>/assets/img/pet.png" alt="">
                                <span class="d-none d-lg-block">เพ็ททาวน์</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">เข้าสู่ระบบ</h5>
                                </div>

                                <form id='login' class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="usr_name" class="form-label">ชื่อผู้ใช้</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="usr_name" class="form-control" id="usr_name" required>
                                            <div class="invalid-feedback">กรอกชื่อผู้ใช้งาน.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="usr_pass" class="form-label">รหัสผ่าน</label>
                                        <input type="password" name="usr_pass" class="form-control" id="usr_pass" required>
                                        <div class="invalid-feedback">กรอกรหัสผ่าน.</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a class="btn btn-primary w-100" onclick="login('login')">เข้าสู่ระบบ</a>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">ลืมรหัสผ่าน โปรดติดต่อผู้ดูแล? <a href="<?php echo base_url(); ?>login/register">ลงทะเบียน</a></p>
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
