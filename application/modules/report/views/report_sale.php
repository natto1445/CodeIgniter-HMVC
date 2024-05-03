<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>รายงาน</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">รายงานการขายรายพนักงาน</li>
            </ol>
        </nav>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-3 col-sm-3" style="">
            <label for="date_start" class="col-form-label">วันที่เริมต้น</label>
            <div class="col-sm-10">
                <input type="date" id="date_start" name="date_start" class="form-control">
            </div>
        </div>
        <div class="col-md-3 col-sm-3" style="">
            <label for="date_end" class="col-form-label">วันที่สิ้นสุด</label>
            <div class="col-sm-10">
                <input type="date" id="date_end" name="date_end" class="form-control">
            </div>
        </div>
        <div class="col-md-3 col-sm-3" style="">
            <label for="sale" class="col-form-label">พนักงาน</label>
            <select class="form-select" id='sale' name='sale' aria-label="Default select example">
                <option value="0">--ระบุพนักงาน--</option>
                <?php for ($i = 0; $i < count($sale); $i++) {?>
                <option value="<?=$sale[$i]['usr_id']?>"><?=$sale[$i]['usr_fname'] . " " . $sale[$i]['usr_lname']?></option>
                <?php }?>
            </select>
        </div>

        <div class="col-md-2 col-sm-2" style="text-align: right;">
            <label for="inputDate" class="col-form-label">&nbsp;</label><br>
            <a type="button" class="btn btn-primary" onclick="get_report()"><i class="bi bi-search"></i></a>
            <a type="button" class="btn btn-danger" onclick="get_report_pdf()"><i class="bi bi-file-earmark-pdf-fill"></i></a>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">จัดการข้อมูลผู้ใช้งาน</h5>

                        <table id='report_data' class="table" style="font-family: 'Kanit', sans-serif;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ลำดับ</th>
                                    <th style="width: 9%;">ออเดอร์</th>
                                    <th style="width: 10%;">ประเภทออเดอร์</th>
                                    <th style="width: 10%;">ประเภทการชำระ</th>
                                    <th>วันที่ขาย</th>
                                    <th>ลูกค้า</th>
                                    <th>ผู้ขาย</th>
                                    <th>ต้นทุน</th>
                                    <th>ยอดขาย</th>
                                    <th>ส่วนลด</th>
                                    <th>ยอดสุทธิ</th>
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
