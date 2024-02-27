<?php echo $this->load->view('template/navmain.php'); ?>
<style>
    .main_store {
        margin-top: 60px;
        padding: 20px 30px;
        transition: all 0.3s;
    }

    .detail {
        padding: 20px 0 0 0;
        font-size: 14px;
        font-weight: 500;
        color: #012970;
        font-family: "Poppins", sans-serif;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>ออเดอร์</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">รายการออเดอร์ของฉัน</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ออเดอร์ออนไลน์</h5>

                        <table id='myorder_data' class="table" style="font-family: 'Kanit', sans-serif;">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>เลขที่ออเดอร์</th>
                                    <th data-type="date" data-format="DD/MM/YYYY">วันที่ซื้อ</th>
                                    <th>ยอดสั่งซื้อ</th>
                                    <th>ส่วนลด</th>
                                    <th>ใบเสร็จ</th>
                                    <th>เลขพัสดุ</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class='data-myorder'>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>


</main><!-- End #main -->