<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo base_url(); ?>" class="logo d-flex align-items-center">
            <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">เพ็ททาวน์</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <?php
    $AUTH = [
        1 => "ลูกค้า",
        5 => "พนักงาน",
        9 => "ผู้ดูแลระบบ",
    ];

    $name = isset($_SESSION['usr_id']) ? $_SESSION['usr_fname'] . " " . $_SESSION['usr_lname'] : "";
    $auth = isset($_SESSION['usr_id']) ? $_SESSION['auth'] : "";
    ?>

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <!-- <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
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

                </ul>

            </li> -->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        <?= $name ?>
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
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
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>storefront">
                                <i class="bi bi-house-door"></i>
                                <span>ระบบหน้าบ้าน</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    <?php } ?>

                    <!-- <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-gear"></i>
                            <span>ตั้งค่าบัญชี</span>
                        </a>
                    </li> -->
                    
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>user/logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->