<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>รายงาน</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">รายงานสินค้าต่ำกว่าสต๊อก</li>
            </ol>
        </nav>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-2 col-sm-2" style="">
            <label for="inputDate" class="col-form-label">&nbsp;</label><br>
            <a type="button" class="btn btn-danger" onclick="get_report_pdf()"><i
                    class="bi bi-file-earmark-pdf-fill"></i></a>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">รายงานสินค้าต่ำกว่าสต๊อก</h5>

                        <table id='report_data' class="table" style="font-family: 'Kanit', sans-serif;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ลำดับ</th>
                                    <th style="width: 9%;">รหัสสินค้า</th>
                                    <th style="width: 10%;">ชื่อสินค้า</th>
                                    <th style="width: 10%;">ประเภทสินค้า</th>
                                    <th>จำนวนที่มี</th>
                                    <th>สต๊อกขั้นต่ำ</th>
                                    <th>ราคาทุน</th>
                                    <th>ราคาขาย</th>
                                    <th>หน่วย</th>
                                </tr>
                            </thead>
                            <tbody class='data_report'>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>