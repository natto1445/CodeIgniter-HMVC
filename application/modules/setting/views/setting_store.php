<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<?php
$store_code = isset($store_data[0]->store_code) ? $store_data[0]->store_code : "";
$store_name = isset($store_data[0]->store_name) ? $store_data[0]->store_name : "";
$store_address = isset($store_data[0]->store_address) ? $store_data[0]->store_address : "";
$store_tel = isset($store_data[0]->store_tel) ? $store_data[0]->store_tel : "";
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">ตั้งค่าระบบ</a></li>
          <li class="breadcrumb-item active">ข้อมูลร้าน</li>
        </ol>
      </nav>
    </div>

    <div class="div" style="margin-bottom: 20px;">
    <a class="btn btn-primary" onclick="save_store('formStore')">บันทึกข้อมูล</a>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">ตั้งค่าข้อมูลร้าน</h5>

              <form id="formStore" class="row g-3">
                <div class="col-md-6">
                  <label for="store_code" class="form-label">รหัสร้าน</label>
                  <input type="text" class="form-control" id="store_code" name="store_code" value="<?=$store_code?>">
                </div>
                <div class="col-md-6">
                  <label for="store_name" class="form-label">ชื่อร้าน</label>
                  <input type="email" class="form-control" id="store_name" name="store_name" value="<?=$store_name?>">
                </div>

                <div class="col-md-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="store_address" name="store_address" style="height: 100px;"><?=$store_address?></textarea>
                    <label for="store_address">ที่อยู่</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="store_tel" class="form-label">เบอร์โทร</label>
                  <input type="text" class="form-control" id="store_tel" name="store_tel" value="<?=$store_tel?>" maxlength="10">
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
