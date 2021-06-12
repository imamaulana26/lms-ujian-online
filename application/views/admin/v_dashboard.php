<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition sidebar-mini text-sm">
	<div class="wrapper">
		<!-- Navbar -->
		<?php $this->load->view('admin/layouts/v_navbar'); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('admin/layouts/v_sidebar'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Soal</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Soal</li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<!-- <div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Online Store Visitors</h3>
										<a href="javascript:void(0);">View Report</a>
									</div>
								</div> -->
								<div class="card-body">
									<div class="pilih d-flex">
										<div class="col-md-6 d-flex">
											<div class="col-md-6">
												<!-- Default dropright button -->
												<select class="form-control" name="kelas" id="kelas">
													<option value="" selected disabled>Pilih Kelas</option>
													<?php foreach ($dtkelas as $kelas) {
													?>
														<option value="<?= $kelas['kelas_id'] ?>"><?= $kelas['kelas_nama'] ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-6">
												<!-- Default dropright button -->
												<select class="form-control" name="idmapel" id="mapel">
													<option value="" selected>Pilih Mapel</option>
												</select>
												<div id="loading" style="margin-top: 15px;"> <img src=" <?= site_url('assets/images/loading.gif') ?>" width="18"> <small>Loading...</small> </div>
											</div>
										</div>
										<div class="col-md-6">
											<button type="submit" class="btn btn-primary mb-2">Pilih</button>
										</div>
									</div>

								</div>
							</div>
							<!-- /.card -->
						</div>
					</div>
					<!-- /.mengelola soal -->
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header">
									Mengelola Soal <label id="mapel"></label> - Soal Uji Coba
								</div>
								<div class="card-body">

									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Soal</label>
										<div class="col-md-10">
											<textarea name="komentar" id="editorfr"></textarea>
										</div>
									</div>

									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Lampiran</label>
										<div class="col-md-6">
											<input style="width: 100%;" type="text" placeholder=" Hanya Dapat Melampirkan Dari Google Drive">
										</div>
										<div class="col-md-2">
											<select class="form-control" name="kelas">
												<option value="" selected disabled>Pilih Type</option>
												<option value="gambar">Gambar</option>
												<option value="video">Video</option>
												<option value="audio">Audio</option>
											</select>
										</div>
									</div>

									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Tipe Soal</label>
										<div class="col-md-2">
											<select class="form-control" name="kelas">
												<option value="" selected disabled>Pilih Type</option>
												<option value="1">Pilihan Ganda</option>
												<option value="2">True / False</option>
												<option value="3">Esay</option>
												<option value="4">Jawaban Singkat</option>
												<option value="5">Mencocokan Jawaban</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary mb-2">Pilih</button>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!-- /.mengelola jawaban tipe soal pilgan-->
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban Matematika Untuk Tipe Soal Pilihan Ganda
								</div>
								<div class="card-body">
									<?php
									$n = range('a', 'd');
									for ($i = 0; $i < 4; $i++) {
									?>
										<div class="form-group d-flex">
											<label class="col-sm-2 control-label text-right">Pilihan <?= strtoupper($n[$i]) ?></label>
											<div class="col-md-4">
												<input style="width: 100%;" type="text">
											</div>
											<label class="control-label text-right">Lampiran</label>
											<div class="col-md-2">
												<input style="width: 100%;" type="text" placeholder=" Hanya Dapat Melampirkan Dari Google Drive">
											</div>
											<div class="col-md-2">
												<select class="form-control" name="kelas">
													<option value="" selected disabled>Pilih Type</option>
													<option value="gambar">Gambar</option>
													<option value="video">Video</option>
													<option value="audio">Audio</option>
												</select>
											</div>
										</div>
									<?php } ?>
									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Kunci Jawaban</label>
										<div class="col-md-4">
											<select class="form-control" name="kelas">
												<option value="" selected disabled>Pilih Kunci</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="C">C</option>
												<option value="D">D</option>
											</select>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!-- /.mengelola jawaban tipe soal True/False-->
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban Matematika Untuk Tipe Soal True / False
								</div>
								<div class="card-body">
									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Kunci Jawaban</label>
										<div class="col-md-4">
											<select class="form-control" name="kelas">
												<option value="" selected disabled>Pilih Kunci</option>
												<option value="true">True</option>
												<option value="false">False</option>
											</select>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!-- /.mengelola jawaban tipe soal Jawaban Singkat-->
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban Matematika Untuk Tipe Soal jawaban Singkat
								</div>
								<div class="card-body">
									<div class="form-group d-flex">
										<label class="col-sm-2 control-label text-right">Kunci Jawaban</label>
										<div class="col-md-4">
											<input style="width: 100%;" type="text" placeholder="Tulisan Jawaban Singkat Maksimal 1kata">
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<!-- /.mengelola jawaban tipe soal Jawaban Singkat-->
					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header">
									Mengelola Jawaban Matematika Untuk Tipe Soal Mencocokan Jawaban
								</div>
								<div class="card-body">
									<?php for ($i = 1; $i < 6; $i++) {
									?>
										<div class="form-group d-flex">
											<label class="col-sm-2 control-label text-right">Row <?= $i ?></label>
											<div class="col-md-4">
												<input style="width: 100%;" type="text" placeholder="Row ke <?= $i ?>">
											</div>
											<label class="col-sm-1 control-label text-right">Col <?= $i ?></label>
											<div class="col-md-4">
												<input style="width: 100%;" type="text" placeholder="Jawaban untuk Row ke <?= $i ?>">
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)  // Kita sembunyikan dulu untuk loadingnya  
		$("#loading").hide();
		$("#kelas").change(function() { // Ketika user mengganti atau memilih data kelas    
			$("#mapel").hide(); // Sembunyikan dulu combobox mapel nya    
			$("#loading").show(); // Tampilkan loadingnya      
			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST      
				url: "<?= site_url('dashboard/get_mapel') ?>", // Isi dengan url/path file php yang dituju      
				data: {
					kelas: $("#kelas").val()
				}, // data yang akan dikirim ke file yang dituju      
				dataType: "json",
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response) { // Ketika proses pengiriman berhasil        
					$("#loading").hide(); // Sembunyikan loadingnya        // set isi dari combobox mapel        // lalu munculkan kembali combobox mapelnya        
					$("#mapel").html(response.data_mapel).show();
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error        
					alert(thrownError); // Munculkan alert error      
				}
			});
		});

		CKEDITOR.replace('editorfr');
	});
</script>


</html>