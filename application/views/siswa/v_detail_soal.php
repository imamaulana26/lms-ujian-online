<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition sidebar-collapse layout-top-nav">
	<div class="preloader d-none">

		<div class="loading">

			<div class="spinner-border" role="status">

				<span class="sr-only">Loading...</span>

			</div>

		</div>

	</div>
	<?php $this->load->view('siswa/layouts/navbar.php'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container">
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
			<div class="container">
				<!-- Tagihan -->
				<div class="row">
					<div class="offset-1 col-sm-10 media-nav">
						<!-- Index Prestasi -->
						<div class="card card-primary card-outline">
							<div class="card-header">
								<h5 class="card-title m-0"><i class="fas fa-fw fa-clipboard-list fa-lg"></i> List Ujian Bulanan Siswa</h5>
							</div>
							<div class="card-body">
								<div class="row d-flex justify-content-center">
									<div class="col-md-6">
										<table class="table table-bordered table-sm">
											<tr>
												<th class="pl-2">Module</th>
												<td class="pl-2">UB-<?= $soal['modul_ub']; ?></td>
											</tr>
											<tr>
												<th class="pl-2">Mata Pelajaran</th>
												<td class="pl-2"><?= $this->session->userdata('nama_mapel'); ?></td>
											</tr>
											<tr>
												<th class="pl-2">Nama Pengajar</th>
												<td class="pl-2"><?= $this->session->userdata('nama_pengajar'); ?></td>
											</tr>
											<tr>
												<th class="pl-2">Durasi Pengerjaan</th>
												<?php if ($status_ujian > 0) : ?>
													<td class="pl-2"><?= $soal['waktu_pengerjaan']; ?> menit</td>
												<?php else : ?>
													<td class="font-weight-bold pl-2">Waktu Ujian Telah Selesai</td>
												<?php endif; ?>
											</tr>
											<?php if ($status_ujian > 0 && $sisa_waktu > 0) : ?>
												<tr>
													<th class="pl-2">Sisa Waktu</th>
													<td class="pl-2"><?= $format_sisa_waktu; ?></td>
												</tr>
											<?php endif; ?>
										</table>

										<div class="d-flex justify-content-center mb-3">
											<a href="<?= site_url('siswa/dashboard') ?>" class="btn btn-default mr-2">Kembali</a>
											<form action="<?= site_url('siswa/test/kerjakan') ?>" method="POST">
												<input type="hidden" name="id_modul" id="id_modul" value="<?= $soal['id_modul'] ?>">
												<input type="hidden" name="waktu_tes" id="waktu_tes" value="<?= $soal['waktu_pengerjaan'] ?>">

												<?php if ($status_ujian > 0) : ?>
													<?php if ($sisa_waktu > 0) : ?>
														<button type="submit" class="btn btn-warning">Lanjut Mengerjakan</button>
													<?php else : ?>
														<button type="submit" class="btn btn-success">Mulai Kerjakan</button>
													<?php endif; ?>
												<?php endif; ?>
											</form>
										</div>

										<p class="text-danger">
											<i>*) Hubungi Admin Jika ingin reset Status Ujian Anda.</i>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
	<!-- /.content-wrapper -->
</body>

</html>