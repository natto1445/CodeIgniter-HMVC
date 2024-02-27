<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>ออเดอร์</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">ออเดอร์</a></li>
          <li class="breadcrumb-item active">ออเดอร์ออนไลน์</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ออเดอร์ออนไลน์</h5>

              <table id='order_data' class="table" style="font-family: 'Kanit', sans-serif;">
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>เลขที่ออเดอร์</th>
                    <th>
                      <b>ลูกค้า</b>
                    </th>
                    <th data-type="date" data-format="DD/MM/YYYY">วันที่ขาย</th>
                    <th>ยอดขาย</th>
                    <th>ส่วนลด</th>
                    <th>สถานะ</th>
                    <th>ใบเสร็จ</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody class='data-order'>

                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>


  </main><!-- End #main -->
