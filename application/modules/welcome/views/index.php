<?php echo $this->load->view('template/nav.php'); ?>
<?php echo $this->load->view('template/menu.php'); ?>
<main id="main" class="main">

	<div class="pagetitle">
		<h1>Dashboard</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">หน้าแรก</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section dashboard">
		<div class="row">
			<!-- Left side columns -->
			<div class="col-lg-12">
				<div class="row">

					<!-- Sales Card -->
					<div class="col-xxl-3 col-md-6">
						<div class="card info-card sales-card">

							<div class="card-body">
								<h5 class="card-title">ออเดอร์หน้าร้าน <span>| ทั้งหมด</span></h5>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-cart"></i>
									</div>
									<div class="ps-3">
										<h6>145</h6>
										<span class="text-success small pt-1 fw-bold">70%</span> <span
											class="text-muted small pt-2 ps-1">เยี่ยม</span>

									</div>
								</div>
							</div>

						</div>
					</div><!-- End Sales Card -->

					<!-- Revenue Card -->
					<div class="col-xxl-3 col-md-6">
						<div class="card info-card revenue-card">

							<div class="card-body">
								<h5 class="card-title">ออเดอร์ออนไลน์ <span>| ทั้งหมด</span></h5>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-cart"></i>
									</div>
									<div class="ps-3">
										<h6>25</h6>
										<span class="text-success small pt-1 fw-bold">30%</span> <span
											class="text-muted small pt-2 ps-1">เยี่ยม</span>

									</div>
								</div>
							</div>

						</div>
					</div><!-- End Revenue Card -->

					<!-- Customers Card -->
					<div class="col-xxl-3 col-md-6">

						<div class="card info-card customers-card">

							<div class="card-body">
								<h5 class="card-title">ออเดอร์ <span>| ทั้งหมด</span></h5>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-cart"></i>
									</div>
									<div class="ps-3">
										<h6>170</h6>
										<span class="text-danger small pt-1 fw-bold">100%</span> <span
											class="text-muted small pt-2 ps-1">เยี่ยม</span>

									</div>
								</div>

							</div>

						</div>

					</div><!-- End Customers Card -->

					<!-- Customers Card -->
					<div class="col-xxl-3 col-md-6">

						<div class="card info-card customers-card">

							<div class="card-body">
								<h5 class="card-title">ออเดอร์ทั้งหมด <span>| วันนี้</span></h5>

								<div class="d-flex align-items-center">
									<div
										class="card-icon rounded-circle d-flex align-items-center justify-content-center">
										<i class="bi bi-cart"></i>
									</div>
									<div class="ps-3">
										<h6>12</h6>
										<span class="text-danger small pt-1 fw-bold">3%</span> <span
											class="text-muted small pt-2 ps-1">เยี่ยม</span>

									</div>
								</div>

							</div>

						</div>

					</div><!-- End Customers Card -->

				</div>
			</div><!-- End Left side columns -->

		</div>
	</section>

</main><!-- End #main -->