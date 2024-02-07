<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>

<style>
    .main_store{
        margin-top: 60px;
        padding: 20px 30px;
        transition: all 0.3s;
    }
    .detail{
        padding: 20px 0 0 0;
        font-size: 14px;
        font-weight: 500;
        color: #012970;
        font-family: "Poppins", sans-serif;
    }
</style>
<main id="main" class="main main_store">

	<div class="pagetitle">
		<h1>หน้าร้าน</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">สินค้าทั้งหมด</a></li>
			</ol>
		</nav>
	</div>

    <div class="row" style='margin-bottom: 25px; justify-content: space-between;'>
        <div class="col-lg-4 col-sm-6">
            <select class="form-select" id="type_product" name="type_product" aria-label="Estatus_type">
                <option value="0">--สินค้าทั้งหมด--</option>
                <?php for ($i = 0; $i < count($rec_type); $i++) {?>
                <option value="<?=$rec_type[$i]['code_type']?>"><?=$rec_type[$i]['name_type']?></option>
                <?php }?>
            </select>
        </div>

        <div class="col-lg-4 col-sm-2">
            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="ช่องสำหรับยิงบาร์โค้ด">
        </div>

        <div class="col-lg-2 col-sm-2">
            <button type="button" class="btn btn-secondary"><i class="bi bi-cart-plus"></i></button>
        </div>

        <div class="col-lg-2 col-sm-2">
            <select class="form-select" id="orderby" name="orderby" aria-label="Estatus_type">
                <option value="0">เรียงลำดับข้อมูล</option>
                <option value="1">ราคาต่ำ - สูง</option>
                <option value="2">ราคาสูง - ต่ำ</option>
            </select>
        </div>
    </div>

	<section class="section dashboard">
		<div class="row">

			<div class="col-lg-12">
				<div id="list_product" class="row">

				</div>
			</div>

		</div>
	</section>

</main>
