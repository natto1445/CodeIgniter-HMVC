<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo base_url(); ?>storefront" class="logo d-flex align-items-center">
            <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">เพ็ททาวน์</span>
        </a>
    </div>

    <?php
    $AUTH = [
        1 => "ลูกค้า",
        5 => "พนักงาน",
        9 => "ผู้ดูแลระบบ",
    ];

    $name = isset($_SESSION['usr_id']) ? $_SESSION['usr_fname'] . " " . $_SESSION['usr_lname'] : "";
    $auth = isset($_SESSION['usr_id']) ? $_SESSION['auth'] : "";

    ?>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#viewcartfront"
                    onclick="view_cart()">
                    <i class="bi bi-cart-plus"></i>
                    <span id='count_cart_front' class="badge bg-primary badge-number">
                        <?= $count_cart_front ?>
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        คุณมีออเดอร์ใหม่ 4 รายการ
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">แสดง</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>customer customer</h4>
                            <p>ยอดสั่งซื้อ 10,255 บาท</p>
                            <p>วันที่สั่งซื้อ 2024/01/34</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>customer customer</h4>
                            <p>ยอดสั่งซื้อ 10,255 บาท</p>
                            <p>วันที่สั่งซื้อ 2024/01/34</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>customer customer</h4>
                            <p>ยอดสั่งซื้อ 10,255 บาท</p>
                            <p>วันที่สั่งซื้อ 2024/01/34</p>
                        </div>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->


            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?= $name ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <?php if (isset($_SESSION['auth'])) { ?>
                        <li class="dropdown-header">
                            <h6>
                                <?= $name ?>
                            </h6>
                            <span>
                                <?= ($auth >= 1) ? $AUTH[$auth] : $auth ?>
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-person"></i>
                                <span>ข้อมูลส่วนตัว</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <?php if ($auth > 1) { ?>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>">
                                    <i class="bi bi-house-door"></i>
                                    <span>ระบบหลังบ้าน</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php } ?>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>ตั้งค่าบัญชี</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>user/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>ออกจากระบบ</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>login">
                                <i class="bi bi-person-circle"></i>
                                <span>เข้าสู่ระบบ</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="<?php echo base_url(); ?>login/register">
                                <i class="bi bi-person-plus-fill"></i>
                                <span>ลงทะเบียน</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    <?php } ?>

                </ul>
            </li>

        </ul>
    </nav>

</header>