<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<?php
$store_logo = isset($store_data[0]->store_logo) && !empty($store_data[0]->store_logo) ? base_url('public/pic_all/' . $store_data[0]->store_logo) : base_url('public/pic_all/default.png');
$store_code = isset($store_data[0]->store_code) ? $store_data[0]->store_code : "";
$store_name = isset($store_data[0]->store_name) ? $store_data[0]->store_name : "";
$store_address = isset($store_data[0]->store_address) ? $store_data[0]->store_address : "";
$store_tel = isset($store_data[0]->store_tel) ? $store_data[0]->store_tel : "";

$point = isset($store_data[0]->point) ? $store_data[0]->point : "";
$ppoint = isset($store_data[0]->ppoint) ? $store_data[0]->ppoint : "";
?>

<style>
  #imageContainer {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border: 1px solid #ccc;
  }

  #previewImage {
    width: 100%;
    height: auto;
    /* display: none; */
  }
</style>

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

            <form id="formStore" class="row g-3" enctype="multipart/form-data">

              <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div id="imageContainer">
                  <img id="previewImage" src="<?= $store_logo ?>" alt="Image Preview">
                </div>
              </div>

              <div class="col-md-12">
                <label for="logo" class="form-label">อัพโหลดรูป logo ร้าน :</label>
                <input type="file" id="logo" name="logo" accept="image/*" onchange="previewpic(event)" required>
              </div>

              <div class="col-md-6">
                <label for="store_code" class="form-label">รหัสร้าน</label>
                <input type="text" class="form-control" id="store_code" name="store_code" value="<?= $store_code ?>">
              </div>

              <div class="col-md-6">
                <label for="store_name" class="form-label">ชื่อร้าน</label>
                <input type="email" class="form-control" id="store_name" name="store_name" value="<?= $store_name ?>">
              </div>

              <div class="col-md-12">
                <div class="form-floating">
                  <textarea class="form-control" placeholder="Address" id="store_address" name="store_address"
                    style="height: 100px;"><?= $store_address ?></textarea>
                  <label for="store_address">ที่อยู่</label>
                </div>
              </div>

              <div class="col-md-6">
                <label for="store_tel" class="form-label">เบอร์โทร</label>
                <input type="text" class="form-control" id="store_tel" name="store_tel" value="<?= $store_tel ?>"
                  maxlength="10">
              </div>

              <div class="col-md-6">
              </div>

              <div class="col-md-6">
                <label for="point" class="form-label">แต้มสำหรับคะแนน</label>
                <input type="number" class="form-control" id="point" name="point" value="<?= $point ?>">
              </div>

              <div class="col-md-6">
                <label for="ppoint" class="form-label">คะแนนแทนเงิน</label>
                <input type="number" class="form-control" id="ppoint" name="ppoint" value="<?= $ppoint ?>">
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>