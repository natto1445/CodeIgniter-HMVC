<?php
$auth = isset($_SESSION['usr_id']) ? $_SESSION['auth'] : "";
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?php echo base_url(); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url(); ?>storefront/store">
                <i class="bi bi-house-fill"></i>
                <span>ระบบหน้าร้าน</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#order" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bag-plus-fill"></i><span>ออเดอร์</span><span class="badge bg-danger text-white"><?=$counr_order_online?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="order" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo base_url(); ?>order/order_front">
                        <i class="bi bi-circle"></i><span>ออเดอร์ออนไลน์</span><span class="badge bg-danger text-white"><?=$counr_order_online?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>order/order_back">
                        <i class="bi bi-circle"></i><span>ออเดอร์หน้าร้าน</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url(); ?>product/type_product">
                <i class="bi bi-person-fill"></i>
                <span>จัดการประเภทสินค้า</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url(); ?>product/products">
                <i class="bi bi-person-fill"></i>
                <span>จัดการสินค้า</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url(); ?>user">
                <i class="bi bi-person-fill"></i>
                <span>จัดการผู้ใช้งาน</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#setting_system" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>ตั้งค่าระบบ</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="setting_system" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo base_url(); ?>setting/setting_store">
                        <i class="bi bi-circle"></i><span>ข้อมูลร้าน</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>setting/setting_bank">
                        <i class="bi bi-circle"></i><span>บัญชีธนาคาร</span>
                    </a>
                </li>
            </ul>
        </li>

        <?php if ($auth == 9) {?>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#report" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>รายงาน</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo base_url(); ?>report/report_date">
                        <i class="bi bi-circle"></i><span>รายงานการขายตามช่วงเวลา</span>
                    </a>
                    <a href="<?php echo base_url(); ?>report/report_sale">
                        <i class="bi bi-circle"></i><span>รายงานการขายรายพนักงาน</span>
                    </a>
                    <a href="<?php echo base_url(); ?>report/report_customer">
                        <i class="bi bi-circle"></i><span>รายงานการขายรายลูกค้า</span>
                    </a>
                </li>
            </ul>
        </li>

        <?php }?>

    </ul>

</aside>