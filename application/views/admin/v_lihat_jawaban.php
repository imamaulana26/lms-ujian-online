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
							<h1 class="m-0 text-dark"><?= $title; ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<?php foreach ($breadcrumb as $val) {
									echo $val;
								} ?>
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
											<div class="col-md-4">
												<!-- Default dropright button -->
												<select class="form-control" name="kelas" id="kelas">
													<option value="" selected disabled>Pilih Kelas</option>
													<?php foreach ($dt_kelas as $kls) : ?>
														<option value="<?= $kls['kelas_id'] ?>"><?= $kls['kelas_nama'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="col-md-8">
												<!-- Default dropright button -->
												<select class="form-control" name="idmapel" id="mapel">
													<option value="" selected>Pilih Mapel</option>
												</select>
												<div id="loading" style="margin-top: 15px;"> <img src=" <?= site_url('assets/images/loading.gif') ?>" width="18"> <small>Loading...</small> </div>
											</div>
										</div>
										<span class="btn btn-info btn-show">Tampilkan</span>
									</div>

								</div>
							</div>
							<!-- /.card -->
						</div>
					</div>

					<div class="row">
						<div class="col-lg">
							<div class="card">
								<div class="card-header d-none my-0"></div>
								<div class="card-body">
									<table class="table table-hover" id="table_id">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Nama Siswa</th>
												<th scope="col">Ulangan Bulanan</th>
												<th scope="col">Nilai</th>
												<th scope="col">Waktu Submit</th>
												<th scope="col">Aksi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
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

		<!-- Main Footer -->
		<?php $this->load->view('admin/layouts/v_footer'); ?>
	</div>
	<!-- ./wrapper -->
</body>

<script>
	$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)  // Kita sembunyikan dulu untuk loadingnya
		// CKEDITOR.replace('editorfr');

		$("#loading").hide();

		$("#kelas").change(function() { // Ketika user mengganti atau memilih data kelas    
			$("#mapel").hide(); // Sembunyikan dulu combobox mapel nya    
			$("#loading").show(); // Tampilkan loadingnya      
			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST      
				url: "<?= site_url('guru/dashboard/get_mapel') ?>", // Isi dengan url/path file php yang dituju      
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


		$('.btn-show').on('click', function() {
			let header = $('.card-header');

			header.removeClass('d-none');
			header.html('<h4>Hasil Jawaban ' + $('#kelas option:selected').text() + ' - ' + $('#mapel option:selected').text() + '</h4>');

			$.ajax({
				url: "<?= site_url('guru/manage_soal/lihat_jawaban') ?>",
				type: "POST",
				data: {
					modul_pelajaran: $('#mapel').val()
				},
				dataType: "JSON",
				success: function(hasil) {
					console.log(hasil);

					var html = "";
					for (let i = 0; i < hasil.length; i++) {
						html += "<tr>";
						for (let n = 0; n < hasil[i].length; n++) {
							html += "<td>" + hasil[i][n] + "</td>";
						}
						html += "</tr>";
					}

					$('#table_id > tbody').html(html);
				}
			});
		});
	});
</script>


</html>